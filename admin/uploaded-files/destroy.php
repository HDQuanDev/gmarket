<?php
include("../../config.php");
if($isAdmin && isset($_GET['id'])){
    $id=$_GET['id'];
    @mysqli_query($conn,"UPDATE file SET status='delete' WHERE id='$id' LIMIT 1");
    header("Location: /admin/uploaded-files/index.php");

}
?>