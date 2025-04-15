<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /"); 

// Handle pagination
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // 10 orders per page
$offset = ($page - 1) * $limit;

// Get total count for pagination
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM orders");
$total_rows = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_rows / $limit);

// Ensure the current page isn't greater than the total pages
if ($page > $total_pages && $total_pages > 0) {
    header("Location: /admin/sales/all_orders.php?page=$total_pages");
    exit;
}

// Build the query with filters
$sql = "SELECT o.*, 
        (SELECT COUNT(*) FROM detail_orders WHERE order_id = o.id) as num_products,
        (SELECT full_name FROM users WHERE id = o.user_id LIMIT 1) as customer_name,
        (SELECT email FROM users WHERE id = o.user_id LIMIT 1) as customer_email
        FROM orders o WHERE 1=1";

// Add filters if set
if (isset($_GET['delivery_status']) && !empty($_GET['delivery_status'])) {
    $delivery_status = mysqli_real_escape_string($conn, $_GET['delivery_status']);
    $sql .= " AND o.delivery_status = '$delivery_status'";
}

if (isset($_GET['payment_status']) && !empty($_GET['payment_status'])) {
    $payment_status = mysqli_real_escape_string($conn, $_GET['payment_status']);
    $sql .= " AND o.payment_status = '$payment_status'";
}

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql .= " AND o.code LIKE '%$search%'";
}

if (isset($_GET['search2']) && !empty($_GET['search2'])) {
    $search2 = mysqli_real_escape_string($conn, $_GET['search2']);
    $sql .= " AND (
        EXISTS (SELECT 1 FROM users u WHERE u.id = o.user_id AND (u.full_name LIKE '%$search2%' OR u.email LIKE '%$search2%'))
    )";
}



// Add pagination
$sql .= " ORDER BY o.create_date DESC LIMIT $offset, $limit";
$result = mysqli_query($conn, $sql);
if(isset($_POST['action']) && $_POST['action']=='update_delivery_status') {
    $delivery_status = $_POST['delivery_status'];
    $order_id = $_POST['order_id'];
    $sql = "UPDATE orders SET delivery_status = '$delivery_status' WHERE id = '$order_id'";
    $conn->query($sql);
    
}
?>

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
                                            <th>Num. of Products</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Delivery Status</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <th class="text-right" width="15%">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="<?=$row['id']?>">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?=$row['code']?> 
                                                <?php if (strtotime($row['create_date']) > strtotime('-7 days')): ?>
                                                <span class="badge badge-inline badge-info">new</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?=$row['num_products']?></td>
                                            <td>
                                                <?=$row['customer_name']?><br>
                                                <small><?=$row['customer_email']?></small>
                                            </td>
                                            <td><?=number_format($row['amount'], 2)?> $</td>
                                             <td>
                                                <select class="border-0 bg-transparent text-primary cursor-pointer appearance-none"
                                                    style="padding-right: 20px;"
                                                    onchange="submitStatus(this, <?= $row['id'] ?>)">
                                                    <option value="Pending" <?= $row['delivery_status'] == 'Pending' ? 'selected' : '' ?>>Đang chờ</option>
                                                    <option value="Confirmed" <?= $row['delivery_status'] == 'Confirmed' ? 'selected' : '' ?>>Đã xác nhận</option>
                                                    <option value="On delivery" <?= $row['delivery_status'] == 'On delivery' ? 'selected' : '' ?>>Đang giao</option>
                                                    <option value="Delivered" <?= $row['delivery_status'] == 'Delivered' ? 'selected' : '' ?>>Đã giao</option>
                                                </select>
                                            </td>

                                            <td><?=$row['payment_option']?></td>
                                            <td>
                                                <span class="badge badge-inline <?=$row['payment_status'] == 'Paid' ? 'badge-success' : 'badge-danger'?>">
                                                    <?=$row['payment_status']?>
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/sales/view_order.php?id=<?=$row['id']?>" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/sales/delete_order.php?id=<?=$row['id']?>" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>

                                <div class="aiz-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            <!-- Previous Page -->
                                            <?php if ($page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="/admin/sales/all_orders.php?page=<?=$page-1?>" aria-label="« Previous">
                                                    <span aria-hidden="true">&lsaquo;</span>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            </li>
                                            <?php endif; ?>
                                            
                                            <!-- Page Numbers -->
                                            <?php
                                            $start_page = max(1, $page - 3);
                                            $end_page = min($total_pages, $page + 3);
                                            
                                            if ($start_page > 1) {
                                                echo '<li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page=1">1</a></li>';
                                                if ($start_page > 2) {
                                                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                                }
                                            }
                                            
                                            for ($i = $start_page; $i <= $end_page; $i++) {
                                                if ($i == $page) {
                                                    echo '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
                                                } else {
                                                    echo '<li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page='.$i.'">'.$i.'</a></li>';
                                                }
                                            }
                                            
                                            if ($end_page < $total_pages) {
                                                if ($end_page < $total_pages - 1) {
                                                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                                }
                                                echo '<li class="page-item"><a class="page-link" href="/admin/sales/all_orders.php?page='.$total_pages.'">'.$total_pages.'</a></li>';
                                            }
                                            ?>
                                            
                                            <!-- Next Page -->
                                            <?php if ($page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="/admin/sales/all_orders.php?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
                                            </li>
                                            <?php else: ?>
                                            <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                                                <span class="page-link">&rsaquo;</span>
                                            </li>
                                            <?php endif; ?>
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

    <form id="statusForm" method="post" action="" style="display: none;">
    <input type="hidden" name="order_id" id="formOrderId">
    <input type="hidden" name="action" value="update_delivery_status">
    <input type="hidden" name="delivery_status" id="formStatus">
</form>

<script>
function submitStatus(selectElem, orderId) {
    document.getElementById('formOrderId').value = orderId;
    document.getElementById('formStatus').value = selectElem.value;
    document.getElementById('statusForm').submit();
}
</script>

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

        function bulk_delete() {
            var data = new FormData($('#sort_orders')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/sales/bulk_delete.php",
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
        
        // Delete confirmation
        $(document).on('click', '.confirm-delete', function(e){
            e.preventDefault();
            $('#delete-modal').modal('show');
            $('#delete-link').attr('href', $(this).data('href'));
        });
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