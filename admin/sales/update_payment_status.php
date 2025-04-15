<?php
include("../../config.php");
if (!$isLogin || !$isAdmin) {
    echo "0";
    exit;
}

if(isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    $update = mysqli_query($conn, "UPDATE orders SET payment_status='$status' WHERE id='$order_id'");
    
    if($update) {
        echo "1"; // Success
    } else {
        echo "0"; // Error
    }
} else {
    echo "0"; // Missing parameters
}
?>