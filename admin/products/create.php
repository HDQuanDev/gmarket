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
    <title>GMARKETVN | Buy Korean domestic products at original prices from the manufacturer</title>

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
                        <h5 class="mb-0 h6"><?=tran("Add New Product")?></h5>
                    </div>
                    <div class="">
                        <!-- Error Meassages -->
                        <form class="form form-horizontal mar-top" action="/admin/products/store.php" method="POST" enctype="multipart/form-data" id="choice_form">
                            <div class="row gutters-5">
                                <div class="col-lg-8">
                                    <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP"> <input type="hidden" name="added_by" value="admin">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6"><?=tran("Product Information")?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label"><?=tran("Product Name")?> <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="name" placeholder="Product Name" onchange="update_sku()" required>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="category">
                                                <label class="col-md-3 col-from-label"><?=tran("Category")?> <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                                        <?php
                                                        $sql=mysqli_query($conn,"SELECT * FROM categories");
                                                        while($row=fetch_assoc($sql)){
                                                        ?>
                                                        <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                                        <?php }?>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="brand">
                                                <label class="col-md-3 col-from-label"><?=tran("Brand")?></label>
                                                <div class="col-md-8">
                                                    <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">
                                                        <option value=""><?=tran("Select Brand")?></option>
                                                        <?php 
                                                        $sql=mysqli_query($conn,"SELECT * FROM brands ");
                                                        while($row=fetch_assoc($sql)){
                                                        ?>
                                                        <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                                        <?php }?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label"><?=tran("Unit")?></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="unit" placeholder="Unit (e.g. KG, Pc etc)" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label"><?=tran("Weight")?> <small>(In Kg)</small></label>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" name="weight" step="0.01" value="0.00" placeholder="0.00">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label"><?=tran("Minimum Purchase Qty")?> <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="number" lang="en" class="form-control" name="min_qty" value="1" min="1" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label"><?=tran("Tags")?> <span class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control aiz-tag-input" name="tags[]" placeholder="Type and hit enter to add a tag">
                                                    <small class="text-muted"><?=tran("This is used for search. Input those words by which cutomer can find this product.")?></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label"><?=tran("Barcode")?></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="barcode" placeholder="Barcode">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6"><?=tran("Product Images")?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="signinSrEmail"><?=tran("Gallery Images")?> <small>(600x600)</small></label>
                                                <div class="col-md-8">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?=tran("Browse")?></div>
                                                        </div>
                                                        <div class="form-control file-amount"><?=tran("Choose File")?></div>
                                                        <input type="hidden" name="photos" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                    <small class="text-muted"><?=tran("These images are visible in product details page gallery. Use 600x600 sizes images.")?></small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="signinSrEmail"><?=tran("Thumbnail Image")?> <small>(300x300)</small></label>
                                                <div class="col-md-8">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?=tran("Browse")?></div>
                                                        </div>
                                                        <div class="form-control file-amount"><?=tran("Choose File")?></div>
                                                        <input type="hidden" name="thumbnail_img" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                    <small class="text-muted"><?=tran("This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.")?></small>
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
                                                        <option value="youtube">Youtube</option>
                                                        <option value="dailymotion">Dailymotion</option>
                                                        <option value="vimeo">Vimeo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label"><?=tran("Video Link")?></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="video_link" placeholder="Video Link">
                                                    <small class="text-muted"><?=tran("Use proper link without extra parameter. Don&#039;t use short share link/embeded iframe code.")?></small>
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
                                                        <option value="#F0F8FF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0F8FF'></span><span>AliceBlue</span></span>"></option>
                                                        <option value="#9966CC" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9966CC'></span><span>Amethyst</span></span>"></option>
                                                        <option value="#FAEBD7" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FAEBD7'></span><span>AntiqueWhite</span></span>"></option>
                                                        <option value="#00FFFF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FFFF'></span><span>Aqua</span></span>"></option>
                                                        <option value="#7FFFD4" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7FFFD4'></span><span>Aquamarine</span></span>"></option>
                                                        <option value="#F0FFFF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0FFFF'></span><span>Azure</span></span>"></option>
                                                        <option value="#F5F5DC" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F5F5DC'></span><span>Beige</span></span>"></option>
                                                        <option value="#FFE4C4" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFE4C4'></span><span>Bisque</span></span>"></option>
                                                        <option value="#000000" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#000000'></span><span>Black</span></span>"></option>
                                                        <option value="#FFEBCD" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFEBCD'></span><span>BlanchedAlmond</span></span>"></option>
                                                        <option value="#0000FF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#0000FF'></span><span>Blue</span></span>"></option>
                                                        <option value="#8A2BE2" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8A2BE2'></span><span>BlueViolet</span></span>"></option>
                                                        <option value="#A52A2A" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#A52A2A'></span><span>Brown</span></span>"></option>
                                                        <option value="#DEB887" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DEB887'></span><span>BurlyWood</span></span>"></option>
                                                        <option value="#5F9EA0" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#5F9EA0'></span><span>CadetBlue</span></span>"></option>
                                                        <option value="#7FFF00" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7FFF00'></span><span>Chartreuse</span></span>"></option>
                                                        <option value="#D2691E" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#D2691E'></span><span>Chocolate</span></span>"></option>
                                                        <option value="#FF7F50" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF7F50'></span><span>Coral</span></span>"></option>
                                                        <option value="#6495ED" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#6495ED'></span><span>CornflowerBlue</span></span>"></option>
                                                        <option value="#FFF8DC" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFF8DC'></span><span>Cornsilk</span></span>"></option>
                                                        <option value="#DC143C" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DC143C'></span><span>Crimson</span></span>"></option>
                                                        <option value="#00FFFF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FFFF'></span><span>Cyan</span></span>"></option>
                                                        <option value="#00008B" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00008B'></span><span>DarkBlue</span></span>"></option>
                                                        <option value="#008B8B" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#008B8B'></span><span>DarkCyan</span></span>"></option>
                                                        <option value="#B8860B" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#B8860B'></span><span>DarkGoldenrod</span></span>"></option>
                                                        <option value="#A9A9A9" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#A9A9A9'></span><span>DarkGray</span></span>"></option>
                                                        <option value="#006400" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#006400'></span><span>DarkGreen</span></span>"></option>
                                                        <option value="#BDB76B" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#BDB76B'></span><span>DarkKhaki</span></span>"></option>
                                                        <option value="#8B008B" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8B008B'></span><span>DarkMagenta</span></span>"></option>
                                                        <option value="#556B2F" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#556B2F'></span><span>DarkOliveGreen</span></span>"></option>
                                                        <option value="#FF8C00" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF8C00'></span><span>DarkOrange</span></span>"></option>
                                                        <option value="#9932CC" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9932CC'></span><span>DarkOrchid</span></span>"></option>
                                                        <option value="#8B0000" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8B0000'></span><span>DarkRed</span></span>"></option>
                                                        <option value="#E9967A" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#E9967A'></span><span>DarkSalmon</span></span>"></option>
                                                        <option value="#8FBC8F" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8FBC8F'></span><span>DarkSeaGreen</span></span>"></option>
                                                        <option value="#483D8B" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#483D8B'></span><span>DarkSlateBlue</span></span>"></option>
                                                        <option value="#2F4F4F" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#2F4F4F'></span><span>DarkSlateGray</span></span>"></option>
                                                        <option value="#00CED1" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00CED1'></span><span>DarkTurquoise</span></span>"></option>
                                                        <option value="#9400D3" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9400D3'></span><span>DarkViolet</span></span>"></option>
                                                        <option value="#FF1493" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF1493'></span><span>DeepPink</span></span>"></option>
                                                        <option value="#00BFFF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00BFFF'></span><span>DeepSkyBlue</span></span>"></option>
                                                        <option value="#696969" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#696969'></span><span>DimGray</span></span>"></option>
                                                        <option value="#1E90FF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#1E90FF'></span><span>DodgerBlue</span></span>"></option>
                                                        <option value="#B22222" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#B22222'></span><span>FireBrick</span></span>"></option>
                                                        <option value="#FFFAF0" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFAF0'></span><span>FloralWhite</span></span>"></option>
                                                        <option value="#228B22" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#228B22'></span><span>ForestGreen</span></span>"></option>
                                                        <option value="#FF00FF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF00FF'></span><span>Fuchsia</span></span>"></option>
                                                        <option value="#DCDCDC" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DCDCDC'></span><span>Gainsboro</span></span>"></option>
                                                        <option value="#F8F8FF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F8F8FF'></span><span>GhostWhite</span></span>"></option>
                                                        <option value="#FFD700" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFD700'></span><span>Gold</span></span>"></option>
                                                        <option value="#DAA520" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DAA520'></span><span>Goldenrod</span></span>"></option>
                                                        <option value="#808080" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#808080'></span><span>Gray</span></span>"></option>
                                                        <option value="#008000" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#008000'></span><span>Green</span></span>"></option>
                                                        <option value="#ADFF2F" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#ADFF2F'></span><span>GreenYellow</span></span>"></option>
                                                        <option value="#F0FFF0" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0FFF0'></span><span>Honeydew</span></span>"></option>
                                                        <option value="#FF69B4" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF69B4'></span><span>HotPink</span></span>"></option>
                                                        <option value="#CD5C5C" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#CD5C5C'></span><span>IndianRed</span></span>"></option>
                                                        <option value="#4B0082" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#4B0082'></span><span>Indigo</span></span>"></option>
                                                        <option value="#FFFFF0" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFFF0'></span><span>Ivory</span></span>"></option>
                                                        <option value="#F0E68C" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0E68C'></span><span>Khaki</span></span>"></option>
                                                        <option value="#E6E6FA" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#E6E6FA'></span><span>Lavender</span></span>"></option>
                                                        <option value="#FFF0F5" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFF0F5'></span><span>LavenderBlush</span></span>"></option>
                                                        <option value="#7CFC00" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7CFC00'></span><span>LawnGreen</span></span>"></option>
                                                        <option value="#FFFACD" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFACD'></span><span>LemonChiffon</span></span>"></option>
                                                        <option value="#ADD8E6" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#ADD8E6'></span><span>LightBlue</span></span>"></option>
                                                        <option value="#F08080" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F08080'></span><span>LightCoral</span></span>"></option>
                                                        <option value="#E0FFFF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#E0FFFF'></span><span>LightCyan</span></span>"></option>
                                                        <option value="#FAFAD2" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FAFAD2'></span><span>LightGoldenrodYellow</span></span>"></option>
                                                        <option value="#90EE90" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#90EE90'></span><span>LightGreen</span></span>"></option>
                                                        <option value="#D3D3D3" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#D3D3D3'></span><span>LightGrey</span></span>"></option>
                                                        <option value="#FFB6C1" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFB6C1'></span><span>LightPink</span></span>"></option>
                                                        <option value="#FFA07A" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFA07A'></span><span>LightSalmon</span></span>"></option>
                                                        <option value="#FFA07A" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFA07A'></span><span>LightSalmon</span></span>"></option>
                                                        <option value="#20B2AA" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#20B2AA'></span><span>LightSeaGreen</span></span>"></option>
                                                        <option value="#87CEFA" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#87CEFA'></span><span>LightSkyBlue</span></span>"></option>
                                                        <option value="#778899" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#778899'></span><span>LightSlateGray</span></span>"></option>
                                                        <option value="#B0C4DE" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#B0C4DE'></span><span>LightSteelBlue</span></span>"></option>
                                                        <option value="#FFFFE0" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFFE0'></span><span>LightYellow</span></span>"></option>
                                                        <option value="#00FF00" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FF00'></span><span>Lime</span></span>"></option>
                                                        <option value="#32CD32" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#32CD32'></span><span>LimeGreen</span></span>"></option>
                                                        <option value="#FAF0E6" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FAF0E6'></span><span>Linen</span></span>"></option>
                                                        <option value="Space Gray" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:Space Gray'></span><span>M2ProMacBookPro14”and16”</span></span>"></option>
                                                        <option value="#FF00FF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF00FF'></span><span>Magenta</span></span>"></option>
                                                        <option value="#800000" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#800000'></span><span>Maroon</span></span>"></option>
                                                        <option value="#66CDAA" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#66CDAA'></span><span>MediumAquamarine</span></span>"></option>
                                                        <option value="#0000CD" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#0000CD'></span><span>MediumBlue</span></span>"></option>
                                                        <option value="#BA55D3" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#BA55D3'></span><span>MediumOrchid</span></span>"></option>
                                                        <option value="#9370DB" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9370DB'></span><span>MediumPurple</span></span>"></option>
                                                        <option value="#3CB371" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#3CB371'></span><span>MediumSeaGreen</span></span>"></option>
                                                        <option value="#7B68EE" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7B68EE'></span><span>MediumSlateBlue</span></span>"></option>
                                                        <option value="#7B68EE" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7B68EE'></span><span>MediumSlateBlue</span></span>"></option>
                                                        <option value="#00FA9A" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FA9A'></span><span>MediumSpringGreen</span></span>"></option>
                                                        <option value="#48D1CC" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#48D1CC'></span><span>MediumTurquoise</span></span>"></option>
                                                        <option value="#C71585" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#C71585'></span><span>MediumVioletRed</span></span>"></option>
                                                        <option value="#191970" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#191970'></span><span>MidnightBlue</span></span>"></option>
                                                        <option value="#F5FFFA" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F5FFFA'></span><span>MintCream</span></span>"></option>
                                                        <option value="#FFE4E1" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFE4E1'></span><span>MistyRose</span></span>"></option>
                                                        <option value="#FFE4B5" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFE4B5'></span><span>Moccasin</span></span>"></option>
                                                        <option value="#FFDEAD" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFDEAD'></span><span>NavajoWhite</span></span>"></option>
                                                        <option value="#000080" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#000080'></span><span>Navy</span></span>"></option>
                                                        <option value="#FDF5E6" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FDF5E6'></span><span>OldLace</span></span>"></option>
                                                        <option value="#808000" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#808000'></span><span>Olive</span></span>"></option>
                                                        <option value="#6B8E23" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#6B8E23'></span><span>OliveDrab</span></span>"></option>
                                                        <option value="#FFA500" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFA500'></span><span>Orange</span></span>"></option>
                                                        <option value="#FF4500" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF4500'></span><span>OrangeRed</span></span>"></option>
                                                        <option value="#DA70D6" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DA70D6'></span><span>Orchid</span></span>"></option>
                                                        <option value="#EEE8AA" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#EEE8AA'></span><span>PaleGoldenrod</span></span>"></option>
                                                        <option value="#98FB98" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#98FB98'></span><span>PaleGreen</span></span>"></option>
                                                        <option value="#AFEEEE" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#AFEEEE'></span><span>PaleTurquoise</span></span>"></option>
                                                        <option value="#DB7093" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DB7093'></span><span>PaleVioletRed</span></span>"></option>
                                                        <option value="#FFEFD5" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFEFD5'></span><span>PapayaWhip</span></span>"></option>
                                                        <option value="#FFDAB9" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFDAB9'></span><span>PeachPuff</span></span>"></option>
                                                        <option value="#CD853F" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#CD853F'></span><span>Peru</span></span>"></option>
                                                        <option value="#FFC0CB" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFC0CB'></span><span>Pink</span></span>"></option>
                                                        <option value="#DDA0DD" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DDA0DD'></span><span>Plum</span></span>"></option>
                                                        <option value="#B0E0E6" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#B0E0E6'></span><span>PowderBlue</span></span>"></option>
                                                        <option value="#800080" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#800080'></span><span>Purple</span></span>"></option>
                                                        <option value="#FF0000" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF0000'></span><span>Red</span></span>"></option>
                                                        <option value="#BC8F8F" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#BC8F8F'></span><span>RosyBrown</span></span>"></option>
                                                        <option value="#4169E1" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#4169E1'></span><span>RoyalBlue</span></span>"></option>
                                                        <option value="#8B4513" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8B4513'></span><span>SaddleBrown</span></span>"></option>
                                                        <option value="#FA8072" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FA8072'></span><span>Salmon</span></span>"></option>
                                                        <option value="#F4A460" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F4A460'></span><span>SandyBrown</span></span>"></option>
                                                        <option value="#2E8B57" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#2E8B57'></span><span>SeaGreen</span></span>"></option>
                                                        <option value="#FFF5EE" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFF5EE'></span><span>Seashell</span></span>"></option>
                                                        <option value="#A0522D" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#A0522D'></span><span>Sienna</span></span>"></option>
                                                        <option value="#C0C0C0" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#C0C0C0'></span><span>Silver</span></span>"></option>
                                                        <option value="#87CEEB" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#87CEEB'></span><span>SkyBlue</span></span>"></option>
                                                        <option value="#6A5ACD" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#6A5ACD'></span><span>SlateBlue</span></span>"></option>
                                                        <option value="#708090" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#708090'></span><span>SlateGray</span></span>"></option>
                                                        <option value="#FFFAFA" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFAFA'></span><span>Snow</span></span>"></option>
                                                        <option value="#00FF7F" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FF7F'></span><span>SpringGreen</span></span>"></option>
                                                        <option value="#4682B4" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#4682B4'></span><span>SteelBlue</span></span>"></option>
                                                        <option value="#D2B48C" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#D2B48C'></span><span>Tan</span></span>"></option>
                                                        <option value="#008080" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#008080'></span><span>Teal</span></span>"></option>
                                                        <option value="#D8BFD8" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#D8BFD8'></span><span>Thistle</span></span>"></option>
                                                        <option value="#FF6347" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF6347'></span><span>Tomato</span></span>"></option>
                                                        <option value="#40E0D0" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#40E0D0'></span><span>Turquoise</span></span>"></option>
                                                        <option value="#EE82EE" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#EE82EE'></span><span>Violet</span></span>"></option>
                                                        <option value="#F5DEB3" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F5DEB3'></span><span>Wheat</span></span>"></option>
                                                        <option value="#FFFFFF" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFFFF'></span><span>White</span></span>"></option>
                                                        <option value="#F5F5F5" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F5F5F5'></span><span>WhiteSmoke</span></span>"></option>
                                                        <option value="#FFFF00" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFF00'></span><span>Yellow</span></span>"></option>
                                                        <option value="#9ACD32" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9ACD32'></span><span>YellowGreen</span></span>"></option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input value="1" type="checkbox" name="colors_active">
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
                                                        <option value="1"><?=tran("Size")?></option>
                                                        <option value="3"><?=tran("Weight")?></option>
                                                        <option value="4"><?=tran("Variation")?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <p>Choose the attributes of this product and then input values of each attribute</p>
                                                <br>
                                            </div>

                                            <div class="customer_choice_options" id="customer_choice_options">

                                            </div>
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
                                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="Unit price" name="unit_price" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 control-label" for="start_date">Discount Date Range</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">Discount <span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="Discount" name="discount" class="form-control" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control aiz-selectpicker" name="discount_type">
                                                        <option value="amount">Flat</option>
                                                        <option value="percent">Percent</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div id="show-hide-div">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-from-label"><?=tran("Quantity")?> <span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <input type="number" lang="en" min="0" value="0" step="1" placeholder="<?=tran("Quantity")?>" name="current_stock" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-from-label">
                                                        SKU
                                                    </label>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="SKU" name="sku" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">
                                                    External link
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="External link" name="external_link" class="form-control">
                                                    <small class="text-muted">Leave it blank if you do not use external site link</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">
                                                    External link button text
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="External link button text" name="external_link_btn" class="form-control">
                                                    <small class="text-muted">Leave it blank if you do not use external site link</small>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="sku_combination" id="sku_combination">

                                            </div>
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
                                                    <textarea class="aiz-text-editor" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Product Shipping Cost</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>-->

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
                                                        <input type="hidden" name="pdf" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
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
                                                    <input type="text" class="form-control" name="meta_title" placeholder="Meta Title">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label"><?=tran("Description")?></label>
                                                <div class="col-md-8">
                                                    <textarea name="meta_description" rows="8" class="form-control"></textarea>
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
                                                        <input type="hidden" name="meta_img" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">
                                                
                                                <?=tran("Shipping Configuration")?>
                                            </h5>
                                        </div>

                                        <div class="card-body">
                                            <p><?=tran("Shipping ConfigurationProduct wise shipping cost is disable. Shipping cost is configured from here")?>
                                                <a href="/admin/shipping_configuration" class="aiz-side-nav-link ">
                                                    <span class="aiz-side-nav-text"><?=tran("Shipping Configuration")?></span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6"><?=tran("Low Stock Quantity Warning")?>

                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label for="name">
                                                    <?=tran("Quantity")?>
                                                </label>
                                                <input type="number" name="low_stock_quantity" value="1" min="0" step="1" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">
                                                <?=tran("Stock Visibility State")?>
                                            </h5>
                                        </div>

                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-md-6 col-from-label"><?=tran("Show Stock Quantity")?></label>
                                                <div class="col-md-6">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input type="radio" name="stock_visibility_state" value="quantity" checked>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-6 col-from-label"><?=tran("Show Stock With Text Only")?></label>
                                                <div class="col-md-6">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input type="radio" name="stock_visibility_state" value="text">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-6 col-from-label"><?=tran("Hide Stock")?></label>
                                                <div class="col-md-6">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input type="radio" name="stock_visibility_state" value="hide">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6"> <?=tran("Cash on Delivery")?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-6 col-from-label"> <?=tran("Status")?></label>
                                                <div class="col-md-6">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input type="checkbox" name="cash_on_delivery" value="1" checked="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6"> <?=tran("Featured")?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-6 col-from-label"><?=tran("Status")?> </label>
                                                <div class="col-md-6">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input type="checkbox" name="featured" value="1">
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
                                                        <input type="checkbox" name="todays_deal" value="1">
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
                                                <label for="name">
                                                    Add To Flash
                                                </label>
                                                <select class="form-control aiz-selectpicker" name="flash_deal_id" id="flash_deal">
                                                    <option value="">Choose Flash Title</option>
                                                    <option value="1">
                                                        flas sale
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="name">
                                                    Discount
                                                </label>
                                                <input type="number" name="flash_discount" value="0" min="0" step="0.01" class="form-control">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="name">
                                                    Discount Type
                                                </label>
                                                <select class="form-control aiz-selectpicker" name="flash_discount_type" id="flash_discount_type">
                                                    <option value="">Choose Discount Type</option>
                                                    <option value="amount">Flat</option>
                                                    <option value="percent">Percent</option>
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
                                                <label for="name">
                                                    Shipping Days
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="est_shipping_days" min="1" step="1" placeholder="Shipping Days">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">Days</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">Vat &amp; TAX</h5>
                                        </div>
                                        <div class="card-body">
                                            <label for="name">
                                                Profit
                                                <input type="hidden" value="3" name="tax_id[]">
                                            </label>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="Tax" name="tax[]" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control aiz-selectpicker" name="tax_type[]">
                                                        <option value="amount">Flat</option>
                                                        <option value="percent">Percent</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <label for="name">
                                                Hoa hồng
                                                <input type="hidden" value="4" name="tax_id[]">
                                            </label>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="Tax" name="tax[]" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control aiz-selectpicker" name="tax_type[]">
                                                        <option value="amount">Flat</option>
                                                        <option value="percent">Percent</option>
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
                    <p class="mb-0">&copy; GMARKETVN v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->



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