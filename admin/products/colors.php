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
                        <div class="align-items-center">
                            <h1 class="h3"><?=tran("All Colors")?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class=" col-lg-7 ">
                            <div class="card">
                                <form class="" id="sort_colors" action="" method="GET">
                                    <div class="card-header">
                                        <h5 class="mb-0 h6"><?=tran("Colors")?></h5>
                                        <div class="col-md-5">
                                            <div class="form-group mb-0">
                                                <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Type color name &amp; Enter">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="card-body">
                                    <table class="table aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?=tran("Name")?></th>
                                                <th class="text-right"><?=tran("Options")?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>M2ProMacBookPro14”and16”</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/144?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/144"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>MistyRose</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/133?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/133"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Ivory</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/129?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/129"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Silver</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/136?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/136"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>DarkGray</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/137?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/137"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>LightGrey</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/135?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/135"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>LavenderBlush</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/132?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/132"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Linen</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/131?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/131"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Gainsboro</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/134?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/134"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Gray</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="/admin/colors/edit/138?lang=en"
                                                        title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-href="/admin/colors/destroy/138"
                                                        title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="aiz-pagination">
                                        <nav>
                                            <ul class="pagination">

                                                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                </li>





                                                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=2">2</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=3">3</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=4">4</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=5">5</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=6">6</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=7">7</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=8">8</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=9">9</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=10">10</a></li>

                                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>





                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=14">14</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/colors?page=15">15</a></li>


                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/colors?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6">Add New Color</h5>
                                </div>
                                <div class="card-body">
                                    <form action="/admin/colors/store" method="POST">
                                        <input type="hidden" name="_token" value="bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb">
                                        <div class="form-group mb-3">
                                            <label for="name"><?=tran("Name")?></label>
                                            <input type="text" placeholder="<?=tran("Name")?>" id="name" name="name"
                                                class="form-control" value="" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name"><?=tran("Color Code")?></label>
                                            <input type="text" placeholder="<?=tran("Color Code")?>" id="code" name="code"
                                                class="form-control" value="" required>
                                        </div>
                                        <div class="form-group mb-3 text-right">
                                            <button type="submit" class="btn btn-primary"><?=tran("Save")?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 h6"><?=tran("Color filter activation")?></h3>
                                </div>
                                <div class="card-body text-center">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" onchange="updateSettings(this, 'color_filter_activation')" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; Gmarket Viet Nam v7.4.0</p>
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
        function updateSettings(el, type) {
            if ($(el).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }

            $.post('/admin/business-settings/update/activation', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                type: type,
                value: value
            }, function(data) {
                if (data == '1') {
                    AIZ.plugins.notify('success', 'Settings updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
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