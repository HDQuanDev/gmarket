<?php
require_once(__DIR__ . "/../layout/header.php");
if(isset($_GET['product']) && $_GET['product']!=""){
    $product = $_GET['product'];
    // Explicitly get purchase_price as is, without any calculations
    $p = fetch_array("SELECT *, purchase_price as purchase_price FROM products WHERE id='$product'");
    
    if($p){
        // Check if the product has a seller_id, if not, show error page
        if(empty($p['seller_id'])) {
            // Display product not available error with Tailwind CSS
            ?>
            <div class="container mx-auto px-4 py-16">
                <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-3">Product Not Available</h2>
                        <p class="text-gray-600 mb-6">This product is currently not available for purchase. It may have been removed or is not yet assigned to a seller.</p>
                        <a href="/" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition-colors">
                            Return to Homepage
                        </a>
                    </div>
                </div>
            </div>
            <?php
            require_once("../layout/footer.php");
            exit;
        }
        
        // Check if the seller is active
        $seller_id = $p['seller_id'];
        $seller_status = fetch_array("SELECT status FROM sellers WHERE id='$seller_id'");
        
        if (!$seller_status || $seller_status['status'] !== 'active') {
            // Display seller not active error with Tailwind CSS
            ?>
            <div class="container mx-auto px-4 py-16">
                <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-amber-100 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-3">Seller Not Available</h2>
                        <p class="text-gray-600 mb-6">This product's seller is currently inactive or has been suspended. The product is temporarily unavailable for purchase.</p>
                        <a href="/" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition-colors">
                            Return to Homepage
                        </a>
                    </div>
                </div>
            </div>
            <?php
            require_once("../layout/footer.php");
            exit;
        }
        
        // If product exists in database and has an active seller, use it
        $dom = new DOMDocument;
        $xpath = new DOMXPath($dom);
        
        // Create product data from database - don't modify the purchase_price
        $product_id = $p['id'];
        $product_name = $p['name'];
        $product_price = $p['purchase_price']; // Keep original, don't modify
        $product_image = $p['gallery_images'];
        $product_description = $p['description'] ?? '';
        $product_stock = $p['stock'] ?? 10;
        
        // You can pass these variables to your template
        require_once("./shop_product.php");
        die();
    } else {
        // If product not found in database - with Tailwind CSS
        ?>
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">Product Not Found</h2>
                    <p class="text-gray-600 mb-6">The product you are looking for does not exist or may have been removed.</p>
                    <a href="/" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition-colors">
                        Return to Homepage
                    </a>
                </div>
            </div>
        </div>
        <?php
        require_once("../layout/footer.php");
        die();
    }
}
else {
    // URL doesn't exist - with Tailwind CSS
    ?>
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-8 text-center">
                <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Invalid URL</h2>
                <p class="text-gray-600 mb-6">The URL you are trying to access is invalid or incomplete.</p>
                <a href="/" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-md transition-colors">
                    Return to Homepage
                </a>
            </div>
        </div>
    </div>
    <?php
    require_once("../layout/footer.php");
    die();
}
?>