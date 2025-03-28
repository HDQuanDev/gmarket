<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">
    <title>GMARKETVN | Buy Korean domestic products at original prices from the manufacturer</title>

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
        <?php include("../layout/sidebar.php")?>
        
        <div class="aiz-content-wrapper">
            <?php include("../layout/topbar.php")?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="card">
                        <form class="" action="" id="sort_orders" method="GET">
                            <div class="card-header row gutters-5">
                                <div class="col">
                                    <h5 class="mb-md-0 h6">All Orders</h5>
                                </div>

                                <div class="dropdown mb-2 mb-md-0">
                                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                                        Bulk Action
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" onclick="bulk_delete()"> Delete selection</a>
                                    </div>
                                </div>

                                <div class="col-lg-2 ml-auto">
                                    <select class="form-control aiz-selectpicker" name="delivery_status" id="delivery_status">
                                        <option value="">Filter by Delivery Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="picked_up">Picked Up</option>
                                        <option value="on_the_way">On The Way</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="cancelled">Cancel</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 ml-auto">
                                    <select class="form-control aiz-selectpicker" name="payment_status" id="payment_status">
                                        <option value="">Filter by Payment Status</option>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Un-Paid</option>
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group mb-0">
                                        <input type="text" class="aiz-date-range form-control" value="" name="date" placeholder="Filter by date" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Type Order code &amp; hit Enter">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" id="search2" name="search2" placeholder="Type name or email &amp; Enter">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table aiz-table mb-0">
                                    <thead>
                                        <tr>
                                            <!--<th>#</th>-->
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
                                            <th>Order Code:</th>
                                            <th data-breakpoints="md">Num. of Products</th>
                                            <th data-breakpoints="md">Customer</th>
                                            <th data-breakpoints="md">Seller</th>
                                            <th data-breakpoints="md">Amount</th>
                                            <th data-breakpoints="md">Delivery Status</th>
                                            <th data-breakpoints="md">Payment method</th>
                                            <th data-breakpoints="md">Payment Status</th>
                                            <th class="text-right" width="15%">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5825">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20241011-12282615 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Truong
                                            </td>
                                            <td>
                                                Mandy’s shop
                                            </td>
                                            <td>
                                                1,091.45$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                HD BANK
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/seller_orders/eyJpdiI6IkdDUjlVUUIza2xSQ055VWxudVlyUUE9PSIsInZhbHVlIjoiMWZEV1BpMnY2clM5TExuTFM0M09qdz09IiwibWFjIjoiNTQ5MWUyOTI0NmE0NDZmMGQ1Mjc3NDEyY2Q4ZDY3M2U2Y2I2MjU4ZDc1NmM1OGRmMjE1YjZhZDk3MDBlNDM5YiIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>  -->
                                                <!-- <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="/invoice/5825" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a> -->
                                                <!-- <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5825" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5824">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20241010-11342962 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Truong
                                            </td>
                                            <td>
                                                a-zstore
                                            </td>
                                            <td>
                                                849.15$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                VISA CARD
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6ImhjNWtRbFhhVUtSUXlVeXdyU0tVSXc9PSIsInZhbHVlIjoiRjllL2w4MHMrLzQ5N2lENFpHbzlLdz09IiwibWFjIjoiMDhjY2ZjODljZjU4ZDVlODlhNmY4NjkzN2IwZWE0Y2M4ZjMzMGUzZjdhZGNmZDg2NzI2MDBjNWZhNDIxMWJlMyIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5824" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5824" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5823">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-21410667 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                John
                                            </td>
                                            <td>
                                                Lina Nguyen
                                            </td>
                                            <td>
                                                829.00$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6ImdmYnp6RzdacDZteU0rM3NHSEd4cFE9PSIsInZhbHVlIjoiQzBoZ00rU1BnbGZjSlVLNUVQY0x4dz09IiwibWFjIjoiMTZjMTQyMmJhYWI4ZDUzYzk2YzIzYzRmYjE5NjU2ZGZlMmMzM2I2ZTk5MGY2ODJhZDIwMGJlMDFmYTQ3MDViZSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5823" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5823" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5822">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-08472272 </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                Adam
                                            </td>
                                            <td>
                                                Lina Nguyen
                                            </td>
                                            <td>
                                                359.38$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6IlljVHE4K2R0YUp4eGFzOEJsSC91TWc9PSIsInZhbHVlIjoibjZxT05IWHNqMm1uTXJMTitIckhUZz09IiwibWFjIjoiZjQ2YWUxZmFlNzcyNjk2ZDdkNTM3NDQwMGMxNDY5ZGYzNTUyZmJkOWRhYTYyYmUwZmY3Njk3NTJjZjZmMzcyNCIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5822" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5822" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5821">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-08292382 </td>
                                            <td>
                                                66
                                            </td>
                                            <td>
                                                Thân Minh Hoàng
                                            </td>
                                            <td>
                                                a-zstore
                                            </td>
                                            <td>
                                                15,660.31$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6Im1hNnZHMk5xUW5xQzQ0WjBabEhzWXc9PSIsInZhbHVlIjoicXRTSXdGY2s1dEVJZi9FTUE4ZUpYQT09IiwibWFjIjoiYWE2NjE2Mzg0OGQ5ZDJmZTFmZGE0ODEyNmQ3MDA2OWZlMmNjZWEwZWFiYmVmNDRjZGM4MjRmZGEwNWY2OTM2MCIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5821" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5821" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5820">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-07494791 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Darareaksmey
                                            </td>
                                            <td>
                                                a-zstore
                                            </td>
                                            <td>
                                                696.90$
                                            </td>
                                            <td>
                                                On The Way
                                            </td>
                                            <td>
                                                Wallet
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6Im00UkVjZGN4Ykx3RStmUXRJeCtxTmc9PSIsInZhbHVlIjoiSlJDN0lNREUxeDNSV3pIRDhqSjFuUT09IiwibWFjIjoiOWRmZmM1NzgzMjQzZTIxNjU3YTI3MGViNjIzNDljNmEyYjZiYzRlZjBhYWMwM2FhMDY5NjZiZjY3YzUyOTE5MSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5820" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5820" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5819">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-07481446 </td>
                                            <td>
                                                4
                                            </td>
                                            <td>
                                                Benjamin
                                            </td>
                                            <td>
                                                a-zstore
                                            </td>
                                            <td>
                                                3,758.00$
                                            </td>
                                            <td>
                                                On The Way
                                            </td>
                                            <td>
                                                Wallet
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6ImVaL3RvSVVvalRiemJYRm1uRVMvL1E9PSIsInZhbHVlIjoiNHhKVVhDazErMHFsYTU1ZGVvUytrZz09IiwibWFjIjoiYTU0MWRjZmQ1MjllODlhM2RmMTkwMTE5NmJlNmFhYWZjZjBkM2JjNDNlY2VhOGMxY2M1NjEwMmRjMWIzNGU5MyIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5819" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5819" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5818">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-06003565 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Kolab
                                            </td>
                                            <td>
                                                Lina Nguyen
                                            </td>
                                            <td>
                                                599.00$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6IkRmMnhDSGY5SXBqYzZheFl4ajcrdFE9PSIsInZhbHVlIjoiNnBZMW9qQjFnM0JHclIwNlNLK3dMQT09IiwibWFjIjoiMTJmZDA0NDE5YzhmMzJmYmM4NDA2ZWI3ZWM5NzEyMmNiNGJiYzgxZTVhZTkyZWQ0ZDkzNTNiYmI0ODUwOGJmYiIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5818" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5818" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5817">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-04502232 </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                Angel
                                            </td>
                                            <td>
                                                Lina Nguyen
                                            </td>
                                            <td>
                                                203.80$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Cash on Delivery
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6InFodDlaKzRtdm9RQVVGYUp0WjlsQnc9PSIsInZhbHVlIjoianlUM3NhVEVYTzFBWllWMEgvUzZjUT09IiwibWFjIjoiMzRmZjE3ZTQ3ZTc1NDdlOGQ4Y2Q2NGI0ZTdiZDkxNWMxNTcxOGE1MWI1M2ZlYWI2OTE0YzIxZDI0ZmUzNmJhNCIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5817" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5817" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5816">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-03095680 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Amy
                                            </td>
                                            <td>
                                                a-zstore
                                            </td>
                                            <td>
                                                68.96$
                                            </td>
                                            <td>
                                                On The Way
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6Ii9XbVdsQXk4MUMraFZxNzViRW9tamc9PSIsInZhbHVlIjoiMDVyOEo5alhybGRGMGEwSEhsVWVZQT09IiwibWFjIjoiYmI5YWU1YmRiMjdhMDViZmExM2NlNmM1ODFlNjQ2M2MxNDRmMmUzZTMwMWRmMzc1NzVkMTlmZDEyOTFlMWVhOCIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5816" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5816" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5815">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-03022427 </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                Yusri
                                            </td>
                                            <td>
                                                Minh Trang Luxury
                                            </td>
                                            <td>
                                                512.05$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6InRzMk8wZWY1SEd1YTA0dU5PcGJpNXc9PSIsInZhbHVlIjoiUGc1V05laHorOXBINkM3Z2FoV1J3dz09IiwibWFjIjoiMjkzYjEyOTFhMmMzMTU5Mzk4YWY2MzFkYzQ5NWUxOTZjMjE1ZmIyNDIwNWNiNzM1MjIyYzhkZDYyNWJhMTE5ZCIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5815" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5815" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5814">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-02543550 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Chittavong
                                            </td>
                                            <td>
                                                a-zstore
                                            </td>
                                            <td>
                                                235.00$
                                            </td>
                                            <td>
                                                On The Way
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6Ikw3cG80YmtMdE9NdWpLNmZLRVE4dkE9PSIsInZhbHVlIjoiZHM1Y01TTk1RdjJtN295eHdSY0Uzdz09IiwibWFjIjoiNjc0MjY2ZDI5YTNiNDIyNzhjYzMyNDhhMDgxNjNkNzI5ZWQ0ZmFmZTdiMDk0ODI1ZmNjNGI1N2Y1YTA1NzYyYiIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5814" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5814" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5813">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-02403249 </td>
                                            <td>
                                                3
                                            </td>
                                            <td>
                                                Baskoro
                                            </td>
                                            <td>
                                                a-zstore
                                            </td>
                                            <td>
                                                318.00$
                                            </td>
                                            <td>
                                                On The Way
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6IkhVek16a1Rkc09pRklDYnFCTUN6aUE9PSIsInZhbHVlIjoiVTRGTG4vNVlCVnAwUkMzbTdiZ1pZZz09IiwibWFjIjoiOGQ4Y2VhZGQxMjNhMjg4NDAzM2YxZDJjMTI5YTY5M2Q1Mzg0NTNmMjkyMmQyMmU1YjMzODI5ZjI0MTI3NTgyNSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5813" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5813" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5812">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-02295945 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Rivera
                                            </td>
                                            <td>
                                                H&amp;H
                                            </td>
                                            <td>
                                                1,537.00$
                                            </td>
                                            <td>
                                                Confirmed
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6ImkrQ2RhK1gwcFYwTlBhb0I2b1F4ZVE9PSIsInZhbHVlIjoieHIwMDVvN3RxdW1qYmkyczdpLytuQT09IiwibWFjIjoiMGU4NjlhMWJmYzRkY2M3ZWJiNGQ2MDRjYzZlNGIyODE4OWE0OGYxNmRmOTg5ODZkNWMzNDUxMDFlYWIzNGY0MSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5812" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5812" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="5811">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240923-02192529 </td>
                                            <td>
                                                28
                                            </td>
                                            <td>
                                                Natasya
                                            </td>
                                            <td>
                                                H&amp;H
                                            </td>
                                            <td>
                                                8,734.30$
                                            </td>
                                            <td>
                                                Confirmed
                                            </td>
                                            <td>
                                                Thanh toán khi nhận
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/seller_orders/eyJpdiI6ImRpOFVKUk1ZSWNyZVVBejg4c0ZUS0E9PSIsInZhbHVlIjoiV2c1eW1NSTdHdWhZaERjQmN4ZmQ0dz09IiwibWFjIjoiZTg2MmE1YWU0NDM2NDAyMDVjMTFjMzM0ZGI1Y2Q3OWU3MDQ0MzFiYzcxOGNjYjYxNDBhODkxYmMzZGViNjBlOSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5811" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5811" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="aiz-pagination">
                                    <nav>
                                        <ul class="pagination">

                                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            </li>





                                            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=2">2</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=3">3</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=4">4</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=5">5</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=6">6</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=7">7</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=8">8</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=9">9</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=10">10</a></li>

                                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>





                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=378">378</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/seller_orders.php?page=379">379</a></li>


                                            <li class="page-item">
                                                <a class="page-link" href="/admin/sales/seller_orders.php?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
                                            </li>
                                        </ul>
                                    </nav>

                                </div>

                            </div>
                        </form>
                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; GMARKETVN v7.4.0</p>
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


    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
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

        //        function change_status() {
        //            var data = new FormData($('#order_form')[0]);
        //            $.ajax({
        //                headers: {
        //                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                },
        //                url: "/admin/bulk-order-status",
        //                type: 'POST',
        //                data: data,
        //                cache: false,
        //                contentType: false,
        //                processData: false,
        //                success: function (response) {
        //                    if(response == 1) {
        //                        location.reload();
        //                    }
        //                }
        //            });
        //        }

        function bulk_delete() {
            var data = new FormData($('#sort_orders')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/bulk-order-delete",
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
                    $.post('/language', {
                        _token: 'yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP',
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