<?php
$footer_setting = fetch_array("SELECT  * FROM website_footer LIMIT 1");
?>
<section class="bg-white border-top mt-auto">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="/terms">
                    <i class="la la-file-text la-3x text-primary mb-2"></i>
                    <h4 class="h6">Terms &amp; conditions</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="/return-policy">
                    <i class="la la-mail-reply la-3x text-primary mb-2"></i>
                    <h4 class="h6">Return policy</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="/support-policy">
                    <i class="la la-support la-3x text-primary mb-2"></i>
                    <h4 class="h6">Support Policy</h4>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left border-right text-center p-4 d-block" href="/privacy-policy">
                    <i class="las la-exclamation-circle la-3x text-primary mb-2"></i>
                    <h4 class="h6">Privacy policy</h4>
                </a>
            </div>
        </div>
    </div>
</section>
</div>
<section class="bg-dark py-5 text-light footer-widget">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-xl-4 text-center text-md-left">
                <div class="mt-4">
                    <a href="" class="d-block">
                        <img class="lazyload" src="/public/assets/img/placeholder-rect.jpg" data-src="/public/uploads/all/d2grNsNYud5xW9aMD2v99SwZSmYSsJMOhS42eSBs.jpg" alt="GMARKETVN" height="44">
                    </a>
                    <div class="my-3">

                    </div>
                    <div class="d-inline-block d-md-block mb-4">
                        <form class="form-inline" method="POST" action="/subscribers">
                            <input type="hidden" name="_token" value="aCXlmkGIF8M5mTlqrTsNo6sGJQysBJlDUqOh9JGt">
                            <div class="form-group mb-0">
                                <input type="email" class="form-control" placeholder="Your Email Address" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <?= tran("Subscribe") ?>
                            </button>
                        </form>
                    </div>
                    <div class="w-300px mw-100 mx-auto mx-md-0">
                        <a href="/" target="_blank" class="d-inline-block mr-3 ml-0">
                            <img src="/public/assets/img/play.png" class="mx-100 h-40px">
                        </a>
                        <a href="/" target="_blank" class="d-inline-block">
                            <img src="/public/assets/img/app.png" class="mx-100 h-40px">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ml-xl-auto col-md-4 mr-0">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        <?= tran("Contact Info") ?>
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="d-block opacity-30"><?= tran("Address") ?>:</span>
                            <span class="d-block opacity-70"><?= $footer_setting['contact_address'] ?></span>
                        </li>
                        <li class="mb-2">
                            <span class="d-block opacity-30"><?= tran("Phone") ?>:</span>
                            <span class="d-block opacity-70"><?= $footer_setting['contact_phone'] ?></span>
                        </li>
                        <li class="mb-2">
                            <span class="d-block opacity-30">Email:</span>
                            <span class="d-block opacity-70">
                                <?= $footer_setting['contact_email'] ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        <?= tran("My Account") ?>
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="/users/login">
                                <?= tran("Login") ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="/purchase_history">
                                <?= tran("Order History") ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="/wishlists">
                                <?= tran("My Wishlist") ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="/track-your-order">
                                <?= tran("Track Order") ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-light" href="/affiliate"><?= tran("Be an affiliate partner") ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                        <?= tran("Be A Seller") ?>
                    </h4>
                    <!-- <p>Become seller in our website</p> -->
                    <a href="/shops/create.php" class="btn btn-primary btn-sm shadow-md">
                        <?= tran("Shop registration") ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="pt-3 pb-7 pb-xl-3 bg-black text-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="text-center text-md-left" current-verison="7.4.0">

                </div>
            </div>
            <div class="col-lg-4">
                <ul class="list-inline my-3 my-md-0 social colored text-center">
                    <li class="list-inline-item">
                        <a href="<?= $footer_setting['facebook_url'] ?>" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?= $footer_setting['twitter_url'] ?>" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?= $footer_setting['instagram_url'] ?>" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?= $footer_setting['youtube_url'] ?>" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="<?= $footer_setting['linkedin_url'] ?>" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/x2PNOaOS6VXSI1SGozrjHtZ1yVp8Mfq9RXB0yD8H.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/4qF2PJQHw5rtlmeiwtP0Rk2o9KjsFyfLdZ2pUsPg.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/davn6mDDhwClwSzwT1PRuDSotpyAhm1Uyh7hyoqC.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/4fvIoubXi7wTPla0GJInJXaeuiDevlXxmvkQDBAT.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/mPc42zjeqLErWAyTks76Vgc2mNq6oqjPQmSiRo0n.webp" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/1ZZ6ccmeWUOBii7WEvFnVpnzY2q0I5xhe06pOI4T.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/2JRFnzKLOnt81chRISVQBKLADNBdRDMEVmls3dU2.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/VwEOJNH2n3FNDi1dgUpvOvbGNS0oKaYZVjn9GnMy.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/dqpOssMysk0H5ovefvOUM2aF0O1UhR6rmzx5jBRx.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/OT3aJXJBsq4xHaubKHYwVWm35iUI7zFqRSqkOZ7E.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/hhjvgBFNlxrifyeRE2oVohk6kAmg3drnXCTqSQIl.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        <li class="list-inline-item">
                            <img src="/public/uploads/all/nd0NuuOseK1RY4dGaUKR9r6HrLsFQlHUSNJa5aS3.png" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
    <div class="row align-items-center gutters-5">
        <div class="col">
            <a href="/" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-home fs-20 opacity-60 opacity-100 text-primary"></i>
                <span class="d-block fs-10 fw-600 opacity-60 opacity-100 fw-600"><?= tran("Home") ?></span>
            </a>
        </div>
        <div class="col">
            <a href="/categories" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-list-ul fs-20 opacity-60 "></i>
                <span class="d-block fs-10 fw-600 opacity-60 "><?= tran("Categories") ?></span>
            </a>
        </div>
        <div class="col-auto">
            <a href="/cart" class="text-reset d-block text-center pb-2 pt-3">
                <span class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px" style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                    <i class="las la-shopping-bag la-2x text-white"></i>
                </span>
                <span class="d-block mt-1 fs-10 fw-600 opacity-60 ">
                    <?= tran("Cart") ?>
                    (<span class="cart-count">0</span>)
                </span>
            </a>
        </div>
        <div class="col">
            <a href="/all-notifications" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-inline-block position-relative px-2">
                    <i class="las la-bell fs-20 opacity-60 "></i>
                </span>
                <span class="d-block fs-10 fw-600 opacity-60 "><?= tran("Notifications") ?></span>
            </a>
        </div>
        <div class="col">
            <a href="/users/login" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-block mx-auto">
                    <img src="/public/assets/img/avatar-place.png" class="rounded-circle size-20px">
                </span>
                <span class="d-block fs-10 fw-600 opacity-60"><?= tran("Account") ?></span>
            </a>
        </div>
    </div>
