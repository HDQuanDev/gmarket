<?php include("../../config.php");
if (!$isLogin || !$isAdmin) header("Location: /"); ?>

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
                                                            <input type="checkbox" class="check-one" name="id[]" value="5826">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20241011-12282695 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Truong
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                7.28$
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

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6IjJ2R3NrZ2lxZ1MyZlRZeHR3U05IVnc9PSIsInZhbHVlIjoiREFFZ0dWVC82QWVOcUFmSUs1U1Bhdz09IiwibWFjIjoiNmZiYjdkYTIwNzhjMDYxMmIzNjEyOGQzMWQ0MDdlMjliZDg3YzE5YTE1NGYwZTdjOGMyYjhkZWQzMTE1MTg0YiIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5826" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/5826" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="2192">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240521-05124138 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                hharuto
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                20.40$
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

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6Inpta2NqMjlMYUJTT2pMeDJTTDlOWVE9PSIsInZhbHVlIjoiWVdURE9mQWp1aUtmYmdaeHV1Ujlxdz09IiwibWFjIjoiYTg1YWVjMjQ3Njk2NjIzZmI0ZDQ3ZjdjNGZkMGE3OTRjN2E4YjEwYThkOWM4Y2UxMGRmMjFjMTRmOTIwNzEzZSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/2192" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/2192" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="1957">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240420-12414369 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                DellaEilidh
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                132.90$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Wallet
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6ImdaSDUrclZhcGhaRzZBL3hFdWdKK0E9PSIsInZhbHVlIjoiUjZMUDJGdUpBdGIrRVduWFNCMnQ3Zz09IiwibWFjIjoiODhkMjQ0ZjdkYWM0YzA3MzM0ODlkYWVjNTJiMDQyMjQxNDZmMzUyOGEyMDJmNjBjZDRhYWZhOTM0MWFkY2U1MyIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/1957" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/1957" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="1956">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240420-12410368 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                DellaEilidh
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                132.90$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Aamarpay
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6IkJSNEhoK1JMSndQeW9iVW81Nk9NZkE9PSIsInZhbHVlIjoiUjFOVE9yeWFZeHV4OG9mQ05vMWRuQT09IiwibWFjIjoiZmRhYzhhMThiYzFiNzc5MzJkODU5OWI1YTcyOWRmOTNlYjI0MjBiMDUxNmU4ZGZjNzhmYjk1YTNkZjQwYTNhMSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/1956" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/1956" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="1954">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240420-12335939 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                KateEleanor
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                286.24$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Aamarpay
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6InhzdXdPY21zSTJqMURBd08vZ0hZaHc9PSIsInZhbHVlIjoiT1ZYVTlBSHVlOERBeGYyVGxZU29GZz09IiwibWFjIjoiNDdhZTliMjJiNDQ3ZDgxZTU5ODBhZTJkZmVmZjU3ZTBiMTVkZTRlMjk2YjgzYjUzMmNmZmE5MGI5NjVjZmNkNyIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/1954" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/1954" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="1949">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240420-11585668 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                AnaghaGunjan
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                141.89$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Wallet
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6Inp3a2czK1ptTUl5U01vRFFrNnFGMHc9PSIsInZhbHVlIjoiMm1BQVJVVjZLWDV5NEFpVmJXTUpiQT09IiwibWFjIjoiMjQwZjNiNzc5NmRlNGQxOGQyOWUxYzNhOTNkNWQ5NTkzMjhjMzlkNGNlNWY0OTUwODRmYWJkZjRhYTFkNDA5MiIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/1949" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/1949" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="1947">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240420-11543988 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                PratiKassandra
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                153.34$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Wallet
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6Im05UWZrWTBMZ3BXUEtGRy96QVlYalE9PSIsInZhbHVlIjoiU0JkSVd5YkJyOEZmRExPT3dCeGpsdz09IiwibWFjIjoiOGM3NzBjNjBlYTkzMjI4NTMyYjNjNmQzYzlhYWEwZTE1YTA1MDBkOWI2MDdiYzllMGJhZTVmN2U1Zjk1NmFmZCIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/1947" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/1947" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="1924">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20240420-09573791 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Akimitsu
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                122.67$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Wallet
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6IkdMb3FXRHplK1FqV0IrSytEZVJFTUE9PSIsInZhbHVlIjoiMnZmdDh1VDJwS29rNEM0ZFBwNWIrZz09IiwibWFjIjoiMjc5NDU0ZGM5NTc0OTlmMmI1ZThjMGIwZmE3YWRjMjU5NmFhNjE0OTJkZDU3YjUxODI2MWE2OGQ3MTVlYTBhYSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/1924" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/1924" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="708">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20231226-21111778 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Guest ()
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                11,082.85$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                TechCombank
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6IklXMHVyZndQZllEWEtTdGFCbXFjY1E9PSIsInZhbHVlIjoia3A2R0tYWXEya0ZWZk1SWG9CTUJMQT09IiwibWFjIjoiZTBkZGJkZThmMTc3OGY2YTY4MzEyMzAyNTJkZGI3MTEwOGI0YjlkMzI4ZTg0NDcyNTJmZWZmMzZmNDgxMDY1YSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/708" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/708" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="707">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20231226-21095758 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Guest ()
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                615.98$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                TechCombank
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6IkRoRXR1bXZ4TDVwdGc4RWdPanJrQ1E9PSIsInZhbHVlIjoiZUtCTWswdldWNEhFUVV5TnIyRG1RZz09IiwibWFjIjoiMTIzYzZjZWZkYjI4NmYyNGJjNWRmZTdmNTY2M2VhZTlmYTJiNjIyMzI1MzlhMDM0YjQ4OWIyMzhkZDYyOGQzNyIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/707" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/707" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="627">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20231015-16502253 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Lê Văn Hoàng
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                949.05$
                                            </td>
                                            <td>
                                                On The Way
                                            </td>
                                            <td>
                                                Cash on Delivery
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6ImJaZlloYkxBekxHTXIydEo5RXIvSkE9PSIsInZhbHVlIjoiQjBrVFFXTkZyZEVFR25VMklkdXhsdz09IiwibWFjIjoiYzMzYWQ5YWJmNTA3YTljMDBjNGZkYzJjZTMyMmQwN2VmZTRiYmY2NmU1YTQ2OTQ2YWQzMjViYWQ4ZjkzOTNlZCIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/627" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/627" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="622">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20231015-16102175 </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Diara
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                650.00$
                                            </td>
                                            <td>
                                                Confirmed
                                            </td>
                                            <td>
                                                Wallet
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6IlNiMU4ybEVIZ2VpNUp0Q2YyejVyTUE9PSIsInZhbHVlIjoidnVsMWdhRzNDNk9hVy9MZkdpdUtYZz09IiwibWFjIjoiYjQyZjIwYjI1Nzc0ZWY4ODZlZGY2OTlhYzg5ZTliY2Y4NmNjNTZjYTU0YjVkNmM2Y2E0NGE5OWViMTM2MjgzMyIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/622" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/622" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="619">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20231015-15054172 </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                Lê Văn Hoàng
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                2,349.00$
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>
                                                Wallet
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-success">Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6IlRvYXM5ZXBVWEduWk5vQ0tCUDhyc1E9PSIsInZhbHVlIjoiNnlvS0E0UDQyQVRheXZXODQvK1NsQT09IiwibWFjIjoiZTVlYWJjNDJjMzU0MGFkYjdlNjhlNjFmMzQxNjc2OTNjNTJmZjkwYTM1YzFkZjI1NWY4NWI5YmNiOGI5NzY3YSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/619" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/619" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="616">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20231015-14470174 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                ahajohn
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                1,684.00$
                                            </td>
                                            <td>
                                                Cancelled
                                            </td>
                                            <td>
                                                Cash on Delivery
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6IkM5eERVWE5tclMvWkVIYUVyaEVvZ0E9PSIsInZhbHVlIjoiSEVLMDZRNVlLTFF6N3hUaEU3S2dSQT09IiwibWFjIjoiMzhhODYyZTJkZDVjMGNkNzNlNDE5MTNjMzUzMmFmNWVkNzdhMjM5MTY0ZWNmNWI4NzY5YmRkNzMyOTc1N2QwOSIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/616" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/616" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="615">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                20231015-14453349 <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                ahajohn
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                1,470.00$
                                            </td>
                                            <td>
                                                Cancelled
                                            </td>
                                            <td>
                                                Cash on Delivery
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger">Un-Paid</span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/inhouse-orders/eyJpdiI6Ild0TWJtT0dMSXNleGNVdGZGa3RseEE9PSIsInZhbHVlIjoiZFlMeVpMVmlLZnNacXlhSkJHTlF0UT09IiwibWFjIjoiN2Y0MzY0MzA1OTBmNjY5YTc1NjIyNWNiMzEyMTM3ZTA0ZWJmMjdiODE4MTNiYTNiZWE1MjExYzUzOThjNWQ5MiIsInRhZyI6IiJ9/show" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/615" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/orders/destroy/615" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
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
                                            <li class="page-item"><a class="page-link" href="https://tmdtquocte.com/admin/inhouse-orders?page=2">2</a></li>


                                            <li class="page-item">
                                                <a class="page-link" href="https://tmdtquocte.com/admin/inhouse-orders?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
                                            </li>
                                        </ul>
                                    </nav>

                                </div>

                            </div>
                        </form>
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
                url: "https://tmdtquocte.com/admin/bulk-order-delete",
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