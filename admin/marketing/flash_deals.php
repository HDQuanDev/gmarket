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
            nothing_selected: '<?=tran("Nothing selected")?>',
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
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3"><?=tran("All Flash Deals")?></h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="#/admin/flash_deals/create" class="btn btn-circle btn-info">
                                    <span><?=tran("Create New Flash Deal")?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6"><?=tran("Flash deals")?></h5>
                            <div class="pull-right clearfix">
                                <form class="" id="sort_flash_deals" action="" method="GET">
                                    <div class="box-inline pad-rgt pull-left">
                                        <div class="" style="min-width: 200px;">
                                            <input type="text" class="form-control" id="search" name="search" placeholder="Type name &amp; Enter">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="lg">#</th>
                                        <th><?=tran("Title")?></th>
                                        <th data-breakpoints="lg"><?=tran("Banner")?></th>
                                        <th data-breakpoints="lg"><?=tran("Start Date")?></th>
                                        <th data-breakpoints="lg"><?=tran("End Date")?></th>
                                        <th data-breakpoints="lg"><?=tran("Status")?></th>
                                        <th data-breakpoints="lg"><?=tran("Featured")?></th>
                                        <th data-breakpoints="lg"><?=tran("Page Link")?></th>
                                        <th class="text-right"><?=tran("Options")?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>flas sale</td>
                                        <td><img src="#/public/uploads/all/Ie4aH14iazZp2067U77htPOJs8c6AMp6T5sKRRXQ.png" alt="banner" class="h-50px"></td>
                                        <td>10-12-2023 00:00:00</td>
                                        <td>05-04-2024 23:59:00</td>
                                        <td>
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input onchange="update_flash_deal_status(this)" value="1" type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input
                                                    onchange="update_flash_deal_feature(this)" value="1" type="checkbox"
                                                    checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>#/flash-deal/flas-sale-Ikd9t</td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="#/admin/flash_deals/edit/1?lang=en" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="#/admin/flash_deals/destroy/1" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="pull-right">

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


    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
        function update_flash_deal_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/flash_deals/update_status', {
                _token: 'yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    location.reload();
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        function update_flash_deal_feature(el) {
            if (el.checked) {
                var featured = 1;
            } else {
                var featured = 0;
            }
            $.post('https://tmdtquocte.com/admin/flash_deals/update_featured', {
                _token: 'yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP',
                id: el.value,
                featured: featured
            }, function(data) {
                if (data == 1) {
                    location.reload();
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }
    </script>

    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('https://tmdtquocte.com/language', {
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

    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'8d1cacba3be7a8cc',t:'MTcyODc5NDY2OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
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