</div>

</div>
<div class="aiz-cookie-alert shadow-xl">
    <div class="p-3 bg-dark rounded">
        <div class="text-white mb-3">
            <b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?= tran("WELCOME TO") ?>&nbsp;<br></b>&nbsp; &nbsp; &nbsp; &nbsp;<a href="https://english.visitseoul.net/index" target="_blank"><b>GMARKET VIET NAM </b><br>&nbsp;</a>
        </div>
        <button class="btn btn-primary aiz-cookie-accept">
            <?= tran("Ok. I Understood") ?>
        </button>
    </div>
</div>
<div class="modal website-popup removable-session d-none" data-key="website-popup" data-value="removed">
    <div class="absolute-full bg-black opacity-60"></div>
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-md">
        <div class="modal-content position-relative border-0 rounded-0 pb-5 pt-4 px-5">
            <div class="aiz-editor-data">
                <div style="text-align: center;"><b style="background-color: rgb(255, 255, 0);">
                        <?= tran("BECOME AN EXCELLENT SALES AGENT OF GMARKET VIET NAM, YOU WILL BE HONORABLE TO VISIT THE LARGEST MERCHANDISE WAREHOUSES IN SEOUL, KOREA") ?></b></div>
                <div style="text-align: center; "><u><b><?= tran("GOOD LUCK TO SALES AGENTS!") ?></b></u></div>
            </div>
            <div class="pt-4">
                <form class="" method="POST" action="/subscribers">
                    <input type="hidden" name="_token" value="aCXlmkGIF8M5mTlqrTsNo6sGJQysBJlDUqOh9JGt">
                    <div class="form-group mb-0">
                        <input type="email" class="form-control" placeholder="Your Email Address" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">
                        <?= tran("Subscribe Now") ?>
                    </button>
                </form>
            </div>
            <button class="absolute-top-right bg-white shadow-lg btn btn-circle btn-icon mr-n3 mt-n3 set-session" data-key="website-popup" data-value="removed" data-toggle="remove-parent" data-parent=".website-popup">
                <i class="la la-close fs-20"></i>
            </button>
        </div>
    </div>
