<?php if(!file_exists("../layout/translate.php"))include_once("../../layout/translate.php");else include_once("../layout/translate.php");?>
<div class="aiz-topbar px-15px px-lg-25px d-flex align-items-stretch justify-content-between">
    <div class="d-flex">
        <div class="aiz-topbar-nav-toggler d-flex align-items-center justify-content-start mr-2 mr-md-3 ml-0" data-toggle="aiz-mobile-nav">
            <button class="aiz-mobile-toggler">
                <span></span>
            </button>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1">
        <div class="d-flex justify-content-around align-items-center align-items-stretch">
            <div class="d-flex justify-content-around align-items-center align-items-stretch">
                <div class="aiz-topbar-item">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-icon btn-circle btn-light" href="" target="_blank" title="Browse Website">
                            <i class="las la-globe"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around align-items-center align-items-stretch ml-3">
                <div class="aiz-topbar-item">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-icon btn-circle btn-light" href="/admin/pos" target="_blank" title="POS">
                            <i class="las la-print"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around align-items-center align-items-stretch ml-3">
                <div class="aiz-topbar-item">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-soft-danger btn-sm d-flex align-items-center" href="/admin/clear-cache">
                            <i class="las la-hdd fs-20"></i>
                            <span class="fw-500 ml-1 mr-0 d-none d-md-block"><?=tran("Clear Cache")?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around align-items-center align-items-stretch" >

            <!-- thông báo  -->
            <div class="aiz-topbar-item ml-2" style="display:none ">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon p-0 d-flex justify-content-center align-items-center">
                            <span class="d-flex align-items-center position-relative">
                                <i class="las la-bell fs-24"></i>
                                <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right"></span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0" >
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="mb-0">Notifications</h6>
                        </div>
                        <div class="px-3 c-scrollbar-light overflow-auto " style="max-height:300px;display:none">
                            <ul class="list-group list-group-flush">
                                
                                
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20241010-11342962 has been Placed
                                            </p>
                                            <small class="text-muted">
                                                October 10 2024, 11:34 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240922-22000283 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:26 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240922-22292488 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:26 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240922-16142080 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:26 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240922-16100927 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:25 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240922-05143150 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:25 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240921-04571475 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:25 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240921-04552875 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:25 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240921-03053624 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:25 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240920-23583432 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:25 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240920-23033215 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:25 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240920-22593843 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:24 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240920-21373722 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:24 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240920-08571477 has been Delivered
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:24 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240922-16142080 has been On the way
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:24 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240922-16142080 Has been Paid
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:24 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                    <div class="media text-inherit">
                                        <div class="media-body">
                                            <p class="mb-1 text-truncate-2">
                                                Order code: 20240922-16100927 has been On the way
                                            </p>
                                            <small class="text-muted">
                                                September 24 2024, 12:24 am
                                            </small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center border-top">
                            <a href="/admin/all-notification" class="text-reset d-block py-2">
                                View All Notifications
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown " id="lang-change">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon">
                            <?php if($_SESSION['country']=='en'){?>
                            <img src="/public/assets/img/flags/en.png" height="11">
                            <?php }else if($_SESSION['country']=='vi'){?>
                            <img src="/public/assets/img/flags/vn.png" height="11">
                            <?php }else if($_SESSION['country']=='ko'){?>
                            <img src="/public/assets/img/flags/kr.png" height="11">
                            <?php }else if($_SESSION['country']=='ja'){?>
                            <img src="/public/assets/img/flags/jp.png" height="11">
                            <?php }?>





                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-xs">

                        <li>
                            <a href="javascript:void(0)" data-flag="en" class="dropdown-item  <?=$_SESSION['country']=='en'?"active":""?> ">
                                <img src="/public/assets/img/flags/en.png" class="mr-2">
                                <span class="language">English</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="javascript:void(0)" data-flag="kr" class="dropdown-item <?=$_SESSION['country']=='ko'?"active":""?> ">
                                <img src="/public/assets/img/flags/kr.png" class="mr-2">
                                <span class="language">Korea</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-flag="jp" class="dropdown-item <?=$_SESSION['country']=='ja'?"active":""?> ">
                                <img src="/public/assets/img/flags/jp.png" class="mr-2">
                                <span class="language">Japan</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="javascript:void(0)" data-flag="vn" class="dropdown-item <?=$_SESSION['country']=='vi'?"active":""?> ">
                                <img src="/public/assets/img/flags/vn.png" class="mr-2">
                                <span class="language">Vietnam</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="aiz-topbar-item ml-2" >
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="avatar avatar-sm mr-md-2">
                                <img
                                    src="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg"
                                    onerror="this.onerror=null;this.src='/public/assets/img/avatar-place.png';">
                            </span>
                            <span class="d-none d-md-block">
                                <span class="d-block fw-500">Admin</span>
                                <span class="d-block small opacity-60">admin</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                        <a href="/admin/profile" class="dropdown-item">
                            <i class="las la-user-circle"></i>
                            <span><?=tran("Profile")?></span>
                        </a>

                        <a href="/logout" class="dropdown-item">
                            <i class="las la-sign-out-alt"></i>
                            <span><?=tran("Logout")?></span>
                        </a>
                    </div>
                </div>
            </div><!-- .aiz-topbar-item -->
        </div>
    </div>
</div><!-- .aiz-topbar -->