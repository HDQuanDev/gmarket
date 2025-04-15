<?php
include_once("../config.php");

    $path = isset($_GET['path']) ? $_GET['path'] : null;
    if($path) {
        $checkExist = fetch_array("SELECT * FROM categories WHERE path='$path' LIMIT 1");
    }else {
         $checkExist = fetch_array("SELECT * FROM categories LIMIT 1");
    }
    
    if (!$checkExist) {
        die("Category not found");
    } else {
        $categoryId = $checkExist['id'];
        $categoryName = $checkExist['name'];

        // Setup pagination
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = 12; // Products per page
        $offset = ($page - 1) * $limit;
        
        // Get total products count for pagination - UPDATED to filter by active sellers
        $count_query = "SELECT COUNT(*) as total 
                        FROM products p 
                        JOIN sellers s ON p.seller_id = s.id
                        WHERE p.category_id='$categoryId' 
                        AND p.published=1 
                        AND p.seller_id IS NOT NULL
                        AND s.status = 'active'";
        $count_result = mysqli_query($conn, $count_query);
        $total_products = mysqli_fetch_assoc($count_result)['total'];
        $total_pages = ceil($total_products / $limit);
        
        // Get products with pagination and include seller information - UPDATED to filter by active sellers
        $products_query = "SELECT p.*, f.src as image_src, s.id as seller_id, s.full_name as seller_name 
                          FROM products p 
                          JOIN sellers s ON p.seller_id = s.id
                          LEFT JOIN file f ON p.thumbnail_image = f.id
                          WHERE p.category_id='$categoryId' 
                          AND p.published=1
                          AND s.status = 'active'
                          ORDER BY p.create_date DESC 
                          LIMIT $limit OFFSET $offset";
        $products_result = mysqli_query($conn, $products_query);
        
        // Check if products exist
        if (mysqli_num_rows($products_result) == 0 && $page == 1) {
            $no_products = true;
        } else {
            $no_products = false;
            $products = [];
            while ($product = mysqli_fetch_assoc($products_result)) {
                $products[] = $product;
            }
        }
    }


include("../layout/header.php");
?>

