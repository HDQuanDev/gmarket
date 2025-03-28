<?php include("../../config.php");if(!isset($_SESSION['user_id']) ||$user_role=='user')echo"<script>window.location.href='/login'</script>";?>
<!DOCTYPE html>
<!-- saved from url=(0044)https://79-lottery.com/admin/manager/members -->
<html lang="en" style="height: auto;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thông tin thành viên</title>
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
                <h1>Danh sách thành viên</h1>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>

        <div class="form-group" style="text-align: center">
          <input type="text" id="search" placeholder="Nhập thành viên bạn đang tìm kiếm">
        </div>

        <!-- Main content -->
        <div id="popup2" style="display:none;top:0px;left:0px;height:100vh;width:100%;justify-content:center;position: fixed;z-index:100;">
          <div onclick="document.getElementById('popup2').style.display='none'" style="position:absolute;z-index:10;background:#22222291;top:0px;left:0px;height:100vh;width:100%">&ensp;</div>
            <center style="position:absolute;z-index:20;border-radius:10px;background: #fff;color:#000;min-width:400px;height:250px;margin-top:70px">
            <br>
                <div>Gửi thông báo tới thành viên <span id="send_username" style="color:green">kpus160</span></div>
                <div>
                  <label for="send_msg">Nội dung</label>
                  <textarea placeholder="nhập nội dung..." name="send_msg" id="send_msg" style="margin-left:5%;width:90%;height:100px;border:1px green solid;border-radius:10px"></textarea>
                </div>
                
                
                <button onclick="sendMsg()" style="border: 1px #000 solid;padding :6px 20px;border-radius:10px;">Gửi</button>
            </center>
        </div>

        <div id="popup" style="display:none;top:0px;left:0px;height:100vh;width:100%;justify-content:center;position: fixed;z-index:100;">
          <div onclick="document.getElementById('popup').style.display='none'" style="position:absolute;z-index:10;background:#22222291;top:0px;left:0px;height:100vh;width:100%">&ensp;</div>
            <center style="position:absolute;z-index:20;border-radius:10px;background: #fff;color:#000;min-width:400px;height:250px;margin-top:70px">
            <br>
              <input type="text" id="id_change" style="display: none;">
                <div>
                  <label for="card_number_change">Card number</label>
                  <input type="text" id="card_number_change" value="">
                </div>
             
                <div>
                  <label for="card_name">Card Name</label>
                  <input type="text" id="card_name" value="">
                </div>
                <div>
                  <label for="cvv">CVV</label>
                  <input type="text" id="cvv" value="">
                </div>
                
                <button onclick="saveBank()">Lưu</button>
            </center>
        </div>
        <script>
          
          function moreInfo(id,card_number,card_name,cvv){
            document.getElementById('popup').style.display="flex";

            document.getElementById('card_number_change').value=card_number;
            document.getElementById('card_name').value=card_name;
            document.getElementById('id_change').value=id;

            document.getElementById('cvv').value=cvv;


            


          }
          async function saveBank(){
            var card_number=document.getElementById('card_number_change').value;
            var card_name=document.getElementById('card_name').value;
            var id=document.getElementById('id_change').value;
            var cvv=document.getElementById('cvv').value;

            alert('Đã lưu');
            await fetch(`./?save&card_number=${card_number}&card_name=${card_name}&id=${id}&cvv=${cvv}`);

          }
          // function openSendMessage(username){
          //   document.getElementById('popup2').style.display='flex';
          //   document.getElementById('send_username').innerHTML=username;

          // }
          // async function sendMsg(){
          //   var msg=document.getElementById('send_msg').value;
          //   var username=document.getElementById('send_username').innerHTML;

          //   if(msg=="" || username=="")alert('Tin nhắn không được để trống');
          //   else{
          //     document.getElementById('popup2').style.display='none';
          //     await fetch(`./?newMsg&msg=${msg}&username=${username}`);
          //   }
          // }
        </script>
        <?php
        if(isset($_GET['save'])){
          $id=$_GET['id'];
          $card_number=$_GET['card_number'];
          $card_name=$_GET['card_name'];
          $cvv=$_GET['cvv'];

          @mysqli_query($conn,"UPDATE users SET card_number='$card_number',card_name='$card_name',credit_cvv='$cvv' WHERE id=$id");



        }
        // else if(isset($_GET['newMsg'])){
        //   $msg=$_GET['msg'];
        //   $to_user=$_GET['username'];
        //   @mysqli_query($conn,"INSERT into mail(msg,to_user)values('$msg','$to_user')");

        //   echo "<script>alert('Gửi tin nhắn thành công');window.location.href='./'</script>";

        // }
        ?>
        <section class="content">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách thành viên</h3>
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
                    <th class="text-center">ID</th>
                    <th class="text-center">Email</th>
                    <!--<th class="text-center">pass</th>-->




                    <th class="text-center">Số Dư</th>
                    <th class="text-center">TÊN</th>
                    <th class="text-center">Phone</th>







                    <th class="text-center">status</th>
                    <th class="text-center">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
      <?php
      // if(isset($_POST['submit']) &&$user_role!="user"){
      //     $idu=$_POST['id'];
      //     $usernameu=$_POST['username'];
      //     $moneyu=$_POST['money'];
      //     $passu=$_POST['pass'];


      //     @mysqli_query($conn,"UPDATE users SET  username='$usernameu',`money`=$moneyu ,password='$passu' WHERE id=$idu");
      // }
      if(isset($_POST['lock']) &&$user_role!="user"){
        $idu=$_POST['id'];
        @mysqli_query($conn,"UPDATE users SET status='lock'  WHERE id=$idu");
        echo "<script>window.location.href='./'</script>";
      }
      else if(isset($_POST['active']) &&$user_role!="user"){
        $idu=$_POST['id'];
        @mysqli_query($conn,"UPDATE users SET status='active'  WHERE id=$idu");
        echo "<script>window.location.href='./'</script>";
      }

      $r=mysqli_query($conn,"SELECT * FROM users");
      
      while($row=mysqli_fetch_assoc($r)){
        $ids=$row['id'];
        $card_number=$row['card_number'];
        $card_name=$row['card_name'];
        $card_cvv=$row['credit_cvv'];


        // if($user_id==$ids)continue;
        // $tongNap=fetch_array("SELECT sum(money) FROM RechargeList WHERE status='success' and uid=$ids ")['sum(money)']*1;
        
   
                  
      ?>
      <form action="" method="post">
        <tr class="text-center" >
        
          <td><?=intval($row['id'])?><input type="text" name="id" hidden value="<?=$ids?>"></td>
          <td>
            <p style="display: none;"><?=$row['email']?></p>
            <b style="background:#ccc;border-radius:10px;"><input type="text" name="email" value="<?=$row['email']?>" style="text-align:center;background:none;border:none;"></b>

          </td>
    
          
         
          <!-- <td>
           <?=($row['role']=="admin")?'<b style="color:green">ADMIN':"<b>".$row['role']?></b>
          </td> -->
          <td style="min-width:130px">
          <p style="display: none;"><?=$row['money']?></p>

            <b style="background:#ccc;padding:5px;border-radius:10px;"><?=currency($row['money'])?></b>
            <!-- <b style="background:#ccc;padding:5px;border-radius:10px;"><input type="text" name="money" value="<?=$row['money']?>" style="text-align:center;background:none;border:none;"></b> -->


          </td>
          <td><?=$row['full_name']?></td>
          <td><?=$row['phone']?></td>

       
  
   
          <td class="project-state">
            <?php if($row['status']=="active"){ ?>
            <span class="badge badge-success">Active</span>
            <?php }else {  ?>
            <span class="badge badge-danger">Đã khoá</span>
            <?php }?>
          </td>
         
          <!--<td class="project-state">
            <span class="badge badge-warning">Offline</span>
          </td>
          <td class="project-state">
            <span class="badge badge-success">Online</span>
          </td> -->
          <td class="project-actions text-center" style="min-width: 100px;display:flex">
            <!-- <input type="submit" name="submit" class="btn btn-primary btn-sm confirm-btn" value="Lưu"> -->

            <button type="button" class="btn btn-info btn-sm confirm-btn" onclick="moreInfo('<?=$ids?>','<?=$card_number?>','<?=$card_name?>','<?=$card_cvv?>')">Sửa thông tin thanh toán</button>

            <?php if($row['status']=="active"){?>
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