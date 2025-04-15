<?php include("../../config.php");
if (!$isLogin || !$isAdmin) header("Location: /"); 

if(isset($_GET['id'])){
    $order=fetch_array("SELECT * FROM orders WHERE id='{$_GET['id']}' LIMIT 1");
    $user=fetch_array("SELECT * FROM users WHERE id='{$order['user_id']}' LIMIT 1");

    if(!$order)die();
}
else die();
?>


<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="tg7AezjJhMZM3J5iLeSSI7fsiwufTUALDOIpXf8U">
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
                        <div class="card-header">
                            <h1 class="h2 fs-16 mb-0">Order Details</h1>
                        </div>
                        <div class="card-body">
                            <div class="row gutters-5">



                                <div class="col-md-3 ml-auto">
                                    <label for="update_payment_status">Payment Status</label>
                                    <input type="text" class="form-control" value="Un-Paid" disabled>
                                </div>
                                <div class="col-md-3 ml-auto">
                                    <div for="update_delivery_status" style="line-height: 24px;">Delivery Status</div>
                                    <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"
                                        id="update_delivery_status">
                                        <option value="Pending" <?=$order['delivery_status']=="Pending"?"selected":""?> >
                                            Pending</option>
                                        <option value="Confirmed" <?=$order['delivery_status']=="Confirmed"?"selected":""?> >
                                            Confirmed</option>
                                        <option value="Picked_up" <?=$order['delivery_status']=="Picked_up"?"selected":""?>>
                                            Picked Up</option>
                                        <option value="On_the_way"<?=$order['delivery_status']=="On_the_way"?"selected":""?> >
                                            On The Way</option>
                                        <option value="Delivered" <?=$order['delivery_status']=="Delivered"?"selected":""?> >
                                            Delivered</option>
                                        <option value="Cancel" <?=$order['delivery_status']=="Cancel"?"selected":""?> >
                                            Cancel</option>
                                    </select>
                                </div>

                                <div class="col-md-3 ml-auto">
                                    <label for="update_payment_status">Tracking</label>
                                    <input type="text" class="form-control" readonly value="<?=$order['code']?>" placeholder="Tracking Code" id="tracking_code">
                                </div>

                                <!--Assign Delivery Boy-->



                                <div class="col-md-3 ml-auto">
                                    <label for="update_payment_status">Payment Status</label>
                                    <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"
                                        id="update_payment_status">
                                        <option value="Un-Paid" <?=$order['payment_status']=="Un-Paid"?"selected":""?> >
                                            Un-Paid
                                        </option>
                                        <option value="Paid" <?=$order['payment_status']=="Paid"?"selected":""?> >
                                            Paid
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">

                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="100" height="100" viewBox="0 0 100 100">
                                    <rect x="0" y="0" width="100" height="100" fill="#ffffff" />
                                    <g transform="scale(4.762)">
                                        <g transform="translate(0,0)">
                                            <path fill-rule="evenodd" d="M8 0L8 2L9 2L9 4L8 4L8 9L9 9L9 11L10 11L10 12L11 12L11 9L14 9L14 10L15 10L15 11L14 11L14 12L13 12L13 11L12 11L12 12L13 12L13 14L10 14L10 13L8 13L8 10L3 10L3 13L4 13L4 11L7 11L7 12L5 12L5 13L8 13L8 14L10 14L10 18L11 18L11 21L12 21L12 20L13 20L13 21L21 21L21 18L19 18L19 17L20 17L20 16L17 16L17 15L20 15L20 14L19 14L19 13L17 13L17 11L18 11L18 12L20 12L20 13L21 13L21 12L20 12L20 10L21 10L21 8L19 8L19 9L20 9L20 10L15 10L15 9L17 9L17 8L12 8L12 7L13 7L13 6L12 6L12 7L11 7L11 5L10 5L10 7L9 7L9 4L10 4L10 3L11 3L11 4L12 4L12 5L13 5L13 3L12 3L12 2L13 2L13 0ZM10 1L10 2L11 2L11 1ZM0 8L0 11L1 11L1 12L0 12L0 13L1 13L1 12L2 12L2 9L3 9L3 8ZM5 8L5 9L7 9L7 8ZM15 11L15 13L14 13L14 14L13 14L13 16L12 16L12 15L11 15L11 16L12 16L12 17L11 17L11 18L12 18L12 19L13 19L13 20L14 20L14 19L13 19L13 18L14 18L14 17L16 17L16 16L14 16L14 14L15 14L15 13L16 13L16 11ZM8 15L8 16L9 16L9 15ZM13 16L13 17L14 17L14 16ZM17 17L17 19L16 19L16 18L15 18L15 19L16 19L16 20L17 20L17 19L18 19L18 20L20 20L20 19L19 19L19 18L18 18L18 17ZM8 18L8 21L10 21L10 20L9 20L9 18ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z" fill="#000000" />
                                        </g>
                                    </g>
                                </svg>

                            </div>
                            <div class="row gutters-5">
                                <div class="col text-md-left text-center">
                                    <address>
                                        <strong class="text-main">
                                            <?=$user['full_name']?>
                                        </strong><br>
                                        <?=$order['address']?>

                                    </address>
                                    <br>
                                    <strong class="text-main">Payment Information</strong><br>
                                    Name: <?=$order['payment_option']?>,
                                    Amount:
                                    <?=$order['amount']?>$,
                                    TRX ID: F434
                                    <br>
                                    <!-- <a href="/public/uploads/all/PA2lJfZzgPXZIvuU5MUVefYMJlPiS6Ptip3QNCCm.jpg" target="_blank">
                                        <img src="/public/uploads/all/PA2lJfZzgPXZIvuU5MUVefYMJlPiS6Ptip3QNCCm.jpg" alt=""
                                            height="100">
                                    </a> -->
                                </div>
                                <div class="col-md-4 ml-auto">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="text-main text-bold">Order #</td>
                                                <td class="text-info text-bold text-right"> <?=$order['code']?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">Order status</td>
                                                <td class="text-right">
                                                    <span class="badge badge-inline badge-info">
                                                        <?=$order['delivery_status']?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">Order date </td>
                                                <td class="text-right"><?=$order['create_date']?> </td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">
                                                    Total amount
                                                </td>
                                                <td class="text-right">
                                                    <?=$order['amount']?>$
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">Payment method</td>
                                                <td class="text-right">
                                                    <?=$order['payment_option']?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-main text-bold">Additional Info</td>
                                                <td class="text-right"><?=$order['additional_info']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr class="new-section-sm bord-no">
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table-bordered aiz-table invoice-summary table">
                                        <thead>
                                            <tr class="bg-trans-dark">
                                                <th data-breakpoints="lg" class="min-col">#</th>
                                                <th width="10%">Photo</th>
                                                <th class="text-uppercase">Description</th>
                                                <th data-breakpoints="lg" class="text-uppercase">Seller</th>
                                                <th data-breakpoints="lg" class="text-uppercase">Delivery Type</th>
                                                <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                                    QTY
                                                </th>
                                                <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                                    Price</th>
                                                <th data-breakpoints="lg" class="min-col text-uppercase text-right">
                                                    Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $total=0;
                                            $sql=mysqli_query($conn,"SELECT *, price*quantity as total FROM detail_orders WHERE order_id='{$_GET['id']}' ");
                                            while($row=fetch_assoc($sql)){
                                                $total+=$row['total'];
                                                $seller_name = "Inhouse";
                                                if(!empty($row['from_seller'])) {
                                                    $seller = fetch_array("SELECT * FROM sellers WHERE id='{$row['from_seller']}' LIMIT 1");
                                                    $seller_name = $seller ? $seller['full_name'] : "Unknown Seller";
                                                }
                                            ?>
                                            <tr>
                                                <td><?=$row['id']?></td>
                                                <td>
                                                        <img height="50" src="<?=$row['img']?>">
                                                </td>
                                                <td>
                                                    <strong>
                                                        <a class="text-muted">
                                                            <?=$row['name']?>
                                                        </a>
                                                    </strong>
                                                    <small>

                                                    </small>
                                                    <br>
                                                    <small>
                                                        Order Item #<?=$row['id']?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <?=$seller_name?>
                                                </td>
                                                <td>
                                                    Home Delivery
                                                </td>
                                                <td class="text-center">
                                                    <?=$row['quantity']?>
                                                </td>
                                                <td class="text-center">
                                                    <?=$row['price']?>$
                                                </td>
                                                <td class="text-center">
                                                    <?=$row['total']?>$
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix float-right">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong class="text-muted">Sub Total :</strong>
                                            </td>
                                            <td>
                                                <?=$total?>$
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="text-muted">Tax :</strong>
                                            </td>
                                            <td>
                                                0.00$
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="text-muted">Shipping :</strong>
                                            </td>
                                            <td>
                                                0.00$
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="text-muted">Coupon :</strong>
                                            </td>
                                            <td>
                                                0.00$
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="text-muted">Total :</strong>
                                            </td>
                                            <td class="text-muted h5">
                                                <?=$total?>$
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="no-print text-right">
                                    <a href="#/invoice/<?=$_GET['id']?>" type="button" class="btn btn-icon btn-light"><i
                                            class="las la-print"></i></a>
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



    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
        $('#assign_deliver_boy').on('change', function() {
            var order_id = <?=$_GET['id']?>;
            var delivery_boy = $('#assign_deliver_boy').val();
            $.post('/admin/orders/delivery-boy-assign', {
                _token: 'tg7AezjJhMZM3J5iLeSSI7fsiwufTUALDOIpXf8U',
                order_id: order_id,
                delivery_boy: delivery_boy
            }, function(data) {
                AIZ.plugins.notify('success', 'Delivery boy has been assigned');
            });
        });
        $('#update_delivery_status').on('change', function() {
            var order_id = <?=$_GET['id']?>;
            var status = $('#update_delivery_status').val();
            $.post('/admin/sales/update_delivery_status.php', {
                _token: 'tg7AezjJhMZM3J5iLeSSI7fsiwufTUALDOIpXf8U',
                order_id: order_id,
                status: status
            }, function(data) {
                try {
                    const response = JSON.parse(data);
                    if(response.status === 1) {
                        AIZ.plugins.notify('success', 'Delivery status has been updated');
                        console.log('Transaction details:', response.details);
                    } else {
                        AIZ.plugins.notify('danger', response.message || 'Error updating delivery status');
                    }
                } catch(e) {
                    AIZ.plugins.notify('danger', 'Invalid response from server');
                }
            });
        });
        $('#update_payment_status').on('change', function() {
            var order_id = <?=$_GET['id']?>;
            var status = $('#update_payment_status').val();
            $.post('/admin/sales/update_payment_status.php', {
                _token: 'tg7AezjJhMZM3J5iLeSSI7fsiwufTUALDOIpXf8U',
                order_id: order_id,
                status: status
            }, function(data) {
                AIZ.plugins.notify('success', 'Payment status has been updated');
                location.reload();
            });
        });

        $("#tracking_code").blur(function() {
            var order_id = <?=$_GET['id']?>;
            var tracking_code = $('#tracking_code').val();
            $.post('/admin/sales/update_tracking_code.php', {
                _token: 'tg7AezjJhMZM3J5iLeSSI7fsiwufTUALDOIpXf8U',
                order_id: order_id,
                tracking_code: tracking_code
            }, function(data) {
                AIZ.plugins.notify('success', 'Tracking code has been updated');
                location.reload();
            });
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
                        _token: 'tg7AezjJhMZM3J5iLeSSI7fsiwufTUALDOIpXf8U',
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