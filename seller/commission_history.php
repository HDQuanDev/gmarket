<?php include("../config.php");
if (!$isSeller) header("Location: /users/login");
?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="jeVFiapLZrmTexe2gwykiL1aVi2OH3FnaNVdk7e4">
    <meta name="app-url" content="//gmarketagents.com/">
    <meta name="file-base-url" content="//gmarketagents.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
    <title>TAKASHIMAYA ONLINE STORE VIETNAM | Mua sản phẩm nội địa Nhật Bản với giá gốc từ nhà sản xuất</title>
    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-seller.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-size: 13px;
            background-color: #f8f9fa;
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

        /* Custom styles for commission history table */
        .commission-card {
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
        }

        .commission-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.2rem 1.5rem;
        }

        .commission-card .card-body {
            padding: 0;
        }

        .commission-table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .commission-table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #333;
            border-top: none;
            padding: 12px 15px;
            font-size: 13px;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }

        .commission-table tbody td {
            vertical-align: middle;
            padding: 12px 15px;
            border-top: 1px solid #f0f0f0;
        }

        .commission-table tbody tr:hover {
            background-color: rgba(0, 138, 255, 0.05);
        }

        .commission-table tfoot tr {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .commission-table tfoot td {
            padding: 12px 15px;
            border-top: 2px solid #dee2e6;
        }

        .order-code {
            font-weight: 600;
            color: #3b5998;
        }

        .amount-positive {
            color: #28a745;
            font-weight: 600;
        }

        .amount-negative {
            color: #dc3545;
            font-weight: 600;
        }

        .balance-value {
            font-weight: 600;
            color: #333;
        }

        .timestamp {
            color: #6c757d;
            font-size: 12px;
        }

        .filter-section {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .filter-section .form-control {
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .filter-section .btn-primary {
            border-radius: 6px;
            padding: 0.375rem 1.5rem;
        }

        .section-heading {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .section-heading i {
            margin-right: 8px;
            color: #3498db;
        }

        .no-data-row td {
            padding: 40px 15px !important;
            text-align: center;
            color: #6c757d;
        }

        .no-data-icon {
            font-size: 40px;
            margin-bottom: 10px;
            color: #d1d1d1;
        }

        /* Badge styles */
        .badge-subtle-success {
            background-color: rgba(40, 167, 69, 0.15);
            color: #28a745;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 500;
        }

        .badge-subtle-danger {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 500;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .commission-table {
                min-width: 850px;
            }

            .card-body {
                overflow-x: auto;
            }
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

        <div class="py-3 px-4 lg:px-6">
            <?php include("./layout/topbar.php") ?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <!-- Filter Section -->
                    <form action="" id="sort_commission_history" method="GET">
                        <div class="filter-section">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h5 class="section-heading">
                                        <i class="fas fa-history"></i> <?= tran("Commission History") ?>
                                    </h5>
                                </div>
                                <div class="col-md-4 col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white" id="basic-addon1">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control aiz-date-range" id="search" name="date_range"
                                            placeholder="<?= tran("Select Date Range") ?>" autocomplete="off"
                                            value="<?= isset($_GET['date_range']) ? $_GET['date_range'] : '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-filter"></i> <?= tran("Filter") ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php
                    // Prepare query and calculate totals first
                    $seller_id = $_SESSION['seller_id'];
                    $where = "WHERE seller_id = '$seller_id'";

                    // Add date range filter if provided
                    if (isset($_GET['date_range']) && !empty($_GET['date_range'])) {
                        $dates = explode(" to ", $_GET['date_range']);
                        if (count($dates) == 2) {
                            $start_date = date('Y-m-d 00:00:00', strtotime($dates[0]));
                            $end_date = date('Y-m-d 23:59:59', strtotime($dates[1]));
                            $where .= " AND created_at BETWEEN '$start_date' AND '$end_date'";
                        }
                    }

                    // Initialize totals
                    $total_commission = 0;
                    $total_earning = 0;
                    $total_order_amount = 0;

                    // Calculate totals from database
                    // admin_commission is the base price/commission taken by admin
                    // seller_earning is the profit for the seller
                    // Total order amount should be admin_commission + seller_earning
                    $totals_query = mysqli_query($conn, "SELECT 
                        SUM(admin_commission) as total_commission, 
                        SUM(seller_earning) as total_earning
                        FROM commission_history $where");

                    if ($totals_query && mysqli_num_rows($totals_query) > 0) {
                        $totals = mysqli_fetch_assoc($totals_query);
                        $total_commission = $totals['total_commission'] ?: 0;
                        $total_earning = $totals['total_earning'] ?: 0;
                        $total_order_amount = $total_commission + $total_earning; // Order amount is commission + earning
                    }

                    // Get record count for header display
                    $count_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM commission_history $where");
                    $count = $count_result ? mysqli_fetch_assoc($count_result)['total'] : 0;
                    ?>

                    <!-- Commission History Table -->
                    <div class="card commission-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 h6">
                                <?= tran("Commission Records") . " (" . $count . ")" ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table commission-table">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="15%" data-breakpoints="lg"><?= tran("Order Code") ?></th>
                                            <th width="15%" data-breakpoints="lg"><?= tran("Order Amount") ?></th>
                                            <th width="12%"><?= tran("Admin Commission") ?></th>
                                            <th width="12%"><?= tran("Earning") ?></th>
                                            <th width="12%"><?= tran("Balance") ?></th>
                                            <th width="12%"><?= tran("New Balance") ?></th>
                                            <th width="15%" data-breakpoints="lg"><?= tran("Date") ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($conn, "SELECT * FROM commission_history $where ORDER BY created_at DESC");

                                        if ($sql && mysqli_num_rows($sql) > 0) {
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                // Calculate order amount as the base amount + commission
                                                $order_total = $row['seller_earning'] - $row['admin_commission'];
                                        ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td>
                                                        <span class="order-code"><?= $row['order_code'] ?></span>
                                                        <?php
                                                        $order = fetch_array("SELECT delivery_status FROM orders WHERE id='{$row['order_id']}' LIMIT 1");
                                                        ?>
                                                        <?php if ($order && $order['delivery_status'] === 'Delivered'): ?>
                                                            <br>
                                                            <span class="badge badge-subtle-success">
                                                                <i class="fas fa-check-circle"></i> <?= tran("Delivered") ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <span class="balance-value">
                                                            $<?= number_format($order_total, 2) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="amount-negative">
                                                            $<?= number_format($row['admin_commission'], 2) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="amount-positive">
                                                            $<?= number_format($order_total + $row['admin_commission'], 2) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="balance-value">$<?= number_format($row['previous_balance'], 2) ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="balance-value">$<?= number_format($row['current_balance'], 2) ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="timestamp">
                                                            <i class="far fa-clock"></i> <?= date('M d, Y - h:i A', strtotime($row['created_at'])) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="8" class="no-data-row">
                                                    <div class="no-data-icon">
                                                        <i class="fas fa-chart-bar"></i>
                                                    </div>
                                                    <p>Không có dữ liệu</p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="aiz-pagination mt-4">
                                <!-- Pagination goes here if needed -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto border-sm-top">
                    <p class="mb-0"></p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>

</body>

</html>