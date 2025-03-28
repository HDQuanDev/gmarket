<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<div class="sidebar" style="margin-top: 0;">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../assets/css/facebook.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=$user_email||"no name"?></a>
            </div>
        </div>
        <nav class="mt-2">
        
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- <li class="nav-item">
                    <a href="../thongke/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/thongke/"?"active":""?>" >
                    style="pointer-events: none;"
                        <i class="nav-icon fa fa-angellist"></i>
                        <p style="color:aquamarine">Thống kê </p>
                    </a>
                </li> -->
                <?php if($user_role=='admin'){?>
                <!-- <li class="nav-item">
                    <a href="../historyplay/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/historyplay/"?"active":""?>" >
                    style="pointer-events: none;"
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>Thống kê đơn</p>
                    </a>

                </li> 

                <li class="nav-item" style="color:#3ee9ff;border:1px #3ee9ff solid">
                    <a href="../game/" class="nav-link " >
                        <i class="nav-icon fa fa-gamepad" style="color:#3ee9ff"></i>
                        <p  style="color:#3ee9ff" >Game</p>
                    </a>

                </li>
                
                 <li class="nav-item">
                    <a href="../agent/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/agent/"?"active":""?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>tài khoản đại lí</p>
                        <span class="right badge badge-success">Hoạt động</span>
                    </a>
                </li> -->
                
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Đầu</p>
                        <span class="right badge badge-danger">Chưa cấu hình</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Đuôi</p>
                        <span class="right badge badge-danger">Chưa cấu hình</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Lô</p>
                        <span class="right badge badge-danger">Chưa cấu hình</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="../home/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/home/"?"active":""?>" >
                    <!-- style="pointer-events: none;" -->
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>Thành viên</p>
                    </a>
                </li>
<!--      
                <li class="nav-item">
                    <a href="../recharge/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/recharge/"?"active":""?>">
                        <i class="nav-icon fa fa-credit-card-alt"></i>
                        <p>Duyệt nạp tiền</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="../don_hang/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/don_hang/"?"active":""?>">
                        <i class="nav-icon fa fa-credit-card-alt"></i>
                        <p>Lịch sử đơn hàng</p>
                    </a>
                </li> 

                <!-- <li class="nav-item">
                    <a href="../withdraw/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/withdraw/"?"active":""?>">
                        <i class="nav-icon fa fa-bank"></i>
                        <p>Duyệt rút tiền</p>
                    </a>
                </li> -->
               
                <li class="nav-item">
                    <a href="../recharge_history/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/recharge_history/"?"active":""?>">
                        <i class="nav-icon fa fa-bank"></i>
                        <p>Duyệt nạp tiền</p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="../settings" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/settings/"?"active":""?>">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>Cài đặt</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="/manage/admin/api" class="nav-link">
                        <i class="nav-icon fa fa-link" aria-hidden="true"></i>
                        <p>API</p>
                    </a>
                </li> -->
                <?php }else if($user_role=='agent'){?>
                <li class="nav-item">
                <a href="../home/" class="nav-link <?=$_SERVER['REQUEST_URI']=="/admin/home/"?"active":""?>" >
                    <i class="nav-icon fa fa-user-circle"></i>
                    <p>Thành viên</p>
                </a>
                </li>
                <?php }?>

                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fa fa-sign-out" aria-hidden="true"></i>
                        <p>Quay lại</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>