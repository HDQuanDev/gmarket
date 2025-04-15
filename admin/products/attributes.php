<?php include("../../config.php");
if (!$isLogin || !$isAdmin) header("Location: /"); ?>

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
        <?php include("../layout/sidebar.php") ?>

        <div class="aiz-content-wrapper">
            <?php include("../layout/topbar.php") ?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="align-items-center">
                            <h1 class="h3"><?=tran("All Attributes")?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class=" col-lg-7 ">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Attributes")?></h5>
                                </div>
                                <div class="card-body">
                                    <table class="table aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?=tran("Name")?></th>
                                                <th><?=tran("Values")?></th>
                                                <th class="text-right"><?=tran("Options")?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Variation</td>
                                                <td>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">1 With 3 Samples</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">1 With Mini Serum Cream</span>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="/admin/attributes/4" title="Attribute values">
                                                        <i class="las la-cog"></i>
                                                    </a>
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/attributes/edit/4?lang=en" title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/attributes/destroy/4" title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Weight</td>
                                                <td>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">140 package</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">210 chip</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">210 g</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">140 chip</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">140 ml</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">140 g</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">70 sheet</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">70 ml</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">70 g</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">Cm</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">L</span>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="/admin/attributes/3" title="Attribute values">
                                                        <i class="las la-cog"></i>
                                                    </a>
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/attributes/edit/3?lang=en" title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/attributes/destroy/3" title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Size</td>
                                                <td>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">4.5</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">5</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">5.5</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">6</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">6.5</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">7</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">7.5</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">8</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">8.5</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">9</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">9.5</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">10</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">10.5</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">XXL</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">XL</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">L</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">M</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">S</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">XS</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">1</span>
                                                    <span class="badge badge-inline badge-md bg-soft-dark">2</span>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="/admin/attributes/1" title="Attribute values">
                                                        <i class="las la-cog"></i>
                                                    </a>
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/attributes/edit/1?lang=en" title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/attributes/destroy/1" title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Add New Attribute")?></h5>
                                </div>
                                <div class="card-body">
                                    <form action="/admin/attributes" method="POST">
                                        <input type="hidden" name="_token" value="bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb">
                                        <div class="form-group mb-3">
                                            <label for="name"><?=tran("Name")?></label>
                                            <input type="text" placeholder="<?=tran("Name")?>" id="name" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3 text-right">
                                            <button type="submit" class="btn btn-primary"><?=tran("Save")?></button>
                                        </div>
                                    </form>
                                </div>
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