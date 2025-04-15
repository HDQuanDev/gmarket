<?php
include("../../config.php");

if(!$isLogin || !$isAdmin) {
    echo "0";
    exit;
}

if(isset($_POST['id']) && isset($_POST['status'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    // Only allow 'active' or 'lock' status
    if($status != 'active' && $status != 'lock') {
        $status = 'lock';
    }
    
    $query = "UPDATE sellers SET status = '$status' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    
    if($result) {
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "0";
}
?>
