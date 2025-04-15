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
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <h1 class="h3"><?=tran("All products")?></h1>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="card">
                        <form class="" id="sort_products" action="" method="GET">
                            <div class="card-header row gutters-5">
                                <div class="col">
                                    <h5 class="mb-md-0 h6"><?=tran("All Products")?></h5>
                                </div>

                                <div class="dropdown mb-2 mb-md-0">
                                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                                        Bulk Action
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" onclick="bulk_delete()"> Delete selection</a>
                                    </div>
                                </div>

                                <div class="col-md-2 ml-auto" style="display:none">
                                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="user_id" name="user_id" onchange="sort_products()">
                                        <option value="">All Sellers</option>
                                        <option value="1397">
                                            Nhật Minh shop (Nhật Minh)
                                        </option>
                                        <option value="1457">
                                            Shop Mai Thảo (Mai Thảo)
                                        </option>
                                        <option value="1477">
                                            Anh Thư Shop (Anh Thư)
                                        </option>
                                        <option value="1622">
                                            Nszn (Kfn)
                                        </option>
                                        <option value="1679">
                                            Thao shop (Phương Thảo Mai)
                                        </option>
                                        <option value="1680">
                                            Đức Hiếu Shop (Đỗ Đức Hiếu)
                                        </option>
                                        <option value="1681">
                                            Tuệ Doanh Luxury (Phạm Tuệ Doanh)
                                        </option>
                                        <option value="1682">
                                            Thu Maria Shop (Thu Maria)
                                        </option>
                                        <option value="1683">
                                            Phạm Thu Mai (Phạm Thu Mai)
                                        </option>
                                        <option value="1685">
                                            Hoàng Tuyết Shop (Hoàng Tuyết)
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2 ml-auto">
                                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="vip" name="vip" onchange="window.location.href = window.location.pathname + '?vip=' + this.value">
                                        <option value="">Type</option>
                                        <option value="todays_deal">Todays Deal</option>
                                        <option value="featured">Featured</option>
                                        <option value="unpublished">Unpublished</option>
                                    </select>
                                </div>
                                <div class="col-md-2 ml-auto">
                                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="type" id="type" onchange="sort_products()">
                                        <option value="">Sort by</option>
                                        <option value="rating,desc">Rating (High &gt; Low)</option>
                                        <option value="rating,asc">Rating (Low &gt; High)</option>
                                        <option value="num_of_sale,desc">Num of Sale (High &gt; Low)</option>
                                        <option value="num_of_sale,asc">Num of Sale (Low &gt; High)</option>
                                        <option value="unit_price,desc">Base Price (High &gt; Low)</option>
                                        <option value="unit_price,asc">Base Price (Low &gt; High)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Type &amp; Enter">
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
                                            <th><?=tran("Name")?></th>
                                            <th data-breakpoints="lg"><?=tran("Added By")?></th>
                                            <th data-breakpoints="sm"><?=tran("Info")?></th>
                                            <th data-breakpoints="md"><?=tran("Total Stock")?></th>
                                            <th data-breakpoints="lg"><?=tran("Todays Deal")?></th>
                                            <th data-breakpoints="lg"><?=tran("Published")?></th>
                                            <th data-breakpoints="lg"><?=tran("Approved")?></th>
                                            <th data-breakpoints="lg"><?=tran("Featured")?></th>
                                            <th data-breakpoints="sm" class="text-right"><?=tran("Options")?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $page=isset($_GET['page'])?$_GET['page']:1;
                                        $i=0;


                                        $sql=mysqli_query($conn,"SELECT * FROM products WHERE seller_id is not null and id>($page-1)*10 and id<=$page*15");
                                        while($row=fetch_assoc($sql)){
                                            $logo=fetch_array("SELECT src FROM file WHERE id='{$row['files']}' ");$logo=$logo?$logo['src']:"";
                                            $seller=fetch_array("SELECT * FROM sellers WHERE id='{$row['seller_id']}' ");


                                            


                                            $i++;
                                            if($i<=$page*15 && $i>($page-1)*15){}
                                            else continue;


                                        ?>
                                        <tr>
                                            <td>
                                                <div class="form-group d-inline-block">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="<?=$row['id']?>">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row gutters-5 w-200px w-md-300px mw-100">
                                                    <div class="col-auto">
                                                        <img src="/public/uploads/all/<?=$logo?>" alt="Image" class="size-50px img-fit">
                                                    </div>
                                                    <div class="col">
                                                        <span class="text-muted text-truncate-2"><?=$row['name']?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?=$seller['shop_name']?></td>
                                            <td>
                                                <strong>Num of Sale:</strong> 1 Times </br>
                                                <strong>Base Price:</strong> <?=$row['unit_price']?>$ </br>
                                                <strong>Rating:</strong> 0 </br>
                                            </td>
                                            <td><?=$row['quantity']?></td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_todays_deal(this)" value="<?=$row['id']?>" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_published(this)" value="<?=$row['id']?>" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_approved(this)" value="<?=$row['id']?>" type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                    <input onchange="update_featured(this)" value="<?=$row['id']?>" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="/product/<?=md5($row['id'])?>" target="_blank" title="View">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/products/seller_product_edit.php?id=<?=$row['id']?>&lang=en" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="/admin/products/seller_duplicate.php?id=<?=$row['id']?>&type=Seller" title="Duplicate">
                                                    <i class="las la-copy"></i>
                                                </a>
                                                <!-- <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/products/destroy/<?=$row['id']?>" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> -->
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
                                                    <a class="page-link" href="/admin/products/seller_products.php?page=<?=$page-1?>" rel="next" aria-label="« Previous">&lsaquo;</a>
                                                    <?php }?>

                                                </li>




                                                <?php if($page>1){?><li class="page-item  "><a class="page-link" href="/admin/products/seller_products.php?page=<?=$page-1?>"><?=$page-1?></a></li><?php }?>
                                                <?php if($page>2){?><li class="page-item  "><a class="page-link" href="/admin/products/seller_products.php?page=<?=$page-2?>"><?=$page-2?></a></li><?php }?>

                                                <li class="page-item active " aria-current="page"><span class="page-link"><?=$page?></span></li>
                                                <?php if($page+1<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/products/seller_products.php?page=<?=$page+1?>"><?=$page+1?></a></li><?php }?>
                                                <?php if($page+2<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/products/seller_products.php?page=<?=$page+2?>"><?=$page+2?></a></li><?php }?>



                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/products/seller_products.php?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
                                                </li>
                                            </ul>
                                        </nav>

                                </div>
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

        function update_approved(el) {
            if (el.checked) {
                var approved = 1;
            } else {
                var approved = 0;
            }
            $.post('/admin/products/approved', {
                _token: 'bCxkcW798Uvx4H0cXu3YhndABNm1s8Gjf4dFJAtb',
                id: el.value,
                approved: approved
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Product approval update successfully');
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

        function sort_products(el) {
            $('#sort_products').submit();
        }

        function bulk_delete() {
            var data = new FormData($('#sort_products')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/bulk-product-delete",
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