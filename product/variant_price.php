<?php
header("Content-type: application/json");
if(file_get_contents("php://input")!=""){

    $data = [];
    parse_str(file_get_contents("php://input"), $data);


    $price=floatval($data['price']);
    $quantity=intval($data['quantity']);
    $max_limit=intval($data['max_limit']);


    echo json_encode(array(
        "price"=> ($price*$quantity)."$",
        "quantity"=> 100,
        "digital"=> 0,
        "variation"=> "",
        "max_limit"=> 100,
        "in_stock"=> 1
    ));

}
?>