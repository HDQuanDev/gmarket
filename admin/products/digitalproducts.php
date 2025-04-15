<?php include("../../config.php");if (!$isLogin || !$isAdmin) header("Location: /"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb">
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

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="text-md-right">
                            <a href="##./digitalproduct_create.php" class="btn btn-circle btn-info">
                                <span><?=tran("Add New Product")?></span>
                            </a>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header row gutters-5">
                            <div class="col text-center text-md-left">
                                <h5 class="mb-md-0 h6"><?=tran("Digital Products")?></h5>
                            </div>
                            <div class="col-md-4">
                                <form class="" id="sort_digital_products" action="" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Type name &amp; Enter">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                    <th data-breakpoints="lg">#</th>
                                        <th><?=tran("Name")?></th>
                                        <th data-breakpoints="lg"><?=tran("Added By")?></th>
                                        <th data-breakpoints="sm"><?=tran("Photo")?></th>
                                        <th data-breakpoints="md"><?=tran("Base price")?></th>
                                        <th data-breakpoints="lg"><?=tran("Todays Deal")?></th>
                                        <th data-breakpoints="lg"><?=tran("Published")?></th>
                                        <th data-breakpoints="lg"><?=tran("Featured")?></th>
                                        <th data-breakpoints="sm" class="text-right"><?=tran("Options")?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="aiz-pagination">

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
        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/products/todays_deal', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Todays Deal updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/products/published', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Published products updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/products/featured', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Featured products updated successfully');
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
                        _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
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