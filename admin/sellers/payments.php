<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT">
    <meta name="app-url" content="//gmarket-quocte.com/">
    <meta name="file-base-url" content="//gmarket-quocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
    <title>Gmarket Viet Nam | Buy Korean domestic products at original prices from the manufacturer</title>

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

                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 h6">Seller Payments</h3>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="lg">#</th>
                                        <th data-breakpoints="lg">Date</th>
                                        <th>Seller</th>
                                        <th>Amount</th>
                                        <th data-breakpoints="lg">Payment Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $page=isset($_GET['page'])?$_GET['page']:1;
                                    $i=0;
                                    $sql=mysqli_query($conn,"SELECT * FROM history_payment WHERE seller_id is not null and id>($page-1)*10 and id<=$page*10");
                                    while($row=fetch_assoc($sql)){
                                        $seller=fetch_array("SELECT * FROM sellers WHERE id='{$row['seller_id']}' LIMIT 1");
                                        if(!$seller)continue;

                                        $i++;
                                        if($i<=$page*15 && $i>($page-1)*15){}
                                        else continue;
                                    ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$row['create_date']?></td>
                                        <td>
                                            <?=$seller['full_name']?> ( <?=$seller['shop_name']?>)
                                        </td>
                                        <td>
                                            <?=$row['amount']?>$
                                        </td>
                                        <td>Bank payment </td>
                                    </tr>
                                    <?php }?>
                                    
                                </tbody>
                            </table>
                            <div class="aiz-pagination">
                            <nav>
                                            <ul class="pagination">

                                                <li class="page-item"  aria-label="« Previous">
                                                    <?php if($page==1){?><span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                    <?php }else{ ?>
                                                    <a class="page-link" href="/admin/sellers/payments.php?page=<?=$page-1?>" rel="next" aria-label="« Previous">&lsaquo;</a>
                                                    <?php }?>

                                                </li>




                                                <?php if($page>1){?><li class="page-item  "><a class="page-link" href="/admin/sellers/payments.php?page=<?=$page-1?>"><?=$page-1?></a></li><?php }?>
                                                <?php if($page>2){?><li class="page-item  "><a class="page-link" href="/admin/sellers/payments.php?page=<?=$page-2?>"><?=$page-2?></a></li><?php }?>

                                                <li class="page-item active " aria-current="page"><span class="page-link"><?=$page?></span></li>
                                                <?php if($page+1<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/sellers/payments.php?page=<?=$page+1?>"><?=$page+1?></a></li><?php }?>
                                                <?php if($page+2<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/sellers/payments.php?page=<?=$page+2?>"><?=$page+2?></a></li><?php }?>



                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/sellers/payments.php?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
                                                </li>
                                            </ul>
                                        </nav>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0"></p>
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
                        _token: 'ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT',
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