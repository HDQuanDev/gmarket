<?php
include("../../config.php");
if (!$isLogin || !$isAdmin) {
    echo "Unauthorized access";
    exit;
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $order_id = $_GET['id'];
    
    // First delete all order details
    $delete_details = mysqli_query($conn, "DELETE FROM detail_orders WHERE order_id='$order_id'");
    
    // Then delete the order
    $delete_order = mysqli_query($conn, "DELETE FROM orders WHERE id='$order_id'");
    
    if($delete_order) {
        // Success
        header("Location: /admin/sales/all_orders.php?status=success&message=Order deleted successfully");
    } else {
        // Error
        header("Location: /admin/sales/all_orders.php?status=error&message=Failed to delete order");
    }
} else {
    header("Location: /admin/sales/all_orders.php?status=error&message=Invalid order ID");
}
