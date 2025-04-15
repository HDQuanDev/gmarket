<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="ba8eR0VFECdim0UFFTz9qhkAFsT2N7Lk9a6JougV">
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

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6"><?=tran("All Subscribers")?></h5>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="lg">#</th>
                                        <th><?=tran("Email")?></th>
                                        <th data-breakpoints="lg"><?=tran("Date")?></th>
                                        <th data-breakpoints="lg" class="text-right"><?=tran("Options")?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $page=isset($_GET['page'])?$_GET['page']:1;
                                    
                                    $i=0;
                                    $sql=mysqli_query($conn,"SELECT * FROM marketing_subscribers ");
                                    while($row=fetch_assoc($sql)){
                                        $i++;
                                        if($i<=$page*15 && $i>($page-1)*15){}
                                        else continue;
                                    ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td>
                                            <div class="text-truncate"><?=$row['email']?></div>
                                        </td>
                                        <td><?=$row['create_date']?></td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/subscribers/destroy/252" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    
                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="pull-right">
                                    <nav>
                                        <ul class="pagination">

                                        <li class="page-item"  aria-label="« Previous">
                                                    <?php if($page==1){?><span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                    <?php }else{ ?>
                                                    <a class="page-link" href="/admin/marketing/subscribers.php?page=<?=$page-1?>" rel="next" aria-label="« Previous">&lsaquo;</a>
                                                    <?php }?>

                                                </li>




                                                <?php if($page>1){?><li class="page-item  "><a class="page-link" href="/admin/marketing/subscribers.php?page=<?=$page-1?>"><?=$page-1?></a></li><?php }?>
                                                <?php if($page>2){?><li class="page-item  "><a class="page-link" href="/admin/marketing/subscribers.php?page=<?=$page-2?>"><?=$page-2?></a></li><?php }?>

                                                <li class="page-item active " aria-current="page"><span class="page-link"><?=$page?></span></li>
                                                <?php if($page+1<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/marketing/subscribers.php?page=<?=$page+1?>"><?=$page+1?></a></li><?php }?>
                                                <?php if($page+2<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/marketing/subscribers.php?page=<?=$page+2?>"><?=$page+2?></a></li><?php }?>



                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/marketing/subscribers.php?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
                                                </li>
                                        </ul>
                                    </nav>

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

    <!-- delete Modal -->
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">Are you sure to delete this?</p>
                    <button type="button" class="btn btn-link mt-2" data-dismiss="modal">Cancel</button>
                    <a href="" id="delete-link" class="btn btn-primary mt-2">Delete</a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->


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
                        _token: 'ba8eR0VFECdim0UFFTz9qhkAFsT2N7Lk9a6JougV',
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

    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'8d5f295d4ee28541',t:'MTcyOTQ5MTgzNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
</body>

</html>