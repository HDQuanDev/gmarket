
<?php
include("../../config.php");
if(isset($_GET['seller_id']) && $isAdmin){
    $_SESSION['seller_id']=$_GET['seller_id'];
    header("Location: /seller");
}
?>