<?php
require_once("./layout/header.php");

// Get search query
$search_term = isset($_GET['q']) ? trim($_GET['q']) : '';

// Setup pagination
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 24; // Increase items per page for shopee-like grid
$offset = ($page - 1) * $limit;

// Get sorting option
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'latest';
$sort_query = "";
switch ($sort) {
    case 'price_low':
        $sort_query = "ORDER BY price ASC";
        break;
    case 'price_high':
        $sort_query = "ORDER BY price DESC";
        break;
    case 'popular':
        $sort_query = "ORDER BY sold_count DESC";
        break;
    default: // latest
        $sort_query = "ORDER BY p.id DESC";
}

if (!empty($search_term)) {
    // Search products with pagination - UPDATED to filter by active sellers
    $product_query = "SELECT p.*, f.src as image_src, s.full_name as seller_name, s.id as seller_id, 
                             c.name as category_name,
                             p.purchase_price + p.rose + p.profit as price,
                             (SELECT COALESCE(SUM(quantity), 0) FROM detail_orders WHERE name = p.name) as sold_count
                      FROM products p
                      LEFT JOIN file f ON p.thumbnail_image = f.id
                      LEFT JOIN sellers s ON p.seller_id = s.id
                      LEFT JOIN categories c ON p.category_id = c.id
                      WHERE p.published = 1 
                      AND p.seller_id IS NOT NULL
                      AND s.status = 'active'
                      AND (p.name LIKE ? OR p.tags LIKE ?) ";
                      
    $product_query .= $sort_query . " LIMIT ?, ?";
                      
    $stmt = $conn->prepare($product_query);
    $search_pattern = "%$search_term%";
    $stmt->bind_param("ssii", $search_pattern, $search_pattern, $offset, $limit);
    $stmt->execute();
    $products_result = $stmt->get_result();
    
    // Get total products count for pagination - UPDATED to filter by active sellers
    $count_query = "SELECT COUNT(*) as total 
                    FROM products p
                    JOIN sellers s ON p.seller_id = s.id
                    WHERE p.published = 1 
                    AND p.seller_id IS NOT NULL
                    AND s.status = 'active'
                    AND (p.name LIKE ? OR p.tags LIKE ?)";
    $stmt = $conn->prepare($count_query);
    $stmt->bind_param("ss", $search_pattern, $search_pattern);
    $stmt->execute();
    $total_products = $stmt->get_result()->fetch_assoc()['total'];
    $total_pages = ceil($total_products / $limit);
    
    // Search sellers
    $seller_query = "SELECT s.*, f.src as shop_logo,
                           (SELECT COUNT(*) FROM products WHERE seller_id = s.id AND published = 1) as product_count
                    FROM sellers s
                    LEFT JOIN file f ON s.shop_logo = f.id
                    WHERE s.status = 'active'
                    AND (s.full_name LIKE ? OR s.shop_name LIKE ?)
                    ORDER BY product_count DESC
                    LIMIT 6";
    $stmt = $conn->prepare($seller_query);
    $stmt->bind_param("ss", $search_pattern, $search_pattern);
    $stmt->execute();
    $sellers_result = $stmt->get_result();

    // Get related categories
    $category_query = "SELECT c.*,
                      (SELECT COUNT(*) FROM products WHERE category_id = c.id AND published = 1) as product_count
                      FROM categories c
                      JOIN products p ON c.id = p.category_id
                      WHERE p.name LIKE ? OR p.tags LIKE ?
                      GROUP BY c.id
                      ORDER BY product_count DESC
                      LIMIT 6";
    $stmt = $conn->prepare($category_query);
    $stmt->bind_param("ss", $search_pattern, $search_pattern);
    $stmt->execute();
    $categories_result = $stmt->get_result();
}
?>

