<?php
include("../../config.php");
function loop_arr($arr){
    $ns="";
    foreach($arr as $n)$ns.=",".$n;
    return substr($ns,1);
}
if($isLogin ){
    $added_by=$_POST['added_by'];
    $name=$_POST['name'];
    $category_id=$_POST['category_id'];

    $brand_id=$_POST['brand_id'];
    $unit=$_POST['unit'];


    $weight=$_POST['weight'];


    $min_qty=$_POST['min_qty'];

    $tags=$_POST['tags'];
    $ns_tags="";
    foreach($tags as $m){
        print_r($tags);

        //echo $m->value;
    }

    
    $barcode=$_POST['barcode'];
    $photos=$_POST['photos'];

    $thumbnail_img=$_POST['thumbnail_img'];
    $video_provider=$_POST['video_provider'];
    $video_link=$_POST['video_link'];
    $choice_attributes=isset($_POST['choice_attributes'])?$_POST['choice_attributes']:false;
    $unit_price=$_POST['unit_price'];
    $date_range=$_POST['date_range'];
    $discount=$_POST['discount'];
    $discount_type=$_POST['discount_type'];
    $current_stock=$_POST['current_stock'];
    $sku=$_POST['sku'];
    $external_link=$_POST['external_link'];

    $description=$_POST['description'];
    $pdf_specification=$_POST['pdf'];

    $files=$_FILES['files'];
    $current_stock=$_POST['current_stock'];



    $pdf=$_POST['pdf'];
    $meta_title=$_POST['meta_title'];
    $meta_description=$_POST['meta_description'];
    $meta_img=$_POST['meta_img'];
    $low_stock_quantity=$_POST['low_stock_quantity'];
    $stock_visibility_state=$_POST['stock_visibility_state'];
    $cash_on_delivery=$_POST['cash_on_delivery'];
    $flash_deal_id=$_POST['flash_deal_id'];
    $flash_discount=$_POST['flash_discount'];
    $flash_discount_type=$_POST['flash_discount_type'];
    $est_shipping_days=$_POST['est_shipping_days'];
    $tax_id=$_POST['tax_id'];//arr
    $tax=$_POST['tax'];//arr
    $tax_type=$_POST['tax_type'];//arr







    @mysqli_query($conn,"INSERT into products(name,category_id,brand_id,unit,weight,minimum_quantity,tags,barcode,gallery_images,thumbnail_image,video_provider,video_link,unit_price,discount_date_range,discount,quantity,sku,external_link,external_link_button_text,description,pdf_specification,meta_title,slugs,create_date)
    values('$name','$category_id','$brand_id','$unit','$weight','$min_qty','','$barcode','$photos','$thumbnail_img','$video_provider','$video_link','$unit_price','','$discount','$current_stock','$sku','$external_link','$external_link_btn','$description','$pdf','$meta_title','','$createDate')");

    header("Location: /admin/products/all.php");







    





















}
?>