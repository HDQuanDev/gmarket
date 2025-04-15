<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">
    <title>Takashimaya | Buy Korean domestic products at original prices from the manufacturer</title>

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
    <?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $product = fetch_array("SELECT * FROM products_admin WHERE id='$id' LIMIT 1");
       
        if(!$product) {
            header("Location: /admin/products/all.php?status=error&message=Product not found");
            exit;
        }
    } else {
        header("Location: /admin/products/all.php?status=error&message=Invalid brand ID");
        exit;
    }
    ?>
    <div class="aiz-main-content">
        <div class="px-15px px-lg-25px">
            <div class="aiz-titlebar text-left mt-2 mb-3">
                <h5 class="mb-0 h6"><?=tran("Edit Product")?></h5>
            </div>
            <div class="">
                <form class="form form-horizontal mar-top" action="/admin/products/update.php" method="POST" enctype="multipart/form-data" id="choice_form">
                    <div class="row gutters-5">
                        <div class="col-lg-8">
                            <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                            <input type="hidden" name="added_by" value="admin">
                            <input type="hidden" name="id" value="<?=$product['id']?>">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Product Information")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Product Name")?> <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" value="<?=$product['name']?>" class="form-control" name="name" placeholder="Product Name" onchange="update_sku()" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Thumbnail Image")?> <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="file" name="thumbnail_image" class="form-control" accept="image/*">
                                            <small class="text-muted"><?=tran("Select one image for the thumbnail.")?></small>
                                            <?php if (!empty($product['thumbnail_image'])): ?>
                                                <div class="mt-2">
                                                    <img src="/public/uploads/all/<?=$product['thumbnail_image']?>" alt="Thumbnail" style="max-width: 100px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Gallery Images")?></label>
                                        <div class="col-md-8">
                                            <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                                            <small class="text-muted"><?=tran("Select multiple images for the gallery.")?></small>
                                            <?php
                                            if (!empty($product['gallery_images'])) {
                                                $gallery_images = json_decode($product['gallery_images'], true) ?? explode(',', $product['gallery_images']);
                                                echo '<div class="mt-2">';
                                                foreach ($gallery_images as $image) {
                                                    echo "<img src='/public/uploads/all/$image' alt='Gallery Image' style='max-width: 100px; margin-right: 5px;'>";
                                                }
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="category">
                                        <label class="col-md-3 col-from-label"><?=tran("Category")?> <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT * FROM categories");
                                                while ($row = fetch_assoc($sql)) {
                                                    $selected = ($row['id'] == $product['category_id']) ? 'selected' : '';
                                                    echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="brand">
                                        <label class="col-md-3 col-from-label"><?=tran("Brand")?></label>
                                        <div class="col-md-8">
                                            <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">
                                                <option value=""><?=tran("Select Brand")?></option>
                                                <?php 
                                                $sql = mysqli_query($conn, "SELECT * FROM brands");
                                                while ($row = fetch_assoc($sql)) {
                                                    $selected = ($row['id'] == $product['brand_id']) ? 'selected' : '';
                                                    echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Unit")?></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="unit" value="<?=$product['unit']?>" placeholder="Unit (e.g. KG, Pc etc)" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Weight")?> <small>(In Kg)</small></label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" name="weight" step="0.01" value="<?=$product['weight']?>" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Minimum Purchase Qty")?> <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="number" lang="en" class="form-control" name="min_qty" value="<?=$product['minimum_quantity']?>" min="1" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Tags")?> <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control aiz-tag-input" name="tags[]" value="<?=$product['tags']?>" placeholder="Type and hit enter to add a tag">
                                            <small class="text-muted"><?=tran("This is used for search. Input those words by which cutomer can find this product.")?></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Barcode")?></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="barcode" value="<?=$product['barcode']?>" placeholder="Barcode">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Product Videos")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Video Provider")?></label>
                                        <div class="col-md-8">
                                            <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">
                                                <option value="youtube" <?=$product['video_provider'] == 'youtube' ? 'selected' : ''?>>Youtube</option>
                                                <option value="dailymotion" <?=$product['video_provider'] == 'dailymotion' ? 'selected' : ''?>>Dailymotion</option>
                                                <option value="vimeo" <?=$product['video_provider'] == 'vimeo' ? 'selected' : ''?>>Vimeo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Video Link")?></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="video_link" value="<?=$product['video_link']?>" placeholder="Video Link">
                                            <small class="text-muted"><?=tran("Use proper link without extra parameter. Don't use short share link/embeded iframe code.")?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Product Variation")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row gutters-5">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" value="Colors" disabled>
                                        </div>
                                        <div class="col-md-8">
                                            <select class="form-control aiz-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple disabled>
                                                <!-- Giữ nguyên danh sách màu -->
                                                <option value="#F0F8FF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0F8FF'></span><span>AliceBlue</span></span>"></option>
                                                <!-- Thêm các màu khác tương tự -->
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input value="1" type="checkbox" name="colors_active" <?=isset($product['colors_active']) && $product['colors_active'] == 1 ? 'checked' : ''?>>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row gutters-5">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" value="Attributes" disabled>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="choice_attributes[]" id="choice_attributes" class="form-control aiz-selectpicker" data-selected-text-format="count" data-live-search="true" multiple data-placeholder="Choose Attributes">
                                                <option value="1" <?=in_array(1, json_decode($product['choice_attributes'] ?? '[]', true)) ? 'selected' : ''?>><?=tran("Size")?></option>
                                                <option value="3" <?=in_array(3, json_decode($product['choice_attributes'] ?? '[]', true)) ? 'selected' : ''?>><?=tran("Weight")?></option>
                                                <option value="4" <?=in_array(4, json_decode($product['choice_attributes'] ?? '[]', true)) ? 'selected' : ''?>><?=tran("Variation")?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Choose the attributes of this product and then input values of each attribute</p>
                                        <br>
                                    </div>
                                    <div class="customer_choice_options" id="customer_choice_options"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Product price + stock</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Unit price <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input type="number" lang="en" min="0" value="<?=$product['unit_price']?>" step="0.01" placeholder="Unit price" name="unit_price" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label" for="start_date">Discount Date Range</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control aiz-date-range" name="date_range" value="<?=$product['discount_date_range']?>" placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Discount <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input type="number" lang="en" min="0" value="<?=$product['discount']?>" step="0.01" placeholder="Discount" name="discount" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control aiz-selectpicker" name="discount_type">
                                                <option value="amount" <?= isset($product['discount_type']) && $product['discount_type'] == 'amount' ? 'selected' : ''?>>Flat</option>
                                                <option value="percent" <?=isset($product['discount_type']) && $product['discount_type'] == 'percent' ? 'selected' : ''?>>Percent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="show-hide-div">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Quantity")?> <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <input type="number" lang="en" min="0" value="<?=$product['quantity']?>" step="1" placeholder="<?=tran("Quantity")?>" name="current_stock" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label">SKU</label>
                                            <div class="col-md-6">
                                                <input type="text" placeholder="SKU" name="sku" value="<?=$product['sku']?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">External link</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="External link" name="external_link" value="<?=$product['external_link']?>" class="form-control">
                                            <small class="text-muted">Leave it blank if you do not use external site link</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">External link button text</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="External link button text" name="external_link_btn" value="<?=$product['external_link_button_text']?>" class="form-control">
                                            <small class="text-muted">Leave it blank if you do not use external site link</small>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="sku_combination" id="sku_combination"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Product Description")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Description")?></label>
                                        <div class="col-md-8">
                                            <textarea class="aiz-text-editor" name="description"><?=$product['description']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">PDF Specification</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="signinSrEmail">PDF Specification</label>
                                        <div class="col-md-8">
                                            <div class="input-group" data-toggle="aizuploader" data-type="document">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <input type="hidden" name="pdf" value="<?=isset($product['pdf']) && $product['pdf']?>" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
                                                <?php if (!empty($product['pdf'])): ?>
                                                    <a href="/uploads/<?=$product['pdf']?>" target="_blank">View PDF</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">SEO Meta Tags</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label">Meta Title</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="meta_title" value="<?=$product['meta_title']?>" placeholder="Meta Title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-from-label"><?=tran("Description")?></label>
                                        <div class="col-md-8">
                                            <textarea name="meta_description" rows="8" class="form-control"><?=$product['meta_description']?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="signinSrEmail">Meta Image</label>
                                        <div class="col-md-8">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <input type="hidden" name="meta_img" value="<?=isset($product['meta_img']) && $product['meta_img']?>" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
                                                <?php if (!empty($product['meta_img'])): ?>
                                                    <img src="/uploads/<?=$product['meta_img']?>" alt="Meta Image" style="max-width: 100px;">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Shipping Configuration")?></h5>
                                </div>
                                <div class="card-body">
                                    <p><?=tran("Shipping ConfigurationProduct wise shipping cost is disable. Shipping cost is configured from here")?>
                                        <a href="/admin/shipping_configuration" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text"><?=tran("Shipping Configuration")?></span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Low Stock Quantity Warning")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name"><?=tran("Quantity")?></label>
                                        <input type="number" name="low_stock_quantity" value="<?=$product['low_stock_quantity'] ?? 1?>" min="0" step="1" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Stock Visibility State")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label"><?=tran("Show Stock Quantity")?></label>
                                        <div class="col-md-6">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                               <input type="checkbox" name="cash_on_delivery" value="1" <?= isset($product['cash_on_delivery']) && $product['cash_on_delivery'] ? 'checked' : '' ?>>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label"><?=tran("Show Stock With Text Only")?></label>
                                        <div class="col-md-6">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="radio" name="stock_visibility_state" value="text" <?=isset($product['stock_visibility_state']) &&$product['stock_visibility_state'] == 'text' ? 'checked' : ''?>>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label"><?=tran("Hide Stock")?></label>
                                        <div class="col-md-6">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="radio" name="stock_visibility_state" value="hide" <?=isset($product['stock_visibility_state']) && $product['stock_visibility_state'] == 'hide' ? 'checked' : ''?>>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Cash on Delivery")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label"><?=tran("Status")?></label>
                                        <div class="col-md-6">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" name="cash_on_delivery" value="1" <?=isset($product['cash_on_delivery']) && $product['cash_on_delivery'] == 1 ? 'checked' : ''?>>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Featured")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label"><?=tran("Status")?></label>
                                        <div class="col-md-6">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" name="featured" value="1" <?=isset($product['featured']) && $product['featured'] == 1 ? 'checked' : ''?>>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Todays Deal")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-6 col-from-label"><?=tran("Status")?></label>
                                        <div class="col-md-6">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" name="todays_deal" value="1" <?=isset($product['todays_deal']) && $product['todays_deal'] == 1 ? 'checked' : ''?>>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Flash Deal")?></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Add To Flash</label>
                                        <select class="form-control aiz-selectpicker" name="flash_deal_id" id="flash_deal">
                                            <option value="">Choose Flash Title</option>
                                            <option value="1" <?=isset($product['flash_deal_id']) && $product['flash_deal_id'] == 1 ? 'selected' : ''?>>Flash Sale</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Discount</label>
                                        <input type="number" name="flash_discount" value="<?=$product['flash_discount'] ?? 0?>" min="0" step="0.01" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Discount Type</label>
                                        <select class="form-control aiz-selectpicker" name="flash_discount_type" id="flash_discount_type">
                                            <option value="">Choose Discount Type</option>
                                            <option value="amount" <?=$product['flash_discount_type'] == 'amount' ? 'selected' : ''?>>Flat</option>
                                            <option value="percent" <?=$product['flash_discount_type'] == 'percent' ? 'selected' : ''?>>Percent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Estimate Shipping Time</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="name">Shipping Days</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="est_shipping_days" value="<?=isset($product['est_shipping_days']) && $product['est_shipping_days']?>" min="1" step="1" placeholder="Shipping Days">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend">Days</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Vat & TAX</h5>
                                </div>
                                <div class="card-body">
                                    <label for="name">Profit<input type="hidden" value="3" name="tax_id[]"></label>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="number" lang="en" min="0" value="<?=$product['tax'][0] ?? 0?>" step="0.01" placeholder="Tax" name="tax[]" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control aiz-selectpicker" name="tax_type[]">
                                                <option value="amount" <?=isset($product['tax_type']) && $product['tax_type'][0] == 'amount' ? 'selected' : ''?>>Flat</option>
                                                <option value="percent" <?= isset($product['tax_type']) && $product['tax_type'][0] == 'percent' ? 'selected' : ''?>>Percent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="name">Hoa hồng<input type="hidden" value="4" name="tax_id[]"></label>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="number" lang="en" min="0" value="<?=$product['tax'][1] ?? 0?>" step="0.01" placeholder="Tax" name="tax[]" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control aiz-selectpicker" name="tax_type[]">
                                                <option value="amount" <?=isset($product['tax_type']) && $product['tax_type'][1] == 'amount' ? 'selected' : ''?>>Flat</option>
                                                <option value="percent" <?=isset($product['tax_type']) && $product['tax_type'][1] == 'percent' ? 'selected' : ''?>>Percent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group mr-2" role="group" aria-label="Third group">
                                    <button type="submit" name="button" value="unpublish" class="btn btn-primary action-btn"><?=tran("Save & Unpublish")?></button>
                                </div>
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <button type="submit" name="button" value="publish" class="btn btn-success action-btn"><?=tran("Save & Publish")?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
            <p class="mb-0">© Takashimaya v7.4.0</p>
        </div>
    </div><!-- .aiz-main-content -->
