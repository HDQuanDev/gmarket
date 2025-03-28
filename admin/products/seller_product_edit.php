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
                        <h1 class="mb-0 h6">Edit Product</h5>
                    </div>
                    <div class="">
                        <form class="form form-horizontal mar-top" action="" method="POST" enctype="multipart/form-data" id="choice_form">
                            <div class="row gutters-5">
                                <div class="col-lg-8">
                                    <input name="_method" type="hidden" value="POST">
                                    <input type="hidden" name="id" value="50050">
                                    <input type="hidden" name="lang" value="en">
                                    <input type="hidden" name="_token" value="bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb">
                                    <div class="card">
                                        <ul class="nav nav-tabs nav-fill border-light" style="display:none">
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  active  py-3" href="/admin/products/admin/50050/edit?lang=en">
                                                    <img src="/public/assets/img/flags/en.png" height="11" class="mr-1">
                                                    <span>English</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=cn">
                                                    <img src="/public/assets/img/flags/cn.png" height="11" class="mr-1">
                                                    <span>中文</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=kr">
                                                    <img src="/public/assets/img/flags/kr.png" height="11" class="mr-1">
                                                    <span>Korea</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=ru">
                                                    <img src="/public/assets/img/flags/ru.png" height="11" class="mr-1">
                                                    <span>Russia</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=in">
                                                    <img src="/public/assets/img/flags/in.png" height="11" class="mr-1">
                                                    <span>India</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=ae">
                                                    <img src="/public/assets/img/flags/ae.png" height="11" class="mr-1">
                                                    <span>UAE</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=jp">
                                                    <img src="/public/assets/img/flags/jp.png" height="11" class="mr-1">
                                                    <span>Japan</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=th">
                                                    <img src="/public/assets/img/flags/th.png" height="11" class="mr-1">
                                                    <span>Thailand</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=br">
                                                    <img src="/public/assets/img/flags/br.png" height="11" class="mr-1">
                                                    <span>Brazil</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=vn">
                                                    <img src="/public/assets/img/flags/vn.png" height="11" class="mr-1">
                                                    <span>Vietnam</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=sg">
                                                    <img src="/public/assets/img/flags/sg.png" height="11" class="mr-1">
                                                    <span>Singapore</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=my">
                                                    <img src="/public/assets/img/flags/my.png" height="11" class="mr-1">
                                                    <span>Malaysia</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=fr">
                                                    <img src="/public/assets/img/flags/fr.png" height="11" class="mr-1">
                                                    <span>France</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/products/admin/50050/edit?lang=de">
                                                    <img src="/public/assets/img/flags/de.png" height="11" class="mr-1">
                                                    <span>Germany</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Product Name <i class="las la-language text-danger" title="Translatable"></i></label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="name" placeholder="Product Name" value="COCO genuine perfume lady long-lasting fresh light fragrance student cocoa fragrance 100ml" required>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="category">
                                                <label class="col-lg-3 col-from-label">Category</label>
                                                <div class="col-lg-8">
                                                    <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-selected="18" data-live-search="true" required>
                                                        <option value="1">Ladies clothing</option>
                                                        <option value="2">Men&#039;s clothing</option>
                                                        <option value="4">Mother and baby items</option>
                                                        <option value="7">Jewelry &amp; Watches</option>
                                                        <option value="12">Beauty salons</option>
                                                        <option value="13">Shoes</option>
                                                        <option value="14">Interior - Decoration</option>
                                                        <option value="16">Pet accessories</option>
                                                        <option value="17">Home electric</option>
                                                        <option value="18">Nước Hoa - Mỹ Phẩm</option>
                                                        <option value="23">Fashion accessories</option>
                                                        <option value="24">Nail and eyelash accessories</option>
                                                        <option value="25">Baby shoes</option>
                                                        <option value="26">Functional foods - Health</option>
                                                        <option value="28">Backpack - Suitcase</option>
                                                        <option value="29">Hand Bag</option>
                                                        <option value="30">Snacks</option>
                                                        <option value="31">Beer - Wine - Drinks</option>
                                                        <option value="32">Souvenir</option>
                                                        <option value="34">Điện Thoại - Máy Tính - Phụ Kiện</option>
                                                        <option value="35">Thể Dục - Thể Thao</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="brand">
                                                <label class="col-lg-3 col-from-label">Brand</label>
                                                <div class="col-lg-8">
                                                    <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">
                                                        <option value="">Select Brand</option>
                                                        <option value="3">APPLE</option>
                                                        <option value="4">Microsoft</option>
                                                        <option value="5">Samsung</option>
                                                        <option value="6">Intel</option>
                                                        <option value="7">Philips</option>
                                                        <option value="8">Xiaomi</option>
                                                        <option value="9">Huawei</option>
                                                        <option value="10">Nike</option>
                                                        <option value="11">Adidas</option>
                                                        <option value="12">Puma</option>
                                                        <option value="13">New Balance</option>
                                                        <option value="14">Converse</option>
                                                        <option value="15">Skechers</option>
                                                        <option value="16">Reebok</option>
                                                        <option value="17">Vans</option>
                                                        <option value="18">Gucci</option>
                                                        <option value="19">Louis Vutton</option>
                                                        <option value="20">Hermes</option>
                                                        <option value="21">Prada</option>
                                                        <option value="22">Channel</option>
                                                        <option value="23">FenDi</option>
                                                        <option value="24">Givenchy</option>
                                                        <option value="25">Dior</option>
                                                        <option value="26">Versace</option>
                                                        <option value="27">Cartier</option>
                                                        <option value="28">Balenciaga</option>
                                                        <option value="29">Valentino</option>
                                                        <option value="30">Chloé</option>
                                                        <option value="31">Coach</option>
                                                        <option value="32">Zara</option>
                                                        <option value="33">D&amp;G</option>
                                                        <option value="34">Rolex</option>
                                                        <option value="35">Tom Ford</option>
                                                        <option value="36">Boss</option>
                                                        <option value="37">Calvin Klein</option>
                                                        <option value="38">Lacoste</option>
                                                        <option value="39">Y.S.L</option>
                                                        <option value="40">Victoria Secret</option>
                                                        <option value="41">Giorgio Armani</option>
                                                        <option value="42">Tommy</option>
                                                        <option value="43">Burberry</option>
                                                        <option value="44">Louboutin</option>
                                                        <option value="45">Bioré</option>
                                                        <option value="46">Bio Oil</option>
                                                        <option value="47">Angel Eyes</option>
                                                        <option value="48">Panasonic</option>
                                                        <option value="49">Toshiba</option>
                                                        <option value="51">MLB</option>
                                                        <option value="52">ROCKROOSTER</option>
                                                        <option value="53">Champion</option>
                                                        <option value="54">Shengtang Home Furnishing Museum</option>
                                                        <option value="55">Qifanhai</option>
                                                        <option value="56">Haofeimei</option>
                                                        <option value="57">VATAR/Vanda Furniture</option>
                                                        <option value="58">Jane Fina</option>
                                                        <option value="59">Fareanar</option>
                                                        <option value="60">Muyoka</option>
                                                        <option value="61">DKEA</option>
                                                        <option value="63" selected>Gmarket</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Unit <i class="las la-language text-danger" title="Translatable"></i> </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="unit" placeholder="Unit (e.g. KG, Pc etc)" value="sản phẩm" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">Weight <small>(In Kg)</small></label>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" name="weight" value="0" step="0.01" placeholder="0.00">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Minimum Purchase Qty</label>
                                                <div class="col-lg-8">
                                                    <input type="number" lang="en" class="form-control" name="min_qty" value="1" min="1" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Tags</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control aiz-tag-input" name="tags[]" id="tags" value="" placeholder="Type to add a tag" data-role="tagsinput">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Barcode</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="barcode" placeholder="Barcode" value="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">Product Images</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="signinSrEmail">Gallery Images</label>
                                                <div class="col-md-8">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                        <div class="form-control file-amount">Choose File</div>
                                                        <input type="hidden" name="photos" value="42395,42396,42397,42398,42399" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="signinSrEmail">Thumbnail Image <small>(290x300)</small></label>
                                                <div class="col-md-8">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                        <div class="form-control file-amount">Choose File</div>
                                                        <input type="hidden" name="thumbnail_img" value="42396" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">Product Videos</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Video Provider</label>
                                                <div class="col-lg-8">
                                                    <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">
                                                        <option value="youtube" selected>Youtube</option>
                                                        <option value="dailymotion">Dailymotion</option>
                                                        <option value="vimeo">Vimeo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Video Link</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="video_link" value="" placeholder="Video Link">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">Product Variation</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row gutters-5">
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" value="Colors" disabled>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select class="form-control aiz-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple>
                                                        <option
                                                            value="#F0F8FF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0F8FF'></span><span>AliceBlue</span></span>"></option>
                                                        <option
                                                            value="#9966CC"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9966CC'></span><span>Amethyst</span></span>"></option>
                                                        <option
                                                            value="#FAEBD7"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FAEBD7'></span><span>AntiqueWhite</span></span>"></option>
                                                        <option
                                                            value="#00FFFF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FFFF'></span><span>Aqua</span></span>"></option>
                                                        <option
                                                            value="#7FFFD4"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7FFFD4'></span><span>Aquamarine</span></span>"></option>
                                                        <option
                                                            value="#F0FFFF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0FFFF'></span><span>Azure</span></span>"></option>
                                                        <option
                                                            value="#F5F5DC"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F5F5DC'></span><span>Beige</span></span>"></option>
                                                        <option
                                                            value="#FFE4C4"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFE4C4'></span><span>Bisque</span></span>"></option>
                                                        <option
                                                            value="#000000"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#000000'></span><span>Black</span></span>"></option>
                                                        <option
                                                            value="#FFEBCD"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFEBCD'></span><span>BlanchedAlmond</span></span>"></option>
                                                        <option
                                                            value="#0000FF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#0000FF'></span><span>Blue</span></span>"></option>
                                                        <option
                                                            value="#8A2BE2"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8A2BE2'></span><span>BlueViolet</span></span>"></option>
                                                        <option
                                                            value="#A52A2A"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#A52A2A'></span><span>Brown</span></span>"></option>
                                                        <option
                                                            value="#DEB887"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DEB887'></span><span>BurlyWood</span></span>"></option>
                                                        <option
                                                            value="#5F9EA0"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#5F9EA0'></span><span>CadetBlue</span></span>"></option>
                                                        <option
                                                            value="#7FFF00"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7FFF00'></span><span>Chartreuse</span></span>"></option>
                                                        <option
                                                            value="#D2691E"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#D2691E'></span><span>Chocolate</span></span>"></option>
                                                        <option
                                                            value="#FF7F50"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF7F50'></span><span>Coral</span></span>"></option>
                                                        <option
                                                            value="#6495ED"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#6495ED'></span><span>CornflowerBlue</span></span>"></option>
                                                        <option
                                                            value="#FFF8DC"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFF8DC'></span><span>Cornsilk</span></span>"></option>
                                                        <option
                                                            value="#DC143C"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DC143C'></span><span>Crimson</span></span>"></option>
                                                        <option
                                                            value="#00FFFF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FFFF'></span><span>Cyan</span></span>"></option>
                                                        <option
                                                            value="#00008B"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00008B'></span><span>DarkBlue</span></span>"></option>
                                                        <option
                                                            value="#008B8B"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#008B8B'></span><span>DarkCyan</span></span>"></option>
                                                        <option
                                                            value="#B8860B"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#B8860B'></span><span>DarkGoldenrod</span></span>"></option>
                                                        <option
                                                            value="#A9A9A9"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#A9A9A9'></span><span>DarkGray</span></span>"></option>
                                                        <option
                                                            value="#006400"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#006400'></span><span>DarkGreen</span></span>"></option>
                                                        <option
                                                            value="#BDB76B"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#BDB76B'></span><span>DarkKhaki</span></span>"></option>
                                                        <option
                                                            value="#8B008B"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8B008B'></span><span>DarkMagenta</span></span>"></option>
                                                        <option
                                                            value="#556B2F"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#556B2F'></span><span>DarkOliveGreen</span></span>"></option>
                                                        <option
                                                            value="#FF8C00"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF8C00'></span><span>DarkOrange</span></span>"></option>
                                                        <option
                                                            value="#9932CC"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9932CC'></span><span>DarkOrchid</span></span>"></option>
                                                        <option
                                                            value="#8B0000"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8B0000'></span><span>DarkRed</span></span>"></option>
                                                        <option
                                                            value="#E9967A"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#E9967A'></span><span>DarkSalmon</span></span>"></option>
                                                        <option
                                                            value="#8FBC8F"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8FBC8F'></span><span>DarkSeaGreen</span></span>"></option>
                                                        <option
                                                            value="#483D8B"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#483D8B'></span><span>DarkSlateBlue</span></span>"></option>
                                                        <option
                                                            value="#2F4F4F"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#2F4F4F'></span><span>DarkSlateGray</span></span>"></option>
                                                        <option
                                                            value="#00CED1"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00CED1'></span><span>DarkTurquoise</span></span>"></option>
                                                        <option
                                                            value="#9400D3"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9400D3'></span><span>DarkViolet</span></span>"></option>
                                                        <option
                                                            value="#FF1493"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF1493'></span><span>DeepPink</span></span>"></option>
                                                        <option
                                                            value="#00BFFF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00BFFF'></span><span>DeepSkyBlue</span></span>"></option>
                                                        <option
                                                            value="#696969"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#696969'></span><span>DimGray</span></span>"></option>
                                                        <option
                                                            value="#1E90FF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#1E90FF'></span><span>DodgerBlue</span></span>"></option>
                                                        <option
                                                            value="#B22222"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#B22222'></span><span>FireBrick</span></span>"></option>
                                                        <option
                                                            value="#FFFAF0"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFAF0'></span><span>FloralWhite</span></span>"></option>
                                                        <option
                                                            value="#228B22"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#228B22'></span><span>ForestGreen</span></span>"></option>
                                                        <option
                                                            value="#FF00FF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF00FF'></span><span>Fuchsia</span></span>"></option>
                                                        <option
                                                            value="#DCDCDC"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DCDCDC'></span><span>Gainsboro</span></span>"></option>
                                                        <option
                                                            value="#F8F8FF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F8F8FF'></span><span>GhostWhite</span></span>"></option>
                                                        <option
                                                            value="#FFD700"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFD700'></span><span>Gold</span></span>"></option>
                                                        <option
                                                            value="#DAA520"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DAA520'></span><span>Goldenrod</span></span>"></option>
                                                        <option
                                                            value="#808080"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#808080'></span><span>Gray</span></span>"></option>
                                                        <option
                                                            value="#008000"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#008000'></span><span>Green</span></span>"></option>
                                                        <option
                                                            value="#ADFF2F"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#ADFF2F'></span><span>GreenYellow</span></span>"></option>
                                                        <option
                                                            value="#F0FFF0"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0FFF0'></span><span>Honeydew</span></span>"></option>
                                                        <option
                                                            value="#FF69B4"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF69B4'></span><span>HotPink</span></span>"></option>
                                                        <option
                                                            value="#CD5C5C"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#CD5C5C'></span><span>IndianRed</span></span>"></option>
                                                        <option
                                                            value="#4B0082"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#4B0082'></span><span>Indigo</span></span>"></option>
                                                        <option
                                                            value="#FFFFF0"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFFF0'></span><span>Ivory</span></span>"></option>
                                                        <option
                                                            value="#F0E68C"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F0E68C'></span><span>Khaki</span></span>"></option>
                                                        <option
                                                            value="#E6E6FA"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#E6E6FA'></span><span>Lavender</span></span>"></option>
                                                        <option
                                                            value="#FFF0F5"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFF0F5'></span><span>LavenderBlush</span></span>"></option>
                                                        <option
                                                            value="#7CFC00"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7CFC00'></span><span>LawnGreen</span></span>"></option>
                                                        <option
                                                            value="#FFFACD"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFACD'></span><span>LemonChiffon</span></span>"></option>
                                                        <option
                                                            value="#ADD8E6"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#ADD8E6'></span><span>LightBlue</span></span>"></option>
                                                        <option
                                                            value="#F08080"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F08080'></span><span>LightCoral</span></span>"></option>
                                                        <option
                                                            value="#E0FFFF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#E0FFFF'></span><span>LightCyan</span></span>"></option>
                                                        <option
                                                            value="#FAFAD2"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FAFAD2'></span><span>LightGoldenrodYellow</span></span>"></option>
                                                        <option
                                                            value="#90EE90"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#90EE90'></span><span>LightGreen</span></span>"></option>
                                                        <option
                                                            value="#D3D3D3"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#D3D3D3'></span><span>LightGrey</span></span>"></option>
                                                        <option
                                                            value="#FFB6C1"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFB6C1'></span><span>LightPink</span></span>"></option>
                                                        <option
                                                            value="#FFA07A"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFA07A'></span><span>LightSalmon</span></span>"></option>
                                                        <option
                                                            value="#FFA07A"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFA07A'></span><span>LightSalmon</span></span>"></option>
                                                        <option
                                                            value="#20B2AA"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#20B2AA'></span><span>LightSeaGreen</span></span>"></option>
                                                        <option
                                                            value="#87CEFA"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#87CEFA'></span><span>LightSkyBlue</span></span>"></option>
                                                        <option
                                                            value="#778899"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#778899'></span><span>LightSlateGray</span></span>"></option>
                                                        <option
                                                            value="#B0C4DE"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#B0C4DE'></span><span>LightSteelBlue</span></span>"></option>
                                                        <option
                                                            value="#FFFFE0"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFFE0'></span><span>LightYellow</span></span>"></option>
                                                        <option
                                                            value="#00FF00"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FF00'></span><span>Lime</span></span>"></option>
                                                        <option
                                                            value="#32CD32"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#32CD32'></span><span>LimeGreen</span></span>"></option>
                                                        <option
                                                            value="#FAF0E6"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FAF0E6'></span><span>Linen</span></span>"></option>
                                                        <option
                                                            value="Space Gray"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:Space Gray'></span><span>M2ProMacBookPro14”and16”</span></span>"></option>
                                                        <option
                                                            value="#FF00FF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF00FF'></span><span>Magenta</span></span>"></option>
                                                        <option
                                                            value="#800000"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#800000'></span><span>Maroon</span></span>"></option>
                                                        <option
                                                            value="#66CDAA"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#66CDAA'></span><span>MediumAquamarine</span></span>"></option>
                                                        <option
                                                            value="#0000CD"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#0000CD'></span><span>MediumBlue</span></span>"></option>
                                                        <option
                                                            value="#BA55D3"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#BA55D3'></span><span>MediumOrchid</span></span>"></option>
                                                        <option
                                                            value="#9370DB"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9370DB'></span><span>MediumPurple</span></span>"></option>
                                                        <option
                                                            value="#3CB371"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#3CB371'></span><span>MediumSeaGreen</span></span>"></option>
                                                        <option
                                                            value="#7B68EE"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7B68EE'></span><span>MediumSlateBlue</span></span>"></option>
                                                        <option
                                                            value="#7B68EE"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#7B68EE'></span><span>MediumSlateBlue</span></span>"></option>
                                                        <option
                                                            value="#00FA9A"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FA9A'></span><span>MediumSpringGreen</span></span>"></option>
                                                        <option
                                                            value="#48D1CC"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#48D1CC'></span><span>MediumTurquoise</span></span>"></option>
                                                        <option
                                                            value="#C71585"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#C71585'></span><span>MediumVioletRed</span></span>"></option>
                                                        <option
                                                            value="#191970"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#191970'></span><span>MidnightBlue</span></span>"></option>
                                                        <option
                                                            value="#F5FFFA"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F5FFFA'></span><span>MintCream</span></span>"></option>
                                                        <option
                                                            value="#FFE4E1"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFE4E1'></span><span>MistyRose</span></span>"></option>
                                                        <option
                                                            value="#FFE4B5"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFE4B5'></span><span>Moccasin</span></span>"></option>
                                                        <option
                                                            value="#FFDEAD"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFDEAD'></span><span>NavajoWhite</span></span>"></option>
                                                        <option
                                                            value="#000080"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#000080'></span><span>Navy</span></span>"></option>
                                                        <option
                                                            value="#FDF5E6"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FDF5E6'></span><span>OldLace</span></span>"></option>
                                                        <option
                                                            value="#808000"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#808000'></span><span>Olive</span></span>"></option>
                                                        <option
                                                            value="#6B8E23"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#6B8E23'></span><span>OliveDrab</span></span>"></option>
                                                        <option
                                                            value="#FFA500"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFA500'></span><span>Orange</span></span>"></option>
                                                        <option
                                                            value="#FF4500"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF4500'></span><span>OrangeRed</span></span>"></option>
                                                        <option
                                                            value="#DA70D6"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DA70D6'></span><span>Orchid</span></span>"></option>
                                                        <option
                                                            value="#EEE8AA"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#EEE8AA'></span><span>PaleGoldenrod</span></span>"></option>
                                                        <option
                                                            value="#98FB98"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#98FB98'></span><span>PaleGreen</span></span>"></option>
                                                        <option
                                                            value="#AFEEEE"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#AFEEEE'></span><span>PaleTurquoise</span></span>"></option>
                                                        <option
                                                            value="#DB7093"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DB7093'></span><span>PaleVioletRed</span></span>"></option>
                                                        <option
                                                            value="#FFEFD5"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFEFD5'></span><span>PapayaWhip</span></span>"></option>
                                                        <option
                                                            value="#FFDAB9"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFDAB9'></span><span>PeachPuff</span></span>"></option>
                                                        <option
                                                            value="#CD853F"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#CD853F'></span><span>Peru</span></span>"></option>
                                                        <option
                                                            value="#FFC0CB"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFC0CB'></span><span>Pink</span></span>"></option>
                                                        <option
                                                            value="#DDA0DD"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#DDA0DD'></span><span>Plum</span></span>"></option>
                                                        <option
                                                            value="#B0E0E6"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#B0E0E6'></span><span>PowderBlue</span></span>"></option>
                                                        <option
                                                            value="#800080"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#800080'></span><span>Purple</span></span>"></option>
                                                        <option
                                                            value="#FF0000"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF0000'></span><span>Red</span></span>"></option>
                                                        <option
                                                            value="#BC8F8F"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#BC8F8F'></span><span>RosyBrown</span></span>"></option>
                                                        <option
                                                            value="#4169E1"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#4169E1'></span><span>RoyalBlue</span></span>"></option>
                                                        <option
                                                            value="#8B4513"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#8B4513'></span><span>SaddleBrown</span></span>"></option>
                                                        <option
                                                            value="#FA8072"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FA8072'></span><span>Salmon</span></span>"></option>
                                                        <option
                                                            value="#F4A460"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F4A460'></span><span>SandyBrown</span></span>"></option>
                                                        <option
                                                            value="#2E8B57"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#2E8B57'></span><span>SeaGreen</span></span>"></option>
                                                        <option
                                                            value="#FFF5EE"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFF5EE'></span><span>Seashell</span></span>"></option>
                                                        <option
                                                            value="#A0522D"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#A0522D'></span><span>Sienna</span></span>"></option>
                                                        <option
                                                            value="#C0C0C0"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#C0C0C0'></span><span>Silver</span></span>"></option>
                                                        <option
                                                            value="#87CEEB"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#87CEEB'></span><span>SkyBlue</span></span>"></option>
                                                        <option
                                                            value="#6A5ACD"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#6A5ACD'></span><span>SlateBlue</span></span>"></option>
                                                        <option
                                                            value="#708090"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#708090'></span><span>SlateGray</span></span>"></option>
                                                        <option
                                                            value="#FFFAFA"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFAFA'></span><span>Snow</span></span>"></option>
                                                        <option
                                                            value="#00FF7F"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#00FF7F'></span><span>SpringGreen</span></span>"></option>
                                                        <option
                                                            value="#4682B4"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#4682B4'></span><span>SteelBlue</span></span>"></option>
                                                        <option
                                                            value="#D2B48C"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#D2B48C'></span><span>Tan</span></span>"></option>
                                                        <option
                                                            value="#008080"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#008080'></span><span>Teal</span></span>"></option>
                                                        <option
                                                            value="#D8BFD8"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#D8BFD8'></span><span>Thistle</span></span>"></option>
                                                        <option
                                                            value="#FF6347"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FF6347'></span><span>Tomato</span></span>"></option>
                                                        <option
                                                            value="#40E0D0"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#40E0D0'></span><span>Turquoise</span></span>"></option>
                                                        <option
                                                            value="#EE82EE"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#EE82EE'></span><span>Violet</span></span>"></option>
                                                        <option
                                                            value="#F5DEB3"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F5DEB3'></span><span>Wheat</span></span>"></option>
                                                        <option
                                                            value="#FFFFFF"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFFFF'></span><span>White</span></span>"></option>
                                                        <option
                                                            value="#F5F5F5"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#F5F5F5'></span><span>WhiteSmoke</span></span>"></option>
                                                        <option
                                                            value="#FFFF00"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#FFFF00'></span><span>Yellow</span></span>"></option>
                                                        <option
                                                            value="#9ACD32"
                                                            data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:#9ACD32'></span><span>YellowGreen</span></span>"></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-1">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input value="1" type="checkbox" name="colors_active">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row gutters-5">
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" value="Attributes" disabled>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="choice_attributes[]" id="choice_attributes" data-selected-text-format="count" data-live-search="true" class="form-control aiz-selectpicker" multiple data-placeholder="Choose Attributes">
                                                        <option value="1">Size</option>
                                                        <option value="3">Weight</option>
                                                        <option value="4">Variation</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="">
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
                                                <label class="col-lg-3 col-from-label">Unit price</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Unit price" name="unit_price" class="form-control" value="26" required>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-3 col-from-label" for="start_date">Discount Date Range</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Discount</label>
                                                <div class="col-lg-6">
                                                    <input type="number" lang="en" min="0" step="0.01" placeholder="Discount" name="discount" class="form-control" value="0" required>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select class="form-control aiz-selectpicker" name="discount_type" required>
                                                        <option value="amount" selected>Flat</option>
                                                        <option value="percent">Percent</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div id="show-hide-div">
                                                <div class="form-group row" id="quantity">
                                                    <label class="col-lg-3 col-from-label">Quantity</label>
                                                    <div class="col-lg-6">
                                                        <input type="number" lang="en" value="456913" step="1" placeholder="Quantity" name="current_stock" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-from-label">
                                                        SKU
                                                    </label>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="SKU" value="" name="sku" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">
                                                    External link
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="External link" name="external_link" value="" class="form-control">
                                                    <small class="text-muted">Leave it blank if you do not use external site link</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-from-label">
                                                    External link button text
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="External link button text" name="external_link_btn" value="" class="form-control">
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
                                            <h5 class="mb-0 h6">Product Description</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Description <i class="las la-language text-danger" title="Translatable"></i></label>
                                                <div class="col-lg-9">
                                                    <textarea class="aiz-text-editor" name="description">&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;div data-spm=&quot;1081181309201&quot; data-version=&quot;0.0.7&quot; id=&quot;1081181309201&quot; class=&quot;rox-pegasus-module&quot; mod-name=&quot;@ali/tdmod-od-pc-attribute-new&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(51, 51, 51); font-family: Tahoma, Arial, 宋体, sans-serif; background-color: rgb(242, 242, 242);&quot;&gt;&lt;div class=&quot;od-pc-attribute&quot; data-spm-anchor-id=&quot;a261y.7663282.1081181309201.i1.544445d6L3MJIK&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; padding-top: 10px; padding-bottom: 20px; outline: 0px; border: 0px; vertical-align: baseline; max-width: 100%; background: rgb(255, 255, 255);&quot;&gt;&lt;div id=&quot;offer-title-1081181309201-0&quot; class=&quot;offer-title-wrapper&quot; data-module-id=&quot;1081181309201&quot; data-title=&quot;商品属性&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-right: 36px; margin-left: 36px; padding-top: 15px; padding-bottom: 15px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; align-items: center;&quot;&gt;&lt;div class=&quot;offer-title-content&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-left: 6px; outline: 0px; border: 0px; vertical-align: baseline; font-size: 14px; font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Product attributes&lt;/font&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; padding-right: 46px; padding-left: 46px; outline: 0px; border: 0px; vertical-align: baseline; width: 980px; position: relative;&quot;&gt;&lt;div class=&quot;offer-attr-switch&quot; data-spm-anchor-id=&quot;a261y.7663282.1081181309201.i0.544445d6L3MJIK&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border-width: 1px; border-style: solid; border-color: rgb(255, 255, 255) rgb(229, 229, 229) rgb(229, 229, 229); border-image: initial; vertical-align: baseline; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; position: absolute; bottom: -17px; left: 108px; width: 52px; height: 18px; border-radius: 0px 0px 5px 5px; display: flex; flex-direction: row; justify-content: center; align-items: flex-end; color: rgb(136, 136, 136); cursor: pointer;&quot;&gt;&lt;span class=&quot;next-icon next-icon-arrow-up next-xxs&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px -4px; padding: 0px; outline: 0px; border: 0px; vertical-align: baseline; display: inline-block; font-family: NextIcon; -webkit-font-smoothing: antialiased; transform: scale(0.5);&quot;&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-wrapper&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border-width: 0px 0px 1px; border-top-style: initial; border-right-style: initial; border-bottom-style: solid; border-left-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: rgb(229, 229, 229); border-left-color: initial; border-image: initial; vertical-align: baseline; width: 888.021px; height: 269.531px; overflow: hidden; transition: height 0.5s ease 0s;&quot;&gt;&lt;div class=&quot;offer-attr-list&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; padding-bottom: 16px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-flow: wrap;&quot;&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Brand type&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;Domestic brands&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Domestic brands&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Whether to import&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;no&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;no&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;brand&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;DRINK&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;DRINK&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;For people&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;Miss&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Miss&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;fragrance&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;Vetiver, bergamot, freesia, benzoin, oud&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Vetiver, bergamot, freesia, benzoin, oud&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Fragrance&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;Fruity&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Fruity&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Specification&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;Normal specifications&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Normal specifications&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Aroma rate&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;7-12%&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;7-12%&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;special purpose cosmetics&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;no&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;no&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Origin&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;Zhejiang&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Zhejiang&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;shelf life&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;60 months&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;60 months&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;sort by color&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;black cocoa&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;black cocoa&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Whether to provide exclusive supply for cross-border exports&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;yes&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;yes&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;net weight&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;100ml&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;100ml&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Non-special cosmetics registration certificate number&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;Zhejiang G makeup network preparation number 2021010454&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Zhejiang G makeup network preparation number 2021010454&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Main sales areas&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;South America, North America, Middle East&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;South America, North America, Middle East&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;div class=&quot;offer-attr-item&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 18px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row; width: 295.694px;&quot;&gt;&lt;span class=&quot;offer-attr-item-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; width: 150px; color: rgb(153, 153, 153);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;product name&lt;/font&gt;&lt;/span&gt;&lt;span class=&quot;offer-attr-item-value&quot; title=&quot;cocoa&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px 20px 0px 0px; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%; overflow: hidden; text-overflow: ellipsis; text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;cocoa&lt;/font&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div data-spm=&quot;1081181309894&quot; data-version=&quot;1.0.4&quot; id=&quot;1081181309894&quot; class=&quot;rox-pegasus-module&quot; mod-name=&quot;@ali/tdmod-od-pc-offer-description&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(51, 51, 51); font-family: Tahoma, Arial, 宋体, sans-serif; background-color: rgb(242, 242, 242);&quot;&gt;&lt;div class=&quot;od-pc-detail-description&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; font-family: -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; max-width: 100%; background: rgb(255, 255, 255);&quot;&gt;&lt;div class=&quot;detail-desc-module&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; padding-top: 30px; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;div id=&quot;offer-title-1081181309894-1&quot; class=&quot;offer-title-wrapper&quot; data-module-id=&quot;1081181309894&quot; data-title=&quot;商品描述&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-right: 36px; margin-left: 36px; padding-top: 15px; padding-bottom: 15px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; align-items: center;&quot;&gt;&lt;div class=&quot;offer-title-icon&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; width: 4px; height: 13px; background: rgb(255, 64, 0); border-radius: 1px;&quot;&gt;&lt;/div&gt;&lt;div class=&quot;offer-title-content&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-left: 6px; outline: 0px; border: 0px; vertical-align: baseline; font-size: 14px; font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;product description&lt;/font&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;detail-description-content fd-editor&quot; id=&quot;detailContentContainer&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-right: auto; margin-left: auto; outline: 0px; border: 0px; vertical-align: baseline; width: 790px; min-height: 200px; overflow: hidden;&quot;&gt;&lt;div id=&quot;detail-notice-contanier-top&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;/div&gt;&lt;div class=&quot;content-detail&quot; data-spm=&quot;module-new-desc&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;div id=&quot;offer-template-0&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;/div&gt;&lt;div style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; width: 790px;&quot;&gt;&lt;img class=&quot;desc-img-loaded&quot; src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01C1RANo1jBdCpVrt7R_!!2215875804510-0-cib.jpg&quot; data-lazyload-src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01C1RANo1jBdCpVrt7R_!!2215875804510-0-cib.jpg&quot; usemap=&quot;#_sdmap_0&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; max-width: 790px; display: block; width: 790px; height: auto;&quot;&gt;&lt;img class=&quot;desc-img-loaded&quot; src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01yGfej61jBdCnEHeEe_!!2215875804510-0-cib.jpg&quot; data-lazyload-src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01yGfej61jBdCnEHeEe_!!2215875804510-0-cib.jpg&quot; usemap=&quot;#_sdmap_1&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; max-width: 790px; display: block; width: 790px; height: auto;&quot;&gt;&lt;img class=&quot;desc-img-loaded&quot; src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01AYAKI81jBdCnVMYBv_!!2215875804510-0-cib.jpg&quot; data-lazyload-src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01AYAKI81jBdCnVMYBv_!!2215875804510-0-cib.jpg&quot; usemap=&quot;#_sdmap_2&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; max-width: 790px; display: block; width: 790px; height: auto;&quot;&gt;&lt;img class=&quot;desc-img-loaded&quot; src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01VakwvW1jBdCkIuYLA_!!2215875804510-0-cib.jpg&quot; data-lazyload-src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01VakwvW1jBdCkIuYLA_!!2215875804510-0-cib.jpg&quot; usemap=&quot;#_sdmap_3&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; max-width: 790px; display: block; width: 790px; height: auto;&quot;&gt;&lt;img class=&quot;desc-img-loaded&quot; src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01nz85y31jBdCpVpTRs_!!2215875804510-0-cib.jpg&quot; data-lazyload-src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01nz85y31jBdCpVpTRs_!!2215875804510-0-cib.jpg&quot; usemap=&quot;#_sdmap_4&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; max-width: 790px; display: block; width: 790px; height: auto;&quot;&gt;&lt;img class=&quot;desc-img-loaded&quot; src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01hyqAjL1jBdCs2f1yD_!!2215875804510-0-cib.jpg&quot; data-lazyload-src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01hyqAjL1jBdCs2f1yD_!!2215875804510-0-cib.jpg&quot; usemap=&quot;#_sdmap_5&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; max-width: 790px; display: block; width: 790px; height: auto;&quot;&gt;&lt;img class=&quot;desc-img-loaded&quot; src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01d9wTeR1jBdCfoBHtF_!!2215875804510-0-cib.jpg&quot; data-lazyload-src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01d9wTeR1jBdCfoBHtF_!!2215875804510-0-cib.jpg&quot; usemap=&quot;#_sdmap_6&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; max-width: 790px; display: block; width: 790px; height: auto;&quot;&gt;&lt;img class=&quot;desc-img-loaded&quot; src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01x812bg1jBdCqKJcDy_!!2215875804510-0-cib.jpg&quot; data-lazyload-src=&quot;https://cbu01.alicdn.com/img/ibank/O1CN01x812bg1jBdCqKJcDy_!!2215875804510-0-cib.jpg&quot; usemap=&quot;#_sdmap_7&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; max-width: 790px; display: block; width: 790px; height: auto;&quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;div id=&quot;detail-notice-contanier-bottom&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-top: 20px; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;price-info-module&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; padding-top: 10px; padding-bottom: 20px; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;div id=&quot;offer-title-1081181309894-3&quot; class=&quot;offer-title-wrapper&quot; data-module-id=&quot;1081181309894&quot; data-title=&quot;价格说明&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-right: 36px; margin-left: 36px; padding-top: 15px; padding-bottom: 15px; outline: 0px; border: 0px; vertical-align: baseline; display: flex; align-items: center;&quot;&gt;&lt;div class=&quot;offer-title-icon&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; width: 4px; height: 13px; background: rgb(255, 64, 0); border-radius: 1px;&quot;&gt;&lt;/div&gt;&lt;div class=&quot;offer-title-content&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-left: 6px; outline: 0px; border: 0px; vertical-align: baseline; font-size: 14px; font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Price Description&lt;/font&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;price-info&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-left: 46px; outline: 0px; border: 0px; vertical-align: baseline; width: 790px;&quot;&gt;&lt;div class=&quot;price-info-content&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 10px; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;div class=&quot;price-info-text-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 10px; outline: 0px; border: 0px; vertical-align: baseline; display: inline; color: rgb(34, 34, 34); font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;[Price under platform activities]&lt;/font&gt;&lt;/div&gt;&lt;div class=&quot;price-info-text&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 5px; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(34, 34, 34);&quot;&gt;&lt;span class=&quot;price-info-text-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px 0px 10px; padding: 0px; outline: 0px; border: 0px; vertical-align: baseline; display: inline; font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Pre-event price:&lt;/font&gt;&lt;/span&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;&amp;nbsp;(1) In non-distribution scenarios, it refers to the sales price of goods before the warm-up period (if there is no warm-up period, then the outbreak period) of platform activities (activities excluding distribution scenarios)&amp;nbsp;&lt;/font&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;; (2) In distribution scenarios , specifically refers to&amp;nbsp;&lt;/font&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;the sales price of goods before the warm-up period of distribution activities (if there is no warm-up period, it is the outbreak period).&lt;/font&gt;&lt;/div&gt;&lt;div class=&quot;price-info-text&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 5px; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(34, 34, 34);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;The aforementioned prices do not include various purchasing allowances, cross-store coupons, red envelopes and other discounts issued by the platform, and do not include full discounts, coupons, store rebates, store membership discounts and L member prices set by the merchant, and designated group orders set by the merchant. product promotions and other discounts; the price will be calculated into various discounts under other non-platform activities (including single product discounts for non-designated groups set by the merchant, etc., which are ultimately subject to the merchant&#039;s own settings). The aforementioned product sales price refers to the price displayed on the product page on that day; if the merchant adjusts the sales price multiple times on that day, the last sales price displayed on that day will be used.&lt;/font&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;price-info-content&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 10px; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;div class=&quot;price-info-text-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 10px; outline: 0px; border: 0px; vertical-align: baseline; display: inline; color: rgb(34, 34, 34); font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;[Price under non-platform activities]&lt;/font&gt;&lt;/div&gt;&lt;div class=&quot;price-info-text&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 5px; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(34, 34, 34);&quot;&gt;&lt;span class=&quot;price-info-text-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px 0px 10px; padding: 0px; outline: 0px; border: 0px; vertical-align: baseline; display: inline; font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Underlined price:&lt;/font&gt;&lt;/span&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;&amp;nbsp;refers to the product price in the scenario of the merchant&#039;s self-marketing activities. This price does not include various preferential activities of the platform. It may be the sales guide price of the product or the previously displayed sales price of the product, etc. It is not the original price and is for reference only.&lt;/font&gt;&lt;/div&gt;&lt;div class=&quot;price-info-text&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 5px; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(34, 34, 34);&quot;&gt;&lt;span class=&quot;price-info-text-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px 0px 10px; padding: 0px; outline: 0px; border: 0px; vertical-align: baseline; display: inline; font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;Uncrossed price:&lt;/font&gt;&lt;/span&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;&amp;nbsp;The sales price of the product is set by the merchant on the 1688 platform. The specific transaction price changes according to various preferential activities set by the merchant, and the final price is based on the price on the order settlement page.&lt;/font&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;price-info-content&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 10px; outline: 0px; border: 0px; vertical-align: baseline;&quot;&gt;&lt;div class=&quot;price-info-text-name&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 10px; outline: 0px; border: 0px; vertical-align: baseline; display: inline; color: rgb(34, 34, 34); font-weight: 700;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;【Release price】&lt;/font&gt;&lt;/div&gt;&lt;div class=&quot;price-info-text&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin-bottom: 5px; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(34, 34, 34);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;It refers to the price of the product after the sales price set by the merchant on the 1688 platform and the L member price discount is added. It is not the original price and is for reference only.&lt;/font&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;price-info-notes&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; display: flex; flex-direction: row;&quot;&gt;&lt;span class=&quot;price-in-text-left&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(255, 115, 0); text-wrap: nowrap;&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;*Note:&lt;/font&gt;&lt;/span&gt;&lt;div class=&quot;price-in-content&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; flex: 1 1 0%;&quot;&gt;&lt;div class=&quot;price-in-text&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(255, 115, 0);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;1. The above description only applies to price comparison scenarios.&lt;/font&gt;&lt;/div&gt;&lt;div class=&quot;price-in-text&quot; style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; outline: 0px; border: 0px; vertical-align: baseline; color: rgb(255, 115, 0);&quot;&gt;&lt;font style=&quot;text-size-adjust: 100%; -webkit-tap-highlight-color: transparent; margin: 0px; padding: 0px; outline: 0px; border: 0px; vertical-align: inherit;&quot;&gt;2. The time before the event is usually the day before the warm-up period/outbreak period. However, due to the delay of data, the price collection time may change. The specific time displayed above and the corresponding product price shall prevail.&lt;/font&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;</textarea>
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
                                                    <div class="input-group" data-toggle="aizuploader">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                        <div class="form-control file-amount">Choose File</div>
                                                        <input type="hidden" name="pdf" value="" class="selected-files">
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
                                                <label class="col-lg-3 col-from-label">Meta Title</label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="meta_title" value="COCO genuine perfume lady long-lasting fresh light fragrance student cocoa fragrance 100ml" placeholder="Meta Title">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-from-label">Description</label>
                                                <div class="col-lg-8">
                                                    <textarea name="meta_description" rows="8" class="form-control">Product attributesBrand typeDomestic brandsWhether to importnobrandDRINKFor peopleMissfragranceVetiver, bergamot, freesia, benzoin, oudFragranceFruitySpecificationNormal specificationsAroma rate7-12%special purpose cosmeticsnoOriginZhejiangshelf life60 monthssort by colorblack cocoaWhether to provide exclusive supply for cross-border exportsyesnet weight100mlNon-special cosmetics registration certificate numberZhejiang G makeup network preparation number 2021010454Main sales areasSouth America, North America, Middle Eastproduct namecocoaproduct descriptionPrice Description[Price under platform activities]Pre-event price:&amp;nbsp;(1) In non-distribution scenarios, it refers to the sales price of goods before the warm-up period (if there is no warm-up period, then the outbreak period) of platform activities (activities excluding distribution scenarios)&amp;nbsp;; (2) In distribution scenarios , specifically refers to&amp;nbsp;the sales price of goods before the warm-up period of distribution activities (if there is no warm-up period, it is the outbreak period).The aforementioned prices do not include various purchasing allowances, cross-store coupons, red envelopes and other discounts issued by the platform, and do not include full discounts, coupons, store rebates, store membership discounts and L member prices set by the merchant, and designated group orders set by the merchant. product promotions and other discounts; the price will be calculated into various discounts under other non-platform activities (including single product discounts for non-designated groups set by the merchant, etc., which are ultimately subject to the merchant&#039;s own settings). The aforementioned product sales price refers to the price displayed on the product page on that day; if the merchant adjusts the sales price multiple times on that day, the last sales price displayed on that day will be used.[Price under non-platform activities]Underlined price:&amp;nbsp;refers to the product price in the scenario of the merchant&#039;s self-marketing activities. This price does not include various preferential activities of the platform. It may be the sales guide price of the product or the previously displayed sales price of the product, etc. It is not the original price and is for reference only.Uncrossed price:&amp;nbsp;The sales price of the product is set by the merchant on the 1688 platform. The specific transaction price changes according to various preferential activities set by the merchant, and the final price is based on the price on the order settlement page.【Release price】It refers to the price of the product after the sales price set by the merchant on the 1688 platform and the L member price discount is added. It is not the original price and is for reference only.*Note:1. The above description only applies to price comparison scenarios.2. The time before the event is usually the day before the warm-up period/outbreak period. However, due to the delay of data, the price collection time may change. The specific time displayed above and the corresponding product price shall prevail.</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label" for="signinSrEmail">Meta Images</label>
                                                <div class="col-md-8">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                        <div class="form-control file-amount">Choose File</div>
                                                        <input type="hidden" name="meta_img" value="42396" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Slug</label>
                                                <div class="col-md-8">
                                                    <input type="text" placeholder="Slug" id="slug" name="slug" value="coco-genuine-perfume-lady-long-lasting-fresh-light-fragrance-student-cocoa-fragrance-100ml-7srz8-pbh75" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6" class="dropdown-toggle" data-toggle="collapse" data-target="#collapse_2">
                                                Shipping Configuration
                                            </h5>
                                        </div>
                                        <div class="card-body collapse show" id="collapse_2">
                                            <p>
                                                Product wise shipping cost is disable. Shipping cost is configured from here
                                                <a href="/admin/shipping_configuration" class="aiz-side-nav-link ">
                                                    <span class="aiz-side-nav-text">Shipping Configuration</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">Low Stock Quantity Warning</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label for="name">
                                                    Quantity
                                                </label>
                                                <input type="number" name="low_stock_quantity" value="1" min="0" step="1" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">
                                                Stock Visibility State
                                            </h5>
                                        </div>

                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-md-6 col-from-label">Show Stock Quantity</label>
                                                <div class="col-md-6">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input type="radio" name="stock_visibility_state" value="quantity" checked>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-6 col-from-label">Show Stock With Text Only</label>
                                                <div class="col-md-6">
                                                    <label class="aiz-switch aiz-switch-success mb-0">
                                                        <input type="radio" name="stock_visibility_state" value="text">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-6 col-from-label">Hide Stock</label>
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
                                            <h5 class="mb-0 h6">Cash on Delivery</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-6 col-from-label">Status</label>
                                                        <div class="col-md-6">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" name="cash_on_delivery" value="1" checked>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">Featured</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-6 col-from-label">Status</label>
                                                        <div class="col-md-6">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" name="featured" value="1">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">Todays Deal</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-6 col-from-label">Status</label>
                                                        <div class="col-md-6">
                                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                                <input type="checkbox" name="todays_deal" value="1">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0 h6">Flash Deal</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label for="name">
                                                    Add To Flash
                                                </label>
                                                <select class="form-control aiz-selectpicker" name="flash_deal_id" id="video_provider">
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
                                                <select class="form-control aiz-selectpicker" name="flash_discount_type" id="">
                                                    <option value="">Choose Discount Type</option>
                                                    <option value="amount" selected>
                                                        Flat
                                                    </option>
                                                    <option value="percent">
                                                        Percent
                                                    </option>
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
                                                    <input type="number" class="form-control" name="est_shipping_days" value="" min="1" step="1" placeholder="Shipping Days">
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
                                                        <option value="amount">
                                                            Flat
                                                        </option>
                                                        <option value="percent">
                                                            Percent
                                                        </option>
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
                                                        <option value="amount">
                                                            Flat
                                                        </option>
                                                        <option value="percent">
                                                            Percent
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="mb-3 text-right">
                                        <button type="submit" name="button" class="btn btn-info">Update Product</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; Gmarket Viet Nam v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->



    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>



    <script type="text/javascript">
        $(document).ready(function() {
            show_hide_shipping_div();
        });

        $("[name=shipping_type]").on("change", function() {
            show_hide_shipping_div();
        });

        function show_hide_shipping_div() {
            var shipping_val = $("[name=shipping_type]:checked").val();

            $(".flat_rate_shipping_div").hide();

            if (shipping_val == 'flat_rate') {
                $(".flat_rate_shipping_div").show();
            }
        }

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

        function delete_row(em) {
            $(em).closest('.form-group').remove();
            update_sku();
        }

        function delete_variant(em) {
            $(em).closest('.variant').remove();
        }

        function update_sku() {
            $.ajax({
                type: "POST",
                url: '/admin/products/sku_combination_edit',
                data: $('#choice_form').serialize(),
                success: function(data) {
                    $('#sku_combination').html(data);
                    setTimeout(() => {
                        AIZ.uploader.previewGenerate();
                    }, "500");
                    AIZ.plugins.fooTable();
                    if (data.length > 1) {
                        $('#show-hide-div').hide();
                    } else {
                        $('#show-hide-div').show();
                    }
                }
            });
        }

        AIZ.plugins.tagify();

        $(document).ready(function() {
            update_sku();

            $('.remove-files').on('click', function() {
                $(this).parents(".col-md-4").remove();
            });
        });

        $('#choice_attributes').on('change', function() {
            $.each($("#choice_attributes option:selected"), function(j, attribute) {
                flag = false;
                $('input[name="choice_no[]"]').each(function(i, choice_no) {
                    if ($(attribute).val() == $(choice_no).val()) {
                        flag = true;
                    }
                });
                if (!flag) {
                    add_more_customer_choice_option($(attribute).val(), $(attribute).text());
                }
            });

            var str = [];

            $.each(str, function(index, value) {
                flag = false;
                $.each($("#choice_attributes option:selected"), function(j, attribute) {
                    if (value == $(attribute).val()) {
                        flag = true;
                    }
                });
                if (!flag) {
                    $('input[name="choice_no[]"][value="' + value + '"]').parent().parent().remove();
                }
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