<?php
require_once("./config.php");

// Check if user is logged in
if (!$isLogin) {
    echo json_encode([
        'success' => false,
        'message' => 'You need to be logged in to remove items from your cart.'
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

// Get cart item ID
$cart_item_id = isset($_POST['cart_item_id']) ? intval($_POST['cart_item_id']) : 0;

// Validate the input
if ($cart_item_id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid cart item ID.'
    ]);
    exit;
}

// Verify the cart item belongs to the current user
$check_query = "SELECT id FROM cart WHERE id = ? AND user_id = ? LIMIT 1";
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

// Delete the cart item
$delete_query = "DELETE FROM cart WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($delete_query);
$stmt->bind_param("ii", $cart_item_id, $user_id);

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
        'message' => 'Item removed from cart!',
        'cartCount' => $cart_count
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to remove item from cart.'
    ]);
}

// Close connection
$stmt->close();
$conn->close();
?>
