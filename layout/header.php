<?php
require_once(__DIR__ . "/../config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="csrf-token" content="aCXlmkGIF8M5mTlqrTsNo6sGJQysBJlDUqOh9JGt">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">

    <title>GMARKETVN | Buy Korean domestic products at original prices from the manufacturer</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Buy Korean domestic products at original prices from the manufacturer" />
    <meta name="keywords" content="GMARKETVN">


    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="GMARKETVN">
    <meta itemprop="description" content="Buy Korean domestic products at original prices from the manufacturer">
    <meta itemprop="image" content="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="GMARKETVN">
    <meta name="twitter:description" content="Buy Korean domestic products at original prices from the manufacturer">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">

    <!-- Open Graph data -->
    <meta property="og:title" content="GMARKETVN" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg" />
    <meta property="og:description" content="Buy Korean domestic products at original prices from the manufacturer" />
    <meta property="og:site_name" content="GMARKETVN" />
    <meta property="fb:app_id" content="">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="./public/assets/css/vendors.css">
    <link rel="stylesheet" href="./public/assets/css/aiz-core.css">
    <link rel="stylesheet" href="./public/assets/css/custom-style.css">


    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Nothing selected',
            nothing_found: 'Nothing found',
            choose_file: 'Choose File',
            file_selected: 'File selected',
            files_selected: 'Files selected',
            add_more_files: 'Add more files',
            adding_more_files: 'Adding more files',
            drop_files_here_paste_or: 'Drop files here, paste or',
            browse: 'Browse',
            upload_complete: 'Upload complete',
            upload_paused: 'Upload paused',
            resume_upload: 'Resume upload',
            pause_upload: 'Pause upload',
            retry_upload: 'Retry upload',
            cancel_upload: 'Cancel upload',
            uploading: 'Uploading',
            processing: 'Processing',
            complete: 'Complete',
            file: 'File',
            files: 'Files',
        }
    </script>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
        }

        :root {
            --primary: #00c01e;
            --hov-primary: #00c01e;
            --soft-primary: rgba(0, 192, 30, 0.15);
        }

        #map {
            width: 100%;
            height: 250px;
        }

        #edit_map {
            width: 100%;
            height: 250px;
        }

        .pac-container {
            z-index: 100000;
        }

        #chat-widget-container {
            margin-bottom: 100px;
        }
    </style>




</head>
<?= tran('WELCOME TO GMARKETVN !') ?>
<!-- AIZ.plugins.notify('success', 'Ticket has been sent successfully'); -->
<?php if (file_exists("./layout/translate.php")) include_once("./layout/translate.php");
else include_once("../layout/translate.php") ?>
<div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="/" class="d-block text-reset">
        <img src="/public/uploads/all/MrmcfYwlmk4jcP9XheaLx0DOFof7atePd8r1NF3E.png" class="w-100 mw-100 h-50px h-lg-auto img-fit">
    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>

