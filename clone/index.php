<?php
include("./function.php");



// $html1=html("https://gmarketagents.com/search?keyword=&page=1");
$html1=html("https://gmarketagents.com/category/ladies-clothing-krads");
$dom = new DOMDocument;
libxml_use_internal_errors(true); // Bỏ qua lỗi do HTML không hợp lệ
$dom->loadHTML($html1);
libxml_clear_errors();
$xpath = new DOMXPath($dom);


$elements = $xpath->query("//div[contains(@class, 'row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2')]");
 foreach ($elements as $element) {
    foreach ($element->childNodes as $child) {
        // In ra thẻ con
        if ($child->nodeType === XML_ELEMENT_NODE) {
            // echo $product_url;
            $c=$dom->saveHTML($child);


            $dom1 = new DOMDocument;
            libxml_use_internal_errors(true); // Bỏ qua lỗi do HTML không hợp lệ
            $dom1->loadHTML($c);
            libxml_clear_errors();
            $xpath1 = new DOMXPath($dom1);
            $product_url = $xpath1->query("//a[contains(@class, 'd-block')]")->item(0)->getAttribute('href');





            echo "<div style='border:1px red solid;margin:10px;padding:10px'>";
            add_product($product_url);
            echo"</div>";
            // die();
            

           

        }
    }
}



?>