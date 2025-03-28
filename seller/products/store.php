<?php
include("../../config.php");
function loop_arr($arr){
    $ns="";
    foreach($arr as $n)$ns.=",".$n;
    return substr($ns,1);
}
if($isLogin && $isSeller){
    $added_by=$_POST['added_by'];
    $name=$_POST['name'];
    $category_id=$_POST['category_id'];





    $ns_tags=loop_arr($_POST['tags']);

    // echo json_encode($_POST['tags']);
    // die();
    

    
    $photos=$_POST['photos'];
    $thumbnail_img=$_POST['thumbnail_img'];

    $unit_price=$_POST['unit_price'];
    $unit_price=$_POST['unit_price'];
    $purchase_price=$_POST['purchase_price'];

    $discount=$_POST['discount'];
    $discount_type=$_POST['discount_type'];

    $description=$_POST['description'];

    $files=$_FILES['files'];



    $meta_title=$_POST['meta_title'];
    $meta_description=$_POST['meta_description'];
    $meta_img=$_POST['meta_img'];
    $tax_id=$_POST['tax_id'];//arr
    $tax=$_POST['tax'];//arr

    $profit=$tax[0];
    $rose=$tax[1];

    

    $tax_type=$_POST['tax_type'];//arr







    @mysqli_query($conn,"INSERT into products(name,category_id,unit,tags,files,gallery_images,thumbnail_image,unit_price,profit,rose,purchase_price,discount,description,meta_title,slugs,create_date,added_by,seller_id)
    values('$name','$category_id','1','$ns_tags','$files','$photos','$thumbnail_img','$unit_price','$profit','$rose','$purchase_price','$discount','$description','$meta_title','','$createDate','seller','$seller_id')");

    header("Location: /admin/products/index.php");







    





















}
?>