<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="3p5l8u6VIdvfsdtb3Yo0crd2vdDbPppm1jXQxA6F">
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
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3"><?=tran("All categories")?></h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <!-- <a href="/admin/categories/create.php" class="btn btn-primary">
                                    <span>Add New category</span>
                                </a> -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-block d-md-flex">
                            <h5 class="mb-0 h6"><?=tran("Categories")?></h5>
                            <form class="" id="sort_categories" action="" method="GET">
                                <div class="box-inline pad-rgt pull-left">
                                    <div class="" style="min-width: 200px;">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Type name &amp; Enter">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="lg">#</th>
                                        <th><?=tran("Name")?></th>
                                        <th data-breakpoints="lg"><?=tran("Parent Category")?></th>
                                        <th data-breakpoints="lg"><?=tran("Order Level")?></th>
                                        <th data-breakpoints="lg"><?=tran("Level")?></th>
                                        <th data-breakpoints="lg"><?=tran("Banner")?></th>
                                        <th data-breakpoints="lg"><?=tran("Icon")?></th>
                                        <th data-breakpoints="lg"><?=tran("Featured")?></th>
                                        <th data-breakpoints="lg"><?=tran("Commission")?></th>
                                        <th width="10%" class="text-right"><?=tran("Options")?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql=mysqli_query($conn,"SELECT * FROM categories");
                                    $i=0;

                                    while($row=fetch_assoc($sql)){
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$row['name']?></td>
                                        <td>
                                            —
                                        </td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <img src="/public/uploads/all/<?=$row['banner']?>" alt="Banner" class="h-50px">
                                        </td>
                                        <td>
                                            <span class="avatar avatar-square avatar-xs">
                                                <img src="/public/uploads/all/<?=$row['img']?>" alt="Icon">
                                            </span>
                                        </td>
                                        <td>
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" onchange="update_featured(this)" value="1" checked>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>0 %</td>
                                        <td class="text-right">
                                            <!-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/categories/edit/1?lang=en" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a> -->
                                            <!-- <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/categories/destroy/1" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a> -->
                                        </td>
                                    </tr>
                                    <?php }?>
                                   
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                   
                                    
                                   
                                    
                                    
                                </tbody>
                            </table>
                            <div class="aiz-pagination">
                                <nav>
                                    <ul class="pagination">

                                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                        </li>





                                        <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                        <!-- <li class="page-item"><a class="page-link" href="/admin/categories?page=2">2</a></li> -->


                                        <li class="page-item">
                                            <a class="page-link" href="/admin/categories?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
                                        </li>
                                    </ul>
                                </nav>

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
        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/categories/featured', {
                _token: '3p5l8u6VIdvfsdtb3Yo0crd2vdDbPppm1jXQxA6F',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Featured categories updated successfully');
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
                    $.post('/language', {
                        _token: '3p5l8u6VIdvfsdtb3Yo0crd2vdDbPppm1jXQxA6F',
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