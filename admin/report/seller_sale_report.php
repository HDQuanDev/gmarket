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
    <title>GMARKETVN | Buy Korean domestic products at original prices from the manufacturer</title>

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
                            <h1 class="h3">Seller Based Selling Report</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="GET">
                                        <div class="form-group row offset-lg-2">
                                            <label class="col-md-3 col-form-label">Sort by verificarion status :</label>
                                            <div class="col-md-5">
                                                <select class="from-control aiz-selectpicker" name="verification_status" required>
                                                    <option value="1">Approved</option>
                                                    <option value="0">Non Approved</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary" type="submit">Filter</button>
                                            </div>
                                        </div>
                                    </form>

                                    <table class="table table-bordered aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Seller Name</th>
                                                <th data-breakpoints="lg">Shop Name</th>
                                                <!-- <th data-breakpoints="lg">Number of Product Sale</th> -->
                                                <th>Order Count</th>
                                                <th>Total sold</th>

                                                <th>Rose</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $page=isset($_GET['page'])?$_GET['page']:1;
                                            $i=0;

                                            $sql=mysqli_query($conn,"SELECT * FROM sellers LIMIT 10");
                                            while($row=fetch_assoc($sql)){
                                                $checkSeller=fetch_array("SELECT IFNULL(sum(rose*quantity),0) as rose,IFNULL(count(*),0) as count,IFNULL(sum(price*quantity),0) as sum FROM detail_orders WHERE from_seller='{$row['id']}'");
                                                // if(!$checkSeller)continue;


                                                $i++;
                                                if($i<=$page*15 && $i>($page-1)*15){}
                                                else continue;
                                            ?>
                                            <tr>
                                                <td><?=$row['full_name']?> - <a href="/shop/<?=md5($row['id'])?>" style='color:green'><?=$row['shop_name']?></a></td>
                                                <td>--</td>
                                                <td>
                                                    <?=$checkSeller['count']?>
                                                </td>
                                                <td>
                                                <?=$checkSeller['sum']?>$
                                                </td>
                                                <td>
                                                <?=$checkSeller['rose']?>$
                                                </td>
                                            </tr>
                                            <?php }?>
                                           
                                        </tbody>
                                    </table>
                                    <div class="aiz-pagination mt-4">
                                    <nav>
                                        <ul class="pagination">

                                            <li class="page-item"  aria-label="« Previous">
                                            <?php if($page==1){?><span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            <?php }else{ ?>
                                            <a class="page-link" href="/admin/reports/seller_sales_report.php?page=<?=$page-1?>" rel="next" aria-label="« Previous">&lsaquo;</a>
                                            <?php }?>
                                            </li>




                                            <?php if($page>1){?><li class="page-item  "><a class="page-link" href="/admin/reports/seller_sales_report.php?page=<?=$page-1?>"><?=$page-1?></a></li><?php }?>
                                            <?php if($page>2){?><li class="page-item  "><a class="page-link" href="/admin/reports/seller_sales_report.php?page=<?=$page-2?>"><?=$page-2?></a></li><?php }?>

                                            <li class="page-item active " aria-current="page"><span class="page-link"><?=$page?></span></li>
                                            <?php if($page+1<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/reports/seller_sales_report.php?page=<?=$page+1?>"><?=$page+1?></a></li><?php }?>
                                            <?php if($page+2<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/reports/seller_sales_report.php?page=<?=$page+2?>"><?=$page+2?></a></li><?php }?>



                                            <li class="page-item">
                                                <a class="page-link" href="/admin/reports/seller_sales_report.php?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
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
                    <p class="mb-0">&copy; GMARKETVN v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->



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