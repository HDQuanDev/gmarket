
<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a">
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
                        <div class="align-items-center">
                            <h1 class="h3"><?=tran("All Customers")?></h1>
                        </div>
                    </div>


                    <div class="card">

                        <form class="" id="sort_customers" action="" method="GET">
                            <div class="card-header row gutters-5">
                                <div class="col">
                                    <h5 class="mb-0 h6"><?=tran("Customers")?></h5>
                                </div>

                                <div class="dropdown mb-2 mb-md-0">
                                    <button type="button" class="layui-btn" onclick="add_user();"><?=tran("Add new")?></button>
                                </div>

                                <div class="dropdown mb-2 mb-md-0" style="margin-left: 20px;">
                                    <!-- <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                                        Bulk Action
                                    </button> -->
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" onclick="bulk_delete()"><?=tran("Delete selection")?></a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Type email or name &amp; Enter">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table aiz-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-all">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th data-breakpoints="lg">#</th>
                                            <th><?=tran("Name")?></th>
                                            <th data-breakpoints="lg"><?=tran("Email Address")?></th>
                                            <th data-breakpoints="lg"><?=tran("Phone")?></th>
                                            <th data-breakpoints="lg"><?=tran("Addess")?></th>
                                            <th data-breakpoints="lg"><?=tran("Wallet Balance")?></th>
                                            <th data-breakpoints="lg"><?=tran("Created Date")?></th>
                                            <th class="text-right"><?=tran("Options")?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $page=isset($_GET['page'])?$_GET['page']:1;

                                        $i=0;
                                        $page=isset($_GET['page'])?$_GET['page']:1;

                                        $sql=mysqli_query($conn,"SELECT * FROM sellers ");
                                        if(isset($_GET['search']) && $_GET['search']!="#" && $_GET['search']!="") $sql=mysqli_query($conn,"SELECT * FROM sellers WHERE full_name LIKE '%{$_GET['search']}%' ");
                                        while($row=fetch_assoc($sql)){
                                            $i++;
                                            if($i<=$page*15 && $i>($page-1)*15){}
                                            else continue;

                                        ?>
                                        <tr>

                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="1919">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td><?=$row['full_name']?> - <a href="/shop/<?=md5($row['id'])?>" style="color:green"><?=$row['shop_name']?></a></td>
                                            <td><?=$row['email']?></td>
                                            <td><?=$row['phone']?></td>
                                            <td>
                                                <?=$row['shop_address']?>
                                            </td>
                                            <td><?=currency($row['money'])?>$</td>
                                            <td><?=$row['create_date']?></td>
                                            
                                            <td class="text-right">
                                                <button type="button" class="btn btn-soft-primary btn-icon btn-circle btn-sm" onclick="show_payment_modal('<?=$row['id']?>');" title="Pay Now">
                                                    <i class="las la-money-bill"></i>
                                                </button>
                                                <a href="/admin/customers/login.php?seller_id=<?=$row['id']?>" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Log in as this Customer">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <!-- <button type="button" href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="confirm_ban('/admin/customers/ban.php?id=<?=$row['id']?>');" title="Ban this Customer">
                                                    <i class="las la-user-slash"></i>
                                                </button>
                                                <button type="button" href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/customers/destroy.php?id=<?=$row['id']?>" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </button> -->
                                            </td>
                                        </tr>
                                        <?php }?>
                                        
                                    </tbody>
                                </table>
                                <div class="aiz-pagination">
                                    <nav>
                                        <ul class="pagination">

                                            <li class="page-item"  aria-label="« Previous">
                                            <?php if($page==1){?><span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            <?php }else{ ?>
                                            <a class="page-link" href="/admin/customers/sellers.php?page=<?=$page-1?>" rel="next" aria-label="« Previous">&lsaquo;</a>
                                            <?php }?>
                                            </li>




                                            <?php if($page>1){?><li class="page-item  "><a class="page-link" href="/admin/customers/sellers.php?page=<?=$page-1?>"><?=$page-1?></a></li><?php }?>
                                            <?php if($page>2){?><li class="page-item  "><a class="page-link" href="/admin/customers/sellers.php?page=<?=$page-2?>"><?=$page-2?></a></li><?php }?>

                                            <li class="page-item active " aria-current="page"><span class="page-link"><?=$page?></span></li>
                                            <?php if($page+1<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/customers/sellers.php?page=<?=$page+1?>"><?=$page+1?></a></li><?php }?>
                                            <?php if($page+2<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/customers/sellers.php?page=<?=$page+2?>"><?=$page+2?></a></li><?php }?>



                                            <li class="page-item">
                                                <a class="page-link" href="/admin/customers/sellers.php?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
                                            </li>

                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="modal fade" id="confirm-ban">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h6"><?=tran("Confirmation")?></h5>
                                    <button type="button" class="close" data-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><?=tran("Do you really want to ban this Customer")?>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal"><?=tran("Cancel")?></button>
                                    <a type="button" id="confirmation" class="btn btn-primary"><?=tran("Proceed")?>!</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="confirm-unban">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h6"><?=tran("Confirmation")?></h5>
                                    <button type="button" class="close" data-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you really want to unban this Customer?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                    <a type="button" id="confirmationunban" class="btn btn-primary">Proceed!</a>
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
    <div class="modal fade" id="payment_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
        $(function() {
            $('#payment_option').change(function() {
                var data = $(this).val();
                var id = $(this).attr('uid');
                if (!data || !id) {
                    alert('Vui lòng chọn một nhân viên');
                    return false;
                }
                $.post('/admin/staffs', {
                    _token: 'y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a',
                    id: id,
                    pantname: data,
                    type: 'setype'
                }, function(data) {
                    $('#payment_modal #modal-content').html(data);
                    $('#payment_modal').modal('show', {
                        backdrop: 'static'
                    });
                    AIZ.plugins.bootstrapSelect('refresh');
                });
            });

            $('.check').val('two').trigger('change');
        });
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        function show_payment_modal(id) {
            $.get('/admin/customers/payment.php?is_seller', {
                _token: 'y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a',
                id: id
            }, function(data) {
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        function add_user() {
            $.get('/admin/customers/add_users.php', {
                _token: 'y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a'
            }, function(data) {
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                AIZ.plugins.bootstrapSelect('refresh');
            });
        }

        function sort_customers(el) {
            $('#sort_customers').submit();
        }

        function confirm_ban(url) {
            $('#confirm-ban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmation').setAttribute('href', url);
        }

        function confirm_unban(url) {
            $('#confirm-unban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmationunban').setAttribute('href', url);
        }

        function bulk_delete() {
            var data = new FormData($('#sort_customers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/bulk-customer-delete",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
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
                        _token: 'y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a',
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