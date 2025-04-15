<?php
include("../../config.php");

if (!$isSeller) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /seller/products");
    exit;
}

$product_id = intval($_GET['id']);

// Verify that the product belongs to the current seller
$check_query = "SELECT id FROM products WHERE id = $product_id AND seller_id = $seller_id";
$check_result = mysqli_query($conn, $check_query);

if (!$check_result || mysqli_num_rows($check_result) == 0) {
    $_SESSION['error'] = 'Product not found or you do not have permission to modify it';
    header("Location: /seller/products");
    exit;
}

// Update the product to set seller_id to NULL instead of deleting it
$update_query = "UPDATE products SET 
                seller_id = NULL, 
                added_by = 'admin', 
                published = 0 
                WHERE id = $product_id AND seller_id = $seller_id";

if (mysqli_query($conn, $update_query)) {
    $_SESSION['success'] = 'Product removed from your shop successfully';
} else {
    $_SESSION['error'] = 'Failed to remove product: ' . mysqli_error($conn);
}

// Redirect back to products page
header("Location: /seller/products");
exit;
?>
