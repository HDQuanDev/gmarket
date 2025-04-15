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

                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">Seller Verification Form</h5>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <input type="hidden" name="_token" value="ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT">
                                    <div class="row">
                                        <div class="col-lg-8 form-horizontal" id="form">
                                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                <input type="hidden" name="type[]" value="text">
                                                <div class="col-lg-3">
                                                    <label class="col-from-label">Text</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input class="form-control" type="text" name="label[]" value="" placeholder="Label">
                                                </div>
                                                <div class="col-lg-2"><span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span></div>
                                            </div>
                                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                <input type="hidden" name="type[]" value="text">
                                                <div class="col-lg-3">
                                                    <label class="col-from-label">Text</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input class="form-control" type="text" name="label[]" value="Shop name" placeholder="Label">
                                                </div>
                                                <div class="col-lg-2"><span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span></div>
                                            </div>
                                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                <input type="hidden" name="type[]" value="text">
                                                <div class="col-lg-3">
                                                    <label class="col-from-label">Text</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input class="form-control" type="text" name="label[]" value="Email" placeholder="Label">
                                                </div>
                                                <div class="col-lg-2"><span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span></div>
                                            </div>
                                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                <input type="hidden" name="type[]" value="text">
                                                <div class="col-lg-3">
                                                    <label class="col-from-label">Text</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input class="form-control" type="text" name="label[]" value="Address" placeholder="Label">
                                                </div>
                                                <div class="col-lg-2"><span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span></div>
                                            </div>
                                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                <input type="hidden" name="type[]" value="file">
                                                <div class="col-lg-3">
                                                    <label class="col-from-label">File</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input class="form-control" type="text" name="label[]" value="Số Điện Thoại" placeholder="Label">
                                                </div>
                                                <div class="col-lg-2"><span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span></div>
                                            </div>
                                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                <input type="hidden" name="type[]" value="file">
                                                <div class="col-lg-3">
                                                    <label class="col-from-label">File</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input class="form-control" type="text" name="label[]" value="Ảnh đại diện" placeholder="Label">
                                                </div>
                                                <div class="col-lg-2"><span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span></div>
                                            </div>
                                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                                <input type="hidden" name="type[]" value="text">
                                                <div class="col-lg-3">
                                                    <label class="col-from-label">Text</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input class="form-control" type="text" name="label[]" value="" placeholder="Label">
                                                </div>
                                                <div class="col-lg-2"><span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">

                                            <ul class="list-group">
                                                <li class="list-group-item btn" style="text-align: left;" onclick="appenddToForm('text')">Text Input</li>
                                                <li class="list-group-item btn" style="text-align: left;" onclick="appenddToForm('select')">Select</li>
                                                <li class="list-group-item btn" style="text-align: left;" onclick="appenddToForm('multi-select')">Multiple Select</li>
                                                <li class="list-group-item btn" style="text-align: left;" onclick="appenddToForm('radio')">Radio</li>
                                                <li class="list-group-item btn" style="text-align: left;" onclick="appenddToForm('file')">File</li>
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
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
        var i = 0;

        function add_customer_choice_options(em) {
            var j = $(em).closest('.form-group.row').find('.option').val();
            var str = '<div class="form-group row">' +
                '<div class="col-sm-6 col-sm-offset-4">' +
                '<input class="form-control" type="text" name="options_' + j + '[]" value="" required>' +
                '</div>' +
                '<div class="col-sm-2"> <span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span>' +
                '</div>' +
                '</div>'
            $(em).parent().find('.customer_choice_options_types_wrap_child').append(str);
        }

        function delete_choice_clearfix(em) {
            $(em).parent().parent().remove();
        }

        function appenddToForm(type) {
            //$('#form').removeClass('seller_form_border');
            if (type == 'text') {
                var str = '<div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">' +
                    '<input type="hidden" name="type[]" value="text">' +
                    '<div class="col-lg-3">' +
                    '<label class="col-from-label">Text</label>' +
                    '</div>' +
                    '<div class="col-lg-7">' +
                    '<input class="form-control" type="text" name="label[]" placeholder="Label">' +
                    '</div>' +
                    '<div class="col-lg-2">' +
                    '<span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span>' +
                    '</div>' +
                    '</div>';
                $('#form').append(str);
            } else if (type == 'select') {
                i++;
                var str = '<div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">' +
                    '<input type="hidden" name="type[]" value="select"><input type="hidden" name="option[]" class="option" value="' + i + '">' +
                    '<div class="col-lg-3">' +
                    '<label class="col-from-label">Select</label>' +
                    '</div>' +
                    '<div class="col-lg-7">' +
                    '<input class="form-control" type="text" name="label[]" placeholder="Select Label" style="margin-bottom:10px">' +
                    '<div class="customer_choice_options_types_wrap_child">'

                    +
                    '</div>' +
                    '<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>' +
                    '</div>' +
                    '<div class="col-lg-2">' +
                    '<span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span>' +
                    '</div>' +
                    '</div>';
                $('#form').append(str);
            } else if (type == 'multi-select') {
                i++;
                var str = '<div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">' +
                    '<input type="hidden" name="type[]" value="multi_select"><input type="hidden" name="option[]" class="option" value="' + i + '">' +
                    '<div class="col-lg-3">' +
                    '<label class="col-from-label">Multiple select</label>' +
                    '</div>' +
                    '<div class="col-lg-7">' +
                    '<input class="form-control" type="text" name="label[]" placeholder="Multiple Select Label" style="margin-bottom:10px">' +
                    '<div class="customer_choice_options_types_wrap_child">'

                    +
                    '</div>' +
                    '<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>' +
                    '</div>' +
                    '<div class="col-lg-2">' +
                    '<span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span>' +
                    '</div>' +
                    '</div>';
                $('#form').append(str);
            } else if (type == 'radio') {
                i++;
                var str = '<div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">' +
                    '<input type="hidden" name="type[]" value="radio"><input type="hidden" name="option[]" class="option" value="' + i + '">' +
                    '<div class="col-lg-3">' +
                    '<label class="col-from-label">Radio</label>' +
                    '</div>' +
                    '<div class="col-lg-7">' +
                    '<div class="customer_choice_options_types_wrap_child">' +
                    '<input class="form-control" type="text" name="label[]" placeholder="Radio Label" style="margin-bottom:10px">'

                    +
                    '</div>' +
                    '<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>' +
                    '</div>' +
                    '<div class="col-lg-2">' +
                    '<span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span>' +
                    '</div>' +
                    '</div>';
                $('#form').append(str);
            } else if (type == 'file') {
                var str = '<div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">' +
                    '<input type="hidden" name="type[]" value="file">' +
                    '<div class="col-lg-3">' +
                    '<label class="col-from-label">File</label>' +
                    '</div>' +
                    '<div class="col-lg-7">' +
                    '<input class="form-control" type="text" name="label[]" placeholder="Label">' +
                    '</div>' +
                    '<div class="col-lg-2">' +
                    '<span class="btn btn-icon btn-circle icon-lg" onclick="delete_choice_clearfix(this)"><i class="las la-times"></i></span>' +
                    '</div>' +
                    '</div>';
                $('#form').append(str);
            }
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