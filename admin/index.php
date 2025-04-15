<?php include("../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="4bRYfDNsvQApU9ncbK3WvDmimAz8Ic4dLn4CWtXY">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">
    <title>Takashimaya | Buy Korean domestic products at original prices from the manufacturer</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-core.css">
    <!-- 引入 layui.css -->
    <link rel="stylesheet" href="/public/layui/css/layui.css">

    <style>
        body {
            font-size: 12px;
        }
    </style>
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

</head>

<body class="">

    <div class="aiz-main-wrapper">

        <?php include("./layout/sidebar.php")?>



        <div class="aiz-content-wrapper">
            <?php include("./layout/topbar.php")?>
            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <div class="row gutters-10">
                        <div class="col-lg-6">
                            <div class="row gutters-10">
                                <div class="col-6">
                                    <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                                        <div class="px-3 pt-3">
                                            <div class="opacity-50">
                                                <span class="fs-12 d-block">Total</span>
                                                Customer
                                            </div>
                                            <div class="h3 fw-700 mb-3">
                                                792
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                            <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
                                        <div class="px-3 pt-3">
                                            <div class="opacity-50">
                                                <span class="fs-12 d-block">Total</span>
                                                Order
                                            </div>
                                            <div class="h3 fw-700 mb-3">5707</div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                            <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                                        <div class="px-3 pt-3">
                                            <div class="opacity-50">
                                                <span class="fs-12 d-block">Total</span>
                                                Product category
                                            </div>
                                            <div class="h3 fw-700 mb-3">27</div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                            <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">
                                        <div class="px-3 pt-3">
                                            <div class="opacity-50">
                                                <span class="fs-12 d-block">Total</span>
                                                Product brand
                                            </div>
                                            <div class="h3 fw-700 mb-3">59</div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                            <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row gutters-10">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0 fs-14">Products</h6>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="pie-1" class="w-100" height="305"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0 fs-14">Sellers</h6>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="pie-2" class="w-100" height="305"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gutters-10">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0 fs-14">Category wise product sale</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="graph-1" class="w-100" height="500"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0 fs-14">Category wise product stock</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="graph-2" class="w-100" height="500"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Top 12 Products</h6>
                        </div>
                        <div class="card-body">
                            <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4" data-md-items="3" data-sm-items="2" data-arrows='true'>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/tiesu-new-technology-three-dimensional-5d-flower-nail-stickers-embossed-adhesive-nail-stickers-exquisite-series-DrUAU" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/Uy58QWamWbDotAInzCeHZuilIyWU02QtaJmReRgK.jpg"
                                                    alt="Tiesu new technology three-dimensional 5D flower nail stickers embossed adhesive nail stickers exquisite series"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">1.20$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/tiesu-new-technology-three-dimensional-5d-flower-nail-stickers-embossed-adhesive-nail-stickers-exquisite-series-DrUAU" class="d-block text-reset">Tiesu new technology three-dimensional 5D flower nail stickers embossed adhesive nail stickers exquisite series</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/naisl-frosted-toenail-manicure-pieces-toe-nail-patches-wholesale-wearable-nail-products-full-stickers-for-nail-salons-DlFwx" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/8gMcSJxR4aTlie2DO3vglvf87IhNFI4LqkOojYiQ.jpg"
                                                    alt="naisl frosted toenail manicure pieces toe nail patches wholesale wearable nail products full stickers for nail salons"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">2.00$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/naisl-frosted-toenail-manicure-pieces-toe-nail-patches-wholesale-wearable-nail-products-full-stickers-for-nail-salons-DlFwx" class="d-block text-reset">naisl frosted toenail manicure pieces toe nail patches wholesale wearable nail products full stickers for nail salons</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/foreign-trade-export-to-russiauv-gel-nail-polish-GyYxJ" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/rvSWtwZKvAq9FDwiM91ols0qdWaJeIaV1JUxONmn.jpg"
                                                    alt="Foreign trade export to Russia/Uv Gel Nail Polish"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <del class="fw-600 opacity-50 mr-1">4.00$</del>
                                                <span class="fw-700 text-primary">3.96$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/foreign-trade-export-to-russiauv-gel-nail-polish-GyYxJ" class="d-block text-reset">Foreign trade export to Russia/Uv Gel Nail Polish</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/sample-retention-display-cabinet-kindergarten-school-commercial-small-refrigeration-refrigerator-preservation-cabinet-with-lock-food-sample-retention-cabinet-oDfBH" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/U5PQEtS2FKvDOFHcIunnTsuQk0MDuaoRjQQBc9A7.jpg"
                                                    alt="Cross-border wholesale nail art jewelry alloy diamond jewelry three-dimensional love diamond ocean heart nail decoration accessories"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">6.30$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/sample-retention-display-cabinet-kindergarten-school-commercial-small-refrigeration-refrigerator-preservation-cabinet-with-lock-food-sample-retention-cabinet-oDfBH" class="d-block text-reset">Cross-border wholesale nail art jewelry alloy diamond jewelry three-dimensional love diamond ocean heart nail decoration accessories</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/internet-celebrity-silver-alloy-butterfly-nail-art-jewelry-light-luxury-style-high-end-metal-three-dimensional-nail-decoration-small-accessories-wholesale-CP8Mj" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/1jdYbTtVYcmQNCq7OzCGvuIs2KiMRnr1te2Ub5uh.jpg"
                                                    alt="Internet celebrity silver alloy butterfly nail art jewelry light luxury style high-end metal three-dimensional nail decoration small accessories wholesale"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">2.50$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/internet-celebrity-silver-alloy-butterfly-nail-art-jewelry-light-luxury-style-high-end-metal-three-dimensional-nail-decoration-small-accessories-wholesale-CP8Mj" class="d-block text-reset">Internet celebrity silver alloy butterfly nail art jewelry light luxury style high-end metal three-dimensional nail decoration small accessories wholesale</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/cross-border-foreign-trade-special-supply-of-nail-polish-60-colors-solid-color-sequin-nail-polish-one-bottle-one-color-nail-polish-factory-wholesale-QyKEv" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/qJIYie6pTzfcvlqBWFzrTI6Y9JzKsjw90OzgnQ6o.jpg"
                                                    alt="Cross-border foreign trade special supply of nail polish 60 colors solid color sequin nail polish one bottle one color nail polish factory wholesale"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">4.50$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/cross-border-foreign-trade-special-supply-of-nail-polish-60-colors-solid-color-sequin-nail-polish-one-bottle-one-color-nail-polish-factory-wholesale-QyKEv" class="d-block text-reset">Cross-border foreign trade special supply of nail polish 60 colors solid color sequin nail polish one bottle one color nail polish factory wholesale</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/nail-polish-wholesale-27-colors-no-bake-peelable-nail-polish-summer-new-style-odorless-water-based-peelable-nail-polish-dzp98" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/1yDRXkKBJuAGxYyLCqe010fjC4wex8Iu5MYPUwgZ.jpg"
                                                    alt="Nail polish wholesale 27 colors no-bake peelable nail polish summer new style odorless water-based peelable nail polish"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">3.50$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/nail-polish-wholesale-27-colors-no-bake-peelable-nail-polish-summer-new-style-odorless-water-based-peelable-nail-polish-dzp98" class="d-block text-reset">Nail polish wholesale 27 colors no-bake peelable nail polish summer new style odorless water-based peelable nail polish</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/new-arrival-42-colors-of-moisturizing-skin-jelly-ice-transparent-color-nail-gel-nail-art-shop-ice-transparent-nude-nail-polish-glue-set-glue-Hg96J" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/JQ6wzcbFxzgtkFkNKsVsEow7EehX9dqPze6LWsnp.jpg"
                                                    alt="New arrival 42 colors of moisturizing skin jelly ice transparent color nail gel nail art shop ice transparent nude nail polish Glue set glue"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">4.00$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/new-arrival-42-colors-of-moisturizing-skin-jelly-ice-transparent-color-nail-gel-nail-art-shop-ice-transparent-nude-nail-polish-glue-set-glue-Hg96J" class="d-block text-reset">New arrival 42 colors of moisturizing skin jelly ice transparent color nail gel nail art shop ice transparent nude nail polish Glue set glue</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/cross-border-hot-sale-48-colors-uv-light-therapy-nail-polish-set-nail-color-glue-wholesale-nail-polish-glue-wholesale-MXKpy" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/Drz1SdpWIfmeRlhK4rzYFkH6BpVVP7W4XqcM2RsL.jpg"
                                                    alt="Cross-border hot sale 48 colors UV light therapy nail polish set nail color glue wholesale nail polish Glue Wholesale"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">9.50$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/cross-border-hot-sale-48-colors-uv-light-therapy-nail-polish-set-nail-color-glue-wholesale-nail-polish-glue-wholesale-MXKpy" class="d-block text-reset">Cross-border hot sale 48 colors UV light therapy nail polish set nail color glue wholesale nail polish Glue Wholesale</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/autumn-and-winter-new-products-bright-starlight-fine-glitter-broken-diamond-glue-12-colors-net-celebrity-disco-flash-reflective-broken-diamond-nail-polish-glue-7qZAj" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/gj8yMuQGbPoDtJcYkCsOu9FxYUQ3SAdhcNCj10e2.jpg"
                                                    alt="Autumn and winter new products bright starlight fine glitter broken diamond glue 12 colors net celebrity disco flash reflective broken diamond nail polish glue"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">5.00$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/autumn-and-winter-new-products-bright-starlight-fine-glitter-broken-diamond-glue-12-colors-net-celebrity-disco-flash-reflective-broken-diamond-nail-polish-glue-7qZAj" class="d-block text-reset">Autumn and winter new products bright starlight fine glitter broken diamond glue 12 colors net celebrity disco flash reflective broken diamond nail polish glue</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/full-size-manicure-patch-free-of-engraving-semi-frosted-trapezoidal-fully-pasted-pointed-nails-water-drop-fake-nails-500-boxes-p9YAO" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/w5c59lsurvHOIpRS7QGNFuaqDVi8XtsZOoSVW1Gb.jpg"
                                                    alt="Full-size manicure patch, free of engraving, semi-frosted, trapezoidal, fully pasted, pointed nails, water drop fake nails, 500 boxes"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <del class="fw-600 opacity-50 mr-1">4.00$</del>
                                                <span class="fw-700 text-primary">3.96$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/full-size-manicure-patch-free-of-engraving-semi-frosted-trapezoidal-fully-pasted-pointed-nails-water-drop-fake-nails-500-boxes-p9YAO" class="d-block text-reset">Full-size manicure patch, free of engraving, semi-frosted, trapezoidal, fully pasted, pointed nails, water drop fake nails, 500 boxes</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="/product/manicure-nail-patch-no-c-semi-patch-nail-patch-xxl-water-pipe-nail-patch-wearable-nail-patch-fake-nail-500-pieces-cross-border-nail-3F7BP" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-210px"
                                                    src="https://tmdtquocte.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://tmdtquocte.com/public/uploads/all/mZtweCFPJjy6bB4EakUYR3wD6TW5aDaKWeFvyM7I.jpg"
                                                    alt="Manicure Nail Patch NO-C Semi-Patch Nail Patch XXL Water Pipe Nail Patch Wearable Nail Patch Fake Nail 500 Pieces Cross-Border Nail"
                                                    onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">3.00$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href="/product/manicure-nail-patch-no-c-semi-patch-nail-patch-xxl-water-pipe-nail-patch-wearable-nail-patch-fake-nail-500-pieces-cross-border-nail-3F7BP" class="d-block text-reset">Manicure Nail Patch NO-C Semi-Patch Nail Patch XXL Water Pipe Nail Patch Wearable Nail Patch Fake Nail 500 Pieces Cross-Border Nail</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; Takashimaya v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->








    </div><!-- .aiz-main-wrapper -->



    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
        AIZ.plugins.chart('#pie-1', {
            type: 'doughnut',
            data: {
                labels: [
                    'Total published products',
                    'Total sellers products',
                    'Total admin products'
                ],
                datasets: [{
                    data: [
                        35230,
                        2192,
                        33038
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }]
            },
            options: {
                cutoutPercentage: 70,
                legend: {
                    labels: {
                        fontFamily: 'Poppins',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                    position: 'bottom'
                }
            }
        });

        AIZ.plugins.chart('#pie-2', {
            type: 'doughnut',
            data: {
                labels: [
                    'Total sellers',
                    'Total approved sellers',
                    'Total pending sellers'
                ],
                datasets: [{
                    data: [
                        133,
                        126,
                        7
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }]
            },
            options: {
                cutoutPercentage: 70,
                legend: {
                    labels: {
                        fontFamily: 'Montserrat',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                    position: 'bottom'
                }
            }
        });
        AIZ.plugins.chart('#graph-1', {
            type: 'bar',
            data: {
                labels: [
                    'Ladies clothing',
                    'Men&#039;s clothing',
                    'Electronics - Refrigeration',
                    'Mother and baby items',
                    'Jewelry &amp; Watches',
                    'Smart Phone, Tablet and Accessory',
                    'Sports',
                    'Toy',
                    'Beauty salons',
                    'Shoes',
                    'Interior - Decoration',
                    'Pet accessories',
                    'Home electric',
                    'Perfume',
                    'Cars - Motorcycles - Bicycles - Accessories',
                    'Camera Camcorder',
                    'Kitchen accessories',
                    'Fashion accessories',
                    'Nail and eyelash accessories',
                    'Baby shoes',
                    'Functional foods - Health',
                    'Nutritional milk',
                    'Backpack - Suitcase',
                    'Hand Bag',
                    'Snacks',
                    'Beer - Wine - Drinks',
                    'Souvenir',
                ],
                datasets: [{
                    label: 'Number of sale',
                    data: [
                        6236, 7013, 1707, 1838, 957, 176, 302, 698, 7667, 9986, 9715, 157, 303, 636, 76, 0, 80, 670, 40716, 1529, 4551, 1213, 110, 3345, 293, 453, 20,
                    ],
                    backgroundColor: [
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                        'rgba(55, 125, 255, 0.4)',
                    ],
                    borderColor: [
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                        'rgba(55, 125, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: '#f2f3f8',
                            zeroLineColor: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Poppins',
                            fontSize: 10,
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Poppins',
                            fontSize: 10
                        }
                    }]
                },
                legend: {
                    labels: {
                        fontFamily: 'Poppins',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                }
            }
        });
        AIZ.plugins.chart('#graph-2', {
            type: 'bar',
            data: {
                labels: [
                    'Ladies clothing',
                    'Men&#039;s clothing',
                    'Electronics - Refrigeration',
                    'Mother and baby items',
                    'Jewelry &amp; Watches',
                    'Smart Phone, Tablet and Accessory',
                    'Sports',
                    'Toy',
                    'Beauty salons',
                    'Shoes',
                    'Interior - Decoration',
                    'Pet accessories',
                    'Home electric',
                    'Perfume',
                    'Cars - Motorcycles - Bicycles - Accessories',
                    'Camera Camcorder',
                    'Kitchen accessories',
                    'Fashion accessories',
                    'Nail and eyelash accessories',
                    'Baby shoes',
                    'Functional foods - Health',
                    'Nutritional milk',
                    'Backpack - Suitcase',
                    'Hand Bag',
                    'Snacks',
                    'Beer - Wine - Drinks',
                    'Souvenir',
                ],
                datasets: [{
                    label: 'Number of Stock',
                    data: [
                        2391932056454, 1386165006144, 279070783, 3954725792, 64662344, 5243776, 582159553, 13036804438, 207297027, 2501221306, 177305212, 3937131, 143473210, 38485560, 1688356, 0, 15158870, 11275526, 145156631, 4647522, 106425660, 686271, 4753847, 163028557, 13433556, 118170956, 12252501,
                    ],
                    backgroundColor: [
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                        'rgba(253, 57, 149, 0.4)',
                    ],
                    borderColor: [
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                        'rgba(253, 57, 149, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: '#f2f3f8',
                            zeroLineColor: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Poppins',
                            fontSize: 10,
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Poppins',
                            fontSize: 10
                        }
                    }]
                },
                legend: {
                    labels: {
                        fontFamily: 'Poppins',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                }
            }
        });
    </script>

    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
                        _token: '4bRYfDNsvQApU9ncbK3WvDmimAz8Ic4dLn4CWtXY',
                        locale: locale
                    }, function(data) {
                        location.reload();
                    });

                });
            });
        }

        function menuSearch() {
            var filter, item;
            filter = $("#menu-search").val().toUpperCase();
            items = $("#main-menu").find("a");
            items = items.filter(function(i, item) {
                if ($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item).attr('href') !== '#') {
                    return item;
                }
            });

            if (filter !== '') {
                $("#main-menu").addClass('d-none');
                $("#search-menu").html('')
                if (items.length > 0) {
                    for (i = 0; i < items.length; i++) {
                        const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;
                        const link = $(items[i]).attr('href');
                        $("#search-menu").append(`<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`);
                    }
                } else {
                    $("#search-menu").html(`<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">Nothing found</span></li>`);
                }
            } else {
                $("#main-menu").removeClass('d-none');
                $("#search-menu").html('')
            }
        }
    </script>

</body>

</html>