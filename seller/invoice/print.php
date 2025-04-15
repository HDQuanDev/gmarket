<?php
include("../../config.php");
if(!$isLogin || !$isSeller) header("Location: /");

// Get order ID from URL parameter
$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// If no order ID provided, redirect back
if($order_id <= 0) {
    header("Location: /seller/orders");
    exit;
}

// Get seller ID from session
$seller_id = $_SESSION['seller_id'];

// First, fetch the order details
$order_query = "SELECT o.*, u.full_name as customer_name, u.email as customer_email, o.phone as customer_phone 
                FROM orders o 
                LEFT JOIN users u ON o.user_id = u.id
                WHERE o.id = ?";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();

if($order_result->num_rows == 0) {
    echo "Order not found!";
    exit;
}

$order = $order_result->fetch_assoc();

// Get all items from this seller for this order
$items_query = "SELECT 
    od.name,
    MAX(od.id) as detail_order_id,
    MAX(od.price) as price,
    MAX(od.quantity) as quantity,
    MAX(p.thumbnail_image) as thumbnail_image,
    MAX(p.id) as product_id,
    MAX(p.slugs) as slugs,
    MAX(p.name) as product_name
FROM detail_orders od 
LEFT JOIN products p ON od.name = p.name
WHERE od.order_id = ? AND od.from_seller = ?
GROUP BY od.name
";
$stmt = $conn->prepare($items_query);
$stmt->bind_param("ii", $order_id, $seller_id);
$stmt->execute();
$items_result = $stmt->get_result();
$order_items = array();
$seller_subtotal = 0;

$last_product_name = null;
while($item = $items_result->fetch_assoc()) {
    if ($item['product_name'] == $last_product_name) {
        continue;
    }
    // Calculate item total
    $item_total = $item['price'] * $item['quantity'];
    $seller_subtotal += $item_total;
    $order_items[] = $item;
    $last_product_name = $item['product_name'];
}



// Get seller information
$seller_query = "SELECT * FROM sellers WHERE id = ?";
$stmt = $conn->prepare($seller_query);
$stmt->bind_param("i", $seller_id);
$stmt->execute();
$seller_result = $stmt->get_result();
$seller = $seller_result->fetch_assoc();

// Format date
$date = new DateTime($order['create_date'], new DateTimeZone('UTC'));
$date->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh')); // GMT+7
$order_date = $date->format('d-m-Y');


// Now generate the invoice HTML
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gmarket Invoice #<?= $order['code'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 60px;
            margin-right: 10px;
        }
        .logo-text {
            font-weight: bold;
            font-size: 24px;
        }
        .invoice-title {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }
        .company-info, .customer-info {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .company-info p, .customer-info p {
            margin: 5px 0;
        }
        .info-container {
            display: flex;
            justify-content: space-between;
        }
        .invoice-details {
            text-align: right;
            font-size: 14px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        .customer-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }
        th {
            background-color: #f9f9f9;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .totals {
            width: 300px;
            margin-left: auto;
            margin-top: 20px;
        }
        .totals table {
            width: 100%;
        }
        .totals td {
            padding: 5px 10px;
        }
        .total-row td {
            font-weight: bold;
            border-top: 1px solid #000;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
                margin: 0;
            }
        }
        .print-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <button class="print-btn no-print" onclick="window.print()">Print Invoice</button>
    
    <div class="header">
        <div class="logo">
            <img src="/public/uploads/final-ver1.svg" alt="Gmarket Logo">
     
        </div>
        <div class="invoice-title">INVOICE</div>
    </div>

    <div class="info-container">
        <div class="company-info">
            <p><strong><?= htmlspecialchars($seller['shop_name'] ?? 'Gmarket Seller') ?></strong></p>
            <p><?= htmlspecialchars($seller['shop_address'] ?? 'No address provided') ?></p>
            <p>Email: <?= htmlspecialchars($seller['email'] ?? 'contact@gmarket.com') ?></p>
            <p>Phone: <?= htmlspecialchars($seller['phone'] ?? 'N/A') ?></p>
        </div>
        <div class="invoice-details">
            <p>Order Code: <?= htmlspecialchars($order['code']) ?></p>
            <p>Order Date: <?= $order_date ?></p>
            <p>Payment Method: <?= htmlspecialchars(str_replace('_', ' ', $order['payment_option'] ?: 'N/A')) ?></p>
            <p>Payment Status: <?= $order['payment_status'] ?: 'Unpaid' ?></p>
        </div>
    </div>

    <div class="customer-info">
        <p class="customer-title">Customer Information:</p>
        <p>Name: <?= htmlspecialchars($order['customer_name'] ?: 'Unknown') ?></p>
        <p>Address: <?= htmlspecialchars($order['address'] ?: 'No address provided') ?></p>
        <p>Email: <?= htmlspecialchars($order['customer_email'] ?: 'Not provided') ?></p>
        <p>Phone: <?= htmlspecialchars($order['customer_phone'] ?: 'Not provided') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Delivery Type</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Tax</th>
                <th class="text-right">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($order_items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td>Home Delivery</td>
                <td class="text-center"><?= $item['quantity'] ?></td>
                <td class="text-right">$<?= number_format($item['price'], 2) ?></td>
                <td class="text-right">$0.00</td>
                <td class="text-right">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td>Subtotal</td>
                <td class="text-right">$<?= number_format($seller_subtotal, 2) ?></td>
            </tr>
            <tr>
                <td>Shipping Cost</td>
                <td class="text-right">$0.00</td>
            </tr>
            <tr>
                <td>Tax Amount</td>
                <td class="text-right">$0.00</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td class="text-right">$0.00</td>
            </tr>
            <tr class="total-row">
                <td>Grand Total</td>
                <td class="text-right">$<?= number_format($seller_subtotal, 2) ?></td>
            </tr>
        </table>
    </div>

    <script>
        // Auto print on page load
        window.onload = function() {
            // Uncomment the line below if you want the invoice to automatically print when loaded
            // window.print();
        }
    </script>
</body>
</html>
