<?php
require_once("./config.php");

// Check if user is logged in
if (!$isLogin) {
    echo json_encode([
        'success' => false,
        'message' => 'You need to be logged in to cancel an order.'
    ]);
    exit;
}

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}

// Get order ID
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;

// Validate the input
if ($order_id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid order ID.'
    ]);
    exit;
}

// Verify the order belongs to the current user
$order_query = "SELECT * FROM orders WHERE id = ? AND user_id = ? LIMIT 1";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Order not found or you do not have permission to cancel it.'
    ]);
    exit;
}

$order = $result->fetch_assoc();

// Check if order can be cancelled (not delivered or already cancelled)
if (in_array($order['delivery_status'], ['Delivered', 'Cancelled'])) {
    echo json_encode([
        'success' => false,
        'message' => 'This order cannot be cancelled because it is already ' . $order['delivery_status'] . '.'
    ]);
    exit;
}

// Start a transaction
$conn->begin_transaction();

try {
    // Update order status to Cancelled
    $update_order_query = "UPDATE orders SET delivery_status = 'Cancelled', updated_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($update_order_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    // Get order details to restore product quantities
    $order_details_query = "SELECT * FROM detail_orders WHERE order_id = ?";
    $stmt = $conn->prepare($order_details_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $details_result = $stmt->get_result();

    // Process each order item
    while ($item = $details_result->fetch_assoc()) {
        // Restore product quantity if from a seller
        if ($item['from_seller']) {
            $product_id = isset($item['product_id']) ? $item['product_id'] : null;
            
            if ($product_id) {
                // Restore product quantity
                $update_product_query = "UPDATE products SET quantity = quantity + ? WHERE id = ? LIMIT 1";
                $stmt = $conn->prepare($update_product_query);
                $stmt->bind_param("ii", $item['quantity'], $product_id);
                $stmt->execute();
            }

            // Revert seller commission if applicable
            if ($item['rose'] > 0) {
                $update_seller_query = "UPDATE sellers SET rose = rose - ?, money = money - ? WHERE id = ? LIMIT 1";
                $stmt = $conn->prepare($update_seller_query);
                $stmt->bind_param("ddi", $item['rose'], $item['rose'], $item['from_seller']);
                $stmt->execute();
            }
        }
    }

    // Commit the transaction
    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Order cancelled successfully.'
    ]);
} catch (Exception $e) {
    // Rollback the transaction in case of error
    $conn->rollback();

    echo json_encode([
        'success' => false,
        'message' => 'Failed to cancel order. Error: ' . $e->getMessage()
    ]);
}

$conn->close();