</div><!-- .aiz-content-wrapper -->


    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>



    <script type="text/javascript">
        $('form').bind('submit', function(e) {
            if ($(".action-btn").attr('attempted') == 'true') {
                //stop submitting the form because we have already clicked submit.
                e.preventDefault();
            } else {
                $(".action-btn").attr("attempted", 'true');
            }
            // Disable the submit button while evaluating if the form should be submitted
            // $("button[type='submit']").prop('disabled', true);

            // var valid = true;

            // if (!valid) {
            // e.preventDefault();

            ////Reactivate the button if the form was not submitted
            // $("button[type='submit']").button.prop('disabled', false);
            // }
        });

        $("[name=shipping_type]").on("change", function() {
            $(".flat_rate_shipping_div").hide();

            if ($(this).val() == 'flat_rate') {
                $(".flat_rate_shipping_div").show();
            }

        });

        function add_more_customer_choice_option(i, name) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/admin/products/add-more-choice-option',
                data: {
                    attribute_id: i
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    $('#customer_choice_options').append('\
                <div class="form-group row">\
                    <div class="col-md-3">\
                        <input type="hidden" name="choice_no[]" value="' + i + '">\
                        <input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="Choice Title" readonly>\
                    </div>\
                    <div class="col-md-8">\
                        <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_' + i + '[]" multiple>\
                            ' + obj + '\
                        </select>\
                    </div>\
                </div>');
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            });


        }

        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors').prop('disabled', true);
                AIZ.plugins.bootstrapSelect('refresh');
            } else {
                $('#colors').prop('disabled', false);
                AIZ.plugins.bootstrapSelect('refresh');
            }
            update_sku();
        });

        $(document).on("change", ".attribute_choice", function() {
            update_sku();
        });

        $('#colors').on('change', function() {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function() {
            update_sku();
        });

        $('input[name="name"]').on('keyup', function() {
            update_sku();
        });

        function delete_row(em) {
            $(em).closest('.form-group row').remove();
            update_sku();
        }

        function delete_variant(em) {
            $(em).closest('.variant').remove();
        }

        function update_sku() {
            $.ajax({
                type: "POST",
                url: '/admin/products/sku_combination',
                data: $('#choice_form').serialize(),
                success: function(data) {
                    $('#sku_combination').html(data);
                    AIZ.uploader.previewGenerate();
                    AIZ.plugins.fooTable();
                    if (data.length > 1) {
                        $('#show-hide-div').hide();
                    } else {
                        $('#show-hide-div').show();
                    }
                }
            });
        }

        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function() {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });

            update_sku();
        });
    </script>


    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
                        _token: 'yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP',
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