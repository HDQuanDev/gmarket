<?php
include("../config.php");

if(!isset($_POST['search']) || $_POST['search']=="")die();
$search=strtolower($_POST['search']);

?>
<!-- <div class="">
</div>
<div class="">
</div> -->

<style>
    div[class="typed-search-box stop-propagation document-click-d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"]{
        z-index: 100000;
    }
</style>
<!-- <div class="">
    <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary">Products</div>
    <ul class="list-group list-group-raw">
        <li class="list-group-item">
            <a class="text-reset" href="/product/-CtSyi">
                <div class="d-flex search-product align-items-center">
                    <div class="mr-3">
                        <img class="size-40px img-fit rounded" src="//laz-img-sg.alicdn.com/p/12384d5dae83635723dab7db52af3bcd.jpg">
                    </div>
                    <div class="flex-grow-1 overflow--hidden minw-0">
                        <div class="product-name text-truncate fs-14 mb-5px">
                            SHOP24 AIWIBI Baby shampoo &amp; shower natural camellia oil baby shampoo &amp; shower extra mild cleansing of skin and hair best protection from the first day quality product from Australia 350ml
                        </div>
                        <div class="">
                            <span class="fw-600 fs-16 text-primary">14.90$</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li class="list-group-item">
            <a class="text-reset" href="/product/-CtSyi-bxOyH">
                <div class="d-flex search-product align-items-center">
                    <div class="mr-3">
                        <img class="size-40px img-fit rounded" src="//laz-img-sg.alicdn.com/p/12384d5dae83635723dab7db52af3bcd.jpg">
                    </div>
                    <div class="flex-grow-1 overflow--hidden minw-0">
                        <div class="product-name text-truncate fs-14 mb-5px">
                            SHOP24 AIWIBI Baby shampoo &amp; shower natural camellia oil baby shampoo &amp; shower extra mild cleansing of skin and hair best protection from the first day quality product from Australia 350ml
                        </div>
                        <div class="">
                            <span class="fw-600 fs-16 text-primary">14.90$</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li class="list-group-item">
            <a class="text-reset" href="/product/-CtSyi-FwOL0">
                <div class="d-flex search-product align-items-center">
                    <div class="mr-3">
                        <img class="size-40px img-fit rounded" src="//laz-img-sg.alicdn.com/p/12384d5dae83635723dab7db52af3bcd.jpg">
                    </div>
                    <div class="flex-grow-1 overflow--hidden minw-0">
                        <div class="product-name text-truncate fs-14 mb-5px">
                            SHOP24 AIWIBI Baby shampoo &amp; shower natural camellia oil baby shampoo &amp; shower extra mild cleansing of skin and hair best protection from the first day quality product from Australia 350ml
                        </div>
                        <div class="">
                            <span class="fw-600 fs-16 text-primary">14.90$</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</div> -->
<div class="">
    <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary">Shops</div>
    <ul class="list-group list-group-raw">
        <?php
        $sql=mysqli_query($conn,"SELECT * FROM sellers WHERE LOWER(shop_name) LIKE '%$search%' LIMIT 10");
        while($row=fetch_assoc($sql)){
            $shop_logo=fetch_array("SELECT src FROM file WHERE id='{$row['shop_logo']}' LIMIT 1");
        ?>
        <li class="list-group-item">
            <a class="text-reset" href="/shop/<?=md5($row['id'])?>">
                <div class="d-flex search-product align-items-center">
                    <div class="mr-3">
                        <img class="size-40px img-fit rounded" src="/public/<?=$shop_logo?"uploads/all/".$shop_logo['src']:'assets/img/placeholder.jpg'?>">
                    </div>
                    <div class="flex-grow-1 overflow--hidden">
                        <div class="product-name text-truncate fs-14 mb-5px">
                            <?=$row['shop_name']?>
                        </div>
                        <div class="opacity-60">
                           <?=$row['shop_address']?>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <?php }?>
        
        
    </ul>
</div>