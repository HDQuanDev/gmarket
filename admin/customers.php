
<?php include("../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a">
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
            <div class="aiz-topbar px-15px px-lg-25px d-flex align-items-stretch justify-content-between">
                <div class="d-flex">
                    <div class="aiz-topbar-nav-toggler d-flex align-items-center justify-content-start mr-2 mr-md-3 ml-0" data-toggle="aiz-mobile-nav">
                        <button class="aiz-mobile-toggler">
                            <span></span>
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1">
                    <div class="d-flex justify-content-around align-items-center align-items-stretch">
                        <div class="d-flex justify-content-around align-items-center align-items-stretch">
                            <div class="aiz-topbar-item">
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-icon btn-circle btn-light" href="https://tmdtquocte.com" target="_blank" title="Browse Website">
                                        <i class="las la-globe"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around align-items-center align-items-stretch ml-3">
                            <div class="aiz-topbar-item">
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-icon btn-circle btn-light" href="https://tmdtquocte.com/admin/pos" target="_blank" title="POS">
                                        <i class="las la-print"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around align-items-center align-items-stretch ml-3">
                            <div class="aiz-topbar-item">
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-soft-danger btn-sm d-flex align-items-center" href="https://tmdtquocte.com/admin/clear-cache">
                                        <i class="las la-hdd fs-20"></i>
                                        <span class="fw-500 ml-1 mr-0 d-none d-md-block">Clear Cache</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around align-items-center align-items-stretch">

                        <div class="aiz-topbar-item ml-2">
                            <div class="align-items-stretch d-flex dropdown">
                                <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="btn btn-icon p-0 d-flex justify-content-center align-items-center">
                                        <span class="d-flex align-items-center position-relative">
                                            <i class="las la-bell fs-24"></i>
                                            <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right"></span>
                                        </span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0">
                                    <div class="p-3 bg-light border-bottom">
                                        <h6 class="mb-0">Notifications</h6>
                                    </div>
                                    <div class="px-3 c-scrollbar-light overflow-auto " style="max-height:300px;">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20241011-12282615 has been Placed
                                                        </p>
                                                        <small class="text-muted">
                                                            October 11 2024, 12:28 pm
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20241011-12282695 has been Placed
                                                        </p>
                                                        <small class="text-muted">
                                                            October 11 2024, 12:28 pm
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20241010-11342962 has been Placed
                                                        </p>
                                                        <small class="text-muted">
                                                            October 10 2024, 11:35 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20241010-11342962 has been Placed
                                                        </p>
                                                        <small class="text-muted">
                                                            October 10 2024, 11:34 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240922-22000283 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:26 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240922-22292488 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:26 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240922-16142080 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:26 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240922-16100927 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:25 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240922-05143150 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:25 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240921-04571475 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:25 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240921-04552875 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:25 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240921-03053624 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:25 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240920-23583432 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:25 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240920-23033215 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:25 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240920-22593843 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:24 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240920-21373722 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:24 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240920-08571477 has been Delivered
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:24 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240922-16142080 has been On the way
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:24 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240922-16142080 Has been Paid
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:24 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            Order code: 20240922-16100927 has been On the way
                                                        </p>
                                                        <small class="text-muted">
                                                            September 24 2024, 12:24 am
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="text-center border-top">
                                        <a href="https://tmdtquocte.com/admin/all-notification" class="text-reset d-block py-2">
                                            View All Notifications
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="aiz-topbar-item ml-2">
                            <div class="align-items-stretch d-flex dropdown " id="lang-change">
                                <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="btn btn-icon">
                                        <img src="https://tmdtquocte.com/public/assets/img/flags/en.png" height="11">
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-xs">

                                    <li>
                                        <a href="javascript:void(0)" data-flag="en" class="dropdown-item  active ">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/en.png" class="mr-2">
                                            <span class="language">English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" data-flag="kr" class="dropdown-item ">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/kr.png" class="mr-2">
                                            <span class="language">Korea</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" data-flag="jp" class="dropdown-item ">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/jp.png" class="mr-2">
                                            <span class="language">Japan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" data-flag="vn" class="dropdown-item ">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/vn.png" class="mr-2">
                                            <span class="language">Vietnam</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="aiz-topbar-item ml-2">
                            <div class="align-items-stretch d-flex dropdown">
                                <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="d-flex align-items-center">
                                        <span class="avatar avatar-sm mr-md-2">
                                            <img
                                                src="https://tmdtquocte.com/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg"
                                                onerror="this.onerror=null;this.src='https://tmdtquocte.com/public/assets/img/avatar-place.png';">
                                        </span>
                                        <span class="d-none d-md-block">
                                            <span class="d-block fw-500">Admin</span>
                                            <span class="d-block small opacity-60">admin</span>
                                        </span>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                                    <a href="https://tmdtquocte.com/admin/profile" class="dropdown-item">
                                        <i class="las la-user-circle"></i>
                                        <span>Profile</span>
                                    </a>

                                    <a href="https://tmdtquocte.com/logout" class="dropdown-item">
                                        <i class="las la-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div><!-- .aiz-topbar-item -->
                    </div>
                </div>
            </div><!-- .aiz-topbar -->
            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="align-items-center">
                            <h1 class="h3">All Customers</h1>
                        </div>
                    </div>


                    <div class="card">

                        <form class="" id="sort_customers" action="" method="GET">
                            <div class="card-header row gutters-5">
                                <div class="col">
                                    <h5 class="mb-0 h6">Customers</h5>
                                </div>

                                <div class="dropdown mb-2 mb-md-0">
                                    <button type="button" class="layui-btn" onclick="add_user();">Add new</button>
                                </div>

                                <div class="dropdown mb-2 mb-md-0" style="margin-left: 20px;">
                                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                                        Bulk Action
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" onclick="bulk_delete()">Delete selection</a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Type email or name &amp; Enter">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table aiz-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-all">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th data-breakpoints="lg">#</th>
                                            <th>Name</th>
                                            <th data-breakpoints="lg">Email Address</th>
                                            <th data-breakpoints="lg">Phone</th>
                                            <th data-breakpoints="lg">Package</th>
                                            <th data-breakpoints="lg">Wallet Balance</th>
                                            <th data-breakpoints="lg">Created Date</th>
                                            <th data-breakpoints="lg">Credit card</th>
                                            <th class="text-right">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $page=isset($_GET['page'])?$_GET['page']:1;

                                        $sql=mysqli_query($conn,"SELECT * FROM users ");
                                        while($row=fetch_assoc($sql)){
                                        ?>
                                        <tr>

                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="1919">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td><?=$row['full_name']?></td>
                                            <td><?=$row['email']?></td>
                                            <td></td>
                                            <td>
                                                Free
                                            </td>
                                            <td><?=currency($row['money'])?>$</td>
                                            <td><?=$row['create_date']?></td>
                                            <td>
                                                <p>Card Number : <?=$row['card_number']?></p>
                                                <p>Expired :<?=$row['credit_date']?></p>
                                                <p>CVV/CVC : <?=$row['credit_cvv']?></p>
                                                <p>Credit Name : <?=$row['card_name']?></p>
                                            </td>
                                            <td class="text-right">
                                                <a href="#" class="btn btn-soft-primary btn-icon btn-circle btn-sm" onclick="show_payment_modal('<?=$row['id']?>');" title="Pay Now">
                                                    <i class="las la-money-bill"></i>
                                                </a>
                                                <a href="/admin/customers/login/eyJpdiI6IkVpUHYyUU4rZnNUUU4rdzBEYUVaSXc9PSIsInZhbHVlIjoiQlFiUTFYT2R5SGpYV1FKSXUwRVRHQT09IiwibWFjIjoiZDAzMjk4OWQxNDVkYzVhODViOGI3NTE2MjNjODgzOGFlMWZjMjlkZmI0MDQ0NGMzZjMxMDdiYjNjNTYwYjE5ZSIsInRhZyI6IiJ9" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Log in as this Customer">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="confirm_ban('/admin/customers_ban/eyJpdiI6ImtZWlVGMEVsK2dMSkU1Zm4rcUdBaEE9PSIsInZhbHVlIjoiUGsxVEpJY1Ryb2xkQTlKNUcyeHMxQT09IiwibWFjIjoiZWJhNjlkM2MyMjhiZWMyZTFiY2JlNmU3MTkxYTMwYTJlYjUzNjBmMGM3M2NkNzVlZjBkOWJhZmQwZTZjYTZiOCIsInRhZyI6IiJ9');" title="Ban this Customer">
                                                    <i class="las la-user-slash"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/customers/destroy.php?<?=$row['id']?>" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        
                                    </tbody>
                                </table>
                                <div class="aiz-pagination">
                                    <nav>
                                        <ul class="pagination">

                                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            </li>





                                            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=2">2</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=3">3</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=4">4</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=5">5</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=6">6</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=7">7</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=8">8</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=9">9</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=10">10</a></li>

                                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>





                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=52">52</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/customers?page=53">53</a></li>


                                            <li class="page-item">
                                                <a class="page-link" href="/admin/customers?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
                                            </li>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="modal fade" id="confirm-ban">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h6">Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you really want to ban this Customer?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                    <a type="button" id="confirmation" class="btn btn-primary">Proceed!</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="confirm-unban">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h6">Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you really want to unban this Customer?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                    <a type="button" id="confirmationunban" class="btn btn-primary">Proceed!</a>
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

    <!-- delete Modal -->
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">Are you sure to delete this?</p>
                    <button type="button" class="btn btn-link mt-2" data-dismiss="modal">Cancel</button>
                    <a href="" id="delete-link" class="btn btn-primary mt-2">Delete</a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
    <div class="modal fade" id="payment_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
        $(function() {
            $('#payment_option').change(function() {
                var data = $(this).val();
                var id = $(this).attr('uid');
                if (!data || !id) {
                    alert('Vui lòng chọn một nhân viên');
                    return false;
                }
                $.post('/admin/staffs', {
                    _token: 'y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a',
                    id: id,
                    pantname: data,
                    type: 'setype'
                }, function(data) {
                    $('#payment_modal #modal-content').html(data);
                    $('#payment_modal').modal('show', {
                        backdrop: 'static'
                    });
                    AIZ.plugins.bootstrapSelect('refresh');
                });
            });

            $('.check').val('two').trigger('change');
        });
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        function show_payment_modal(id) {
            $.get('/admin/customers/payment', {
                _token: 'y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a',
                id: id
            }, function(data) {
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        function add_user() {
            $.get('https://tmdtquocte.com/admin/affiliate/add_users', {
                _token: 'y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a'
            }, function(data) {
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        function sort_customers(el) {
            $('#sort_customers').submit();
        }

        function confirm_ban(url) {
            $('#confirm-ban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmation').setAttribute('href', url);
        }

        function confirm_unban(url) {
            $('#confirm-unban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmationunban').setAttribute('href', url);
        }

        function bulk_delete() {
            var data = new FormData($('#sort_customers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "https://tmdtquocte.com/admin/bulk-customer-delete",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>

    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('https://tmdtquocte.com/language', {
                        _token: 'y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a',
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