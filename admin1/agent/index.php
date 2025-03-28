<?php include("../../config.php");if(!isset($_SESSION['user_id']) || $user_role!='admin')echo"<script>window.location.href='/#/Login'</script>";
if($user_role=="admin"){
?>
<!DOCTYPE html>
<!-- saved from url=(0044)https://79-lottery.com/admin/manager/members -->
<html lang="en" style="height: auto;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Danh sách tài khoản đại lý</title>
  <link rel="stylesheet" href="../assets/css/css">
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link href="../assets/css/dark.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <style>
    .block-click {
      pointer-events: none;
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
      <div class="content-wrapper" style="min-height: 595px;">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Danh sách đại lý</h1>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

        <!-- <div class="form-group" style="text-align: center">
          <input type="text" id="search" placeholder="Nhập thành viên bạn đang tìm kiếm">
        </div> -->

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title"> &ensp;Tạo tài khoản đại lý mới</h3> -->
              <br>
              <?php
              if(isset($_POST['submits'])){
                $AgentUser=strtolower(htmlentities(trim(addslashes($_POST['Auser']))));
                $AgentPass=md5(htmlentities(trim(addslashes($_POST['Apass']))));
                if(mysqli_fetch_array(mysqli_query($con,"SELECT * from users WHERE LOWER(username)='$AgentUser' LIMIT 1")))echo "<str style='color:red'>Username đã tồn tại</str>";
                else{
                  $invite_code=strtoupper(substr(md5(time()),0,8));
                  $ip=$_SERVER['REMOTE_ADDR'];
                  @mysqli_query($con,"INSERT into users(invite_code,username,password,ip,role)values('$invite_code','$AgentUser','$AgentPass','$ip','agent')");
                  echo "<script>alert('thêm đại lí thành công');window.location.href='./'</script>";
                }
              }
              ?>
              <form action="" method="post" style="display:grid;grid-template-columns:1fr 1fr 100px">
                <div style="background-image:linear-gradient(to left,#ffeb3b,#00bcd4);padding:10px;border-radius:5px;margin:10px;"> <i class='fa fa-refresh fa-spin'></i> Tạo mới  <br>
                <input type="texr" name="Auser" style="background:none;border:1px blue solid;margin:10px 0px" required  placeholder="username"> <br>
                <input type="text" name="Apass" style="background:none;border:1px blue solid;" required  placeholder="mật khẩu"> <br> 
                <button type="submit" name="submits" style="border-radius:10px;height:40px;margin-top:20px">tạo mới</button>
              </div>
              </form>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class='fa fa-arrows-v'></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class='fa fa-close'></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0" style="overflow-y: hidden">
              <table class="table table-striped projects" id="table1">
                <thead>
                  <tr>
                    <th class="text-center">Username</th>
                    <th class="text-center">Số thành viên</th>

                    <th class="text-center">Tổng dư </th>


                    <th class="text-center">Level</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
      <?php
 
      if(isset($_POST['lock']) &&$user_role=="admin"){
        $idu=$_POST['id'];
        @mysqli_query($con,"UPDATE users SET status='0'  WHERE id=$idu");
      }
      if(isset($_POST['active']) &&$user_role=="admin"){
        $idu=$_POST['id'];
        @mysqli_query($con,"UPDATE users SET status='1'  WHERE id=$idu");
      }
      $r=mysqli_query($con,"SELECT * FROM users WHERE role='agent'");
      
      while($row=mysqli_fetch_assoc($r)){
        $ids=$row['id'];
        $dailyCode=$row['invite_code'];
        $csu= mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*),SUM(money) FROM users WHERE invite_code='$dailyCode' and role='user'"))
        
                  
      ?>
      <form action="" method="post">
        <tr class="text-center" >
        
          <td><?=$row['username']?><input type="text" name="id" hidden id="" value="<?=$ids?>"></td>
          <td><?=$csu['COUNT(*)']?></td>
          <td><?=($csu['SUM(money)'])?></td>


        
        
          <td>
           <?=($row['role']=="admin")?'<b style="color:green">ADMIN':"<b>".$row['role']?></b>
          </td>
          <!-- <td style="min-width:130px">
            <b style="background:#ccc;padding:5px;border-radius:10px;"><?=($row['money'])?></b>
          </td> -->
          <td class="project-state">
            <?php if($row['status']=="1"){ ?>
            <span class="badge badge-success">Online</span>
            <?php }else {  ?>
            <span class="badge badge-danger">Đã Khoá</span>
            <?php }?>
          </td>
         
          <!--<td class="project-state">
            <span class="badge badge-warning">Offline</span>
          </td>
          <td class="project-state">
            <span class="badge badge-success">Online</span>
          </td> -->
          <td class="project-actions text-center" style="min-width: 100px;display:flex">
            <input type="submit" name="submit" class="btn btn-primary btn-sm confirm-btn" value="Lưu">
            <?php if($row['status']=="1"){?>
            <input type="submit"  name="lock" class="btn btn-info btn-sm btn-danger" id="98" value="Khoá">
            <?php }else{?>
            <input type="submit"  name="active" class="btn btn-success btn-sm " id="98" value="Mở ">
            <?php }?>


            
           
            <!--<a class="btn btn-danger btn-sm delete-btn" href="#">
              <i class="fas fa-trash"></i> Banner
            </a>-->
          </td>
        </tr>
        </form>
      <?php }?>
</tbody>
              </table>
            </div>
            <nav aria-label="Page navigation example" style="margin-top: 20px; display: flex; justify-content: center">
                <ul class="pagination table1">
                    <li class="page-item previous" id="previous">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <div id="numbers" style="display: flex">
                        <!-- <li class="page-item">
                            <a class="page-link active text-white" id="text-page">1 / 3</a>
                        </li> -->
                    </div>
                    <li class="page-item next" id="next">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
          </div>
        </section>
      </div>
  <div id="sidebar-overlay"></div></div> 
  <script src="./index_files/jquery.min.js"></script>
  <script src="./index_files/bootstrap.bundle.min.js"></script>
  <script src="./index_files/adminlte.min.js"></script>
  <script src="./index_files/sweetalert2.min.js"></script>
  <script src="./index_files/admin.js"></script> 

  <script src="../assets/js/tables.js"></script>
 


</body></html>
<?php }else echo "Only admin has access";?>