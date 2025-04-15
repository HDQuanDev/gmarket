<?php include("../../config.php");if(!$isSeller)header("Location: /users/login");?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="QRLUoW1AMnSkkhBhHHYJFvoE9vsvOKYIyRGadUL7">
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

        <div class="py-3 px-2 lg:px-6">
            <?php include("../layout/topbar.php")?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success']; ?>
                        <?php unset($_SESSION['success']); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                    <?php endif; ?>

                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3">Sản phẩm</h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="../pos" class="btn btn-primary">
                                    <i class="las la-plus"></i>
                                    <span>Thêm sản phẩm mới</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row gutters-10 justify-content-center">
                        <div class="col-md-4 mx-auto mb-3">
                            <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
                                <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                                    <i class="las la-upload la-2x text-white"></i>
                                </span>
                                <div class="px-3 pt-3 pb-3">
                                    <?php
                                    $total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products WHERE seller_id='$seller_id'"))['total'];
                                    $seller_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT max_products FROM sellers WHERE id='$seller_id'"));
                                    $total_allowed = isset($seller_info['max_products']) ? $seller_info['max_products'] : 0;
                                    $remaining = max(0, $total_allowed - $total_products);
                                    ?>
                                    <div class="h4 fw-700 text-center"><?php echo $remaining; ?></div>
                                    <div class="opacity-50 text-center">Lượt tải lên còn lại</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <a href="/seller/seller-packages" class="text-center bg-white shadow-sm hov-shadow-lg text-center d-block p-3 rounded">
                               
                                <?php
                                // Get the current package information
                                $package_query = "SELECT h.*, p.name as package_name,  p.logo as package_logo
                                                 FROM package_purchase_history h 
                                                 LEFT JOIN seller_packages p ON h.package_id = p.id 
                                                 WHERE h.member_id = '$seller_id' AND h.type = 'seller'
                                                 ORDER BY h.create_date DESC
                                                 LIMIT 1";
                                $package_result = mysqli_query($conn, $package_query);
                                $package_info = mysqli_fetch_assoc($package_result);
                                $current_package = $package_info ? $package_info['package_name'] : 'Không có gói nào';
                                $package_logo = $package_info ? get_image($conn,$package_info['package_logo']) : '#';


                                ?>
                                 <img src="<?= $package_logo ?>" height="22" class="mw-100 mx-auto max-h-20">
                                <span class="d-block sub-title mb-2">Gói hiện tại: <?php echo $current_package; ?></span>
                                <div class="btn btn-outline-primary py-1">Nâng gói</div>
                            </a>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header row gutters-5">
                            <div class="col">
                                <h5 class="mb-md-0 h6">Tất cả sản phẩm</h5>
                            </div>
                            <div class="col-md-4">
                                <form class="" id="sort_products" action="" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Search product" 
                                            <?php if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="10%">Ảnh</th>
                                        <th width="20%">Tên</th>
                                        <th data-breakpoints="md">Loại</th>
                                        <th data-breakpoints="md">Giá</th>
                                        <th data-breakpoints="md">Số lượng</th>
                                        <th>Trạng thái</th>
                                        <th class="text-right">Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    // Pagination setup
                                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                    $limit = 10;
                                    $offset = ($page - 1) * $limit;
                                    
                                    // Build query with search condition
                                    $where = "WHERE seller_id='$seller_id'";
                                    
                                    if(isset($_GET['search']) && !empty($_GET['search'])) {
                                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                                        $where .= " AND (name LIKE '%$search%' OR barcode LIKE '%$search%')";
                                    }
                                    
                                    // Count total products for pagination
                                    $total_rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products $where"))['count'];
                                    $total_pages = ceil($total_rows / $limit);
                                    
                                    // Get products with category info
                                    $query = "SELECT p.*, c.name as category_name 
                                              FROM products p 
                                              LEFT JOIN categories c ON p.category_id = c.id 
                                              $where 
                                              ORDER BY p.id DESC 
                                              LIMIT $offset, $limit";
                                    
                                    $result = mysqli_query($conn, $query);
                                    $i = $offset;
                                    
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <?php
                                            $image = '';
                                            if(!empty($row['thumbnail_image'])) {
                                                if(isJSON($row['thumbnail_image'])) {
                                                    $images = json_decode($row['thumbnail_image'], true);
                                                    if(is_array($images) && !empty($images)) {
                                                        $image = "/public/uploads/all/" . $images[0];
                                                    }
                                                } else {
                                                    $image = "/public/uploads/all/" . $row['thumbnail_image'];
                                                }
                                            }
                                            if(empty($image)) {
                                                $image = "/public/assets/img/placeholder.jpg";
                                            }
                                            ?>
                                            <img src="<?php echo $image; ?>" class="img-fluid size-50px" alt="<?php echo $row['name']; ?>">
                                        </td>
                                        <td>
                                            <a href="/products/<?php echo md5($row['id']); ?>" target="_blank" class="text-reset">
                                                <?php echo $row['name']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $row['category_name'] ?? 'Uncategorized'; ?></td>
                                        <td><?php echo number_format($row['purchase_price'], 0, '.', ','); ?> VND</td>
                                        <td><?php echo $row['quantity'] > 0 ? $row['quantity'] : 'Hết hàng'; ?></td>
                                        <td>
                                            <?php if($row['published'] == 1): ?>
                                                <span class="badge badge-inline badge-success">Đã xuất bản</span>
                                            <?php else: ?>
                                                <span class="badge badge-inline badge-danger">Chưa xuất bản</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" 
                                               href="/seller/products/edit/<?php echo $row['id']; ?>" 
                                               title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" 
                                               data-href="/seller/products/delete.php?id=<?php echo $row['id']; ?>" 
                                               title="Remove from shop" 
                                               onclick="confirm_modal('/seller/products/delete.php?id=<?php echo $row['id']; ?>')">
                                                <i class="las la-trash"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-info btn-icon btn-circle btn-sm" 
                                               onclick="togglePublishStatus(<?php echo $row['id']; ?>, <?php echo $row['published']; ?>)" 
                                               title="<?php echo $row['published'] == 1 ? 'Chưa xuất bản' : 'Đã xuất bản'; ?>">
                                                <i class="las <?php echo $row['published'] == 1 ? 'la-eye-slash' : 'la-eye'; ?>"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                    ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Không tìm thấy sản phẩm nào</td>
                                    </tr>
                                    <?php
                                    }
                                    
                                    // Helper function to check if a string is valid JSON
                                    function isJSON($string) {
                                        if (!is_string($string)) return false;
                                        json_decode($string);
                                        return json_last_error() === JSON_ERROR_NONE;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                            <div class="aiz-pagination mt-3">
                                <nav>
                                    <?php if($total_pages > 1): ?>
                                    <ul class="pagination justify-content-center">
                                        <?php if($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $page-1; ?><?php echo isset($_GET['search']) ? '&search='.$_GET['search'] : ''; ?>">
                                                <i class="las la-angle-left"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        
                                        <?php
                                        $start_page = max(1, $page - 2);
                                        $end_page = min($total_pages, $page + 2);
                                        
                                        for($i = $start_page; $i <= $end_page; $i++): 
                                        ?>
                                        <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search='.$_GET['search'] : ''; ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                        <?php endfor; ?>
                                        
                                        <?php if($page < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?php echo $page+1; ?><?php echo isset($_GET['search']) ? '&search='.$_GET['search'] : ''; ?>">
                                                <i class="las la-angle-right"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                    <?php endif; ?>
                                </nav>
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

    <!-- delete Modal -->
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">Xoá sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">Bạn có chắc chắn sẽ loại bỏ sản phẩm này khỏi cửa hàng của bạn? Sản phẩm vẫn sẽ tồn tại nhưng sẽ không còn được liên kết với cửa hàng của bạn.</p>
                    <button type="button" class="btn btn-link mt-2" data-dismiss="modal">Quay lại</button>
                    <a href="" id="delete-link" class="btn btn-primary mt-2">Xoá</a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->


    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>
    
    <script>
        function confirm_modal(delete_url) {
            jQuery('#delete-modal').modal('show', {backdrop: 'static'});
            document.getElementById('delete-link').setAttribute('href', delete_url);
        }
        
        function togglePublishStatus(id, current_status) {
            if (!id) return;
            
            $.ajax({
                url: '/seller/products/update-status.php',
                type: 'POST',
                data: {
                    id: id,
                    status: current_status == 1 ? 0 : 1
                },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.success) {
                            AIZ.plugins.notify('success', data.message);
                            location.reload();
                        } else {
                            AIZ.plugins.notify('danger', data.message);
                        }
                    } catch (e) {
                        AIZ.plugins.notify('danger', 'An error occurred');
                        console.error(e);
                    }
                },
                error: function() {
                    AIZ.plugins.notify('danger', 'An error occurred');
                }
            });
        }
        
        $(document).ready(function(){
            // Enable search form submission on Enter key
            $('#search').keypress(function(e){
                if(e.which == 13) {
                    $('#sort_products').submit();
                }
            });
        });
    </script>

</body>

</html>