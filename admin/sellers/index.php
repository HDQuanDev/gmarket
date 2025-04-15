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

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3"><?=tran("All Sellers")?></h1>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <form class="" id="sort_sellers" action="" method="GET">
                            <div class="card-header row gutters-5">
                                <div class="col">
                                    <h5 class="mb-md-0 h6"><?=tran("Sellers")?></h5>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Type name or email & Enter">
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
                                            <th>Name</th>
                                            <th data-breakpoints="lg"><?=tran("Phone")?></th>
                                            <th data-breakpoints="lg"><?=tran("Email Address")?></th>
                                            <th data-breakpoints="lg"><?=tran("Verification Info")?></th>
                                            <th data-breakpoints="lg"><?=tran("Approval")?></th>
                                            <th data-breakpoints="lg"><?=tran("Num. of Products")?></th>
                                            <th data-breakpoints="lg"><?=tran("Due to seller")?></th>
                                            <!--<th data-breakpoints="lg">Đại lý</th>-->
                                            <th width="10%"><?=tran("Created Date")?></th>
                                            <th width="10%"><?=tran("Options")?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $page=isset($_GET['page'])?$_GET['page']:1;
                                        $i=0;
                                        $sql=mysqli_query($conn,"SELECT  * FROM sellers ORDER by id desc");
                                        // if(isset($_GET['search']) && $_GET['search']!=""){$search=$_GET['search'];$sql=mysqli_query($conn,"SELECT  * FROM sellers WHERE (full_name like '%$search%' or email like '%$search%') ORDER by id desc");}
                                        while($row=fetch_assoc($sql)){
                                            $i++;
                                            if($i<=$page*10 && $i>($page-1)*10){}
                                            else continue;

                                            $count_product=intval(fetch_array("SELECT IFNULL(count(*),0) as count FROM products WHERE seller_id='{$row['id']}'")['count']);
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="aiz-checkbox-inline">
                                                        <label class="aiz-checkbox">
                                                            <input type="checkbox" class="check-one" name="id[]" value="<?=$row['id']?>">
                                                            <span class="aiz-square-check"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?=$row['full_name']?></td>
                                            <td></td>
                                            <td><strong style="color:green"><?=$row['email']?></strong></td>
                                            <td>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input
                                                        onchange="update_approved(this)" value="<?=$row['id']?>" type="checkbox"
                                                        <?php if($row['status'] == 'active') echo 'checked'; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td><?=$count_product?></td>
                                            <td>
                                                0.00$
                                            </td>
                                            <td><?=$row['create_date']?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm btn-circle btn-soft-primary btn-icon dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="las la-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-md">
                                                        <a href="#" onclick="show_seller_profile('<?=$row['id']?>');" class="dropdown-item">
                                                            Profile
                                                        </a>
                                                        <a href="/admin/sellers/login.php?seller_id=<?=$row['id']?>" class="dropdown-item">
                                                            Log in as this Seller
                                                        </a>
                                                        <a href="/admin/sellers/seller_edit.php?id=<?=$row['id']?>" class="dropdown-item">
                                                            Edit Profile
                                                        </a>
                                                        <a href="#" onclick="confirm_ban('/admin/sellers/ban.php?id=<?=$row['id']?>');" class="dropdown-item">
                                                            Ban this seller
                                                            <i class="fa fa-ban text-danger" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="#" class="dropdown-item confirm-delete" data-href="/admin/sellers/destroy.php?id=<?=$row['id']?>" class="">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        
                                    </tbody>
                                </table>
                                <!--<div class="aiz-pagination">-->
                                <!--    <nav>-->
                                <!--        <ul class="pagination">-->
                                <!--            <li class="page-item"  aria-label="« Previous">-->
                                <!--                <?php if($page==1){?><span class="page-link" aria-hidden="true">&lsaquo;</span>-->
                                <!--                <?php }else{ ?>-->
                                <!--                <a class="page-link" href="/admin/sellers/index.php?page=<?=$page-1?>" rel="next" aria-label="« Previous">&lsaquo;</a>-->
                                <!--                <?php }?>-->
                                <!--            </li>-->


                                <!--            <?php if($page>1){?><li class="page-item  "><a class="page-link" href="/admin/sellers/index.php?page=<?=$page-1?>"><?=$page-1?></a></li><?php }?>-->
                                <!--            <?php if($page>2){?><li class="page-item  "><a class="page-link" href="/admin/sellers/index.php?page=<?=$page-2?>"><?=$page-2?></a></li><?php }?>-->
                                <!--            <li class="page-item active " aria-current="page"><span class="page-link"><?=$page?></span></li>-->
                                <!--            <?php if($page+1<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/sellers/index.php?page=<?=$page+1?>"><?=$page+1?></a></li><?php }?>-->
                                <!--            <?php if($page+2<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/sellers/index.php?page=<?=$page+2?>"><?=$page+2?></a></li><?php }?>-->


                                <!--            <li class="page-item">-->
                                <!--                <a class="page-link" href="/admin/sellers/index.php?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>-->
                                <!--            </li>-->
                                <!--        </ul>-->
                                <!--    </nav>-->

                                <!--</div>-->
                            </div>
                        </form>
                    </div>

                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0"></p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <!-- Delete Modal -->
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

    <!-- Seller Profile Modal -->
    <div class="modal fade" id="profile_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="profile-modal-content">

            </div>
        </div>
    </div>

    <!-- Seller Payment Modal -->
    <div class="modal fade" id="payment_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="payment-modal-content">

            </div>
        </div>
    </div>

    <!-- Ban Seller Modal -->
    <div class="modal fade" id="confirm-ban">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to ban this seller?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" id="confirmation">Proceed!</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Unban Seller Modal -->
    <div class="modal fade" id="confirm-unban">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to unban this seller?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" id="confirmationunban">Proceed!</a>
                </div>
            </div>
        </div>
    </div>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
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
        $(document).on("change", ".payment_option", function() {
            var data = $(this).val();
            var id = $(this).find("option:selected").attr("uid");
            //console.log(data+'--'+id);
            if (!data || !id) {
                //alert('Vui lòng chọn một nhân viên');
                //return false;
            }
            $.post('/admin/sellers/payment_modal', {
                _token: 'ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT',
                id: id,
                pantname: data,
                type: 'setype'
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Approved sellers updated successfully');
                    AIZ.plugins.bootstrapSelect('refresh');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        });

        function show_seller_payment_modal(id) {
            $.post('/admin/sellers/payment_modal.php', {
                _token: 'ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT',
                id: id
            }, function(data) {
                $('#payment_modal #payment-modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                $('.demo-select2-placeholder').select2();
            });
        }

        function show_seller_profile(id) {
            $.post('/admin/sellers/profile_modal.php', {
                _token: 'ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT',
                id: id
            }, function(data) {
                $('#profile_modal #profile-modal-content').html(data);
                $('#profile_modal').modal('show', {
                    backdrop: 'static'
                });
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var status = 'active';
            } else {
                var status = 'lock';
            }
            $.post('/admin/sellers/approved.php', {
                _token: 'ipFnQztuiy1MNweUaMWxj2Zehpt9XnKJaoHzWGuT',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Seller status updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        function sort_sellers(el) {
            $('#sort_sellers').submit();
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
            var data = new FormData($('#sort_sellers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/bulk-seller-delete",
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

</body>

</html>