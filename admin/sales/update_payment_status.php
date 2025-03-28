<?php
include("../../config.php");

if($isAdmin && isset($_POST['order_id'])){
    $order_id=$_POST['order_id'];
    $status=$_POST['status'];
    @mysqli_query($conn,"UPDATE orders SET payment_status='$status' WHERE id='$order_id' LIMIT 1");
    echo 1;

}

?>