<?php
include("../../config.php");

if (!$isSeller) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// Check if required parameters are provided
if (!isset($_POST['id']) || !isset($_POST['status'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

$product_id = intval($_POST['id']);
$status = intval($_POST['status']) ? 1 : 0;

// Verify that the product belongs to the current seller
$check_query = "SELECT id FROM products WHERE id = $product_id AND seller_id = $seller_id";
$check_result = mysqli_query($conn, $check_query);

if (!$check_result || mysqli_num_rows($check_result) == 0) {
    echo json_encode(['success' => false, 'message' => 'Product not found or you do not have permission to modify it']);
    exit;
}

// Update the product status
$update_query = "UPDATE products SET published = $status WHERE id = $product_id";
$result = mysqli_query($conn, $update_query);

if ($result) {
    echo json_encode([
        'success' => true, 
        'message' => 'Product status updated successfully',
        'status' => $status
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to update product status: ' . mysqli_error($conn)
    ]);
}
?>