<!-- Shopee-style search results page -->
<div class="min-h-screen bg-gray-100 pb-10">
    <!-- Search Header with stats -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-gray-800 font-medium">
                        <?= !empty($search_term) ? "Search results for \"<span class=\"text-shopee-500\">".htmlspecialchars($search_term)."</span>\"" : "Search Products" ?>
                    </h1>
                    <?php if (!empty($search_term) && $total_products > 0): ?>
                        <p class="text-sm text-gray-500 mt-0.5">
                            <?= number_format($total_products) ?> products found
                        </p>
                    <?php endif; ?>
                </div>
                <!-- Search stats -->
                <?php if (!empty($search_term) && $total_products > 0): ?>
                <div class="hidden md:block text-sm text-gray-500">
                    Page <?= $page ?> of <?= $total_pages ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-4">
        <?php if (empty($search_term)): ?>
            <!-- Empty Search State -->
            <div class="flex flex-col items-center justify-center bg-white rounded-lg shadow-sm py-12 px-4">
                <div class="w-32 h-32 bg-shopee-50 rounded-full flex items-center justify-center mb-6">
                    <i class="fa-solid fa-search text-5xl text-shopee-300"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Start Your Search</h2>
                <p class="text-gray-600 mb-6 text-center">Enter keywords in the search bar above to find products and shops</p>
                <div class="w-full max-w-md">
                    <form action="/search" method="GET" class="flex">
                        <input 
                            type="text" 
                            name="q" 
                            placeholder="What are you looking for?"
                            class="flex-grow px-4 py-2.5 border border-gray-300 rounded-l-md focus:outline-none focus:border-shopee-500"
                            required
                        >
                        <button type="submit" class="px-6 bg-shopee-500 text-white rounded-r-md hover:bg-shopee-600 transition-colors">
                            <i class="fa-solid fa-search mr-1"></i> Search
                        </button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Search Results -->
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Left Sidebar on larger screens - Categories & Sellers -->
                <div class="lg:w-64 flex-shrink-0">
                    <!-- Related Categories -->
                    <?php if(isset($categories_result) && $categories_result->num_rows > 0): ?>
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                        <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                            <i class="fa-solid fa-th-large text-shopee-500 mr-2"></i> Related Categories
                        </h3>
                        <ul class="space-y-2">
                            <?php while($category = $categories_result->fetch_assoc()): 
                                $category_img = !empty($category['img']) ? "/public/uploads/all/{$category['img']}" : "/public/assets/img/placeholder.jpg";
                            ?>
                            <li>
                                <a href="/category/<?= $category['path'] ?>" class="flex items-center py-1.5 px-2 rounded-md hover:bg-shopee-50 transition group">
                                    <div class="w-8 h-8 rounded-full overflow-hidden border border-gray-200 mr-2">
                                        <img src="<?= $category_img ?>" alt="<?= htmlspecialchars($category['name']) ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-grow">
                                        <span class="text-sm text-gray-700 group-hover:text-shopee-500"><?= htmlspecialchars($category['name']) ?></span>
                                        <span class="block text-xs text-gray-500"><?= number_format($category['product_count']) ?> items</span>
                                    </div>
                                </a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Related Shops -->
                    <?php if (isset($sellers_result) && $sellers_result->num_rows > 0): ?>
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                        <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                            <i class="fa-solid fa-store text-shopee-500 mr-2"></i> Related Shops
                        </h3>
                        <ul class="space-y-3">
                            <?php while($seller = $sellers_result->fetch_assoc()): 
                                $shop_logo = !empty($seller['shop_logo']) ? "/public/uploads/all/{$seller['shop_logo']}" : "/public/assets/img/placeholder.jpg";
                            ?>
                            <li>
                                <a href="/shop/<?= $seller['id'] ?>" class="flex items-center py-1.5 px-2 rounded-md hover:bg-shopee-50 transition group">
                                    <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200 mr-3">
                                        <img src="<?= $shop_logo ?>" alt="<?= htmlspecialchars($seller['full_name']) ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-800 group-hover:text-shopee-500 line-clamp-1"><?= htmlspecialchars($seller['full_name']) ?></h4>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="text-xs text-gray-500"><?= number_format($seller['product_count']) ?> products</span>
                                            <span class="inline-flex items-center text-xs">
                                                <i class="fa-solid fa-star text-yellow-400 mr-0.5"></i>
                                                <?= number_format(rand(4, 5) + rand(0, 9) / 10, 1) ?>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Price Filter -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
                        <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                            <i class="fa-solid fa-filter text-shopee-500 mr-2"></i> Filter by Price
                        </h3>
                        <form action="/search" method="GET" class="space-y-3">
                            <input type="hidden" name="q" value="<?= htmlspecialchars($search_term) ?>">
                            
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Min Price</label>
                                    <input type="number" name="min_price" placeholder="0" min="0" class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-shopee-500">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 block mb-1">Max Price</label>
                                    <input type="number" name="max_price" placeholder="Any" min="0" class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-shopee-500">
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full py-2 bg-shopee-500 text-white text-sm rounded hover:bg-shopee-600 transition-colors">
                                Apply Filter
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-grow">
                    <!-- Sort options -->
                    <div class="bg-white rounded-lg shadow-sm p-3 mb-4 flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-700">Sort by:</div>
                        <div class="flex flex-wrap gap-2">
                            <a href="?q=<?= urlencode($search_term) ?>&sort=latest" class="px-3 py-1.5 text-sm rounded <?= $sort == 'latest' ? 'bg-shopee-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                                Latest
                            </a>
                            <a href="?q=<?= urlencode($search_term) ?>&sort=popular" class="px-3 py-1.5 text-sm rounded <?= $sort == 'popular' ? 'bg-shopee-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                                Popular
                            </a>
                            <a href="?q=<?= urlencode($search_term) ?>&sort=price_low" class="px-3 py-1.5 text-sm rounded <?= $sort == 'price_low' ? 'bg-shopee-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                                Price: Low to High
                            </a>
                            <a href="?q=<?= urlencode($search_term) ?>&sort=price_high" class="px-3 py-1.5 text-sm rounded <?= $sort == 'price_high' ? 'bg-shopee-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
                                Price: High to Low
                            </a>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <?php if (isset($products_result) && $total_products > 0): ?>
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-6 gap-3">
                                <?php while ($product = $products_result->fetch_assoc()):
                                    $image_url = $product['thumbnail_image'] ? "/public/uploads/all/" . $product['thumbnail_image'] : "/public/assets/img/placeholder.jpg";
                                    
                                    // Calculate discount percentage when applicable
                                    $discount_percent = 0;
                                    $original_price = $product['price'];
                                    $final_price = $product['price'];
                                    
                                    if (!empty($product['discount']) && $product['discount'] > 0) {
                                        $discount_percent = $product['discount'];
                                        $final_price = $original_price - $discount_percent;
                                    }
                                ?>
                                <div class="group">
                                    <div class="relative overflow-hidden rounded-sm border border-gray-200 hover:border-shopee-500 hover:shadow-md transition-all duration-300 h-full flex flex-col">
                                        <a href="/product/<?= $product['id'] ?>" class="block relative pt-[100%]">
                                            <img 
                                                src="<?= $image_url ?>" 
                                                alt="<?= htmlspecialchars($product['name']) ?>"
                                                class="absolute inset-0 w-full h-full object-contain group-hover:scale-105 transition-transform duration-500"
                                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';"
                                            >
                                            <?php if ($discount_percent > 0): ?>
                                                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded">
                                                    -<?= ceil(($product['discount'] / $product['purchase_price']) * 100) ?>%
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($product['sold_count']) && $product['sold_count'] > 0): ?>
                                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-2">
                                                    <span class="text-white text-xs">Sold <?= number_format($product['sold_count']) ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                        
                                        <div class="p-2 flex-grow flex flex-col">
                                            <a href="/product/<?= $product['id'] ?>" class="block">
                                                <h3 class="text-sm text-gray-800 line-clamp-2 group-hover:text-shopee-500 mb-1">
                                                    <?= htmlspecialchars($product['name']) ?>
                                                </h3>
                                            </a>
                                            
                                            <div class="mt-auto">
                                                <div class="flex items-center gap-1">
                                                    <span class="text-shopee-500 font-bold"><?= number_format($final_price, 0, ',', '.') ?>$</span>
                                                    <?php if ($discount_percent > 0): ?>
                                                        <span class="text-gray-400 text-xs line-through"><?= number_format($original_price, 0, ',', '.') ?>$</span>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <?php if (!empty($product['seller_name'])): ?>
                                                    <div class="mt-1 flex items-center text-xs text-gray-500">
                                                        <i class="fa-solid fa-store mr-1 text-gray-400"></i>
                                                        <span class="truncate"><?= htmlspecialchars($product['seller_name']) ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <div class="flex items-center justify-between mt-2">
                                                    <div class="flex items-center gap-0.5">
                                                        <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                                        <span class="text-xs text-gray-500"><?= number_format(rand(40, 50) / 10, 1) ?></span>
                                                    </div>
                                                    <button class="text-gray-400 hover:text-shopee-500 transition">
                                                        <i class="fa-regular fa-heart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>

                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                            <div class="mt-6 flex justify-center">
                                <nav class="inline-flex rounded-md shadow overflow-hidden">
                                    <?php if ($page > 1): ?>
                                        <a href="?q=<?= urlencode($search_term) ?>&page=<?= $page-1 ?>&sort=<?= $sort ?>" class="relative inline-flex items-center px-3 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 border-r border-gray-200">
                                            <i class="fa-solid fa-chevron-left text-xs mr-1"></i>
                                            Previous
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php
                                    $start_page = max(1, min($page - 2, $total_pages - 4));
                                    $end_page = min($total_pages, max($page + 2, 5));
                                    
                                    for($i = $start_page; $i <= $end_page; $i++):
                                    ?>
                                        <a href="?q=<?= urlencode($search_term) ?>&page=<?= $i ?>&sort=<?= $sort ?>" 
                                           class="relative inline-flex items-center px-4 py-2 <?= $i === $page ? 'bg-shopee-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' ?> text-sm font-medium border-r border-gray-200">
                                            <?= $i ?>
                                        </a>
                                    <?php endfor; ?>
                                    
                                    <?php if ($page < $total_pages): ?>
                                        <a href="?q=<?= urlencode($search_term) ?>&page=<?= $page+1 ?>&sort=<?= $sort ?>" class="relative inline-flex items-center px-3 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                            Next
                                            <i class="fa-solid fa-chevron-right text-xs ml-1"></i>
                                        </a>
                                    <?php endif; ?>
                                </nav>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <!-- No Results State -->
                        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                            <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center">
                                <i class="fa-solid fa-search text-3xl text-gray-400"></i>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">No Products Found</h2>
                            <p class="text-gray-600 mb-6">We couldn't find any products matching "<?= htmlspecialchars($search_term) ?>"</p>
                            <div class="space-y-3">
                                <p class="text-gray-500">Try:</p>
                                <ul class="text-gray-500 text-sm space-y-1">
                                    <li>• Checking your spelling</li>
                                    <li>• Using fewer or more general keywords</li>
                                    <li>• Looking in a different category</li>
                                </ul>
                            </div>
                            <a href="/" class="inline-flex items-center justify-center px-6 py-3 mt-6 border border-transparent text-base font-medium rounded-md text-white bg-shopee-500 hover:bg-shopee-600 transition-colors">
                                Return to Homepage
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once("./layout/footer.php"); ?>