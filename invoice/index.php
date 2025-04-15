<?php
require_once(__DIR__ . "/../config.php");

// Check if user is logged in
if (!$isLogin) {
    header("Location: /users/login");
    exit;
}

// Get order code from URL
$order_code = isset($_GET['code']) ? $_GET['code'] : null;
if (!$order_code) {
    // Extract from URL path - /invoice/ORDER-CODE
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $order_code = end($uri_segments);
}

if (empty($order_code) || $order_code === 'index.php') {
    // No valid order code provided
    header("Location: /purchase_history.php");
    exit;
}

// Get order details
$order_query = "SELECT o.*, u.name as user_name, u.email as user_email
               FROM orders o
               JOIN users u ON o.user_id = u.id
               WHERE o.code = ? AND o.user_id = ? LIMIT 1";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("si", $order_code, $user_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    header("Location: /purchase_history.php");
    exit;
}

// Get order items
$items_query = "SELECT * FROM detail_orders WHERE order_id = ?";
$stmt = $conn->prepare($items_query);
$stmt->bind_param("i", $order['id']);
$stmt->execute();
$items = $stmt->get_result();
$order_items = [];
$subtotal = 0;

while ($item = $items->fetch_assoc()) {
    $item_total = $item['price'] * $item['quantity'];
    $subtotal += $item_total;
    $order_items[] = $item;
}

// Calculate shipping cost
$shipping_cost = $order['amount'] - $subtotal;

// Format the invoice date
$invoice_date = date('d M Y', strtotime($order['create_date']));

// PDF generation libraries are typically used here, but for simplicity we'll use HTML
// In a real application, you'd use a library like FPDF, TCPDF, or mPDF to generate a PDF file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= $order['code'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            .no-print {
                display: none;
            }
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            background-color: #f8f9fa;
            padding: 20px;
            margin: 0;
        }
        
        .container {
            background-color: #fff;
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .header h1 {
            color: #0098F1;
            margin: 0;
            font-size: 24px;
        }
        
        .invoice-meta {
            margin-bottom: 30px;
        }
        
        .invoice-meta table {
            width: 100%;
        }
        
        .invoice-meta td {
            padding: 5px 0;
            vertical-align: top;
        }
        
        .invoice-meta .label {
            font-weight: bold;
            width: 150px;
        }
        
        .customer-info {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
        }
        
        .customer-info > div {
            width: 48%;
        }
        
        .customer-info h3 {
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        
        .items {
            margin-bottom: 30px;
        }
        
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .items th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #eee;
            padding: 10px;
            text-align: left;
        }
        
        .items td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .items .text-right {
            text-align: right;
        }
        
        .totals {
            margin-left: auto;
            width: 300px;
        }
        
        .totals table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .totals td {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .totals .label {
            font-weight: bold;
        }
        
        .totals .text-right {
            text-align: right;
        }
        
        .totals .total {
            font-size: 18px;
            font-weight: bold;
            color: #0098F1;
        }
        
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            color: #777;
            font-size: 12px;
        }
        
        .print-btn {
            background: #0098F1;
            color: white;
            border: none;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        
        .print-btn:hover {
            background: #0083d1;
        }
        
        .back-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
        
        .back-btn:hover {
            background: #5a6268;
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table width="100%">
                <tr>
                    <td>
                        <h1>INVOICE</h1>
                    </td>
                    <td style="text-align: right;">
                        <img src="/public/uploads/final-ver1.svg" alt="Takashimaya" style="height: 50px;">
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="invoice-meta">
            <table>
                <tr>
                    <td class="label">Invoice #:</td>
                    <td><?= $order['code'] ?></td>
                </tr>
                <tr>
                    <td class="label">Date:</td>
                    <td><?= $invoice_date ?></td>
                </tr>
                <tr>
                    <td class="label">Status:</td>
                    <td>
                        <?php
                        $status = $order['delivery_status'] ?: 'Pending';
                        echo $status;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="label">Payment Method:</td>
                    <td><?= $order['payment_option'] ?></td>
                </tr>
            </table>
        </div>
        
        <div class="customer-info">
            <div>
                <h3>Billing Address</h3>
                <p>
                    <?= htmlspecialchars($order['user_name']) ?><br>
                    <?= htmlspecialchars($order['user_email']) ?><br>
                    <?= htmlspecialchars($order['address']) ?>
                </p>
            </div>
            <div>
                <h3>Shipping Address</h3>
                <p>
                    <?= htmlspecialchars($order['user_name']) ?><br>
                    <?= htmlspecialchars($order['address']) ?>
                </p>
            </div>
        </div>
        
        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 1;
                    foreach ($order_items as $item):
                        $item_total = $item['price'] * $item['quantity'];
                    ?>
                    <tr>
                        <td><?= $counter++ ?></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                        <td class="text-right"><?= number_format($item_total, 0, ',', '.') ?> VND</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="totals">
            <table>
                <tr>
                    <td class="label">Subtotal:</td>
                    <td class="text-right"><?= number_format($subtotal, 0, ',', '.') ?> VND</td>
                </tr>
                <tr>
                    <td class="label">Shipping:</td>
                    <td class="text-right"><?= number_format($shipping_cost, 0, ',', '.') ?> VND</td>
                </tr>
                <tr>
                    <td class="label">Tax:</td>
                    <td class="text-right">0.00 VND</td>
                </tr>
                <tr>
                    <td class="label total">Total:</td>
                    <td class="text-right total"><?= number_format($order['amount'], 0, ',', '.') ?> VND</td>
                </tr>
            </table>
        </div>
        
        <div class="footer">
            <p>Thank you for your business!</p>
            <p>For any inquiries, please contact support@gmarketvn.com</p>
            <p>&copy; <?= date('Y') ?> Takashimaya. All rights reserved.</p>
        </div>
        
        <div class="text-center no-print">
            <a href="javascript:history.back()" class="back-btn">Back</a>
            <button onclick="window.print()" class="print-btn">Print Invoice</button>
        </div>
    </div>
</body>
</html>
