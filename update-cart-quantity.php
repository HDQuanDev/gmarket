<?php
require_once("./config.php");

// Check if user is logged in
if (!$isLogin) {
    echo json_encode([
        'success' => false,
        'message' => 'You need to be logged in to update your cart.'
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

// Get form data
$cart_item_id = isset($_POST['cart_item_id']) ? intval($_POST['cart_item_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

// Validate the input
if ($cart_item_id <= 0 || $quantity <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid cart item ID or quantity.'
    ]);
    exit;
}

// Verify the cart item belongs to the current user
$check_query = "SELECT c.id, p.quantity as available_quantity 
                FROM cart c 
                JOIN products p ON c.product_id = p.id
                WHERE c.id = ? AND c.user_id = ? 
                LIMIT 1";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("ii", $cart_item_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Item not found in your cart.'
    ]);
    exit;
}

// Check if requested quantity is available
$item = $result->fetch_assoc();
if ($quantity > $item['available_quantity']) {
    echo json_encode([
        'success' => false,
        'message' => 'Requested quantity is not available. Only ' . $item['available_quantity'] . ' items left in stock.'
    ]);
    exit;
}

// Update the cart item quantity
$update_query = "UPDATE cart SET quantity = ?, updated_at = NOW() WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($update_query);
$stmt->bind_param("iii", $quantity, $cart_item_id, $user_id);

if ($stmt->execute()) {
    // Get updated cart count
    $count_query = "SELECT SUM(quantity) as cart_count FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($count_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $count_result = $stmt->get_result();
    $cart_data = $count_result->fetch_assoc();
    $cart_count = $cart_data['cart_count'] ?? 0;
    
    echo json_encode([
        'success' => true,
        'message' => 'Cart updated successfully!',
        'cartCount' => $cart_count
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update cart.'
    ]);
}

// Close connection
$stmt->close();
$conn->close();
?>
