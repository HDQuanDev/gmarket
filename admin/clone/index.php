<?php 
include("../../config.php");
function html1($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
}

// echo html1("/admin/clone/1.json");
// echo file_get_contents("http://localhost/admin/clone/1.json");

$i=0;
while($i<=30){
    $i++;
    $data=json_decode(file_get_contents("http://localhost/admin/clone/$i.json"));
    foreach($data->data as $value){

        $PRODUCT_IMG=$value->thumbnail_image;
        $stock_id=$value->stock_id;
        $name=htmlspecialchars($value->name);
        $price=floatval($value->price);
        $base_price=floatval($value->base_price);
        $variant=$value->variant;
        $quantity=$value->qty;

       


        $BASE_PRODUCT_IMG=basename($PRODUCT_IMG);
        // echo "INSERT into file(src,user_id,type,size,status)values('$BASE_PRODUCT_IMG','1','image','0','delete')";
        // die();
        
        $save=@file_put_contents("./image/". $BASE_PRODUCT_IMG,  file_get_contents($PRODUCT_IMG));

        @mysqli_query($conn,"INSERT into file(src,user_id,type,size,status)values('$BASE_PRODUCT_IMG','1','image','0','delete')");
        $id=mysqli_insert_id($conn);

        @mysqli_query($conn,"INSERT into pos_products(stock_id,name,image,price,base_price,quantity,variant)values('$stock_id','$name','$id','$price','$base_price','$quantity','$variant')");
        echo $BASE_PRODUCT_IMG."<br>";



    }
}
?>
