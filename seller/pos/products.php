<?php
include("../../config.php");
header("Content-type: application/json");
$data=[];
if(!isset($_GET['page']) || $_GET['page']=="")$page=1;
else $page=intval($_GET['page']);
$sql=mysqli_query($conn,"SELECT * FROM pos_products WHERE id>($page-1)*30 and id<=$page*30 ");
while($row=fetch_assoc($sql)){
    $thumbnail_image=fetch_array("SELECT * FROM file WHERE id='{$row['image']}' LIMIT 1");
    if(!$thumbnail_image)continue;
    $data[]=array(
        "id"=>intval($row['id']),
        "stock_id"=>intval($row['stock_id']),
        "name"=>$row['name'],
        "thumbnail_image"=>"/public/uploads/all/".$thumbnail_image['src'],
        "price"=>$row['price'],
        "base_price"=>$row['base_price'],
        "qty"=>intval($row['quantity']),
        "variant"=>$row['variant'],
    );
}
echo json_encode(array(
    "data"=>$data,
    "links"=> array(
        "first"=> "/pos/products?page=1",
        "last"=> "/pos/products?page=96",
        "prev"=> "/pos/products?page=".($page-1<0)?0:($page-1),
        "next"=> "/pos/products?page=".($page+1),
    ),
    "meta"=> array(
        "current_page"=> 3,
        "from"=> 929,
        "last_page"=> 96,
        "links"=> [
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=29","label"=> "« Previous","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=1","label"=> "1","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=2","label"=> "2","active"=> false),
            array("url"=> null,"label"=> "...","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=27","label"=> "27","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=28","label"=> "28","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=29","label"=> "29","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=30","label"=> "30","active"=> true),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=31","label"=> "31","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=32","label"=> "32","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=33","label"=> "33","active"=> false),
            array("url"=> null,"label"=> "...","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=95","label"=> "95","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=96","label"=> "96","active"=> false),
            array("url"=> "https=>//gmarket-quocte.com/pos/products?page=31","label"=> "Next »","active"=> false)
        ],
        "path"=> "https=>//gmarket-quocte.com/pos/products",
        "per_page"=> 32,
        "to"=> 960,
        "total"=> 3065
    ),
    "success"=> true,
    "status"=> 200
));

?>