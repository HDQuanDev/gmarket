<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /");

if(!isset($_GET['id']) || $_GET['id']=='')die();
$query=fetch_array("SELECT * FROM product_queries WHERE id='{$_GET['id']}' LIMIT 1");
if(!$query)die();


$user=fetch_array("SELECT full_name,logo FROM users WHERE id='{$query['user_id']}' LIMIT 1");
$product=fetch_array("SELECT name FROM products WHERE id='{$query['product_id']}' LIMIT 1");

$user_logo=fetch_array("SELECT src FROM file WHERE id='{$user['logo']}' LIMIT 1");




?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="Fiky3Wly3Hsl06NfbKni7WyOVJ1nQuxVyDrzdod3">
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><?=$product['name']?></h5>
                            </div>

                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        <div class="media mb-2">
                                            <img class="avatar avatar-xs mr-3" src="/public/<?=$user_logo?"uploads/all/".$user_logo['src']:"assets/img/avatar-place.png"?>" onerror="this.onerror=null;this.src='/public/assets/img/avatar-place.png';">
                                            <div class="media-body">
                                                <h6 class="mb-0 fw-600">
                                                </h6>
                                                <p class="opacity-50">From <?=$query['create_date']?></p>
                                            </div>
                                        </div>
                                        <p class="font-weight-bold">
                                            <?=$query['message']?>
                                        </p>
                                       
                                    </li>
                                    <?php if($query['status']=='active'){?>
                                    <li class="list-group-item px-0">
                                        <div class="media mb-2">
                                            <img class="avatar avatar-xs mr-3" src="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
                                            <div class="media-body">
                                                <h6 class="mb-0 fw-600">
                                                </h6>
                                                <p class="opacity-50">From <?=$query['create_date']?></p>
                                            </div>
                                        </div>
                                        <p class="font-weight-bold">
                                            <?=$query['reply']?>
                                        </p>
                                       
                                    </li>
                                    <?php }?>
                                </ul>
                                <?php if($query['status']=='pending'){
                                    if(isset($_POST['add_new'])){
                                        $reply=$_POST['reply'];
                                        @mysqli_query($conn,"UPDATE product_queries SET reply='$reply',reply_time='$createDate',status='active' WHERE id='{$_GET['id']}' LIMIT 1");
                                        echo "<script>window.location.href=''</script>";
                                    }
                                    ?>

                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="4" name="reply" placeholder="Type your reply" required=""></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="text-right">
                                        <button type="submit" name="add_new" class="btn btn-info">Send</button>
                                    </div>
                                </form>
                                <?php }?>

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
                        _token: 'Fiky3Wly3Hsl06NfbKni7WyOVJ1nQuxVyDrzdod3',
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