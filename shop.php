<?php
require_once(__DIR__ . '/layout/header.php');

// Check if seller ID is provided
$seller_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($seller_id <= 0) {
    header("Location: /");
    exit;
}

// Get seller information
$seller_query = "SELECT * FROM sellers WHERE id = $seller_id";
$seller_result = mysqli_query($conn, $seller_query);

if (mysqli_num_rows($seller_result) == 0) {
    header("Location: /");
    exit;
}

$seller = mysqli_fetch_assoc($seller_result);

// Check if seller status is active
if ($seller['status'] != 'active') {
    // Update visitor count even for inactive shops (for tracking purposes)
    mysqli_query($conn, "UPDATE sellers SET visitors = visitors + 1 WHERE id = $seller_id");
    ?>
    <div class="bg-gray-100 min-h-screen py-12">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto text-center">
                <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Shop Unavailable</h2>
                <p class="text-gray-600 mb-6">
                    This shop is currently not active or has been suspended. The shop owner needs to activate their account to make their products available.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-3">
                    <a href="/" class="inline-block bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-md transition-colors">
                        Return to Homepage
                    </a>
                    <?php if ($isLogin): ?>
                    <a href="#" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-md transition-colors">
                        Contact Support
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
    require_once(__DIR__ . '/layout/footer.php');
    exit;
}

// Update visitor count
mysqli_query($conn, "UPDATE sellers SET visitors = visitors + 1 WHERE id = $seller_id");

// Get categories with product counts for this seller
$categories_query = "SELECT c.*, COUNT(p.id) as product_count 
                    FROM categories c
                    JOIN products p ON p.category_id = c.id
                    WHERE p.seller_id = $seller_id AND p.published = 1
                    GROUP BY c.id
                    HAVING product_count > 0
                    ORDER BY c.name ASC";
$categories_result = mysqli_query($conn, $categories_query);

// Handle product filtering
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$sort_by = isset($_GET['sort_by']) ? mysqli_real_escape_string($conn, $_GET['sort_by']) : 'newest';
$limit = 12;
$offset = ($page - 1) * $limit;

// Build query conditions
$where = "WHERE p.seller_id = $seller_id AND p.published = 1";
if ($category_id > 0) {
    $where .= " AND p.category_id = $category_id";
}
if (!empty($search)) {
    $where .= " AND (p.name LIKE '%$search%' OR p.tags LIKE '%$search%')";
}

// Build order by clause
$order_by = "";
switch ($sort_by) {
    case 'price_low_to_high':
        $order_by = "ORDER BY p.purchase_price ASC";
        break;
    case 'price_high_to_low':
        $order_by = "ORDER BY p.purchase_price DESC";
        break;
    case 'popularity':
        $order_by = "ORDER BY p.visitors DESC";
        break;
    case 'rating':
        $order_by = "ORDER BY p.rating DESC";
        break;
    default:
        $order_by = "ORDER BY p.id DESC";
        break;
}

// Count total products for pagination
$count_query = "SELECT COUNT(*) as count FROM products p $where";
$count_result = mysqli_query($conn, $count_query);
$total_products = mysqli_fetch_assoc($count_result)['count'];
$total_pages = ceil($total_products / $limit);

// Get products
$products_query = "SELECT p.*, c.name as category_name, f.src as image_src
                  FROM products p
                  LEFT JOIN categories c ON p.category_id = c.id
                  LEFT JOIN file f ON p.thumbnail_image = f.id
                  $where
                  $order_by
                  LIMIT $offset, $limit";
$products_result = mysqli_query($conn, $products_query);

// Get seller's rating details
$rating = floatval($seller['rating']);

// Generate shop banner and avatar based on seller name if not available
$shop_name = $seller['full_name'];
$shop_initial = strtoupper(substr($shop_name, 0, 1));
$shop_logo=fetch_array("SELECT * FROM file WHERE id='{$seller['shop_logo']}' LIMIT 1");
$banner_image = !empty($seller['banners']) ? '/public/uploads/all' . $seller['banners'] : 'https://ui-avatars.com/api/?name=' . urlencode($shop_name) . '&background=ff5722&color=fff&size=800&bold=true';
$avatar_image = !empty($seller['shop_logo']) ? '/public/uploads/all/' . $shop_logo['src'] : 'https://ui-avatars.com/api/?name=' . urlencode($shop_name) . '&background=ff5722&color=fff&size=400&bold=true';


