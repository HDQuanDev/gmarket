<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");

if(!isset($_GET['id']) || $_GET['id']=='')die();

$t=fetch_array("SELECT * FROM through_trains WHERE id='{$_GET['id']}' LIMIT 1" );

if(!$t)die();


?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="XuoZ4GhCuke85ZgiUSBsuFcCY7mJDgio6H80JeU9">
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
                    <div class="aiz-titlebar mt-2 mb-3">
                        <h5 class="mb-0 h6">Update Package Information</h5>
                    </div>

                    <div class="col-lg-10 mx-auto">
                        <div class="card">
                            <div class="card-body p-0" >
                                <ul class="nav nav-tabs nav-fill border-light " style="display:none">
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  active  py-3" href="/admin/seller_through_train/edit/7?lang=en">
                                            <img src="/public/assets/img/flags/en.png" height="11" class="mr-1">
                                            <span>English</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=cn">
                                            <img src="/public/assets/img/flags/cn.png" height="11" class="mr-1">
                                            <span>中文</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=kr">
                                            <img src="/public/assets/img/flags/kr.png" height="11" class="mr-1">
                                            <span>Korea</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=ru">
                                            <img src="/public/assets/img/flags/ru.png" height="11" class="mr-1">
                                            <span>Russia</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=in">
                                            <img src="/public/assets/img/flags/in.png" height="11" class="mr-1">
                                            <span>India</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=ae">
                                            <img src="/public/assets/img/flags/ae.png" height="11" class="mr-1">
                                            <span>UAE</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=jp">
                                            <img src="/public/assets/img/flags/jp.png" height="11" class="mr-1">
                                            <span>Japan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=th">
                                            <img src="/public/assets/img/flags/th.png" height="11" class="mr-1">
                                            <span>Thailand</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=br">
                                            <img src="/public/assets/img/flags/br.png" height="11" class="mr-1">
                                            <span>Brazil</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=vn">
                                            <img src="/public/assets/img/flags/vn.png" height="11" class="mr-1">
                                            <span>Vietnam</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=sg">
                                            <img src="/public/assets/img/flags/sg.png" height="11" class="mr-1">
                                            <span>Singapore</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=my">
                                            <img src="/public/assets/img/flags/my.png" height="11" class="mr-1">
                                            <span>Malaysia</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=fr">
                                            <img src="/public/assets/img/flags/fr.png" height="11" class="mr-1">
                                            <span>France</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/seller_through_train/edit/7?lang=de">
                                            <img src="/public/assets/img/flags/de.png" height="11" class="mr-1">
                                            <span>Germany</span>
                                        </a>
                                    </li>
                                </ul>
                                <?php
                                if(isset($_POST['submit'])){
                                    $amount=$_POST['amount'];
                                    $people=$_POST['people'];
                                    $name=$_POST['name'];
                                    $duration=$_POST['duration'];
                                    $logo=$_POST['logo'];
                                    @mysqli_query($conn,"UPDATE through_trains SET logo='$logo',people='$people',duration='$duration',name='$name',amount='$amount' WHERE id='{$_GET['id']}'");
                                    echo "<script>window.location.href=''</script>";

                                }
                                ?>
                                <form class="p-4" action="" method="POST">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="lang" value="en">
                                    <input type="hidden" name="_token" value="XuoZ4GhCuke85ZgiUSBsuFcCY7mJDgio6H80JeU9">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-from-label" for="name">Package Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Name" value="<?=$t['name']?>" id="name" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-from-label" for="amount">Amount</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="0.01" placeholder="Amount" value="<?=$t['amount']?>" id="amount" name="amount" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-from-label" for="people">People Reached</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="1" placeholder="People Reached" value="<?=$t['people']?>" id="people" name="people" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-from-label" for="duration">Duration</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="1" placeholder="Validity in number of days" value="<?=$t['duration']?>" id="duration" name="duration" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="signinSrEmail">Package Logo</label>
                                        <div class="col-md-10">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <input type="hidden" name="logo" value="<?=$t['logo']?>" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="submit" class="btn btn-sm btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
                        _token: 'XuoZ4GhCuke85ZgiUSBsuFcCY7mJDgio6H80JeU9',
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