<?php
include("../../config.php");
if (!$isLogin || !$isAdmin) {
    echo "0";
    exit;
}

if(isset($_POST['order_id']) && isset($_POST['tracking_code'])) {
    $order_id = $_POST['order_id'];
    $tracking_code = $_POST['tracking_code'];
    
    $update = mysqli_query($conn, "UPDATE orders SET code='$tracking_code' WHERE id='$order_id'");
    
    if($update) {
        echo "1"; // Success
    } else {
        echo "0"; // Error
    }
} else {
    echo "0"; // Missing parameters
}
