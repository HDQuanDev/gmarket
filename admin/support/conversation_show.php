<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /");

if(!isset($_GET['id']) || $_GET['id']=='')die();
$conversation=fetch_array("SELECT * FROM conversations WHERE id='{$_GET['id']}' LIMIT 1");
if(!$conversation)die();

$product=fetch_array("SELECT name FROM products WHERE id='{$conversation['product_id']}' LIMIT 1");




?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="PuAewTX5kmdSazKZ0Z4IpWC0TzD6LOAo7z78ENxR">
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
                                <h5 class="card-title" translate="no">Sản phẩm<b style="color:green"> #<?=$product['name']?></b> </h5>
                            </div>

                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <?php
                                    $sql=mysqli_query($conn,"SELECT * FROM conversation_details WHERE conversation_id='{$_GET['id']}'");
                                    while($row=fetch_assoc($sql)){
                                        if($row['type']=='seller'){
                                            $seller=fetch_array("SELECT full_name,shop_logo FROM sellers WHERE id='{$conversation['seller_id']}' LIMIT 1");
                                            $name=$seller['full_name'];
                                            $shop_logo=fetch_array("SELECT * FROM file WHERE id='{$seller['shop_logo']}' LIMIT 1");

                                            $shop_logo=$shop_logo?'uploads/all/'.$shop_logo['src']:'assets/img/placeholder.jpg';
                                        }
                                        else{
                                            $user=fetch_array("SELECT full_name FROM users WHERE id='{$conversation['user_id']}' LIMIT 1");
                                            $name=$user['full_name'];
                                            

                                        }

                                    ?>
                                    <li class="list-group-item px-0">
                                        <div class="media mb-2">
                                            <img class="avatar avatar-xs mr-3" src="/public/<?=$row['type']=='user'?'assets/img/placeholder.jpg':$shop_logo?>" onerror="this.onerror=null;this.src='/public/assets/img/avatar-place.png';">
                                            <div class="media-body">
                                                <h6 class="mb-0 fw-600"><?=$name?></h6>
                                                <p class="opacity-50"><?=$row['create_date']?></p>
                                            </div>
                                        </div>
                                        <p><?=$row['message']?></p>
                                    </li>
                                    <?php }?>
                                    
                                </ul>
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
                        _token: 'PuAewTX5kmdSazKZ0Z4IpWC0TzD6LOAo7z78ENxR',
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