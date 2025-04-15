<?php
require_once(__DIR__ . "/../config.php");

// Check if user is logged in
if (!$isLogin) {
    echo "You must be logged in to view order details";
    exit;
}

// Get order ID from query string
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Validate the order belongs to the logged-in user
$order_query = "SELECT * FROM orders WHERE id = ? AND user_id = ? LIMIT 1";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    echo "Order not found or you don't have permission to view it";
    exit;
}

// Get order items
$items_query = "SELECT * FROM detail_orders WHERE order_id = ?";
$stmt = $conn->prepare($items_query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result();

// Display order details
?>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Order #<?= $order['code'] ?></h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="mb-3">Order Info</h5>
                <p><strong>Order Code:</strong> <?= $order['code'] ?></p>
                <p><strong>Order Date:</strong> <?= date('d-m-Y H:i', strtotime($order['create_date'])) ?></p>
                <p><strong>Status:</strong> <?= $order['delivery_status'] ?: 'Pending' ?></p>
                <p><strong>Payment Method:</strong> <?= $order['payment_option'] ?></p>
            </div>
            <div class="col-lg-6">
                <h5 class="mb-3">Shipping Address</h5>
                <p><?= htmlspecialchars($order['address']) ?></p>
            </div>
        </div>
        
        <?php if (!empty($order['additional_info'])): ?>
        <div class="row mt-3">
            <div class="col-12">
                <h5 class="mb-3">Additional Information</h5>
                <p><?= nl2br(htmlspecialchars($order['additional_info'])) ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Order Items</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $subtotal = 0;
                    while ($item = $items->fetch_assoc()): 
                        $item_total = $item['price'] * $item['quantity'];
                        $subtotal += $item_total;
                    ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= $item['img'] ?>" class="size-50px mr-3" alt="<?= $item['name'] ?>">
                                <span><?= $item['name'] ?></span>
                            </div>
                        </td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                        <td><?= number_format($item_total, 0, ',', '.') ?> VND</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Subtotal</th>
                        <td><?= number_format($subtotal, 0, ',', '.') ?> VND</td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Shipping</th>
                        <td>
                            <?php 
                            $shipping = $order['amount'] - $subtotal;
                            echo number_format($shipping, 0, ',', '.') . ' VND'; 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Total</th>
                        <td><?= number_format($order['amount'], 0, ',', '.') ?> VND</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
