
<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /");
$website=fetch_array("SELECT * FROM website_appearance LIMIT 1");
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

                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="fw-600 mb-0"><?=tran("General")?></h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if(isset($_POST['general'])){

                                            $website_name=$_POST['website_name'];
                                            $site_motto=$_POST['site_motto'];
                                            $base_color=$_POST['base_color'];
                                            $base_hover_color=$_POST['base_hover_color'];

                                            $site_icon=$_POST['site_icon'];
                                            $referal_code=$_POST['referal_code'];

                                            
                                            @mysqli_query($conn,"UPDATE website_appearance SET referal_code='$referal_code',site_icon='$site_icon',base_hover_color='$base_hover_color',base_color='$base_color',site_motto='$site_motto',website_name='$website_name' ");
                                            echo "<script>window.location.href=''</script>";


                                        }
                                    ?>
                                    <form action="" method="POST">
                                        <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Frontend Website Name")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="website_name">
                                                <input type="text" name="website_name" class="form-control" placeholder="<?=tran("Website Name")?>" value="<?=$website['website_name']?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("INVITE CODE")?></label>
                                            <div class="col-md-8">
                                                <input type="text" name="referal_code" class="form-control" placeholder="Website Name" value="<?=$website['referal_code']?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Site Motto")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="site_motto">
                                                <input type="text" name="site_motto" class="form-control" placeholder="Best eCommerce Website" value="<?=$website['site_motto']?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Site Icon")?></label>
                                            <div class="col-md-8">
                                                <div class="input-group " data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary"><?=tran("Browse")?></div>
                                                    </div>
                                                    <div class="form-control file-amount"><?=tran("Choose File")?></div>
                                                    <input type="hidden" name="types[]" value="site_icon">
                                                    <input type="hidden" name="site_icon" value="<?=$website['site_icon']?>" class="selected-files">
                                                </div>
                                                <div class="file-preview box"></div>
                                                <small class="text-muted">Website favicon. 32x32 .png</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Website Base Color")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="base_color">
                                                <input type="text" name="base_color" class="form-control" placeholder="#377dff" value="#00c01e">
                                                <small class="text-muted"><?=tran("Hex Color Code")?></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Website Base Hover Color")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="base_hover_color">
                                                <input type="text" name="base_hover_color" class="form-control" placeholder="#377dff" value="#00c01e">
                                                <small class="text-muted"><?=tran("Hex Color Code")?></small>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary" name="general"><?=tran("Update")?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="fw-600 mb-0"><?=tran("Global SEO")?></h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if(isset($_POST['global_seo'])){

                                            $meta_title=$_POST['meta_title'];
                                            $meta_description=$_POST['meta_description'];
                                            $meta_keywords=$_POST['keywords'];
                                            $meta_image=$_POST['meta_image'];

                                            
                                            @mysqli_query($conn,"UPDATE website_appearance SET meta_image='$meta_image',keywords='$meta_keywords',meta_description='$meta_description',meta_title='$meta_title' ");
                                            echo "<script>window.location.href=''</script>";


                                        }
                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Meta Title")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="meta_title">
                                                <input type="text" class="form-control" placeholder="Title" name="meta_title" value="<?=$website['meta_title']?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Meta description")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="meta_description">
                                                <textarea class="resize-off form-control" placeholder="Description" name="meta_description"><?=$website['meta_description']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Keywords")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="meta_keywords">
                                                <textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="meta_keywords"><?=$website['keywords']?></textarea>
                                                <small class="text-muted"><?=tran("Separate with coma")?></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Meta Image")?></label>
                                            <div class="col-md-8">
                                                <div class="input-group " data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary"><?=tran("Browse")?></div>
                                                    </div>
                                                    <div class="form-control file-amount"><?=tran("Choose File")?></div>
                                                    <input type="hidden" name="types[]" value="meta_image">
                                                    <input type="hidden" name="meta_image" value="<?=$website['meta_image']?>" class="selected-files">
                                                </div>
                                                <div class="file-preview box"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="global_seo" class="btn btn-primary"><?=tran("Update")?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="fw-600 mb-0"><?=tran("Cookies Agreement")?></h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if(isset($_POST['cookie_agreement'])){
                                            $show_cookies_agreement=isset($_POST['show_cookies_agreement'])?"1":"0";

                                            $cookies_agreement_text=$_POST['cookies_agreement_text'];
                                            @mysqli_query($conn,"UPDATE website_appearance SET show_cookies_agreement='$show_cookies_agreement',cookies_agreement_text='$cookies_agreement_text' ");
                                            echo "<script>window.location.href=''</script>";


                                        }
                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Cookies Agreement Text")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="cookies_agreement_text">
                                                <textarea name="cookies_agreement_text" rows="4" class="aiz-text-editor form-control" data-buttons='[["font", ["bold"]],["insert", ["link"]]]'><?=$website['cookies_agreement_text']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Show Cookies Agreement")?>?</label>
                                            <div class="col-md-8">
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input type="hidden" name="types[]" value="show_cookies_agreement">
                                                    <input type="checkbox" name="show_cookies_agreement" <?=$website["show_cookies_agreement"]=='1'?"checked":""?> >
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="cookie_agreement" class="btn btn-primary"><?=tran("Update")?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="fw-600 mb-0">Website Popup</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if(isset($_POST['website_popup'])){
                                            $show_website_popup=isset($_POST['show_website_popup'])?"1":"0";
                                            $show_subscriber_form=isset($_POST['show_subscriber_form'])?"1":"0";

                                            $website_popup_content=$_POST['website_popup_content'];
                                            @mysqli_query($conn,"UPDATE website_appearance SET popup_content='$website_popup_content',show_website_popup='$show_website_popup',show_subscriber_form='$show_subscriber_form' ");
                                             echo "<script>window.location.href=''</script>";


                                        }
                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Show website popup")?>?</label>
                                            <div class="col-md-8">
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input type="hidden" name="types[]" value="show_website_popup">
                                                    <input type="checkbox" name="show_website_popup" <?=$website["show_website_popup"]=='1'?"checked":""?>     >
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Popup content")?></label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="website_popup_content">
                                                <textarea name="website_popup_content" rows="4" class="aiz-text-editor form-control"><?=$website['popup_content']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Show Subscriber form")?>?</label>
                                            <div class="col-md-8">
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input type="hidden" name="types[]" value="show_subscriber_form">
                                                    <input type="checkbox" name="show_subscriber_form" <?=$website["show_subscriber_form"]=='1'?"checked":""?>    >
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="website_popup" class="btn btn-primary"><?=tran("Update")?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="fw-600 mb-0"><?=tran("Custom Script")?></h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if(isset($_POST['custom_script'])){
                                        $header_script=$_POST['header_script'];
                                        $footer_script=$_POST['footer_script'];
                                        @mysqli_query($conn,"UPDATE website_appearance SET footer_script='$footer_script',header_script='$header_script' ");
                                        echo "<script>window.location.href=''</script>";


                                    }
                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Header custom script - before")?> &lt;/head&gt;</label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="header_script">
                                                <textarea name="header_script" rows="4" class="form-control" placeholder="<script>&#10;...&#10;</script>"><?=$website['header_script']?></textarea>
                                                <small><?=tran("Write script with")?> &lt;script&gt; tag</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-from-label"><?=tran("Footer custom script - before")?> &lt;/body&gt;</label>
                                            <div class="col-md-8">
                                                <input type="hidden" name="types[]" value="footer_script">
                                                <textarea name="footer_script" rows="4" class="form-control" placeholder="<script>&#10;...&#10;</script>"><?=$website['footer_script']?></textarea>
                                                <small><?=tran("Write script with")?> &lt;script&gt; tag</small>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary" name="custom_script"><?=tran("Update")?></button>
                                        </div>
                                    </form>
                                </div>
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