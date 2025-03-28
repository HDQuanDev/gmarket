<?= require_once("./layout/header.php") ?>
<div class="home-banner-area mb-4 pt-3">
    <div class="container">
        <div class="row gutters-10 position-relative">
            <div class="col-lg-3 position-static d-none d-lg-block">
                <div class="aiz-category-menu bg-white rounded  shadow-sm">
                    <div class="p-3 bg-soft-primary d-none d-lg-block rounded-top all-category position-relative text-left">
                        <span class="fw-600 fs-16 mr-3">Categories</span>
                        <a href="/categories" class="text-reset">
                            <span class="d-none d-lg-inline-block">See All ></span>
                        </a>
                    </div>
                    <ul class="list-unstyled categories no-scrollbar py-2 mb-0 text-left">
                        <?php
                        // Fetch categories from the database
                        $category_query = "SELECT * FROM categories ORDER BY id ASC";
                        $category_result = mysqli_query($conn, $category_query);
                        
                        // Check if categories exist
                        if(mysqli_num_rows($category_result) > 0) {
                            // Loop through each category
                            while($category = mysqli_fetch_assoc($category_result)) {
                                $img_url = !empty($category['img']) ? '/public/uploads/all/' . $category['img'] : '/public/assets/img/placeholder.jpg';
                        ?>
                        <li class="category-nav-element" data-id="<?php echo $category['id']; ?>">
                            <a href="/category/<?php echo $category['path']; ?>" class="text-truncate text-reset py-2 px-3 d-block">
                                <img
                                    class="cat-image lazyload mr-2 opacity-60"
                                    src="/public/assets/img/placeholder.jpg"
                                    data-src="<?php echo $img_url; ?>"
                                    width="16"
                                    alt="<?php echo $category['name']; ?>"
                                    onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">
                                <span class="cat-name"><?php echo $category['name']; ?></span>
                            </a>
                        </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true">
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/OAjX4Kgn9yGXJ8uc0HBoBQkM4MzmClzjn19rpuKM.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/zrBEQ0wDzMMdNITo1s4FnPKOTEgUKiAeGulzCPvp.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/FDbI6VbmXbQRTwkLfrcgm7GbbCJ7U1Lj0AVN0gWG.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/FweDQq8LWA2WMc1xmMmW968RWsy69aSQN0Qy1gVe.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/2aL2ai7Vh0Wgk8wG70iDc6B90BPWTdx0uAAKwQ2x.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/xRT8Y7AZgHhGuD7rao4EWc4sWaTTBqkPDVS2WmbV.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/pjf0wngtorc17SQYBriIGjPE4sT9H6tnDoBRwUCm.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/7n5bwDNnXjUJt0MqHbtTUIfZChE1eQJMpxh9K93r.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>
                    <div class="carousel-box">
                        <a href="/">
                            <img
                                class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                                src="/public/uploads/all/n6YuOzZylIrsqawsuKiTOlfk43iC77Y5Y7W1vv8D.png"
                                alt="GMARKETVN promo"
                                height="315"
                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                        </a>
                    </div>

                    <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="10" data-xl-items="9" data-lg-items="8" data-md-items="7" data-sm-items="5" data-xs-items="4" data-arrows='true'>
                        <?php
                        // Reset the category result pointer to start from the beginning
                        mysqli_data_seek($category_result, 0);
                        
                        // Loop through categories again for the carousel
                        while($category = mysqli_fetch_assoc($category_result)) {
                            $img_url = !empty($category['img']) ? $category['img'] : '/public/assets/img/placeholder.jpg';
                        ?>
                        <div class="slide-cate">
                            <a href="/category/<?php echo $category['path']; ?>" class="d-block rounded bg-white p-2 text-reset shadow-sm">
                                <img
                                    src="/public/assets/img/placeholder.jpg"
                                    data-src="<?php echo $img_url; ?>"
                                    alt="<?php echo $category['name']; ?>"
                                    class="lazyload img-fit"
                                    height="78"
                                    onerror="this.onerror=null;this.src='/public/assets/img/placeholder-rect.jpg';">
                                <div class="text-truncate fs-12 fw-600 mt-2 opacity-70"><?php echo $category['name']; ?></div>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .slide-cate {
                padding: 5px 5px 0 5px
            }
        </style>

        <div class="mb-4">
            <div class="container">
                <div class="row gutters-10">
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="/" class="d-block text-reset">
                                <img src="/public/assets/img/placeholder-rect.jpg" data-src="/public/uploads/all/3rlMzrXackF27NnXwHf10p5bZe6B6fQ7gGlpf8Ee.png" alt="GMARKETVN promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="/" class="d-block text-reset">
                                <img src="/public/assets/img/placeholder-rect.jpg" data-src="/public/uploads/all/F931utpUonsvukOB7C3j0eUeqdRwT87BaJXgFxat.png" alt="GMARKETVN promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="/" class="d-block text-reset">
                                <img src="/public/assets/img/placeholder-rect.jpg" data-src="/public/uploads/all/qNTwqsBIB3IsL9TH4ovSMxSt1hw4yMWHiAmuNAvP.png" alt="GMARKETVN promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="mb-4">
            <div class="container">
                <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                    <div class="d-flex mb-3 align-items-baseline border-bottom">
                        <h3 class="h5 fw-700 mb-0">
                            <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">Featured Products</span>
                        </h3>
                    </div>
                    <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true'>
                        <?php
                        // Fetch featured products from the database
                        $query = "SELECT * FROM products WHERE published = 1 ORDER BY id DESC LIMIT 12";
                        $result = mysqli_query($conn, $query);

                        // Check if products exist
                        if (mysqli_num_rows($result) > 0) {
                            // Loop through each product
                            while ($product = mysqli_fetch_assoc($result)) {
                                // Get thumbnail image URL or use placeholder
                                $thumb_img = !empty($product['thumbnail_image']) ? $product['thumbnail_image'] : 'https://gmarket-quocte.com/public/assets/img/placeholder.jpg';
                        ?>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/<?php echo $product['id']; ?>" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                    src="https://gmarket-quocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="<?php echo $thumb_img; ?>"
                                                    alt="<?php echo $product['name']; ?>"
                                                    onerror="this.onerror=null;this.src='https://gmarket-quocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                            <div class="absolute-top-right aiz-p-hov-icon">
                                                <a href="javascript:void(0)" onclick="addToWishList(<?php echo $product['id']; ?>)" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                    <i class="la la-heart-o"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="addToCompare(<?php echo $product['id']; ?>)" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                    <i class="las la-sync"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="showAddToCartModal(<?php echo $product['id']; ?>)" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                    <i class="las la-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary"><?php echo number_format($product['purchase_price'], 2); ?><?= $_SESSION['currency_character'] ?></span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star active'></i><i class='las la-star active'></i><i class='las la-star active'></i><i class='las la-star active'></i><i class='las la-star active'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                <a href="/product/<?php echo $product['id']; ?>" class="d-block text-reset"><?php echo $product['name']; ?></a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            // Display message if no featured products
                            echo '<div class="col-12"><p class="text-center">No featured products available.</p></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- SCRIPTS -->
<script src="/public/assets/js/vendors.js"></script>
<script src="/public/assets/js/aiz-core.js"></script>
<?php
require_once("./layout/footer.php");
require_once("./layout/livechat.php");
?>