<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");


if(!isset($_GET['id']) && $_GET['id']=="")die();

$brand=fetch_array("SELECT * FROM brands WHERE id='{$_GET['id']}'");
if(!$brand)die();
?>


<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="uru77TLXUqC5gadmXR2hk7A8xmGFZBb5CBLXAIhp">
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
                        <h5 class="mb-0 h6">Brand Information</h5>
                    </div>

                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body p-0">
                                <ul class="nav nav-tabs nav-fill border-light">
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  active  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=en">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/en.png" height="11" class="mr-1">
                                            <span>English</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=cn">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/cn.png" height="11" class="mr-1">
                                            <span>中文</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=kr">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/kr.png" height="11" class="mr-1">
                                            <span>Korea</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=ru">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/ru.png" height="11" class="mr-1">
                                            <span>Russia</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=in">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/in.png" height="11" class="mr-1">
                                            <span>India</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=ae">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/ae.png" height="11" class="mr-1">
                                            <span>UAE</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=jp">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/jp.png" height="11" class="mr-1">
                                            <span>Japan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=th">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/th.png" height="11" class="mr-1">
                                            <span>Thailand</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=br">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/br.png" height="11" class="mr-1">
                                            <span>Brazil</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=vn">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/vn.png" height="11" class="mr-1">
                                            <span>Vietnam</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=sg">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/sg.png" height="11" class="mr-1">
                                            <span>Singapore</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=my">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/my.png" height="11" class="mr-1">
                                            <span>Malaysia</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=fr">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/fr.png" height="11" class="mr-1">
                                            <span>France</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="https://tmdtquocte.com/admin/brands/edit/11?lang=de">
                                            <img src="https://tmdtquocte.com/public/assets/img/flags/de.png" height="11" class="mr-1">
                                            <span>Germany</span>
                                        </a>
                                    </li>
                                </ul>
                                <?php 
                                if(isset($_POST['submit'])){
                                    $id=$_GET['id'];
                                    $name=$_POST['name'];
                                    $logo=$_POST['logo'];
                                    $meta_title=$_POST['meta_title'];
                                    $meta_description=$_POST['meta_description'];
                                    $path=$_POST['slug'];


                                    $img=mysqli_query($conn,"SELECT src FROM file WHERE id=$logo LIMIT 1")['src'];
                                    @mysqli_query($conn,"UPDATE brands SET name='$name',logo='$img',title='$meta_description',desciption='$meta_description',path='$path' WHERE id=$id");
                                    echo "<script>AIZ.plugins.notify('success', 'Tải lên thành công');</script>";



                                }
                                ?>
                                <form class="p-4" action="" method="POST" enctype="multipart/form-data">
                                    <input name="_method" type="hidden" value="PATCH">
                                    <input type="hidden" name="lang" value="en">
                                    <input type="hidden" name="_token" value="uru77TLXUqC5gadmXR2hk7A8xmGFZBb5CBLXAIhp">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="name">Name <i class="las la-language text-danger" title="Translatable"></i></label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Name" id="name" name="name" value="<?=$brand['name']?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="signinSrEmail">Logo <small>(120x80)</small></label>
                                        <div class="col-md-9">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <input type="hidden" name="logo" value="<?=$brand['id']?>" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label">Meta Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="meta_title" value="<?=$brand['title']?>" placeholder="Meta Title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label">Meta description</label>
                                        <div class="col-sm-9">
                                            <textarea name="meta_description" rows="8" class="form-control"><?=$brand['description']?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="name">Slug</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Slug" id="slug" name="slug" value="<?=$brand['path']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
                        _token: 'uru77TLXUqC5gadmXR2hk7A8xmGFZBb5CBLXAIhp',
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