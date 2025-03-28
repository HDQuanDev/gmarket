<?php include("../../config.php");if(!isset($_SESSION['user_id']) ||$user_role=='user')echo"<script>window.location.href='/#/Login'</script>";

function chuan_hoa_khoang_cach($str) {
    // Loại bỏ khoảng trắng ở đầu và cuối chuỗi
    $str = trim($str);
    // Thay thế các khoảng trắng kép bằng một khoảng trắng đơn
    $str = preg_replace('/\s+/', ' ', $str);
    return $str;
}
?>
<!DOCTYPE html>
<!-- saved from url=(0044)https://79-lottery.com/admin/manager/members -->
<html lang="en" style="height: auto;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kết quả game</title>
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
              <div class="col-sm-6" >
                <h1>Chỉnh sửa kết quả theo cú pháp  <br><code>[số][1 dấu chấm phẩy][số] VD :1,2,3 tuỳ game</code></h1>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

        <!-- <div class="form-group" style="text-align: center">
          <input type="text" id="search" placeholder="Nhập thành viên bạn đang tìm kiếm">
        </div> -->

        <!-- Main content -->
   











<?php 
$sql_g=mysqli_query($conn,"SELECT * FROM games ");
while($cr=fetch_assoc($sql_g)){
?>


        <section class="content">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Kết quả <?=$cr['name']?></h3>
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
              <table class="table table-striped projects" id="">
                <thead>
                  <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Phiên</th>
                    <!-- <th class="text-center">Mã phiên</th> -->
                    <th class="text-center">KẾT QUẢ</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
      <?php
      if(isset($_POST['update_3'])){
        $id=$_POST['id'];
        $result_3=chuan_hoa_khoang_cach($_POST['result_3']);
        @mysqli_query($conn,"UPDATE k5 SET result='$result_3' WHERE id=$id");
        echo "<script>alert('Thay đổi thành công');window.location.href='./'</script>";
      }
      $i=6;
      $r=mysqli_query($conn,"SELECT * FROM k5 WHERE game_id='{$cr['id']}' ORDER BY id desc LIMIT $i");
      while($row=mysqli_fetch_assoc($r)){
        $ids=$row['id'];
        $i--;
                  
      ?>
      <form action="./" method="post">
        <tr class="text-center" >
          <td><?=$ids?><input type="text" name="id" hidden value="<?=$ids?>"></td>
          <td><?=$i==0?"Phiên hiện tại":"Phiên kế tiếp thứ ".$i?> </td>
          <!-- <td style="min-width:160px"><?=($row['period'])?></td> -->
          <td style="min-width:130px">
            <input type="text" name="result_3" value=" <?=$row['result']?>" style="width:150px;text-align:center">
          </td>
          <td style="display:flex">
               <button type="submit" class="btn btn-success btn-sm confirm-btn" name="update_3">Lưu</button>
          </td> 
        </tr>
        </form>
      <?php }?>
</tbody>
              </table>
            </div>
            
          </div>
        </section>

        <?php }?>

      </div>
  <div id="sidebar-overlay"></div></div> 
  <script src="./index_files/jquery.min.js"></script>
  <script src="./index_files/bootstrap.bundle.min.js"></script>
  <script src="./index_files/adminlte.min.js"></script>
  <script src="./index_files/sweetalert2.min.js"></script>
  <script src="./index_files/admin.js"></script> 

  <script src="../assets/js/tables.js"></script>
 


</body></html>