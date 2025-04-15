<?php
require_once(__DIR__ . "/../layout/header.php");

// Get product details with all necessary information - important to get unit_price directly
$product_query = "SELECT p.*,  
                  c.name as category_name,
                  c.path as category_path,
                  b.name as brand_name,
                  s.full_name as seller_name, 
                  s.id as seller_id,
                  s.shop_logo,
                  p.unit_price, -- Get unit_price directly, not as a calculation
                  (SELECT COALESCE(SUM(quantity), 0) FROM detail_orders WHERE name = p.name) as sold_count
           FROM products p
           LEFT JOIN sellers s ON p.seller_id = s.id
           LEFT JOIN categories c ON p.category_id = c.id
           LEFT JOIN brands b ON p.brand_id = b.id
           WHERE p.id = '{$p['id']}'";

$product_result = mysqli_query($conn, $product_query);
if ($product_result && mysqli_num_rows($product_result) > 0) {
    $product = mysqli_fetch_assoc($product_result);
} else {
    $product = $p; // Fallback to original data if query fails
}

// Calculate discount and final price - Make sure to convert to integers explicitly
$discount_percent = 0;
$original_price = (int)($product['unit_price'] ?? 0);
$final_price = $original_price;

if (!empty($product['discount']) && $product['discount'] > 0) {
    $discount_percent = (int)($product['discount']);
    // Calculate final price by subtracting the discount amount from the original price
    $final_price = $original_price - $discount_percent;
}

// Get seller information
$seller = null;
if ($product['seller_id']) {
    $seller_query = "SELECT id, full_name, shop_logo, create_date, rating,
                    (SELECT COUNT(*) FROM products WHERE seller_id = s.id AND published = 1) as product_count
                    FROM sellers s 
                    WHERE id = '{$product['seller_id']}'";
    $seller = fetch_array($seller_query);
}

// Get gallery images - now using the new JSON field structure
$gallery_images = [];
if (!empty($product['gallery_images'])) {
    // Try to decode the JSON
    $gallery_array = json_decode($product['gallery_images'], true);

    if (is_array($gallery_array)) {
        foreach ($gallery_array as $img_name) {
            if (!empty($img_name)) {
                $gallery_images[] = ['src' => $img_name];
            }
        }
    }
    // If not JSON (legacy support), try comma separated
    else if (is_string($product['gallery_images'])) {
        $gallery_ids = explode(',', $product['gallery_images']);
        foreach ($gallery_ids as $img_name) {
            if (!empty($img_name)) {
                $gallery_images[] = ['src' => $img_name];
            }
        }
    }
}

// If no gallery images, use thumbnail
if (empty($gallery_images) && !empty($product['thumbnail_image'])) {
    $gallery_images[] = ['src' => $product['thumbnail_image']];
}

// Default image if no images available
$default_img = "/public/assets/img/placeholder.jpg";
$thumbnail_img = !empty($product['thumbnail_image']) ? "/public/uploads/all/" . $product['thumbnail_image'] : $default_img;

// Check if product is in stock
$in_stock = isset($product['quantity']) && $product['quantity'] > 0;

// Check if user is logged in
$isLogged = isset($user_id) && $user_id > 0;

// Get product reviews
// Escape product name to prevent SQL injection and syntax errors
$escaped_product_name = mysqli_real_escape_string($conn, $product['name']);
$escaped_product_id = mysqli_real_escape_string($conn, $product['id']);

$reviews_query = "SELECT r.*, u.full_name as user_name,
                    CONCAT(SUBSTRING(u.full_name, 1, 1), '.jpg') as avatar,
                    COUNT(d.id) as purchase_count
                  FROM product_reviews r
                  LEFT JOIN users u ON r.user_id = u.id
                  LEFT JOIN detail_orders d ON d.user_id = r.user_id AND d.name = '{$escaped_product_name}'
                  WHERE r.product_id = '{$escaped_product_id}' AND r.status = 'approved'
                  GROUP BY r.id
                  ORDER BY r.created_at DESC
                  LIMIT 5";

$reviews_result = mysqli_query($conn, $reviews_query);
$reviews = [];

if ($reviews_result) {
    while ($review = mysqli_fetch_assoc($reviews_result)) {
        $reviews[] = $review;
    }
}

// Get review statistics
$review_stats_query = "SELECT 
                        COUNT(*) as total_reviews,
                        AVG(rating) as avg_rating,
                        SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
                        SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
                        SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
                        SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
                        SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star
                      FROM product_reviews 
                      WHERE product_id = '{$product['id']}' AND status = 'approved'";

$review_stats_result = mysqli_query($conn, $review_stats_query);
$review_stats = mysqli_fetch_assoc($review_stats_result) ?? [
    'total_reviews' => 0,
    'avg_rating' => 0,
    'five_star' => 0,
    'four_star' => 0,
    'three_star' => 0,
    'two_star' => 0,
    'one_star' => 0
];

// Fix for number_format - ensure that avg_rating is not null
$avg_rating = number_format($review_stats['avg_rating'] ?? 0, 1);
$total_reviews = $review_stats['total_reviews'] ?? 0;

// Check if user has purchased this product
$can_review = false;
$has_reviewed = false;
$unreviewedOrders = [];
$pendingOrders = [];

