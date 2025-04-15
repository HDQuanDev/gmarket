<?php
require_once("layout/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/markdown.php');

// Get all slides from directory
$slides = [];
$slides_directory = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/slides/';

// Check if directory exists
if (is_dir($slides_directory)) {
    // Get all files from slides directory
    $files = scandir($slides_directory);

    // Filter only image files
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    foreach ($files as $file) {
        // Skip . and .. directories
        if ($file === '.' || $file === '..') {
            continue;
        }

        // Get file extension
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        // Check if file is an image
        if (in_array($extension, $allowed_extensions)) {
            $slides[] = "/public/uploads/slides/" . $file;
        }
    }
}

// If no slides found, use default slides
if (empty($slides)) {
    $slides = [
        "/public/uploads/slide1.png",
        "/public/uploads/slide2.png",
        "/public/uploads/slide3.png",
        "/public/uploads/slide4.png"
    ];
}

// Categories with product count
$categories_query = "SELECT c.*, 
                    (SELECT COUNT(*) FROM products WHERE category_id = c.id) as product_count
                    FROM categories c 
                    WHERE c.img IS NOT NULL
                    ORDER BY product_count DESC 
                    LIMIT 10";
$categories_result = mysqli_query($conn, $categories_query);

// Check if we have any categories
if (!$categories_result || mysqli_num_rows($categories_result) == 0) {
    // No categories found, use sample data instead
    $categories_result = [
        ['id' => 1, 'name' => 'Electronics', 'img' => 'electronics.png', 'path' => 'electronics'],
        ['id' => 2, 'name' => 'Fashion', 'img' => 'fashion.png', 'path' => 'fashion'],
        ['id' => 3, 'name' => 'Home & Living', 'img' => 'home.png', 'path' => 'home-living'],
        ['id' => 4, 'name' => 'Beauty', 'img' => 'beauty.png', 'path' => 'beauty'],
        ['id' => 5, 'name' => 'Sports', 'img' => 'sports.png', 'path' => 'sports'],
        ['id' => 6, 'name' => 'Toys', 'img' => 'toys.png', 'path' => 'toys'],
        ['id' => 7, 'name' => 'Books', 'img' => 'books.png', 'path' => 'books'],
        ['id' => 8, 'name' => 'Automotive', 'img' => 'automotive.png', 'path' => 'automotive']
    ];
} else {
    $categories = [];
    while ($row = mysqli_fetch_assoc($categories_result)) {
        $categories[] = $row;
    }
    $categories_result = $categories;
}

// Featured brands
$brands_query = "SELECT b.* 
                 FROM brands b
                 ORDER BY b.id DESC 
                 LIMIT 6";
$brands_result = mysqli_query($conn, $brands_query);
$brands = [];
while ($row = mysqli_fetch_assoc($brands_result)) {
    $brands[] = $row;
}
$brands_result = $brands;

// Flash sale products - UPDATED to filter by active sellers
$flash_sale_query = "SELECT p.*, f.src as image_src,
                     b.name as brand_name,
                     s.full_name, s.rating as seller_rating,
                     (SELECT COALESCE(SUM(quantity), 0) 
                      FROM detail_orders 
                      WHERE name = p.name) as sold_count
                     FROM products p 
                     LEFT JOIN file f ON p.thumbnail_image = f.id
                     LEFT JOIN brands b ON p.brand_id = b.id
                     LEFT JOIN sellers s ON p.seller_id = s.id
                     WHERE p.published = 1 
                     AND p.discount > 0
                     AND p.seller_id IS NOT NULL
                     AND p.quantity > 0
                     AND s.status = 'active'
                     ORDER BY sold_count DESC, p.discount DESC
                     LIMIT 12";
$flash_sale_result = mysqli_query($conn, $flash_sale_query);
$flash_sale_products = [];
while ($row = mysqli_fetch_assoc($flash_sale_result)) {
    $flash_sale_products[] = $row;
}
$flash_sale_result = $flash_sale_products;

// Top sellers with real metrics
$top_sellers_query = "SELECT s.*, 
                      f.src as logo_src,
                      COUNT(DISTINCT p.id) as product_count,
                      SUM(do.quantity) as total_quantity_sold,
                      AVG(s.rating) as avg_rating
                      FROM sellers s
                      LEFT JOIN file f ON s.shop_logo = f.id
                      LEFT JOIN products p ON s.id = p.seller_id AND p.published = 1
                      LEFT JOIN detail_orders do ON p.name = do.name
                      WHERE s.status = 'active'
                      GROUP BY s.id
                      HAVING product_count > 0
                      ORDER BY total_quantity_sold DESC, avg_rating DESC
                      LIMIT 6";
$top_sellers_result = mysqli_query($conn, $top_sellers_query);

// Recommended products - UPDATED to filter by active sellers
$recommended_query = "SELECT p.*, 
                     f.src as image_src,
                     b.name as brand_name,
                     s.shop_name, 
                     s.rating as seller_rating,
                     COUNT(DISTINCT do.id) as total_sales
                     FROM products p 
                     LEFT JOIN file f ON p.thumbnail_image = f.id
                     LEFT JOIN brands b ON p.brand_id = b.id
                     LEFT JOIN sellers s ON p.seller_id = s.id
                     LEFT JOIN detail_orders do ON p.name = do.name
                     WHERE p.published = 1
                     AND p.quantity > 0
                     AND p.seller_id IS NOT NULL
                     AND s.status = 'active'
                     GROUP BY p.id
                     ORDER BY total_sales DESC, p.create_date DESC
                     LIMIT 12";
$recommended_result = mysqli_query($conn, $recommended_query);

// Replace currency symbol if needed
$currency_symbol = '$';  // Change this based on your needs

// Get blog posts marked for homepage display
$homepage_posts_query = mysqli_query($conn, "SELECT id, title, thumbnail, author, created_at, content, views FROM blog_posts WHERE show_on_homepage = 1 ORDER BY created_at DESC LIMIT 4");
$homepage_posts = [];
while ($row = mysqli_fetch_assoc($homepage_posts_query)) {
    $homepage_posts[] = $row;
}

?>

<!-- Full-width Main Hero Section with Side Banners -->
<div class="w-full max-w-full px-0">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-3">
        <!-- Main Slider - 9 columns on large screens -->
        <div class="lg:col-span-12">
            <div class="relative h-[280px] lg:h-[430px] overflow-hidden rounded-lg">
                <div class="aiz-carousel dots-inside-bottom h-full" data-arrows="true" data-dots="true"
                    data-autoplay="true" data-infinite="true">
                    <?php foreach ($slides as $slide): ?>
                        <div class="carousel-box h-full">
                            <a href="/" class="block h-full">
                                <div class="relative h-full overflow-hidden">
                                    <img style="object-fit: cover;" class="w-full h-full object-fill transform hover:scale-105 transition-transform duration-700 ease-out"
                                        src="<?= $slide ?>" alt="Takashimaya promo" loading="lazy"
                                        onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Custom Navigation Arrows -->
                <button
                    class="absolute left-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 hover:bg-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 z-10 group">
                    <i class="fa fa-angle-left text-2xl text-gray-600 group-hover:text-orange-500"></i>
                </button>
                <button
                    class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 hover:bg-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 z-10 group">
                    <i class="fa fa-angle-right text-2xl text-gray-600 group-hover:text-orange-500"></i>
                </button>

                <!-- Custom Dots -->
                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5">
                    <?php for ($i = 0; $i < count($slides); $i++): ?>
                        <button
                            class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-200"></button>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Flash Sale Banner with Gradient Blur Effect - Responsive Version -->
<div
    class="container mx-auto px-4 md:px-8 lg:px-12 xl:px-[280px] -mt-6 md:-mt-8 lg:-mt-12 relative z-10 animate__animated animate__fadeInUp">
    <div
        class="rounded-xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 relative">
        <!-- Transparent background with gradient -->
        <div
            class="absolute inset-0 bg-gradient-to-r from-blue-600/80 via-purple-500/80 to-orange-500/80 backdrop-blur-sm">
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 items-center relative">
            <!-- Glass morphism layer with decreased opacity for better transparency -->
            <div class="absolute inset-0 bg-white/10 backdrop-blur-[2px]"></div>

            <!-- Decorative elements with reduced opacity so content behind can be seen -->
            <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none hidden md:block">
                <div class="absolute top-1/4 left-1/4 w-16 h-16 rounded-full bg-white"></div>
                <div class="absolute top-3/4 left-2/3 w-8 h-8 rounded-full bg-white"></div>
                <div class="absolute top-1/2 left-1/6 w-12 h-12 rounded-full bg-white"></div>
            </div>

            <!-- Flash Sale Title Section - Full width on mobile -->
            <div class="lg:col-span-2 text-center py-4 px-2 md:px-4 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 -mr-12 -mt-12 rounded-full hidden md:block">
                </div>
                <div class="relative">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 rounded-full bg-gradient-to-br from-yellow-400/90 to-orange-500/90 text-white mb-2 md:mb-3 shadow-lg animate-pulse">
                        <i class="fa fa-bolt text-2xl md:text-4xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-white">Flash Sale</h3>
                    <div class="w-8 md:w-12 h-1 bg-yellow-300 mx-auto mt-1 md:mt-2 rounded-full"></div>
                </div>
            </div>

            <!-- Countdown Timer Section - Stack vertically on mobile -->
            <div class="lg:col-span-8 py-3 md:py-4 lg:py-4 relative">
                <div class="flex flex-wrap justify-center gap-2 sm:gap-4 md:gap-6">
                    <div class="flex flex-col items-center">
                        <div
                            class="countdown-box bg-white/20 backdrop-blur-[3px] text-white rounded-xl p-2 md:p-4 text-center min-w-[60px] md:min-w-[80px] shadow-lg transform hover:scale-105 transition-all border border-white/30">
                            <div class="text-xl md:text-2xl lg:text-3xl font-bold countdown-hours">00</div>
                            <div class="text-[10px] md:text-xs uppercase tracking-wider mt-1">Giờ</div>
                        </div>
                    </div>
                    <div class="flex items-center text-white text-xl md:text-2xl font-light">:</div>
                    <div class="flex flex-col items-center">
                        <div
                            class="countdown-box bg-white/20 backdrop-blur-[3px] text-white rounded-xl p-2 md:p-4 text-center min-w-[60px] md:min-w-[80px] shadow-lg transform hover:scale-105 transition-all border border-white/30">
                            <div class="text-xl md:text-2xl lg:text-3xl font-bold countdown-minutes">00</div>
                            <div class="text-[10px] md:text-xs uppercase tracking-wider mt-1">Phút</div>
                        </div>
                    </div>
                    <div class="flex items-center text-white text-xl md:text-2xl font-light">:</div>
                    <div class="flex flex-col items-center">
                        <div
                            class="countdown-box bg-white/20 backdrop-blur-[3px] text-white rounded-xl p-2 md:p-4 text-center min-w-[60px] md:min-w-[80px] shadow-lg transform hover:scale-105 transition-all border border-white/30">
                            <div class="text-xl md:text-2xl lg:text-3xl font-bold countdown-seconds">46</div>
                            <div class="text-[10px] md:text-xs uppercase tracking-wider mt-1">Giây</div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2 md:mt-3">
                    <span class="text-white/90 text-xs sm:text-sm inline-flex items-center">
                        <i class="fa fa-fire text-orange-300 mr-1"></i> Chỉ <span class="font-bold mx-1">356</span> sản
                        phẩm được sale!
                    </span>
                </div>
            </div>
            <script>
                // Thiết lập thời gian kết thúc - 24 giờ từ thời điểm hiện tại
                const endTime = new Date();
                endTime.setHours(endTime.getHours() + 24);

                function updateCountdown() {
                    const now = new Date().getTime();
                    const distance = endTime - now;

                    if (distance < 0) {
                        // Đã hết thời gian
                        document.querySelectorAll('.countdown-hours').forEach(el => el.textContent = '00');
                        document.querySelectorAll('.countdown-minutes').forEach(el => el.textContent = '00');
                        document.querySelectorAll('.countdown-seconds').forEach(el => el.textContent = '00');
                        return;
                    }

                    // Tính toán giờ, phút, giây
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Cập nhật tất cả các phần tử hiển thị đếm ngược
                    document.querySelectorAll('.countdown-hours').forEach(el =>
                        el.textContent = hours.toString().padStart(2, '0')
                    );
                    document.querySelectorAll('.countdown-minutes').forEach(el =>
                        el.textContent = minutes.toString().padStart(2, '0')
                    );
                    document.querySelectorAll('.countdown-seconds').forEach(el =>
                        el.textContent = seconds.toString().padStart(2, '0')
                    );
                }

                // Cập nhật đồng hồ đếm ngược mỗi giây
                document.addEventListener('DOMContentLoaded', function () {
                    updateCountdown(); // Cập nhật ngay lập tức khi trang tải
                    setInterval(updateCountdown, 1000); // Sau đó cập nhật mỗi giây
                });
            </script>
            <!-- Shop Now Button Section - Center aligned on all screens -->
            <div class="lg:col-span-2 text-center py-3 md:py-4 lg:py-6 relative">
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/5 -ml-10 -mb-10 rounded-full hidden md:block">
                </div>
                <div class="relative">
                    <a href="#"
                        class="inline-block px-4 py-2 md:px-6 md:py-3 bg-white/80 hover:bg-white text-blue-600 font-medium rounded-full transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 group backdrop-blur-sm">
                        Shop Now
                        <i class="fa fa-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <div class="text-[10px] md:text-xs text-white/90 mt-1 md:mt-2">Ending soon!</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category & Brand Row - Enhanced Design -->

<div class="container mx-auto px-2 mt-2">
    <!-- Categories Section (Full Width) -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
        <!-- Header with simpler design -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-3 flex items-center justify-between">
            <h2 class="font-semibold text-white flex items-center gap-1.5">
                <i class="las la-crown text-yellow-300"></i>
                Premium Brands
            </h2>

        </div>

        <!-- Brands grid with compact styling -->
        <div class="p-3">
            <div class="main-carousel">
                <div data-flickity='{ "wrapAround": true, "autoPlay": false, "pageDots": false }'>
                <?php
                if (is_array($brands_result)):
                    foreach ($brands_result as $brand):
                        $brand_logo = $brand['logo'] ? "/public/uploads/all/" . $brand['logo'] : "/public/assets/img/placeholder.jpg";
                        ?>
                        <div class="carousel-cell w-full sm:w-1/3 px-1">
                            <a href="<?= $brand['path'] ?>" class="group" target="_blank">
                                <div class="flex flex-col items-center p-2 rounded hover:bg-blue-50 transition-all">
                                    <!-- Simplified logo presentation -->
                                    <div
                                        class="w-12 h-12 mb-2 rounded-full bg-gray-50 p-0.5 shadow-sm flex items-center justify-center">
                                        <img src="<?= $brand_logo ?>" alt="<?= $brand['name'] ?>"
                                            class="w-full h-full object-contain rounded-full">
                                    </div>

                                    <!-- Simplified brand name -->
                                    <h3
                                        class="text-xs font-medium text-gray-700 text-center group-hover:text-blue-600 line-clamp-1">
                                        <?= $brand['name'] ?>
                                    </h3>

                                    <!-- Mini verification badge -->
                                    <div class="mt-1 flex items-center gap-0.5">
                                        <svg class="w-2.5 h-2.5 text-blue-500" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z" />
                                        </svg>
                                        <span class="text-[10px] text-gray-500">Verified</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    endforeach;
                else:
                    mysqli_data_seek($brands_result, 0);
                    $count = 0;
                    while ($brand = mysqli_fetch_assoc($brands_result) && $count < 6):
                        $brand_logo = $brand['logo'] ? "/public/uploads/all/" . $brand['logo'] : "/public/assets/img/placeholder.jpg";
                        $count++;
                        ?>
                        <div class="carousel-cell w-full sm:w-1/3 px-1">
                            <a href="/brand/<?= $brand['path'] ?>" class="group">
                                <div class="flex flex-col items-center p-2 rounded hover:bg-blue-50 transition-all">
                                    <!-- Simplified logo presentation -->
                                    <div
                                        class="w-12 h-12 mb-2 rounded-full bg-gray-50 p-0.5 shadow-sm flex items-center justify-center">
                                        <img src="<?= $brand_logo ?>" alt="<?= $brand['name'] ?>"
                                            class="w-full h-full object-contain rounded-full">
                                    </div>

                                    <!-- Simplified brand name -->
                                    <h3
                                        class="text-xs font-medium text-gray-700 text-center group-hover:text-blue-600 line-clamp-1">
                                        <?= $brand['name'] ?>
                                    </h3>

                                    <!-- Mini verification badge -->
                                    <div class="mt-1 flex items-center gap-0.5">
                                        <svg class="w-2.5 h-2.5 text-blue-500" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z" />
                                        </svg>
                                        <span class="text-[10px] text-gray-500">Verified</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
        <!-- Header with enhanced styling -->
        <div class="bg-gradient-to-r from-rose-500 via-red-600 to-orange-500 p-4 relative overflow-hidden">
            <!-- Animated light effect -->
            <div class="absolute -left-10 top-0 w-20 h-full bg-white/20 skew-x-[-20deg] animate-shine"></div>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 relative z-10">
                <div class="flex items-center gap-4">
                    <div class="relative flex items-center">
                        <!-- Lightning bolt icon with animation -->
                        <svg class="w-10 h-10 text-yellow-300 filter drop-shadow-lg" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <div
                            class="absolute -top-1 -right-1 bg-yellow-300 text-red-600 rounded-full h-5 w-5 flex items-center justify-center animate-pulse shadow-lg">
                            🔥
                        </div>
                    </div>
                    <div>
                        <h2 class="text-white font-black text-2xl md:text-3xl text-shadow">FLASH SALE</h2>
                        <p class="text-white/80 text-xs md:text-sm">Grab amazing deals before they're gone!</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Enhanced countdown timer -->
                    <div class="flex items-center gap-1.5">
                        <div
                            class="bg-white rounded-md flex flex-col items-center px-3 py-1 shadow-lg transform hover:scale-105 transition-transform">
                            <span class="countdown-hours font-bold text-red-600 text-xl leading-tight">12</span>
                            <span class="text-gray-500 text-[10px] font-medium leading-tight">HOURS</span>
                        </div>
                        <span class="text-white font-bold text-xl">:</span>
                        <div
                            class="bg-white rounded-md flex flex-col items-center px-3 py-1 shadow-lg transform hover:scale-105 transition-transform">
                            <span class="countdown-minutes font-bold text-red-600 text-xl leading-tight">45</span>
                            <span class="text-gray-500 text-[10px] font-medium leading-tight">MINS</span>
                        </div>
                        <span class="text-white font-bold text-xl">:</span>
                        <div
                            class="bg-white rounded-md flex flex-col items-center px-3 py-1 shadow-lg transform hover:scale-105 transition-transform">
                            <span class="countdown-seconds font-bold text-red-600 text-xl leading-tight">30</span>
                            <span class="text-gray-500 text-[10px] font-medium leading-tight">SECS</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative elements -->
            <div
                class="absolute -bottom-3 left-0 w-full h-6 bg-[url('/public/assets/img/wave-pattern.svg')] bg-repeat-x opacity-40">
            </div>
        </div>

        <div class="p-4">
            <!-- Enhanced product grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <?php
                if (is_array($flash_sale_result)):
                    foreach ($flash_sale_result as $product):

                        $image_url = !empty($product['thumbnail_image']) ? "/public/uploads/all/" . $product['thumbnail_image'] : "/public/assets/img/placeholder.jpg";
                        $final_price = $product['unit_price'] - ($product['discount']);
                        $sold_percent = min(($product['sold_count'] / ($product['quantity'] > 0 ? $product['quantity'] : 1)) * 100, 100);
                        ?>
                        <div class="group">
                            <div
                                class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:border-orange-400 transition-all duration-300 hover:shadow-xl relative">
                                <!-- Product Image with enhanced animation -->
                                <div class="relative pt-[100%] overflow-hidden">
                                    <a href="/product/<?= $product['id'] ?>" class="absolute inset-0">
                                        <img src="<?= $image_url ?>" alt="<?= $product['name'] ?>"
                                            class="absolute inset-0 w-full h-full object-cover transition-all duration-500 group-hover:scale-110">

                                        <!-- Enhanced discount badge -->
                                        <div class="absolute -top-1 -right-1">
                                            <div
                                                class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold px-3 py-1.5 rounded-br-xl rounded-tl-xl shadow-md transform -rotate-3 group-hover:rotate-0 transition-transform duration-300">
                                                <?= ceil(($product['discount'] / $product['unit_price']) * 100) ?>% OFF
                                            </div>
                                        </div>

                                        <!-- Improved wishlist button -->
                                        <button
                                            class="absolute top-2 left-2 w-8 h-8 flex items-center justify-center bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-orange-50 shadow-md transform group-hover:scale-110"
                                            onclick="event.preventDefault(); addToWishlist(<?= $product['id'] ?>)">
                                            <i class="las la-heart text-lg text-gray-400 hover:text-red-500"></i>
                                        </button>

                                        <!-- Quick view overlay button -->
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <button
                                                class="bg-white/90 hover:bg-white text-gray-800 px-3 py-1.5 rounded-full font-medium text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-md">
                                                Quick View
                                            </button>
                                        </div>
                                    </a>
                                </div>

                                <!-- Enhanced Product Info -->
                                <div class="p-3 bg-white">
                                    <!-- Title -->
                                    <h3
                                        class="text-sm font-medium text-gray-800 line-clamp-2 min-h-[40px] group-hover:text-orange-500 transition-colors">
                                        <a href="/product/<?= $product['id'] ?>">
                                            <?= htmlspecialchars($product['name']) ?>
                                        </a>
                                    </h3>

                                    <!-- Enhanced pricing display -->
                                    <div class="mt-2 flex flex-wrap items-baseline gap-2">
                                        <span class="text-orange-500 font-bold text-base"
                                            id="product-final-price"><?= $currency_symbol . number_format($final_price) ?></span>
                                        <?php if ($product['discount'] > 0): ?>
                                            <span class="text-xs text-gray-400 line-through"
                                                id="product-final-price"><?= $currency_symbol . number_format($product['unit_price']) ?></span>
                                            <span class="text-xs bg-orange-50 text-orange-500 px-1.5 py-0.5 rounded-sm">Save
                                                <?= $currency_symbol . number_format($product['unit_price'] - $final_price) ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Enhanced progress bar -->
                                    <div class="mt-3">
                                        <div class="relative h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="absolute left-0 top-0 bottom-0 bg-gradient-to-r from-orange-500 to-red-500 rounded-full"
                                                style="width: <?= $sold_percent ?>%">
                                                <div
                                                    class="absolute top-0 left-0 w-full h-full bg-white/30 animate-pulse-light">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mt-1.5">
                                            <div class="flex items-center gap-1">
                                                <span class="text-xs text-orange-600 font-medium">Sold
                                                    <?= $product['sold_count'] ?></span>
                                            </div>
                                            <span class="text-xs text-gray-500">Only
                                                <?= $product['quantity'] - $product['sold_count'] ?> left</span>
                                        </div>
                                    </div>

                                    <div class="mt-2.5 flex items-center justify-between">
                                        <!-- Brand and rating -->
                                        <div>
                                            <?php if (!empty($product['brand_name'])): ?>
                                                <div class="flex items-center gap-1">
                                                    <span class="text-xs text-gray-500"><?= $product['brand_name'] ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Rating Stars -->
                                            <div class="flex items-center gap-1 mt-0.5">
                                                <div class="flex items-center">
                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                        <i
                                                            class="las la-star text-xs <?= $i < 4 ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="text-[10px] text-gray-500">(<?= rand(50, 500) ?>)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                else:
                    while ($product = mysqli_fetch_assoc($flash_sale_result)):
                        $image_url = $product['thumbnail_image'] ? "/public/uploads/all/" . $product['thumbnail_image'] : "/public/assets/img/placeholder.jpg";
                        $final_price = $product['unit_price'] - ($product['discount']);
                        $sold_percent = min(($product['sold_count'] / ($product['quantity'] > 0 ? $product['quantity'] : 1)) * 100, 100);
                        ?>
                        <div class="group">
                            <div
                                class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:border-orange-400 transition-all duration-300 hover:shadow-xl relative">
                                <!-- Product Image with enhanced animation -->
                                <div class="relative pt-[100%] overflow-hidden">
                                    <a href="/product/<?= $product['id'] ?>" class="absolute inset-0">
                                        <img src="<?= $image_url ?>" alt="<?= $product['name'] ?>"
                                            class="absolute inset-0 w-full h-full object-cover transition-all duration-500 group-hover:scale-110">

                                        <!-- Enhanced discount badge -->
                                        <div class="absolute -top-1 -right-1">
                                            <div
                                                class="bg-gradient-to-br from-red-500 to-red-600 text-white font-bold px-3 py-1.5 rounded-br-xl rounded-tl-xl shadow-md transform -rotate-3 group-hover:rotate-0 transition-transform duration-300">
                                                <?= $product['discount'] ?>% OFF
                                            </div>
                                        </div>

                                        <!-- Improved wishlist button -->
                                        <button
                                            class="absolute top-2 left-2 w-8 h-8 flex items-center justify-center bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-orange-50 shadow-md transform group-hover:scale-110"
                                            onclick="event.preventDefault(); addToWishlist(<?= $product['id'] ?>)">
                                            <i class="las la-heart text-lg text-gray-400 hover:text-red-500"></i>
                                        </button>

                                        <!-- Quick view overlay button -->
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <button
                                                class="bg-white/90 hover:bg-white text-gray-800 px-3 py-1.5 rounded-full font-medium text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-md">
                                                Quick View
                                            </button>
                                        </div>
                                    </a>
                                </div>

                                <!-- Enhanced Product Info -->
                                <div class="p-3 bg-white">
                                    <!-- Title -->
                                    <h3
                                        class="text-sm font-medium text-gray-800 line-clamp-2 min-h-[40px] group-hover:text-orange-500 transition-colors">
                                        <a href="/product/<?= $product['id'] ?>">
                                            <?= htmlspecialchars($product['name']) ?>
                                        </a>
                                    </h3>

                                    <!-- Enhanced pricing display -->
                                    <div class="mt-2 flex flex-wrap items-baseline gap-2">
                                        <span
                                            class="text-orange-500 font-bold text-base"><?= $currency_symbol . number_format($final_price, 2) ?></span>
                                        <?php if ($product['discount'] > 0): ?>
                                            <span
                                                class="text-xs text-gray-400 line-through"><?= $currency_symbol . number_format($product['unit_price'], 2) ?></span>
                                            <span class="text-xs bg-orange-50 text-orange-500 px-1.5 py-0.5 rounded-sm">Save
                                                <?= $currency_symbol . number_format($product['unit_price'] - $final_price, 2) ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Enhanced progress bar -->
                                    <div class="mt-3">
                                        <div class="relative h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="absolute left-0 top-0 bottom-0 bg-gradient-to-r from-orange-500 to-red-500 rounded-full"
                                                style="width: <?= $sold_percent ?>%">
                                                <div
                                                    class="absolute top-0 left-0 w-full h-full bg-white/30 animate-pulse-light">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mt-1.5">
                                            <div class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5 text-orange-500" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                                <span class="text-xs text-orange-600 font-medium">Sold
                                                    <?= $product['sold_count'] ?></span>
                                            </div>
                                            <span class="text-xs text-gray-500">Only
                                                <?= $product['quantity'] - $product['sold_count'] ?> left</span>
                                        </div>
                                    </div>

                                    <div class="mt-2.5 flex items-center justify-between">
                                        <!-- Brand and rating -->
                                        <div>
                                            <?php if (!empty($product['brand_name'])): ?>
                                                <div class="flex items-center gap-1">
                                                    <span class="text-xs text-gray-500"><?= $product['brand_name'] ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Rating Stars -->
                                            <div class="flex items-center gap-1 mt-0.5">
                                                <div class="flex items-center">
                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                        <i
                                                            class="las la-star text-xs <?= $i < floor($rating) ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="text-[10px] text-gray-500">(<?= rand(50, 500) ?>)</span>
                                            </div>
                                        </div>

                                        <!-- Add to cart button -->
                                        <button
                                            class="w-8 h-8 bg-orange-50 rounded-full flex items-center justify-center text-orange-500 hover:bg-orange-500 hover:text-white transition-all duration-300 shadow-sm">
                                            <i class="las la-shopping-cart text-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
    <!-- Featured Brands (Full Width) -->

</div>

<!-- Flash Sale Section - Premium Design -->

<div class="container mx-auto px-2 mt-4">
    <div
        class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300 mb-4">
        <div class="bg-gradient-to-r from-gray-50 to-white p-2 border-b flex items-center justify-between">
            <h2 class="font-semibold text-gray-800 text-sm flex items-center gap-1">
                <i class="las la-th-large text-orange-500"></i>
                Popular Categories
            </h2>
            <a href="/categories" class="text-orange-500 text-xs hover:text-orange-600 flex items-center group">
                View all <i class="las la-angle-right text-[10px] ml-0.5"></i>
            </a>
        </div>

        <div class="p-2">
            <div class="grid grid-cols-5 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-1">
                <?php
                if (is_array($categories_result)):
                    foreach ($categories_result as $category):
                        $category_img = $category['img'] ? "/public/uploads/all/" . $category['img'] : "/public/assets/img/placeholder.jpg";
                        ?>
                        <a href="/category/<?= $category['path'] ?>" class="group">
                            <div class="flex flex-col items-center gap-1 p-1 rounded-lg hover:bg-orange-50 transition-all">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-50 to-gray-50 overflow-hidden">
                                        <img src="<?= $category_img ?>" alt="<?= $category['name'] ?>"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <?php if (isset($category['product_count']) && $category['product_count'] > 0): ?>
                                        <div
                                            class="absolute -top-1 -right-1 w-4 h-4 bg-orange-500 text-white rounded-full flex items-center justify-center text-[8px] font-bold">
                                            <?= $category['product_count'] > 99 ? '99+' : $category['product_count'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p class="text-[13px] text-center font-medium text-gray-700 line-clamp-1">
                                    <?= $category['name'] ?>
                                </p>
                            </div>
                        </a>
                        <?php
                    endforeach;
                else:
                    mysqli_data_seek($categories_result, 0);
                    $count = 0;
                    while ($category = mysqli_fetch_assoc($categories_result) && $count < 10):
                        $category_img = $category['img'] ? "/public/uploads/all/" . $category['img'] : "/public/assets/img/placeholder.jpg";
                        $count++;
                        ?>
                        <a href="/category/<?= $category['path'] ?>" class="group">
                            <div class="flex flex-col items-center gap-1 p-1 rounded-lg hover:bg-orange-50 transition-all">
                                <div class="relative">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-50 to-gray-50 overflow-hidden">
                                        <img src="<?= $category_img ?>" alt="<?= $category['name'] ?>"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <?php if (isset($category['product_count']) && $category['product_count'] > 0): ?>
                                        <div
                                            class="absolute -top-1 -right-1 w-4 h-4 bg-orange-500 text-white rounded-full flex items-center justify-center text-[8px] font-bold">
                                            <?= $category['product_count'] > 99 ? '99+' : $category['product_count'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p class="text-[10px] text-center font-medium text-gray-700 line-clamp-1">
                                    <?= $category['name'] ?>
                                </p>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional styles to enhance the design */
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    @keyframes shine {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }

    .animate-shine {
        animation: shine 3s infinite;
    }

    @keyframes pulse-light {

        0%,
        100% {
            opacity: 0.3;
        }

        50% {
            opacity: 0.6;
        }
    }

    .animate-pulse-light {
        animation: pulse-light 1.5s ease-in-out infinite;
    }
</style>

<!-- Banner Grid - Shopee Style -->
<div class="container mx-auto px-2 mt-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <?php foreach (array_slice($slides, 0, 2) as $index => $slide): ?>
            <a href="/" class="block overflow-hidden rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                <img src="<?= $slide ?>" alt="Promotion <?= $index + 1 ?>"
                    class="w-full h-auto object-cover sm:h-32 transform hover:scale-105 transition-transform duration-700">
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Top Sellers - Enhanced Design -->
<div class="container mx-auto px-2 mt-4">
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="flex items-center justify-between p-3 border-b">
            <h2 class="font-bold text-gray-800 flex items-center gap-2">
                <i class="las la-store text-orange-500 text-xl"></i>
                Featured Shops
            </h2>
        </div>

        <div class="p-4">
            <div class="main-carousel"
                data-flickity='{ "wrapAround": true, "autoPlay": true, "pageDots": false, "prevNextButtons": true }'>
                <?php
                if (is_array($top_sellers_result)):
                    foreach ($top_sellers_result as $seller):
                        $shop_logo = $seller['logo_src'] ? "/public/uploads/all/" . $seller['logo_src'] : "";
                        $rating = $seller['rating'] > 0 ? $seller['rating'] : rand(38, 50) / 10;

                        $initials = "";
                        $name_parts = explode(" ", $seller['full_name']);
                        if (count($name_parts) >= 2) {
                            $initials = strtoupper(substr($name_parts[0], 0, 1) . substr($name_parts[count($name_parts) - 1], 0, 1));
                        } else {
                            $initials = strtoupper(substr($seller['full_name'], 0, 2));
                        }

                        $colors = ['bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-red-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500'];
                        $color_index = crc32($seller['full_name']) % count($colors);
                        $bg_color = $colors[$color_index];
                        ?>
                        <div class="carousel-cell w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2">
                            <a href="/shop.php?id=<?= $seller['id'] ?>" class="group block">
                                <div
                                    class="bg-white rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300 border border-gray-100">
                                    <div class="h-16 bg-gradient-to-r from-orange-400 to-red-500 relative">
                                        <?php if (!empty($seller['banners'])): ?>
                                            <img src="/public/uploads/all/<?= $seller['banners'] ?>"
                                                alt="<?= $seller['full_name'] ?> banner" class="w-full h-full object-cover">
                                        <?php endif; ?>
                                        <div class="absolute -bottom-6 left-1/2 -translate-x-1/2">
                                            <div class="w-14 h-14 rounded-full bg-white p-0.5 shadow-md">
                                                <div class="w-full h-full rounded-full overflow-hidden border-2 border-white">
                                                    <?php if (!empty($shop_logo)): ?>
                                                        <img src="<?= $shop_logo ?>" alt="<?= $seller['full_name'] ?>"
                                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                    <?php else: ?>
                                                        <div
                                                            class="w-full h-full <?= $bg_color ?> flex items-center justify-center text-white text-sm font-bold">
                                                            <?= $initials ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-8 pb-3 px-2 text-center">
                                        <h3
                                            class="font-semibold text-sm text-gray-800 truncate group-hover:text-orange-500 transition-colors">
                                            <?= $seller['full_name'] ?>
                                        </h3>
                                        <div class="mt-1 flex items-center justify-center gap-1">
                                            <span
                                                class="text-xs font-medium text-orange-500"><?= number_format($rating, 1) ?></span>
                                            <div class="flex items-center">
                                                <?php for ($i = 0; $i < 5; $i++): ?>
                                                    <i
                                                        class="las la-star text-xs <?= $i < floor($rating) ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <div class="mt-1 text-xs text-gray-500">
                                            <?= $seller['product_count'] ?> products
                                        </div>
                                        <button
                                            class="mt-2 w-full py-1 border border-orange-500 rounded text-xs text-orange-500 hover:bg-orange-500 hover:text-white transition-colors">
                                            <i class="las la-plus"></i> Follow
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    endforeach;
                else:
                    mysqli_data_seek($top_sellers_result, 0);
                    while ($seller = mysqli_fetch_assoc($top_sellers_result)):
                        $shop_logo = $seller['logo_src'] ? "/public/uploads/all/" . $seller['logo_src'] : "";
                        $rating = $seller['rating'] > 0 ? $seller['rating'] : rand(38, 50) / 10;

                        $initials = "";
                        $name_parts = explode(" ", $seller['full_name']);
                        if (count($name_parts) >= 2) {
                            $initials = strtoupper(substr($name_parts[0], 0, 1) . substr($name_parts[count($name_parts) - 1], 0, 1));
                        } else {
                            $initials = strtoupper(substr($seller['full_name'], 0, 2));
                        }

                        $colors = ['bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-red-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500'];
                        $color_index = crc32($seller['full_name']) % count($colors);
                        $bg_color = $colors[$color_index];
                        ?>
                        <div class="carousel-cell w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2">
                            <a href="/shop.php?id=<?= $seller['id'] ?>" class="group block">
                                <div
                                    class="bg-white rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300 border border-gray-100">
                                    <div class="h-16 bg-gradient-to-r from-orange-400 to-red-500 relative">
                                        <?php if (!empty($seller['banners'])): ?>
                                            <img src="/public/uploads/all/<?= $seller['banners'] ?>"
                                                alt="<?= $seller['full_name'] ?> banner" class="w-full h-full object-cover">
                                        <?php endif; ?>
                                        <div class="absolute -bottom-6 left-1/2 -translate-x-1/2">
                                            <div class="w-14 h-14 rounded-full bg-white p-0.5 shadow-md">
                                                <div class="w-full h-full rounded-full overflow-hidden border-2 border-white">
                                                    <?php if (!empty($shop_logo)): ?>
                                                        <img src="<?= $shop_logo ?>" alt="<?= $seller['full_name'] ?>"
                                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                    <?php else: ?>
                                                        <div
                                                            class="w-full h-full <?= $bg_color ?> flex items-center justify-center text-white text-sm font-bold">
                                                            <?= $initials ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-8 pb-3 px-2 text-center">
                                        <h3
                                            class="font-semibold text-sm text-gray-800 truncate group-hover:text-orange-500 transition-colors">
                                            <?= $seller['full_name'] ?>
                                        </h3>
                                        <div class="mt-1 flex items-center justify-center gap-1">
                                            <span
                                                class="text-xs font-medium text-orange-500"><?= number_format($rating, 1) ?></span>
                                            <div class="flex items-center">
                                                <?php for ($i = 0; $i < 5; $i++): ?>
                                                    <i
                                                        class="las la-star text-xs <?= $i < floor($rating) ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <div class="mt-1 text-xs text-gray-500">
                                            <?= $seller['product_count'] ?> products
                                        </div>
                                        <button
                                            class="mt-2 w-full py-1 border border-orange-500 rounded text-xs text-orange-500 hover:bg-orange-500 hover:text-white transition-colors">
                                            <i class="las la-plus"></i> Follow
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Recommended Products - Enhanced Shopee Style -->
<div class="container mx-auto px-2 mt-4 mb-6">
    <div
        class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300">
        <div class="relative bg-gradient-to-r from-orange-50 via-white to-orange-50 py-5">
            <div class="flex items-center justify-center">
                <div
                    class="absolute left-0 w-full h-px bg-gradient-to-r from-transparent via-orange-300 to-transparent">
                </div>
                <div
                    class="px-6 py-1.5 bg-gradient-to-r from-orange-500 to-red-500 rounded-full shadow-md relative z-10">
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="las la-fire text-yellow-300"></i>
                        TODAY'S RECOMMENDATIONS
                    </h2>
                </div>
            </div>
        </div>

        <div class="p-3 md:p-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
                <?php
                // Reset and ensure we're pulling accurate data
                if ($recommended_result && !is_array($recommended_result)) {
                    mysqli_data_seek($recommended_result, 0);

                    while ($product = mysqli_fetch_assoc($recommended_result)):
                        $image_url = !empty($product['thumbnail_image']) ? "/public/uploads/all/" . $product['thumbnail_image'] : "/public/assets/img/placeholder.jpg";

                        $original_price = $product['unit_price'];
                        $final_price = $product['discount'] > 0 ? $product['unit_price'] - ($product['discount']) : $product['unit_price'];

                        $discount_percent = isset($product['discount']) ? ($product['discount'] / $product['unit_price']) * 100 : 0;
                        ?>
                        <div class="group">
                            <div
                                class="bg-white rounded-lg overflow-hidden border border-gray-100 hover:border-orange-400 transition-all duration-300 hover:shadow-xl h-full flex flex-col">
                                <!-- Product Image with improved presentation -->
                                <div class="relative pt-[100%] overflow-hidden bg-gray-50">
                                    <a href="/product/<?= $product['id'] ?>" class="absolute inset-0">
                                        <img src="<?= $image_url ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                                            class="absolute inset-0 w-full h-full object-contain transition-transform duration-500 group-hover:scale-110"
                                            onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">

                                        <?php if ($discount_percent > 0): ?>
                                            <!-- Enhanced sale badge -->
                                            <div class="absolute top-2 right-2">
                                                <div
                                                    class="bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold px-2 py-1 rounded-sm shadow-sm transform -rotate-2 group-hover:rotate-0 transition-transform">
                                                    <?= ceil($discount_percent) ?>% OFF
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Enhanced wishlist button -->
                                        <button
                                            class="absolute top-2 left-2 w-8 h-8 flex items-center justify-center bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-orange-50 shadow-sm transform group-hover:scale-105"
                                            onclick="event.preventDefault(); addToWishlist(<?= $product['id'] ?>)">
                                            <i
                                                class="las la-heart text-lg text-gray-400 hover:text-red-500 transition-colors"></i>
                                        </button>

                                        <!-- Quick view overlay -->
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <button
                                                class="bg-white/95 hover:bg-white text-gray-800 px-3 py-1.5 rounded-full font-medium text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-md">
                                                Quick View
                                            </button>
                                        </div>
                                    </a>
                                </div>

                                <!-- Product Info with better spacing and hierarchy -->
                                <div class="p-3 flex flex-col flex-grow">
                                    <!-- Improved title presentation -->
                                    <h3
                                        class="text-sm font-medium text-gray-800 line-clamp-2 min-h-[40px] group-hover:text-orange-500 transition-colors">
                                        <a href="/product/<?= $product['id'] ?>">
                                            <?= htmlspecialchars($product['name']) ?>
                                        </a>
                                    </h3>

                                    <!-- Enhanced price display -->
                                    <div class="mt-2 flex flex-wrap items-baseline gap-2">
                                        <span
                                            class="text-orange-500 font-bold"><?= $currency_symbol . number_format($final_price) ?></span>
                                        <?php if ($discount_percent > 0): ?>
                                            <span
                                                class="text-xs text-gray-400 line-through"><?= $currency_symbol . number_format($original_price) ?></span>
                                            <span class="text-xs bg-orange-50 text-orange-500 px-1.5 py-0.5 rounded-sm">Save
                                                <?= $currency_symbol . number_format($original_price - $final_price) ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mt-auto pt-2">
                                        <!-- Shop name with icon -->
                                        <?php if (!empty($product['shop_name']) || !empty($product['brand_name'])): ?>
                                            <div class="mt-1 flex items-center gap-1">
                                                <i class="las la-store text-xs text-gray-400"></i>
                                                <span class="text-xs text-gray-500 truncate max-w-full">
                                                    <?= !empty($product['shop_name']) ? htmlspecialchars($product['shop_name']) : htmlspecialchars($product['brand_name']) ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Rating and Sold with improved visualization -->
                                        <div class="flex items-center justify-between mt-1.5">
                                            <div class="flex items-center gap-1">
                                                <?php
                                                // Use actual rating if available, otherwise generate placeholder
                                                $rating = !empty($product['seller_rating']) ? $product['seller_rating'] : rand(35, 50) / 10;
                                                ?>
                                                <div class="flex items-center">
                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                        <i
                                                            class="las la-star text-xs <?= $i < floor($rating) ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="text-xs text-gray-500"><?= number_format($rating, 1) ?></span>
                                            </div>

                                            <!-- Show accurate sold count when available -->
                                            <span class="text-xs text-gray-500">
                                                Sold
                                                <?= !empty($product['total_sales']) ? $product['total_sales'] : (!empty($product['sold_count']) ? $product['sold_count'] : rand(10, 999)) ?>
                                            </span>
                                        </div>

                                        <!-- Add to cart button -->
                                        <a type="button"
                                            class="mt-2 w-full py-1.5 bg-orange-50 hover:bg-orange-500 text-orange-500 hover:text-white rounded flex items-center justify-center gap-1 text-xs font-medium transition-all duration-300"
                                            href="/product/<?= $product['id'] ?>">
                                            <i class="las la-shopping-cart"></i> Add to Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                } elseif (is_array($recommended_result)) {
                    // Handle array case
                    foreach ($recommended_result as $product):
                        $image_url = !empty($product['image_src']) ? "/public/uploads/all/" . $product['image_src'] : "/public/assets/img/placeholder.jpg";

                        // Ensure proper price calculation
                        $final_price = $product['discount'] > 0 && isset($product['unit_price'])
                            ? $product['unit_price'] - ($product['unit_price'] * ($product['discount'] / 100))
                            : (isset($product['unit_price']) ? $product['unit_price'] : $product['unit_price']);

                        $original_price = isset($product['unit_price']) ? $product['unit_price'] : $product['unit_price'];
                        $discount_percent = isset($product['discount']) ? $product['discount'] : 0;
                        ?>
                        <!-- Same product card HTML as above -->
                        <div class="group">
                            <div
                                class="bg-white rounded-lg overflow-hidden border border-gray-100 hover:border-orange-400 transition-all duration-300 hover:shadow-xl h-full flex flex-col">
                                <!-- Product Image with improved presentation -->
                                <div class="relative pt-[100%] overflow-hidden bg-gray-50">
                                    <a href="/product/<?= $product['id'] ?>" class="absolute inset-0">
                                        <img src="<?= $image_url ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                                            class="absolute inset-0 w-full h-full object-contain transition-transform duration-500 group-hover:scale-110"
                                            onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">

                                        <?php if ($discount_percent > 0): ?>
                                            <!-- Enhanced sale badge -->
                                            <div class="absolute top-2 right-2">
                                                <div
                                                    class="bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-bold px-2 py-1 rounded-sm shadow-sm transform -rotate-2 group-hover:rotate-0 transition-transform">
                                                    <?= $discount_percent ?>% OFF
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Enhanced wishlist button -->
                                        <button
                                            class="absolute top-2 left-2 w-8 h-8 flex items-center justify-center bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-orange-50 shadow-sm transform group-hover:scale-105"
                                            onclick="event.preventDefault(); addToWishlist(<?= $product['id'] ?>)">
                                            <i
                                                class="las la-heart text-lg text-gray-400 hover:text-red-500 transition-colors"></i>
                                        </button>

                                        <!-- Quick view overlay -->
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <button
                                                class="bg-white/95 hover:bg-white text-gray-800 px-3 py-1.5 rounded-full font-medium text-xs transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-md">
                                                Quick View
                                            </button>
                                        </div>
                                    </a>
                                </div>

                                <!-- Product Info with better spacing and hierarchy -->
                                <div class="p-3 flex flex-col flex-grow">
                                    <!-- Improved title presentation -->
                                    <h3
                                        class="text-sm font-medium text-gray-800 line-clamp-2 min-h-[40px] group-hover:text-orange-500 transition-colors">
                                        <a href="/product/<?= $product['id'] ?>">
                                            <?= htmlspecialchars($product['name']) ?>
                                        </a>
                                    </h3>

                                    <!-- Enhanced price display -->
                                    <div class="mt-2 flex flex-wrap items-baseline gap-2">
                                        <span
                                            class="text-orange-500 font-bold"><?= $currency_symbol . number_format($final_price) ?></span>
                                        <?php if ($discount_percent > 0): ?>
                                            <span
                                                class="text-xs text-gray-400 line-through"><?= $currency_symbol . number_format($original_price) ?></span>
                                            <span class="text-xs bg-orange-50 text-orange-500 px-1.5 py-0.5 rounded-sm">Save
                                                <?= $currency_symbol . number_format($original_price - $final_price) ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mt-auto pt-2">
                                        <!-- Shop name with icon -->
                                        <?php if (!empty($product['full_name']) || !empty($product['brand_name'])): ?>
                                            <div class="mt-1 flex items-center gap-1">
                                                <i class="las la-store text-xs text-gray-400"></i>
                                                <span class="text-xs text-gray-500 truncate max-w-full">
                                                    <?= !empty($product['full_name']) ? htmlspecialchars($product['full_name']) : htmlspecialchars($product['brand_name']) ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Rating and Sold with improved visualization -->
                                        <div class="flex items-center justify-between mt-1.5">
                                            <div class="flex items-center gap-1">
                                                <?php
                                                // Use actual rating if available, otherwise generate placeholder
                                                $rating = !empty($product['seller_rating']) ? $product['seller_rating'] : rand(35, 50) / 10;
                                                ?>
                                                <div class="flex items-center">
                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                        <i
                                                            class="las la-star text-xs <?= $i < floor($rating) ? 'text-yellow-400' : 'text-gray-300' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="text-xs text-gray-500"><?= number_format($rating, 1) ?></span>
                                            </div>

                                            <!-- Show accurate sold count when available -->
                                            <span class="text-xs text-gray-500">
                                                Sold
                                                <?= !empty($product['total_sales']) ? $product['total_sales'] : (!empty($product['sold_count']) ? $product['sold_count'] : rand(10, 999)) ?>
                                            </span>
                                        </div>

                                        <!-- Add to cart button -->
                                        <button
                                            class="mt-2 w-full py-1.5 bg-orange-50 hover:bg-orange-500 text-orange-500 hover:text-white rounded flex items-center justify-center gap-1 text-xs font-medium transition-all duration-300">
                                            <i class="las la-shopping-cart"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                }
                ?>
            </div>

            <!-- Enhanced Load More Button -->
            <div class="flex justify-center mt-8 mb-2">
                <a href="/category" id="loadMoreBtn"
                    class="px-8 py-2.5 bg-orange-50 border border-orange-400 rounded-md text-orange-500 font-medium hover:bg-orange-500 hover:text-white transition-colors duration-300 shadow-sm flex items-center gap-2 group">
                    <span>View More Products</span>
                    <i class="las la-arrow-right text-sm transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Featured Blog Posts Section -->
<?php if (count($homepage_posts) > 0): ?>
    <div class="container mx-auto px-2 mt-6 mb-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
            <!-- Shopee-styled header with orange gradient background -->
            <div class="relative bg-gradient-to-r from-orange-500 to-red-500 py-4 px-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                            <i class="las la-newspaper text-2xl text-white"></i>
                        </div>
                        <h2 class="text-xl font-bold text-white">Latest From Our Blog</h2>
                    </div>
                    <a href="/blogs"
                        class="text-white/80 hover:text-white text-sm flex items-center group transition-all duration-300">
                        View all articles
                        <i class="las la-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                <!-- Decorative elements with Shopee orange colors -->
                <div
                    class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-300 via-white to-yellow-300 opacity-60">
                </div>
            </div>

            <!-- Blog posts grid with Shopee-styled cards -->
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <?php
                    // Display up to 4 posts maximum
                    foreach (array_slice($homepage_posts, 0, 4) as $post):
                        // Get first paragraph of content for excerpt
                        $excerpt = '';
                        if (!empty($post['content'])) {
                            // Clean up the content and get first part
                            $cleaned = strip_tags($post['content']);
                            $excerpt = substr($cleaned, 0, 120) . (strlen($cleaned) > 120 ? '...' : '');
                        }
                        ?>
                        <div
                            class="flex bg-gray-50 rounded-lg overflow-hidden hover:shadow-md transition-all duration-300 border border-gray-100 group hover:border-orange-300">
                            <!-- Image with hover effect -->
                            <div class="w-1/3 overflow-hidden">
                                <a href="/blogs/view.php?id=<?= $post['id'] ?>" class="block h-full">
                                    <img src="<?= htmlspecialchars($post['thumbnail']) ?>"
                                        alt="<?= htmlspecialchars($post['title']) ?>"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                        onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">
                                </a>
                            </div>

                            <!-- Content with Shopee-styled typography -->
                            <div class="w-2/3 p-4 flex flex-col">
                                <h3 class="text-lg font-bold line-clamp-2 group-hover:text-orange-500 transition-colors">
                                    <a href="/blogs/view.php?id=<?= $post['id'] ?>">
                                        <?= htmlspecialchars($post['title']) ?>
                                    </a>
                                </h3>

                                <!-- Short excerpt -->
                                <?php if (!empty($excerpt)): ?>
                                    <p class="text-gray-600 text-sm mt-1 line-clamp-2"><?= $excerpt ?></p>
                                <?php endif; ?>

                                <!-- Enhanced meta information with Shopee-colored icons -->
                                <div class="flex items-center text-gray-500 text-xs mt-auto pt-2">
                                    <span class="flex items-center mr-3">
                                        <i class="las la-user-circle text-orange-500 mr-1"></i>
                                        <?= htmlspecialchars($post['author'] ?? 'Admin') ?>
                                    </span>
                                    <span class="flex items-center mr-3">
                                        <i class="las la-calendar text-orange-500 mr-1"></i>
                                        <?= date('d M Y', strtotime($post['created_at'])) ?>
                                    </span>
                                    <span class="flex items-center">
                                        <i class="las la-eye text-orange-500 mr-1"></i>
                                        <?= number_format($post['views']) ?>
                                    </span>

                                    <!-- Read more button with Shopee colors -->
                                    <a href="/blogs/view.php?id=<?= $post['id'] ?>"
                                        class="ml-auto text-orange-500 hover:text-orange-600 font-medium text-xs flex items-center group-hover:underline">
                                        Read more
                                        <i class="las la-arrow-right ml-1 group-hover:ml-2 transition-all"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Shopee-styled "More Articles" button at bottom -->
            <div class="px-4 pb-4 flex justify-center">
                <a href="/blogs"
                    class="px-6 py-2 bg-orange-50 border border-orange-300 rounded text-orange-500 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition-all font-medium text-sm flex items-center gap-2">
                    <span>More Articles</span>
                    <i class="las la-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
    .aiz-carousel .slick-prev,
    .aiz-carousel .slick-next {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        z-index: 10;
    }

    .aiz-carousel .slick-prev:hover,
    .aiz-carousel .slick-next:hover {
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .aiz-carousel .slick-dots {
        display: flex !important;
        gap: 6px;
        justify-content: center;
        position: absolute;
        bottom: 12px;
        left: 50%;
        transform: translateX(-50%);
    }

    .aiz-carousel .slick-dots li button {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }

    .aiz-carousel .slick-dots li.slick-active button {
        background: #fff;
        transform: scale(1.2);
    }

    /* Enhanced Hover Effects */
    .product-card:hover {
        transform: translateY(-2px);
    }

    /* Animated Badge */
    @keyframes pulse-badge {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .badge-discount {
        animation: pulse-badge 2s infinite;
    }

    /* Improved Mobile Responsiveness */
    @media (max-width: 640px) {
        .countdown-container {
            flex-direction: column;
        }
    }
</style>

<script>
    // Initialize the carousel when DOM is ready
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize carousel
        const carousel = document.querySelector('.aiz-carousel');
        if (carousel) {
            // Get all slides
            const slides = carousel.querySelectorAll('.carousel-box');
            let currentSlide = 0;
            const totalSlides = slides.length;

            // Set up navigation arrows using more specific selectors
            const prevButton = carousel.parentElement.querySelector('button:first-of-type');
            const nextButton = carousel.parentElement.querySelector('button:nth-of-type(2)');

            // Set up dots
            const dotsContainer = carousel.parentElement.querySelector('.absolute.bottom-3');
            const dots = dotsContainer.querySelectorAll('button');

            // Function to show a specific slide
            function showSlide(index) {
                // Hide all slides
                slides.forEach(slide => {
                    slide.style.display = 'none';
                });

                // Update dots
                dots.forEach((dot, i) => {
                    dot.classList.remove('bg-white');
                    dot.classList.add('bg-white/50');
                    if (i === index) {
                        dot.classList.remove('bg-white/50');
                        dot.classList.add('bg-white');
                    }
                });

                // Show selected slide
                slides[index].style.display = 'block';
                currentSlide = index;
            }

            // Set up event listeners for arrows
            prevButton.addEventListener('click', function () {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide);
            });

            nextButton.addEventListener('click', function () {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            });

            // Set up event listeners for dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function () {
                    showSlide(index);
                });
            });

            // Set up autoplay
            let autoplayInterval = null;
            if (carousel.getAttribute('data-autoplay') === 'true') {
                autoplayInterval = setInterval(function () {
                    currentSlide = (currentSlide + 1) % totalSlides;
                    showSlide(currentSlide);
                }, 5000); // Change slide every 5 seconds
            }

            // Show first slide initially
            showSlide(0);
        }

        // Smooth Countdown Timer
        const endTime = new Date().getTime() + (12 * 60 * 60 * 1000) + (45 * 60 * 1000) + (30 * 1000);

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance < 0) {
                clearInterval(countdownTimer);
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.querySelector('.countdown-hours').textContent = hours.toString().padStart(2, '0');
            document.querySelector('.countdown-minutes').textContent = minutes.toString().padStart(2, '0');
            document.querySelector('.countdown-seconds').textContent = seconds.toString().padStart(2, '0');
        }

        const countdownTimer = setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call to avoid delay
    });

    // Back to top functionality

    // Add to wishlist functionality
    function addToWishlist(productId) {
        // Implement wishlist functionality
        console.log('Added product', productId, 'to wishlist');

        // Visual feedback
        const heart = event.target.closest('i');
        heart.classList.add('text-orange-500');

        setTimeout(() => {
            heart.classList.remove('text-orange-500');
        }, 1000);
    }
</script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<?php require_once("./layout/footer.php"); ?>