

<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");

if(!isset($_GET['id']) || $_GET['id']=='')die();

$support=fetch_array("SELECT * FROM supports WHERE id='{$_GET['id']}' LIMIT 1" );
$user=fetch_array("SELECT * FROM users WHERE id='{$support['user_id']}' LIMIT 1");
$seller=fetch_array("SELECT * FROM sellers WHERE id='{$support['seller_id']}' LIMIT 1");

if( (!$user && !$seller ) || !$support)die();

?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="3p5l8u6VIdvfsdtb3Yo0crd2vdDbPppm1jXQxA6F">
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
            <?php include("../layout/sidebar.php")?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="col-lg-10 mx-auto">
                        <div class="card">
                            <div class="card-header row gutters-5">
                                <div class="text-center text-md-left">
                                    <h5 class="mb-md-0 h5"><?=$support['subject']?> <?=$support['code']?></h5>
                                    <div class="mt-2">
                                        <span> <?=isset($user)?$user['full_name']:"<str style='color:red'>".$seller['full_name']."</str> chủ shop <a href='/shop/".md5($seller['id'])."' style='color:green'>".$seller['shop_name']."</a>"?> </span>
                                        <span class="ml-2"><?=$support['create_date']?> </span>
                                        <span class="badge badge-inline badge-secondary ml-2 text-capitalize">
                                            <?=$support['status']?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <?php
                                if(isset($_POST['reply'])){
                                    $reply=$_POST['reply'];
                                    $files=$_POST['attachments'];
                                    $status=isset($_POST['pending'])?"Pending":(isset($_POST['solved'])?"Solved":"Open");


                                    $sp_id=intval($_GET['id']);
                                    @mysqli_query($conn,"UPDATE supports SET status='$status',last_reply='$createDate' WHERE id=$sp_id LIMIT 1");

                                    // if(isset($seller))@mysqli_query($conn,"INSERT into support_details(support_id,seller_id,details,files,create_date,type)values($sp_id,$seller_id,'$reply','$files','$createDate','admin')");
                                    @mysqli_query($conn,"INSERT into support_details(support_id,user_id,details,files,create_date,type)values($sp_id,$user_id,'$reply','$files','$createDate','admin')");

                                    

                                    echo "<script>window.location.href=''</script>";
                                    


                                }
                                ?>
                                <form action="" method="post" id="ticket-reply-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="3p5l8u6VIdvfsdtb3Yo0crd2vdDbPppm1jXQxA6F"> 
                                    <input type="hidden" name="status" value="solved" required>
                                    <div class="form-group">
                                        <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' name="reply" required></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <input type="hidden" name="attachments" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="pending" class="btn btn-sm btn-dark" onclick="submit_reply('pending')">
                                            Submit as
                                            <strong>
                                                <span class="text-capitalize">
                                                    Pending
                                                </span>
                                            </strong>
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-icon btn-sm btn-dark" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"><i class="las la-angle-down"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item" name="pending">Submit as <strong>Pending</strong></button>
                                            <button class="dropdown-item" name="open">Submit as <strong>Open</strong></button>
                                            <button class="dropdown-item" name="solved">Submit as <strong>Solved</strong></button>

                                        <!--                                             
                                            <a class="dropdown-item" href="#" onclick="submit_reply('pending')">Submit as <strong>Pending</strong></a>
                                            <a class="dropdown-item" href="#" onclick="submit_reply('open')">Submit as <strong>Open</strong></a>

                                            <a class="dropdown-item" href="#" onclick="submit_reply('solved')">Submit as <strong>Solved</strong></a> -->
                                        </div>
                                    </div>
                                </form>
                                <div class="pad-top">
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        $sql=mysqli_query($conn,"SELECT * FROM support_details WHERE support_id='{$_GET['id']}' ORDER by id desc");
                                        while($row=fetch_assoc($sql)){
                                        ?>
                                        <li class="list-group-item px-0">
                                            <div class="media">
                                                <a class="media-left" href="#">
                                                    <span class="avatar avatar-sm mr-3">
                                                        <?php if($row['type']=='admin'){?>
                                                        <img src="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
                                                        <?php }else{?>
                                                        <img src="/public/assets/img/avatar-place.png">
                                                        <?php }?>

                                                    </span>
                                                </a>
                                                <div class="media-body">
                                                    <div class="">
                                                        <span class="text-bold h6"><?=$row['type']=='admin'?"Admin":(isset($user)?$user['full_name']:"<str style='color:purple'>".$seller['full_name']."</str>")?></span>
                                                        <p class="text-muted text-sm fs-11"><?=$row['create_date']?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <p><?=$row['details']?></p>
                                                <div class="mt-3">
                                                    <?php
                                                    $imgs=explode(",",$row['files']);
                                                    foreach($imgs as $img){
                                                        $file=fetch_array("SELECT * FROM file WHERE id='$img' LIMIT 1");
                                                    ?>
                                                    <a href="/public/uploads/all/<?=$file['src']?>" download="" class="badge badge-lg badge-inline badge-light mb-1">
                                                        <i class="las la-paperclip mr-2"><?=$file['src']?></i>
                                                    </a>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </li>
                                        <?php }?>

                                        
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
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
        function submit_reply(status) {
            $('input[name=status]').val(status);
            if ($('textarea[name=reply]').val().length > 0) {
                $('#ticket-reply-form').submit();
            }
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
                        _token: '3p5l8u6VIdvfsdtb3Yo0crd2vdDbPppm1jXQxA6F',
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

    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'8d59c3382e1edd3c',t:'MTcyOTQzNTIyMi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/public/assets/js/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
</body>

</html>