<?php
include("../../config.php");

if(isset($_POST['id']) && isset($_POST['status'])){
    $id=$_POST['id'];
    $pack_id=$_POST['package_id'];
    $status=$_POST['status']=='1'?'active':'pending';

    @mysqli_query($conn,"UPDATE sellers SET package_id='$pack_id' WHERE id='$pack_id'");
    @mysqli_query($conn,"UPDATE package_purchase_history SET status='$status' WHERE id='$id' LIMIT 1");
    echo 1;

}

?>