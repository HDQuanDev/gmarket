<?php
include("../../config.php");
if (!isset($_SESSION['pos'])) $_SESSION['pos'] = [];

$html = "";
if (isset($_POST['key']) && $isSeller && count($_SESSION['pos'])) {
    $stock_id = $_POST['key'];
    $newSession = [];
    foreach ($_SESSION['pos'] as $value) {
            // exist in session
        if ($value['pos_id'] != $stock_id) {
            $newSession[] = array(
                "pos_id" => $value['pos_id'],
                "name" => $value['name'],
                "price" => $value['price'],
                "quantity" => intval($value['quantity']) + 1,
            );
        }
    }
    $_SESSION['pos'] = $newSession;

        //
        
} else die();
?>

<div class="aiz-pos-cart-list mb-4 mt-3 c-scrollbar-light">
    <ul class="list-group list-group-flush">
        <?php
        $total = 0.0;
        $count=0;
        foreach ($newSession as $value) {
            
        ?>
        <li class="list-group-item py-0 pl-2">
            <div class="row gutters-5 align-items-center">
                <div class="col-auto w-60px">
                    <div class="row no-gutters align-items-center flex-column aiz-plus-minus">
                        <button class="btn col-auto btn-icon btn-sm fs-15" type="button" data-type="plus" data-field="qty-1">

                            <i class="las la-plus"></i>
                        </button>
                        <input type="text" name="qty-1" id="qty-1" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="1" min="1" max="912000" onchange="updateQuantity(1)">
                        <button class="btn col-auto btn-icon btn-sm fs-15" type="button" data-type="minus" data-field="qty-1">
                            <i class="las la-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="col">
                    <div class="text-truncate-2"><?=$value['name']?></div>
                    <span class="span badge badge-inline fs-12 badge-soft-secondary"></span>
                </div>
                <div class="col-auto">
                    <div class="fs-12 opacity-60"><?=$value['price']?>$ x <?=$value['quantity']?></div>
                    <div class="fs-15 fw-600"><?=($value['price']*$value['quantity'])?>$</div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-circle btn-icon btn-sm btn-soft-danger ml-2 mr-0" onclick="removeFromCart(<?=$value['pos_id']?>)">
                        <i class="las la-trash-alt"></i>
                    </button>
                </div>
            </div>
        </li>
        <?php }?>
    </ul>
</div>
<div>
    <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
        <span>Quantity</span>
        <span> <?=$count?> </span>
    </div>
    <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
        <span>Sub Total</span>
        <span><?=$total?>$</span>
    </div>
    <!--<div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
        <span>Tax</span>
        <span>0.00$</span>
    </div>
    <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
        <span>Shipping</span>
        <span>0.00$</span>
    </div>
    <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
        <span>Discount</span>
        <span>0.00$</span>
    </div>-->
    <div class="d-flex justify-content-between fw-600 fs-18 border-top pt-2">
        <span>Total</span>
        <span><?=$total?>$</span>
    </div>
</div>