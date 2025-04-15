<?php
include("../../config.php");
if (!$isLogin || !$isAdmin) {
    echo "0";
    exit;
}

if(isset($_POST['id']) && is_array($_POST['id'])) {
    $success = true;
    
    foreach($_POST['id'] as $order_id) {
        // First delete all order details
        $delete_details = mysqli_query($conn, "DELETE FROM detail_orders WHERE order_id='$order_id'");
        
        // Then delete the order
        $delete_order = mysqli_query($conn, "DELETE FROM orders WHERE id='$order_id'");
        
        if(!$delete_order) {
            $success = false;
        }
    }
    
    if($success) {
        echo "1"; // Success
    } else {
        echo "0"; // Error
    }
} else {
    echo "0"; // No orders selected
}
