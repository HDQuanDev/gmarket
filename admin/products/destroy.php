<?php
include("../../config.php");
if(isset($_GET['id']) && $isAdmin && $isLogin){
    @mysqli_query($conn,"DELETE FROM products  WHERE id='{$_GET['id']}' LIMIT 1");
    echo "<script>history.back()</script>";

}
?>