<?php 
include("../../config.php");
if(!isset($_SESSION['user_id']))echo"<script>window.location.href='/#/Login'</script>";
else if($user_role=='agent')echo"<script>window.location.href='/admin/home'</script>";

else{
?>
<!DOCTYPE html>
<!-- saved from url=(0044)https://79-lottery.com/admin/manager/members -->
<html lang="en" style="height: auto;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lịch sử đơn</title>
  <link rel="stylesheet" href="../assets/css/css">
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link href="../assets/css/dark.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">


  <link rel="stylesheet" href="../resource/js/vendors/simple-datatables/style.css">
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
                <h1>Lịch sử đơn</h1>
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
            <div class="card-header" >
              <!-- <h3 class="card-title" style="padding:5px"># RaND1</h3> -->
              
              <!-- <button style="padding:5px ;background:#8bc34a;border-radius:10px;border:none" onclick="auto('on')">Bật liveServer</button>
              <button style="padding:5px ;background:red;border-radius:10px;border:none" onclick="auto('off')">Tắt liveServer</button> -->
              <div id="last" style="background-image:linear-gradient(to right,#2196f3,#00bcd4);padding:10px;border-radius:5px;margin:10px;"> <i class='fa fa-refresh fa-spin'></i> &ensp; Đang hiển thị tối đa 50 chưa xử lí </div>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class='fa fa-arrows-v'></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class='fa fa-close'></i>
                </button>
              </div>
            </div>
            <style>
              .win{
                background-image: linear-gradient(to right,#8bc34a,green);
                color:#fff;
                height: 30px;
                line-height: 30px;
                font-size:22px;
              }
              .lose{
                background-image: linear-gradient(to right,red,    #ff9800);
                color:#000;
                height: 30px;
                line-height: 30px;
                font-size:22px;
              }
              .wait{
                border: 1px #ccc solid;
                color:#000;
                height: 30px;
                line-height: 30px;
                font-size:22px;
              }

            </style>
            <div class="card-body p-0" style="overflow-y: hidden">
              <table class="table table-striped projects" id="table1">
                <thead>
                  <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">user</th>


                    <th class="text-center">sản phẩm</th>



                    <th class="text-center">Tổng tiền</th>
                    <!-- <th class="text-center">Log</th> -->
                    <th class="text-center">số chọn</th>
                    <th class="text-center">Trạng thái</th>

                    <th class="text-center">Thời gian</th>

                  </tr>
                </thead>
                <tbody id="main_wrap">
      <?php

      $r=mysqli_query($con,"SELECT * FROM HistoryOrder ORDER BY id DESC");
      while($row=mysqli_fetch_assoc($r)){
        $id=$row['id'];
        $userInfo=fetch_array($con,"SELECT * FROM users WHERE id='{$row['uid']}'");
        $status='Hoàn thành';

      ?>
        <tr class="text-center" >
          <td><?=$id?></td>
          <td><b> <?=$userInfo['username']?></b></td>
          <td><b style="color: red"><?=$row['name']?></b></td>
          <td> <b style="background:#cddc39 ;padding:5px;border-radius:3px"><?=$row['total']?></b></td>
          <!-- <td style="min-width:130px"><b style="background:#ccc;padding:5px;border-radius:10px;"><?=($row['money']*count(explode(',',$row['choose'])))?></b></td> -->
          <!--          
          <td class="project-state">
            <span class="badge badge-warning">Offline</span>
          </td>
          <td class="project-state">
            <span class="badge badge-success">Online</span>
          </td> -->
          <td style="width:150px"><img src="../../upload/new/<?=$row['img']?>" style="height:50px" alt=""></td>
          <td><?=$row['status']=='success'?"Thành công":($row['status']=='wait'?"chờ xác nhận":"huỷ" )?></td>
          <td class="project-state"><span class="badge badge-warning"><?=$row['create_time']?></span></td>
        </tr>
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
                        <li class="page-item">
                            <!-- <a class="page-link active text-white" id="text-page">1 / 3</a> -->
                        </li>
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
 
  <!-- // simple database -->
  <!-- <script src="../../resource/js/vendors/simple-datatables/simple-datatables.js"></script> -->
  <!-- <script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
  </script> -->
  <script src="../assets/js/tables.js"></script>


 


</body></html>
<?php }?>