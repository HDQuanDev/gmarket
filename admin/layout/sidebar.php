
<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="/admin" class="d-block text-left">
                <img class="mw-100" src="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg" class="brand-icon" alt="GMARKETVN">
            </a>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text" name="" placeholder="Search in menu" id="menu-search" onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">


                <li class="aiz-side-nav-item">
                    <a href="/admin" class="aiz-side-nav-link">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Dashboard")?></span>
                    </a>
                </li>

                <!-- POS Addon-->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-tasks aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("POS System")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/pos/index.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("POS Manager")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/pos/pos_active.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("POS Configuration")?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Product -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-shopping-cart aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Products")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <!--Submenu-->
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a class="aiz-side-nav-link" href="/admin/products/create.php">
                                <span class="aiz-side-nav-text"><?=tran("Add New Product")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/products/all.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("All products")?></span>
                            </a>
                        </li>
                         <li class="aiz-side-nav-item">
                            <a href="/admin/products/in_house_products.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("In House Products")?></span>
                            </a>
                        </li> 
                        
                        <li class="aiz-side-nav-item">
                            <a href="/admin/products/seller_products.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Seller Products")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/products/digitalproducts.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Digital Products")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/products/bulk_upload.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Bulk Import</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <!-- <a href="/admin/products/bulk_export.php" class="aiz-side-nav-link"> -->
                            <a href="/admin/products/bulk_upload.php" class="aiz-side-nav-link">

                                <span class="aiz-side-nav-text">Bulk Export</span>
                            </a>
                        </li> 
                        <li class="aiz-side-nav-item">
                            <a href="/admin/categories" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Category")?></span>
                            </a>
                        </li>
                       <li class="aiz-side-nav-item">
                             <a href="/admin/brands" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Brand")?></span>
                            </a>
                        </li>
                      
                        <li class="aiz-side-nav-item">
                            <a href="/admin/products/attributes.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Attribute")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/products/colors.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Colors")?></span>
                            </a>
                        </li> 
                 
                        <li class="aiz-side-nav-item">
                            <a href="/admin/products/reviews.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Product Reviews")?></span>
                            </a>
                        </li> 
                    </ul>
                </li>

                <!-- Auction Product -->

                <!-- Wholesale Product -->

                <!-- Sale -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-money-bill aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Dashboard")?> </span>
                        <span class="badge badge-info">228</span> <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/sales/all_orders.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("All Orders")?></span>
                            </a>
                        </li>
                         <!-- <li class="aiz-side-nav-item">
                            <a href="/admin/sales/inhouse_orders.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Inhouse orders</span>
                            </a>
                        </li> -->

                        <li class="aiz-side-nav-item">
                            <a href="/admin/sales/seller_orders.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Seller Orders")?></span>
                            </a>
                        </li>

                        <!-- <li class="aiz-side-nav-item">
                            <a href="/admin/sales/orders_by_pickup_point.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Pick-up Point Order</span>
                            </a>
                        </li> -->
                    </ul>
                </li>




                <!-- Deliver Boy Addon-->

                <!-- Refund addon -->

                <!-- Customers -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-user-friends aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Customers")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/customers/index.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Customer list")?></span>
                            </a>
                        </li>
                        <!-- <li class="aiz-side-nav-item">
                            <a href="/admin/customers/sellers.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Seller list</span>
                            </a>
                        </li> -->
                        <li class="aiz-side-nav-item">
                            <a href="/admin/customers/classified_products.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Classified Products")?></span>
                            </a>
                        </li> 
                        <li class="aiz-side-nav-item">
                            <a href="/admin/customers/packages.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Classified Packages")?></span>
                            </a>
                        </li>
                       
                    </ul>
                </li>



                <!-- Sellers -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-user aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Sellers")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/sellers/index.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("All Seller")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/sellers/payments.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Payouts")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/sellers/withdraw_requests_all.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Payout Requests")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/sellers/recharge_requests_all.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Recharge Requests")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/sellers/vendor_commission.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Seller Commission")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/sellers/seller_packages.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Seller Packages")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/sellers/verification_form.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Seller Verification Form")?></span>
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
                            <a href="/admin/through_train/sellers.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Through Train")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/through_train/offline_seller_payment_requests.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Historical Purchases")?></span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="aiz-side-nav-item">
                    <a href="/admin/uploaded-files" class="aiz-side-nav-link ">
                        <i class="las la-folder-open aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Uploaded Files")?></span>
                    </a>
                </li>

                <!-- Reports -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-file-alt aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Reports")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/report/in_house_sale_report.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("In House Product Sale")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/report/seller_sale_report.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Seller Products Sale Reports")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/report/stock_report.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Products Stock")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/report/wish_report.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Products wishlist")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/report/user_search_report.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("User Searches")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/report/commission_log.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Commission History")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/report/wallet_history.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Wallet Recharge History")?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!--Blog System-->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-bullhorn aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Blog System")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/blog" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("All Posts")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/blog/blog_category.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Categories")?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- marketing -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-bullhorn aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Marketing")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/marketing/flash_deals.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Flash deals")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/marketing/newsletter.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Newsletters")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/marketing/subscribers.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Subscribers")?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Support -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-link aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Support")?> </span>
                        <span class="badge badge-info">7</span> <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/support/support_ticket.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Ticket")?></span>
                                <span class="badge badge-info">3</span> </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="/admin/support/conversations.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Product Conversations")?></span>
                                <span class="badge badge-info">4</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/support/product_queries.php"
                                class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Product Queries")?></span>
                            </a>
                        </li> 
                    </ul>
                </li>

                <!-- Affiliate Addon -->
                <!-- <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-link aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Affiliate System</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/affiliate/configs" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Affiliate Registration Form</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/affiliate" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Affiliate Configurations</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/affiliate/users" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Affiliate Users</span>
                            </a>
                        </li>
                       
                        <li class="aiz-side-nav-item">
                            <a href="/admin/referral_admin" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Referral Admin</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/affiliate/withdraw_requests" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Affiliate Withdraw Requests</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/affiliate/logs" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Affiliate Logs</span>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- Offline Payment Addon-->
                <!-- <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-money-check-alt aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Offline Payment System</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/manual_payment_methods" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Manual Payment Methods</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/offline-wallet-recharge-requests" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Offline Wallet Recharge</span>
                            </a>
                        </li>

                        <li class="aiz-side-nav-item">
                            <a href="/admin/offline-customer-package-payment-requests" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Offline Customer Package Payments</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/offline-seller-package-payment-requests" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Offline Seller Package Payments</span>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- Paytm Addon -->

                <!-- Club Point Addon-->

                <!--OTP addon -->


                <!-- Website Setup -->
                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link ">
                        <i class="las la-desktop aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Website Setup")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/website/header.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Header")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/website/footer.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Footer")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/website/pages.php" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text"><?=tran("Pages")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/website/appearance.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Appearance")?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Setup & Configurations -->
                <!-- <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-dharmachakra aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Setup &amp; Configurations</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/general-setting" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">General Settings</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/activation" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Features activation</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/languages" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Languages</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/currency" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Currency</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/tax" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Vat &amp; TAX</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/pick_up_points" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Pickup point</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/smtp-settings" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">SMTP Settings</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/payment-method" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Payment Methods</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/order-configuration" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Order Configuration</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/file_system" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">File System &amp; Cache Configuration</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/social-login" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Social media Logins</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="javascript:void(0);" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Facebook</span>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-3">
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/facebook-chat" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">Facebook Chat</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/facebook-comment" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">Facebook Comment</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="javascript:void(0);" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Google</span>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-3">
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/google-analytics" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">Analytics Tools</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/google-recaptcha" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">Google reCAPTCHA</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/google-map" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">Google Map</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/google-firebase" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">Google Firebase</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="javascript:void(0);" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">Shipping</span>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-3">
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/shipping_configuration" class="aiz-side-nav-link ">
                                        <span class="aiz-side-nav-text">Shipping Configuration</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/countries" class="aiz-side-nav-link ">
                                        <span class="aiz-side-nav-text">Shipping Countries</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/states" class="aiz-side-nav-link ">
                                        <span class="aiz-side-nav-text">Shipping States</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/cities" class="aiz-side-nav-link ">
                                        <span class="aiz-side-nav-text">Shipping Cities</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/zones" class="aiz-side-nav-link ">
                                        <span class="aiz-side-nav-text">Shipping Zones</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/admin/carriers" class="aiz-side-nav-link ">
                                        <span class="aiz-side-nav-text">Shipping Carrier</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->

                <!-- Staffs -->
                <!-- <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-user-tie aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Staffs</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/staffs" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">All staffs</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/roles" class="aiz-side-nav-link ">
                                <span class="aiz-side-nav-text">Staff permissions</span>
                            </a>
                        </li>
                    </ul>
                </li> -->


                <li class="aiz-side-nav-item">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-user-tie aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("System")?></span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="/admin/system/update.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Update")?></span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="/admin/system/server_status.php" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text"><?=tran("Server status")?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Addon Manager -->
                <li class="aiz-side-nav-item">
                    <a href="/admin/addons" class="aiz-side-nav-link ">
                        <i class="las la-wrench aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text"><?=tran("Addon Manager")?></span>
                    </a>
                </li>

                
            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->