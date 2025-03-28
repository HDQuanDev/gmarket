
<?php

$shop_logo=fetch_array("SELECT  * FROM file WHERE id='$seller_shop_logo' LIMIT 1");
?>
<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <div class="d-block text-center my-3">
                <img class="mw-100 mb-3" src="/public/uploads/all/<?=$shop_logo?$shop_logo['src']:"1731319238-1lgoo.svg"?>" class="brand-icon" alt="<?=$seller_shop_name?>">
                <h3 class="fs-16  m-0 text-primary"><?=$seller_shop_name?></h3>
                <p class="text-primary"><?=$seller_email?></p>
                <p class="text-primary fs-14"><?=tran("Credit Score")?>: <?=$seller_money?></p>
            </div>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm" type="text"
                    name="" placeholder="Search in menu" id="menu-search"
                    onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">
                <li class="aiz-side-nav-item">
                    <a href="/seller/index.php" class="aiz-side-nav-link">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Dashboard")?></span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-shopping-cart aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Products")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <!--Submenu-->
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/seller/products/index.php"
                                class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Products")?></span>
                            </a>
                        </li>

                        <!--<li class="aiz-side-nav-item">
                            <a href="/seller/product-bulk-upload/index"
                                class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Product Bulk Upload</span>
                            </a>
                        </li>-->
                        <li class="aiz-side-nav-item">
                            <a href="/seller/products/digitalproducts.php"
                                class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Digital Products")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/seller/products/reviews.php"
                                class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Product Reviews")?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="aiz-side-nav-item">
                    <a href="/seller/uploads"
                        class="aiz-side-nav-link ">
                        <i class="las la-folder-open aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Uploaded Files")?></span>
                    </a>
                </li>
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-shopping-cart aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Package")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/seller/packages/index.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Packages")?></span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="/seller/packages/payment_list.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Purchase Packages")?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-shopping-bag aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Through Train")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/seller/through_train/index.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Through Train")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/seller/through_train/payment_list.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Historical Purchases")?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-tasks aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">POS System</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/seller/pos/index.php"
                                class="aiz-side-nav-link ">
                                <i class="las la-fax aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text">POS Manager</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="/seller/orders/index.php"
                        class="aiz-side-nav-link ">
                        <i class="las la-money-bill aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Orders")?></span>
                    </a>
                </li>


                <li class="aiz-side-nav-item">
                    <a href="/seller/shop/index.php"
                        class="aiz-side-nav-link ">
                        <i class="las la-cog aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Shop Setting")?></span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="/seller/payments.php"
                        class="aiz-side-nav-link ">
                        <i class="las la-history aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Payment History")?></span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="/seller/withdraw_requests.php"
                        class="aiz-side-nav-link ">
                        <i class="las la-money-bill-wave-alt aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Money Withdraw")?></span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="/seller/recharge_requests.php"
                        class="aiz-side-nav-link ">
                        <i class="las la-money-bill-wave-alt aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Money Recharge")?></span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="/seller/commission_history.php" class="aiz-side-nav-link">
                        <i class="las la-file-alt aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Commission History")?></span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="/seller/conversations/index.php"
                        class="aiz-side-nav-link ">
                        <i class="las la-comment aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Conversations")?></span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="/seller/product_queries.php"
                        class="aiz-side-nav-link ">
                        <i class="las la-question-circle aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Product Queries")?></span>

                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="/seller/support_ticket"
                        class="aiz-side-nav-link ">
                        <i class="las la-atom aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Support Ticket")?></span>
                    </a>
                </li>

            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->