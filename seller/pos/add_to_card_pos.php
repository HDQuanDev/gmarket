<?php
include("../../config.php");
header("Content-type: application/json");
if(!isset($_SESSION['pos']))$_SESSION['pos']=[];

$html="";
if(isset($_POST['stock_id']) && $isSeller){
    $stock_id=$_POST['stock_id'];
    $checkExist=fetch_array("SELECT * FROM pos_products WHERE id='$stock_id' LIMIT 1" );
    if($checkExist){

        $newSession=[];
        $isAdd=false;
        foreach($_SESSION['pos'] as $value){
            // exist in session
            if($value['pos_id']==$stock_id){
                $value=array(
                    "pos_id"=>$value['pos_id'],
                    "name"=>$value['name'],
                    "price"=>$value['price'],
                    "image"=>$value['image'],

                    "quantity"=>intval($value['quantity'])+1,
                );
                $isAdd=true;
            }
            $newSession[]=$value;

            
        }
        if(!$isAdd){
            $newSession[]=array(
                "pos_id"=>$checkExist['id'],
                "name"=>$checkExist['name'],
                "price"=>$checkExist['price'],
                "image"=>$checkExist['image'],
                "quantity"=>1,
            );
        }
        $_SESSION['pos']=$newSession;





        //
        $total=0.0;
        foreach($newSession as $value){
            $total+=$value['quantity']*$value['price'];

            $html.="<li class='list-group-item py-0 pl-2'><div class='row gutters-5 align-items-center'><div class='col-auto w-60px'><div class='row no-gutters align-items-center flex-column aiz-plus-minus'><button class='btn col-auto btn-icon btn-sm fs-15' type='button' data-type='plus' data-field='qty-0'><i class='las la-plus'></i></button><input type='text' name='qty-0' id='qty-0' class='col border-0 text-center flex-grow-1 fs-16 input-number' placeholder='1' value='".$value['quantity']."' min='1' max='812000' onchange='updateQuantity(0)'><button class='btn col-auto btn-icon btn-sm fs-15' type='button' data-type='minus' data-field='qty-0' disabled='disabled'><i class='las la-minus'></i></button></div></div><div class='col'><div class='text-truncate-2'>".$value['name']."</div><span class='span badge badge-inline fs-12 badge-soft-secondary'></span></div><div class='col-auto'><div class='fs-12 opacity-60'>".$value['price']."$ x ".$value['quantity']."</div><div class='fs-15 fw-600'>".($value['quantity']*$value['price'])."$</div></div><div class='col-auto'><button type='button' class='btn btn-circle btn-icon btn-sm btn-soft-danger ml-2 mr-0' onclick='removeFromCart(".$value['pos_id'].")'><i class='las la-trash-alt'></i></button></div></div></li>";
        }

    }
    else{
        
    }


}
else die();
?>
{
    "success": 1,
    "message": "",
    "view": "<div class='aiz-pos-cart-list mb-4 mt-3 c-scrollbar-light'>\n                <ul class='list-group list-group-flush'>      <?=$html?>          </ul>\n    </div>\n<div>\n    <div class='d-flex justify-content-between fw-600 mb-2 opacity-70'>\n                                        <span>Quantity</span>\n                                        <span>\n                                                                                    2                                                                                </span>\n                                    </div>\n    <div class='d-flex justify-content-between fw-600 mb-2 opacity-70'>\n        <span>Sub Total</span>\n        <span><?=$total?>$</span>\n    </div>\n    <!--<div class='d-flex justify-content-between fw-600 mb-2 opacity-70'>\n        <span>Tax</span>\n        <span>0.00$</span>\n    </div>\n    <div class='d-flex justify-content-between fw-600 mb-2 opacity-70'>\n        <span>Shipping</span>\n        <span>0.00$</span>\n    </div>\n    <div class='d-flex justify-content-between fw-600 mb-2 opacity-70'>\n        <span>Discount</span>\n        <span>0.00$</span>\n    </div>-->\n    <div class='d-flex justify-content-between fw-600 fs-18 border-top pt-2'>\n        <span>Total</span>\n        <span><?=$total?>$</span>\n    </div>\n</div>"
}