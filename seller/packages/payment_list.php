<?php include("../../config.php");
if(!$isSeller)header("Location: /users/login");

// Get purchase history with package details
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Count total purchases for pagination
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM package_purchase_history WHERE member_id = ? AND type = 'seller'");
$stmt->bind_param("i", $seller_id);
$stmt->execute();
$total_rows = $stmt->get_result()->fetch_assoc()['total'];
$stmt->close();

// Get purchase history with package details
$stmt = $conn->prepare("
    SELECT h.*, p.name as package_name, p.amount 
    FROM package_purchase_history h 
    LEFT JOIN seller_packages p ON h.package_id = p.id 
    WHERE h.member_id = ? AND h.type = 'seller'
    ORDER BY h.create_date DESC
    LIMIT ? OFFSET ?");
$stmt->bind_param("iii", $seller_id, $limit, $offset);
$stmt->execute();
$purchase_history = $stmt->get_result();
$stmt->close();

// Calculate pagination
$total_pages = ceil($total_rows / $limit);
?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="CwdiIhCoMKhaoM7fH4FutGWDWnyClpCwbyyWh17X">
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
        <?php include("../layout/sidebar.php")?>

        <div class="py-3 px-4 lg:px-6">
            <?php include("../layout/topbar.php")?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3">Danh Sách Gói Đã Mua</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header row gutters-5">
                            <div class="col">
                                <h5 class="mb-md-0 h6">Tất Cả Các Gói Đã Mua</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="30%">Gói</th>
                                        <th data-breakpoints="md">Giá Gói</th>
                                        <th data-breakpoints="md">Phương Thức Thanh Toán</th>
                                        <th data-breakpoints="md">Ngày Mua</th>
                                        <th data-breakpoints="md">Trạng Thái</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($purchase_history) > 0) {
                                        $count = ($page - 1) * $limit + 1;
                                        while ($row = mysqli_fetch_assoc($purchase_history)) {
                                            $status_class = '';
                                            switch ($row['status']) {
                                                case 'completed':
                                                    $status_class = 'badge-success';
                                                    $status_text = 'Thành công';
                                                    break;
                                                case 'pending':
                                                    $status_class = 'badge-warning';
                                                    $status_text = 'Đang chờ';
                                                    break;
                                                case 'failed':
                                                    $status_class = 'badge-danger';
                                                    $status_text = 'Lỗi';
                                                    break;
                                                default:
                                                    $status_class = 'badge-info';
                                                    $status_text = ucfirst($row['status']);
                                                    break;
                                            }
                                    ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= htmlspecialchars($row['package_name']) ?></td>
                                        <td><?= $row['amount'] == 0 ? 'Free' : number_format($row['amount'], 2) ?></td>
                                        <td>
                                            <?= ucfirst($row['payment_method']) ?>
                                        </td>
                                        <td>
                                            <?= date('d M Y, h:i A', strtotime($row['create_date'])) ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-inline <?= $status_class ?>"><?= $status_text ?></span>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Không có lịch sử mua nào</td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="aiz-pagination mt-3">
                                <?php if ($total_pages > 1): ?>
                                <nav>
                                    <ul class="pagination">
                                        <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page-1 ?>" tabindex="-1">
                                                <i class="las la-angle-left"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        
                                        <?php
                                        $start_page = max(1, $page - 2);
                                        $end_page = min($start_page + 4, $total_pages);
                                        
                                        if ($start_page > 1) {
                                            echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                                            if ($start_page > 2) {
                                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                            }
                                        }
                                        
                                        for ($i = $start_page; $i <= $end_page; $i++) {
                                            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">
                                                <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                                            </li>';
                                        }
                                        
                                        if ($end_page < $total_pages) {
                                            if ($end_page < $total_pages - 1) {
                                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                            }
                                            echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                                        }
                                        ?>
                                        
                                        <?php if ($page < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page+1 ?>">
                                                <i class="las la-angle-right"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                                <?php endif; ?>
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