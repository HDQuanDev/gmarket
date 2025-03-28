<?php
include("../../config.php");
if($isAdmin && isset($_POST['value']) && isset($_POST['type'])){
    $value=$_POST['value'];
    $type=$_POST['type'];

    @mysqli_query($conn,"UPDATE seller_setting SET $type=$value ");
    // header("Location: /admin/sellers/vendor_commission.php");
    echo 1;

}
?>