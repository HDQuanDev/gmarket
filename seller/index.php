<?php include("../config.php");
if (!$isSeller) header("Location: /users/login");


$count_uploaded_product = intval(fetch_array("SELECT IFNULL(count(*),0) as count FROM products WHERE seller_id='$seller_id'")['count'])
?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="WHlv8s3iHwKLAGXuo3YNzXWSxeiLQwI3HCTT6iXe">
    <meta name="app-url" content="//gmarketagents.com/">
    <meta name="file-base-url" content="//gmarketagents.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
    <title>Gmarket Viet Nam | Buy Korean domestic products at original prices from the manufacturer</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-seller.css">

    <style>
        body {
            font-size: 12px;
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
        <?php include("./layout/sidebar.php") ?>
        <div class="aiz-content-wrapper">
            <?php include("./layout/topbar.php") ?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <!--<div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3 text-primary">Dashboard</h1>
            </div>
        </div>
    </div>-->

                    <div class="mb-4 mt-2">
                        <h2 class="fs-30"><?= $seller_shop_name ?></h2>
                        <div class="rating fs-20">
                            <span><i class="las la-star" style="color:#ffca00"></i></span>
                            <span><i class="las la-star" style="color:#ffca00"></i></span>
                            <span><i class="las la-star" style="color:#ffca00"></i></span>
                            <span><i class="las la-star" style="color:#ffca00"></i></span>
                            <span><i class="las la-star" style="color:#ffca00"></i></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-xxl-3">
                            <div class="card shadow-none mb-4 bg-primary py-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p class="small text-muted mb-0">
                                                <span class="fe fe-arrow-down fe-12"></span>
                                                <span class="fs-14 text-light">Products</span>
                                            </p>
                                            <h3 class="mb-0 text-white fs-30">
                                                <?= $count_uploaded_product ?>
                                            </h3>

                                        </div>
                                        <div class="col-auto text-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64.001" height="64" viewBox="0 0 64.001 64">
                                                <path id="Path_66" data-name="Path 66"
                                                    d="M146.431,117.56l-26.514-10.606a8.014,8.014,0,0,0-5.944,0L87.458,117.56a4,4,0,0,0-2.514,3.714v34.217a4,4,0,0,0,2.514,3.714l26.514,10.606a8.013,8.013,0,0,0,5.944,0L146.431,159.2a4,4,0,0,0,2.514-3.714V121.274a4,4,0,0,0-2.514-3.714m-31.714-8.748a5.981,5.981,0,0,1,4.456,0l26.1,10.44a1,1,0,0,1,0,1.858l-12.332,4.932-30.654-12.26Zm1.228,59.633L88.2,157.347a2,2,0,0,1-1.258-1.856V122.6l29,11.6Zm1-36L88.612,121.11a1,1,0,0,1,0-1.858L99.6,114.858l30.654,12.262Zm30,23.048a2,2,0,0,1-1.258,1.856l-27.742,11.1V134.2l13-5.2V146.61a1.035,1.035,0,0,0,2-.466V128.2l14-5.6Z"
                                                    transform="translate(-84.944 -106.382)" fill="#FFFFFF" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xxl-3">
                            <div class="card shadow-none mb-4 bg-primary py-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p class="small text-muted mb-0">
                                                <span class="fe fe-arrow-down fe-12"></span>
                                                <span class="fs-14 text-light">Rating</span>
                                            </p>
                                            <h3 class="mb-0 text-white fs-30">
                                                5
                                            </h3>

                                        </div>
                                        <div class="col-auto text-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="61.143" viewBox="0 0 64 61.143">
                                                <path id="Path_57" data-name="Path 57"
                                                    d="M63.286,22.145a2.821,2.821,0,0,0-1.816-.926L43.958,19.455a2.816,2.816,0,0,1-2.294-1.666L34.574,1.68a2.813,2.813,0,0,0-5.148,0l-7.09,16.11a2.813,2.813,0,0,1-2.292,1.666L2.53,21.219a2.813,2.813,0,0,0-1.59,4.9l13.13,11.72a2.818,2.818,0,0,1,.876,2.7l-3.734,17.2a2.812,2.812,0,0,0,4.166,3.026L30.584,51.9a2.8,2.8,0,0,1,2.832,0l15.206,8.864a2.813,2.813,0,0,0,4.166-3.026l-3.734-17.2a2.818,2.818,0,0,1,.876-2.7l13.13-11.72a2.813,2.813,0,0,0,.226-3.972m-1.5,2.546L48.658,36.413a4.717,4.717,0,0,0-1.47,4.524l3.732,17.2a.9.9,0,0,1-1.336.97l-15.2-8.866a4.729,4.729,0,0,0-4.758,0L14.416,59.109a.9.9,0,0,1-1.336-.97l3.732-17.2a4.717,4.717,0,0,0-1.47-4.524L2.212,24.691a.9.9,0,0,1,.51-1.57l17.512-1.766a4.721,4.721,0,0,0,3.85-2.8l7.09-16.11a.9.9,0,0,1,1.652,0l7.09,16.11a4.721,4.721,0,0,0,3.85,2.8l17.512,1.766a.9.9,0,0,1,.51,1.57"
                                                    transform="translate(0 0)" fill="#FFFFFF" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xxl-3">
                            <div class="card shadow-none mb-4 bg-primary py-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p class="small text-muted mb-0">
                                                <span class="fe fe-arrow-down fe-12"></span>
                                                <span class="fs-14 text-light">Total Order</span>
                                            </p>
                                            <h3 class="mb-0 text-white fs-30">
                                                0
                                            </h3>
                                        </div>
                                        <div class="col-auto text-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">
                                                <g id="Group_25" data-name="Group 25" transform="translate(-1561.844 1020.618)">
                                                    <path id="Path_58" data-name="Path 58"
                                                        d="M229.23,106.382h-12a6,6,0,0,0,0,12h12a6,6,0,0,0,0-12m0,10h-12a4,4,0,0,1,0-8h12a4,4,0,0,1,0,8"
                                                        transform="translate(1370.615 -1127)" fill="#FFFFFF" />
                                                    <path id="Path_59" data-name="Path 59"
                                                        d="M213.73,117.882h24a1,1,0,0,1,0,2h-24a1,1,0,0,1,0-2"
                                                        transform="translate(1372.115 -1115.5)" fill="#FFFFFF" />
                                                    <path id="Path_60" data-name="Path 60" d="M210.23,117.382a2,2,0,1,0,2,2,2,2,0,0,0-2-2"
                                                        transform="translate(1367.615 -1116)" fill="#FFFFFF" />
                                                    <line id="Line_1" data-name="Line 1" transform="translate(1578.047 -1014.618)"
                                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="0.142" />
                                                    <line id="Line_2" data-name="Line 2" transform="translate(1609.643 -1014.618)"
                                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="0.142" />
                                                    <path id="Path_61" data-name="Path 61"
                                                        d="M213.73,123.882h24a1,1,0,0,1,0,2h-24a1,1,0,0,1,0-2"
                                                        transform="translate(1372.115 -1109.5)" fill="#FFFFFF" />
                                                    <path id="Path_62" data-name="Path 62" d="M210.23,123.382a2,2,0,1,0,2,2,2,2,0,0,0-2-2"
                                                        transform="translate(1367.615 -1110)" fill="#FFFFFF" />
                                                    <path id="Path_63" data-name="Path 63"
                                                        d="M213.73,129.882h24a1,1,0,0,1,0,2h-24a1,1,0,1,1,0-2"
                                                        transform="translate(1372.115 -1103.5)" fill="#FFFFFF" />
                                                    <path id="Path_64" data-name="Path 64" d="M210.23,129.382a2,2,0,1,0,2,2,2,2,0,0,0-2-2"
                                                        transform="translate(1367.615 -1104)" fill="#FFFFFF" />
                                                    <line id="Line_3" data-name="Line 3" transform="translate(1609.643 -1015.618)"
                                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="0.142" />
                                                    <line id="Line_4" data-name="Line 4" transform="translate(1578.047 -1015.618)"
                                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="0.142" />
                                                    <path id="Path_65" data-name="Path 65"
                                                        d="M265.23,116.382a8,8,0,0,0-8-8h-7.2a1,1,0,0,0,0,2h7.2a6,6,0,0,1,6,6v44a6,6,0,0,1-6,6h-48a6,6,0,0,1-6-6v-44a6,6,0,0,1,6-6h7.2a1,1,0,0,0,0-2h-7.2a8,8,0,0,0-8,8v44a8,8,0,0,0,8,8h48a8,8,0,0,0,8-8Z"
                                                        transform="translate(1360.615 -1125)" fill="#FFFFFF" />
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xxl-3">
                            <div class="card shadow-none mb-4 bg-primary py-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p class="small text-muted mb-0">
                                                <span class="fe fe-arrow-down fe-12"></span>
                                                <span class="fs-14 text-light">Total Sales</span>
                                            </p>
                                            <h3 class="mb-0 text-white fs-30">
                                                0.00$
                                            </h3>

                                        </div>
                                        <div class="col-auto text-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64.001" viewBox="0 0 64 64.001">
                                                <g id="Group_26" data-name="Group 26" transform="translate(-1571.385 1123.29)">
                                                    <line id="Line_5" data-name="Line 5" transform="translate(1572.385 -1123.29)"
                                                        fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="0.142" />
                                                    <path id="Path_67" data-name="Path 67"
                                                        d="M214.771,65.71a2,2,0,0,1-2-2v-59a1,1,0,0,0-2,0v59a4,4,0,0,0,4,4h59a1,1,0,0,0,0-2Z"
                                                        transform="translate(1360.615 -1127)" fill="#FFFFFF" />
                                                    <line id="Line_6" data-name="Line 6" y1="0.136" x2="0.136"
                                                        transform="translate(1586.533 -1087.117)" fill="none" stroke="red"
                                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="0.142" />
                                                    <path id="Path_68" data-name="Path 68"
                                                        d="M264.6,10.027a3,3,0,0,0-4,4L247.536,27.1a2.994,2.994,0,0,0-2.594,0l-6.584-6.584a3,3,0,1,0-5.414,0L221.528,31.927a3,3,0,1,0,1.412,1.418l11.418-11.418a3,3,0,0,0,2.586,0l6.586,6.586a3,3,0,1,0,5.418,0l13.072-13.07a3,3,0,0,0,2.584-5.416M220.23,35.633a1,1,0,1,1,1-1,1,1,0,0,1-1,1m15.42-15.414a1,1,0,1,1,1-1,1,1,0,0,1-1,1M246.238,30.8a1,1,0,1,1,1-1,1,1,0,0,1-1,1m17.074-17.066a1,1,0,1,1,1-1,1,1,0,0,1-1,1"
                                                        transform="translate(1367.074 -1120.976)" fill="#FFFFFF" />
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3 mb-4">
                            <div class="card shadow-none bg-soft-primary mb-0">


                                <div class="card-body">
                                    <div class="card-title text-primary fs-16 fw-600">
                                        Sold Amount
                                    </div>
                                    <p>Your sold amount (current month)</p>
                                    <h3 class="text-primary fw-600 fs-30">
                                        0
                                    </h3>
                                    <p class="mt-4">
                                        Last Month: 0
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 mb-4">

                            <div class="card shadow-none h-450px mb-0 h-100" style="height: 32%!important;">
                                <div class="card-body">
                                    <div class="card-title text-primary fs-16 fw-600">
                                        Visitors
                                    </div>
                                    <hr>
                                    <ul class="list-group">
                                        <li class="d-flex justify-content-between align-items-center my-2 text-primary fs-13">
                                            <span class="">
                                                0
                                            </span>
                                        </li>
                                    </ul>
                                    <br /><br />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 mb-4">
                            <div class="card h-450px mb-0 h-100">
                                <div class="card-body">
                                    <div class="card-title text-primary fs-16 fw-600">
                                        Orders
                                        <p class="small text-muted mb-0">
                                            <span class="fs-12 fw-600">This Month</span>
                                        </p>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto text-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g id="Group_23742" data-name="Group 23742" transform="translate(2044 3467)">
                                                    <rect id="Rectangle_17194" data-name="Rectangle 17194" width="30" height="30"
                                                        transform="translate(-2044 -3467)" fill="none" />
                                                    <g id="Group_23741" data-name="Group 23741" transform="translate(310 759)">
                                                        <path id="Path_26908" data-name="Path 26908"
                                                            d="M4.355,30a12.083,12.083,0,0,1-1.6-.517A4.905,4.905,0,0,1,.029,24.5c.146-1.377.228-2.761.339-4.142Q.532,18.313.7,16.271c.106-1.332.206-2.665.316-4,.129-1.555.227-3.114.413-4.662a2,2,0,0,1,2-1.687c.782-.012,1.565,0,2.348,0h.336A5.77,5.77,0,0,1,8.275,1.3,5.615,5.615,0,0,1,12.367.018a5.841,5.841,0,0,1,5.38,5.9h.278c.753,0,1.507,0,2.26,0A2.116,2.116,0,0,1,22.5,7.986c.165,2.091.343,4.181.509,6.272s.322,4.183.488,6.273c.107,1.352.222,2.7.335,4.054a4.9,4.9,0,0,1-4.195,5.362A.61.61,0,0,0,19.5,30ZM6.118,7.678c-.893,0-1.743-.005-2.593,0-.282,0-.383.141-.407.463q-.151,1.97-.307,3.939Q2.559,15.2,2.3,18.325c-.156,1.935-.319,3.869-.455,5.806a6.248,6.248,0,0,0,.028,1.685,3.078,3.078,0,0,0,3.166,2.427q6.882,0,13.764,0c.088,0,.176,0,.264-.006a3.145,3.145,0,0,0,2.986-3.544c-.117-1.076-.177-2.158-.262-3.238-.105-1.342-.208-2.684-.315-4.026-.128-1.6-.261-3.209-.389-4.813q-.181-2.275-.357-4.551a.36.36,0,0,0-.365-.381c-.868-.009-1.735,0-2.63,0,0,.123,0,.218,0,.313,0,.615.006,1.23,0,1.845a.878.878,0,1,1-1.755-.006c-.006-.71,0-1.419,0-2.134h-8.1c0,.693,0,1.365,0,2.038a1.312,1.312,0,0,1-.034.347A.877.877,0,0,1,6.12,9.847c-.008-.711,0-1.422,0-2.168M7.894,5.9h8.069a4.036,4.036,0,1,0-8.069,0"
                                                            transform="translate(-2351 -4226)" fill="#2E294E" />
                                                        <path id="Path_26909" data-name="Path 26909"
                                                            d="M156.63,290.4H153.2v-3.431a.872.872,0,1,0-1.744,0V290.4h-3.431a.872.872,0,1,0,0,1.744h3.431v3.431a.872.872,0,0,0,1.744,0v-3.431h3.431a.872.872,0,0,0,0-1.744"
                                                            transform="translate(-2491.298 -4498.774)" fill="#2E294E" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="col">
                                            <p class="small text-muted mb-0">
                                                <span class="fe fe-arrow-down fe-12"></span>
                                                <span class="fs-13 text-primary fw-600">New Order</span>
                                            </p>
                                            <h3 class="mb-0" style="color: #A9A3CC">
                                                0
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto text-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30"
                                                height="30" viewBox="0 0 30 30">
                                                <defs>
                                                    <clipPath id="clip-path">
                                                        <rect id="Rectangle_17198" data-name="Rectangle 17198" width="30" height="30"
                                                            transform="translate(0 0)" fill="none" />
                                                    </clipPath>
                                                </defs>
                                                <g id="Group_23751" data-name="Group 23751" transform="translate(0 0.001)">
                                                    <g id="Group_23750" data-name="Group 23750" transform="translate(0 -0.001)"
                                                        clip-path="url(#clip-path)">
                                                        <path id="Path_27505" data-name="Path 27505"
                                                            d="M13.122,30H7.03A7.041,7.041,0,0,1,0,22.959V7.03A7.041,7.041,0,0,1,7.03,0H22.959A7.041,7.041,0,0,1,30,7.03v5.857a1.172,1.172,0,1,1-2.343,0V7.03a4.691,4.691,0,0,0-4.7-4.687H7.03A4.691,4.691,0,0,0,2.343,7.03V22.959A4.691,4.691,0,0,0,7.03,27.646h6.092a1.177,1.177,0,0,1,0,2.354"
                                                            transform="translate(0 0)" fill="#2E294E" />
                                                        <path id="Path_27506" data-name="Path 27506"
                                                            d="M193.376,91.163a1.171,1.171,0,0,0-1.171-1.171h-5.969a1.172,1.172,0,1,0,0,2.343h5.969a1.171,1.171,0,0,0,1.171-1.171v0"
                                                            transform="translate(-174.22 -84.719)" fill="#2E294E" />
                                                        <path id="Path_27507" data-name="Path 27507"
                                                            d="M249.953,242.05a7.909,7.909,0,1,0,7.916,7.9,7.909,7.909,0,0,0-7.916-7.9m.008,13.467a5.563,5.563,0,1,1,5.558-5.566h.008a5.566,5.566,0,0,1-5.566,5.566"
                                                            transform="translate(-227.869 -227.867)" fill="#2E294E" />
                                                        <path id="Path_27508" data-name="Path 27508"
                                                            d="M331.615,329.84l.929-.929a1.172,1.172,0,0,0-1.658-1.656l-.929.929-.929-.929a1.172,1.172,0,0,0-1.658,1.656l.929.929-.929.929a1.172,1.172,0,1,0,1.658,1.656l.929-.929.929.929a1.172,1.172,0,1,0,1.658-1.656Z"
                                                            transform="translate(-307.867 -307.756)" fill="#2E294E" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="col">
                                            <p class="small text-muted mb-0">
                                                <span class="fe fe-arrow-down fe-12"></span>
                                                <span class="fs-13 text-primary fw-600">Cancelled</span>
                                            </p>
                                            <h3 class="mb-0" style="color: #A9A3CC">
                                                0
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto text-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g id="Group_23745" data-name="Group 23745" transform="translate(1901 3455)">
                                                    <rect id="Rectangle_17195" data-name="Rectangle 17195" width="30" height="30"
                                                        transform="translate(-1901 -3455)" fill="none" />
                                                    <g id="Group_23744" data-name="Group 23744" transform="translate(-867.487 654.098)">
                                                        <path id="Path_26911" data-name="Path 26911"
                                                            d="M1352.884,172.262h-4.464a.88.88,0,1,0,0,1.761h4.464a.88.88,0,1,0,0-1.761"
                                                            transform="translate(-2379.291 -4277.175)" fill="#2E294E" />
                                                        <path id="Path_26912" data-name="Path 26912"
                                                            d="M1352.884,292.455h-4.464a.88.88,0,1,0,0,1.761h4.464a.88.88,0,1,0,0-1.761"
                                                            transform="translate(-2379.291 -4390.326)" fill="#2E294E" />
                                                        <path id="Path_26913" data-name="Path 26913"
                                                            d="M1322.832,232.366h-4.464a.88.88,0,1,0,0,1.761h4.464a.88.88,0,0,0,0-1.761"
                                                            transform="translate(-2351 -4333.757)" fill="#2E294E" />
                                                        <path id="Path_26914" data-name="Path 26914"
                                                            d="M1531.056,222.736h-5.341v-3.52a1.763,1.763,0,0,0-3-1.244l-7.04,7.04a1.76,1.76,0,0,0,0,2.489h0l4.035,4.035-4.918,4.918a1.761,1.761,0,0,0,2.49,2.49l6.162-6.163a1.76,1.76,0,0,0,0-2.489h0l-4.035-4.035,2.792-2.792v1.03a1.761,1.761,0,0,0,1.761,1.761h7.1a1.761,1.761,0,0,0,0-3.52Z"
                                                            transform="translate(-2536.278 -4319.726)" fill="#2E294E" />
                                                        <path id="Path_26915" data-name="Path 26915"
                                                            d="M1475.968,150.029a1.761,1.761,0,0,0-2.222.22l-4.842,4.842a1.761,1.761,0,0,0,2.441,2.538l.049-.049,3.821-3.821,1.288.927,1.717-1.717a3.5,3.5,0,0,1,1-.687Z"
                                                            transform="translate(-2493.036 -4255.966)" fill="#2E294E" />
                                                        <path id="Path_26916" data-name="Path 26916"
                                                            d="M1344.676,384.535a3.489,3.489,0,0,1-.9-1.589l-9.3,9.3a1.761,1.761,0,0,0,2.49,2.49l8.955-8.954Z"
                                                            transform="translate(-2366.531 -4475.515)" fill="#2E294E" />
                                                        <path id="Path_26917" data-name="Path 26917"
                                                            d="M1690.437,117.9a2.5,2.5,0,1,1-2.5,2.5,2.5,2.5,0,0,1,2.5-2.5"
                                                            transform="translate(-2699.74 -4226)" fill="#2E294E" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="col">
                                            <p class="small text-muted mb-0">
                                                <span class="fe fe-arrow-down fe-12"></span>
                                                <span class="fs-13 text-primary fw-600">On delivery</span>
                                            </p>
                                            <h3 class="mb-0" style="color: #A9A3CC">
                                                0
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-4">
                                        <div class="col-auto text-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                                                <g id="Group_23747" data-name="Group 23747" transform="translate(1894 3457)">
                                                    <rect id="Rectangle_17196" data-name="Rectangle 17196" width="30" height="30"
                                                        transform="translate(-1894 -3457)" fill="none" />
                                                    <g id="Group_23746" data-name="Group 23746" transform="translate(-1599.983 686.845)">
                                                        <path id="Path_26918" data-name="Path 26918"
                                                            d="M2077.33,84.3v.4q0,3.482,0,6.963a1.069,1.069,0,0,1-.7,1.137,1.082,1.082,0,0,1-1.236-.336c-.411-.424-.836-.834-1.273-1.268-.4.4-.806.792-1.206,1.191a1.126,1.126,0,0,1-1.887-.009c-.392-.393-.791-.78-1.208-1.192-.46.464-.9.934-1.371,1.375a1.071,1.071,0,0,1-1.789-.482,1.63,1.63,0,0,1-.036-.43q0-3.465,0-6.93V84.3h-.363q-2.409,0-4.819,0a2.166,2.166,0,0,0-2.317,2.325q0,10.529,0,21.058a2.17,2.17,0,0,0,2.343,2.333q4.183,0,8.366,0a1.07,1.07,0,0,1,.3,2.1,1.345,1.345,0,0,1-.363.038c-2.867,0-5.734.008-8.6,0a4.261,4.261,0,0,1-4.181-4.194q-.008-10.8,0-21.593a4.254,4.254,0,0,1,4.2-4.2q10.792-.007,21.584,0a4.259,4.259,0,0,1,4.192,4.182c.008,2.868,0,5.736,0,8.6a1.071,1.071,0,1,1-2.138,0q0-4.134,0-8.269a2.177,2.177,0,0,0-2.365-2.378h-5.133m-2.163,4.811V84.324h-6.387v4.842c.063-.051.1-.074.125-.1.709-.676,1.2-.671,1.884.017.392.392.789.78,1.194,1.179.459-.458.909-.9,1.357-1.353a.991.991,0,0,1,1.1-.271,3.98,3.98,0,0,1,.726.472"
                                                            transform="translate(-2351 -4226)" fill="#2E294E" />
                                                        <path id="Path_26919" data-name="Path 26919"
                                                            d="M2276.429,310.26a8.566,8.566,0,1,1,8.554,8.574,8.552,8.552,0,0,1-8.554-8.574m14.992,0a6.426,6.426,0,1,0-6.388,6.431,6.451,6.451,0,0,0,6.388-6.431"
                                                            transform="translate(-2557.593 -4432.681)" fill="#2E294E" />
                                                        <path id="Path_26920" data-name="Path 26920"
                                                            d="M2352.663,396.855c.43-.437.848-.866,1.271-1.292q1.072-1.08,2.148-2.155a1.083,1.083,0,1,1,1.531,1.519q-2.064,2.073-4.137,4.139a1.071,1.071,0,0,1-1.672,0q-1-.99-1.986-1.986a1.085,1.085,0,1,1,1.538-1.513l1.305,1.29"
                                                            transform="translate(-2626.31 -4518.65)" fill="#2E294E" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="col">
                                            <p class="small text-muted mb-0">
                                                <span class="fe fe-arrow-down fe-12"></span>
                                                <span class="fs-13 text-primary fw-600">Delivered</span>
                                            </p>
                                            <h3 class="mb-0" style="color: #A9A3CC">
                                                0
                                            </h3>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3 mb-4">
                            <!-- <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h6 class="mb-0">Purchased Package</h6>
                                    </div>
                                    <h6 class="fw-600 mb-3 text-primary">Package Not Found</h6>

                                </div>
                            </div> -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h6 class="mb-0">Purchased Package</h6>
                                    </div>
                                    <div class="d-flex">
                                        <div class="col-3">
                                            <img src="/public/uploads/all/6qfFN60o3OZkhXQERvwdqhvXVaworW0g4ZkowM72.jpg" class="img-fluid mb-4 w-64px">
                                        </div>
                                        <div class="col-9">
                                            <a class="fw-600 mb-3 text-primary">Current Package:</a>
                                            <h6 class="text-primary">
                                                Bronze Shop
                                            </h6>
                                            <p class="mb-1 text-muted">Product Upload Limit:
                                                50
                                            </p>
                                            <p class="text-muted mb-4">Package Expires at:
                                                2024-12-11
                                            </p>
                                            <div class="">
                                                <a href="/seller/packages/index.php" class="btn btn-soft-primary">Upgrade Package</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div
                                class="card mb-0  px-4 py-5  d-flex align-items-center justify-content-center">
                                <div class="my-n4 py-1 text-center">
                                    <img src="/public/assets/img/non_verified.png" alt=""
                                        class="w-xxl-130px w-90px d-block">
                                    <a href="/seller/shop/apply_for_verification.php"
                                        class="btn btn-sm btn-primary">Verify Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <a href="/seller/money_withdraw_requests.php"
                                class="card mb-4 p-4 text-center bg-soft-primary h-180px">
                                <div class="fs-16 fw-600 text-primary">
                                    Money Withdraw
                                </div>
                                <div class="m-3">
                                    <svg id="Group_22725" data-name="Group 22725" xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                        viewBox="0 0 48 48">
                                        <path id="Path_108"
                                            d="M24,28.5A1.538,1.538,0,0,1,25.5,30v6a1.5,1.5,0,0,1-3,0V30A1.538,1.538,0,0,1,24,28.5"
                                            fill="#2E294E" />
                                        <path id="Path_109"
                                            d="M36,21H33V43.5A1.538,1.538,0,0,1,31.5,45h-15A1.538,1.538,0,0,1,15,43.5V21H12V43.5A4.481,4.481,0,0,0,16.5,48h15A4.481,4.481,0,0,0,36,43.5Z"
                                            fill="#2E294E" />
                                        <path id="Path_110"
                                            d="M43.5,0H4.5A4.481,4.481,0,0,0,0,4.5v9A4.481,4.481,0,0,0,4.5,18h39A4.481,4.481,0,0,0,48,13.5v-9A4.481,4.481,0,0,0,43.5,0M45,13.5A1.538,1.538,0,0,1,43.5,15H4.5A1.538,1.538,0,0,1,3,13.5v-9A1.538,1.538,0,0,1,4.5,3h39A1.538,1.538,0,0,1,45,4.5Z"
                                            fill="#2E294E" />
                                        <path id="Path_111" d="M28.5,21h-9a4.5,4.5,0,0,0,9,0" fill="#2E294E" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <a href="/seller/products/index.php" class="card mb-4 p-4 text-center h-180px">
                                <div class="fs-16 fw-600 text-primary">
                                    Add New Product
                                </div>
                                <div class="m-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                        <g id="Group_22724" data-name="Group 22724" transform="translate(-1284 -875)">
                                            <rect id="Rectangle_17080" data-name="Rectangle 17080" width="2" height="48" rx="1"
                                                transform="translate(1307 875)" fill="#2E294E" />
                                            <rect id="Rectangle_17081" data-name="Rectangle 17081" width="2" height="48" rx="1"
                                                transform="translate(1332 898) rotate(90)" fill="#2E294E" />
                                        </g>
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="card mb-4 p-4 text-center bg-soft-primary">
                                <div class="fs-16 fw-600 text-primary">
                                    Shop Settings
                                </div>
                                <div class=" m-3">
                                    <svg id="Group_31" data-name="Group 31" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 32 32">
                                        <path id="Path_78" data-name="Path 78"
                                            d="M2,25.723a1,1,0,0,0,.629.928L16,32l3.361-1.344a.5.5,0,0,0-.186-.965.491.491,0,0,0-.185.036L16,30.923l-13-5.2v-11.6a4.428,4.428,0,0,1-1-.2Z"
                                            fill="#2E294E" />
                                        <path id="Path_79" data-name="Path 79"
                                            d="M19.681,24.189a.5.5,0,0,0-.5-.5.493.493,0,0,0-.186.036l-3,1.2L7.432,21.5a.5.5,0,0,0-.65.278.512.512,0,0,0-.035.186.5.5,0,0,0,.314.464L16,26l3.367-1.347a.5.5,0,0,0,.314-.464"
                                            fill="#2E294E" />
                                        <path id="Path_80" data-name="Path 80"
                                            d="M31.5,25.126h-.087a1.368,1.368,0,0,1-.967-2.336l.061-.061a.5.5,0,0,0,0-.707l-.265-.265-.264-.264a.5.5,0,0,0-.707,0l-.061.06a1.368,1.368,0,0,1-2.336-.967V20.5a.5.5,0,0,0-.5-.5h-.748a.5.5,0,0,0-.5.5v.086a1.368,1.368,0,0,1-2.336.967l-.061-.06a.5.5,0,0,0-.707,0l-.265.264-.265.265a.5.5,0,0,0,0,.707l.061.061a1.368,1.368,0,0,1-.967,2.336H20.5a.5.5,0,0,0-.5.5v.748a.5.5,0,0,0,.5.5h.086a1.368,1.368,0,0,1,.967,2.336l-.061.061a.5.5,0,0,0,0,.707l.265.264.265.265a.5.5,0,0,0,.707,0l.061-.061a1.368,1.368,0,0,1,2.336.968V31.5a.5.5,0,0,0,.5.5h.748a.5.5,0,0,0,.5-.5v-.086a1.368,1.368,0,0,1,2.336-.968l.061.061a.5.5,0,0,0,.707,0l.264-.265.265-.264a.5.5,0,0,0,0-.707l-.061-.061a1.368,1.368,0,0,1,.967-2.336H31.5a.5.5,0,0,0,.5-.5v-.748a.5.5,0,0,0-.5-.5M29.171,29a2.373,2.373,0,0,0,.118.285,2.368,2.368,0,0,0-3.171,1.078,2.22,2.22,0,0,0-.118.285,2.369,2.369,0,0,0-3-1.481,2.516,2.516,0,0,0-.285.118A2.367,2.367,0,0,0,21.348,26a2.369,2.369,0,0,0,1.48-3,2.344,2.344,0,0,0-.118-.285,2.37,2.37,0,0,0,3.172-1.077A2.516,2.516,0,0,0,26,21.348a2.367,2.367,0,0,0,3,1.48,2.28,2.28,0,0,0,.285-.118,2.37,2.37,0,0,0,1.077,3.172,2.457,2.457,0,0,0,.286.118,2.367,2.367,0,0,0-1.481,3"
                                            fill="#2E294E" />
                                        <path id="Path_81" data-name="Path 81" d="M27.5,26A1.5,1.5,0,1,0,26,27.5,1.5,1.5,0,0,0,27.5,26"
                                            fill="#2E294E" />
                                        <path id="Path_82" data-name="Path 82"
                                            d="M16,0A46.43,46.43,0,0,1,0,8.4v2a3.451,3.451,0,0,0,5.333,2.133,3.452,3.452,0,0,0,5.333,2.134A3.453,3.453,0,0,0,16,16.8a3.451,3.451,0,0,0,5.333-2.133,3.451,3.451,0,0,0,5.333-2.134A3.454,3.454,0,0,0,32,10.4v-2A46.421,46.421,0,0,1,16,0M31.021,10.194a2.452,2.452,0,0,1-3.788,1.515,1,1,0,0,0-1.545.618A2.453,2.453,0,0,1,21.9,13.843a1,1,0,0,0-1.545.618A2.451,2.451,0,0,1,16,15.434a2.452,2.452,0,0,1-4.355-.973,1,1,0,0,0-1.545-.618,2.454,2.454,0,0,1-3.789-1.516,1,1,0,0,0-1.184-.772,1.015,1.015,0,0,0-.361.154A2.451,2.451,0,0,1,.978,10.194V9.148A47.458,47.458,0,0,0,16,1.277,47.442,47.442,0,0,0,31.021,9.148Z"
                                            fill="#2E294E" />
                                    </svg>
                                </div>
                                <a href="/seller/shop/index.php" class="btn btn-primary">
                                    Go to setting
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="card mb-4 p-4 text-center bg-soft-primary">
                                <div class="fs-16 fw-600 text-primary">
                                    Payment Settings
                                </div>
                                <div class=" m-3">
                                    <svg id="Group_30" data-name="Group 30" xmlns="http://www.w3.org/2000/svg" width="31.999" height="32"
                                        viewBox="0 0 31.999 32">
                                        <path id="Path_83" data-name="Path 83"
                                            d="M96.2,30.593a.5.5,0,0,1,.314-.464L103.6,27.3a.484.484,0,0,1,.185-.036.5.5,0,0,1,.185.965l-7.087,2.831a.5.5,0,0,1-.686-.464"
                                            transform="translate(-92.946 -10)" fill="#2E294E" />
                                        <path id="Path_84" data-name="Path 84"
                                            d="M96.2,33.537a.5.5,0,0,1,.314-.464l4.615-1.844a.493.493,0,0,1,.186-.036.5.5,0,0,1,.186.964L96.887,34a.5.5,0,0,1-.686-.464"
                                            transform="translate(-92.946 -10)" fill="#2E294E" />
                                        <path id="Path_85" data-name="Path 85"
                                            d="M117.171,10a2.017,2.017,0,0,0-.744.143L94.205,19.021a2,2,0,0,0-1.259,1.857V40a2,2,0,0,0,2.746,1.857l15.795-6.31a.5.5,0,1,0-.372-.929L95.32,40.928a.985.985,0,0,1-.372.072,1,1,0,0,1-1-1V28.7l24.225-9.679v8.306a.5.5,0,0,0,1,0V12a2,2,0,0,0-2-2m1,5.82L93.947,25.5v-4.62a1,1,0,0,1,.63-.928L116.8,11.071a1,1,0,0,1,1.373.929Z"
                                            transform="translate(-92.946 -10)" fill="#2E294E" />
                                        <path id="Path_86" data-name="Path 86"
                                            d="M123.686,32.181,115.1,28.752a4.007,4.007,0,0,0-7.193-1.8l2.671,1.067a1,1,0,1,1-.744,1.857l-2.671-1.067a4.005,4.005,0,0,0,6.449,3.654L122.2,35.9a2,2,0,1,0,1.487-3.714m.186,2.228a1,1,0,0,1-1.3.557L113.4,31.3a3.006,3.006,0,0,1-5.08-.952l1.149.459a2,2,0,1,0,1.488-3.714l-1.149-.459a3,3,0,0,1,4.336,2.809l9.173,3.665a1,1,0,0,1,.558,1.3"
                                            transform="translate(-92.946 -10)" fill="#2E294E" />
                                    </svg>
                                </div>
                                <a href="/seller/shop/profile.php" class="btn btn-primary">
                                    Configure Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title text-primary">
                                <h6 class="mb-0">Top 12 Products</h6>
                            </div>
                            <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"
                                data-md-items="3" data-sm-items="2" data-arrows='true'>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto border-sm-top">
                    <p class="mb-0">&copy; Gmarket Viet Nam v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->



    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>



    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
                        _token: 'WHlv8s3iHwKLAGXuo3YNzXWSxeiLQwI3HCTT6iXe',
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
    <script>
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

</body>

</html>