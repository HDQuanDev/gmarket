<?php
include("../../config.php");
if(count($_SESSION['pos']) && $isSeller){
    foreach($_SESSION['pos'] as $value){
        $checkExist=fetch_array("SELECT * FROM products WHERE pos_id='{$value['pos_id']}'");
        if($checkExist)continue;
        @mysqli_query($conn,"INSERT into products(seller_id,name,pos_id,quantity,gallery_images,thumbnail_image,unit_price)values('$seller_id','{$value['name']}','{$value['pos_id']}','{$value['quantity']}','{$value['image']}','{$value['image']}','{$value['price']}')");

        
    }
}
echo json_encode(array("data"=>"success"));
// http_response_code(200);

?>