</div>
<!-- Top Bar -->
<div class="top-navbar bg-white border-bottom border-soft-secondary z-1035 h-35px h-sm-auto">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col">
                <ul class="list-inline d-flex justify-content-between justify-content-lg-start mb-0">
                    <li class="list-inline-item dropdown mr-3" id="lang-change">
                        <?php if ($_SESSION['country'] == 'en') { ?>
                            <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">
                                <img src="/public/assets/img/placeholder.jpg" data-src="/public/assets/img/flags/en.png" class="mr-2 lazyload" alt="English" height="11">
                                <span class="opacity-60">English</span>
                            </a>
                        <?php } else if ($_SESSION['country'] == 'ko') { ?>
                            <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">
                                <img src="/public/assets/img/placeholder.jpg" data-src="/public/assets/img/flags/kr.png" class="mr-1 lazyload" alt="Korea" height="11">
                                <span class="language">Korea</span>
                            </a>
                        <?php } else if ($_SESSION['country'] == 'ja') { ?>
                            <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">
                                <img src="/public/assets/img/placeholder.jpg" data-src="/public/assets/img/flags/jp.png" class="mr-1 lazyload" alt="Japan" height="11">
                                <span class="language">Japan</span>
                            </a>


                        <?php } else if ($_SESSION['country'] == 'vi') { ?>
                            <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2" data-toggle="dropdown" data-display="static">

                                <img src="/public/assets/img/placeholder.jpg" data-src="/public/assets/img/flags/vn.png" class="mr-1 lazyload" alt="Vietnam" height="11">
                                <span class="language">Vietnam</span>
                            </a>
                        <?php } ?>



                        <ul class="dropdown-menu dropdown-menu-left">
                            <li>
                                <a href="javascript:void(0)" data-flag="en" class="dropdown-item <?= $_SESSION['country'] == 'en' ? 'active' : '' ?>">
                                    <img src="/public/assets/img/placeholder.jpg" data-src="/public/assets/img/flags/en.png" class="mr-1 lazyload" alt="English" height="11">
                                    <span class="language">English</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="javascript:void(0)" data-flag="kr" class="dropdown-item ">
                                    <img src="/public/assets/img/placeholder.jpg" data-src="/public/assets/img/flags/kr.png" class="mr-1 lazyload" alt="Korea" height="11">
                                    <span class="language">Korea</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-flag="jp" class="dropdown-item ">
                                    <img src="/public/assets/img/placeholder.jpg" data-src="/public/assets/img/flags/jp.png" class="mr-1 lazyload" alt="Japan" height="11">
                                    <span class="language">Japan</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="javascript:void(0)" data-flag="vn" class="dropdown-item <?= $_SESSION['country'] == 'vi' ? 'active' : '' ?>">
                                    <img src="/public/assets/img/placeholder.jpg" data-src="/public/assets/img/flags/vn.png" class="mr-1 lazyload" alt="Vietnam" height="11">
                                    <span class="language">Vietnam</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="list-inline-item dropdown ml-auto ml-lg-0 mr-0" id="currency-change">
                        <a href="javascript:void(0)" class="dropdown-toggle text-reset py-2 opacity-60" data-toggle="dropdown" data-display="static">
                            <?php if ($_SESSION['currency'] == 'USD') { ?>
                                U.S. Dollar $
                            <?php } else { ?>
                                Việt Nam (VND)
                            <?php } ?>


                        </a>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                            <li>
                                <a class="dropdown-item  <?= $_SESSION['currency'] == 'USD' ? 'active' : '' ?> " href="javascript:void(0)" data-currency="USD">U.S. Dollar ($)</a>
                            </li>
                            <!-- <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="CAD">Canadian Dollar ($)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="DKK">Danish Krone (kr)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="EUR">Euro (€)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="HKD">Hong Kong Dollar ($)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="JPY">Japanese Yen (¥)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="NZD">New Zealand Dollar ($)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="PHP">Philippine Peso (₱)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="GBP">Pound Sterling (£)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="RUB">Russian Ruble (руб)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="SGD">Singapore Dollar ($)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="CHF">Swiss Franc (CHF)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="THB">Thai Baht (฿)</a>
                            </li>
                            <li>
                                <a class="dropdown-item " href="javascript:void(0)" data-currency="KRW">Korea (₩)</a>
                            </li> -->
                            <li>
                                <a class="dropdown-item <?= $_SESSION['currency'] == 'VND' ? 'active' : '' ?>" href="javascript:void(0)" data-currency="VND">Việt Nam (VND)</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-5 text-right d-none d-lg-block">

                <ul class="list-inline mb-0 h-100 d-flex justify-content-end align-items-center">
                    <!--<li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                            <a href="tel:https://secure.livechatinc.com/licence/17724141/v2/open_chat.cgi" class="text-reset d-inline-block opacity-60 py-2">
                                <i class="la la-phone"></i>
                                <span>Help line</span>  
                                <span>https://secure.livechatinc.com/licence/17724141/v2/open_chat.cgi</span>    
                            </a>
                        </li>-->
                    <?php if (!$isLogin) { ?>
                        <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                            <a href="/users/login" class="text-reset d-inline-block opacity-60 py-2"><?= tran("Login") ?></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/users/registration" class="text-reset d-inline-block opacity-60 py-2"><?= tran("Registration") ?></a>
                        </li>
                    <?php } else { ?>
                        <!--<li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                            <a href="tel:https://secure.livechatinc.com/licence/17724141/v2/open_chat.cgi" class="text-reset d-inline-block opacity-60 py-2">
                                <i class="la la-phone"></i>
                                <span>Help line</span>  
                                <span>https://secure.livechatinc.com/licence/17724141/v2/open_chat.cgi</span>    
                            </a>
                        </li>-->

                        <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0 dropdown">
                            <a class="dropdown-toggle no-arrow text-reset" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="">
                                    <span class="position-relative d-inline-block">
                                        <i class="las la-bell fs-18"></i>
                                    </span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg py-0">
                                <div class="p-3 bg-light border-bottom">
                                    <h6 class="mb-0"><?= tran("Notifications") ?></h6>
                                </div>
                                <div class="px-3 c-scrollbar-light overflow-auto " style="max-height:300px;">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="py-4 text-center fs-16">
                                                <?= tran("No notification found") ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-center border-top">
                                    <a href="/all-notifications" class="text-reset d-block py-2">
                                        <?= tran("View All Notifications") ?>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="list-inline-item mr-3 border-right border-left-0 pr-3 pl-0">
                            <a href="/<?= $isSeller ? "seller" : ($isAdmin ? "admin" : "dashboard") ?>" class="text-reset d-inline-block opacity-60 py-2"><?= tran("My Panel") ?></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/logout" class="text-reset d-inline-block opacity-60 py-2"><?= tran("Logout") ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END Top Bar -->
<header class=" sticky-top  z-1020 bg-white border-bottom shadow-sm">


    <div class="position-relative logo-bar-area z-1">
        <div class="container">
            <div class="d-flex align-items-center">

                <div class="col-auto col-xl-3 pl-0 pr-3 d-flex align-items-center">
                    <a class="d-block py-20px mr-3 ml-0" href="/">
                        <img src="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg" alt="GMARKETVN" class="mw-100 h-30px h-md-40px" height="40">
                    </a>

                    <div class="d-none d-xl-block align-self-stretch category-menu-icon-box ml-auto mr-0">
                        <div class="h-100 d-flex align-items-center" id="category-menu-icon">
                            <div class="dropdown-toggle navbar-light bg-light h-40px w-50px pl-2 rounded border c-pointer">
                                <span class="navbar-toggler-icon"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-lg-none ml-auto mr-0">
                    <a class="p-2 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </a>
                </div>

                <div class="flex-grow-1 front-header-search d-flex align-items-center bg-white">
                    <div class="position-relative flex-grow-1">
                        <form action="/search" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="border-0 border-lg form-control" id="search" name="keyword" placeholder="<?= tran("I am shopping for") ?>..." autocomplete="off">
                                    <div class="input-group-append d-none d-lg-block">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">

                            </div>
                            <div id="search-content" class="text-left">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-none d-lg-none ml-3 mr-0">
                    <div class="nav-search-box">
                        <a href="#" class="nav-box-link">
                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                        </a>
                    </div>
                </div>

                <div class="d-none d-lg-block ml-3 mr-0">
                    <div class="" id="compare">
                        <a href="/compare" class="d-flex align-items-center text-reset">
                            <i class="la la-refresh la-2x opacity-80"></i>
                            <span class="flex-grow-1 ml-1">
                                <span class="badge badge-primary badge-inline badge-pill">0</span>
                                <span class="nav-box-text d-none d-xl-block opacity-70"><?= tran("Compare") ?></span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="d-none d-lg-block ml-3 mr-0">
                    <div class="" id="wishlist">
                        <a href="/wishlists" class="d-flex align-items-center text-reset">
                            <i class="la la-heart-o la-2x opacity-80"></i>
                            <span class="flex-grow-1 ml-1">
                                <span class="badge badge-primary badge-inline badge-pill">0</span>
                                <span class="nav-box-text d-none d-xl-block opacity-70"><?= tran("Wishlist") ?></span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="d-none d-lg-block  align-self-stretch ml-3 mr-0" data-hover="dropdown">
                    <div class="nav-cart-box dropdown h-100" id="cart_items">
                        <a href="javascript:void(0)" class="d-flex align-items-center text-reset h-100" data-toggle="dropdown"
                            data-display="static">
                            <i class="la la-shopping-cart la-2x opacity-80"></i>
                            <span class="flex-grow-1 ml-1">
                                <span class="badge badge-primary badge-inline badge-pill cart-count"><?= $count_cart ?></span>
                                <span class="nav-box-text d-none d-xl-block opacity-70"><?= tran("Cart") ?></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg p-0 stop-propagation">
                            <?php if ($count_cart == 0) { ?>
                                <div class="text-center p-3">
                                    <i class="las la-frown la-3x opacity-60 mb-3"></i>
                                    <h3 class="h6 fw-700"><?= tran("Your Cart is empty") ?></h3>
                                </div>
                            <?php } else { ?>
                                <div class="p-3 fs-15 fw-600 p-3 border-bottom">
                                    <?= tran("Cart Items") ?>
                                </div>
                                <ul class="h-250px overflow-auto c-scrollbar-light list-group list-group-flush">
                                    <?php
                                    $i = 0;
                                    foreach ($_SESSION['cart'] as $cart) {
                                        $i++; ?>
                                        <li class="list-group-item">
                                            <span class="d-flex align-items-center">
                                                <a href="/product/rhze9-C2Csm" class="text-reset d-flex align-items-center flex-grow-1">
                                                    <img src="<?= $cart['img'] ?>" data-src="<?= $cart['img'] ?>" class="img-fit size-60px rounded ls-is-cached lazyloaded" alt="Grass Rattan Teng Woven Storage Cabinet Drawer Woven Wardrobe Wardrobe Creative Bedside Locker Pastoral Rattan Home">
                                                    <span class="minw-0 pl-2 flex-grow-1">
                                                        <span class="fw-600 mb-1 text-truncate-2">
                                                            <?= $cart['name'] ?>
                                                        </span>
                                                        <span class=""><?= $cart['quantity'] ?>x</span>

                                                        <span class=""><?= $cart['price'] ?>$</span>
                                                    </span>
                                                </a>
                                                <span class="">
                                                    <button onclick="removeFromCart(<?= $i ?>)" class="btn btn-sm btn-icon stop-propagation">
                                                        <i class="la la-close"></i>
                                                    </button>
                                                </span>
                                            </span>
                                        </li>
                                    <?php } ?>


                                </ul>
                                <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between">
                                    <span class="opacity-60"><?= tran("Subtotal") ?></span>
                                    <span class="fw-600"><?= $total_cart ?>$</span>
                                </div>
                                <div class="px-3 py-2 text-center border-top">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="/cart" class="btn btn-soft-primary btn-sm">
                                                <?= tran("View cart") ?>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="/checkout" class="btn btn-primary btn-sm">
                                                <?= tran("Checkout") ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    <?php } ?>




                    </div>
                </div>

            </div>
        </div>
        <div class="hover-category-menu position-absolute w-100 top-100 left-0 right-0 d-none z-3" id="hover-category-menu">
            <div class="container">
                <div class="row gutters-10 position-relative">
                    <div class="col-lg-3 position-static">
                        <div class="aiz-category-menu bg-white rounded  shadow-lg" id="category-sidebar">
                            <div class="p-3 bg-soft-primary d-none d-lg-block rounded-top all-category position-relative text-left">
                                <span class="fw-600 fs-16 mr-3"><?= tran("Categories") ?></span>
                                <a href="/categories" class="text-reset">
                                    <span class="d-none d-lg-inline-block"><?= tran("See All") ?> ></span>
                                </a>
                            </div>
                            <ul class="list-unstyled categories no-scrollbar py-2 mb-0 text-left">
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM categories ");
                                while ($row = fetch_assoc($sql)) {
                                ?>


                                    <li class="category-nav-element" data-id="14">
                                        <a href="/category/<?= $row['path'] ?>" class="text-truncate text-reset py-2 px-3 d-block">
                                            <img
                                                class="cat-image lazyload mr-2 opacity-60"
                                                src="/public/assets/img/placeholder.jpg"
                                                data-src="/public/uploads/all/<?= $row['img'] ?>"
                                                width="16"
                                                alt="<?= $row['name'] ?>"
                                                onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">
                                            <span class="cat-name"><?= $row['name'] ?></span>
                                        </a>
                                    </li>

                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white border-top border-gray-200 py-1">
        <div class="container">
            <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                <!-- <li class="list-inline-item mr-0">
                    <a href="https://www.lotte.co.kr/global/en/main.do#firstPage" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Lotte
                    </a>
                </li> -->
                <li class="list-inline-item mr-0">
                    <a href="https://www.thefaceshop.com/mall/index.jsp" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        The Face Shop
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://ohui.com/" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Ohui
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://www.samsung.com/ae/smartphones/galaxy-s24/buy/?cid=ae_pd_ppc_google_f1h24_sustain_f1h24_stads_multi_bap_ae_en_na_wh_lo_cross_mx_performance-max_multi_kew__conv&amp;utm_campaign=f1h24&amp;utm_medium=pd_ppc&amp;utm_source=google&amp;utm_content=ae_f1h24_sustain_f1h24_stads_multi_bap_ae_en_na_wh_lo_cross_mx_performance-max_multi_kew__conv&amp;gad_source=1&amp;gclid=Cj0KCQjw3ZayBhDRARIsAPWzx8pvR2F2IPgx2Qzs9QBADNyuFeSSoCQOIEPqAIzCs1-jnabv6i2rV5UaArC1EALw_wcB&amp;gclsrc=aw.ds" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Samsung
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://www.lge.co.kr/" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        LG
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://www.cuckoo.co.kr/" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Cuckoo
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://kye-official.com/" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Kye
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://harriotwatches.com/" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Harriot
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://www.altivo.com/collections/dogfight" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Dogfight
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://koreantoyshop.com/toytron/" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Toytron
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://www.lotteon.com/p/display/main/toysrus?mall_no=9&amp;ch_no=100325&amp;ch_dtl_no=1000840&amp;utm_source=google&amp;utm_medium=cpc&amp;utm_term=%EC%9E%90%EC%82%AC%EB%B8%8C%EB%9E%9C%EB%93%9C&amp;utm_campaign=paid_google_cpc_pc&amp;gad_source=1&amp;gclid=Cj0KCQjw3ZayBhDRARIsAPWzx8pezexdw0n1Il9JIHUG0ISMVnWjkiRvSV_o6SVC8wyDIPvtlYTA2XgaAnmlEALw_wcB" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Toys &#039;R&#039; Us
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a href="https://ruche.vn/minervamade-in-korea" class="opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">
                        Ruche
                    </a>
                </li>
            </ul>
        </div>
    </div>

</header>

<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>


<body>
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column">