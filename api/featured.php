<?php include('../config.php')?>
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
                if(mysqli_num_rows($result) > 0) {
                    // Loop through each product
                    while($product = mysqli_fetch_assoc($result)) {
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
                                <span class="fw-700 text-primary"><?php echo number_format($product['unit_price'], 2); ?><?=$_SESSION['currency_character']?></span>
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