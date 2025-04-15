<?php include("../../config.php");if (!$isSeller) header("Location: /users/login"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="EpLTfG4LJrjCsFJrVbHNwTrBuYT4ExCsOjy4tbOa">
    <meta name="app-url" content="//gmarket-quocte.com/">
    <meta name="file-base-url" content="//gmarket-quocte.com/public/">

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

        #selected-products {
            max-height: 400px;
            overflow-y: auto;
        }
        
        .selected-product-item {
            border-bottom: 1px solid #f3f3f3;
            padding: 8px;
            position: relative;
        }
        
        .selected-product-item:last-child {
            border-bottom: none;
        }
        
        .selected-product-item .remove-btn {
            position: absolute;
            right: 8px;
            top: 8px;
        }
    </style>
    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Không có gì được chọn',
            nothing_found: 'Không tìm thấy',
            choose_file: 'Chọn tệp',
            file_selected: 'Tệp đã được chọn',
            files_selected: 'Các tệp đã được chọn',
            add_more_files: 'Thêm nhiều tệp hơn',
            adding_more_files: 'Đang thêm nhiều tệp hơn',
            drop_files_here_paste_or: 'Thả tệp vào đây, dán hoặc',
            browse: 'Duyệt',
            upload_complete: 'Tải lên hoàn tất',
            upload_paused: 'Tải lên bị tạm dừng',
            resume_upload: 'Tiếp tục tải lên',
            pause_upload: 'Tạm dừng tải lên',
            retry_upload: 'Thử tải lên lại',
            cancel_upload: 'Hủy tải lên',
            uploading: 'Đang tải lên',
            processing: 'Đang xử lý',
            complete: 'Hoàn tất',
            file: 'Tệp',
            files: 'Các tệp',
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

                    <section class="gry-bg py-4 profile">
                        <div class="container-fluids">
                            <form class="" action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="EpLTfG4LJrjCsFJrVbHNwTrBuYT4ExCsOjy4tbOa">
                                <div class="row gutters-10">
                                    <div class="col-md-8">
                                        <div class="row gutters-5 mb-3">
                                            <div class="col-md-4 mb-2 mb-md-0">
                                                <div class="form-group mb-0">
                                                    <input class="form-control form-control-lg" type="text" id="search" name="keyword" placeholder="Search by Product Name/Barcode" onkeyup="filterProducts()">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2 mb-md-0">
                                                <select name="poscategory" id="category_filter" class="form-control form-control-lg aiz-selectpicker" data-live-search="true" onchange="filterProducts()">
                                                    <option value="">Tất cả các loại</option>
                                                    <?php
                                                    $categories_query = mysqli_query($conn, "SELECT * FROM categories");
                                                    while($category = mysqli_fetch_assoc($categories_query)){
                                                        echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="aiz-pos-product-list c-scrollbar-light">
                                            <div class="d-flex flex-wrap justify-content-center" id="product-list">
                                                <!-- Products will be loaded here -->
                                            </div>
                                            <div id="load-more" class="text-center">
                                                <div class="fs-14 d-inline-block fw-600 btn btn-soft-primary c-pointer" onclick="loadMoreProduct()">Tải thêm</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mb-3">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0 fs-14 fw-600">Số sản phẩm đã chọn (<span id="selected-count">0</span>)</h5>
                                            </div>
                                            <div class="card-body p-0">
                                                <div id="selected-products" class="c-scrollbar-light">
                                                    <div class="text-center py-4 fs-14">
                                                        Chưa chọn sản phẩm nào
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="my-2 my-md-0">
                                                    <button type="button" class="btn btn-primary btn-block" onclick="orderConfirmation()">Thêm vào cửa hàng của bạn</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto border-sm-top">
                    <p class="mb-0"></p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <!-- Order Confirmation Modal -->
    <div id="order-confirm" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-xl">
            <div class="modal-content" id="variants">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">Xác nhận sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="order-confirmation">
                    <div class="p-4 text-center">
                        <i class="las la-spinner la-spin la-3x"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="addToProduct()" class="btn btn-primary btn-base-3">Thêm vào cửa hàng của tôi</button>
                    <button type="button" class="btn btn-secondary btn-base-3" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Modal -->
    <div id="new-customer" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">Địa chỉ giao hàng</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="shipping_form">
                    <div class="modal-body" id="shipping_address">


                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-styled btn-base-3" data-dismiss="modal" id="close-button">Đóng</button>
                    <button type="button" class="btn btn-primary btn-styled btn-base-1" id="confirm-address" data-dismiss="modal">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- new address modal -->
    <div id="new-address-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">Địa chỉ giao hàng</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" action="/addresses" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="EpLTfG4LJrjCsFJrVbHNwTrBuYT4ExCsOjy4tbOa">
                    <div class="modal-body">
                        <input type="hidden" name="customer_id" id="set_customer_id" value="">
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="address">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <textarea placeholder="Địa chỉ" id="address" name="address" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label">Quốc gia</label>
                                <div class="col-sm-10">
                                    <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="Chọn quốc gia của bạn" name="country_id" required>
                                        <option value="">Chọn quốc gia của bạn</option>
                                        <option value="231">Hoa Kỳ</option>
                                        <option value="238">Việt Nam</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2 control-label">
                                    <label>Tỉnh/Thành phố</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="state_id" required>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Quận/Huyện</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="city_id" required>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="postal_code">Mã bưu điện</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" placeholder="Mã bưu điện" id="postal_code" name="postal_code" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="phone">Số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" placeholder="Số điện thoại" id="phone" name="phone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-styled btn-base-3" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary btn-styled btn-base-1">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="offlin_payment" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">Thông tin thanh toán ngoại tuyến</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class=" row">
                            <label class="col-sm-3 control-label" for="offline_payment_method">Phương thức thanh toán</label>
                            <div class="col-sm-9">
                                <input placeholder="Tên" id="offline_payment_method" name="offline_payment_method" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class=" row">
                            <label class="col-sm-3 control-label" for="offline_payment_amount">Số tiền</label>
                            <div class="col-sm-9">
                                <input placeholder="Số tiền" id="offline_payment_amount" name="offline_payment_amount" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3 control-label" for="trx_id">Mã giao dịch</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control mb-3" id="trx_id" name="trx_id" placeholder="Mã giao dịch" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Bằng chứng thanh toán</label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Duyệt</div>
                                </div>
                                <div class="form-control file-amount">Chọn hình ảnh</div>
                                <input type="hidden" name="payment_proof" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-base-3" data-dismiss="modal">Đóng</button>
                    <button type="button" onclick="submitOrder('offline_payment')" class="btn btn-styled btn-base-1 btn-success">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>

    <script>
        var products = [];
        var selectedProducts = [];
        var offset = 0;
        var limit = 10;
        var seller_id = <?php echo json_encode($user_id); ?>;
        
        // Format number with commas
        function numberFormat(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        
        // Load products on page load
        $(document).ready(function() {
            loadProducts();
            updateSelectedProductsPanel();
             console.log("abcd");
            // Debug console logs to help troubleshoot
            console.log("Page loaded, seller_id:", seller_id);
        });

        // Load products from database
        function loadProducts() {
            $('#load-more').html('<div class="fs-14 d-inline-block fw-600 btn btn-soft-primary">Đang tải...</div>');
           
            
            $.ajax({
                url: 'ajax-products.php',
                type: 'POST',
                data: {
                    offset: offset,
                    limit: limit,
                    category_id: $('#category_filter').val(),
                    search: $('#search').val()
                },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        console.log("Products loaded:", data.products.length);
                        products = products.concat(data.products);
                        
                        displayProducts(data.products);
                        
                        if (data.has_more === false) {
                            $('#load-more').hide();
                        } else {
                            $('#load-more').html('<div class="fs-14 d-inline-block fw-600 btn btn-soft-primary c-pointer" onclick="loadMoreProduct()">Tải thêm</div>');
                            $('#load-more').show();
                        }
                    } catch (e) {
                        console.error("Error parsing response:", e);
                        console.log("Raw response:", response);
                        $('#product-list').html('<div class="alert alert-danger">Lỗi khi tải sản phẩm</div>');
                        $('#load-more').hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", error);
                    $('#product-list').html('<div class="alert alert-danger">Lỗi khi tải sản phẩm: ' + error + '</div>');
                    $('#load-more').hide();
                }
            });
        }

        // Display products
        function displayProducts(products) {
            var html = '';
            
            if (products.length === 0) {
                html = '<div class="col-12 text-center"><p>No products found</p></div>';
            } else {
                products.forEach(function(product) {
                    let priceDisplay = '';
                    let stockStatus = '';
                    let buttonDisabled = '';
                    
                    // Show discount if available
                    if (product.has_discount) {
                        priceDisplay = `<span class="d-block fw-400">
                            <span class="text-decoration-line-through text-muted">${product.original_price} $</span> 
                            <span class="text-danger">${product.purchase_price} $</span>
                        </span>`;
                    } else {
                        priceDisplay = `<span class="d-block fw-400">${product.purchase_price} $</span>`;
                    }
                    
                    // Check if product is out of stock
                    if (!product.available_quantity || product.available_quantity <= 0) {
                        stockStatus = '<span class="d-block fw-400 text-danger">Hết hàng</span>';
                        buttonDisabled = 'disabled';
                    } else {
                        stockStatus = `<span class="d-block fw-400 text-muted">Số lượng: ${product.available_quantity}</span>`;
                    }
                    
                    html += `<div class="w-140px w-xl-180px w-xxl-210px mx-2 mb-2">
                        <div class="card product-card hov-shadow-md mb-2 has-transition bg-white">
                            <div class="card-body p-2 p-xl-3">
                                <span class="d-block text-center">
                                    <img src="${product.thumbnail_image ? product.thumbnail_image : '/public/assets/img/placeholder.jpg'}" 
                                         class="img-fit h-140px h-xl-180px h-xxl-210px mx-auto" 
                                         alt="${product.name}">
                                </span>
                                <div class="text-center fs-14 mt-2">
                                    <span class="d-block text-truncate-2 fw-600">${product.name}</span>
                                    ${priceDisplay}
                                    ${stockStatus}
                                    <button type="button" class="btn btn-sm btn-primary btn-circle" onclick="addToSelection(${product.id})" ${buttonDisabled}>
                                        <i class="las la-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
            }
            
            if (offset === 0) {
                $('#product-list').html(html);
            } else {
                $('#product-list').append(html);
            }
        }

        // Load more products
        function loadMoreProduct() {
            offset += limit;
            loadProducts();
        }

        // Filter products
        function filterProducts() {
            offset = 0;
            products = [];
            loadProducts();
        }

        // Update the selected products panel
        function updateSelectedProductsPanel() {
            var html = '';
            $('#selected-count').text(selectedProducts.length);
            
            if (selectedProducts.length === 0) {
                html = '<div class="text-center py-4 fs-14">Không có sản phẩm nào được chọn</div>';
            } else {
                // Add a header row
                // html += '<div class="p-3 bg-light border-bottom">';
                // html += '<div class="row fw-600">';
                // html += '<div class="col-6">Sản phẩm</div>';
                // html += '<div class="col-2 text-center">Giá</div>';
                // html += '<div class="col-2 text-center">Số lượng</div>';
                // html += '<div class="col-2 text-right">Tổng cộng</div>';
                // html += '</div>';
                // html += '</div>';
                
                // Calculate running total
                var totalAmount = 0;
                
                selectedProducts.forEach(function(product) {
                    // Initialize quantity if not set
                    if (!product.quantity) product.quantity = 1;
                    
                    // Calculate subtotal using the price after discount
                    var subtotal = product.numeric_price * product.quantity;
                    totalAmount += subtotal;
                    
                    // Prepare price display based on discount
                    let priceDisplay = product.purchase_price;
                    if (product.has_discount) {
                        priceDisplay = `<span class="text-danger">${product.purchase_price}</span>`;
                    }
                    
                    html += `<div class="selected-product-item flex items-center space-x-2">
                        <div class="w-12 h-12 flex-shrink-0 overflow-hidden">
                            <img src="${product.thumbnail_image ? product.thumbnail_image : '/public/assets/img/placeholder.jpg'}" 
                                 class="w-full h-full object-cover" 
                                 alt="${product.name}">
                        </div>
                        <div class="flex-grow truncate">
                            <div class="text-sm font-semibold truncate">${product.name}</div>
                            <div class="mt-1 flex items-center justify-between">
                                <span class="text-xs">${priceDisplay}</span>
                                <span class="text-xs font-semibold">${numberFormat(subtotal)}</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1">
                            <button class="btn btn-light btn-xs px-2" type="button" onclick="updateQuantity(${product.id}, -1)">-</button>
                            <input type="number" class="form-control text-center p-0 w-10" value="${product.quantity}" min="1" 
                                   onchange="updateQuantityDirect(${product.id}, this.value)">
                            <button class="btn btn-light btn-xs px-2" type="button" onclick="updateQuantity(${product.id}, 1)">+</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-icon btn-danger flex-shrink-0" onclick="removeFromSelection(${product.id})">
                            <i class="las la-trash"></i>
                        </button>
                    </div>`;
                });
                
                // Add a footer with total
                html += '<div class="p-3 bg-light border-top">';
                html += '<div class="row">';
                html += '<div class="col-6 fw-600">Total Amount</div>';
                html += `<div class="col-6 text-right fw-700">${numberFormat(totalAmount)} $</div>`;
                html += '</div>';
                html += '</div>';
            }
            
            $('#selected-products').html(html);
        }

        // Add product to selection
        function addToSelection(productId) {
            console.log("Adding product to selection:", productId);
            
            var product = products.find(p => parseInt(p.id) === parseInt(productId));
            
            if (product) {
                console.log("Found product:", product);
                var existingProduct = selectedProducts.find(p => parseInt(p.id) === parseInt(productId));
                
                if (!existingProduct) {
                    // Initialize with quantity 1
                    product.quantity = 1;
                    // Use numeric_purchase_price which already accounts for discount
                    product.numeric_price = product.numeric_purchase_price;
                    
                    selectedProducts.push(product);
                    AIZ.plugins.notify('success', 'Sản phẩm đã được thêm vào danh sách chọn');
                    console.log("Số sản phẩm đã chọn:", selectedProducts.length);
                    updateSelectedProductsPanel();
                } else {
                    AIZ.plugins.notify('warning', 'Sản phẩm đã có trong danh sách chọn');
                }
            } else {
                console.error("Không tìm thấy sản phẩm:", productId);
                AIZ.plugins.notify('danger', 'Sản phẩm không tồn tại');
            }
        }
        
        // Update quantity for a product
        function updateQuantity(productId, change) {
            var product = selectedProducts.find(p => parseInt(p.id) === parseInt(productId));
            if (product) {
                product.quantity = Math.max(1, (product.quantity || 1) + change);
                updateSelectedProductsPanel();
            }
        }
        
        // Update quantity directly from input
        function updateQuantityDirect(productId, value) {
            var product = selectedProducts.find(p => parseInt(p.id) === parseInt(productId));
            if (product) {
                product.quantity = Math.max(1, parseInt(value) || 1);
                updateSelectedProductsPanel();
            }
        }
        
        // Calculate total cost of selected products
        function calculateTotalCost() {
            return selectedProducts.reduce((total, product) => {
                return total + (product.numeric_price * product.quantity);
            }, 0);
        }

        // Show order confirmation modal
        function orderConfirmation() {
            console.log("Order confirmation called, selected products:", selectedProducts.length);
            
            if (selectedProducts.length === 0) {
                AIZ.plugins.notify('warning', 'Không có product nào được chọn');
                return;
            }
            
            var totalCost = calculateTotalCost();
            
            var html = '<div class="overflow-x-auto">'
            html += '<table class="table-auto w-full border-collapse border border-gray-200">'
            html += '<thead class="bg-gray-100">';
            html += '<tr>';
            html += '<th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Sản phẩm</th>';
            html += '<th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Đơn giá ($)</th>';
            html += '<th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Số lượng</th>';
            html += '<th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Tổng cộng ($)</th>';
            html += '<th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Hành động</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            
            selectedProducts.forEach(function(product) {
                var subtotal = product.numeric_price * product.quantity;
                
                // Prepare price display based on discount
                let priceDisplay = product.purchase_price;
                if (product.has_discount) {
                    priceDisplay = `
                        <div>
                            <span class="line-through text-gray-500">${product.original_price}</span>
                        </div>
                        <div class="text-red-500">${product.purchase_price}</div>
                    `;
                }
                
                html += `<tr class="border-t border-gray-200">
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                        <div class=" items-center space-x-3">
                            <img src="${product.thumbnail_image ? product.thumbnail_image : '/public/assets/img/placeholder.jpg'}" 
                                 class="w-12 h-12 object-cover" alt="${product.name}">
                            <span>${product.name}</span>
                        </div>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${priceDisplay}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                        <div class="flex items-center space-x-2">
                            <button class="px-2 py-1 bg-gray-200 text-gray-700 rounded" type="button" onclick="updateQuantity(${product.id}, -1); orderConfirmation();">-</button>
                            <input type="number" class="w-12 text-center border border-gray-300 rounded" value="${product.quantity}" min="1" 
                                   onchange="updateQuantityDirect(${product.id}, this.value); orderConfirmation();">
                            <button class="px-2 py-1 bg-gray-200 text-gray-700 rounded" type="button" onclick="updateQuantity(${product.id}, 1); orderConfirmation();">+</button>
                        </div>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">${numberFormat(subtotal)}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                        <button type="button" class="px-3 py-1 bg-red-500 text-white rounded" onclick="removeFromSelectionModal(${product.id})">
                            <i class="las la-trash"></i>
                        </button>
                    </td>
                </tr>`;
            });
            
            html += '</tbody>';
            html += '<tfoot>';
            html += '<tr class="bg-gray-100">';
            html += '<td colspan="3" class="border border-gray-300 px-4 py-2 text-right text-sm font-medium text-gray-700">Total:</td>';
            html += `<td colspan="2" class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700">${numberFormat(totalCost)} $</td>`;
            html += '</tr>';
            html += '</tfoot>';
            html += '</table></div>';
            
            $('#order-confirmation').html(html);
            $('#order-confirm').modal('show');
        }
        
        // Function to add selected products to shop
        function addToProduct() {
            if (selectedProducts.length === 0) {
                AIZ.plugins.notify('warning', 'Không có product nào được chọn');
                return;
            }
            
            var products = selectedProducts.map(p => {
                return {
                    id: p.id,
                    quantity: p.quantity
                };
            });
            
            console.log("Adding products to shop:", products);
            
            $('#order-confirmation').html('<div class="p-4 text-center"><i class="las la-spinner la-spin la-3x"></i><p class="mt-2">Đang tải...</p></div>');
            
            $.ajax({
                url: 'add-to-shop.php',
                type: 'POST',
                data: {
                    products: JSON.stringify(products),
                    seller_id: seller_id
                },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        console.log("Add to shop response:", data);
                        
                        if (data.success) {
                            AIZ.plugins.notify('success', data.message);
                            selectedProducts = [];
                            updateSelectedProductsPanel();
                            $('#order-confirm').modal('hide');
                            
                            // Reload products
                            offset = 0;
                            products = [];
                            loadProducts();
                        } else {
                            AIZ.plugins.notify('danger', data.message || 'Đã xảy ra lỗi, vui lòng thử lại sau');
                            $('#order-confirmation').html('<div class="alert alert-danger">' + (data.message || 'Đã xảy ra lỗi') + '</div>');
                        }
                    } catch (e) {
                        console.error("Error parsing response:", e);
                        console.log("Raw response:", response);
                        AIZ.plugins.notify('danger', 'Lỗi xử lý dữ liệu');
                        $('#order-confirmation').html('<div class="alert alert-danger">Lỗi xử lý phản hồi</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", error);
                    AIZ.plugins.notify('danger', 'Lỗi: ' + error);
                    $('#order-confirmation').html('<div class="alert alert-danger">Yêu cầu thất bại: ' + error + '</div>');
                }
            });
        }
        
        // Add function to remove product from selection in modal
        function removeFromSelectionModal(productId) {
            removeFromSelection(productId);
            orderConfirmation();
            
            if (selectedProducts.length === 0) {
                $('#order-confirm').modal('hide');
            }
        }
        
        // Remove product from selection
        function removeFromSelection(productId) {
            selectedProducts = selectedProducts.filter(p => parseInt(p.id) !== parseInt(productId));
            updateSelectedProductsPanel();
        }
    </script>

</body>

</html>