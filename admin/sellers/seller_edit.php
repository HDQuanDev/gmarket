<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");


if(!isset($_GET['id']) || $_GET['id']=='')die();

$seller=fetch_array("SELECT * FROM sellers WHERE id='{$_GET['id']}' LIMIT 1");

if(!$seller)die();


?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="eqjqtUtxseorsGoZu7TnivtNRjQVUkt0un4xjOJ8">
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
                        <h5 class="mb-0 h6">Edit Seller Information</h5>
                    </div>

                    <div class="col-lg-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">Seller Information</h5>
                            </div>

                            <div class="card-body">
                                <?php
                                if(isset($_POST['submit'])){
                                    $full_name=$_POST['full_name'];
                                    $password=($_POST['password']=="")?$seller['password']:md5($_POST['password']);
                                    $email=$_POST['email'];
                                    $visitors=$_POST['flow'];

                                    $rating=$_POST['rating'];
                                    $balance=$_POST['balance'];
                                    @mysqli_query($conn,"UPDATE sellers SET money='$balance', full_name='$full_name',password='$password',email='$email',visitors='$visitors',rating='$rating' WHERE id='{$seller['id']}' LIMIT 1");

                                    echo "<script>window.location.href=''</script>";



                                }
                                
                                ?>
                                <form action="" method="POST">
                                    <input name="_method" type="hidden" value="PATCH">
                                    <input type="hidden" name="_token" value="eqjqtUtxseorsGoZu7TnivtNRjQVUkt0un4xjOJ8">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="name">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Name" id="name" name="full_name" class="form-control" value="<?=$seller['full_name']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="email">Email Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Email Address" id="email" name="email" class="form-control" value="<?=$seller['email']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="password">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" placeholder="Password" id="password" name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="password">Rating</label>
                                        <div class="col-sm-9">
                                            <input type="number" placeholder="Rating" name="rating" class="form-control" value="<?=$seller['rating']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="flow">Visitors</label>
                                        <div class="col-sm-9">
                                            <input type="number" placeholder="Visitors" name="flow" class="form-control" value="<?=$seller['visitors']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="flow">Money sell</label>
                                        <div class="col-sm-9">
                                            <input type="number" placeholder="Balance" name="balance" class="form-control" value="<?=$seller['money']?>">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="admin_to_pay">Money sell</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.01" placeholder="Balance" name="admin_to_pay" class="form-control" value="0">
                                        </div>
                                    </div> -->
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
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
                        _token: 'eqjqtUtxseorsGoZu7TnivtNRjQVUkt0un4xjOJ8',
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