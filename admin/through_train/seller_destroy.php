<?php
include("../../config.php");
if($isAdmin && isset($_GET['id'])){
    $id=$_GET['id'];
    @mysqli_query($conn,"UPDATE through_trains SET status='delete' WHERE id='$id' LIMIT 1");
    header("Location: /admin/through_train/sellers.php");

}
?>