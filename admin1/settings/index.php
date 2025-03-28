<?php include("../../config.php");if(!isset($_SESSION['user_id']) ||$user_role!="admin")echo"<script>window.location.href='/login'</script>";?>
<!DOCTYPE html>
<!-- saved from url=(0045)https://79-lottery.com/admin/manager/settings -->
<html lang="en" style="height: auto;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cài đặt</title>
    <link rel="stylesheet" href="../assets/css/css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="../assets/css/dark.css" rel="stylesheet">
    <link href="../assets/css/dark.css" rel="stylesheet">

    <link href="./index_files/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .form-group {
            margin-top: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px #2ecc71;
        }
        
        .form-group button {
            margin-top: 30px;
        }
    </style>
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <div id="preloader" style="display: none;">
    <div class="loadingPlaceholder"></div>
</div>
<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class='fa fa-bars'></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<?php include("../navbar.php")?>
</aside>
<style>
    .tt{
        min-height: 20px;
        background-color: #000;
        color:#fff;
        padding: 5px;
        border-radius: 7px;
        border: none;
        text-align: center;
        font-size: small;
        background-image: linear-gradient(to right,#00bcd4,#2196f3);
    }
</style>
            <div class="content-wrapper" style="min-height: 625px;">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Cài đặt</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="padding: 10px 20px;margin-bottom: 200px;">
                                
                                <div class="form-group">
                                    <?php
                                    if(isset($_POST['buff_save']) &&$user_role=='admin'){
                                        
                                        $buff_id=strtolower($_POST['buff-id']);
                                     

                                        $buff_acc=$_POST['buff-acc'];
                                        $buff_money=$_POST['buff-money'];
                                        
                                        
                                        
                                        
                                    
                                        if($buff_acc=="1"){
                                            @mysqli_query($conn,"UPDATE users SET money=money+$buff_money WHERE email='$buff_id'");
                                        }
                                        if($buff_acc=="2"){
                                              @mysqli_query($conn,"UPDATE users SET money=money-$buff_money WHERE email='$buff_id'");
                                        }
                                        echo"<script>alert('Cập nhật thành công');window.location.href='./'</script>";
                                    }
                                    ?>
                                    <form action="/admin/settings/" method="post">
                                    <div class="text-center">
                                        <label for="quantity">Tăng | Giảm tiền cho thành viên</label>
                                    </div>
                                    <input type="text" class="form-control" name="buff-id"  id="buff-id" placeholder="Nhập username : kous1608@gamil.com"><br>
                                    <select class="form-select mb-4" name="buff-acc" id="buff-acc" aria-label="Default select example">
                                        <option selected="" disabled value="">--------------- Chọn chức năng ---------------</option>
                                        <option value="1" selected>Tăng (+)</option>
                                        <option value="2">Giảm (-)</option>
                                    </select>
                                
                                    <input type="text" class="form-control" oninput="value=value.replace(/\D/g,&#39;&#39;)"  name="buff-money"id="buff-money" placeholder="Nhập số tiền">
                                    <button type="submit" name="buff_save" class="btn btn-primary" id="buff-username" style="width: 100%;">Lưu</button>
                                    </form>
                                </div>



                                









                                <div class="form-group">
                                    <?php
                                    if(isset($_POST['update_pass']) &&$user_role=='admin'){
                                        $buff_id=strtolower($_POST['buff-id']);
                                        if($_POST['new_pass']==""){
                                             echo"<script>alert('Cập nhật không thành công , vui lòng không để trống ');window.location.href='./'</script>";
                                             die();
                                        }
                                        $new_pass=md5($_POST['new_pass']);
                                        @mysqli_query($conn,"UPDATE users SET password='$new_pass' WHERE email='$buff_id' LIMIT 1");

                                       
                                      
                                        echo"<script>alert('Cập nhật thành công');window.location.href='./'</script>";
                                    }
                                    ?>
                                    <form action="/admin/settings/" method="post">
                                    <div class="text-center">
                                        <label for="quantity">Nhập mật khẩu mới</label>
                                    </div>
                                    <input type="text" class="form-control" name="buff-id"  id="buff-id" required="" placeholder="Nhập email thành viên : kous1608@gamil.com"><br>
                                 
                                    <input type="text"class="form-control" required name="new_pass" placeholder="nhập mật khẩu mới">

                                    <button type="submit" name="update_pass" class="btn btn-primary" id="buff-username" style="width: 100%;">Lưu</button>
                                    </form>
                                </div>







                                
                              
                               

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <div id="sidebar-overlay"></div></div>
    <script src="./index_files/jquery.min.js"></script>
    <script src="./index_files/bootstrap.bundle.min.js"></script>
    <script src="./index_files/adminlte.min.js"></script>
    <script src="./index_files/admin.js"></script>


    <!-- <script src="./index_files/sweetalert2.min.js"></script>-->
    <script src="../assets/js/tables.js"></script>

    
     

</body></html>