<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="XuoZ4GhCuke85ZgiUSBsuFcCY7mJDgio6H80JeU9">
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

                    <div class="col-lg-10 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">Create New Seller Package</h5>
                            </div>
                            <?php 
                            if(isset($_POST['submit'])){
                                $name=$_POST['name'];
                                $amount=$_POST['amount'];
                                $people=$_POST['people'];
                                $duration=$_POST['duration'];
                                $logo=$_POST['logo'];

                                @mysqli_query($conn,"INSERT into through_trains(name,amount,people,duration,logo,create_date)values('$name','$amount','$people','$duration','$logo','$createDate')");
                                echo "<script>window.location.href='/admin/through_train/sellers.php'</script>";



                            }
                            
                            ?>
                            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="XuoZ4GhCuke85ZgiUSBsuFcCY7mJDgio6H80JeU9">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-from-label" for="name">Package Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Name" id="name" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-from-label" for="amount">Amount</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="0.01" placeholder="Amount" id="amount" name="amount" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-from-label" for="people">People Reached</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="1" placeholder="People Reached" id="people" name="people" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-from-label" for="duration">Duration</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="0" step="1" placeholder="Validity in number of days" id="duration" name="duration" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="signinSrEmail">Package Logo</label>
                                        <div class="col-md-10">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                </div>
                                                <div class="form-control file-amount">Choose File</div>
                                                <input type="hidden" name="logo" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="submit" class="btn btn-sm btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
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
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
                        _token: 'XuoZ4GhCuke85ZgiUSBsuFcCY7mJDgio6H80JeU9',
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