if ($isLogged) {
    // Escape the product name to prevent SQL injection
    $escaped_product_name = mysqli_real_escape_string($conn, $product['name']);
    
    // Get all orders that include this product - using product name
    $purchases_query = "SELECT d.id as detail_id, d.order_id, o.code as order_code,
                           d.quantity as purchase_quantity, d.price, o.delivery_status, o.create_date,
                           (SELECT COUNT(*) FROM product_reviews WHERE detail_order_id = d.id) as review_count
                        FROM detail_orders d 
                        JOIN orders o ON d.order_id = o.id
                        WHERE d.user_id = $user_id 
                        AND d.name = '{$escaped_product_name}'
                        ORDER BY o.create_date DESC";
    
    $purchases_result = mysqli_query($conn, $purchases_query);

    // If the query returns no results, use a more lenient approach
    if (!$purchases_result || mysqli_num_rows($purchases_result) == 0) {
        // Fallback method - try using LIKE query for partial name match
        $purchases_query = "SELECT d.id as detail_id, d.order_id, o.code as order_code,
                           d.quantity as purchase_quantity, d.price, o.delivery_status, o.create_date,
                           (SELECT COUNT(*) FROM product_reviews WHERE detail_order_id = d.id) as review_count
                        FROM detail_orders d 
                        JOIN orders o ON d.order_id = o.id
                        WHERE d.user_id = $user_id 
                        AND d.name LIKE '%".substr($escaped_product_name, 0, 30)."%'
                        ORDER BY o.create_date DESC";
        
        $purchases_result = mysqli_query($conn, $purchases_query);
    }

    if ($purchases_result && mysqli_num_rows($purchases_result) > 0) {
        // Count total purchases and already reviewed
        $total_purchased = 0;
        $total_reviewed = 0;
        $total_pending = 0;

        while ($purchase = mysqli_fetch_assoc($purchases_result)) {
            $total_purchased++;
            $total_reviewed += intval($purchase['review_count']);
            
            // Store unreviewed delivered orders for review
            if ($purchase['review_count'] == 0 && $purchase['delivery_status'] == 'Delivered') {
                $unreviewedOrders[] = [
                    'detail_id' => $purchase['detail_id'],
                    'order_id' => $purchase['order_id'],
                    'order_code' => $purchase['order_code'],
                    'date' => date('d M Y', strtotime($purchase['create_date'])),
                    'price' => $purchase['price'],
                    'quantity' => $purchase['purchase_quantity']
                ];
            }
            
            // Store pending orders
            if ($purchase['delivery_status'] != 'Delivered' && $purchase['delivery_status'] != 'Cancelled') {
                $total_pending++;
                $pendingOrders[] = [
                    'order_code' => $purchase['order_code'],
                    'date' => date('d M Y', strtotime($purchase['create_date'])),
                    'status' => $purchase['delivery_status']
                ];
            }
        }

        // User can review if they have unreviewed orders
        $can_review = !empty($unreviewedOrders);
        
        // User has reviewed if they have purchases but no unreviewed orders
        $has_reviewed = ($total_purchased > 0 && empty($unreviewedOrders) && empty($pendingOrders));
    }
}

// Get related products
$related_products_query = "SELECT p.*, 
                          f.src as image_src, 
                          s.full_name as seller_name, 
                          s.id as seller_id,
                          p.unit_price + p.rose + p.profit as price,
                          (SELECT COALESCE(SUM(quantity), 0) FROM detail_orders WHERE name = p.name) as sold_count
                     FROM products p
                     LEFT JOIN file f ON p.thumbnail_image = f.id
                     LEFT JOIN sellers s ON p.seller_id = s.id
                     WHERE p.category_id = '{$product['category_id']}' 
                     AND p.id != '{$product['id']}'
                     AND p.published = 1 
                     AND p.seller_id IS NOT NULL
                     ORDER BY sold_count DESC, p.create_date DESC
                     LIMIT 6";
$related_products_result = mysqli_query($conn, $related_products_query);
$related_products = [];

if ($related_products_result) {
    while ($related = mysqli_fetch_assoc($related_products_result)) {
        // Calculate discount for related products
        $discount_percent = 0;
        $original_price = $related['unit_price'] ?? 0;
        $final_price = $related['unit_price'] ?? 0;

        if (!empty($related['discount']) && $related['discount'] > 0) {
            $discount_percent = $related['discount'];
            $final_price = $original_price - $discount_percent;
        }

        $related_products[] = $related;
    }
}

// Helper functions
function getSellerLogo($logo)
{
    if (!empty($logo)) {
        return "/public/uploads/" . $logo;
    }
    return "/public/assets/img/placeholder.jpg";
}

function renderStars($rating)
{
    $rating = min(5, max(0, $rating));
    $full_stars = floor($rating);
    $half_star = $rating - $full_stars >= 0.5;
    $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);

    $html = '';
    for ($i = 0; $i < $full_stars; $i++) {
        $html .= '<i class="fas fa-star"></i>';
    }
    if ($half_star) {
        $html .= '<i class="fas fa-star-half-alt"></i>';
    }
    for ($i = 0; $i < $empty_stars; $i++) {
        $html .= '<i class="far fa-star"></i>';
    }
    return $html;
}

function formatDate($date)
{
    if (!$date) return 'N/A';
    return date('M Y', strtotime($date));
}
?>

