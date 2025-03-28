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
                    <div class="row">
                        <div class="col-lg-10 col-xxl-8 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h6 mb-0">Server information</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped aiz-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th data-breakpoints="lg">Current Version</th>
                                                <th data-breakpoints="lg">Required Version</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Php versions</td>
                                                <td>8.1.13</td>
                                                <td>7.3 or 7.4</td>
                                                <td>
                                                    <i class="las la-times text-danger"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>MySQL</td>
                                                <td>
                                                    5.7.40-log
                                                </td>
                                                <td>5.6+</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h6 mb-0">php.ini Config</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped aiz-table">
                                        <thead>
                                            <tr>
                                                <th>Config Name</th>
                                                <th data-breakpoints="lg">Current</th>
                                                <th data-breakpoints="lg">Recommended</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>file_uploads</td>
                                                <td>
                                                    On
                                                </td>
                                                <td>On</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>max_file_uploads</td>
                                                <td>
                                                    200
                                                </td>
                                                <td>20+</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>upload_max_filesize</td>
                                                <td>
                                                    50M
                                                </td>
                                                <td>128M+</td>
                                                <td>
                                                    <i class="las la-times text-danger"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>post_max_size</td>
                                                <td>
                                                    500M
                                                </td>
                                                <td>128M+</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>allow_url_fopen</td>
                                                <td>
                                                    On
                                                </td>
                                                <td>On</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>max_execution_time</td>
                                                <td>
                                                    3000
                                                </td>
                                                <td>600+</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>max_input_time</td>
                                                <td>
                                                    600
                                                </td>
                                                <td>120+</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>max_input_vars</td>
                                                <td>
                                                    1000
                                                </td>
                                                <td>1000+</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>memory_limit</td>
                                                <td>
                                                    2560M
                                                </td>
                                                <td>256M+</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h6 mb-0">Extensions information</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Extension Name</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>bcmath</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ctype</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>json</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>mbstring</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>zip</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>zlib</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>openssl</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>tokenizer</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>xml</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>dom</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>curl</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>fileinfo</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>gd</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>pdo_mysql</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h6 mb-0">Filesystem Permissions</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>File or Folder</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>.env</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>public</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>app/Providers</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>app/Http/Controllers</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>storage</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>resources/views</td>
                                                <td>
                                                    <i class="las la-check text-success"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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