// Add meta tags for chat functionality
$chatUserType = "";
$chatUserName = "";
$chatUserId = "";

if (isset($user_id) && $user_id > 0) {
    if (isset($isSeller) && $isSeller) {
        $chatUserType = "seller";
        $chatUserName = htmlspecialchars($seller_full_name ?? '');
        $chatUserId = $seller_id ?? '';
    } else {
        $chatUserType = isset($isAdmin) && $isAdmin ? "admin" : "user";
        $chatUserName = htmlspecialchars($user_name ?? '');
        $chatUserId = $user_id ?? '';
    }
}
?>

<!-- Add meta tags for chat functionality -->
<meta name="user-id" content="<?= $chatUserId ?>">
<meta name="user-type" content="<?= $chatUserType ?>">
<meta name="user-name" content="<?= $chatUserName ?>">

<div class="bg-gray-100 min-h-screen">
    <!-- Breadcrumb -->
    <div class="bg-white py-3 shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="text-gray-500 hover:text-shopee-500">
                            <i class="fa-solid fa-home mr-1"></i> Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-angle-right text-gray-400 mx-1"></i>
                            <span class="text-shopee-600 font-medium"><?= htmlspecialchars($seller['full_name']) ?></span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Shop Banner and Info -->
    <div class="relative h-48 md:h-64 bg-cover bg-center" style="background-image: url('<?php echo get_image($conn,$seller['banners']); ?>');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        
        <div class="container mx-auto px-4 h-full relative">
            <div class="flex items-end h-full pb-4">
                <div class="flex flex-col md:flex-row items-center md:items-end gap-4 text-white w-full">
                    <!-- Shop Logo -->
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-full border-4 border-white overflow-hidden flex-shrink-0 -mb-10 z-10">
                        <img src="<?php echo $avatar_image; ?>"
                             class="w-full h-full object-cover" 
                             alt="<?php echo htmlspecialchars($seller['full_name']); ?>">
                    </div>
                    
                    <!-- Shop Name and Stats -->
                    <div class="text-center md:text-left md:pb-2">
                        <h1 class="text-2xl font-bold"><?php echo htmlspecialchars($seller['full_name']); ?></h1>
                    </div>
                    
                    <!-- Verification Badge -->
                    <?php if ($seller['status'] == 'active'): ?>
                        <div class="ml-0 md:ml-auto md:pb-2">
                            <span class="bg-white text-shopee-500 text-xs font-medium rounded-full py-1 px-3 flex items-center">
                                <i class="fa-solid fa-circle-check mr-1"></i> Verified Seller
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Shop Stats Bar -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap py-4 md:py-2 gap-4 justify-center md:justify-start">
                <!-- Extra space for logo on mobile -->
                <div class="w-full md:hidden h-6"></div>
                
                <!-- Chat Button (Prominently displayed for logged-in users) -->
                <?php if (isset($user_id) && $user_id > 0): ?>
                <div class="w-full md:w-auto order-1 mb-2 md:mb-0">
                    <button type="button"
                       class="shop-chat-button w-full md:w-auto flex items-center justify-center text-sm bg-blue-500 hover:bg-blue-600 transition text-white px-6 py-2 rounded-md shadow-sm"
                       data-seller-id="<?= $seller_id ?>" 
                       data-seller-name="<?= htmlspecialchars($seller['full_name']) ?>">
                        <i class="fa-solid fa-comments mr-2"></i>
                        <span>Chat with Seller</span>
                    </button>
                </div>
                <?php elseif (!isset($user_id) || $user_id <= 0): ?>
                <div class="w-full md:w-auto order-1 mb-2 md:mb-0">
                    <a href="/users/login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>"
                       class="w-full md:w-auto flex items-center justify-center text-sm bg-gray-200 hover:bg-gray-300 transition text-gray-700 px-6 py-2 rounded-md shadow-sm">
                        <i class="fa-solid fa-lock mr-2"></i>
                        <span>Login to Chat</span>
                    </a>
                </div>
                <?php endif; ?>
                
                <!-- Rating -->
                <div class="flex items-center text-sm">
                    <span class="mr-2">Rating:</span>
                    <div class="flex items-center">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php if ($i <= $rating): ?>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            <?php elseif ($i - 0.5 <= $rating): ?>
                                <i class="fa-solid fa-star-half-stroke text-yellow-400"></i>
                            <?php else: ?>
                                <i class="fa-regular fa-star text-yellow-400"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <span class="ml-1 text-shopee-500 font-medium"><?= number_format($rating, 1) ?></span>
                    </div>
                </div>
                
                <!-- Separator -->
                <div class="hidden md:block h-6 border-l border-gray-300"></div>
                
                <!-- Products Count -->
                <div class="flex items-center text-sm">
                    <span class="mr-2">Products:</span>
                    <span class="text-shopee-500 font-medium"><?= number_format($total_products) ?></span>
                </div>
                
                <!-- Separator -->
                <div class="hidden md:block h-6 border-l border-gray-300"></div>
                
                <!-- Visitors -->
                <div class="flex items-center text-sm">
                    <span class="mr-2">Visitors:</span>
                    <span class="text-shopee-500 font-medium"><?= number_format($seller['visitors']) ?></span>
                </div>
                
                <!-- Contact Button -->
                <div class="ml-0 md:ml-auto">
                    <?php if (!empty($seller['shop_phone'])): ?>
                    <a href="tel:<?php echo htmlspecialchars($seller['shop_phone']); ?>" 
                       class="flex items-center text-sm bg-shopee-500 hover:bg-shopee-600 transition text-white px-4 py-1.5 rounded">
                        <i class="fa-solid fa-phone mr-2"></i>
                        <span>Contact Seller</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar with Filters -->
            <div class="w-full lg:w-64 flex-shrink-0">
                <!-- Mobile toggle for filters -->
                <div class="lg:hidden mb-4">
                    <button type="button" 
                            class="w-full flex items-center justify-between bg-white p-3 rounded-md shadow-sm"
                            onclick="document.getElementById('mobile-filters').classList.toggle('hidden')">
                        <span class="font-medium">Filters & Search</span>
                        <i class="fa-solid fa-filter text-shopee-500"></i>
                    </button>
                </div>

                <div id="mobile-filters" class="hidden lg:block space-y-4">
                    <!-- Search Box -->
                    <div class="bg-white rounded-md shadow-sm overflow-hidden">
                        <div class="bg-gray-50 py-3 px-4 border-b border-gray-200">
                            <h3 class="font-medium text-gray-800">Search Products</h3>
                        </div>
                        <div class="p-4">
                            <form action="" method="GET">
                                <input type="hidden" name="id" value="<?php echo $seller_id; ?>">
                                <?php if ($category_id): ?>
                                    <input type="hidden" name="category" value="<?php echo $category_id; ?>">
                                <?php endif; ?>
                                <div class="flex">
                                    <input type="text" 
                                           class="w-full border border-gray-300 rounded-l-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-shopee-500 focus:border-shopee-500" 
                                           name="search" 
                                           placeholder="Search products" 
                                           value="<?php echo htmlspecialchars($search); ?>">
                                    <button class="bg-shopee-500 hover:bg-shopee-600 transition text-white px-3 py-2 rounded-r-md" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="bg-white rounded-md shadow-sm overflow-hidden">
                        <div class="bg-gray-50 py-3 px-4 border-b border-gray-200">
                            <h3 class="font-medium text-gray-800">Categories</h3>
                        </div>
                        <div class="p-1">
                            <a href="shop.php?id=<?php echo $seller_id; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo !empty($sort_by) && $sort_by != 'newest' ? '&sort_by=' . $sort_by : ''; ?>" 
                               class="flex items-center p-3 rounded-md hover:bg-gray-50 transition <?php echo $category_id == 0 ? 'bg-shopee-50 text-shopee-500 font-medium' : 'text-gray-700' ?>">
                                <i class="fa-solid fa-border-all w-5 text-center"></i>
                                <span class="ml-2">All Categories</span>
                                <span class="ml-auto text-sm text-gray-500"><?= $total_products ?></span>
                            </a>
                            
                            <?php mysqli_data_seek($categories_result, 0); // Reset the pointer ?>
                            <?php while($category = mysqli_fetch_assoc($categories_result)): ?>
                                <a href="shop.php?id=<?php echo $seller_id; ?>&category=<?php echo $category['id']; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo !empty($sort_by) && $sort_by != 'newest' ? '&sort_by=' . $sort_by : ''; ?>" 
                                   class="flex items-center p-3 rounded-md hover:bg-gray-50 transition <?php echo $category_id == $category['id'] ? 'bg-shopee-50 text-shopee-500 font-medium' : 'text-gray-700' ?>">
                                    <i class="fa-solid fa-folder w-5 text-center"></i>
                                    <span class="ml-2"><?php echo htmlspecialchars($category['name']); ?></span>
                                    <span class="ml-auto text-sm text-gray-500"><?php echo $category['product_count']; ?></span>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    
                    <!-- Sort By -->
                    <div class="bg-white rounded-md shadow-sm overflow-hidden">
                        <div class="bg-gray-50 py-3 px-4 border-b border-gray-200">
                            <h3 class="font-medium text-gray-800">Sort By</h3>
                        </div>
                        <div class="p-1">
                            <a href="shop.php?id=<?php echo $seller_id; ?><?php echo $category_id ? '&category=' . $category_id : ''; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                               class="flex items-center p-3 rounded-md hover:bg-gray-50 transition <?php echo $sort_by == 'newest' || empty($sort_by) ? 'bg-shopee-50 text-shopee-500 font-medium' : 'text-gray-700' ?>">
                                <i class="fa-solid fa-clock w-5 text-center"></i>
                                <span class="ml-2">Newest</span>
                            </a>
                            
                            <a href="shop.php?id=<?php echo $seller_id; ?><?php echo $category_id ? '&category=' . $category_id : ''; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>&sort_by=price_low_to_high" 
                               class="flex items-center p-3 rounded-md hover:bg-gray-50 transition <?php echo $sort_by == 'price_low_to_high' ? 'bg-shopee-50 text-shopee-500 font-medium' : 'text-gray-700' ?>">
                                <i class="fa-solid fa-arrow-down-wide-short w-5 text-center"></i>
                                <span class="ml-2">Price: Low to High</span>
                            </a>
                            
                            <a href="shop.php?id=<?php echo $seller_id; ?><?php echo $category_id ? '&category=' . $category_id : ''; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>&sort_by=price_high_to_low" 
                               class="flex items-center p-3 rounded-md hover:bg-gray-50 transition <?php echo $sort_by == 'price_high_to_low' ? 'bg-shopee-50 text-shopee-500 font-medium' : 'text-gray-700' ?>">
                                <i class="fa-solid fa-arrow-up-wide-short w-5 text-center"></i>
                                <span class="ml-2">Price: High to Low</span>
                            </a>
                            
                        </div>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="bg-white rounded-md shadow-sm overflow-hidden">
                        <div class="bg-gray-50 py-3 px-4 border-b border-gray-200">
                            <h3 class="font-medium text-gray-800">Contact Info</h3>
                        </div>
                        <div class="p-4 space-y-4">
                            <?php if (!empty($seller['shop_address'])): ?>
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 uppercase mb-2">Address</h4>
                                    <p class="text-sm text-gray-700"><?php echo nl2br(htmlspecialchars($seller['shop_address'])); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($seller['shop_phone'])): ?>
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 uppercase mb-2">Phone</h4>
                                    <p class="text-sm text-gray-700"><?php echo htmlspecialchars($seller['shop_phone']); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($seller['email'])): ?>
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 uppercase mb-2">Email</h4>
                                    <p class="text-sm text-gray-700 break-words"><?php echo htmlspecialchars($seller['email']); ?></p>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Keep the secondary Chat Button in sidebar for additional visibility -->
                            <?php if (isset($user_id) && $user_id > 0): ?>
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 uppercase mb-2">Chat</h4>
                                    <button type="button"
                                       class="shop-chat-button w-full flex items-center justify-center text-sm bg-blue-500 hover:bg-blue-600 transition text-white px-4 py-2 rounded"
                                       data-seller-id="<?= $seller_id ?>" 
                                       data-seller-name="<?= htmlspecialchars($seller['full_name']) ?>">
                                        <i class="fa-solid fa-comments mr-2"></i>
                                        <span>Start Conversation</span>
                                    </button>
                                </div>
                            <?php elseif (!isset($user_id) || $user_id <= 0): ?>
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 uppercase mb-2">Chat</h4>
                                    <a href="/users/login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" 
                                       class="w-full flex items-center justify-center text-sm bg-gray-200 hover:bg-gray-300 transition text-gray-700 px-4 py-2 rounded">
                                        <i class="fa-solid fa-lock mr-2"></i>
                                        <span>Login to Chat</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <?php if (!empty($seller['facebook_url']) || !empty($seller['instagram_url']) || !empty($seller['twitter_url']) || !empty($seller['google_url']) || !empty($seller['youtube_url'])): ?>
                        <div class="bg-white rounded-md shadow-sm overflow-hidden">
                            <div class="bg-gray-50 py-3 px-4 border-b border-gray-200">
                                <h3 class="font-medium text-gray-800">Follow Us</h3>
                            </div>
                            <div class="p-4">
                                <div class="flex gap-2">
                                    <?php if (!empty($seller['facebook_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($seller['facebook_url']); ?>" target="_blank" 
                                           class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center hover:opacity-90 transition">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($seller['instagram_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($seller['instagram_url']); ?>" target="_blank"
                                           class="w-9 h-9 rounded-full bg-gradient-to-r from-purple-500 via-pink-500 to-yellow-500 text-white flex items-center justify-center hover:opacity-90 transition">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($seller['twitter_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($seller['twitter_url']); ?>" target="_blank"
                                           class="w-9 h-9 rounded-full bg-sky-500 text-white flex items-center justify-center hover:opacity-90 transition">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($seller['google_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($seller['google_url']); ?>" target="_blank"
                                           class="w-9 h-9 rounded-full bg-red-500 text-white flex items-center justify-center hover:opacity-90 transition">
                                            <i class="fa-brands fa-google"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($seller['youtube_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($seller['youtube_url']); ?>" target="_blank"
                                           class="w-9 h-9 rounded-full bg-red-600 text-white flex items-center justify-center hover:opacity-90 transition">
                                            <i class="fa-brands fa-youtube"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Products Area -->
            <div class="flex-1">
                <!-- Results Header -->
                <div class="bg-white p-4 rounded-md shadow-sm mb-4">
                    <h3 class="text-lg font-medium text-gray-800">
                        <?php if (!empty($search) || $category_id > 0): ?>
                            <span class="text-shopee-500 font-bold"><?php echo $total_products; ?></span> Results 
                            <?php if (!empty($search)): ?>
                                for "<span class="text-shopee-500"><?php echo htmlspecialchars($search); ?></span>"
                            <?php endif; ?>
                            <?php if ($category_id > 0):
                                $cat_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM categories WHERE id = $category_id"))['name'];
                            ?>
                                in <span class="text-shopee-500"><?php echo htmlspecialchars($cat_name); ?></span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-shopee-500 font-bold"><?php echo $total_products; ?></span> Products Available
                        <?php endif; ?>
                    </h3>
                </div>

                <!-- Products Grid -->
                <?php if (mysqli_num_rows($products_result) > 0): ?>
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <?php 
                        while ($product = mysqli_fetch_assoc($products_result)):
                            $product_image = $product['thumbnail_image'] ? "/public/uploads/all/" . $product['thumbnail_image'] : "/public/assets/img/placeholder.jpg";
                            
                            // Calculate prices
                            $original_price = $product['unit_price'];
                            $discount_amount = !empty($product['discount']) ? $product['discount'] : 0;
                            $current_price = $original_price - $discount_amount;
                            
                            // Calculate discount percentage
                            $discount_percent = 0;
                            if ($discount_amount > 0 && $original_price > 0) {
                                $discount_percent = round(($discount_amount / $original_price) * 100);
                            }
                        ?>
                            <div class="bg-white rounded-md shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                                <!-- Product Image with Discount Badge -->
                                <div class="relative pt-[100%] overflow-hidden">
                                    <a href="/product/<?= $product['id'] ?>">
                                        <img 
                                            src="<?= $product_image ?>" 
                                            alt="<?= htmlspecialchars($product['name']) ?>" 
                                            class="absolute top-0 left-0 w-full h-full object-cover transition hover:scale-105"
                                            onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">
                                    </a>
                                    <?php if($discount_amount > 0): ?>
                                    <div class="absolute top-0 right-0 bg-shopee-500 text-white px-2 py-1 text-xs font-medium">
                                        -<?= $discount_percent ?>%
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
                                    
                                    <!-- Category Name -->
                                    <div class="text-xs text-gray-500 mb-2">
                                        <span>Category: </span>
                                        <a href="/category/<?= $product['category_id'] ?>" class="text-shopee-500 hover:underline">
                                            <?= htmlspecialchars($product['category_name'] ?? '') ?>
                                        </a>
                                    </div>
                                    
                                    <!-- Price -->
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-shopee-500 font-medium">
                                                $<?= number_format($current_price) ?>
                                            </span>
                                            
                                            <?php if($discount_amount > 0): ?>
                                            <span class="block text-xs text-gray-400 line-through">
                                                $<?= number_format($original_price) ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <a href="/product/<?= $product['id'] ?>" 
                                           class="text-xs bg-shopee-50 hover:bg-shopee-100 text-shopee-500 px-2 py-1 rounded transition">
                                            <i class="fa-solid fa-eye mr-1"></i>View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <!-- No Products -->
                    <div class="bg-white rounded-md shadow-sm p-10 text-center">
                        <img src="/public/assets/img/empty-box.png" alt="No products" class="w-24 h-24 mx-auto mb-4 opacity-50">
                        <h3 class="text-lg font-medium text-gray-800 mb-2">No Products Found</h3>
                        <p class="text-gray-500 mb-4">We couldn't find any products matching your criteria.</p>
                        <a href="shop.php?id=<?= $seller_id ?>" class="inline-block bg-shopee-500 hover:bg-shopee-600 text-white font-medium py-2 px-4 rounded-md transition">
                            View All Products
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <div class="mt-6 flex justify-center">
                        <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <?php if($page > 1): ?>
                            <a href="shop.php?id=<?= $seller_id ?><?= $category_id ? '&category='.$category_id : '' ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= !empty($sort_by) && $sort_by != 'newest' ? '&sort_by='.$sort_by : '' ?>&page=<?= $page-1 ?>" 
                               class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fa-solid fa-angle-left text-xs"></i>
                            </a>
                            <?php endif; ?>
                            
                            <?php
                            $start_page = max(1, min($page - 2, $total_pages - 4));
                            $end_page = min($total_pages, max($page + 2, 5));
                            
                            if ($start_page > 1): ?>
                                <a href="shop.php?id=<?= $seller_id ?><?= $category_id ? '&category='.$category_id : '' ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= !empty($sort_by) && $sort_by != 'newest' ? '&sort_by='.$sort_by : '' ?>&page=1" 
                                   class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    1
                                </a>
                                <?php if ($start_page > 2): ?>
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                        ...
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <a href="shop.php?id=<?= $seller_id ?><?= $category_id ? '&category='.$category_id : '' ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= !empty($sort_by) && $sort_by != 'newest' ? '&sort_by='.$sort_by : '' ?>&page=<?= $i ?>" 
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
                                <a href="shop.php?id=<?= $seller_id ?><?= $category_id ? '&category='.$category_id : '' ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= !empty($sort_by) && $sort_by != 'newest' ? '&sort_by='.$sort_by : '' ?>&page=<?= $total_pages ?>" 
                                   class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <?= $total_pages ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if($page < $total_pages): ?>
                            <a href="shop.php?id=<?= $seller_id ?><?= $category_id ? '&category='.$category_id : '' ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= !empty($sort_by) && $sort_by != 'newest' ? '&sort_by='.$sort_by : '' ?>&page=<?= $page+1 ?>" 
                               class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fa-solid fa-angle-right text-xs"></i>
                            </a>
                            <?php endif; ?>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Add Chat Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize shop chat buttons
    const chatButtons = document.querySelectorAll('.shop-chat-button');
    if (chatButtons.length > 0) {
        chatButtons.forEach(button => {
            button.addEventListener('click', function() {
                const sellerId = this.getAttribute('data-seller-id');
                const sellerName = this.getAttribute('data-seller-name');
                
                if (window.startChat && typeof window.startChat === 'function') {
                    window.startChat(sellerId, sellerName);
                } else {
                    console.error('Chat functionality not available');
                }
            });
        });
    }
});
</script>

<?php require_once(__DIR__ . '/layout/footer.php'); ?>