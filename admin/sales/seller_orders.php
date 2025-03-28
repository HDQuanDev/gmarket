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
                                        <?php 
                                        $sql=mysqli_query($conn,"SELECT * FROM orders  ");
                                        $i=0;
                                        while($row=fetch_assoc($sql)){
                                            $checkSeller=fetch_array("SELECT * FROM detail_orders WHERE order_id='{$row['id']}' and from_seller is not null");
                                            if(!$checkSeller)continue;
                                            $i++;
                                            $user=fetch_array("SELECT * from users WHERE id='{$row['user_id']}' LIMIT 1");
                                            $num_product=fetch_array("SELECT IFNULL(count(*),0) as count FROM detail_orders WHERE order_id='{$row['id']}' ")['count'];
                                            $code=$row['code'];
                                        ?>
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
                                                <?=$code?> <span class="badge badge-inline badge-info">new</span> </td>
                                            <td>
                                                <?=$num_product?>
                                            </td>
                                            <td>
                                                <?=$user['full_name']?>
                                            </td>
                                            <td>
                                                Inhouse Order
                                            </td>
                                            <td>
                                                <?=$row['amount']?>$
                                            </td>
                                            <td>
                                                <?=$row['delivery_status']?>
                                            </td>
                                            <td>
                                                <?=$row['payment_option']?>
                                            </td>
                                            <td>
                                                <span class="badge badge-inline badge-danger"><?=$row['payment_status']?></span>
                                            </td>
                                            <td class="text-right">

                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/sales/view_order.php?id=<?=$row['id']?>" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <!-- <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/invoice/5826" title="Download Invoice">
                                                    <i class="las la-download"></i>
                                                </a> -->
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/sales/delete_order.php?id=<?=$row['id']?>" title="Delete">
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
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=2">2</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=3">3</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=4">4</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=5">5</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=6">6</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=7">7</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=8">8</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=9">9</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=10">10</a></li>

                                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>





                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders?page=380">380</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/sales/all_orders?page=381">381</a></li>


                                            <li class="page-item">
                                                <a class="page-link" href="/admin/all_orders?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
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