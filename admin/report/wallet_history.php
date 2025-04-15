<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">
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
            <?php include("../layout/topbar.php")?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class=" align-items-center">
                            <h1 class="h3">Wallet Transaction Report</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="card">
                                <form action="" method="GET">
                                    <div class="card-header row gutters-5">
                                        <div class="col text-center text-md-left">
                                            <h5 class="mb-md-0 h6">Wallet Transaction</h5>
                                        </div>
                                        <div class="col-md-3 ml-auto">
                                            <select id="demo-ease" class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="type">
                                                <!-- <option value="">Choose Type</option> -->
                                                <option value="All">
                                                    ALL
                                                </option>
                                                <option value="seller" <?=isset($_GET['type'])&&$_GET['type']=='seller'?"selected":""?> >
                                                    Seller
                                                </option>
                                                <option value="user" <?=isset($_GET['type'])&&$_GET['type']=='user'?"selected":""?>  >
                                                    User
                                                </option>
                                            </select>
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <div class="form-group mb-0">
                                                <input type="text" class="form-control form-control-sm aiz-date-range" id="search" name="date_range" placeholder="Daterange">
                                            </div>
                                        </div> -->
                                        <div class="col-md-2">
                                            <button class="btn btn-md btn-primary" type="submit">
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">

                                    <table class="table aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer</th>
                                                <th data-breakpoints="lg">Date</th>
                                                <th>Amount</th>
                                                <th data-breakpoints="lg">Payment method</th>
                                                <th data-breakpoints="lg" class="text-right">Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $page=isset($_GET['page'])?$_GET['page']:1;
                                            $i=0;

                                            $sql=mysqli_query($conn,"SELECT * FROM history_payment  ");
                                            if(isset($_GET['type']) && $_GET['type']=='seller') $sql=mysqli_query($conn,"SELECT * FROM history_payment  WHERE seller_id is not null");
                                            if(isset($_GET['type']) && $_GET['type']=='user') $sql=mysqli_query($conn,"SELECT * FROM history_payment  WHERE user_id is not null");

                                            while($row=fetch_assoc($sql)){
                                                $i++;
                                                if($i<=$page*15 && $i>($page-1)*15){}
                                                else continue;


                                                if($row['seller_id']!=""){
                                                    $seller=fetch_array("SELECT * FROM sellers WHERE id='{$row['seller_id']}' LIMIT 1");
                                                    $full_name=$seller['full_name'];
                                                }
                                                else{
                                                    $user=fetch_array("SELECT * FROM users WHERE id='{$row['user_id']}' LIMIT 1");
                                                    $full_name=$user['full_name'];
                                                }
                                            ?>
                                            <form action="">
                                            <tr>
                                                <td><?=$i?> <input type="text" hidden name="id"value="<?=$id?>"> <input type="text" hidden name="id"value="<?=$id?>"> </td>
                                                <td><?=$full_name?></td>
                                                <td><?=$row['create_date']?></td>
                                                <td><?=$row['amount']?>$</td>
                                                <td><?=$row['name_payment']?></td>
                                                <td class="text-right">
                                                    <span class="badge badge-inline badge-info"><?=$row['status']?></span>
                                                </td>
                                            </tr>
                                            </form>
                                            <?php }?>

                                            
                                        </tbody>
                                    </table>
                                    <div class="aiz-pagination mt-4">
                                        <nav>
                                            <ul class="pagination">

                                                <li class="page-item"  aria-label="« Previous">
                                                    <?php if($page==1){?><span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                    <?php }else{ ?>
                                                    <a class="page-link" href="/admin/report/wallet_history.php?page=<?=$page-1?>" rel="next" aria-label="« Previous">&lsaquo;</a>
                                                    <?php }?>

                                                </li>




                                                <?php if($page>1){?><li class="page-item  "><a class="page-link" href="/admin/report/wallet_history.php?page=<?=$page-1?>"><?=$page-1?></a></li><?php }?>
                                                <?php if($page>2){?><li class="page-item  "><a class="page-link" href="/admin/report/wallet_history.php?page=<?=$page-2?>"><?=$page-2?></a></li><?php }?>

                                                <li class="page-item active " aria-current="page"><span class="page-link"><?=$page?></span></li>
                                                <?php if($page+1<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/report/wallet_history.php?page=<?=$page+1?>"><?=$page+1?></a></li><?php }?>
                                                <?php if($page+2<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/report/wallet_history.php?page=<?=$page+2?>"><?=$page+2?></a></li><?php }?>



                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/report/wallet_history.php?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
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



    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
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
                        _token: 'yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP',
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