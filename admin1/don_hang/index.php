<?php include("../../config.php");if (!isset($_SESSION['user_id']) || $user_role != "admin") echo "<script>window.location.href='/login'</script>"; ?>

<!DOCTYPE html>
<!-- saved from url=(0045)/admin/manager/recharge -->
<html lang="en" style="height: auto;">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Duyệt đơn</title>
  <link rel="stylesheet" href="../assets/css/css">
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <link href="../assets/css/dark.css" rel="stylesheet">
</head>

<body class="sidebar-mini" style="height: auto;">
  <div class="wrapper">
    <div id="preloader" style="display: none;">
      <div class="loadingPlaceholder"></div>
    </div>
    <nav class="main-header navbar navbar-expand navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
      <?php include("../navbar.php") ?>
    </aside>
    <div class="content-wrapper" style="min-height: 625px;">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Đơn hàng của thành viên</h1>
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
            <h3 class="card-title">Đơn hàng của thành viên</h3>

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
            <table class="table table-striped projects" id="table1">
              <thead>
                <tr>
                  <th class="text-center">@</th>
                  <th class="text-center">code</th>

                  <th class="text-center">email</th>
                  <th class="text-center">tổng tiền</th>
                  <th class="text-center">lời nhắn</th>
                  <th class="text-center">địa chỉ</th>


                  <th class="text-center">thanh toán</th>



                  <th class="text-center">Thời gian</th>
                  <th class="text-center">Status</th>
                  <!-- <th class="text-center">Action</th> -->
                  
                </tr>
              </thead>
              <tbody>
              <?php
             
              
                  
                  $l=mysqli_query($conn,"SELECT * FROM orders ORDER by id DESC");
                  $i=0;
                  while($row=fetch_assoc($l)){
                    $user_nap=fetch_array("SELECT * FROM users WHERE id='{$row['user_id']}' LIMIT 1");

                    $i++;
                  ?>
                <form action="" method="post">
                <tr class="text-center">
                  
                  <td id="<?=$i?>"><?=$i?>
                    <input type="text" hidden name="id" value="<?=$row['id']?>">
                  </td>
                  <td><?=$row['code']?></td>
                  <td>
                    <b><?=$user_nap['email']?></b>
                    <input type="text" name="user_nap" hidden value="<?=$user_nap['email']?>">
                  </td>
                  <td>
                    <b style="color: #3498db"><?=currency($row['amount'])?> </b>

                  </td>
                  <td>
                    <p><?=$row['additional_info']?></p>
                  </td>
                  <td><p><?=$row['address']?></p></td>
                  <td class="project-state">
                    <span class="badge btn-success"><?=$row['payment_option']?></span>
                  </td>
                
                 
                  <td class="project-state">
                    <span class="badge badge-warning"><?=$row['create_date']?></span>
                  </td>
                  <td class="project-actions text-center" style="min-width: 160px;">
                      <?=$row['delivery_status']?>
                    <!-- xác nhận -->
                   
                    <!-- ? -->
                    <!-- <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i></a> -->
                    <!-- Xóa -->
                    <!--<button type="submit" name="error" class="btn btn-danger btn-sm delete-btn" href="" data="43"><i class='fa fa-close'></i></button>-->
                  </td>
                  <!-- <td> <button type="submit" name="save_new" class="btn btn-success btn-sm confirm-btn" href="" data="43"><i class="fa fa-check"></i></button></td> -->
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
    <div id="sidebar-overlay"></div>
  </div>
  <script src="./index_files/jquery.min.js"></script>
  <script src="./index_files/bootstrap.bundle.min.js"></script>
  <script src="./index_files/adminlte.min.js"></script>
  <script src="./index_files/admin.js"></script>
  <script src="./index_files/sweetalert2.min.js"></script>

  <script src="../assets/js/tables.js"></script>



</body>

</html>