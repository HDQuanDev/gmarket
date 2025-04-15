<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb">
    <meta name="app-url" content="//gmarket-quocte.com/">
    <meta name="file-base-url" content="//gmarket-quocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
    <title>Gmarket Viet Nam | Buy Korean domestic products at original prices from the manufacturer</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-core.css">
    <!-- 引入 layui.css -->
    <link rel="stylesheet" href="/public/layui/css/layui.css">

    <style>
        body {
            font-size: 12px;
        }
    </style>
    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Nothing selected',
            nothing_found: 'Nothing found',
            choose_file: 'Choose File',
            file_selected: 'File selected',
            files_selected: 'Files selected',
            add_more_files: 'Add more files',
            adding_more_files: 'Adding more files',
            drop_files_here_paste_or: 'Drop files here, paste or',
            browse: 'Browse',
            upload_complete: 'Upload complete',
            upload_paused: 'Upload paused',
            resume_upload: 'Resume upload',
            pause_upload: 'Pause upload',
            retry_upload: 'Retry upload',
            cancel_upload: 'Cancel upload',
            uploading: 'Uploading',
            processing: 'Processing',
            complete: 'Complete',
            file: 'File',
            files: 'Files',
        }
    </script>

</head>

<body class="">

    <div class="aiz-main-wrapper">
        <?php include("../layout/sidebar.php")?>

        <div class="aiz-content-wrapper">
            <?php include("../layout/topbar.php")?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">


                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h1 class="h3"><?=tran("All products")?></h1>
                            </div>
                            <div class="col text-right">
                                <a href="/admin/products/create" class="btn btn-circle btn-info">
                                    <span><?=tran("Add New Product")?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="card">
                        <form class="" id="sort_products" action="" method="GET">
                            <div class="card-header row gutters-5">
                                <div class="col">
                                    <h5 class="mb-md-0 h6"><?=tran("All products")?></h5>
                                </div>

                                <div class="dropdown mb-2 mb-md-0">
                                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                                        Bulk Action
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" onclick="bulk_delete()"> Delete selection</a>
                                    </div>
                                </div>

                                <div class="col-md-2 ml-auto">
                                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="vip" name="vip" onchange="window.location.href = window.location.pathname + '?vip=' + this.value">
                                        <option value="">Type</option>
                                        <option value="todays_deal">Todays Deal</option>
                                        <option value="featured">Featured</option>
                                        <option value="unpublished">Unpublished</option>
                                    </select>
                                </div>
                                <div class="col-md-2 ml-auto">
                                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="type" id="type" onchange="sort_products()">
                                        <option value="">Sort by</option>
                                        <option value="rating,desc">Rating (High &gt; Low)</option>
                                        <option value="rating,asc">Rating (Low &gt; High)</option>
                                        <option value="num_of_sale,desc">Num of Sale (High &gt; Low)</option>
                                        <option value="num_of_sale,asc">Num of Sale (Low &gt; High)</option>
                                        <option value="unit_price,desc">Base Price (High &gt; Low)</option>
                                        <option value="unit_price,asc">Base Price (Low &gt; High)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Type &amp; Enter">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table aiz-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-all">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th><?=tran("Name")?></th>
                                            <th data-breakpoints="sm"><?=tran("Info")?></th>
                                            <th data-breakpoints="md"><?=tran("Total Stock")?></th>
                                            <th data-breakpoints="lg"><?=tran("Todays Deal")?></th>
                                            <th data-breakpoints="lg"><?=tran("Published")?></th>
                                            <th data-breakpoints="lg"><?=tran("Featured")?></th>
                                            <th data-breakpoints="sm" class="text-right"><?=tran("Options")?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50145">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/PxwcUonvoJaXQZ0UgpPbYKNmDJUsZBnFo4vHDYWT.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">[Inmabel] Golden Toad Painting Feng Shui Interior Frame Ornament Money-Bringing Painting Office Living Room Interior Props Parents Gift</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 36.88$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                1383 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50145" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50145" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50145" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/inmabel-golden-toad-painting-feng-shui-interior-frame-ornament-money-bringing-painting-office-living-room-interior-props-parents-gift-9a44P" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50145/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50145?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50145" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50144">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/NGC19kikhgPOMqTMQtNlPdR6R1CnTSkdpDpQKtAV.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">Nailae Soft Coffin Gel Nail Tips 500p</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 19.05$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                813200 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50144" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50144" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50144" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/nailae-soft-coffin-gel-nail-tips-500p-tnDOG" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50144/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50144?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50144" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50143">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/VPdV1WhcS9VQJouuNMGvd2qKTPomXT5O7D7Rsfn7.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">JTory Christmas Wall Tree Set 50 100 Cherry Bulb Cotton Ball Window Tree Bulb Light Snowflake Sticker Decoration Supplies Remote Control USB Battery Mixed Wall Tree Design</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 27.06$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                812000 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50143" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50143" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50143" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/jtory-christmas-wall-tree-set-50-100-cherry-bulb-cotton-ball-window-tree-bulb-light-snowflake-sticker-decoration-supplies-remote-control-usb-battery-mixed-wall-tree-design-aI0D6" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50143/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50143?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50143" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50142">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://sc04.alicdn.com/kf/Hde3f13f9d10445e5b533a266dccedd67t.jpg" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">Children Duvet Cover Set Printed Bedsheets Hot Sale! Cute from China Cotton Manufacturer Produced All Size Woven 100% Cotton41212</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 35.00$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                666 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50142" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50142" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50142" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/-frRhO-38JHr-QxjE8" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50142/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50142?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50142" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50141">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://sc04.alicdn.com/kf/Hd8e1c5970d4c4d62a26f4a0c5a1390ceN.jpg" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">Rc Car On Road Racing Drift Remote Control Car Electric Power Toys High Speed Hobby Lipo Vehicle41225</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 85.00$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                654 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50141" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50141" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50141" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/-a8Gxx-6aE4n-panRp" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50141/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50141?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50141" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50140">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://sc04.alicdn.com/kf/H3314471bc3f743c5b5d6dc9493ba58b5v.jpg" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">China Factory Pickup Truck RC Car Climbing Car HG-P407-White-4 1:10 Scale 2.4G 4WD Pickup Truck41229</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 161.00$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                621 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50140" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50140" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50140" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/-3wgx4-2df2I-LTxfM" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50140/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50140?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50140" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50139">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/zNFg5iTXEeJC1Ate2hvBVIBz1Kum5BJHs1bKLlGj.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">ANYOU Beautiful Special Gel Nail 35-piece Set for Beginners and Professionals</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 42.06$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                812000 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50139" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50139" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50139" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/anyou-beautiful-special-gel-nail-35-piece-set-for-beginners-and-professionals-fu1Dh" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50139/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50139?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50139" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50138">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/7cLbzE7LvA1agcnvDU0Y3jinXudpFPxRW0tIJRzY.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">JENIJEL SPECIAL HONEY SET NAIL SET</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 42.00$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                91200 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50138" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50138" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50138" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/jenijel-special-honey-set-nail-set-BjDsM" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50138/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50138?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50138" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50137">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/iBBvQ4fM822gNuNzOD4gKZzmXnk1to19X5bCHrst.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">yinikiz 30ml poly gel set extension builder gel self nail extension parts, S27909, 1 piece</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 39.08$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                8132000 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50137" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50137" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50137" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/yinikiz-30ml-poly-gel-set-extension-builder-gel-self-nail-extension-parts-s27909-1-piece-cEJIc" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50137/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50137?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50137" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50136">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/QlMqi2E8QBQWZWzV1SbD9uFnWNhedWMGsvPaXWsT.jpg" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">Wallson manufacturer D498 searchlight rechargeable light portable outdoor long-range xenon household super bright and strong</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 14.08$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                516 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50136" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50136" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50136" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/wallson-manufacturer-d498-searchlight-rechargeable-light-portable-outdoor-long-range-xenon-household-super-bright-and-strong-AnlJO-B4wjr" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50136/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50136?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50136" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50135">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/o97ht8567bkhy1Voy1U78oqMmFvDLQ6gUrEf1siZ.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">Eyebit SM Ecolab Nail Drill Bit Set 02, Mixed Colors, 1 Set</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 7.08$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                912000 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50135" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50135" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50135" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/eyebit-sm-ecolab-nail-drill-bit-set-02-mixed-colors-1-set-TpcZr" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50135/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50135?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50135" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50134">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/W0CAKLzwtTr1wPm0iw85BGbLThlqwd9NXY5JloVi.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">Isolate Plus 2 WPH Gainer Health Supplement</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 37.80$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                66333 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50134" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50134" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50134" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/isolate-plus-2-wph-gainer-health-supplement-83q4H" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50134/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50134?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50134" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50133">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/MDF9xIiSOdURCNvVOudHorle8kOsfSNpzJlKFBUz.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">Makebody Geraway Protein Gera Gainer Gera Mass Health Protein Supplement</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 36.33$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                76567 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50133" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50133" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50133" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/makebody-geraway-protein-gera-gainer-gera-mass-health-protein-supplement-3-EZlk4" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50133/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50133?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50133" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50132">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/aSatZ2yQtQ5DJKXRq9mS2s1cayvdJ7Qe81vWjwaw.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">[Balenciaga] 23SS Men&#039;s Speed ​​Runner Sneakers (645056 W2DBP 1013 23S)</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 205.07$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                64881 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50132" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50132" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50132" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/balenciaga-23ss-mens-speed-runner-sneakers-645056-w2dbp-1013-23s-R3Dic" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50132/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50132?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50132" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="50131">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="https://gmarket-quocte.com/public/uploads/all/i1fpmQIHV8igBRKnjlcx3iAVa5PnaNlHvSLsLL6O.png" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2">Otas Ugly Sneakers</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Num of Sale:</strong> 0 Times </br>
                                                <strong>Base Price:</strong> 22.10$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td>
                                                81553 </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="50131" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="50131" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="50131" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/otas-ugly-sneakers-gfFE1" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/admin/50131/edit?lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/duplicate/50131?type=In%20House" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/50131" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="aiz-pagination">
                                    <nav>
                                        <ul class="pagination">

                                            <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            </li>





                                            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=2">2</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=3">3</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=4">4</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=5">5</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=6">6</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=7">7</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=8">8</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=9">9</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=10">10</a></li>

                                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>





                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=401">401</a></li>
                                            <li class="page-item"><a class="page-link" href="/admin/products/in_house_products.php?page=402">402</a></li>


                                            <li class="page-item">
                                                <a class="page-link" href="/admin/products/in_house_products.php?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
                                            </li>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0"></p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <!-- delete Modal -->
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">Are you sure to delete this?</p>
                    <button type="button" class="btn btn-link mt-2" data-dismiss="modal">Cancel</button>
                    <a href="" id="delete-link" class="btn btn-primary mt-2">Delete</a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->


    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/products/todays_deal', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Todays Deal updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/products/published', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Published products updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var approved = 1;
            } else {
                var approved = 0;
            }
            $.post('/admin/products/approved', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                id: el.value,
                approved: approved
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Product approval update successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/products/featured', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Featured products updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        function sort_products(el) {
            $('#sort_products').submit();
        }

        function bulk_delete() {
            var data = new FormData($('#sort_products')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/bulk-product-delete",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>

    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
                        _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                        locale: locale
                    }, function(data) {
                        location.reload();
                    });

                });
            });
        }

        function menuSearch() {
            var filter, item;
            filter = $("#menu-search").val().toUpperCase();
            items = $("#main-menu").find("a");
            items = items.filter(function(i, item) {
                if ($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item).attr('href') !== '#') {
                    return item;
                }
            });

            if (filter !== '') {
                $("#main-menu").addClass('d-none');
                $("#search-menu").html('')
                if (items.length > 0) {
                    for (i = 0; i < items.length; i++) {
                        const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;
                        const link = $(items[i]).attr('href');
                        $("#search-menu").append(`<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`);
                    }
                } else {
                    $("#search-menu").html(`<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">Nothing found</span></li>`);
                }
            } else {
                $("#main-menu").removeClass('d-none');
                $("#search-menu").html('')
            }
        }
    </script>

</body>

</html>