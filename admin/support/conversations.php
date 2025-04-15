<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="PuAewTX5kmdSazKZ0Z4IpWC0TzD6LOAo7z78ENxR">
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

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">Conversations</h5>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="lg">#</th>
                                        <th data-breakpoints="lg">Date</th>
                                        <th data-breakpoints="lg">Title</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th width="10%" class="text-right">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql=mysqli_query($conn,"SELECT conversation_id,id,type,create_date FROM conversation_details  GROUP BY conversation_id ORDER BY id desc LIMIT 50");
                                    while($row=fetch_assoc($sql)){
                                        $conversation=fetch_array("SELECT * FROM conversations WHERE id='{$row['conversation_id']}'");
                                        if(!$conversation)continue;

                                        $product=fetch_array("SELECT name FROM products WHERE id='{$conversation['product_id']}' LIMIT 1");

                                        $seller=fetch_array("SELECT full_name FROM sellers WHERE id='{$conversation['seller_id']}' LIMIT 1");
                                        $user=fetch_array("SELECT full_name FROM users WHERE id='{$conversation['user_id']}' LIMIT 1");

                                        if($row['type']=='user'){
                                            $sender=$user['full_name'];
                                            $receiver=$seller['full_name'];
                                        }
                                        else{
                                            $sender=$seller['full_name'];
                                            $receiver=$user['full_name'];
                                        }

                                    ?>
                                    <tr>
                                        <td>1</td>
                                        <td><?=$row['create_date']?></td>
                                        <td><?=$product['name']?></td>
                                        <td>
                                            <?=$sender?>
                                        </td>
                                        <td>
                                            <?=$receiver?>
                                        </td>
                                        <td class="text-right">
                                            <label class="aiz-switch aiz-switch-success mb-0">

                                                <input type="checkbox" name="refundable" data-status="1" class="refsetpas" data="1029" checked>
                                                <span></span>
                                            </label>
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="./conversation_show.php?id=<?=$row['id']?>" title="View">
                                                <i class="las la-eye"></i>
                                            </a>
                                            <!-- <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/conversations/destroy/eyJpdiI6IkEwaWh5Nm83RHYzZlI2V1NRK3E2M1E9PSIsInZhbHVlIjoiVko2VTNlREk5MXFnTThZRklWTS9iUT09IiwibWFjIjoiMTBhYmJiYzE0N2E4ZTgwZDg5NWFjYTgzZTAwZDJiODY2YjM3MTlhMmQwMTEyOWM3NjVlMWZkNTUwYzU0ZjFmMiIsInRhZyI6IiJ9" title="Delete">
                                                <i class="las la-trash"></i>
                                            </a> -->
                                        </td>
                                    </tr>
                                    <?php }?>
                                    
                                    
                                    
                                    
                                    



                                </tbody>
                            </table>
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


    <script src="https://gmarket-quocte.com/public/assets/js/vendors.js"></script>
    <script src="https://gmarket-quocte.com/public/assets/js/aiz-core.js"></script>



    <script type="text/javascript">
        $(document).on("change", ".refsetpas", function() {
            var status = 0;
            if ($(this).attr('data-status') == 0) {
                status = 1;
                $(this).attr('data-status', 1);
            } else {
                status = 0;
                $(this).attr('data-status', 0);
            }
            var id = $(this).attr('data');

            $.post('https://gmarket-quocte.com/admin/conversations/showedit', {
                _token: 'PuAewTX5kmdSazKZ0Z4IpWC0TzD6LOAo7z78ENxR',
                id: id,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Featured products updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });

        });

        function setpas(id, status) {
            $.post('https://gmarket-quocte.com/admin/conversations/showedit', {
                _token: 'PuAewTX5kmdSazKZ0Z4IpWC0TzD6LOAo7z78ENxR',
                id: id,
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
                    $.post('https://gmarket-quocte.com/language', {
                        _token: 'PuAewTX5kmdSazKZ0Z4IpWC0TzD6LOAo7z78ENxR',
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