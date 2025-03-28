<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="4bRYfDNsvQApU9ncbK3WvDmimAz8Ic4dLn4CWtXY">
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
                                <h1 class="h3"><?=tran("All uploaded files")?></h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="/admin/uploaded-files/create.php" class="btn btn-primary">
                                    <span><?=tran("Upload New File")?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <form id="sort_uploads" action="">
                            <div class="card-header row gutters-5">
                                <div class="col">
                                    <h5 class="mb-0 h6"><?=tran("All files")?></h5>
                                </div>
                                <div class="dropdown mb-2 mb-md-0">
                                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                                        Bulk Action
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" onclick="bulk_delete()"> Delete selection</a>
                                    </div>
                                </div>
                                <div class="col-md-3 ml-auto mr-0">
                                    <select class="form-control form-control-xs aiz-selectpicker" name="sort" onchange="sort_uploads()">
                                        <option value="newest">Sort by newest</option>
                                        <option value="oldest">Sort by oldest</option>
                                        <option value="smallest">Sort by smallest</option>
                                        <option value="largest">Sort by largest</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-xs" name="search" placeholder="Search your files" value="">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary"><?=tran("Search")?></button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <div class="aiz-checkbox-inline">
                                        <label class="aiz-checkbox">
                                            <?=tran("Select All")?>
                                            <input type="checkbox" class="check-all">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row gutters-5">



                                    




                                    <?php
                                    $page=isset($_GET['page'])?$_GET['page']:1;
                                    $i=0;
                                    $sql=mysqli_query($conn,"SELECT * FROM file WHERE id>($page-1)*60 and id<=$page*60 and status='active' ORDER by id desc LIMIT 60");
                                    while($row=fetch_assoc($sql)){
                                        $i++;
                                        
                                    ?>
                                    <div class="col-auto w-140px w-lg-220px">
                                        <div class="aiz-file-box">
                                            <div class="dropdown-file">
                                                <a class="dropdown-link" data-toggle="dropdown">
                                                    <i class="la la-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- <a href="javascript:void(0)" class="dropdown-item" onclick="detailsInfo(this)" data-id="48529">
                                                        <i class="las la-info-circle mr-2"></i>
                                                        <span>Details Info</span>
                                                    </a> -->
                                                    <a href="/public/uploads/all/PA2lJfZzgPXZIvuU5MUVefYMJlPiS6Ptip3QNCCm.jpg" target="_blank" download="434722122_407019058618083_890352495166560540_n.jpg" class="dropdown-item">
                                                        <i class="la la-download mr-2"></i>
                                                        <span><?=tran("Download")?></span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)" data-url="/public/uploads/all/PA2lJfZzgPXZIvuU5MUVefYMJlPiS6Ptip3QNCCm.jpg">
                                                        <i class="las la-clipboard mr-2"></i>
                                                        <span><?=tran("Copy Link")?></span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item confirm-alert" data-href="/admin/uploaded-files/destroy.php?id=<?=$row['id']?>" data-target="#delete-modal">
                                                        <i class="las la-trash mr-2"></i>
                                                        <span><?=tran("Delete")?></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="select-box">
                                                <div class="aiz-checkbox-inline">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="48529">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card card-file aiz-uploader-select c-default" title="434722122_407019058618083_890352495166560540_n.jpg">
                                                <div class="card-file-thumb">
                                                    <img src="/public/uploads/all/<?=$row['src']?>" class="img-fit">
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="d-flex">
                                                        <span class="text-truncate title">434722122_407019058618083_890352495166560540_n</span>
                                                        <span class="ext">.jpg</span>
                                                    </h6>
                                                    <p>312.99 KB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>




                                    
                                    
                                    
                                    
                                    
                                    
                                    <!-- <div class="col-auto w-140px w-lg-220px">
                                        <div class="aiz-file-box">
                                            <div class="dropdown-file">
                                                <a class="dropdown-link" data-toggle="dropdown">
                                                    <i class="la la-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                     <a href="javascript:void(0)" class="dropdown-item" onclick="detailsInfo(this)" data-id="48471">
                                                        <i class="las la-info-circle mr-2"></i>
                                                        <span><?=tran("Details Info")?></span>
                                                    </a> 
                                                    <a href="/public/uploads/all/CRWeUIr4NUF7al2x9YJoZEWGEOzyOlXDY0zv8Uie.png" target="_blank" download="image.png" class="dropdown-item">
                                                        <i class="la la-download mr-2"></i>
                                                        <span><?=tran("Download")?></span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)" data-url="/public/uploads/all/CRWeUIr4NUF7al2x9YJoZEWGEOzyOlXDY0zv8Uie.png">
                                                        <i class="las la-clipboard mr-2"></i>
                                                        <span><?=tran("Copy Link")?></span>
                                                    </a>
                                                     <a href="javascript:void(0)" class="dropdown-item confirm-alert" data-href="/admin/uploaded-files/destroy/48471" data-target="#delete-modal">
                                                        <i class="las la-trash mr-2"></i>
                                                        <span><?=tran("Delete")?></span>
                                                    </a> 
                                                </div>
                                            </div>
                                            <div class="select-box">
                                                <div class="aiz-checkbox-inline">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" class="check-one" name="id[]" value="48471">
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card card-file aiz-uploader-select c-default" title="image.png">
                                                <div class="card-file-thumb">
                                                    <img src="/public/uploads/all/CRWeUIr4NUF7al2x9YJoZEWGEOzyOlXDY0zv8Uie.png" class="img-fit">
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="d-flex">
                                                        <span class="text-truncate title">image</span>
                                                        <span class="ext">.png</span>
                                                    </h6>
                                                    <p>902.72 KB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->



                                </div>
                                <div class="aiz-pagination mt-3">
                                    <nav>
                                        <ul class="pagination">

                                        <li class="page-item"  aria-label="« Previous">
                                                    <?php if($page==1){?><span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                    <?php }else{ ?>
                                                    <a class="page-link" href="/admin/uploaded-files/?page=<?=$page-1?>" rel="next" aria-label="« Previous">&lsaquo;</a>
                                                    <?php }?>

                                                </li>




                                                <?php if($page>1){?><li class="page-item  "><a class="page-link" href="/admin/uploaded-files/?page=<?=$page-1?>"><?=$page-1?></a></li><?php }?>
                                                <?php if($page>2){?><li class="page-item  "><a class="page-link" href="/admin/uploaded-files/?page=<?=$page-2?>"><?=$page-2?></a></li><?php }?>

                                                <li class="page-item active " aria-current="page"><span class="page-link"><?=$page?></span></li>
                                                <?php if($page+1<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/uploaded-files/?page=<?=$page+1?>"><?=$page+1?></a></li><?php }?>
                                                <?php if($page+2<=intval($i/15)){?><li class="page-item  "><a class="page-link" href="/admin/uploaded-files/?page=<?=$page+2?>"><?=$page+2?></a></li><?php }?>



                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/uploaded-files/?page=<?=$page+1?>" rel="next" aria-label="Next »">&rsaquo;</a>
                                                </li>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; GMARKETVN v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">Are you sure to delete this file?</p>
                    <button type="button" class="btn btn-link mt-2" data-dismiss="modal">Cancel</button>
                    <a href="" class="btn btn-primary mt-2 comfirm-link">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div id="info-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">File Info</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
                    <div class="c-preloader text-center absolute-center">
                        <i class="las la-spinner la-spin la-3x opacity-70"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



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

        function detailsInfo(e) {
            $('#info-modal-content').html('<div class="c-preloader text-center absolute-center"><i class="las la-spinner la-spin la-3x opacity-70"></i></div>');
            var id = $(e).data('id')
            $('#info-modal').modal('show');
            $.post('https://tmdtquocte.com/admin/uploaded-files/file-info', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {
                $('#info-modal-content').html(data);
                // console.log(data);
            });
        }

        function copyUrl(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', 'Link copied to clipboard');
            } catch (err) {
                AIZ.plugins.notify('danger', 'Oops, unable to copy');
            }
            $temp.remove();
        }

        function sort_uploads(el) {
            $('#sort_uploads').submit();
        }

        function bulk_delete() {
            var data = new FormData($('#sort_uploads')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "https://tmdtquocte.com/admin/bulk-uploaded-files-delete",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    } else {
                        AIZ.plugins.notify('danger', 'Something went wrong!');
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
                    $.post('https://tmdtquocte.com/language', {
                        _token: '4bRYfDNsvQApU9ncbK3WvDmimAz8Ic4dLn4CWtXY',
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