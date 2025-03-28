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
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3">All staffs</h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="https://tmdtquocte.com/admin/staffs/create" class="btn btn-circle btn-info">
                                    <span>Add New Staffs</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">Staffs</h5>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="lg" width="10%">#</th>
                                        <th>Name</th>
                                        <th data-breakpoints="lg">Email</th>
                                        <th data-breakpoints="lg">Phone</th>
                                        <th data-breakpoints="lg">Role</th>
                                        <th width="10%">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>mion</td>
                                        <td>mion@8686</td>
                                        <td>123123</td>
                                        <td>
                                            Nhân viên
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6Inl2eldGclhiQkQwR3lodWdGeXdUa2c9PSIsInZhbHVlIjoiQjkyZnBSZi92U041VVduQ2RRcVJsZz09IiwibWFjIjoiYzk5ZjBlYzFhNTA2YzEwMTgwNzQ0MTA3YTM3Mzk1MmRmM2ViMmI1ODI3OWRjYWU2NTkzNmY2MzdmNTNmZjdmZSIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/42" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>sgb</td>
                                        <td>sgb@999</td>
                                        <td>888888</td>
                                        <td>
                                            Nhân viên
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6InhZZjVkSEFjZElhdXFPWTlpTTRkRlE9PSIsInZhbHVlIjoiQVF0NEpKdEM5M2xlNE5zNVBZOStSQT09IiwibWFjIjoiNTZjNDk3Y2QyZjJmMDliZjNlODNhZmIxNDBhNjhkODM5ZmNkMzJlNmRkMzBmMjJkYTcxZTYzYzg1ZWQzMDgzOSIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/44" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>yun</td>
                                        <td>yun@888</td>
                                        <td>888888</td>
                                        <td>
                                            Nhân viên
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6IjNOeWs5RW44R2NUWmdRK08zYWZ1dlE9PSIsInZhbHVlIjoieFFDSnhzRXMwR1R6WXlqdVVPeEV2Zz09IiwibWFjIjoiZjdhNjE3YjYwZDk1YjQxOGIyOTk4OGNhZDc0MDNiYzJhNDdjNGI5YmQ0NmU1Nzc3ZGU0Njg3ZGM2NDljNGJhMiIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/45" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>VN01VIET</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="23554d13131263444e424a4f0d404c4e">[email&#160;protected]</a></td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a1d7cf919190e1c6ccc0c8cd8fc2cecc">[email&#160;protected]</a></td>
                                        <td>
                                            admin2
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6IjYyMEhhRlJQWHF3SzNtWThlN1hMZVE9PSIsInZhbHVlIjoiMlF2SFVxQzFJUFJtclNHQVMraWhJdz09IiwibWFjIjoiZDg4ZThlZDY2NDgwYjkzZTlkNGJkYTk3OTQzOWQyNzU2YmMxMzQ0NzE2MzRkNjdkNzcxMzVjMDU2ZWI4MDIwZiIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/46" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>VN002</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3b6d750b0b097b5c565a525715585456">[email&#160;protected]</a></td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="acfae29c9c9eeccbc1cdc5c082cfc3c1">[email&#160;protected]</a></td>
                                        <td>
                                            Đặt đơn
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6ImNwRWpiWmpSemUzSHNKSXN1QmJOUWc9PSIsInZhbHVlIjoiVCtLd3dIbmZSQ3ZlWFBPTERTN1JUdz09IiwibWFjIjoiOTZhMmNlZGM5Y2MxMTY1YmNmOTI4MTEyZDU3ODQyMTVmZDhjOGE3MDFkZWJkZGJiM2M5YzRjMjY5OGI1ZmU0MiIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/47" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>VN03</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="ecbaa2dcdfac8b818d8580c28f8381">[email&#160;protected]</a></td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="eeb8a0deddae89838f8782c08d8183">[email&#160;protected]</a></td>
                                        <td>
                                            Nhân viên
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6ImN1cVhZd20xbGpUV2F6Q3NwZXZpdVE9PSIsInZhbHVlIjoiTEl1TEIrQVZWbExoWDNOUDkzeFBqZz09IiwibWFjIjoiMjZjMTI4ZjVhYWViZmI0Y2ViOTA3MzZlZDM3MTNlMDZkYmQwZjZmZGE3NzgxMDIwY2QwMjFhN2YwOTkxYzE3NCIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/48" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>VN07</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="12445c222552555f535b5e3c515d5f">[email&#160;protected]</a></td>
                                        <td>0583024129</td>
                                        <td>
                                            admin2
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6IlBtQ0hqRlZrVStuWEQvV0pxT2gySGc9PSIsInZhbHVlIjoiWkN5OGZHMEZCdWMrRy9lbzdWdG04QT09IiwibWFjIjoiMjI1YjRiMDcxMDU2MWE5NWNjMTdmMjY5ZWMyZjYxYWM0YWY3OTg3ODVlYmIwYjM3MmVjYzIzYmI3MzJmN2FkMCIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/49" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>vn003</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="cdbba3fdfdfe8daaa0aca4a1e3aea2a0">[email&#160;protected]</a></td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="9aecf4aaaaa9dafdf7fbf3f6b4f9f5f7">[email&#160;protected]</a></td>
                                        <td>
                                            Nhân viên
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6ImkwSSs0a1k1N3krcjVLWmVISzhsOUE9PSIsInZhbHVlIjoieFRhdm1hdmg2cmlIdE5Tb3JpRHByQT09IiwibWFjIjoiMTE2MDNiNTgyZmEwNzUzYTY0OWY3Mjc5OTIwOWJmOGU0MjQ1ZTI3MGM1MjQxNTc4NjE5MzQxYTM0OGIwOTc2NCIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/50" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>VN04</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0e58403e3a4e69636f6762206d6163">[email&#160;protected]</a></td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e6b0a8d6d2a6818b878f8ac885898b">[email&#160;protected]</a></td>
                                        <td>
                                            Nhân viên
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6InZ5QUU2d0NBZElZU2oyN1RiL013MFE9PSIsInZhbHVlIjoiR3hEU3E2dEppN0xFVXZSR2lHS2VZUT09IiwibWFjIjoiODczOWZjZjg1YjdkODBiNTIwMzFiMTc1ZTM3ZmVkZjMyOWZlYmRkOWJmOTUzY2FmZTk2OGZkNWI5OTRlMGYxNiIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/51" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>hyz</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c1a9b8bba3aeb881a6aca0a8adefa2aeac">[email&#160;protected]</a></td>
                                        <td>0833977094</td>
                                        <td>
                                            Nhân viên
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="https://tmdtquocte.com/admin/staffs/eyJpdiI6ImJhb0VCMi9ieGNvNmtoVFFrTXhmREE9PSIsInZhbHVlIjoiYjJXRVVwUDVOd0x6ZUNWc0E3M2RxZz09IiwibWFjIjoiMmU1MzBlYmRjMWY3MjVhY2E0YmMyYWMzNjY1MmE3YjJhZGZjNDdlMDZjMTYzYjEwMGE1YzZiNDZkNzMyMTE3OSIsInRhZyI6IiJ9/edit" title="Edit">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="https://tmdtquocte.com/admin/staffs/destroy/52" title="Delete">
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
                                        <li class="page-item"><a class="page-link" href="https://tmdtquocte.com/admin/staffs?page=2">2</a></li>
                                        <li class="page-item"><a class="page-link" href="https://tmdtquocte.com/admin/staffs?page=3">3</a></li>


                                        <li class="page-item">
                                            <a class="page-link" href="https://tmdtquocte.com/admin/staffs?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
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