<?php
include("../config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&$isLogin) {
    // Kiểm tra nếu có file đã upload
    if (isset($_FILES['aiz_file']) ) {
        echo 1;
        $uploadDir = '../public/uploads/all/';  // Thư mục lưu trữ file
        $fileName = time()."-".($isSeller?$seller_id:$user_id).basename($_FILES['aiz_file']['name']);
        $targetFile = $uploadDir . $fileName;

        $fileType = $_FILES['aiz_file']['type'];  
        $fileSize = $_FILES['aiz_file']['size'];

        // // Lưu file vào thư mục đích
        if (move_uploaded_file($_FILES['aiz_file']['tmp_name'], $targetFile)) {
            if($isAdmin)@mysqli_query($conn,"INSERT into file(src,user_id,type,size,create_date)values('$fileName','$user_id','$fileType','$fileSize','$createDate')");
            else if($isSeller){
                @mysqli_query($conn,"INSERT into file(src,seller_id,type,size,create_date)values('$fileName','$seller_id','$fileType','$fileSize','$createDate')");
            }
            else @mysqli_query($conn,"INSERT into file(src,user_id,type,size,create_date)values('$fileName','$user_id','$fileType','$fileSize','$createDate')");
            echo "File " . htmlspecialchars($fileName) . " đã được tải lên thành công.<br>";
        } else {
        //     echo "Có lỗi xảy ra trong quá trình tải file.<br>";
        }
    } else {
        echo "File chưa được tải lên.<br>";
    }

   
}
?>