<div class="bg-gray-100 min-h-screen py-4">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-4 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="text-gray-500 hover:text-shopee-500">
                        <i class="fa-solid fa-home mr-1"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-400 mx-1"></i>
                        <a href="/categories" class="text-gray-500 hover:text-shopee-500">All Categories</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-400 mx-1"></i>
                        <span class="text-shopee-600 font-medium"><?= $categoryName ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row gap-4">
            <!-- Category Sidebar -->
            <div class="w-full md:w-60 flex-shrink-0">
                <!-- Mobile filter toggle -->
                <div class="md:hidden mb-4">
                    <button type="button" class="w-full flex items-center justify-between bg-white p-3 rounded-md shadow-sm" 
                            onclick="document.getElementById('mobile-filter').classList.toggle('hidden')">
                        <span class="font-medium">Filters</span>
                        <i class="fa-solid fa-filter text-shopee-500"></i>
                    </button>
                </div>
                
                <!-- Filter sidebar content -->
                <div id="mobile-filter" class="hidden md:block">
                    <div class="bg-white rounded-md shadow-sm mb-4 overflow-hidden">
                        <div class="bg-gray-50 py-3 px-4 border-b border-gray-200">
                            <h3 class="font-medium text-gray-800">Categories</h3>
                        </div>
                        <div class="p-4">
                            <ul class="space-y-2">
                                <?php
                                // Get all categories
                                $categories_query = "SELECT * FROM categories ORDER BY name ASC";
                                $categories_result = mysqli_query($conn, $categories_query);
                                while($category = mysqli_fetch_assoc($categories_result)):
                                ?>
                                <li>
                                    <a href="/category/<?= $category['path'] ?>" 
                                       class="block hover:text-shopee-500 transition <?= ($category['id'] == $categoryId) ? 'text-shopee-500 font-medium' : 'text-gray-600' ?>">
                                        <?= $category['name'] ?>
                                    </a>
                                </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Category Header with Sorting -->
                <div class="bg-white p-4 rounded-md shadow-sm mb-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <h1 class="text-xl font-medium text-gray-800"><?= $categoryName ?></h1>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500 whitespace-nowrap">Sort by:</span>
                            <select class="form-select text-sm border border-gray-300 rounded-md py-2 pl-3 pr-8 focus:outline-none focus:ring-2 focus:ring-shopee-500 focus:border-shopee-500" 
                                    name="sort_by" 
                                    onchange="sort_products()">
                                <option value="newest" <?= (!isset($_GET['sort_by']) || $_GET['sort_by'] == 'newest') ? 'selected' : '' ?>>Newest</option>
                                <option value="oldest" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'oldest') ? 'selected' : '' ?>>Oldest</option>
                                <option value="price_low" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_low') ? 'selected' : '' ?>>Price low to high</option>
                                <option value="price_high" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'price_high') ? 'selected' : '' ?>>Price high to low</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <?php if (isset($no_products) && $no_products): ?>
                    <div class="bg-white rounded-md shadow-sm p-10 text-center">
                        <img src="/public/assets/img/empty-box.png" alt="No products" class="w-24 h-24 mx-auto mb-4 opacity-50">
                        <h3 class="text-lg font-medium text-gray-800 mb-2">No Products Found</h3>
                        <p class="text-gray-500 mb-4">We couldn't find any products in this category.</p>
                        <a href="/" class="inline-block bg-shopee-500 hover:bg-shopee-600 text-white font-medium py-2 px-4 rounded-md transition">
                            Continue Shopping
                        </a>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        <?php foreach ($products as $product): 
                            $product_price = $product['unit_price'] + $product['rose'] + $product['profit'];
                            $product_price_real = $product_price;
                            if (!empty($product['discount']) && $product['discount'] > 0) {
                                $product_price_real = $product_price - $product['discount'];
                            }
                            $image_url = $product['thumbnail_image'] ? "/public/uploads/all/" . $product['thumbnail_image'] : "/public/assets/img/placeholder.jpg";
                        ?>
                        <div class="bg-white rounded-md shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                            <!-- Product Image with Discount Badge -->
                            <div class="relative pt-[100%] overflow-hidden">
                                <a href="/product/<?= $product['id'] ?>">
                                    <img 
                                        src="<?= $image_url ?>" 
                                        alt="<?= htmlspecialchars($product['name']) ?>" 
                                        class="absolute top-0 left-0 w-full h-full object-cover transition hover:scale-105"
                                        onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">
                                </a>
                                <?php if($product['discount'] > 0): ?>
                                <div class="absolute top-0 right-0 bg-shopee-500 text-white px-2 py-1 text-xs font-medium">
                                    -<?= ($product['discount'] / $product['unit_price']) * 100 ?>%
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-3">
                                <!-- Product Name -->
                                <h3 class="text-sm text-gray-800 font-medium mb-1 line-clamp-2 min-h-[2.5rem]">
                                    <a href="/product/<?= $product['id'] ?>" class="hover:text-shopee-500">
                                        <?= htmlspecialchars($product['name']) ?>
                                    </a>
                                </h3>
                                
                                <!-- Seller Name -->
                                <?php if (!empty($product['seller_name'])): ?>
                                <div class="text-xs text-gray-500 mb-2 flex items-center">
                                    <span>Sold by: </span>
                                    <a href="/shop.php?id=<?= $product['seller_id'] ?>" class="ml-1 text-shopee-500 hover:underline">
                                        <?= htmlspecialchars($product['seller_name']) ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Price -->
                                <div class="flex items-center">
                                    <span class="text-shopee-500 font-medium text-base">
                                        <?= number_format($product_price_real, 0, ',', '.') ?> $
                                    </span>
                                    
                                    <?php if($product['discount'] > 0): 
                                        $original_price = $product_price / (1 - $product['discount']/100);
                                    ?>
                                    <span class="ml-1 text-xs text-gray-400 line-through">
                                        <?= number_format($original_price, 0, ',', '.') ?> $
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if($total_pages > 1): ?>
                    <div class="mt-6 flex justify-center">
                        <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <?php if($page > 1): ?>
                            <a href="?path=<?= $path ?>&page=<?= $page-1 ?><?= isset($_GET['sort_by']) ? '&sort_by='.$_GET['sort_by'] : '' ?>" 
                               class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fa-solid fa-angle-left text-xs"></i>
                            </a>
                            <?php endif; ?>
                            
                            <?php
                            $start_page = max(1, $page - 2);
                            $end_page = min($total_pages, $page + 2);
                            
                            if ($start_page > 1): ?>
                                <a href="?path=<?= $path ?>&page=1<?= isset($_GET['sort_by']) ? '&sort_by='.$_GET['sort_by'] : '' ?>" 
                                   class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    1
                                </a>
                                <?php if ($start_page > 2): ?>
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                        ...
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php for($i=$start_page; $i<=$end_page; $i++): ?>
                            <a href="?path=<?= $path ?>&page=<?= $i ?><?= isset($_GET['sort_by']) ? '&sort_by='.$_GET['sort_by'] : '' ?>" 
                               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium 
                                     <?= ($i == $page) ? 'bg-shopee-50 border-shopee-500 text-shopee-500 z-10' : 'bg-white text-gray-700 hover:bg-gray-50' ?>">
                                <?= $i ?>
                            </a>
                            <?php endfor; ?>
                            
                            <?php if ($end_page < $total_pages): ?>
                                <?php if ($end_page < $total_pages - 1): ?>
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                        ...
                                    </span>
                                <?php endif; ?>
                                <a href="?path=<?= $path ?>&page=<?= $total_pages ?><?= isset($_GET['sort_by']) ? '&sort_by='.$_GET['sort_by'] : '' ?>" 
                                   class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <?= $total_pages ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if($page < $total_pages): ?>
                            <a href="?path=<?= $path ?>&page=<?= $page+1 ?><?= isset($_GET['sort_by']) ? '&sort_by='.$_GET['sort_by'] : '' ?>" 
                               class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fa-solid fa-angle-right text-xs"></i>
                            </a>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function sort_products() {
        var sort_by = $('select[name=sort_by]').val();
        var url = window.location.href;
        url = updateURLParameter(url, 'sort_by', sort_by);
        window.location.href = url;
    }

    function updateURLParameter(url, param, paramVal) {
        var newAdditionalURL = "";
        var tempArray = url.split("?");
        var baseURL = tempArray[0];
        var additionalURL = tempArray[1];
        var temp = "";
        
        if (additionalURL) {
            tempArray = additionalURL.split("&");
            for (var i=0; i<tempArray.length; i++) {
                if (tempArray[i].split('=')[0] != param) {
                    newAdditionalURL += temp + tempArray[i];
                    temp = "&";
                }
            }
        }

        var rows_txt = temp + "" + param + "=" + paramVal;
        return baseURL + "?" + newAdditionalURL + rows_txt;
    }
</script>

<?php include("../layout/footer.php"); ?>