</div>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script>
    function confirm_modal(delete_url) {
        jQuery('#confirm-delete').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel"><?= tran("Confirmation") ?></h4>
            </div>

            <div class="modal-body">
                <p><?= tran("Delete confirmation message") ?></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= tran("Cancel") ?></button>
                <a id="delete_link" class="btn btn-danger btn-ok"><?= tran("Delete") ?></a>
            </div>
        </div>
    </div>
</div>

<script>
    function account_delete_confirm_modal(delete_url) {
        jQuery('#account_delete_confirm').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('account_delete_link').setAttribute('href', delete_url);
    }
</script>

<div class="modal fade" id="account_delete_confirm" tabindex="-1" role="dialog" aria-labelledby="account_delete_confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header d-block py-4">
                <div class="d-flex justify-content-center">
                    <span class="avatar avatar-md mb-2 mt-2">
                        <img src="/public/assets/img/avatar-place.png" class="image rounded-circle m-auto"
                            onerror="this.onerror=null;this.src='/public/assets/img/avatar-place.png';">
                    </span>
                </div>
                <h4 class="modal-title text-center fw-700" id="account_delete_confirmModalLabel" style="color: #ff9819;"><?= tran("Delete Your Account") ?></h4>
                <p class="fs-16 fw-600 text-center" style="color: #8d8d8d;"><?= tran("Warning: You cannot undo this action") ?></p>
            </div>

            <div class="modal-body pt-3 pb-5 px-xl-5">
                <p class="text-danger mt-3"><i><strong>Note:&nbsp;Don&#039;t Click to any button or don&#039;t do any action during account Deletion, it may takes some times.</strong></i></p>
                <p class="fs-14 fw-700" style="color: #8d8d8d;"><?= tran("Deleting Account Means:") ?></p>
                <div class="row bg-soft-warning py-2 mb-2 ml-0 mr-0 border-left border-width-2 border-danger">
                    <div class="col-1">
                        <img src="/public/assets/img/warning.png" class="h-20px">
                    </div>
                    <div class="col">
                        <p class="fw-600 mb-0"><?= tran("If you create any classified ptoducts, after deleting your account, those products will no longer in our system") ?></p>
                    </div>
                </div>
                <div class="row bg-soft-warning py-3 ml-0 mr-0 border-left border-width-2 border-danger">
                    <div class="col-1">
                        <img src="/public/assets/img/warning.png" class="h-20px">
                    </div>
                    <div class="col">
                        <p class="fw-600 mb-0"><?= tran("After deleting your account, wallet balance no longer in our system") ?></p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= tran("Cancel") ?></button>
                <a id="account_delete_link" class="btn btn-danger btn-rounded btn-ok"><?= tran("Delete Account") ?></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addToCart">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="c-preloader text-center p-3">
                <i class="las la-spinner la-spin la-3x"></i>
            </div>
            <button type="button" class="close absolute-top-right btn-icon close z-1" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="la-2x">&times;</span>
            </button>
            <div id="addToCart-modal-body">

            </div>
        </div>
    </div>
</div>

</body>

</html>