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
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="h3">Website Pages</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0 fw-600">All Pages</h6>
                            <a href="#/admin/website/custom-pages/create" class="btn btn-primary">Add New Page</a>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="lg">#</th>
                                        <th>Name</th>
                                        <th data-breakpoints="md">URL</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>

                                        <td><a href="https://tmdtquocte.com/home" class="text-reset">Home Page</a></td>
                                        <td>https://tmdtquocte.com</td>

                                        <td class="text-right">
                                            <a href="#/admin/website/custom-pages/edit/home?lang=en&amp;page=home" class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
                                                <i class="las la-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>

                                        <td><a href="https://tmdtquocte.com/seller-policy" class="text-reset">Seller Policies</a></td>
                                        <td>https://tmdtquocte.com/seller-policy</td>

                                        <td class="text-right">
                                            <a href="#/admin/website/custom-pages/edit/seller-policy?lang=en" class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
                                                <i class="las la-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>

                                        <td><a href="https://tmdtquocte.com/return-policy" class="text-reset">Return Items You Ordered</a></td>
                                        <td>https://tmdtquocte.com/return-policy</td>

                                        <td class="text-right">
                                            <a href="#/admin/website/custom-pages/edit/return-policy?lang=en" class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
                                                <i class="las la-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>

                                        <td><a href="https://tmdtquocte.com/support-policy" class="text-reset">Gmarket Partner Service Policy</a></td>
                                        <td>https://tmdtquocte.com/support-policy</td>

                                        <td class="text-right">
                                            <a href="#/admin/website/custom-pages/edit/support-policy?lang=en" class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
                                                <i class="las la-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>

                                        <td><a href="https://tmdtquocte.com/terms" class="text-reset">Term Conditions Page</a></td>
                                        <td>https://tmdtquocte.com/terms</td>

                                        <td class="text-right">
                                            <a href="#/admin/website/custom-pages/edit/terms?lang=en" class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
                                                <i class="las la-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>

                                        <td><a href="https://tmdtquocte.com/privacy-policy" class="text-reset">Gmarketvn.com Privacy</a></td>
                                        <td>https://tmdtquocte.com/privacy-policy</td>

                                        <td class="text-right">
                                            <a href="#/admin/website/custom-pages/edit/privacy-policy?lang=en" class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
                                                <i class="las la-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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