<style>
    /* Shopee UI Color Variables */
    :root {
        --shopee-orange: #ee4d2d;
        --shopee-orange-light: #f6422e;
        --shopee-orange-dark: #d73211;
        --shopee-yellow: #faca51;
        --shopee-light-bg: #fff9f8;
        --shopee-gray: #f5f5f5;
    }

    /* Utility Classes */
    .text-shopee-orange { color: var(--shopee-orange) !important; }
    .bg-shopee-orange { background-color: var(--shopee-orange) !important; }
    .hover\:bg-shopee-orange-dark:hover { background-color: var(--shopee-orange-dark) !important; }
    .border-shopee-orange { border-color: var(--shopee-orange) !important; }
    .text-shopee-yellow { color: var(--shopee-yellow) !important; }
    .bg-shopee-light { background-color: var(--shopee-light-bg) !important; }
    .bg-shopee-gray { background-color: var(--shopee-gray) !important; }

    /* Rating stars */
    .shopee-rating { color: var(--shopee-yellow); }

    /* Button Styles */
    .btn-shopee {
        background-color: var(--shopee-orange);
        color: white;
        transition: all 0.2s;
        border-radius: 2px;
        font-weight: 500;
    }
    .btn-shopee:hover {
        background-color: var(--shopee-orange-dark);
    }
    .btn-shopee-outline {
        border: 1px solid var(--shopee-orange);
        color: var(--shopee-orange);
        transition: all 0.2s;
        border-radius: 2px;
    }
    .btn-shopee-outline:hover {
        background-color: rgba(238, 77, 45, 0.1);
    }

    /* Rating Progress Bar */
    .rating-progress {
        height: 6px;
        background-color: #efefef;
        border-radius: 10px;
        overflow: hidden;
    }
    .rating-progress-bar {
        height: 100%;
        background-color: var(--shopee-yellow);
    }

    /* Product Card */
    .product-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Gallery Thumbnails */
    .gallery-thumbnail {
        border: 1px solid #e0e0e0;
        transition: all 0.2s;
        cursor: pointer;
    }
    .gallery-thumbnail.active {
        border-color: var(--shopee-orange);
    }
    .gallery-thumbnail:hover {
        border-color: var(--shopee-orange);
    }

    /* Flash Badge */
    .flash-badge {
        background-color: var(--shopee-orange);
        color: white;
        font-weight: 500;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 2px;
        display: inline-block;
    }

    /* Form Controls */
    .form-control-shopee {
        border: 1px solid #e0e0e0;
        border-radius: 2px;
        padding: 0.5rem 0.75rem;
        transition: border 0.2s;
    }
    .form-control-shopee:focus {
        border-color: var(--shopee-orange);
        box-shadow: none;
        outline: none;
    }

    /* Quantity Selector */
    .quantity-selector {
        display: flex;
        border: 1px solid #e0e0e0;
        border-radius: 2px;
        overflow: hidden;
    }
    .quantity-selector button {
        width: 32px;
        height: 32px;
        background-color: #fff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #757575;
        font-size: 1rem;
        transition: background-color 0.2s;
    }
    .quantity-selector button:hover {
        background-color: #f5f5f5;
    }
    .quantity-selector input {
        width: 50px;
        height: 32px;
        border: none;
        border-left: 1px solid #e0e0e0;
        border-right: 1px solid #e0e0e0;
        text-align: center;
    }
</style>

<div class="bg-shopee-gray min-h-screen pb-6">
    <!-- Main Content -->
    <div class="max-w-screen-xl mx-auto px-2 sm:px-4 py-3">
        <!-- Meta tags for SEO -->
        <meta name="user-id" content="<?= $isLogged ? $chatUserId : '' ?>">
