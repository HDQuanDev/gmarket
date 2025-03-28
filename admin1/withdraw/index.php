<?php include("../../config.php");if(!isset($_SESSION['user_id']) ||$user_role!="admin")echo"<script>window.location.href='/login'</script>";?>

<!DOCTYPE html>
<!-- saved from url=(0045)https://79-lottery.com/admin/manager/recharge -->
<html lang="en" style="height: auto;">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rút tiền</title>
  <link rel="stylesheet" href="./index_files/css">
  <link rel="stylesheet" href="./index_files/all.min.css">
  <link rel="stylesheet" href="./index_files/font-awesome.min.css">
  <link href="./index_files/dark.css" rel="stylesheet">
  <link rel="stylesheet" href="./index_files/adminlte.min.css">
  <link rel="stylesheet" href="./index_files/admin.css">
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
              <i class='fas fa-arrow-alt-circle-left'></i>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <?php include("../navbar.php") ?>
    </aside>
    <div class="content-wrapper" style="min-height: 625px;">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Duyệt rút tiền</h1>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Duyệt rút tiền</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class='fa fa-arrows-v'></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class='fa fa-close'></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0" style="overflow-y: hidden;">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th class="text-center">@</th>
                  <th class="text-center">Username</th>
                  <th class="text-center">Ngân hàng</th>
                  <th class="text-center">STK</th>
                  <th class="text-center">Chủ khoản</th>
                  <th class="text-center">Số tiền</th>
                  <th class="text-center">Thời gian tạo</th>
                  <th class="text-center"></th>
                </tr>
              </thead>
              <tbody>
              <?php
              if(isset($_POST['error'])){
                $id=$_POST['id'];
                $usr=$_POST['user_rut'];
                $mon=$_POST['money'];
                @mysqli_query($conn,"UPDATE users  SET money=money+$mon WHERE id=$id");

                @mysqli_query($conn,"UPDATE payment SET status='error' WHERE id=$id");


                @mysqli_query($conn,"UPDATE users SET money=money+$mon WHERE id='$usr'");
              }
              else if(isset($_POST['success'])){
                $id=$_POST['id'];
                $mon=$_POST['money'];
                @mysqli_query($conn,"UPDATE payment SET status='success' WHERE id=$id");


                $m_user=fetch_array($conn,"SELECT * FROM users WHERE id='$usr'");
            
                // @mysqli_query($conn,"INSERT into MoneyLog(uid,`money`,`before`,`after`,`type`,`memo`,`color`)values('{$m_user['id']}','$m_money','$beforeMon','$afterMon','Withdarwal','rút',1)");

              }
              
                  $l=mysqli_query($conn,"SELECT * FROM payment WHERE status='pending' and type='withdraw' ORDER by id DESC");
                  $i=0;
                  while($lenh=mysqli_fetch_assoc($l)){
                    $user_rut=fetch_array("SELECT * FROM users WHERE id='{$lenh['user_id']}' LIMIT 1");

                    $i++;
                  ?>
                <form action="" method="post">
                <tr class="text-center">
                  
                  <td id="<?=$i?>"><?=$i?>
                    <input type="text" hidden name="id" value="<?=$lenh['id']?>">
                  </td>
                  <td>
                    <b><?=$user_rut['username']?></b>
                    <input type="text" name="user_rut" hidden value="<?=$user_rut['id']?>">
                  </td>
                  <td>
                    <b style="color: #3498db"><?=$user_rut['bank_name']?></b>
                  </td>
                  <td>
                    <b><?=$user_rut['stk']?></b>
                  </td>
                  <td>
                    <b><?=$user_rut['owner']?></b>
                  </td>
                  <td>
                    <input type="number" name="money"  hidden value="<?=$lenh['money']?>" id="">
                    <b><?=($lenh['money'])?></b>
                  </td>
              
                  <td class="project-state">
                    <span class="badge badge-warning"><?=$lenh['create_date']?></span>
                  </td>
                  <td class="project-actions text-center" style="min-width: 160px;">
                    <!-- xác nhận -->
                    <button type="submit" name="success" class="btn btn-success btn-sm confirm-btn" href="" data="43"><i class="fa fa-check"></i></button>
                    <!-- ? -->
                    <!-- <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i></a> -->
                    <!-- Xóa -->
                    <button type="submit" name="error" class="btn btn-danger btn-sm delete-btn" href="" data="43"><i class='fa fa-close'></i></button>
                  </td>
                </tr>
                </form>
                
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>

      </section>
    </div>
    <div id="sidebar-overlay"></div>
  </div>
  <script src="./index_files/jquery.min.js"></script>
  <script src="./index_files/bootstrap.bundle.min.js"></script>
  <script src="./index_files/adminlte.min.js"></script>
  <script src="./index_files/admin.js"></script>
  <script src="./index_files/sweetalert2.min.js"></script>

  <script src="../assets/js/tables.js"></script>

</body></html>


