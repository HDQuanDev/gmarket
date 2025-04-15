<?php
include("../../config.php");
if(!$isLogin || !$isSeller)header("Location: /");

// Get detail order ID from URL parameter
$detail_order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Enable for debugging
$debug_mode = false;
if($debug_mode) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    echo "<div style='background:#f8d7da;border:1px solid #f5c6cb;padding:10px;margin:10px;border-radius:5px;'>";
    echo "<p><strong>Debug Mode:</strong> ON</p>";
    echo "<p>Detail Order ID: {$detail_order_id}</p>";
    echo "<p>Seller ID: {$_SESSION['seller_id']}</p>";
    echo "</div>";
}

// If no detail order ID provided, redirect to orders list
if($detail_order_id <= 0) {
    header("Location: /seller/orders");
    exit;
}

// Get seller ID from session
$seller_id = $_SESSION['seller_id'];

// First, fetch the detail_order record
$detail_query = "SELECT * FROM detail_orders WHERE id = ? AND from_seller = ?";
$stmt = $conn->prepare($detail_query);
$stmt->bind_param("ii", $detail_order_id, $seller_id);
$stmt->execute();
$detail_result = $stmt->get_result();

// Check if detail order exists and belongs to this seller
if($detail_result->num_rows == 0) {
    if($debug_mode) {
        echo "<div style='background:#f8d7da;border:1px solid #f5c6cb;padding:10px;margin:10px;border-radius:5px;'>";
        echo "<p><strong>Error:</strong> Detail order not found or does not belong to your shop.</p>";
        echo "</div>";
    } else {
        header("Location: /seller/orders");
        exit;
    }
    $detail_order = null;
} else {
    $detail_order = $detail_result->fetch_assoc();
    $order_id = $detail_order['order_id'];

    // Now fetch the order details using order_id from detail_order
    $order_query = "SELECT o.*, u.full_name as customer_name, u.email as customer_email, u.phone as customer_phone 
                    FROM orders o 
                    LEFT JOIN users u ON o.user_id = u.id
                    WHERE o.id = ?";
    $stmt = $conn->prepare($order_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_result = $stmt->get_result();

    if($order_result->num_rows > 0) {
        $order = $order_result->fetch_assoc();
    } else {
        if($debug_mode) {
            echo "<div style='background:#f8d7da;border:1px solid #f5c6cb;padding:10px;margin:10px;border-radius:5px;'>";
            echo "<p><strong>Error:</strong> Related order not found in database.</p>";
            echo "</div>";
        }
        // Create an empty order with default values to prevent null offset errors
        $order = [
            'id' => $order_id,
            'code' => 'Unknown',
            'delivery_status' => 'Pending',
            'payment_status' => 'Unpaid',
            'payment_option' => 'Unknown',
            'additional_info' => '',
            'address' => 'No address provided',
            'create_date' => date('Y-m-d H:i:s'),
            'customer_name' => 'Unknown Customer',
            'customer_email' => '',
            'customer_phone' => ''
        ];
    }

    // Fetch all items for this seller and order in a single query
    $items_query = "SELECT od.*, p.thumbnail_image, p.id as product_id, p.slugs,  p.name as product_name,
                    (od.price * od.quantity) as item_total,
                    CASE WHEN od.id = ? THEN 1 ELSE 0 END as is_current,
                    COALESCE(p.thumbnail_image, od.img, '/public/assets/img/placeholder.jpg') as image_path
                    FROM detail_orders od 
                    LEFT JOIN products p ON od.name = p.name
                    WHERE od.order_id = ? AND od.from_seller = ?";
    $stmt = $conn->prepare($items_query);
    $stmt->bind_param("iii", $detail_order_id, $order_id, $seller_id);
    $stmt->execute();
    $items_result = $stmt->get_result();
    $order_items = array();
    $seller_subtotal = 0;

    $last_product_name = null;
    while($item = $items_result->fetch_assoc()) {
        if($item['product_name'] == $last_product_name) {
            continue;
        }
        $seller_subtotal += $item['item_total'];
        $item['is_current'] = (bool)$item['is_current'];
        $item['image_path'] = '/public/uploads/all/' . $item['image_path'];
        $order_items[] = $item;
        $last_product_name = $item['product_name'];
    }
    
}

// Determine status for display
$current_status = $order['delivery_status'] ?? 'Pending';
$status_class = '';
$status_badge = '';

switch($current_status) {
    case 'Pending':
        $status_badge = 'badge-info';
        break;
    case 'Processing':
        $status_badge = 'badge-primary';
        break;
    case 'Shipped':
        $status_badge = 'badge-warning';
        break;
    case 'Delivered':
        $status_badge = 'badge-success';
        break;
    case 'Cancelled':
        $status_badge = 'badge-danger';
        break;
    default:
        $status_badge = 'badge-secondary';
}
?>

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
    <title>Order #<?= $order['code'] ?> | Gmarket Seller Dashboard</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-seller.css">

    <style>
        body {
            font-size: 12px;
        }
        
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #eee;
        }
        
        .badge-status {
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem;
        }
        
        .order-status-timeline .timeline-item {
            position: relative;
            padding-bottom: 1rem;
            padding-left: 2.5rem;
        }
        
        .order-status-timeline .timeline-item:before {
            content: "";
            position: absolute;
            left: 0.85rem;
            top: 0.3rem;
            bottom: 0;
            width: 1px;
            background-color: #e2e8f0;
        }
        
        .order-status-timeline .timeline-item:last-child:before {
            display: none;
        }
        
        .order-status-timeline .timeline-item .timeline-badge {
            position: absolute;
            left: 0;
            top: 0;
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            z-index: 1;
        }
        
        .order-status-timeline .timeline-item.active .timeline-badge {
            background-color: #5cb85c;
            border-color: #5cb85c;
            color: #fff;
        }
        
        .order-status-timeline .timeline-item.complete .timeline-badge {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
        }
        
        .order-status-timeline .timeline-item.cancelled .timeline-badge {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
        
        .order-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="aiz-main-wrapper">
        <?php include("../layout/sidebar.php") ?>
        
        <div class="py-3 px-4 lg:px-6">
            <?php include("../layout/topbar.php") ?>
            
            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <?php if(!$detail_order || count($order_items) === 0): ?>
                    <div class="alert alert-warning mb-3">
                        <div class="d-flex">
                            <div class="mr-3">
                                <i class="las la-exclamation-circle la-2x"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">Không tìm thấy sản phẩm</h5>
                                <p class="mb-0">Sản phẩm trong đơn hàng này không được tìm thấy hoặc không thuộc cửa hàng của bạn.</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="/seller/orders" class="btn btn-primary">
                            <i class="las la-arrow-left mr-2"></i> Quay lại danh sách đơn hàng
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="h3 mb-0">Chi tiết đơn hàng</h1>
                                
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <!-- Thông tin tiêu đề đơn hàng -->
                            <div class="row gutters-5 mb-4">
                                <div class="col-md-4">
                                    <div class="mb-3 d-flex align-items-center">
                                        <span class="mr-2">Mã đơn hàng:</span>
                                        <span class="badge badge-inline badge-dark"><?= $order['code'] ?></span>
                                    </div>
                                    <div class="mb-3 d-flex align-items-center">
                                        <span class="mr-2">Ngày đặt hàng:</span>
                                        <span><?= date('d M Y, h:i A', strtotime($order['create_date'])) ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 d-flex align-items-center">
                                        <span class="mr-2">Trạng thái đơn hàng:</span>
                                        <span class="badge badge-inline <?= $status_badge ?>"><?= $current_status ?></span>
                                    </div>
                                    <div class="mb-3 d-flex align-items-center">
                                        <span class="mr-2">Trạng thái thanh toán:</span>
                                        <span class="badge badge-inline <?= $order['payment_status'] == 'Paid' ? 'badge-success' : 'badge-warning' ?>">
                                            <?= $order['payment_status'] ?: 'Chưa thanh toán' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 text-md-right">
                                    <div class="mb-3">
                                        <span class="mr-2">Phương thức thanh toán:</span>
                                        <span class="text-capitalize"><?= str_replace('_', ' ', $order['payment_option'] ?: 'Không có') ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="mr-2">Tổng số tiền:</span>
                                        <span class="text-primary h5">$<?= number_format($seller_subtotal, 2) ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Order Status Timeline (only for non-cancelled orders) -->
                            <?php if($current_status !== 'Cancelled'): ?>
                            <div class="card shadow-none bg-light mb-4">
                                <div class="card-body">
                                    <h5 class="mb-3">Trạng thái đơn hàng</h5>
                                    
                                    <div class="order-status-timeline">
                                        <?php
                                        $status_steps = ['Pending', 'Processing', 'Shipped', 'Delivered'];
                                        $current_step_index = array_search($current_status, $status_steps);
                                        
                                        foreach($status_steps as $index => $step):
                                            $step_label = '';
                                            $step_labels = [
                                                'Pending' => 'Đang chờ',
                                                'Processing' => 'Đang chuẩn bị hàng',
                                                'Shipped' => 'Đang vận chuyển',
                                                'Delivered' => 'Đã giao hàng'
                                            ];
                                            $step_label = $step_labels[$step];
                                            $step_class = '';
                                            if($current_step_index !== false) {
                                                if($index < $current_step_index) {
                                                    $step_class = 'complete';
                                                } elseif($index === $current_step_index) {
                                                    $step_class = 'active';
                                                }
                                            }
                                        ?>
                                        <div class="timeline-item <?= $step_class ?>">
                                            <div class="timeline-badge">
                                                <?php if($step_class): ?>
                                                <i class="las la-check"></i>
                                                <?php else: ?>
                                                <i class="las la-circle"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0"><?= $step_label ?></h6>
                                                <small class="text-muted">
                                                    <?php
                                                    if($step_class === 'active' || $step_class === 'complete') {
                                                        echo date('d M Y, h:i A', strtotime($order['create_date']));
                                                    } else {
                                                        echo 'Đang chờ';
                                                    }
                                                    ?>
                                                </small>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <!-- Cancelled Order Notice -->
                            <div class="alert alert-danger mb-4">
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <i class="las la-exclamation-triangle la-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="alert-heading">Order Cancelled</h5>
                                        <p class="mb-0">This order has been cancelled and cannot be processed further.</p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Customer Information -->
                            <div class="row gutters-5 mb-4">
                                <div class="col-md-6">
                                    <div class="card shadow-none bg-light">
                                        <div class="card-header">
                                            <h5 class="mb-0">Thông tin khách hàng</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex mb-2">
                                                <span class="w-25 font-weight-bold">Tên:</span>
                                                <span><?= $order['customer_name'] ?: 'Không xác định' ?></span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <span class="w-25 font-weight-bold">Email:</span>
                                                <span><?= $order['customer_email'] ?: 'Không cung cấp' ?></span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <span class="w-25 font-weight-bold">Số điện thoại:</span>
                                                <span><?= $order['customer_phone'] ?: 'Không cung cấp' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card shadow-none bg-light">
                                        <div class="card-header">
                                            <h5 class="mb-0">Địa chỉ giao hàng</h5>
                                        </div>
                                        <div class="card-body">
                                            <address class="mb-0">
                                                <?= nl2br($order['address'] ?: 'Không có địa chỉ') ?>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Các sản phẩm trong đơn hàng -->
                            <div class="card shadow-none bg-light mb-4 ">
                                <div class="card-header">
                                    <h5 class="mb-0">Sản phẩm trong đơn hàng</h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                                            <thead class="bg-gray-100 border-b border-gray-200">
                                                <tr>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">#</th>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Hình ảnh</th>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Sản phẩm</th>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Số lượng</th>
                                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Đơn giá</th>
                                                    <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Tổng cộng</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                <?php foreach($order_items as $key => $item): ?>
                                                <tr class="<?= $item['is_current'] ? 'bg-blue-50' : '' ?>">
                                                    <td class="px-4 py-3 text-sm text-gray-700"><?= $key + 1 ?></td>
                                                    <td class="px-4 py-3">
                                                        <img src="<?= $item['image_path'] ?>" class="w-12 h-12 object-cover rounded-md border border-gray-300" alt="<?= htmlspecialchars($item['name']) ?>">
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <div class="text-sm font-medium text-gray-800 truncate">
                                                            <?php if(!empty($item['product_id']) || !empty($item['slugs'])): ?>
                                                            <a href="/product/<?= !empty($item['slugs']) ? $item['slugs'] : $item['product_id'] ?>" target="_blank" class="text-blue-600 hover:underline">
                                                                <?= htmlspecialchars($item['name']) ?>
                                                            </a>
                                                            <?php else: ?>
                                                            <?= htmlspecialchars($item['name']) ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if($item['is_current']): ?>
                                                        <span class="inline-block mt-1 text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded">Current Item</span>
                                                        <?php endif; ?>
                                                        <?php if($item['status_xuli'] == 1): ?>
                                                        <span class="inline-block mt-1 text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded">Processed</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-700"><?= $item['quantity'] ?></td>
                                                    <td class="px-4 py-3 text-sm text-gray-700">$<?= number_format($item['price'], 2) ?></td>
                                                    <td class="px-4 py-3 text-sm text-gray-700 text-right">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="w-100 grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div class="flex flex-col space-y-2 md:flex-row md:items-center md:space-y-0 md:space-x-2">
                                            <a href="/seller/invoice/print.php?id=<?= $order_id ?>" target="_blank" class="btn btn-sm btn-info bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center justify-center">
                                                <i class="las la-print mr-2"></i> In hóa đơn
                                            </a>
                                            <a href="/seller/orders" class="btn btn-sm btn-light bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md flex items-center justify-center">
                                                <i class="las la-arrow-left mr-2"></i> Quay lại danh sách đơn hàng
                                            </a>
                                        </div>
                                        <div class="flex flex-col items-end space-y-2">
                                            <div class="flex justify-between w-full text-sm sm:text-base">
                                                <span class="text-gray-600">Tạm tính:</span>
                                                <span class="text-gray-800">$<?= number_format($seller_subtotal, 2) ?></span>
                                            </div>
                                            <div class="flex justify-between w-full text-sm sm:text-base">
                                                <span class="text-gray-600">Thuế:</span>
                                                <span class="text-gray-800">$0.00</span>
                                            </div>
                                            <div class="flex justify-between w-full text-sm sm:text-base">
                                                <span class="text-gray-600">Phí vận chuyển:</span>
                                                <span class="text-gray-800">$0.00</span>
                                            </div>
                                            <div class="flex justify-between w-full text-sm sm:text-base">
                                                <span class="text-gray-600">Giảm giá:</span>
                                                <span class="text-gray-800">$0.00</span>
                                            </div>
                                            <div class="flex justify-between w-full font-bold text-lg sm:text-xl">
                                                <span class="text-gray-900">Tổng cộng:</span>
                                                <span class="text-blue-700 font-extrabold">$<?= number_format($seller_subtotal, 2) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Additional Information (if provided) -->
                            <?php if(!empty($order['additional_info'])): ?>
                            <div class="card shadow-none bg-light">
                                <div class="card-header">
                                    <h5 class="mb-0">Additional Information</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($order['additional_info'])) ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
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
</body>
</html>