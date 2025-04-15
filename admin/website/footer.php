<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /");
$setting=fetch_array("SELECT * FROM website_footer LIMIT 1");
?>

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

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="h3">Website Footer</h1>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-fill border-light" style="display:none">
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=en">
                                <img src="/public/assets/img/flags/en.png" height="11" class="mr-1">
                                <span>English</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=cn">
                                <img src="/public/assets/img/flags/cn.png" height="11" class="mr-1">
                                <span>中文</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=kr">
                                <img src="/public/assets/img/flags/kr.png" height="11" class="mr-1">
                                <span>Korea</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=ru">
                                <img src="/public/assets/img/flags/ru.png" height="11" class="mr-1">
                                <span>Russia</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=in">
                                <img src="/public/assets/img/flags/in.png" height="11" class="mr-1">
                                <span>India</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=ae">
                                <img src="/public/assets/img/flags/ae.png" height="11" class="mr-1">
                                <span>UAE</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=jp">
                                <img src="/public/assets/img/flags/jp.png" height="11" class="mr-1">
                                <span>Japan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=th">
                                <img src="/public/assets/img/flags/th.png" height="11" class="mr-1">
                                <span>Thailand</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=br">
                                <img src="/public/assets/img/flags/br.png" height="11" class="mr-1">
                                <span>Brazil</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=vn">
                                <img src="/public/assets/img/flags/vn.png" height="11" class="mr-1">
                                <span>Vietnam</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=sg">
                                <img src="/public/assets/img/flags/sg.png" height="11" class="mr-1">
                                <span>Singapore</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=my">
                                <img src="/public/assets/img/flags/my.png" height="11" class="mr-1">
                                <span>Malaysia</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=fr">
                                <img src="/public/assets/img/flags/fr.png" height="11" class="mr-1">
                                <span>France</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset  bg-soft-dark border-light border-left-0  py-3" href="/admin/website/footer.php?lang=de">
                                <img src="/public/assets/img/flags/de.png" height="11" class="mr-1">
                                <span>Germany</span>
                            </a>
                        </li>
                    </ul>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="fw-600 mb-0">Footer Widget</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gutters-10">
                                <div class="col-lg-6">
                                    <div class="card shadow-none bg-light">
                                        <div class="card-header">
                                            <h6 class="mb-0">About Widget</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            if(isset($_POST['save1'])){
                                                $logo=$_POST['footer_logo'];
                                                $description=$_POST['about_us_description'];
                                                $play_store_link=$_POST['play_store_link'];
                                                $app_store_link=$_POST['app_store_link'];

                                                @mysqli_query($conn,"UPDATE website_footer SET logo='$logo',description='$description',play_store_link='$play_store_link',app_store_link='$app_store_link'");
                                                echo "<script>window.location.href=''</script>";



                                            }
                                            ?>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                                <div class="form-group">
                                                    <label class="form-label" for="signinSrEmail">Footer Logo</label>
                                                    <div class="input-group " data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                        </div>
                                                        <div class="form-control file-amount">Choose File</div>
                                                        <input type="hidden" name="types[]" value="footer_logo">
                                                        <input type="hidden" name="footer_logo" class="selected-files" value="<?=$setting['logo']?>">
                                                    </div>
                                                    <div class="file-preview"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>About description (Translatable)</label>
                                                    <input type="hidden" name="types[][]" value="about_us_description">
                                                    <textarea class="aiz-text-editor form-control" name="about_us_description" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150"><?=$setting['description']?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Play Store Link</label>
                                                    <!-- <input type="hidden" name="types[]" value="play_store_link"> -->
                                                    <input type="text" class="form-control" placeholder="http://" name="play_store_link" value="<?=$setting['play_store_link']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>App Store Link</label>
                                                    <!-- <input type="hidden" name="types[]" value="app_store_link"> -->
                                                    <input type="text" class="form-control" placeholder="http://" name="app_store_link" value="<?=$setting['app_store_link']?>">
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit"  name="save1"class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card shadow-none bg-light">
                                        <div class="card-header">
                                            <h6 class="mb-0">Contact Info Widget</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            if(isset($_POST['save2'])){
                                                $contact_address=$_POST['contact_address'];
                                                $contact_phone=$_POST['contact_phone'];
                                                $contact_email=$_POST['contact_email'];
                                                @mysqli_query($conn,"UPDATE website_footer SET contact_address='$contact_address',contact_phone='$contact_phone',contact_email='$contact_email'");
                                                echo "<script>window.location.href=''</script>";



                                            }
                                            ?>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                                <div class="form-group">
                                                    <label>Contact address (Translatable)</label>
                                                    <!-- <input type="hidden" name="types[][]" value="contact_address"> -->
                                                    <input type="text" class="form-control" placeholder="Address" name="contact_address" value="<?=$setting['contact_address']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact phone</label>
                                                    <!-- <input type="hidden" name="types[]" value="contact_phone"> -->
                                                    <input type="text" class="form-control" placeholder="Phone" name="contact_phone" value="<?=$setting['contact_phone']?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact email</label>
                                                    <!-- <input type="hidden" name="types[]" value="contact_email"> -->
                                                    <input type="text" class="form-control" placeholder="Email" name="contact_email" value="<?=$setting['contact_email']?>">
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary" name="save2">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card shadow-none bg-light">
                                        <div class="card-header">
                                            <h6 class="mb-0">Link Widget One</h6>
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                                <div class="form-group">
                                                    <label>Title (Translatable)</label>
                                                    <input type="hidden" name="types[][]" value="widget_one">
                                                    <input type="text" class="form-control" placeholder="Widget title" name="widget_one" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Links - (Translatable Label)</label>
                                                    <div class="w3-links-target">
                                                        <input type="hidden" name="types[][]" value="widget_one_labels">
                                                        <input type="hidden" name="types[]" value="widget_one_links">
                                                    </div>
                                                    <button
                                                        type="button"
                                                        class="btn btn-soft-secondary btn-sm"
                                                        data-toggle="add-more"
                                                        data-content='<div class="row gutters-5">
    										<div class="col-4">
    											<div class="form-group">
    												<input type="text" class="form-control" placeholder="Label" name="widget_one_labels[]">
    											</div>
    										</div>
    										<div class="col">
    											<div class="form-group">
    												<input type="text" class="form-control" placeholder="http://" name="widget_one_links[]">
    											</div>
    										</div>
    										<div class="col-auto">
    											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
    												<i class="las la-times"></i>
    											</button>
    										</div>
    									</div>'
                                                        data-target=".w3-links-target">
                                                        Add New
                                                    </button>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary" name="save3">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="fw-600 mb-0">Footer Bottom</h6>
                        </div>
                        <?php
                        if(isset($_POST['save4'])){
                            $payment_methods=$_POST['payment_methods'];
                            $facebook_url=$_POST['facebook_url'];
                            $twitter_url=$_POST['twitter_url'];
                            $instagram_url=$_POST['instagram_url'];
                            $youtube_url=$_POST['youtube_url'];
                            $linkedin_url=$_POST['linkedin_url'];


                            @mysqli_query($conn,"UPDATE website_footer SET facebook_url='$facebook_url',twitter_url='$twitter_url',youtube_url='$youtube_url',linkedin_url='$linkedin_url',instagram_url='$instagram_url',payment_methods='$payment_methods'");
                            echo "<script>window.location.href=''</script>";



                                            }
                                            ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                            <div class="card-body">
                                <div class="card shadow-none bg-light">
                                    <div class="card-header">
                                        <h6 class="mb-0">Copyright Widget</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Copyright Text (Translatable)</label>
                                            <input type="hidden" name="types[][]" value="frontend_copyright_text">
                                            <textarea class="aiz-text-editor form-control" name="frontend_copyright_text" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">

                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none bg-light">
                                    <div class="card-header">
                                        <h6 class="mb-0">Social Link Widget</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-from-label">Show Social Links?</label>
                                            <div class="col-md-9">
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input type="hidden" name="types[]" value="show_social_links">
                                                    <input type="checkbox" name="show_social_links" checked>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Social Links</label>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="lab la-facebook-f"></i></span>
                                                </div>
                                                <!-- <input type="hidden" name="types[]" value="facebook_url"> -->
                                                <input type="text" class="form-control" placeholder="http://" name="facebook_url" value="<?=$setting['facebook_url']?>">
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="lab la-twitter"></i></span>
                                                </div>
                                                <!-- <input type="hidden" name="types[]" value="twitter_url"> -->
                                                <input type="text" class="form-control" placeholder="http://" name="twitter_url" value="<?=$setting['twitter_url']?>">
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="lab la-instagram"></i></span>
                                                </div>
                                                <!-- <input type="hidden" name="types[]" value="instagram_url"> -->
                                                <input type="text" class="form-control" placeholder="http://" name="instagram_url" value="<?=$setting['instagram_url']?>">
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="lab la-youtube"></i></span>
                                                </div>
                                                <!-- <input type="hidden" name="types[]" value="youtube_url"> -->
                                                <input type="text" class="form-control" placeholder="http://" name="youtube_url" value="<?=$setting['youtube_url']?>">
                                            </div>
                                            <div class="input-group form-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="lab la-linkedin-in"></i></span>
                                                </div>
                                                <!-- <input type="hidden" name="types[]" value="linkedin_url"> -->
                                                <input type="text" class="form-control" placeholder="http://" name="linkedin_url" value="<?=$setting['linkedin_url']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow-none bg-light">
                                    <div class="card-header">
                                        <h6 class="mb-0">Payment Methods Widget</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Payment Methods</label>
                                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <!-- <input type="hidden" name="types[]" value="payment_methods"> -->
                                                <input type="hidden" name="payment_methods" class="selected-files" value="<?=$setting['payment_methods']?>">
                                            </div>
                                            <div class="file-preview box sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" name="save4">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; Takashimaya v7.4.0</p>
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