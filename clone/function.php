<?php
include("../config.php");
function html($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}


function add_product($url){
    global $conn;
    $html=html($url);

    $dom = new DOMDocument;
    libxml_use_internal_errors(true); // Bỏ qua lỗi do HTML không hợp lệ
    $dom->loadHTML($html);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);

    $elements = $xpath->query("//div[contains(@class, 'row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2')]");
    $PRODUCT_IMG = $xpath->query("//img[contains(@class, 'img-fluid lazyload')]")->item(0)->getAttribute('data-src');
    $PRODUCT_UNIT_PRICE = trim(($xpath->query("//strong[contains(@class, 'h2 fw-600 text-primary')]"))->item(0)->nodeValue);
    $PRODUCT_NAME = trim(($xpath->query("//h1[contains(@class, 'mb-2 fs-20 fw-600')]"))->item(0)->nodeValue);
    $PRODUCT_QUANTITY = trim(($xpath->query("//span[@id='available-quantity']"))->item(0)->nodeValue);
    $PRODUCT_CATEGORY_ID=1;//ladies
    $PRODUCT_BRAND_ID=1;//apple
    $PRODUCT_UNIT=4;//apple
    $PRODUCT_WEIGHT=4.00;//apple
    $PRODUCT_MINIMUM_QUANTITY=1;//apple
    $PRODUCT_TAGS="";

    $path = parse_url($url, PHP_URL_PATH);
    $PRODUCT_SLUGS = basename($path);




    $PRODUCT_DES="";
    $element1=$xpath->query("//div[contains(@class,'mw-100 overflow-auto text-left aiz-editor-data')]");
    foreach ($element1 as $element) {
        foreach ($element->childNodes as $child) {
            if ($child->nodeType === XML_ELEMENT_NODE) {
                $c=$dom->saveHTML($child);
                $PRODUCT_DES.=$c;
            }
        }
    }
    $PRODUCT_DES=htmlspecialchars($PRODUCT_DES);
    
    $BASE_PRODUCT_IMG=basename($PRODUCT_IMG);
    $BASE_PRODUCT_IMG=explode('#',$BASE_PRODUCT_IMG)[0];
    $save=@file_put_contents("./image/". basename($PRODUCT_IMG),  file_get_contents($PRODUCT_IMG));

    @mysqli_query($conn,"INSERT into file(src,user_id)values('$BASE_PRODUCT_IMG',1)");
    $PRODUCT_GALERY_IMAGES = mysqli_insert_id($conn);
    $PRODUCT_THUMBNAIL_IMAGE = mysqli_insert_id($conn);

echo "INSERT into products(`name`,`category_id`,`brand_id`,`unit`,`weight`,`minimum_quantity`,`tags`,`gallery_images`,`thumbnail_image`,`unit_price`,`quantity`,`description`,`slugs`)
values('$PRODUCT_NAME','$PRODUCT_CATEGORY_ID','$PRODUCT_BRAND_ID','$PRODUCT_UNIT','$PRODUCT_WEIGHT','$PRODUCT_MINIMUM_QUANTITY','$PRODUCT_TAGS','$PRODUCT_GALERY_IMAGES','$PRODUCT_THUMBNAIL_IMAGE','$PRODUCT_UNIT_PRICE','$PRODUCT_QUANTITY','$PRODUCT_DES','$PRODUCT_SLUGS')";
die();

    @mysqli_query($conn,"INSERT into products(`name`,`category_id`,`brand_id`,`unit`,`weight`,`minimum_quantity`,`tags`,`gallery_images`,`thumbnail_image`,`unit_price`,`quantity`,`description`,`slugs`)
    values('$PRODUCT_NAME','$PRODUCT_CATEGORY_ID','$PRODUCT_BRAND_ID','$PRODUCT_UNIT','$PRODUCT_WEIGHT','$PRODUCT_MINIMUM_QUANTITY','$PRODUCT_TAGS','$PRODUCT_GALERY_IMAGES','$PRODUCT_THUMBNAIL_IMAGE','$PRODUCT_UNIT_PRICE','$PRODUCT_QUANTITY','$PRODUCT_DES','$PRODUCT_SLUGS')");


    echo $PRODUCT_IMG."<str style='color:green'>$BASE_PRODUCT_IMG</str>";
    echo "<br>";
    echo $PRODUCT_NAME." - ".$PRODUCT_UNIT_PRICE. " - LIMIT : ".$PRODUCT_QUANTITY."-". $PRODUCT_SLUGS;
    echo "<br>";

    echo $url;
    echo "<br>";

}

?>