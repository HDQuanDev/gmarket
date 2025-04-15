<?php include("../../config.php");if (!$isSeller) header("Location: /users/login"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="eObVDgS1BnyzqUZf3wNmMehk2sbNi4MatBxDBYhn">
    <meta name="app-url" content="//gmarket-quocte.com/">
    <meta name="file-base-url" content="//gmarket-quocte.com/public/">

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
        <?php include("../layout/sidebar.php") ?>

        <div class="py-3 px-4 lg:px-6">
            <?php include("../layout/topbar.php") ?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="card">
                        <form id="sort_orders" action="" method="GET">
                            <div class="card-header row gutters-5">
                                <div class="col text-center text-md-left">
                                    <h5 class="mb-md-0 h6">Đơn hàng</h5>
                                </div>
                                <div class="col-md-3 ml-auto">
                                    <select class="form-control aiz-selectpicker" data-placeholder="Lọc theo trạng thái thanh toán" name="payment_status" onchange="sort_orders()">
                                        <option value="">Lọc theo trạng thái thanh toán</option>
                                        <option value="paid" <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'paid' ? 'selected' : '' ?>>Đã thanh toán</option>
                                        <option value="unpaid" <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'unpaid' ? 'selected' : '' ?>>Chưa thanh toán</option>
                                    </select>
                                </div>

                                <div class="col-md-3 ml-auto">
                                    <select class="form-control aiz-selectpicker" data-placeholder="Lọc theo trạng thái giao hàng" name="delivery_status" onchange="sort_orders()">
                                        <option value="">Lọc theo trạng thái giao hàng</option>
                                        <option value="pending" <?= isset($_GET['delivery_status']) && $_GET['delivery_status'] == 'pending' ? 'selected' : '' ?>>Đang chờ</option>
                                        <option value="confirmed" <?= isset($_GET['delivery_status']) && $_GET['delivery_status'] == 'confirmed' ? 'selected' : '' ?>>Đã xác nhận</option>
                                        <option value="on_delivery" <?= isset($_GET['delivery_status']) && $_GET['delivery_status'] == 'on_delivery' ? 'selected' : '' ?>>Đang giao</option>
                                        <option value="delivered" <?= isset($_GET['delivery_status']) && $_GET['delivery_status'] == 'delivered' ? 'selected' : '' ?>>Đã giao</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="from-group mb-0">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Type Order code & hit Enter" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card-body p-3">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã đặt hàng</th>
                                        <th>Sản Phẩm</th>
                                        <th >Phương Thức Thanh Toán</th>
                                        <th>Khách Hàng</th>
                                        <th >Số Tiền</th>
                                        <th>Trạng Thái Giao Hàng</th> 
                                        <th>Trạng Thái Thanh Toán</th>
                                        <th class="text-right">Tùy Chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Build the query with filters
                                    $where = "WHERE do.from_seller = '$seller_id'";
                                    
                                    if (isset($_GET['payment_status']) && !empty($_GET['payment_status'])) {
                                        $payment_status = mysqli_real_escape_string($conn, $_GET['payment_status']);
                                        if ($payment_status == 'paid') {
                                            $where .= " AND o.payment_status = 'Paid'";
                                        } elseif ($payment_status == 'unpaid') {
                                            $where .= " AND o.payment_status = 'Un-paid'";
                                        }
                                    }
                                    
                                    if (isset($_GET['delivery_status']) && !empty($_GET['delivery_status'])) {
                                        $delivery_status = mysqli_real_escape_string($conn, $_GET['delivery_status']);
                                        $where .= " AND o.delivery_status = '" . ucfirst($delivery_status) . "'";
                                    }
                                    
                                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                                        $where .= " AND o.code LIKE '%$search%'";
                                    }
                                    
                                    // Pagination
                                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                    $limit = 10;
                                    $offset = ($page - 1) * $limit;
                                    
                                    // Count total orders for pagination
                                    $count_query = "SELECT COUNT(DISTINCT o.id) AS total 
                                                  FROM detail_orders do
                                                  JOIN orders o ON do.order_id = o.id
                                                  $where";
                                    $count_result = mysqli_query($conn, $count_query);
                                    $total_rows = mysqli_fetch_assoc($count_result)['total'];
                                    $total_pages = ceil($total_rows / $limit);
                                    
                                    // Get orders with details
                                    
                                    // Query: gom tất cả chi tiết đơn hàng của 1 đơn hàng vào 1 dòng dùng GROUP_CONCAT()
                                    $sql = "SELECT 
                                                o.id, 
                                                o.code, 
                                                o.delivery_status, 
                                                o.payment_status, 
                                                o.create_date, 
                                                o.payment_option, 
                                                u.email, 
                                                u.full_name,
                                                GROUP_CONCAT(
                                                    CONCAT(do.id, '|', do.price, '|', do.quantity, '|', do.name, '|', do.status_xuli) 
                                                    ORDER BY do.create_date DESC
                                                    SEPARATOR '||'
                                                ) AS order_details
                                            FROM orders o
                                            LEFT JOIN users u ON o.user_id = u.id
                                            LEFT JOIN detail_orders do ON do.order_id = o.id
                                            $where
                                            GROUP BY o.id
                                            ORDER BY o.create_date DESC
                                            LIMIT $offset, $limit";
                                    
                                    $result = mysqli_query($conn, $sql);
                                    $i = $offset;
                                    
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $i++;
                                            $customer_name = !empty($row['full_name']) 
                                                ? $row['full_name'] 
                                                : (!empty($row['username']) ? $row['username'] : $row['email']);
                                            
                                            // Khởi tạo tổng số tiền của đơn hàng
                                            $total_order_amount = 0;
                                            $orderDetails = [];
                                    
                                            if (!empty($row['order_details'])) {
                                                // Tách mỗi detail dựa trên ký tự phân cách "||"
                                                $details = explode("||", $row['order_details']);
                                                foreach ($details as $detail) {
                                                    // Từng phần của detail được phân cách bởi "|"
                                                    list($detail_id, $price, $quantity, $name, $status_xuli) = explode("|", $detail);
                                                    $total = $price * $quantity;
                                                    $total_order_amount += $total;
                                                    $orderDetails[] = [
                                                        'detail_id'   => $detail_id,
                                                        'price'       => $price,
                                                        'quantity'    => $quantity,
                                                        'name'        => $name,
                                                        'status_xuli' => $status_xuli, // Truyền status_xuli từ order detail
                                                        'total'       => $total
                                                    ];
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <!-- Hiển thị mã đơn hàng và ngày tạo -->
                                                    <a href="order_detail.php?id=<?= $row['id'] ?>"><?= $row['code'] ?></a>
                                                    <br>
                                                    <small class="text-muted"><?= date('d M Y, h:i A', strtotime($row['create_date'])) ?></small>
                                                    <?php 
                                                    // Nếu có ít nhất 1 chi tiết mà status_xuli != 1 và payment_option là cash_on_delivery
                                                    // Lưu ý: Ở đây bạn có thể chọn điều kiện hiển thị theo detail cụ thể. 
                                                    // Ví dụ, nếu muốn xuất hiện nút xử lý khi có ít nhất 1 product chưa xử lý:
                                                    $show_process_btn = false;
                                                    if ($row['payment_option'] == "cash_on_delivery") {
                                                        foreach ($orderDetails as $od) {
                                                            if ($od['status_xuli'] != 1) {
                                                                $show_process_btn = true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    if ($show_process_btn): ?>
                                                        <br>
                                                        <a href="javascript:void(0)" 
                                                           class="process-order-btn small text-primary" 
                                                           data-id="<?= $row['id'] ?>" 
                                                           data-order-code="<?= $row['code'] ?>"
                                                           data-amount="<?= $total_order_amount ?>">
                                                            <i class="las la-check-circle"></i> Xử lý đơn hàng
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    // Hiển thị tên sản phẩm của từng chi tiết (có thể lặp nhiều dòng nếu cần)
                                                    if (!empty($orderDetails)) {
                                                        foreach ($orderDetails as $detail) {
                                                            ?>
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <h6 class="mb-0 text-truncate" style="max-width: 200px;">
                                                                        <?= htmlspecialchars($detail['name']) ?>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                            <?php 
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= tran($row['payment_option']) ?></td>
                                                <td><?= htmlspecialchars($customer_name) ?></td>
                                                <td><?= number_format($total_order_amount) ?> $</td>
                                                <td>
                                                    <?php
                                                    // Màu hiển thị trạng thái giao hàng
                                                    $status_color = 'secondary';
                                                    switch ($row['delivery_status']) {
                                                        case 'Pending':
                                                            $status_color = 'warning';
                                                            break;
                                                        case 'Confirmed':
                                                            $status_color = 'info';
                                                            break;
                                                        case 'On delivery':
                                                            $status_color = 'primary';
                                                            break;
                                                        case 'Delivered':
                                                            $status_color = 'success';
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="badge badge-inline badge-<?= $status_color ?>">
                                                        <?= $row['delivery_status'] ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-inline badge-<?= $row['payment_status'] == 'Paid' ? 'success' : 'danger' ?>">
                                                        <?= tran($row['payment_status']) ?>
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <a href="order_detail.php?id=<?= $row['id'] ?>" class="btn btn-soft-info btn-icon btn-circle btn-sm" title="Order Details">
                                                        <i class="las la-eye"></i>
                                                    </a>
                                                    <a href="/seller/invoice/print.php?id=<?= $row['id'] ?>" class="btn btn-soft-warning btn-icon btn-circle btn-sm" title="Download Invoice">
                                                        <i class="las la-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="9" class="text-center">Không tìm thấy đơn hàng nào</td>
                                        </tr>
                                        <?php 
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right font-weight-bold">Tổng cộng:</td>
                                        <td colspan="4" class="font-weight-bold">
                                            <?php
                                            // Calculate total amount for all matching orders
                                            $total_query = "SELECT SUM(do.price * do.quantity) as total_amount 
                                                        FROM detail_orders do
                                                        JOIN orders o ON do.order_id = o.id
                                                        $where";
                                            $total_result = mysqli_query($conn, $total_query);
                                            $total_sum = mysqli_fetch_assoc($total_result)['total_amount'];
                                            echo number_format($total_sum, 2) . ' $';
                                            ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                            <div class="aiz-pagination mt-3">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page-1 ?><?= isset($_GET['payment_status']) ? '&payment_status='.$_GET['payment_status'] : '' ?><?= isset($_GET['delivery_status']) ? '&delivery_status='.$_GET['delivery_status'] : '' ?><?= isset($_GET['search']) ? '&search='.$_GET['search'] : '' ?>">
                                                <i class="las la-angle-left"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        
                                        <?php
                                        $start_page = max(1, $page - 2);
                                        $end_page = min($total_pages, $page + 2);
                                        
                                        for ($i = $start_page; $i <= $end_page; $i++):
                                        ?>
                                        <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?><?= isset($_GET['payment_status']) ? '&payment_status='.$_GET['payment_status'] : '' ?><?= isset($_GET['delivery_status']) ? '&delivery_status='.$_GET['delivery_status'] : '' ?><?= isset($_GET['search']) ? '&search='.$_GET['search'] : '' ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                        <?php endfor; ?>
                                        
                                        <?php if ($page < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page+1 ?><?= isset($_GET['payment_status']) ? '&payment_status='.$_GET['payment_status'] : '' ?><?= isset($_GET['delivery_status']) ? '&delivery_status='.$_GET['delivery_status'] : '' ?><?= isset($_GET['search']) ? '&search='.$_GET['search'] : '' ?>">
                                                <i class="las la-angle-right"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto border-sm-top">
                    <p class="mb-0"></p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>

    <script>
        function sort_orders() {
            $('#sort_orders').submit();
        }
        
        $(document).ready(function() {
            // Enable search form submission on Enter key
            $('#search').keypress(function(e) {
                if (e.which == 13) {
                    $('#sort_orders').submit();
                }
            });
            
            // Process Order Button Click
            $(document).on('click', '.process-order-btn', function() {
                var orderId = $(this).data('id');
                var orderCode = $(this).data('order-code');
                var amount = $(this).data('amount');
                var $processBtn = $(this);
                // Find the payment status badge for this order row
                var $paymentStatusBadge = $processBtn.closest('tr').find('td:nth-child(8) span.badge');
                // Find the delivery status badge for this order row
                var $deliveryStatusBadge = $processBtn.closest('tr').find('td:nth-child(7) span.badge');
                
                // Confirm before processing
                if (confirm('Are you sure you want to process order ' + orderCode + '?\nThis will mark the order as delivered.')) {
                    // Show loading indicator
                    $processBtn.html('<i class="las la-spinner la-spin"></i> Processing...');
                    
                    // Send Ajax request
                    $.ajax({
                        url: 'process_order.php',
                        type: 'POST',
                        data: {
                            order_id: orderId,
                            amount: amount
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                // Remove the process button
                                $processBtn.fadeOut(function() {
                                    $(this).remove();
                                });
                                
                                // Update payment status badge to "Paid"
                                $paymentStatusBadge.removeClass('badge-danger').addClass('badge-success');
                                $paymentStatusBadge.text('Paid');
                                
                                // Update delivery status badge to "Delivered"
                                $deliveryStatusBadge.removeClass('badge-warning badge-info badge-primary badge-secondary').addClass('badge-primary');
                                $deliveryStatusBadge.text('Confirmed');
                                
                                // Show success message
                                AIZ.plugins.notify('success', response.message);
                            } else {
                                // Show error message
                                AIZ.plugins.notify('danger', response.message);
                                // Reset button
                                $processBtn.html('<i class="las la-check-circle"></i> Process Order');
                            }
                        },
                        error: function() {
                            // Show error message
                            AIZ.plugins.notify('danger', 'An error occurred while processing the order.');
                            // Reset button
                            $processBtn.html('<i class="las la-check-circle"></i> Process Order');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>