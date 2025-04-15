<?php include("../../config.php");
if (!$isSeller) header("Location: /users/login"); 

// Get seller information
$stmt = $conn->prepare("SELECT * FROM sellers WHERE id = ?");
$stmt->bind_param("i", $seller_id);
$stmt->execute();
$seller_info = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Handle free package requests via AJAX
if (isset($_POST['get_free_package']) && !empty($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);
    
    // Get package details
    $stmt = $conn->prepare("SELECT * FROM seller_packages WHERE id = ? AND amount = 0 AND status = 'active'");
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $package = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    if ($package) {
        // Update seller's max_products and package_id
        $stmt = $conn->prepare("UPDATE sellers SET max_products = IFNULL(max_products, 0) + ?, package_id = ? WHERE id = ?");
        $stmt->bind_param("iii", $package['product_upload_limit'], $package_id, $seller_id);
        $stmt->execute();
        
        // Record in purchase history
        $stmt = $conn->prepare("INSERT INTO package_purchase_history (package_id, payment_method, status, type, member_id, package_type) VALUES (?, 'free', 'completed', 'seller', ?, 'seller')");
        $stmt->bind_param("ii", $package_id, $seller_id);
        $stmt->execute();
        
        echo json_encode(['status' => 'success']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid package']);
        exit;
    }
}

// Handle paid package purchase via wallet
if (isset($_POST['purchase_via_wallet']) && !empty($_POST['package_id'])) {
    $package_id = intval($_POST['package_id']);
    
    // Get package details
    $stmt = $conn->prepare("SELECT * FROM seller_packages WHERE id = ? AND status = 'active'");
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $package = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    if ($package && $seller_money >= $package['amount']) {
        // Deduct from seller's wallet
        $new_balance = $seller_money - $package['amount'];
        $stmt = $conn->prepare("UPDATE sellers SET money = ?, max_products = IFNULL(max_products, 0) + ?, package_id = ? WHERE id = ?");
        $stmt->bind_param("diii", $new_balance, $package['product_upload_limit'], $package_id, $seller_id);
        $stmt->execute();
        
        // Record in purchase history
        $stmt = $conn->prepare("INSERT INTO package_purchase_history (package_id, payment_method, status, type, member_id, package_type) VALUES (?, 'wallet', 'completed', 'seller', ?, 'seller')");
        $stmt->bind_param("ii", $package_id, $seller_id);
        $stmt->execute();
        
        echo json_encode(['status' => 'success']);
        exit;
    } else {
        $error = $package ? 'Insufficient funds' : 'Invalid package';
        echo json_encode(['status' => 'error', 'message' => $error]);
        exit;
    }
}

// Get seller's current package
$seller_package_info = null;
if ($seller_info && !empty($seller_info['package_id'])) {
    $stmt = $conn->prepare("SELECT * FROM seller_packages WHERE id = ?");
    $stmt->bind_param("i", $seller_info['package_id']);
    $stmt->execute();
    $seller_package_info = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Get last purchase date
$last_purchase = null;
if ($seller_info) {
    $stmt = $conn->prepare("SELECT * FROM package_purchase_history WHERE member_id = ? AND type = 'seller' AND status = 'completed' ORDER BY create_date DESC LIMIT 1");
    $stmt->bind_param("i", $seller_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $last_purchase = $result->fetch_assoc();
    }
    $stmt->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="c6MXnpe4lPP7N32uzv6W24NEiPEWxjq4Y54fVWYP">
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
        
        .img-pakage {
            width: 100px;
            height: 100px;
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
                    <section class="py-8 bg-soft-primary">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-8 mx-auto text-center">
                                    <h1 class="mb-0 fw-700">Các gói cho người bán hàng</h1>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="py-4 py-lg-5">
                        <div class="container">
                            <div class="row row-cols-xxl-4 row-cols-lg-3 row-cols-md-2 row-cols-1 gutters-10 justify-content-center">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM seller_packages WHERE status = 'active' ORDER BY amount ASC");
                                $stmt->execute();
                                $packages = $stmt->get_result();
                                
                                while ($row = $packages->fetch_assoc()) {
                                    $stmt2 = $conn->prepare("SELECT * FROM file WHERE id = ? LIMIT 1");
                                    $stmt2->bind_param("i", $row['logo']);
                                    $stmt2->execute();
                                    $logo = $stmt2->get_result()->fetch_assoc();
                                    $stmt2->close();
                                    
                                    $is_current = ($seller_info && isset($seller_info['package_id'])) ? ($seller_info['package_id'] == $row['id']) : false;
                                ?>
                                    <div class="col">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="text-center mb-4 mt-3">
                                                    <img class="img-pakage mw-100 mx-auto mb-4" src="/public<?= $logo ? '/uploads/all/' . $logo['src'] : '/assets/img/placeholder.jpg' ?>" height="100">
                                                    <h5 class="mb-3 h5 fw-600"><?= htmlspecialchars($row['name']) ?></h5>
                                                </div>
                                                <ul class="list-group list-group-raw fs-15 mb-5">
                                                    <li class="list-group-item py-2">
                                                        <i class="las la-check text-success mr-2"></i>
                                                        <?= number_format($row['product_upload_limit']) ?> Giới hạn đăng sản phẩm
                                                    </li>
                                                    <li class="list-group-item py-2">
                                                        <i class="las la-check text-success mr-2"></i>
                                                        <?= $row['duration'] ?> Ngày
                                                    </li>
                                                </ul>
                                                <div class="mb-5 d-flex align-items-center justify-content-center">
                                                    <span class="fs-30 fw-600 lh-1 mb-0"><?= $row['amount'] == 0 ? "Miễn phí" : number_format($row['amount']) . "$" ?></span>
                                                    <span class="text-secondary border-left ml-2 pl-2"><?= $row['duration'] ?><br>Ngày</span>
                                                </div>

                                                <div class="text-center">
                                                    <?php if ($is_current) { ?>
                                                        <span class="btn btn-light fw-600">Gói hiện tại</span>
                                                    <?php } else if ($row['amount'] == 0) { ?>
                                                        <button class="btn btn-primary fw-600" onclick="get_free_package(<?= $row['id'] ?>)">Nâng gói miễn phí</button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-primary fw-600" onclick="select_payment_type(<?= $row['id'] ?>, <?= $row['amount'] ?>)">Mua ngay</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                </div>
                </section>
            </div>
            <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto border-sm-top">
                <p class="mb-0"></p>
            </div>
        </div><!-- .aiz-main-content -->
    </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <!-- Select Payment Type Modal -->
    <div class="modal fade" id="select_payment_type_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chọn phương thức thanh toán</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <select id="payment_option" class="form-control aiz-selectpicker">
                                    <option value="wallet">Sử dụng số dư ví ($<?= number_format($seller_money, 2) ?>)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-sm btn-secondary transition-3d-hover mr-1"
                            id="select_type_cancel" data-dismiss="modal">Hủy</button>
                        <button type="button" id="confirm_payment" onclick="confirmPayment()"
                            class="btn btn-sm btn-primary transition-3d-hover mr-1">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Online payment Modal-->
    <div class="modal fade" id="price_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mua gói của bạn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <form class="" id="package_payment_form" action="/seller_packages/purchase"
                    method="post">
                    <input type="hidden" name="_token" value="c6MXnpe4lPP7N32uzv6W24NEiPEWxjq4Y54fVWYP"> 
                    <input type="hidden" name="seller_package_id" id="package_id_input" value="">
                    <div class="modal-body" style="overflow-y: unset;">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Phương thức thanh toán</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select class="form-control aiz-selectpicker" data-live-search="true"
                                        name="payment_option">
                                        <option value="toyyibpay">ToyyibPay</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-sm btn-secondary transition-3d-hover mr-1"
                                data-dismiss="modal">Hủy</button>
                            <button type="submit"
                                class="btn btn-sm btn-primary transition-3d-hover mr-1">Xác nhận</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>

    <script type="text/javascript">
        var selectedPackageId = null;
        var packageAmount = 0;

        function get_free_package(package_id) {
            if (confirm('Bạn có chắc chắn muốn nhận gói miễn phí này không?')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "",
                    type: 'POST',
                    data: {
                        get_free_package: true,
                        package_id: package_id
                    },
                    success: function (response) {
                        try {
                            response = JSON.parse(response);
                        } catch(e) {}
                        
                        if (response.status === 'success') {
                            AIZ.plugins.notify('success', 'Gói đã được nhận thành công');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            AIZ.plugins.notify('danger', response.message || 'Có lỗi xảy ra');
                        }
                    },
                    error: function() {
                        AIZ.plugins.notify('danger', 'Có lỗi xảy ra');
                    }
                });
            }
        }

        function select_payment_type(package_id, amount) {
            selectedPackageId = package_id;
            packageAmount = amount;
            
            // Check if seller has enough balance
            if (amount > <?= $seller_money ?? 0 ?>) {
                AIZ.plugins.notify('warning', 'Số dư không đủ. Vui lòng nạp thêm tiền vào ví của bạn.');
                return;
            }
            
            $('#select_payment_type_modal').modal('show');
        }

        function confirmPayment() {
            if (!selectedPackageId) return;
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "",
                type: 'POST',
                data: {
                    purchase_via_wallet: true,
                    package_id: selectedPackageId
                },
                success: function (response) {
                    try {
                        response = JSON.parse(response);
                    } catch(e) {}
                    
                    if (response.status === 'success') {
                        AIZ.plugins.notify('success', 'Mua gói thành công');
                        $('#select_payment_type_modal').modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        AIZ.plugins.notify('danger', response.message || 'Có lỗi xảy ra');
                    }
                },
                error: function() {
                    AIZ.plugins.notify('danger', 'Có lỗi xảy ra');
                }
            });
        }
    </script>
</body>

</html>