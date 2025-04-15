<?php include("../../config.php");
if (!$isLogin || !$isAdmin) header("Location: /"); 
$seller_setting=fetch_array("SELECT * FROM seller_setting LIMIT 1");

?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT">
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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 h6 text-center">Seller Commission Activatation</h3>
                                </div>
                                <div class="card-body text-center">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" onchange="updateSettings(this, 'commission_active')" <?=$seller_setting["commission_active"]=="1"?"checked":""?> >
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 h6 text-center">Category Based Commission</h3>
                                </div>
                                <div class="card-body text-center">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" onchange="updateSettings(this, 'category_wise_commission')" <?=$seller_setting["category_wise_commission"]=="1"?"checked":""?> >
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Seller Commission</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if(isset($_POST['save1'])){
                                        $vendor_commission=$_POST['vendor_commission'];
                                        @mysqli_query($conn,"UPDATE seller_setting SET commission='$vendor_commission' ");
                                        echo "<script>window.location.href=''</script>";
                                    }
                                    ?>
                                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-from-label">Seller Commission</label>
                                            <div class="col-md-8">
                                                <!-- <input type="hidden" name="types[]" value="vendor_commission"> -->
                                                <div class="input-group">
                                                    <input type="number" lang="en" min="0" step="0.01" value="<?=$seller_setting['commission']?>" placeholder="Seller Commission" name="vendor_commission" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 text-right">
                                            <button type="submit" class="btn btn-primary" name="save1">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Note</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item text-muted">
                                            1. 18% of seller product price will be deducted from seller earnings.
                                        </li>
                                        <li class="list-group-item text-muted">
                                            2. If Category Based Commission is enbaled, Set seller commission percentage 0..
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Withdraw Seller Amount</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if(isset($_POST['save2'])){
                                        $minimum_seller_amount_withdraw=$_POST['minimum_seller_amount_withdraw'];
                                        @mysqli_query($conn,"UPDATE seller_setting SET min_withdraw='$minimum_seller_amount_withdraw' ");
                                        echo "<script>window.location.href=''</script>";
                                    }
                                    ?>
                                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-from-label">Minimum Seller Amount Withdraw</label>
                                            <div class="col-md-8">
                                                <!-- <input type="hidden" name="types[]" value="minimum_seller_amount_withdraw"> -->
                                                <div class="input-group">
                                                    <input type="number" lang="en" min="0" step="0.01" value="<?=$seller_setting['min_withdraw']?>" placeholder="Minimum Seller Amount Withdraw" name="minimum_seller_amount_withdraw" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 text-right">
                                            <button type="submit" class="btn btn-primary" name="save2">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0"></p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->



    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
        function updateSettings(el, type) {
            if ($(el).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }

            // $.post('/admin/business-settings/update/activation', {
            $.post('/admin/sellers/business_active.php', {

                _token: 'ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT',
                type: type,
                value: value
            }, function(data) {
                if (data == '1') {
                    AIZ.plugins.notify('success', 'Settings updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
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
                        _token: 'ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT',
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