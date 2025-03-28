<?php
include("../../config.php");
if(isset($_GET['id']) && $isAdmin && $isLogin){
    @mysqli_query($conn,"DELETE FROM users  WHERE id='{$_GET['id']}' and role='user' LIMIT 1");
    echo "<script>history.back()</script>";

}
?>