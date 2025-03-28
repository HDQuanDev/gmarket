<?php
include("../../config.php");
if(isset($_GET['id']) && $isAdmin){
    @mysqli_query($conn,"UPDATE sellers SET status='lock' WHERE id='{$_GET['id']}' LIMIT 1");
    header("Location: /admin/sellers/");
}
?>