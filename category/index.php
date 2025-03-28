<?php
include_once("../config.php");
if (isset($_GET['path']) && $_GET['path'] != "") {
    $path = $_GET['path'];

    $checkExist = fetch_array("SELECT * FROM categories WHERE path='$path' LIMIT 1");
    if (!$checkExist) {
        die("Url đã bị gỡ");
    } else {
        $categoryId = $checkExist['id'];

        $products = fetch_all("SELECT * FROM products WHERE category_id='$categoryId'");

        if (!$products) {
            die("Không có sản phẩm nào trong danh mục này.");
        }
    }
} else {
    die("Url không tồn tại");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="csrf-token" content="aCXlmkGIF8M5mTlqrTsNo6sGJQysBJlDUqOh9JGt">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">

    <title></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="" />
    <meta name="keywords" content="GMARKETVN">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">

    <!-- Open Graph data -->
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="GMARKETVN">
    <meta itemprop="description" content="Buy Korean domestic products at original prices from the manufacturer">
    <meta itemprop="image" content="https://gmarketagents.com/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="GMARKETVN">
    <meta name="twitter:description" content="Buy Korean domestic products at original prices from the manufacturer">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="https://gmarketagents.com/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">

    <!-- Open Graph data -->
    <meta property="og:title" content="GMARKETVN" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://gmarketagents.com" />
    <meta property="og:image" content="https://gmarketagents.com/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg" />
    <meta property="og:description" content="Buy Korean domestic products at original prices from the manufacturer" />
    <meta property="og:site_name" content="GMARKETVN" />
    <meta property="fb:app_id" content="">

    <!-- Favicon -->
    <link rel="icon" href="https://gmarketagents.com/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">

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



    WELCOME TO GMARKETVN !
</head>

<body>

    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column">

        <!-- Header -->
        <?php include("../layout/header.php") ?>



        <section class="mb-4 pt-3">
            <div class="container sm-px-0">
                <form class="" id="search-form" action="" method="GET">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                                <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                                <div class="collapse-sidebar c-scrollbar-light text-left">
                                    <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                        <h3 class="h6 mb-0 fw-600">Filters</h3>
                                        <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                                            <i class="las la-times la-2x"></i>
                                        </button>
                                    </div>
                                    <div class="bg-white shadow-sm rounded mb-3">
                                        <div class="fs-15 fw-600 p-3 border-bottom">
                                            <a href="#collapse_1" class="dropdown-toggle filter-section text-dark" data-toggle="collapse">
                                                Categories
                                            </a>
                                        </div>
                                        <div class="collapse show" id="collapse_1">
                                            <ul class="p-3 list-unstyled">
                                                <li class="mb-2">
                                                    <a class="text-reset fs-14 fw-600" href="https://gmarketagents.com/search">
                                                        <i class="las la-angle-left"></i>
                                                        All categories
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a class="text-reset fs-14 fw-600" href="https://gmarketagents.com/category/Mens-clothing-PjXnt">
                                                        <i class="las la-angle-left"></i>
                                                        Men&#039;s clothing
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bg-white shadow-sm rounded mb-3">
                                        <div class="fs-15 fw-600 p-3 border-bottom">
                                            Price range
                                        </div>
                                        <div class="p-3">
                                            <div class="aiz-range-slider">
                                                <div
                                                    id="input-slider-range"
                                                    data-range-value-min=" 0.13 "
                                                    data-range-value-max=" 15000 "></div>

                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                            data-range-value-low="6"
                                                            id="input-slider-range-value-low"></span>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                            data-range-value-high="18.52"
                                                            id="input-slider-range-value-high"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="bg-white shadow-sm rounded mb-3">
                                        <div class="fs-15 fw-600 p-3 border-bottom">
                                            <a href="#" class="dropdown-toggle text-dark filter-section collapsed" data-toggle="collapse" data-target="#collapse_color">
                                                Filter by color
                                            </a>
                                        </div>
                                        <div class="collapse" id="collapse_color">
                                            <div class="p-3 aiz-radio-inline">
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="IndianRed">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#CD5C5C"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #CD5C5C;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightCoral">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F08080"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F08080;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Salmon">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FA8072"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FA8072;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkSalmon">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#E9967A"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #E9967A;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightSalmon">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFA07A"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFA07A;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Crimson">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#DC143C"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #DC143C;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Red">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF0000"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF0000;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="FireBrick">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#B22222"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #B22222;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkRed">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#8B0000"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #8B0000;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Pink">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFC0CB"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFC0CB;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightPink">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFB6C1"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFB6C1;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="HotPink">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF69B4"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF69B4;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DeepPink">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF1493"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF1493;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumVioletRed">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#C71585"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #C71585;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="PaleVioletRed">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#DB7093"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #DB7093;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightSalmon">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFA07A"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFA07A;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Coral">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF7F50"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF7F50;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Tomato">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF6347"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF6347;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="OrangeRed">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF4500"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF4500;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkOrange">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF8C00"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF8C00;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Orange">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFA500"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFA500;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Gold">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFD700"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFD700;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Yellow">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFFF00"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFFF00;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightYellow">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFFFE0"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFFFE0;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LemonChiffon">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFFACD"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFFACD;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightGoldenrodYellow">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FAFAD2"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FAFAD2;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="PapayaWhip">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFEFD5"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFEFD5;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Moccasin">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFE4B5"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFE4B5;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="PeachPuff">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFDAB9"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFDAB9;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="PaleGoldenrod">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#EEE8AA"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #EEE8AA;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Khaki">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F0E68C"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F0E68C;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkKhaki">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#BDB76B"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #BDB76B;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Lavender">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#E6E6FA"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #E6E6FA;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Thistle">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#D8BFD8"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #D8BFD8;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Plum">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#DDA0DD"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #DDA0DD;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Violet">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#EE82EE"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #EE82EE;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Orchid">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#DA70D6"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #DA70D6;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Fuchsia">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF00FF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF00FF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Magenta">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FF00FF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FF00FF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumOrchid">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#BA55D3"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #BA55D3;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumPurple">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#9370DB"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #9370DB;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Amethyst">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#9966CC"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #9966CC;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="BlueViolet">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#8A2BE2"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #8A2BE2;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkViolet">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#9400D3"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #9400D3;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkOrchid">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#9932CC"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #9932CC;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkMagenta">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#8B008B"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #8B008B;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Purple">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#800080"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #800080;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Indigo">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#4B0082"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #4B0082;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="SlateBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#6A5ACD"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #6A5ACD;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkSlateBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#483D8B"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #483D8B;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumSlateBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#7B68EE"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #7B68EE;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="GreenYellow">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#ADFF2F"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #ADFF2F;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Chartreuse">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#7FFF00"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #7FFF00;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LawnGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#7CFC00"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #7CFC00;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Lime">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#00FF00"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #00FF00;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LimeGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#32CD32"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #32CD32;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="PaleGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#98FB98"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #98FB98;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#90EE90"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #90EE90;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumSpringGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#00FA9A"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #00FA9A;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="SpringGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#00FF7F"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #00FF7F;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumSeaGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#3CB371"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #3CB371;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="SeaGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#2E8B57"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #2E8B57;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="ForestGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#228B22"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #228B22;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Green">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#008000"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #008000;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#006400"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #006400;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="YellowGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#9ACD32"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #9ACD32;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="OliveDrab">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#6B8E23"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #6B8E23;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Olive">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#808000"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #808000;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkOliveGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#556B2F"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #556B2F;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumAquamarine">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#66CDAA"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #66CDAA;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkSeaGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#8FBC8F"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #8FBC8F;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightSeaGreen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#20B2AA"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #20B2AA;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkCyan">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#008B8B"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #008B8B;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Teal">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#008080"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #008080;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Aqua">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#00FFFF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #00FFFF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Cyan">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#00FFFF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #00FFFF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightCyan">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#E0FFFF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #E0FFFF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="PaleTurquoise">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#AFEEEE"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #AFEEEE;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Aquamarine">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#7FFFD4"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #7FFFD4;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Turquoise">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#40E0D0"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #40E0D0;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumTurquoise">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#48D1CC"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #48D1CC;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkTurquoise">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#00CED1"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #00CED1;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="CadetBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#5F9EA0"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #5F9EA0;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="SteelBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#4682B4"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #4682B4;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightSteelBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#B0C4DE"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #B0C4DE;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="PowderBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#B0E0E6"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #B0E0E6;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#ADD8E6"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #ADD8E6;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="SkyBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#87CEEB"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #87CEEB;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightSkyBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#87CEFA"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #87CEFA;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DeepSkyBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#00BFFF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #00BFFF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DodgerBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#1E90FF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #1E90FF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="CornflowerBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#6495ED"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #6495ED;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumSlateBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#7B68EE"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #7B68EE;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="RoyalBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#4169E1"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #4169E1;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Blue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#0000FF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #0000FF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MediumBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#0000CD"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #0000CD;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#00008B"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #00008B;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Navy">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#000080"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #000080;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MidnightBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#191970"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #191970;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Cornsilk">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFF8DC"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFF8DC;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="BlanchedAlmond">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFEBCD"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFEBCD;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Bisque">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFE4C4"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFE4C4;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="NavajoWhite">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFDEAD"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFDEAD;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Wheat">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F5DEB3"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F5DEB3;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="BurlyWood">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#DEB887"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #DEB887;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Tan">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#D2B48C"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #D2B48C;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="RosyBrown">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#BC8F8F"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #BC8F8F;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="SandyBrown">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F4A460"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F4A460;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Goldenrod">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#DAA520"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #DAA520;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkGoldenrod">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#B8860B"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #B8860B;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Peru">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#CD853F"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #CD853F;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Chocolate">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#D2691E"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #D2691E;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="SaddleBrown">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#8B4513"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #8B4513;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Sienna">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#A0522D"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #A0522D;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Brown">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#A52A2A"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #A52A2A;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Maroon">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#800000"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #800000;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="White">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFFFFF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFFFFF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Snow">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFFAFA"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFFAFA;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Honeydew">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F0FFF0"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F0FFF0;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MintCream">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F5FFFA"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F5FFFA;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Azure">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F0FFFF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F0FFFF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="AliceBlue">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F0F8FF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F0F8FF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="GhostWhite">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F8F8FF"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F8F8FF;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="WhiteSmoke">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F5F5F5"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F5F5F5;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Seashell">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFF5EE"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFF5EE;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Beige">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#F5F5DC"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #F5F5DC;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="OldLace">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FDF5E6"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FDF5E6;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="FloralWhite">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFFAF0"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFFAF0;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Ivory">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFFFF0"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFFFF0;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="AntiqueWhite">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FAEBD7"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FAEBD7;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Linen">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FAF0E6"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FAF0E6;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LavenderBlush">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFF0F5"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFF0F5;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="MistyRose">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#FFE4E1"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #FFE4E1;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Gainsboro">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#DCDCDC"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #DCDCDC;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightGrey">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#D3D3D3"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #D3D3D3;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Silver">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#C0C0C0"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #C0C0C0;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkGray">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#A9A9A9"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #A9A9A9;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Gray">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#808080"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #808080;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DimGray">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#696969"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #696969;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="LightSlateGray">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#778899"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #778899;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="SlateGray">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#708090"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #708090;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="DarkSlateGray">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#2F4F4F"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #2F4F4F;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="Black">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="#000000"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: #000000;"></span>
                                                    </span>
                                                </label>
                                                <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="M2ProMacBookPro14”and16”">
                                                    <input
                                                        type="radio"
                                                        name="color"
                                                        value="Space Gray"
                                                        onchange="filter()">
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded" style="background: Space Gray;"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9">

                            <ul class="breadcrumb bg-transparent p-0">
                                <li class="breadcrumb-item opacity-50">
                                    <a class="text-reset" href="https://gmarketagents.com">Home</a>
                                </li>
                                <li class="breadcrumb-item opacity-50">
                                    <a class="text-reset" href="https://gmarketagents.com/search">All categories</a>
                                </li>
                                <li class="text-dark fw-600 breadcrumb-item">
                                    <a class="text-reset" href="https://gmarketagents.com/category/Mens-clothing-PjXnt">"Men&#039;s clothing"</a>
                                </li>
                            </ul>

                            <div class="text-left">
                                <div class="row gutters-5 flex-wrap align-items-center">
                                    <div class="col-lg col-10">
                                        <h1 class="h6 fw-600 text-body">
                                            Men&#039;s clothing
                                        </h1>
                                        <input type="hidden" name="keyword" value="">
                                    </div>
                                    <div class="col-2 col-lg-auto d-xl-none mb-lg-3 text-right">
                                        <button type="button" class="btn btn-icon p-0" data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                                            <i class="la la-filter la-2x"></i>
                                        </button>
                                    </div>
                                    <div class="col-6 col-lg-auto mb-3 w-lg-200px">
                                        <label class="mb-0 opacity-50">Brands</label>
                                        <select class="form-control form-control-sm aiz-selectpicker" data-live-search="true" name="brand" onchange="filter()">
                                            <option value="">All Brands</option>
                                            <option value="APPLE-y0nFH">APPLE</option>
                                            <option value="Microsoft-Ay0K8">Microsoft</option>
                                            <option value="Samsung-sjRm8">Samsung</option>
                                            <option value="Intel-VAP4F">Intel</option>
                                            <option value="Philips-n8s93">Philips</option>
                                            <option value="Xiaomi-H1gI1">Xiaomi</option>
                                            <option value="Huawei-oyyXS">Huawei</option>
                                            <option value="Nike-hg8T0">Nike</option>
                                            <option value="Adidas-l6cRe">Adidas</option>
                                            <option value="Puma-xzpP6">Puma</option>
                                            <option value="New-Balance-x51Mv">New Balance</option>
                                            <option value="Converse-2Qiuq">Converse</option>
                                            <option value="Skechers-MZjlM">Skechers</option>
                                            <option value="Reebok-BMMuf">Reebok</option>
                                            <option value="Vans-1zGPW">Vans</option>
                                            <option value="Gucci-ZbRPq">Gucci</option>
                                            <option value="Louis-Vutton-mFk5R">Louis Vutton</option>
                                            <option value="Hermes-xFTIb">Hermes</option>
                                            <option value="Prada-xZP7c">Prada</option>
                                            <option value="Channel-83fxp">Channel</option>
                                            <option value="FenDi-Yt8iR">FenDi</option>
                                            <option value="Givenchy-ttMLl">Givenchy</option>
                                            <option value="Dior-Gz1b5">Dior</option>
                                            <option value="Versace-NImJ8">Versace</option>
                                            <option value="Cartier-37Ll0">Cartier</option>
                                            <option value="Balenciaga-UnuTm">Balenciaga</option>
                                            <option value="Valentino-sB20E">Valentino</option>
                                            <option value="Chlo-3sl3D">Chloé</option>
                                            <option value="Coach-9WC30">Coach</option>
                                            <option value="Zara-cF5HJ">Zara</option>
                                            <option value="DG-kcgs2">D&amp;G</option>
                                            <option value="Rolex-z8BKo">Rolex</option>
                                            <option value="Tom-Ford-bNA0T">Tom Ford</option>
                                            <option value="Boss-dQHyV">Boss</option>
                                            <option value="Calvin-Klein-YMNuT">Calvin Klein</option>
                                            <option value="Lacoste-6bgeq">Lacoste</option>
                                            <option value="YSL-A5B7k">Y.S.L</option>
                                            <option value="Victoria-Secret-b7x0x">Victoria Secret</option>
                                            <option value="Giorgio-Armani-Bpz3g">Giorgio Armani</option>
                                            <option value="Tommy-fQgzA">Tommy</option>
                                            <option value="Burberry-mdgxx">Burberry</option>
                                            <option value="Louboutin-s8g2T">Louboutin</option>
                                            <option value="Bior-aWVe0">Bioré</option>
                                            <option value="Bio-Oil-YrmxL">Bio Oil</option>
                                            <option value="Angel-Eyes-cmPD4">Angel Eyes</option>
                                            <option value="Panasonic-g3FOL">Panasonic</option>
                                            <option value="Toshiba-1jzhk">Toshiba</option>
                                            <option value="MLB-nYsAr">MLB</option>
                                            <option value="ROCKROOSTER-WfpRU">ROCKROOSTER</option>
                                            <option value="champion-etzhk">Champion</option>
                                            <option value="Shengtang-Home-Furnishing-Museum-ovnEP">Shengtang Home Furnishing Museum</option>
                                            <option value="Qifanhai-l5Bda">Qifanhai</option>
                                            <option value="Haofeimei-aJSSv">Haofeimei</option>
                                            <option value="VATARVanda-Furniture-n5IEe">VATAR/Vanda Furniture</option>
                                            <option value="Jane-Fina-kaYK8">Jane Fina</option>
                                            <option value="Fareanar-ZSRG8">Fareanar</option>
                                            <option value="Muyoka-mGsiB">Muyoka</option>
                                            <option value="DKEA-CFXzb">DKEA</option>
                                            <option value="rakuten-z2bwg">Gmarket</option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-lg-auto mb-3 w-lg-200px">
                                        <label class="mb-0 opacity-50">Sort by</label>
                                        <select class="form-control form-control-sm aiz-selectpicker" name="sort_by" onchange="filter()">
                                            <option value="newest">Newest</option>
                                            <option value="oldest">Oldest</option>
                                            <option value="price-asc">Price low to high</option>
                                            <option value="price-desc">Price high to low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="min_price" value="">
                            <input type="hidden" name="max_price" value="">
                            <div class="row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2">
                                <?php

                                $cate = fetch_array("SELECT * FROM categories WHERE path='$path' LIMIT 1");
                                if ($cate && !isset($_GET['page']) ) {
                                    $sql = mysqli_query($conn, "SELECT * FROM products WHERE category_id='{$cate['id']}'");
                                    while ($row = fetch_assoc($sql)) {
                                        $file=fetch_array("SELECT * FROM file WHERE id='{$row['thumbnail_image']}' LIMIT 1");
                                ?>
                                        <div class="col">
                                            <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
                                                <div class="position-relative">
                                                    <a href="/product/<?=$row['id']?>" class="d-block">
                                                        <img class="img-fit mx-auto h-140px h-md-210px lazyloaded" src="/public/uploads/all/<?=$file['src']?>" data-src="/public/uploads/all/<?=$file['src']?>" alt="Women Shirt 2022 Summer Autumn Turn Down Collar Long Sleeves Blouses New Korean Flower Printing Female Clothing Shirts T27601X" onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">
                                                    </a>
                                                    <div class="absolute-top-right aiz-p-hov-icon">
                                                        <a href="javascript:void(0)" onclick="addToWishList(<?=$row['id']?>)" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                            <i class="la la-heart-o"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="addToCompare(<?=$row['id']?>)" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                            <i class="las la-sync"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" onclick="showAddToCartModal(<?=$row['id']?>)" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                            <i class="las la-shopping-cart"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="p-md-3 p-2 text-left">
                                                    <div class="fs-15">
                                                        <span class="fw-700 text-primary"><?=$row['unit_price']?>$</span>
                                                    </div>
                                                    <div class="rating rating-sm mt-1">
                                                        <i class="las la-star"></i><i class="las la-star"></i><i class="las la-star"></i><i class="las la-star"></i><i class="las la-star"></i>
                                                    </div>
                                                    <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                        <a href="/product/<?=$row['id']?>" class="d-block text-reset"><?=$row['name']?></a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>

                                <?php }
                                } ?>





















                                <?php
                                $elements = $xpath->query("//div[contains(@class, 'row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2')]");
                                foreach ($elements as $element) {
                                    foreach ($element->childNodes as $child) {
                                        // In ra thẻ con
                                        if ($child->nodeType === XML_ELEMENT_NODE) {
                                            $c = str_replace("https://gmarketagents.com/product", "/product", $dom->saveHTML($child));
                                            echo $c;
                                        }
                                    }
                                }
                                ?>


                                <!-- <div class="col">
                                    <div class="aiz-card-box border border-light rounded hov-shadow-md mt-1 mb-2 has-transition bg-white">
                                        <div class="position-relative">
                                            <a href="https://gmarketagents.com/product/2-piece-set-outfits-mens-sweatshirt-set-hoodies-sets-tracksuit-spring-and-autumn-jogger-suit-male-pullover-winter-casual-clothes-7Njv5" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                    src="https://gmarketagents.com/public/assets/img/placeholder.jpg"
                                                    data-src="https://gmarketagents.com/public/uploads/all/UtAJwKLw1edCzf0YJ2YQ0giiQ15rYvLaKLkDov9m.png"
                                                    alt="2 Piece Set Outfits Mens Sweatshirt Set Hoodies Sets Tracksuit Spring and Autumn Jogger Suit Male Pullover Winter Casual Clothes"
                                                    onerror="this.onerror=null;this.src='https://gmarketagents.com/public/assets/img/placeholder.jpg';">
                                            </a>
                                            <div class="absolute-top-right aiz-p-hov-icon">
                                                <a href="javascript:void(0)" onclick="addToWishList(91957)" data-toggle="tooltip" data-title="Add to wishlist" data-placement="left">
                                                    <i class="la la-heart-o"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="addToCompare(91957)" data-toggle="tooltip" data-title="Add to compare" data-placement="left">
                                                    <i class="las la-sync"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="showAddToCartModal(91957)" data-toggle="tooltip" data-title="Add to cart" data-placement="left">
                                                    <i class="las la-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                <span class="fw-700 text-primary">16.90$</span>
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                <i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i><i class='las la-star'></i>
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                <a href="https://gmarketagents.com/product/2-piece-set-outfits-mens-sweatshirt-set-hoodies-sets-tracksuit-spring-and-autumn-jogger-suit-male-pullover-winter-casual-clothes-7Njv5" class="d-block text-reset">2 Piece Set Outfits Mens Sweatshirt Set Hoodies Sets Tracksuit Spring and Autumn Jogger Suit Male Pullover Winter Casual Clothes</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div> -->










                            </div>
                            <div class="aiz-pagination aiz-pagination-center mt-4">
                                <?php

                                $elements = $xpath->query("//div[contains(@class, 'aiz-pagination aiz-pagination-center mt-4')]");
                                foreach ($elements as $element) {
                                    foreach ($element->childNodes as $child) {
                                        // In ra thẻ con
                                        if ($child->nodeType === XML_ELEMENT_NODE) {
                                            $c = str_replace("https://gmarketagents.com/category/", "", $dom->saveHTML($child));


                                            echo $c;
                                        }
                                    }
                                }
                                ?>
                                <!-- <nav>
                                    <ul class="pagination">

                                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                        </li>

                                        <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=2">2</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=3">3</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=4">4</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=5">5</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=6">6</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=7">7</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=8">8</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=9">9</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=10">10</a></li>

                                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>

                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=288">288</a></li>
                                        <li class="page-item"><a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=289">289</a></li>

                                        <li class="page-item">
                                            <a class="page-link" href="https://gmarketagents.com/category/Mens-clothing-PjXnt?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
                                        </li>
                                    </ul>
                                </nav> -->





                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>


        <section class="bg-white border-top mt-auto">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-3 col-md-6">
                        <a class="text-reset border-left text-center p-4 d-block" href="https://gmarketagents.com/terms">
                            <i class="la la-file-text la-3x text-primary mb-2"></i>
                            <h4 class="h6">Terms &amp; conditions</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a class="text-reset border-left text-center p-4 d-block" href="https://gmarketagents.com/return-policy">
                            <i class="la la-mail-reply la-3x text-primary mb-2"></i>
                            <h4 class="h6">Return policy</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a class="text-reset border-left text-center p-4 d-block" href="https://gmarketagents.com/support-policy">
                            <i class="la la-support la-3x text-primary mb-2"></i>
                            <h4 class="h6">Support Policy</h4>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a class="text-reset border-left border-right text-center p-4 d-block" href="https://gmarketagents.com/privacy-policy">
                            <i class="las la-exclamation-circle la-3x text-primary mb-2"></i>
                            <h4 class="h6">Privacy policy</h4>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <?php include("../layout/footer.php")?>


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
                        $.post('https://gmarketagents.com/currency', {
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
                $.post('https://gmarketagents.com/ajax-search', {
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
            $.post('https://gmarketagents.com/cart/removeFromCart', {
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
            $.post('https://gmarketagents.com/compare/addToCompare', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {
                $('#compare').html(data);
                AIZ.plugins.notify('success', "Item has been added to compare list");
                $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html()) + 1);
            });
        }

        function addToWishList(id) {
            AIZ.plugins.notify('warning', "Please login first");
        }

        function showAddToCartModal(id) {
            if (!$('#modal-size').hasClass('modal-lg')) {
                $('#modal-size').addClass('modal-lg');
            }
            $('#addToCart-modal-body').html(null);
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.post('https://gmarketagents.com/cart/show-cart-modal', {
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
                    url: 'https://gmarketagents.com/product/variant_price',
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
                    url: 'https://gmarketagents.com/cart/addtocart',
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
                    url: 'https://gmarketagents.com/cart/addtocart',
                    data: $('#option-choice-form').serializeArray(),
                    success: function(data) {
                        if (data.status == 1) {

                            $('#addToCart-modal-body').html(data.modal_view);
                            updateNavCart(data.nav_cart_view, data.cart_count);

                            window.location.replace("https://gmarketagents.com/cart");
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
        function filter() {
            $('#search-form').submit();
        }

        function rangefilter(arg) {
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
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
    <!-- Start of LiveChat (www.livechat.com) code -->
    <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 17789163;;
        (function(n, t, c) {
            function i(n) {
                return e._h ? e._h.apply(null, n) : e._q.push(n)
            }
            var e = {
                _q: [],
                _h: null,
                _v: "2.0",
                on: function() {
                    i(["on", c.call(arguments)])
                },
                once: function() {
                    i(["once", c.call(arguments)])
                },
                off: function() {
                    i(["off", c.call(arguments)])
                },
                get: function() {
                    if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load.");
                    return i(["get", c.call(arguments)])
                },
                call: function() {
                    i(["call", c.call(arguments)])
                },
                init: function() {
                    var n = t.createElement("script");
                    n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js", t.head.appendChild(n)
                }
            };
            !n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e
        }(window, document, [].slice))
    </script>
    <noscript><a href="https://www.livechat.com/chat-with/17789163/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
    <!-- End of LiveChat code -->
    <style>
        .overflow-hidden.mw-100.text-left * {
            width: auto !important;
        }
    </style>
</body>

</html>