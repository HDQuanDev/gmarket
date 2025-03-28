<?php include("./config.php");if(!$isLogin)header("Location: /users/login");else if($isSeller) header("Location: /seller/index.php")?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="csrf-token" content="SIMyi3CQKTA1LH5K7ZwJcHY3qsy2D7IbmfYhtWZi">
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
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-core.css">
    <link rel="stylesheet" href="/public/assets/css/custom-style.css">


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

<body>
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column">

        <!-- Header -->
        
        <?php include("./layout/header.php")?>

       


        <section class="py-5">
            <div class="container">
                <div class="d-flex align-items-start">
                    <div class="aiz-user-sidenav-wrap position-relative z-1 shadow-sm">
                        <div class="aiz-user-sidenav rounded overflow-auto c-scrollbar-light pb-5 pb-xl-0">
                            <div class="p-4 text-xl-center mb-4 border-bottom bg-primary text-white position-relative">
                                <span class="avatar avatar-md mb-3">
                                    <img src="/public/assets/img/avatar-place.png" class="image rounded-circle"
                                        onerror="this.onerror=null;this.src='/public/assets/img/avatar-place.png';">
                                </span>
                                <h4 class="h5 fs-16 mb-1 fw-600"><?=$user_email?></h4>
                                <div class="text-truncate opacity-60"><?=$user_email?></div>
                            </div>

                            <div class="sidemnenu mb-3">
                                <?php include("./layout/user_sidemnenu.php")?>
                            </div>

                        </div>

                        <div class="fixed-bottom d-xl-none bg-white border-top d-flex justify-content-between px-2"
                            style="box-shadow: 0 -5px 10px rgb(0 0 0 / 10%);">
                            <a class="btn btn-sm p-2 d-flex align-items-center" href="/logout">
                                <i class="las la-sign-out-alt fs-18 mr-2"></i>
                                <span>Logout</span>
                            </a>
                            <button class="btn btn-sm p-2 " data-toggle="class-toggle" data-backdrop="static"
                                data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
                                <i class="las la-times la-2x"></i>
                            </button>
                        </div>
                    </div>
                    <div class="aiz-user-panel">
                        <div class="aiz-titlebar mt-2 mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <b class="h4">Wishlist</b>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters-5">
                            <div class="col-xxl-3 col-xl-4 col-lg-3 col-md-4 col-sm-6" id="wishlist_13">
                                <div class="card mb-2 shadow-sm">
                                    <div class="card-body">
                                        <a href="https://gmarketagents.com/product/iphone-15-pro-max-v7yQp" class="d-block mb-3">
                                            <img src="https://gmarketagents.com/public/uploads/all/rzUAOzUAIyll8X8G6OhQnbwTE30826gUZt4bx542.jpg" class="img-fit h-140px h-md-200px">
                                        </a>

                                        <h5 class="fs-14 mb-0 lh-1-5 fw-600 text-truncate-2">
                                            <a href="https://gmarketagents.com/product/iphone-15-pro-max-v7yQp" class="text-reset">Iphone 15 pro max</a>
                                        </h5>
                                        <div class="rating rating-sm mb-1">
                                            <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                        </div>
                                        <div class=" fs-14">
                                            <del class="opacity-60 mr-1">999.00$</del>
                                            <span class="fw-600 text-primary">849.15$</span>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist(13)">
                                            <i class="la la-trash la-2x"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-block btn-primary ml-3" onclick="showAddToCartModal(90922)">
                                            <i class="la la-shopping-cart mr-2"></i>Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aiz-pagination">

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white border-top mt-auto">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-3 col-md-6">
                        <a class="text-reset border-left text-center p-4 d-block" href="/terms">
                            <i class="la la-file-text la-3x text-primary mb-2"></i>
                            <h4 class="h6">Terms &amp; conditions</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a class="text-reset border-left text-center p-4 d-block" href="/return-policy">
                            <i class="la la-mail-reply la-3x text-primary mb-2"></i>
                            <h4 class="h6">Return policy</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a class="text-reset border-left text-center p-4 d-block" href="/support-policy">
                            <i class="la la-support la-3x text-primary mb-2"></i>
                            <h4 class="h6">Support Policy</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a class="text-reset border-left border-right text-center p-4 d-block" href="/privacy-policy">
                            <i class="las la-exclamation-circle la-3x text-primary mb-2"></i>
                            <h4 class="h6">Privacy policy</h4>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-dark py-5 text-light footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-xl-4 text-center text-md-left">
                        <div class="mt-4">
                            <a href="" class="d-block">
                                <img class="lazyload" src="/public/assets/img/placeholder-rect.jpg" data-src="/public/uploads/all/d2grNsNYud5xW9aMD2v99SwZSmYSsJMOhS42eSBs.jpg" alt="GMARKETVN" height="44">
                            </a>
                            <div class="my-3">

                            </div>
                            <div class="d-inline-block d-md-block mb-4">
                                <form class="form-inline" method="POST" action="/subscribers">
                                    <input type="hidden" name="_token" value="SIMyi3CQKTA1LH5K7ZwJcHY3qsy2D7IbmfYhtWZi">
                                    <div class="form-group mb-0">
                                        <input type="email" class="form-control" placeholder="Your Email Address" name="email" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Subscribe
                                    </button>
                                </form>
                            </div>
                            <div class="w-300px mw-100 mx-auto mx-md-0">
                                <a href="/" target="_blank" class="d-inline-block mr-3 ml-0">
                                    <img src="/public/assets/img/play.png" class="mx-100 h-40px">
                                </a>
                                <a href="/" target="_blank" class="d-inline-block">
                                    <img src="/public/assets/img/app.png" class="mx-100 h-40px">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 ml-xl-auto col-md-4 mr-0">
                        <div class="text-center text-md-left mt-4">
                            <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                                Contact Info
                            </h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="d-block opacity-30">Address:</span>
                                    <span class="d-block opacity-70">Số 18 đường Phan Khiêm Ích, Phường Tân Phong, Quận 7, Thành phố Hồ Chí Minh, Việt Nam</span>
                                </li>
                                <li class="mb-2">
                                    <span class="d-block opacity-30">Phone:</span>
                                    <span class="d-block opacity-70">1900 252 656</span>
                                </li>
                                <li class="mb-2">
                                    <span class="d-block opacity-30">Email:</span>
                                    <span class="d-block opacity-70">
                                        <a href="/cdn-cgi/l/email-protection#ddabb4b8a9b3bcb0bab0bcafb6b8a9edebe59dbab0bcb4b1f3beb2b0" class="text-reset"><span class="__cf_email__" data-cfemail="1f69767a6b717e7278727e6d747a6b2f29275f78727e7673317c7072">[email&#160;protected]</span></a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-2">
                        <div class="text-center text-md-left mt-4">
                            <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                                My Account
                            </h4>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a class="opacity-50 hov-opacity-100 text-reset" href="/logout">
                                        Logout
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="opacity-50 hov-opacity-100 text-reset" href="/purchase_history">
                                        Order History
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="opacity-50 hov-opacity-100 text-reset" href="/wishlists">
                                        My Wishlist
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="opacity-50 hov-opacity-100 text-reset" href="/track-your-order">
                                        Track Order
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="opacity-50 hov-opacity-100 text-light" href="/affiliate">Be an affiliate partner</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <!--<div class="text-center text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        
                    </h4>
<ul class="list-unstyled">
    </ul>

                </div>-->
                        <div class="text-center text-md-left mt-4">
                            <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                                Be A Seller
                            </h4>
                            <p>Become seller in our website</p>
                            <a href="/shops/create" class="btn btn-primary btn-sm shadow-md">
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="pt-3 pb-7 pb-xl-3 bg-black text-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="text-center text-md-left" current-verison="7.4.0">

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <ul class="list-inline my-3 my-md-0 social colored text-center">
                            <li class="list-inline-item">
                                <a href="#" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-center text-md-right">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/x2PNOaOS6VXSI1SGozrjHtZ1yVp8Mfq9RXB0yD8H.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/4qF2PJQHw5rtlmeiwtP0Rk2o9KjsFyfLdZ2pUsPg.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/davn6mDDhwClwSzwT1PRuDSotpyAhm1Uyh7hyoqC.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/4fvIoubXi7wTPla0GJInJXaeuiDevlXxmvkQDBAT.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/mPc42zjeqLErWAyTks76Vgc2mNq6oqjPQmSiRo0n.webp" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/1ZZ6ccmeWUOBii7WEvFnVpnzY2q0I5xhe06pOI4T.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/2JRFnzKLOnt81chRISVQBKLADNBdRDMEVmls3dU2.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/VwEOJNH2n3FNDi1dgUpvOvbGNS0oKaYZVjn9GnMy.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/dqpOssMysk0H5ovefvOUM2aF0O1UhR6rmzx5jBRx.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/OT3aJXJBsq4xHaubKHYwVWm35iUI7zFqRSqkOZ7E.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/hhjvgBFNlxrifyeRE2oVohk6kAmg3drnXCTqSQIl.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                                <li class="list-inline-item">
                                    <img src="/public/uploads/all/nd0NuuOseK1RY4dGaUKR9r6HrLsFQlHUSNJa5aS3.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
            <div class="row align-items-center gutters-5">
                <div class="col">
                    <a href="" class="text-reset d-block text-center pb-2 pt-3">
                        <i class="las la-home fs-20 opacity-60 "></i>
                        <span class="d-block fs-10 fw-600 opacity-60 ">Home</span>
                    </a>
                </div>
                <div class="col">
                    <a href="/categories" class="text-reset d-block text-center pb-2 pt-3">
                        <i class="las la-list-ul fs-20 opacity-60 "></i>
                        <span class="d-block fs-10 fw-600 opacity-60 ">Categories</span>
                    </a>
                </div>
                <div class="col-auto">
                    <a href="/cart" class="text-reset d-block text-center pb-2 pt-3">
                        <span class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px" style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                            <i class="las la-shopping-bag la-2x text-white"></i>
                        </span>
                        <span class="d-block mt-1 fs-10 fw-600 opacity-60 ">
                            Cart
                            (<span class="cart-count">2</span>)
                        </span>
                    </a>
                </div>
                <div class="col">
                    <a href="/all-notifications" class="text-reset d-block text-center pb-2 pt-3">
                        <span class="d-inline-block position-relative px-2">
                            <i class="las la-bell fs-20 opacity-60 "></i>
                        </span>
                        <span class="d-block fs-10 fw-600 opacity-60 ">Notifications</span>
                    </a>
                </div>
                <div class="col">
                    <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                        <span class="d-block mx-auto">
                            <img src="/public/assets/img/avatar-place.png" class="rounded-circle size-20px">
                        </span>
                        <span class="d-block fs-10 fw-600 opacity-60">Account</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
            <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
            <div class="collapse-sidebar bg-white">
                <div class="aiz-user-sidenav-wrap position-relative z-1 shadow-sm">
                    <div class="aiz-user-sidenav rounded overflow-auto c-scrollbar-light pb-5 pb-xl-0">
                        <div class="p-4 text-xl-center mb-4 border-bottom bg-primary text-white position-relative">
                            <span class="avatar avatar-md mb-3">
                                <img src="/public/assets/img/avatar-place.png" class="image rounded-circle"
                                    onerror="this.onerror=null;this.src='/public/assets/img/avatar-place.png';">
                            </span>
                            <h4 class="h5 fs-16 mb-1 fw-600"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="cbfaf9f8fffe8bace5ac">[email&#160;protected]</a></h4>
                            <div class="text-truncate opacity-60"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e9d8dbdadddca98ec78e">[email&#160;protected]</a></div>
                        </div>

                        <div class="sidemnenu mb-3">
                            <ul class="aiz-side-nav-list px-2" data-toggle="aiz-side-menu">

                                <li class="aiz-side-nav-item">
                                    <a href="/dashboard" class="aiz-side-nav-link ">
                                        <i class="las la-home aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Dashboard</span>
                                    </a>
                                </li>

                                <li class="aiz-side-nav-item">
                                    <a href="/purchase_history"
                                        class="aiz-side-nav-link ">
                                        <i class="las la-file-alt aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Purchase History</span>
                                    </a>
                                </li>

                                <li class="aiz-side-nav-item">
                                    <a href="/digital-purchase-history"
                                        class="aiz-side-nav-link ">
                                        <i class="las la-download aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Downloads</span>
                                    </a>
                                </li>


                                <li class="aiz-side-nav-item">
                                    <a href="/wishlists"
                                        class="aiz-side-nav-link active">
                                        <i class="la la-heart-o aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Wishlist</span>
                                    </a>
                                </li>

                                <li class="aiz-side-nav-item">
                                    <a href="/compare" class="aiz-side-nav-link ">
                                        <i class="la la-refresh aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Compare</span>
                                    </a>
                                </li>

                                <li class="aiz-side-nav-item">
                                    <a href="/customer_products"
                                        class="aiz-side-nav-link ">
                                        <i class="lab la-sketch aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Classified Products</span>
                                    </a>
                                </li>


                                <li class="aiz-side-nav-item">
                                    <a href="/conversations"
                                        class="aiz-side-nav-link ">
                                        <i class="las la-comment aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Conversations</span>
                                    </a>
                                </li>


                                <li class="aiz-side-nav-item">
                                    <a href="/wallet"
                                        class="aiz-side-nav-link ">
                                        <i class="las la-dollar-sign aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">My Wallet</span>
                                    </a>
                                </li>





                                <li class="aiz-side-nav-item">
                                    <a href="/support_ticket"
                                        class="aiz-side-nav-link ">
                                        <i class="las la-atom aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Support Ticket</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="/profile" class="aiz-side-nav-link ">
                                        <i class="las la-user aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Manage Profile</span>
                                    </a>
                                </li>

                                <li class="aiz-side-nav-item">
                                    <a href="#" onclick="account_delete_confirm_modal('/account-deletion')" class="aiz-side-nav-link">
                                        <i class="las la-user aiz-side-nav-icon"></i>
                                        <span class="aiz-side-nav-text">Delete My Account</span>
                                    </a>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="fixed-bottom d-xl-none bg-white border-top d-flex justify-content-between px-2"
                        style="box-shadow: 0 -5px 10px rgb(0 0 0 / 10%);">
                        <a class="btn btn-sm p-2 d-flex align-items-center" href="/logout">
                            <i class="las la-sign-out-alt fs-18 mr-2"></i>
                            <span>Logout</span>
                        </a>
                        <button class="btn btn-sm p-2 " data-toggle="class-toggle" data-backdrop="static"
                            data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
                            <i class="las la-times la-2x"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="aiz-cookie-alert shadow-xl">
        <div class="p-3 bg-dark rounded">
            <div class="text-white mb-3">
                <b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; WELCOME TO&nbsp;<br></b>&nbsp; &nbsp; &nbsp; &nbsp;<a href="https://english.visitseoul.net/index" target="_blank"><b>GMARKET VIET NAM </b><br>&nbsp;</a>
            </div>
            <button class="btn btn-primary aiz-cookie-accept">
                Ok. I Understood
            </button>
        </div>
    </div>

    <div class="modal website-popup removable-session d-none" data-key="website-popup" data-value="removed">
        <div class="absolute-full bg-black opacity-60"></div>
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md">
            <div class="modal-content position-relative border-0 rounded-0 pb-5 pt-4 px-5">
                <div class="aiz-editor-data">
                    <div style="text-align: center;"><b style="background-color: rgb(255, 255, 0);">BECOME AN EXCELLENT SALES AGENT OF GMARKET VIET NAM, YOU WILL BE HONORABLE TO VISIT THE LARGEST MERCHANDISE WAREHOUSES IN SEOUL, KOREA</b></div>
                    <div style="text-align: center; "><u><b>GOOD LUCK TO SALES AGENTS!</b></u></div>
                </div>
                <div class="pt-4">
                    <form class="" method="POST" action="/subscribers">
                        <input type="hidden" name="_token" value="SIMyi3CQKTA1LH5K7ZwJcHY3qsy2D7IbmfYhtWZi">
                        <div class="form-group mb-0">
                            <input type="email" class="form-control" placeholder="Your Email Address" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">
                            Subscribe Now
                        </button>
                    </form>
                </div>
                <button class="absolute-top-right bg-white shadow-lg btn btn-circle btn-icon mr-n3 mt-n3 set-session" data-key="website-popup" data-value="removed" data-toggle="remove-parent" data-parent=".website-popup">
                    <i class="la la-close fs-20"></i>
                </button>
            </div>
        </div>
    </div>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script>
        function confirm_modal(delete_url) {
            jQuery('#confirm-delete').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('delete_link').setAttribute('href', delete_url);
        }
    </script>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>

                <div class="modal-body">
                    <p>Delete confirmation message</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="delete_link" class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function account_delete_confirm_modal(delete_url) {
            jQuery('#account_delete_confirm').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('account_delete_link').setAttribute('href', delete_url);
        }
    </script>

    <div class="modal fade" id="account_delete_confirm" tabindex="-1" role="dialog" aria-labelledby="account_delete_confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header d-block py-4">
                    <div class="d-flex justify-content-center">
                        <span class="avatar avatar-md mb-2 mt-2">
                            <img src="/public/assets/img/avatar-place.png" class="image rounded-circle m-auto"
                                onerror="this.onerror=null;this.src='/public/assets/img/avatar-place.png';">
                        </span>
                    </div>
                    <h4 class="modal-title text-center fw-700" id="account_delete_confirmModalLabel" style="color: #ff9819;">Delete Your Account</h4>
                    <p class="fs-16 fw-600 text-center" style="color: #8d8d8d;">Warning: You cannot undo this action</p>
                </div>

                <div class="modal-body pt-3 pb-5 px-xl-5">
                    <p class="text-danger mt-3"><i><strong>Note:&nbsp;Don&#039;t Click to any button or don&#039;t do any action during account Deletion, it may takes some times.</strong></i></p>
                    <p class="fs-14 fw-700" style="color: #8d8d8d;">Deleting Account Means:</p>
                    <div class="row bg-soft-warning py-2 mb-2 ml-0 mr-0 border-left border-width-2 border-danger">
                        <div class="col-1">
                            <img src="/public/assets/img/warning.png" class="h-20px">
                        </div>
                        <div class="col">
                            <p class="fw-600 mb-0">If you create any classified ptoducts, after deleting your account, those products will no longer in our system</p>
                        </div>
                    </div>
                    <div class="row bg-soft-warning py-3 ml-0 mr-0 border-left border-width-2 border-danger">
                        <div class="col-1">
                            <img src="/public/assets/img/warning.png" class="h-20px">
                        </div>
                        <div class="col">
                            <p class="fw-600 mb-0">After deleting your account, wallet balance no longer in our system</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="account_delete_link" class="btn btn-danger btn-rounded btn-ok">Delete Account</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader text-center p-3">
                    <i class="las la-spinner la-spin la-3x"></i>
                </div>
                <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la-2x">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>


    <!-- SCRIPTS -->
    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>




    <script>
    </script>

    <script>
        $(document).ready(function() {
            $('.category-nav-element').each(function(i, el) {
                $(el).on('mouseover', function() {
                    if (!$(el).find('.sub-cat-menu').hasClass('loaded')) {
                        $.post('/category/nav-element-list', {
                            _token: AIZ.data.csrf,
                            id: $(el).data('id')
                        }, function(data) {
                            $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                        });
                    }
                });
            });
            if ($('#lang-change').length > 0) {
                $('#lang-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        var locale = $this.data('flag');
                        $.post('/language', {
                            _token: AIZ.data.csrf,
                            locale: locale
                        }, function(data) {
                            location.reload();
                        });

                    });
                });
            }

            if ($('#currency-change').length > 0) {
                $('#currency-change .dropdown-menu a').each(function() {
                    $(this).on('click', function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        var currency_code = $this.data('currency');
                        $.post('/currency', {
                            _token: AIZ.data.csrf,
                            currency_code: currency_code
                        }, function(data) {
                            location.reload();
                        });

                    });
                });
            }
        });

        $('#search').on('keyup', function() {
            search();
        });

        $('#search').on('focus', function() {
            search();
        });

        function search() {
            var searchKey = $('#search').val();
            if (searchKey.length > 0) {
                $('body').addClass("typed-search-box-shown");

                $('.typed-search-box').removeClass('d-none');
                $('.search-preloader').removeClass('d-none');
                $.post('/ajax-search', {
                    _token: AIZ.data.csrf,
                    search: searchKey
                }, function(data) {
                    if (data == '0') {
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"' + searchKey + '"</strong>');
                        $('.search-preloader').addClass('d-none');

                    } else {
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
            } else {
                $('.typed-search-box').addClass('d-none');
                $('body').removeClass("typed-search-box-shown");
            }
        }

        function updateNavCart(view, count) {
            $('.cart-count').html(count);
            $('#cart_items').html(view);
        }

        function removeFromCart(key) {
            $.post('/cart/removeFromCart', {
                _token: AIZ.data.csrf,
                id: key
            }, function(data) {
                updateNavCart(data.nav_cart_view, data.cart_count);
                $('#cart-summary').html(data.cart_view);
                AIZ.plugins.notify('success', "Item has been removed from cart");
                $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html()) - 1);
            });
        }

        function addToCompare(id) {
            $.post('/compare/addToCompare', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {
                $('#compare').html(data);
                AIZ.plugins.notify('success', "Item has been added to compare list");
                $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html()) + 1);
            });
        }

        function addToWishList(id) {
            $.post('/wishlists', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {
                if (data != 0) {
                    $('#wishlist').html(data);
                    AIZ.plugins.notify('success', "Item has been added to wishlist");
                } else {
                    AIZ.plugins.notify('warning', "Please login first");
                }
            });
        }

        function showAddToCartModal(id) {
            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('/cart/show-cart-modal', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {
                $('.c-preloader').hide();
                $('#addToCart-modal-body').html(data);
                AIZ.plugins.slickCarousel();
                AIZ.plugins.zoom();
                AIZ.extra.plusMinus();
                getVariantPrice();
            });
        }

        $('#option-choice-form input').on('change', function() {
            getVariantPrice();
        });

        function getVariantPrice() {
            if ($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
                $.ajax({
                    type: "POST",
                    url: '/product/variant_price',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {

                        $('.product-gallery-thumb .carousel-box').each(function(i) {
                            if ($(this).data('variation') && data.variation == $(this).data('variation')) {
                                $('.product-gallery-thumb').slick('slickGoTo', i);
                            }
                        })

                        $('#option-choice-form #chosen_price_div').removeClass('d-none');
                        $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                        $('#available-quantity').html(data.quantity);
                        $('.input-number').prop('max', data.max_limit);
                        if (parseInt(data.in_stock) == 0 && data.digital == 0) {
                            $('.buy-now').addClass('d-none');
                            $('.add-to-cart').addClass('d-none');
                            $('.out-of-stock').removeClass('d-none');
                        } else {
                            $('.buy-now').removeClass('d-none');
                            $('.add-to-cart').removeClass('d-none');
                            $('.out-of-stock').addClass('d-none');
                        }

                        AIZ.extra.plusMinus();
                    }
                });
            }
        }

        function checkAddToCartValidity() {
            var names = {};
            $('#option-choice-form input:radio').each(function() { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                count++;
            });

            if ($('#option-choice-form input:radio:checked').length == count) {
                return true;
            }

            return false;
        }

        function addToCart() {

            if (checkAddToCartValidity()) {
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type: "POST",
                    url: '/cart/addtocart',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {

                        $('#addToCart-modal-body').html(null);
                        $('.c-preloader').hide();
                        $('#modal-size').removeClass('modal-lg');
                        $('#addToCart-modal-body').html(data.modal_view);
                        AIZ.extra.plusMinus();
                        AIZ.plugins.slickCarousel();
                        updateNavCart(data.nav_cart_view, data.cart_count);
                    }
                });
            } else {
                AIZ.plugins.notify('warning', "Please choose all the options");
            }
        }

        function buyNow() {

            if (checkAddToCartValidity()) {
                $('#addToCart-modal-body').html(null);
                $('#addToCart').modal();
                $('.c-preloader').show();
                $.ajax({
                    type: "POST",
                    url: '/cart/addtocart',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        if (data.status == 1) {

                            $('#addToCart-modal-body').html(data.modal_view);
                            updateNavCart(data.nav_cart_view, data.cart_count);

                            window.location.replace("/cart");
                        } else {
                            $('#addToCart-modal-body').html(null);
                            $('.c-preloader').hide();
                            $('#modal-size').removeClass('modal-lg');
                            $('#addToCart-modal-body').html(data.modal_view);
                        }
                    }
                });
            } else {
                AIZ.plugins.notify('warning', "Please choose all the options");
            }
        }
    </script>

    <script type="text/javascript">
        function removeFromWishlist(id) {
            $.post('/wishlists/remove', {
                _token: 'SIMyi3CQKTA1LH5K7ZwJcHY3qsy2D7IbmfYhtWZi',
                id: id
            }, function(data) {
                $('#wishlist').html(data);
                $('#wishlist_' + id).hide();
                AIZ.plugins.notify('success', 'Item has been renoved from wishlist');
            })
        }
    </script>

    GMARKETVN IS HONORABLE TO ACCOMPANY YOU !<script type='text/javascript'>
        var $jscomp = $jscomp || {};
        $jscomp.scope = {};
        $jscomp.arrayIteratorImpl = function(b) {
            var d = 0;
            return function() {
                return d < b.length ? {
                    done: !1,
                    value: b[d++]
                } : {
                    done: !0
                }
            }
        };
        $jscomp.arrayIterator = function(b) {
            return {
                next: $jscomp.arrayIteratorImpl(b)
            }
        };
        $jscomp.ASSUME_ES5 = !1;
        $jscomp.ASSUME_NO_NATIVE_MAP = !1;
        $jscomp.ASSUME_NO_NATIVE_SET = !1;
        $jscomp.SIMPLE_FROUND_POLYFILL = !1;
        $jscomp.defineProperty = $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties ? Object.defineProperty : function(b, d, a) {
            b != Array.prototype && b != Object.prototype && (b[d] = a.value)
        };
        $jscomp.getGlobal = function(b) {
            return "undefined" != typeof window && window === b ? b : "undefined" != typeof global && null != global ? global : b
        };
        $jscomp.global = $jscomp.getGlobal(this);
        $jscomp.SYMBOL_PREFIX = "jscomp_symbol_";
        $jscomp.initSymbol = function() {
            $jscomp.initSymbol = function() {};
            $jscomp.global.Symbol || ($jscomp.global.Symbol = $jscomp.Symbol)
        };
        $jscomp.Symbol = function() {
            var b = 0;
            return function(d) {
                return $jscomp.SYMBOL_PREFIX + (d || "") + b++
            }
        }();
        $jscomp.initSymbolIterator = function() {
            $jscomp.initSymbol();
            var b = $jscomp.global.Symbol.iterator;
            b || (b = $jscomp.global.Symbol.iterator = $jscomp.global.Symbol("iterator"));
            "function" != typeof Array.prototype[b] && $jscomp.defineProperty(Array.prototype, b, {
                configurable: !0,
                writable: !0,
                value: function() {
                    return $jscomp.iteratorPrototype($jscomp.arrayIteratorImpl(this))
                }
            });
            $jscomp.initSymbolIterator = function() {}
        };
        $jscomp.initSymbolAsyncIterator = function() {
            $jscomp.initSymbol();
            var b = $jscomp.global.Symbol.asyncIterator;
            b || (b = $jscomp.global.Symbol.asyncIterator = $jscomp.global.Symbol("asyncIterator"));
            $jscomp.initSymbolAsyncIterator = function() {}
        };
        $jscomp.iteratorPrototype = function(b) {
            $jscomp.initSymbolIterator();
            b = {
                next: b
            };
            b[$jscomp.global.Symbol.iterator] = function() {
                return this
            };
            return b
        };
        $jscomp.iteratorFromArray = function(b, d) {
            $jscomp.initSymbolIterator();
            b instanceof String && (b += "");
            var a = 0,
                c = {
                    next: function() {
                        if (a < b.length) {
                            var e = a++;
                            return {
                                value: d(e, b[e]),
                                done: !1
                            }
                        }
                        c.next = function() {
                            return {
                                done: !0,
                                value: void 0
                            }
                        };
                        return c.next()
                    }
                };
            c[Symbol.iterator] = function() {
                return c
            };
            return c
        };
        $jscomp.polyfill = function(b, d, a, c) {
            if (d) {
                a = $jscomp.global;
                b = b.split(".");
                for (c = 0; c < b.length - 1; c++) {
                    var e = b[c];
                    e in a || (a[e] = {});
                    a = a[e]
                }
                b = b[b.length - 1];
                c = a[b];
                d = d(c);
                d != c && null != d && $jscomp.defineProperty(a, b, {
                    configurable: !0,
                    writable: !0,
                    value: d
                })
            }
        };
        $jscomp.polyfill("Array.prototype.values", function(b) {
            return b ? b : function() {
                return $jscomp.iteratorFromArray(this, function(b, a) {
                    return a
                })
            }
        }, "es8", "es3");
        $jscomp.findInternal = function(b, d, a) {
            b instanceof String && (b = String(b));
            for (var c = b.length, e = 0; e < c; e++) {
                var l = b[e];
                if (d.call(a, l, e, b)) return {
                    i: e,
                    v: l
                }
            }
            return {
                i: -1,
                v: void 0
            }
        };
        $jscomp.polyfill("Array.prototype.find", function(b) {
            return b ? b : function(b, a) {
                return $jscomp.findInternal(this, b, a).v
            }
        }, "es6", "es3");
        (function(b) {
            function d(a, c) {
                this._initialized = !1;
                this.settings = null;
                this.popups = [];
                this.options = b.extend({}, d.Defaults, c);
                this.$element = b(a);
                this.init();
                this.y = this.x = 0;
                this._interval;
                this._callbackOpened = this._popupOpened = this._menuOpened = !1;
                this.countdown = null
            }
            d.Defaults = {
                activated: !1,
                pluginVersion: "2.0.1",
                wordpressPluginVersion: !1,
                align: "right",
                mode: "regular",
                countdown: 0,
                drag: !1,
                buttonText: "Contact us",
                buttonSize: "large",
                menuSize: "normal",
                buttonIcon: '<svg width="20" height="20" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-825 -308)"><g><path transform="translate(825 308)" fill="#FFFFFF" d="M 19 4L 17 4L 17 13L 4 13L 4 15C 4 15.55 4.45 16 5 16L 16 16L 20 20L 20 5C 20 4.45 19.55 4 19 4ZM 15 10L 15 1C 15 0.45 14.55 0 14 0L 1 0C 0.45 0 0 0.45 0 1L 0 15L 4 11L 14 11C 14.55 11 15 10.55 15 10Z"/></g></g></svg>',
                ajaxUrl: "server.php",
                action: "callback",
                phonePlaceholder: "+X-XXX-XXX-XX-XX",
                callbackSubmitText: "Waiting for call",
                reCaptcha: !1,
                reCaptchaAction: "callbackRequest",
                reCaptchaKey: "",
                errorMessage: "Connection error. Please try again.",
                callProcessText: "We are calling you to phone",
                callSuccessText: "Thank you.<br>We are call you back soon.",
                showMenuHeader: !1,
                menuHeaderText: "How would you like to contact us?",
                showHeaderCloseBtn: !0,
                menuInAnimationClass: "show-messageners-block",
                menuOutAnimationClass: "",
                eaderCloseBtnBgColor: "#787878",
                eaderCloseBtnColor: "#FFFFFF",
                items: [],
                itemsIconType: "rounded",
                iconsAnimationSpeed: 800,
                iconsAnimationPause: 2E3,
                promptPosition: "side",
                callbackFormFields: {
                    name: {
                        name: "name",
                        enabled: !0,
                        required: !0,
                        type: "text",
                        label: "Please enter your name",
                        placeholder: "Your full name"
                    },
                    email: {
                        name: "email",
                        enabled: !0,
                        required: !1,
                        type: "email",
                        label: "Enter your email address",
                        placeholder: "Optional field. Example: email@domain.com"
                    },
                    time: {
                        name: "time",
                        enabled: !0,
                        required: !1,
                        type: "dropdown",
                        label: "Please choose schedule time",
                        values: [{
                            value: "asap",
                            label: "Call me ASAP"
                        }, "00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"]
                    },
                    phone: {
                        name: "phone",
                        enabled: !0,
                        required: !0,
                        type: "tel",
                        label: "Please enter your phone number",
                        placeholder: "+X-XXX-XXX-XX-XX"
                    },
                    description: {
                        name: "description",
                        enabled: !0,
                        required: !1,
                        type: "textarea",
                        label: "Please leave a message with your request"
                    }
                },
                theme: "#000000",
                callbackFormText: "Please enter your phone number<br>and we call you back soon",
                closeIcon: '<svg width="12" height="13" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-4087 108)"><g><path transform="translate(4087 -108)" fill="currentColor" d="M 14 1.41L 12.59 0L 7 5.59L 1.41 0L 0 1.41L 5.59 7L 0 12.59L 1.41 14L 7 8.41L 12.59 14L 14 12.59L 8.41 7L 14 1.41Z"></path></g></g></svg>',
                callbackStateIcon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>'
            };
            d.prototype.init = function() {
                if (this._initialized) return !1;
                this.destroy();
                this.settings = b.extend({}, this.options);
                this.$element.addClass("arcontactus-widget").addClass("arcontactus-message");
                "left" === this.settings.align ? this.$element.addClass("left") : this.$element.addClass("right");
                this.settings.items.length ? (this.$element.append("\x3c!--noindex--\x3e"), this._initCallbackBlock(), "regular" == this.settings.mode && this._initMessengersBlock(), this.popups.length && this._initPopups(), this._initMessageButton(),
                    this._initPrompt(), this._initEvents(), this.startAnimation(), this.$element.append("\x3c!--/noindex--\x3e"), this.$element.addClass("active")) : console.info("jquery.contactus:no items");
                this._initialized = !0;
                this.$element.trigger("arcontactus.init")
            };
            d.prototype.destroy = function() {
                if (!this._initialized) return !1;
                this.$element.html("");
                this._initialized = !1;
                this.$element.trigger("arcontactus.destroy")
            };
            d.prototype._initCallbackBlock = function() {
                var a = b("<div>", {
                        class: "callback-countdown-block",
                        style: this._colorStyle()
                    }),
                    c = b("<div>", {
                        class: "callback-countdown-block-close",
                        style: "background-color:" + this.settings.theme + "; color: #FFFFFF"
                    });
                c.append(this.settings.closeIcon);
                var e = b("<div>", {
                    class: "callback-countdown-block-phone"
                });
                e.append("<p>" + this.settings.callbackFormText + "</p>");
                var d = b("<form>", {
                        id: "arcu-callback-form",
                        action: this.settings.ajaxUrl,
                        method: "POST"
                    }),
                    h = b("<div>", {
                        class: "callback-countdown-block-form-group"
                    }),
                    f = b("<input>", {
                        name: "action",
                        type: "hidden",
                        value: this.settings.action
                    }),
                    g = b("<input>", {
                        name: "gtoken",
                        class: "ar-g-token",
                        type: "hidden",
                        value: ""
                    });
                h.append(f);
                h.append(g);
                this._initCallbackFormFields(h);
                f = b("<div>", {
                    class: "arcu-form-group arcu-form-button"
                });
                g = b("<button>", {
                    id: "arcontactus-message-callback-phone-submit",
                    type: "submit",
                    style: this._backgroundStyle()
                });
                g.text(this.settings.callbackSubmitText);
                f.append(g);
                h.append(f);
                f = b("<div>", {
                    class: "callback-countdown-block-timer"
                });
                g = b("<p>" + this.settings.callProcessText + "</p>");
                var k = b("<div>", {
                    class: "callback-countdown-block-timer_timer"
                });
                f.append(g);
                f.append(k);
                g = b("<div>", {
                    class: "callback-countdown-block-sorry"
                });
                k = b("<p>" + this.settings.callSuccessText + "</p>");
                g.append(k);
                d.append(h);
                e.append(d);
                a.append(c);
                a.append(e);
                a.append(f);
                a.append(g);
                this.$element.append(a)
            };
            d.prototype._initCallbackFormFields = function(a) {
                var c = this;
                b.each(c.settings.callbackFormFields, function(e) {
                    var d = b("<div>", {
                            class: "arcu-form-group arcu-form-group-type-" + c.settings.callbackFormFields[e].type + " arcu-form-group-" + c.settings.callbackFormFields[e].name + (c.settings.callbackFormFields[e].required ?
                                " arcu-form-group-required" : "")
                        }),
                        h = "<input>";
                    switch (c.settings.callbackFormFields[e].type) {
                        case "textarea":
                            h = "<textarea>";
                            break;
                        case "dropdown":
                            h = "<select>"
                    }
                    if (c.settings.callbackFormFields[e].label) {
                        var f = b("<div>", {
                            class: "arcu-form-label"
                        });
                        f.html(c.settings.callbackFormFields[e].label);
                        d.append(f)
                    }
                    var g = b(h, {
                        name: c.settings.callbackFormFields[e].name,
                        class: "arcu-form-field arcu-field-" + c.settings.callbackFormFields[e].name,
                        required: c.settings.callbackFormFields[e].required,
                        type: "dropdown" == c.settings.callbackFormFields[e].type ?
                            null : c.settings.callbackFormFields[e].type,
                        value: ""
                    });
                    g.attr("placeholder", c.settings.callbackFormFields[e].placeholder);
                    "undefined" != typeof c.settings.callbackFormFields[e].maxlength && g.attr("maxlength", c.settings.callbackFormFields[e].maxlength);
                    "dropdown" == c.settings.callbackFormFields[e].type && b.each(c.settings.callbackFormFields[e].values, function(a) {
                        var d = c.settings.callbackFormFields[e].values[a],
                            l = c.settings.callbackFormFields[e].values[a];
                        "object" == typeof c.settings.callbackFormFields[e].values[a] &&
                            (d = c.settings.callbackFormFields[e].values[a].value, l = c.settings.callbackFormFields[e].values[a].label);
                        a = b("<option>", {
                            value: d
                        });
                        a.text(l);
                        g.append(a)
                    });
                    d.append(g);
                    a.append(d)
                })
            };
            d.prototype._initPopups = function() {
                var a = this,
                    c = b("<div>", {
                        class: "popups-block arcuAnimated"
                    }),
                    e = b("<div>", {
                        class: "popups-list-container"
                    });
                b.each(this.popups, function() {
                    var c = b("<div>", {
                            class: "arcu-popup",
                            id: "arcu-popup-" + this.id
                        }),
                        d = b("<div>", {
                            class: "arcu-popup-header",
                            style: a.settings.theme ? "background-color:" + a.settings.theme : null
                        }),
                        f = b("<div>", {
                            class: "arcu-popup-close",
                            style: a.settings.theme ? "background-color:" + a.settings.theme : null
                        }),
                        g = b("<div>", {
                            class: "arcu-popup-back",
                            style: a.settings.theme ? "background-color:" + a.settings.theme : null
                        });
                    f.append(a.settings.closeIcon);
                    g.append('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z" class=""></path></svg>');
                    d.text(this.title);
                    d.append(f);
                    d.append(g);
                    f = b("<div>", {
                        class: "arcu-popup-content"
                    });
                    f.html(this.popupContent);
                    c.append(d);
                    c.append(f);
                    e.append(c)
                });
                c.append(e);
                this.$element.append(c)
            };
            d.prototype._initMessengersBlock = function() {
                var a = b("<div>", {
                        class: "messangers-block arcuAnimated"
                    }),
                    c = b("<div>", {
                        class: "messangers-list-container"
                    }),
                    e = b("<ul>", {
                        class: "messangers-list"
                    });
                "normal" !== this.settings.menuSize && "large" !== this.settings.menuSize || a.addClass("lg");
                "small" === this.settings.menuSize && a.addClass("sm");
                this._appendMessengerIcons(e);
                if (this.settings.showMenuHeader) {
                    var d = b("<div>", {
                        class: "arcu-menu-header",
                        style: this.settings.theme ? "background-color:" + this.settings.theme : null
                    });
                    d.html(this.settings.menuHeaderText);
                    if (this.settings.showHeaderCloseBtn) {
                        var h = b("<div>", {
                            class: "arcu-header-close",
                            style: "color:" + this.settings.headerCloseBtnColor + "; background:" + this.settings.headerCloseBtnBgColor
                        });
                        h.append(this.settings.closeIcon);
                        d.append(h)
                    }
                    a.append(d);
                    a.addClass("has-header")
                }
                "rounded" == this.settings.itemsIconType ?
                    e.addClass("rounded-items") : e.addClass("not-rounded-items");
                c.append(e);
                a.append(c);
                this.$element.append(a)
            };
            d.prototype._appendMessengerIcons = function(a) {
                var c = this;
                b.each(this.settings.items, function(e) {
                    e = b("<li>", {});
                    if ("callback" == this.href) var d = b("<div>", {
                        class: "messanger call-back " + (this.class ? this.class : "")
                    });
                    else if ("_popup" == this.href) c.popups.push(this), d = b("<div>", {
                        class: "messanger arcu-popup-link " + (this.class ? this.class : ""),
                        "data-id": this.id ? this.id : null
                    });
                    else if (d = b("<a>", {
                            class: "messanger " +
                                (this.class ? this.class : ""),
                            id: this.id ? this.id : null,
                            href: this.href
                        }), this.onClick) {
                        var h = this;
                        d.on("click", function(a) {
                            h.onClick(a)
                        })
                    }
                    var f = "rounded" == c.settings.itemsIconType ? b("<span>", {
                        style: this.color ? "background-color:" + this.color : null
                    }) : b("<span>", {
                        style: (this.color ? "color:" + this.color : null) + "; background-color: transparent"
                    });
                    f.append(this.icon);
                    d.append(f);
                    f = b("<div>", {
                        class: "arcu-item-label"
                    });
                    var g = b("<div>", {
                        class: "arcu-item-title"
                    });
                    g.text(this.title);
                    f.append(g);
                    "undefined" != typeof this.subTitle && this.subTitle && (g = b("<div>", {
                        class: "arcu-item-subtitle"
                    }), g.text(this.subTitle), f.append(g));
                    d.append(f);
                    e.append(d);
                    a.append(e)
                })
            };
            d.prototype._initMessageButton = function() {
                var a = this,
                    c = b("<div>", {
                        class: "arcontactus-message-button",
                        style: this._backgroundStyle()
                    });
                "large" === this.settings.buttonSize && this.$element.addClass("lg");
                "huge" === this.settings.buttonSize && this.$element.addClass("hg");
                "medium" === this.settings.buttonSize && this.$element.addClass("md");
                "small" === this.settings.buttonSize && this.$element.addClass("sm");
                var e = b("<div>", {
                    class: "static"
                });
                e.append(this.settings.buttonIcon);
                !1 !== this.settings.buttonText ? e.append("<p>" + this.settings.buttonText + "</p>") : c.addClass("no-text");
                var d = b("<div>", {
                    class: "callback-state",
                    style: a._colorStyle()
                });
                d.append(this.settings.callbackStateIcon);
                var h = b("<div>", {
                        class: "icons hide"
                    }),
                    f = b("<div>", {
                        class: "icons-line"
                    });
                b.each(this.settings.items, function(c) {
                    c = b("<span>", {
                        style: a._colorStyle()
                    });
                    c.append(this.icon);
                    f.append(c)
                });
                h.append(f);
                var g = b("<div>", {
                    class: "arcontactus-close"
                });
                g.append(this.settings.closeIcon);
                var k = b("<div>", {
                        class: "pulsation",
                        style: a._backgroundStyle()
                    }),
                    m = b("<div>", {
                        class: "pulsation",
                        style: a._backgroundStyle()
                    });
                c.append(e).append(d).append(h).append(g).append(k).append(m);
                this.$element.append(c)
            };
            d.prototype._initPrompt = function() {
                var a = b("<div>", {
                        class: "arcontactus-prompt arcu-prompt-" + this.settings.promptPosition
                    }),
                    c = b("<div>", {
                        class: "arcontactus-prompt-close",
                        style: this._backgroundStyle() +
                            "; color: #FFFFFF"
                    });
                c.append(this.settings.closeIcon);
                var e = b("<div>", {
                    class: "arcontactus-prompt-inner"
                });
                a.append(c).append(e);
                this.$element.append(a)
            };
            d.prototype._initEvents = function() {
                var a = this.$element,
                    c = this;
                a.find(".arcontactus-message-button").on("mousedown", function(a) {
                    c.x = a.pageX;
                    c.y = a.pageY
                }).on("mouseup", function(a) {
                    if (c.settings.drag && a.pageX === c.x && a.pageY === c.y || !c.settings.drag) "regular" == c.settings.mode ? c._menuOpened || c._popupOpened || c._callbackOpened ? (c._menuOpened && c.closeMenu(),
                        c._popupOpened && c.closePopup()) : c.openMenu() : c.openCallbackPopup(), a.preventDefault()
                });
                this.settings.drag && (a.draggable(), a.get(0).addEventListener("touchmove", function(c) {
                    var b = c.targetTouches[0];
                    a.get(0).style.left = b.pageX - 25 + "px";
                    a.get(0).style.top = b.pageY - 25 + "px";
                    c.preventDefault()
                }, !1));
                b(document).on("click", function(a) {
                    c.closeMenu();
                    c.closePopup()
                });
                a.on("click", function(a) {
                    a.stopPropagation()
                });
                a.find(".call-back").on("click", function() {
                    c.openCallbackPopup()
                });
                a.find(".arcu-popup-link").on("click",
                    function() {
                        var a = b(this).data("id");
                        c.openPopup(a)
                    });
                a.find(".arcu-header-close").on("click", function() {
                    c.closeMenu()
                });
                a.find(".arcu-popup-close").on("click", function() {
                    c.closePopup()
                });
                a.find(".arcu-popup-back").on("click", function() {
                    c.closePopup();
                    c.openMenu()
                });
                a.find(".callback-countdown-block-close").on("click", function() {
                    null != c.countdown && (clearInterval(c.countdown), c.countdown = null);
                    c.closeCallbackPopup()
                });
                a.find(".arcontactus-prompt-close").on("click", function() {
                    c.hidePrompt()
                });
                a.find("#arcu-callback-form").on("submit",
                    function(b) {
                        b.preventDefault();
                        a.find(".callback-countdown-block-phone").addClass("ar-loading");
                        c.settings.reCaptcha ? grecaptcha.execute(c.settings.reCaptchaKey, {
                            action: c.settings.reCaptchaAction
                        }).then(function(b) {
                            a.find(".ar-g-token").val(b);
                            c.sendCallbackRequest()
                        }) : c.sendCallbackRequest()
                    });
                setTimeout(function() {
                    c._processHash()
                }, 500);
                b(window).on("hashchange", function(a) {
                    c._processHash()
                })
            };
            d.prototype._processHash = function() {
                switch (window.location.hash) {
                    case "#callback-form":
                    case "callback-form":
                        this.openCallbackPopup();
                        break;
                    case "#callback-form-close":
                    case "callback-form-close":
                        this.closeCallbackPopup();
                        break;
                    case "#contactus-menu":
                    case "contactus-menu":
                        this.openMenu();
                        break;
                    case "#contactus-menu-close":
                    case "contactus-menu-close":
                        this.closeMenu();
                        break;
                    case "#contactus-hide":
                    case "contactus-hide":
                        this.hide();
                        break;
                    case "#contactus-show":
                    case "contactus-show":
                        this.show()
                }
            };
            d.prototype._callBackCountDownMethod = function() {
                var a = this.settings.countdown,
                    c = this.$element,
                    b = this,
                    d = 60;
                c.find(".callback-countdown-block-phone, .callback-countdown-block-timer").toggleClass("display-flex");
                this.countdown = setInterval(function() {
                    --d;
                    var e = a,
                        f = d;
                    10 > a && (e = "0" + a);
                    10 > d && (f = "0" + d);
                    e = e + ":" + f;
                    c.find(".callback-countdown-block-timer_timer").html(e);
                    0 === d && 0 === a && (clearInterval(b.countdown), b.countdown = null, c.find(".callback-countdown-block-sorry, .callback-countdown-block-timer").toggleClass("display-flex"));
                    0 === d && (d = 60, --a)
                }, 20)
            };
            d.prototype.sendCallbackRequest = function() {
                var a = this,
                    c = a.$element;
                this.$element.trigger("arcontactus.beforeSendCallbackRequest");
                b.ajax({
                    url: a.settings.ajaxUrl,
                    type: "POST",
                    dataType: "json",
                    data: c.find("form").serialize(),
                    success: function(b) {
                        a.settings.countdown && a._callBackCountDownMethod();
                        c.find(".callback-countdown-block-phone").removeClass("ar-loading");
                        if (b.success) a.settings.countdown || c.find(".callback-countdown-block-sorry, .callback-countdown-block-phone").toggleClass("display-flex");
                        else if (b.errors) {
                            var d = b.errors.join("\n\r");
                            alert(d)
                        } else alert(a.settings.errorMessage);
                        a.$element.trigger("arcontactus.successCallbackRequest", b)
                    },
                    error: function() {
                        c.find(".callback-countdown-block-phone").removeClass("ar-loading");
                        alert(a.settings.errorMessage);
                        a.$element.trigger("arcontactus.errorCallbackRequest")
                    }
                })
            };
            d.prototype.show = function() {
                this.$element.addClass("active");
                this.$element.trigger("arcontactus.show")
            };
            d.prototype.hide = function() {
                this.$element.removeClass("active");
                this.$element.trigger("arcontactus.hide")
            };
            d.prototype.openPopup = function(a) {
                this.closeMenu();
                var c = this.$element;
                c.find("#arcu-popup-" + a).addClass("show-messageners-block");
                c.find("#arcu-popup-" + a).hasClass("popup-opened") || (this.stopAnimation(),
                    c.addClass("popup-opened"), c.find("#arcu-popup-" + a).addClass(this.settings.menuInAnimationClass), c.find(".arcontactus-close").addClass("show-messageners-block"), c.find(".icons, .static").addClass("hide"), c.find(".pulsation").addClass("stop"), this._popupOpened = !0, this.$element.trigger("arcontactus.openPopup"))
            };
            d.prototype.closePopup = function() {
                var a = this.$element;
                a.find(".arcu-popup").hasClass("show-messageners-block") && (setTimeout(function() {
                        a.removeClass("popup-opened")
                    }, 150), a.find(".arcu-popup").removeClass(this.settings.menuInAnimationClass).addClass(this.settings.menuOutAnimationClass),
                    setTimeout(function() {
                        a.removeClass("popup-opened")
                    }, 150), a.find(".arcontactus-close").removeClass("show-messageners-block"), a.find(".icons, .static").removeClass("hide"), a.find(".pulsation").removeClass("stop"), this.startAnimation(), this._popupOpened = !1, this.$element.trigger("arcontactus.closeMenu"))
            };
            d.prototype.openMenu = function() {
                if ("callback" == this.settings.mode) return console.log("Widget in callback mode"), !1;
                var a = this.$element;
                a.find(".messangers-block").hasClass(this.settings.menuInAnimationClass) ||
                    (this.stopAnimation(), a.addClass("open"), a.find(".messangers-block").addClass(this.settings.menuInAnimationClass), a.find(".arcontactus-close").addClass("show-messageners-block"), a.find(".icons, .static").addClass("hide"), a.find(".pulsation").addClass("stop"), this._menuOpened = !0, this.$element.trigger("arcontactus.openMenu"))
            };
            d.prototype.closeMenu = function() {
                if ("callback" == this.settings.mode) return console.log("Widget in callback mode"), !1;
                var a = this.$element,
                    c = this;
                a.find(".messangers-block").hasClass(this.settings.menuInAnimationClass) &&
                    (setTimeout(function() {
                        a.removeClass("open")
                    }, 150), a.find(".messangers-block").removeClass(this.settings.menuInAnimationClass).addClass(this.settings.menuOutAnimationClass), setTimeout(function() {
                        a.find(".messangers-block").removeClass(c.settings.menuOutAnimationClass)
                    }, 1E3), a.find(".arcontactus-close").removeClass("show-messageners-block"), a.find(".icons, .static").removeClass("hide"), a.find(".pulsation").removeClass("stop"), this.startAnimation(), this._menuOpened = !1, this.$element.trigger("arcontactus.closeMenu"))
            };
            d.prototype.toggleMenu = function() {
                var a = this.$element;
                this.hidePrompt();
                if (a.find(".callback-countdown-block").hasClass("display-flex")) return !1;
                a.find(".messangers-block").hasClass(this.settings.menuInAnimationClass) ? this.closeMenu() : this.openMenu();
                this.$element.trigger("arcontactus.toggleMenu")
            };
            d.prototype.openCallbackPopup = function() {
                var a = this.$element;
                a.addClass("opened");
                this.closeMenu();
                this.stopAnimation();
                a.find(".icons, .static").addClass("hide");
                a.find(".pulsation").addClass("stop");
                a.find(".callback-countdown-block").addClass("display-flex");
                a.find(".callback-countdown-block-phone").addClass("display-flex");
                a.find(".callback-state").addClass("display-flex");
                this._callbackOpened = !0;
                this.$element.trigger("arcontactus.openCallbackPopup")
            };
            d.prototype.closeCallbackPopup = function() {
                var a = this.$element;
                a.removeClass("opened");
                a.find(".messangers-block").removeClass(this.settings.menuInAnimationClass);
                a.find(".arcontactus-close").removeClass("show-messageners-block");
                a.find(".icons, .static").removeClass("hide");
                a.find(".pulsation").removeClass("stop");
                a.find(".callback-countdown-block, .callback-countdown-block-phone, .callback-countdown-block-sorry, .callback-countdown-block-timer").removeClass("display-flex");
                a.find(".callback-state").removeClass("display-flex");
                this.startAnimation();
                this._callbackOpened = !1;
                this.$element.trigger("arcontactus.closeCallbackPopup")
            };
            d.prototype.startAnimation = function() {
                var a = this.$element,
                    c = a.find(".icons-line"),
                    b = a.find(".static"),
                    d = a.find(".icons-line>span:first-child").width() +
                    40;
                if ("huge" === this.settings.buttonSize) var h = 2,
                    f = 0;
                "large" === this.settings.buttonSize && (h = 2, f = 0);
                "medium" === this.settings.buttonSize && (h = 4, f = -2);
                "small" === this.settings.buttonSize && (h = 4, f = -2);
                var g = a.find(".icons-line>span").length,
                    k = 0;
                this.stopAnimation();
                if (0 === this.settings.iconsAnimationSpeed) return !1;
                var m = this;
                this._interval = setInterval(function() {
                    0 === k && (c.parent().removeClass("hide"), b.addClass("hide"));
                    var a = "translate(" + -(d * k + h) + "px, " + f + "px)";
                    c.css({
                        "-webkit-transform": a,
                        "-ms-transform": a,
                        transform: a
                    });
                    k++;
                    if (k > g) {
                        if (k > g + 1) {
                            if (m.settings.iconsAnimationPause) return m.stopAnimation(), setTimeout(function() {
                                if (m._callbackOpened || m._menuOpened || m._popupOpened) return !1;
                                m.startAnimation()
                            }, m.settings.iconsAnimationPause), !1;
                            k = 0
                        }
                        c.parent().addClass("hide");
                        b.removeClass("hide");
                        a = "translate(" + -h + "px, " + f + "px)";
                        c.css({
                            "-webkit-transform": a,
                            "-ms-transform": a,
                            transform: a
                        })
                    }
                }, this.settings.iconsAnimationSpeed)
            };
            d.prototype.stopAnimation = function() {
                clearInterval(this._interval);
                var a = this.$element,
                    b = a.find(".icons-line");
                a = a.find(".static");
                b.parent().addClass("hide");
                a.removeClass("hide");
                b.css({
                    "-webkit-transform": "translate(-2px, 0px)",
                    "-ms-transform": "translate(-2px, 0px)",
                    transform: "translate(-2px, 0px)"
                })
            };
            d.prototype.showPrompt = function(a) {
                var b = this.$element.find(".arcontactus-prompt");
                a && a.content && b.find(".arcontactus-prompt-inner").html(a.content);
                b.addClass("active");
                this.$element.trigger("arcontactus.showPrompt")
            };
            d.prototype.hidePrompt = function() {
                this.$element.find(".arcontactus-prompt").removeClass("active");
                this.$element.trigger("arcontactus.hidePrompt")
            };
            d.prototype.showPromptTyping = function() {
                this.$element.find(".arcontactus-prompt").find(".arcontactus-prompt-inner").html("");
                this._insertPromptTyping();
                this.showPrompt({});
                this.$element.trigger("arcontactus.showPromptTyping")
            };
            d.prototype._insertPromptTyping = function() {
                var a = this.$element.find(".arcontactus-prompt-inner"),
                    c = b("<div>", {
                        class: "arcontactus-prompt-typing"
                    }),
                    d = b("<div>");
                c.append(d);
                c.append(d.clone());
                c.append(d.clone());
                a.append(c)
            };
            d.prototype.hidePromptTyping =
                function() {
                    this.$element.find(".arcontactus-prompt").removeClass("active");
                    this.$element.trigger("arcontactus.hidePromptTyping")
                };
            d.prototype._backgroundStyle = function() {
                return "background-color: " + this.settings.theme
            };
            d.prototype._colorStyle = function() {
                return "color: " + this.settings.theme
            };
            b.fn.contactUs = function(a) {
                var c = Array.prototype.slice.call(arguments, 1);
                return this.each(function() {
                    var e = b(this),
                        l = e.data("ar.contactus");
                    l || (l = new d(this, "object" == typeof a && a), e.data("ar.contactus", l));
                    "string" ==
                    typeof a && "_" !== a.charAt(0) && l[a].apply(l, c)
                })
            };
            b.fn.contactUs.Constructor = d
        })(jQuery);
    </script>
    <?php include("./layout/livechat.php");?>
    
</body>

</html>