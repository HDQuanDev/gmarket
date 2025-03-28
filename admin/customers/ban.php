<?php
include("../../config.php");
if(isset($_GET['id']) && $isAdmin && $isLogin){
    @mysqli_query($conn,"UPDATE users SET status='lock' WHERE id='{$_GET['id']}' LIMIT 1");
    echo "<script>history.back()</script>";

}
?>