<meta name="user-type" content="<?= $chatUserType ?>">
<meta name="user-name" content="<?= $chatUserName ?>">
        <meta name="description" content="<?= $product['meta_description'] ?? htmlspecialchars($product['name']) . ' - Shop now at Takashimaya' ?>">
        <meta name="keywords" content="<?= $product['tags'] ?? '' ?>, <?= $product['brand_name'] ?? '' ?>, <?= $product['category_name'] ?? '' ?>">
        <meta property="og:title" content="<?= htmlspecialchars($product['name']) ?>">
        <meta property="og:description" content="<?= $product['meta_description'] ?? htmlspecialchars($product['name']) . ' - Shop now at Takashimaya' ?>">
        <meta property="og:image" content="<?= $thumbnail_img ?>">
        <meta property="og:url" content="<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
        <meta property="og:type" content="product">
        <meta property="product:price:amount" content="<?= $product['unit_price'] - ($product['discount'] ?? 0) ?>">
        <meta property="product:price:currency" content="USD">
        <meta property="product:availability" content="<?= $in_stock ? 'in stock' : 'out of stock' ?>">
        
        <!-- Breadcrumb -->
        <div class="text-xs text-gray-500 mb-3 bg-white p-3 rounded shadow-sm">
            <a href="/" class="hover:text-shopee-orange">Home</a> &gt;
            <a href="/category/<?= $product['category_path'] ?? '' ?>" class="hover:text-shopee-orange"><?= $product['category_name'] ?? 'Uncategorized' ?></a>
            <?php if ($seller): ?> &gt;
                <a href="/shop.php?id=<?= $seller['id'] ?>" class="hover:text-shopee-orange"><?= htmlspecialchars($seller['full_name']) ?></a>
            <?php endif; ?> &gt;
            <span class="text-gray-700"><?= $product['name'] ?></span>
        </div>

        <!-- Product Section -->
        <div class="bg-white rounded-sm shadow-sm mb-3">
            <div class="flex flex-col md:flex-row p-4">
                <!-- Left: Product Images -->
                <div class="md:w-[40%] pr-0 md:pr-6">
                    <!-- Main Image -->
                    <div class="border border-gray-100 mb-2 relative rounded-sm overflow-hidden product-image-container">
                        <div class="aspect-square overflow-hidden">
                            <img id="main-product-image" src="<?= $thumbnail_img ?>" alt="<?= $product['name'] ?>" class="w-full h-full object-contain">
                        </div>
                        <?php if (!$in_stock): ?>
                            <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                <div class="bg-black/70 text-white px-4 py-2 font-bold">OUT OF STOCK</div>
                            </div>
                        <?php endif; ?>
                        <?php if ($discount_percent > 0): ?>
                            <div class="absolute top-2 right-2">
                                <div class="flash-badge">-<?= ceil(($product['discount'] / $product['unit_price']) * 100) ?>%</div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Thumbnails -->
                    <?php if (!empty($gallery_images)): ?>
                        <div class="flex space-x-2 overflow-x-auto py-1">
                            <?php foreach ($gallery_images as $index => $img): ?>
                                <div class="w-16 h-16 gallery-thumbnail <?= $index === 0 ? 'active' : '' ?>"
                                    data-src="/public/uploads/all/<?= $img['src'] ?>">
                                    <img src="/public/uploads/all/<?= $img['src'] ?>" alt="" class="w-full h-full object-cover">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Social Share -->
                    <div class="flex items-center mt-6 space-x-3 text-sm text-gray-500 border-t border-gray-100 pt-3">
                        <span>Share:</span>
                        <div class="flex space-x-2">
                            <a href="#" class="w-8 h-8 rounded-full bg-[#3b5998] text-white flex items-center justify-center hover:opacity-90">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-[#E60023] text-white flex items-center justify-center hover:opacity-90">
                                <i class="fab fa-pinterest"></i>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:opacity-90">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Product Details -->
                <div class="md:w-[60%] mt-6 md:mt-0">
                    <div class="flex items-center space-x-2">
                        <?php if ($discount_percent > 0): ?>
                            <span class="flash-badge">SALE</span>
                        <?php endif; ?>
                        <span class="inline-block bg-[#D0011B] text-white text-xs px-2 py-1 rounded-sm">HOT</span>
                        <?php if ($product['type_product'] === 'digital'): ?>
                            <span class="inline-block bg-[#1877F2] text-white text-xs px-2 py-1 rounded-sm">DIGITAL</span>
                        <?php endif; ?>
                    </div>

                    <h1 class="text-xl font-normal mb-2 mt-2 product-title"><?= $product['name'] ?></h1>

                    <!-- Ratings and Sold Count -->
                    <div class="flex flex-wrap items-center mb-3 text-sm">
                        <div class="flex items-center">
                            <span class="text-shopee-orange font-medium mr-1"><?= number_format($avg_rating, 1) ?></span>
                            <div class="flex shopee-rating text-sm mr-2">
                                <?= renderStars($avg_rating) ?>
                            </div>
                        </div>
                        <div class="mx-2 h-4 w-[1px] bg-gray-300"></div>
                        <div>
                            <span class="text-gray-500"><?= $total_reviews ?> Ratings</span>
                        </div>
                        <div class="mx-2 h-4 w-[1px] bg-gray-300"></div>
                        <div>
                            <span class="font-medium"><?= $product['sold_count'] ?> Sold</span>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="bg-shopee-light p-4 rounded-sm mb-4">
                        <?php if (!empty($product['discount']) && $product['discount'] > 0): ?>
                            <div class="flex items-center">
                                <div class="text-gray-500 line-through text-sm" id="product-original-price">$<?= number_format($product['unit_price'], 0, '.', ',') ?></div>
                            </div>
                            <div class="flex items-end mt-1">
                                <div class="text-shopee-orange text-3xl font-medium product-price" id="product-final-price">$<?= number_format($product['unit_price'] - $product['discount'], 0, '.', ',') ?></div>
                                <div class="ml-3 flash-badge" id="product-discount-percent">
                                    <?= ceil(($product['discount'] / $product['unit_price']) * 100) ?>% OFF
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-shopee-orange text-3xl font-medium product-price" id="product-final-price">$<?= number_format($product['unit_price'], 0, '.', ',') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Details -->
                    <div class="border-b border-gray-100 pb-4 mb-4">
                        <!-- Deal -->
                        <?php if ($discount_percent > 0): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">Deal</div>
                                <div class="flex items-center">
                                    <span class="flash-badge">Save $<?= number_format($product['discount'] ?? 0, 0, '.', ',') ?></span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Unit -->
                        <?php if (!empty($product['unit'])): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">Unit</div>
                                <div><?= htmlspecialchars($product['unit']) ?></div>
                            </div>
                        <?php endif; ?>

                        <!-- Weight -->
                        <?php if (!empty($product['weight'])): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">Weight</div>
                                <div><?= htmlspecialchars($product['weight']) ?> kg</div>
                            </div>
                        <?php endif; ?>

                        <!-- Minimum quantity -->
                        <?php if (!empty($product['minimum_quantity']) && $product['minimum_quantity'] > 1): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">Min. Order</div>
                                <div><?= htmlspecialchars($product['minimum_quantity']) ?> units</div>
                            </div>
                        <?php endif; ?>

                        <!-- Barcode -->
                        <?php if (!empty($product['barcode'])): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">Barcode</div>
                                <div><?= htmlspecialchars($product['barcode']) ?></div>
                            </div>
                        <?php endif; ?>

                        <!-- Tags -->
                        <?php if (!empty($product['tags'])): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">Tags</div>
                                <div class="flex flex-wrap gap-1">
                                    <?php foreach (explode(',', $product['tags']) as $tag): ?>
                                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-sm"><?= htmlspecialchars(trim($tag)) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Type -->
                        <?php if (!empty($product['type_product'])): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">Type</div>
                                <div class="capitalize"><?= htmlspecialchars($product['type_product']) ?></div>
                            </div>
                        <?php endif; ?>

                        <!-- SKU -->
                        <?php if (!empty($product['sku'])): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">SKU</div>
                                <div><?= htmlspecialchars($product['sku']) ?></div>
                            </div>
                        <?php endif; ?>

                        <!-- Brand -->
                        <?php if (!empty($product['brand_name'])): ?>
                            <div class="flex mb-3">
                                <div class="w-28 text-gray-500">Brand</div>
                                <div><?= htmlspecialchars($product['brand_name']) ?></div>
                            </div>
                        <?php endif; ?>

                        <!-- Delivery -->
                        <div class="flex mb-3">
                            <div class="w-28 text-gray-500">Delivery</div>
                            <div>
                                <div class="flex items-center">
                                    <i class="fas fa-truck text-shopee-orange mr-2"></i>
                                    <span>Free Shipping</span>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">Ships from <?= $seller ? htmlspecialchars($seller['full_name']) : 'Warehouse' ?></div>
                            </div>
                        </div>
                    </div>

                    <?php if ($in_stock): ?>
                        <form id="option-choice-form">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="seller" value="<?= $product['seller_id'] ?>">
                            <input type="hidden" name="price" value="<?= $product['unit_price'] - ($product['discount'] ?? 0) ?>">
                            <input type="hidden" name="original_price" value="<?= $product['unit_price'] ?>">
                            <input type="hidden" name="discount" value="<?= $product['discount'] ?? 0 ?>">

                            <!-- Quantity -->
                            <div class="flex flex-wrap items-center mb-6">
                                <div class="w-28 text-gray-500">Quantity</div>
                                <div class="flex items-center">
                                    <div class="quantity-selector">
                                        <button type="button" id="quantity-minus" class="text-lg">-</button>
                                        <input type="text" name="quantity" class="shopee-input" value="1" min="1" max="<?= $product['quantity'] ?>">
                                        <button type="button" id="quantity-plus" class="text-lg">+</button>
                                    </div>
                                    <div class="ml-3 text-gray-500 text-sm"><?= $product['quantity'] ?> pieces available</div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-wrap gap-3 mt-6">
                                <button type="button" onclick="addToCart()" class="px-5 py-3 btn-shopee-outline flex items-center flex-1 justify-center">
                                    <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                                </button>
                                <button type="button" onclick="buyNow()" class="px-5 py-3 btn-shopee flex-1 flex items-center justify-center">
                                    Buy Now
                                </button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-red-500 font-medium bg-red-50 p-4 rounded-sm text-center">This product is currently out of stock.</div>
                    <?php endif; ?>

                    <!-- Shopee Guarantee -->
                    <div class="flex items-center mt-6 pt-3 border-t border-gray-100">
                        <img src="/public/assets/img/guarantee.webp" alt=" Guarantee" class="h-5 mr-2">
                        <span class="text-xs text-gray-500"> Guarantee: Get the item you ordered or get your money back.</span>
                    </div>

                    <!-- Shop Info -->
                    <?php if ($seller): ?>
                        <div class="border-t border-gray-200 mt-6 pt-4">
                            <div class="flex items-center">
                                <img src="<?= getSellerLogo($seller['shop_logo']) ?>" alt="<?= htmlspecialchars($seller['full_name']) ?>" class="w-12 h-12 rounded-full border object-cover">
                                <div class="ml-3 flex-1">
                                    <h3 class="font-medium"><?= htmlspecialchars($seller['full_name']) ?></h3>
                                    <div class="flex items-center text-xs text-gray-500 mt-1">
                                        <span>Active 5 minutes ago</span>
                                        <span class="mx-1">•</span>
                                        <span>Since <?= formatDate($seller['create_date']) ?></span>
                                    </div>
                                </div>
                                <div class="hidden md:block">
                                    <a href="/shop.php?id=<?= $seller['id'] ?>" class="px-4 py-1.5 btn-shopee-outline inline-block">
                                        View Shop
                                    </a>
                                </div>
                            </div>

                            <!-- Shop stats -->
                            <div class="grid grid-cols-3 gap-4 mt-4 text-center text-xs">
                                <div class="p-2 border border-gray-100 rounded-sm hover:border-shopee-orange transition-colors">
                                    <div class="text-gray-500 mb-1">Products</div>
                                    <div class="font-medium"><?= $seller['product_count'] ?? 0 ?></div>
                                </div>
                                <div class="p-2 border border-gray-100 rounded-sm hover:border-shopee-orange transition-colors">
                                    <div class="text-gray-500 mb-1">Rating</div>
                                    <div class="font-medium flex justify-center shopee-rating">
                                        <?= renderStars($seller['rating'] ?? 0) ?>
                                    </div>
                                </div>
                                <div class="p-2 border border-gray-100 rounded-sm hover:border-shopee-orange transition-colors">
                                    <div class="text-gray-500 mb-1">Response</div>
                                    <div class="font-medium"><?= $seller['response_rate'] ?? '98%' ?></div>
                                </div>
                            </div>

                            <div class="flex mt-3 space-x-3">
                                <?php if ($isLogged): ?>
                                    <button class="shop-chat-button flex-1 py-2 border border-gray-300 rounded-sm text-center hover:bg-gray-50 text-gray-700 text-sm"
                                        data-seller-id="<?= $seller['id'] ?>"
                                        data-seller-name="<?= htmlspecialchars($seller['full_name']) ?>">
                                        <i class="far fa-comment-dots mr-1"></i> Chat Now
                                    </button>
                                <?php else: ?>
                                    <a href="/users/login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="flex-1 py-2 border border-gray-300 rounded-sm text-center hover:bg-gray-50 text-gray-700 text-sm">
                                        <i class="far fa-comment-dots mr-1"></i> Login to Chat
                                    </a>
                                <?php endif; ?>
                                <a href="/shop.php?id=<?= $seller['id'] ?>" class="flex-1 py-2 border border-gray-300 rounded-sm text-center hover:bg-gray-50 text-gray-700 text-sm md:hidden">
                                    <i class="fas fa-store-alt mr-1"></i> View Shop
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Product Description Section -->
        <div class="bg-white rounded-sm shadow-sm p-4 mb-3">
            <h2 class="text-xl font-medium mb-4 text-shopee-orange border-b border-gray-100 pb-2">Product Description</h2>
            <div class="product-description text-gray-800">
                <?= $product['description'] ?>
            </div>
        </div>

        <!-- Product Ratings Section -->
        <div class="bg-white rounded-sm shadow-sm p-4 mb-3" id="product-reviews">
            <h2 class="text-xl font-medium pb-3 mb-4 text-shopee-orange border-b border-gray-100">Ratings & Reviews</h2>

            <div class="flex flex-col md:flex-row gap-6">
                <!-- Rating summary -->
                <div class="md:w-1/3 flex flex-col items-center justify-center p-4 md:border-r border-gray-100">
                    <div class="text-3xl font-medium text-shopee-orange mb-1"><?= $avg_rating ?><span class="text-sm text-gray-500">/5</span></div>
                    <div class="flex shopee-rating justify-center text-xl mb-4">
                        <?= renderStars($avg_rating) ?>
                    </div>
                    <div class="text-sm text-gray-500"><?= $total_reviews ?> ratings</div>

                    <!-- Rating distribution -->
                    <?php if ($total_reviews > 0): ?>
                        <div class="w-full mt-4">
                            <?php
                            $star_ratings = [
                                5 => $review_stats['five_star'] ?? 0,
                                4 => $review_stats['four_star'] ?? 0,
                                3 => $review_stats['three_star'] ?? 0,
                                2 => $review_stats['two_star'] ?? 0,
                                1 => $review_stats['one_star'] ?? 0
                            ];

                            foreach ($star_ratings as $stars => $count):
                                $percent = $total_reviews > 0 ? ($count / $total_reviews) * 100 : 0;
                            ?>
                                <div class="flex items-center mb-1">
                                    <div class="w-10 text-xs text-gray-500"><?= $stars ?> <i class="fas fa-star text-shopee-yellow"></i></div>
                                    <div class="flex-1 mx-2">
                                        <div class="rating-progress">
                                            <div class="rating-progress-bar" style="width: <?= $percent ?>%"></div>
                                        </div>
                                    </div>
                                    <div class="w-8 text-xs text-gray-500"><?= $count ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($can_review && !empty($unreviewedOrders)): ?>
                        <div class="mt-4 w-full">
                            <button type="button" onclick="showReviewForm()" class="w-full py-2 btn-shopee">
                                Write a Review (<?= count($unreviewedOrders) ?> order<?= count($unreviewedOrders) > 1 ? 's' : '' ?> to review)
                            </button>
                        </div>
                    <?php elseif (!empty($pendingOrders)): ?>
                        <div class="mt-4 w-full">
                            <div class="w-full py-2 bg-blue-100 text-blue-700 rounded-sm text-center">
                                You have <?= count($pendingOrders) ?> pending order<?= count($pendingOrders) > 1 ? 's' : '' ?> that will be available for review once delivered
                            </div>
                        </div>
                    <?php elseif ($has_reviewed): ?>
                        <div class="mt-4 w-full">
                            <div class="w-full py-2 bg-gray-100 text-gray-600 rounded-sm text-center">
                                You've reviewed all your purchases
                            </div>
                        </div>
                    <?php elseif ($isLogged && empty($unreviewedOrders) && empty($pendingOrders)): ?>
                        <div class="mt-4 w-full">
                            <div class="w-full py-2 bg-yellow-100 text-yellow-700 rounded-sm text-center">
                                Please purchase this product to leave a review
                            </div>
                        </div>
                    <?php elseif (!$isLogged): ?>
                        <div class="mt-4 w-full">
                            <a href="/users/login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="block text-center w-full py-2 bg-gray-200 text-gray-700 rounded-sm hover:bg-gray-300">
                                Login to Review
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Review list -->
                <div class="md:w-2/3">
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="review-card">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 rounded-full mr-3 bg-gray-200 flex items-center justify-center overflow-hidden">
                                        <span class="text-gray-500 font-bold text-lg"><?= substr($review['user_name'] ?? 'U', 0, 1) ?></span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <div class="font-medium"><?= htmlspecialchars($review['user_name'] ?? 'Anonymous') ?></div>
                                            <div class="text-xs text-gray-500">
                                                <?= date('d M Y', strtotime($review['created_at'] ?? 'now')) ?>
                                            </div>
                                        </div>
                                        <div class="flex shopee-rating text-xs my-1">
                                            <?= renderStars($review['rating'] ?? 0) ?>
                                        </div>
                                        <div class="text-xs text-gray-500 mb-2">
                                            Order: #<?= $review['order_id'] ?? '-' ?> • Purchased <?= $review['purchase_count'] ?? 0 ?> time(s)
                                        </div>
                                        <div class="text-sm"><?= nl2br(htmlspecialchars($review['comment'] ?? '')) ?></div>

                                        <?php if (!empty($review['images'])): ?>
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                <?php
                                                $images = explode(',', $review['images']);
                                                foreach ($images as $img): ?>
                                                    <div class="w-16 h-16 border border-gray-200 rounded-sm overflow-hidden gallery-thumbnail">
                                                        <img src="/public/uploads/reviews/<?= $img ?>" alt="Review image" class="w-full h-full object-cover cursor-pointer" onclick="showImageModal(this.src)">
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if ($total_reviews > count($reviews)): ?>
                            <div class="text-center mt-4">
                                <a href="/product-reviews.php?id=<?= $product['id'] ?>" class="px-5 py-2 btn-shopee-outline inline-block">
                                    See All Reviews (<?= $total_reviews ?>)
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="py-6 text-center text-gray-500">
                            <div class="text-5xl shopee-rating mb-2">
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="mb-4">No reviews yet for this product</p>
                            <?php if ($can_review && !empty($unreviewedOrders)): ?>
                                <button onclick="showReviewForm()" class="px-4 py-2 btn-shopee-outline">
                                    Be the first to review
                                </button>
                            <?php elseif (!$isLogged): ?>
                                <a href="/users/login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-sm text-sm hover:bg-gray-50">
                                    Login to review this product
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Review Form Modal -->
        <?php if ($can_review && !empty($unreviewedOrders)): ?>
            <div id="review-modal" class="fixed inset-0 z-50 hidden">
                <div class="absolute inset-0 bg-black/50" onclick="hideReviewForm()"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-xl p-3">
                    <div class="bg-white rounded-sm shadow-xl">
                        <div class="flex items-center justify-between px-6 py-4 border-b">
                            <h3 class="font-medium text-lg">Write Your Review</h3>
                            <button type="button" onclick="hideReviewForm()" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <div class="p-6">
                            <form id="review-form" action="/submit-review.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                                <!-- Order selection dropdown if multiple unreviewed orders -->
                                <?php if (count($unreviewedOrders) > 1): ?>
                                    <div class="mb-4">
                                        <label for="order-select" class="block text-gray-700 mb-2">Select Order to Review</label>
                                        <select id="order-select" class="w-full px-3 py-2 form-control-shopee" onchange="updateOrderDetails()">
                                            <?php foreach ($unreviewedOrders as $index => $order): ?>
                                                <option value="<?= $index ?>"
                                                    data-order-id="<?= $order['order_id'] ?>"
                                                    data-detail-id="<?= $order['detail_id'] ?>"
                                                    data-order-code="<?= $order['order_code'] ?>"
                                                    data-date="<?= $order['date'] ?>"
                                                    data-price="<?= $order['price'] ?>"
                                                    data-quantity="<?= $order['quantity'] ?>">
                                                    Order #<?= $order['order_code'] ?> (<?= $order['date'] ?>) - <?= $order['quantity'] ?> item(s)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php endif; ?>

                                <input type="hidden" name="order_id" id="order_id" value="<?= $unreviewedOrders[0]['order_id'] ?>">
                                <input type="hidden" name="detail_order_id" id="detail_order_id" value="<?= $unreviewedOrders[0]['detail_id'] ?>">

                                <!-- Order details -->
                                <div class="mb-4 p-3 bg-gray-50 rounded-sm">
                                    <div class="text-sm">
                                        <div><strong>Order:</strong> <span id="order-code">#<?= $unreviewedOrders[0]['order_code'] ?></span></div>
                                        <div><strong>Purchased:</strong> <span id="order-date"><?= $unreviewedOrders[0]['date'] ?></span></div>
                                        <div><strong>Quantity:</strong> <span id="order-quantity"><?= $unreviewedOrders[0]['quantity'] ?></span> units</div>
                                    </div>
                                </div>

                                <!-- Rating stars -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 mb-2">Your Rating</label>
                                    <div class="flex space-x-2 text-2xl review-stars">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="far fa-star cursor-pointer hover:text-shopee-orange" data-rating="<?= $i ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <input type="hidden" name="rating" id="rating-input" value="0">
                                </div>

                                <!-- Review comment -->
                                <div class="mb-4">
                                    <label for="review-comment" class="block text-gray-700 mb-2">Your Review</label>
                                    <textarea id="review-comment" name="comment" rows="4" class="w-full px-3 py-2 form-control-shopee" placeholder="Share your experience with this product..."></textarea>
                                </div>

                                <!-- Image upload -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 mb-2">Upload Photos (Optional)</label>
                                    <div class="border-dashed border-2 border-gray-300 p-4 text-center rounded-sm hover:border-shopee-orange transition-colors">
                                        <input type="file" name="review_images[]" id="review-images" class="hidden" multiple accept="image/*">
                                        <label for="review-images" class="cursor-pointer">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                            <p class="mt-2 text-sm text-gray-600">Click to upload images</p>
                                        </label>
                                        <div id="image-preview" class="flex flex-wrap gap-2 mt-2"></div>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="flex justify-end">
                                    <button type="button" onclick="hideReviewForm()" class="px-4 py-2 border border-gray-300 rounded-sm text-sm mr-2 hover:bg-gray-50">Cancel</button>
                                    <button type="submit" class="px-4 py-2 btn-shopee text-sm">Submit Review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Image Viewer Modal -->
        <div id="image-modal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black/80" onclick="hideImageModal()"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 max-w-3xl w-full p-4">
                <button type="button" onclick="hideImageModal()" class="absolute top-4 right-4 text-white text-2xl z-10">
                    <i class="fas fa-times"></i>
                </button>
                <img id="modal-image" src="" alt="Review image" class="max-w-full max-h-[80vh] mx-auto">
            </div>
        </div>

        <!-- Success/Error Message Toast -->
        <div id="toast-message" class="fixed top-4 right-4 z-50 hidden">
            <div id="toast-content" class="bg-white shadow-lg rounded-sm p-4 max-w-md border-l-4"></div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gallery thumbnails functionality
        const thumbItems = document.querySelectorAll('[data-src]');
        const mainImage = document.getElementById('main-product-image');

        thumbItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all thumbnails
                thumbItems.forEach(thumb => thumb.classList.remove('border-shopee-orange'));

                // Add active class to clicked thumbnail
                this.classList.add('border-shopee-orange');

                // Update main image
                mainImage.src = this.getAttribute('data-src');
            });
        });

        // Quantity buttons functionality
        const qtyInput = document.querySelector('input[name="quantity"]');
        const minusBtn = document.getElementById('quantity-minus');
        const plusBtn = document.getElementById('quantity-plus');

        if (minusBtn && plusBtn && qtyInput) {
            minusBtn.addEventListener('click', function() {
                const currentValue = parseInt(qtyInput.value);
                if (currentValue > parseInt(qtyInput.min)) {
                    qtyInput.value = currentValue - 1;
                }
            });

            plusBtn.addEventListener('click', function() {
                const currentValue = parseInt(qtyInput.value);
                if (currentValue < parseInt(qtyInput.max)) {
                    qtyInput.value = currentValue + 1;
                }
            });
        }

        // Show toast message if present in URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            showToast(urlParams.get('success'), 'success');
        } else if (urlParams.has('error')) {
            showToast(urlParams.get('error'), 'error');
        }

        // Review stars functionality
        const stars = document.querySelectorAll('.review-stars i');
        const ratingInput = document.getElementById('rating-input');

        if (stars && ratingInput) {
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    ratingInput.value = rating;

                    // Update stars display
                    stars.forEach(s => {
                        const starRating = parseInt(s.getAttribute('data-rating'));
                        if (starRating <= rating) {
                            s.classList.remove('far');
                            s.classList.add('fas', 'text-shopee-yellow');
                        } else {
                            s.classList.remove('fas', 'text-shopee-yellow');
                            s.classList.add('far');
                        }
                    });
                });

                // Hover effects
                star.addEventListener('mouseover', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));

                    stars.forEach(s => {
                        const starRating = parseInt(s.getAttribute('data-rating'));
                        if (starRating <= rating) {
                            s.classList.add('text-shopee-yellow');
                        }
                    });
                });

                star.addEventListener('mouseout', function() {
                    const currentRating = parseInt(ratingInput.value);

                    stars.forEach(s => {
                        const starRating = parseInt(s.getAttribute('data-rating'));
                        if (starRating > currentRating) {
                            s.classList.remove('text-shopee-yellow');
                        }
                    });
                });
            });
        }

        // Image preview functionality
        const imageInput = document.getElementById('review-images');
        const imagePreview = document.getElementById('image-preview');

        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function() {
                imagePreview.innerHTML = '';

                if (this.files) {
                    Array.from(this.files).forEach(file => {
                        if (!file.type.match('image.*')) {
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imgWrap = document.createElement('div');
                            imgWrap.className = 'relative w-16 h-16';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-full h-full object-cover border border-gray-200 rounded';
                            imgWrap.appendChild(img);

                            imagePreview.appendChild(imgWrap);
                        };

                        reader.readAsDataURL(file);
                    });
                }
            });
        }

        // Form validation
        const reviewForm = document.getElementById('review-form');

        if (reviewForm) {
            reviewForm.addEventListener('submit', function(e) {
                const rating = ratingInput.value;
                const comment = document.getElementById('review-comment').value;

                if (rating === '0') {
                    e.preventDefault();
                    showToast('Please select a star rating', 'error');
                } else if (comment.trim() === '') {
                    e.preventDefault();
                    showToast('Please write a review comment', 'error');
                }
            });
        }

        // Function to update order details in review form
        window.updateOrderDetails = function() {
            const selectElement = document.getElementById('order-select');
            if (selectElement) {
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                const orderId = selectedOption.getAttribute('data-order-id');
                const detailId = selectedOption.getAttribute('data-detail-id');
                const orderCode = selectedOption.getAttribute('data-order-code');
                const orderDate = selectedOption.getAttribute('data-date');
                const quantity = selectedOption.getAttribute('data-quantity');

                document.getElementById('order_id').value = orderId;
                document.getElementById('detail_order_id').value = detailId;
                document.getElementById('order-code').textContent = '#' + orderCode;
                document.getElementById('order-date').textContent = orderDate;
                document.getElementById('order-quantity').textContent = quantity;
            }
        }

    });

    // Add to cart function
    function addToCart() {
        const form = document.getElementById('option-choice-form');
        if (!form) {
            console.error("Form not found");
            alert('Error: Could not find the product form.');
            return;
        }
        const formData = new FormData(form);
        // Ensure required fields are included
        const id = formData.get('id');
        const seller = formData.get('seller');
        const quantity = formData.get('quantity');
        if (!id || !seller || !quantity) {
            console.error("Required fields missing", {
                id,
                seller,
                quantity
            });
            alert('Error: Missing required product information.');
            return;
        }
        // Log the data being sent (for debugging)
        console.log("Sending data:", {
            id: formData.get('id'),
            seller: formData.get('seller'),
            quantity: formData.get('quantity'),
            price: formData.get('price'),
            original_price: formData.get('original_price'),
            discount: formData.get('discount')
        });
        // Send AJAX request to add item to cart
        fetch('/add-to-cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success message
                    alert('Product added to cart!');
                    // Update cart count in the header if needed
                    if (data.cartCount && document.querySelector('.cart-count')) {
                        document.querySelector('.cart-count').textContent = data.cartCount;
                    }
                } else {
                    // Show error message
                    alert(data.message || 'Failed to add product to cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the product to cart. Please try again.');
            });
    }

    // Buy now function
    function buyNow() {
        // First add to cart
        const form = document.getElementById('option-choice-form');
        if (!form) {
            alert('Error: Could not find the product form.');
            return;
        }
        const formData = new FormData(form);
        // Ensure the required fields
        if (!formData.get('id') || !formData.get('seller') || !formData.get('quantity')) {
            alert('Error: Missing required product information.');
            return;
        }
        fetch('/add-to-cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Redirect to checkout page
                    window.location.href = '/checkout';
                } else {
                    alert(data.message || 'Failed to add product to cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your request. Please try again.');
            });
    }

    function showLoginModal() {
        $('#loginModal').modal('show');
    }

    function addToWishList(id) {
        // Implement wishlist functionality
        alert('Product added to wishlist!');
    }

    function addToCompare(id) {
        // Implement compare functionality
        alert('Product added to compare!');
    }

    function showReviewForm() {
        const reviewModal = document.getElementById('review-modal');
        if (reviewModal) {
            reviewModal.classList.remove('hidden');
        }
    }

    function hideReviewForm() {
        const reviewModal = document.getElementById('review-modal');
        if (reviewModal) {
            reviewModal.classList.add('hidden');
        }
    }

    function showImageModal(src) {
        const modal = document.getElementById('image-modal');
        const modalImage = document.getElementById('modal-image');
        if (modal && modalImage) {
            modalImage.src = src;
            modal.classList.remove('hidden');
        }
    }

    function hideImageModal() {
        const modal = document.getElementById('image-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast-message');
        const toastContent = document.getElementById('toast-content');

        if (toast && toastContent) {
            toastContent.innerHTML = message;

            if (type === 'success') {
                toastContent.className = 'bg-white shadow-lg rounded-lg p-4 max-w-md border-l-4 border-green-500';
            } else if (type === 'error') {
                toastContent.className = 'bg-white shadow-lg rounded-lg p-4 max-w-md border-l-4 border-red-500';
            }

            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 5000);
        }
    }
</script>

<?php
require_once("../layout/footer.php");
?>