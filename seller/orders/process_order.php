<?php
include("../../config.php");

// Check if user is logged in as seller
if (!$isSeller) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get request data
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

if ($order_id <= 0 || $amount <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid order ID or amount']);
    exit;
}

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Get order details and check if it's already processed
    $sql = "SELECT 
            o.id AS order_id, 
            o.code, 
            o.delivery_status, 
            o.payment_status, 
            o.create_date, 
            o.payment_option, 
            u.email, 
            u.full_name,
            JSON_ARRAYAGG(
                JSON_OBJECT(
                    'detail_id', do.id,
                    'status_xuli', do.status_xuli
                )
            ) AS order_details
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.id
        LEFT JOIN detail_orders do ON do.order_id = o.id
        WHERE o.id = $order_id
        GROUP BY o.id
        ORDER BY o.create_date DESC
        LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        throw new Exception("Order not found or does not belong to you");
    }

    $order = mysqli_fetch_assoc($result);

    // if ($order['status_xuli'] == 1) {
    //     throw new Exception("This order has already been processed");
    // }

    // Get seller's current balance from sellers table
    $seller_query = "SELECT money FROM sellers WHERE id = '$seller_id'";
    $seller_result = mysqli_query($conn, $seller_query);

    if (mysqli_num_rows($seller_result) == 0) {
        throw new Exception("Seller account not found");
    }

    $seller = mysqli_fetch_assoc($seller_result);
    $current_balance = $seller['money'];

    // Check if seller has enough balance
    if ($current_balance < $amount) {
        throw new Exception("Insufficient funds. Your balance: " . number_format($current_balance, 2) . " $");
    }

    // Update seller's balance
    $new_balance = $current_balance - $amount;
    $update_seller = "UPDATE sellers SET money = $new_balance WHERE id = '$seller_id'";
    if (!mysqli_query($conn, $update_seller)) {
        throw new Exception("Failed to update seller balance");
    }

    // Update order processing status in detail_orders table
    $order_details = json_decode($order['order_details'], true);
    foreach ($order_details as $order_detail) {
        $detail_id = intval($order_detail['detail_id']);
        $update_order = "UPDATE detail_orders SET status_xuli = 1 WHERE id = $detail_id";
        if (!mysqli_query($conn, $update_order)) {
            throw new Exception("Failed to update order status");
        }
    }

    // Update payment status to Paid in orders table
    $update_payment = "UPDATE orders SET payment_status = 'Paid' WHERE id = " . $order['order_id'];
    if (!mysqli_query($conn, $update_payment)) {
        throw new Exception("Failed to update payment status");
    }

    // Update delivery status to Delivered in orders table
    $update_delivery = "UPDATE orders SET delivery_status = 'Confirmed' WHERE id = " . $order['order_id'];
    if (!mysqli_query($conn, $update_delivery)) {
        throw new Exception("Failed to update delivery status");
    }

    // Commit transaction
    mysqli_commit($conn);

    echo json_encode([
        'success' => true,
        'message' => 'Order processed successfully. Order has been marked as Processing.',
        'new_balance' => number_format($new_balance, 2)
    ]);
    
} catch (Exception $e) {
    // Rollback transaction
    mysqli_rollback($conn);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
