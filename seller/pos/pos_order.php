<?php
include("../../config.php");

if (isset($_POST['token']) && count($_SESSION['pos'])) {
    // foreach ($_SESSION['pos'] as $value) {
    //     @mysqli_query($conn, "INSERT into products(seller_id,type_product,name,unit_price,quantity)values($seller_id,'pos','{$value['name']}','{$value['price']}','{$value['quantity']}')");
    // }
}

?>

<div class="row">
    <div class="col-xl-6">
        <ul class="list-group list-group-flush">
            <?php
            $total=0.0;
            foreach($_SESSION['pos'] as $value){
                $total+=$value['price'];
                $file=fetch_array("SELECT * FROM file WHERE id='{$value['image']}' LIMIT 1");

            ?>
            <li class="list-group-item px-0">
                <div class="row gutters-10 align-items-center">
                    <div class="col">
                        <div class="d-flex">
                            <img src="<?=$file?'/public/uploads/all/'.$file['src']:''?>" class="img-fit size-60px">
                            <span class="flex-grow-1 ml-3 mr-0">
                                <div class="text-truncate-2"><?=$value['name']?></div>
                                <span class="span badge badge-inline fs-12 badge-soft-secondary"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="fs-14 fw-600 text-right"><?=$value['price']?>$</div>
                        <div class="fs-14 text-right">QTY: <?=$value['quantity']?></div>
                    </div>
                </div>
            </li>
            <?php }?>
            
        </ul>
    </div>
    <div class="col-xl-6">
        <div class="pl-xl-4">
            <!--<div class="card mb-4">
				<div class="card-header"><span class="fs-16">Customer Info</span></div>
				<div class="card-body">
											<div class="text-center p-4">
							No customer information selected.
						</div>
									</div>
			</div>-->

            <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
                <span>Total</span>
                <span><?=$total?>$</span>
            </div>
            <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
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
            </div>
            <div class="d-flex justify-content-between fw-600 fs-18 border-top pt-2">
                <span>Total</span>
                <span>75.13$</span>
            </div>
        </div>
    </div>
</div>