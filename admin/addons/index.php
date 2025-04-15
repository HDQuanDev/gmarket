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

                    <div class="">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="nav border-bottom aiz-nav-tabs">
                                    <a class="p-3 fs-16 text-reset show active" data-toggle="tab" href="#installed">Installed Addon</a>
                                    <a class="p-3 fs-16 text-reset" data-toggle="tab" href="#available">Available Addon</a>
                                </div>
                            </div>
                            <div class="col mt-3 mt-sm-0 text-center text-md-right">
                                <a href="https://activeitzone.com/activation/addon" class="btn btn-primary" target="_blank">
                                    Activate Addon Link
                                </a>
                            </div>
                            <div class="col-auto mt-3 mt-sm-0 text-center text-md-right">
                                <a href="https://tmdtquocte.com/admin/addons/create" class="btn btn-primary">Install/Update Addon</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane fade in active show" id="installed">
                            <div class="row">
                                <div class="col-lg-8 mx-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/seller_subscription.jpg" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Seller Subscription System</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.8</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>000</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 1)" checked>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/pos_banner.jpg" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Point of Sale</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.3</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>1111</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 2)" checked>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/delivery_boy.png" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Delivery_boy</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>3.2</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>222</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 3)">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/wholesale.png" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Wholesale</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.3</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>333</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 4)">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/refund_request.png" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Refund</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.5</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>444</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 5)">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/paytm.png" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Asian Payment Gateway</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.5</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>555</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 6)">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/otp_system.png" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">OTP</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>2.1</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>666</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 7)">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/offline_banner.jpg" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Offline Payment</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.4</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>888</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 8)" checked>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/club_points.png" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Club_point</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.6</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>991</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 9)">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/auction.png" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Auction</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.4</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>992</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 10)">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/africanpg.jpg" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">African Payment Gateways</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.5</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>993</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 11)">
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row">
                                                        <img class="h-60px mb-3 mb-md-0" src="https://tmdtquocte.com/public/affiliate_banner.jpg" alt="Image">
                                                        <div class="mr-md-3 ml-md-5">
                                                            <h4 class="fs-16 fw-600">Affiliate</h4>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Version: </small>1.8</p>
                                                        </div>
                                                        <div class="mr-md-3 ml-0">
                                                            <p><small>Purchase code: </small>994</p>
                                                        </div>
                                                        <div class="ml-auto mr-0">
                                                            <label class="aiz-switch mb-0">
                                                                <input type="checkbox" onchange="updateStatus(this, 12)" checked>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="available">
                            <div class="row" id="available-addons-content">

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



    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>


    <script type="text/javascript">
        function updateStatus(el, id) {
            if ($(el).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('/admin/addons/activation', {
                _token: 'yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP',
                id: id,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Status updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong!');
                }
            });
        }

        $(document).ready(function() {
            $.post('https://activeitzone.com/addons/public/addons', {
                item: 'ecommerce'
            }, function(data) {
                //console.log(data);
                html = '';
                data.forEach((item, i) => {
                    if (item.link != null) {
                        html += `<div class="col-lg-4 col-md-6 ">
                                    <div class="card addon-card">
                                        <div class="card-body">
                                            <a href="${item.link}" target="_blank"><img class="img-fluid" src="${item.image}"></a>
                                            <div class="pt-4">
                                                <a class="fs-16 fw-600 text-reset" href="${item.link}" target="_blank">${item.name}</a>
                                                <div class="rating mb-2"><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i></div>
                                                <p class="mar-no text-truncate-3">${item.short_description}</p>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-danger fs-22 fw-600">$${item.price}</div>
                                            <div class=""><a href="${item.link}" target="_blank" class="btn btn-sm btn-secondary">Preview</a> <a href="${item.purchase}" target="_blank" class="btn btn-sm btn-primary">Purchase</a></div>
                                        </div>
                                    </div>
                                </div>`;
                    } else {
                        html += `<div class="col-lg-4 col-md-6 ">
                                    <div class="card addon-card">
                                        <div class="card-body">
                                            <a><img class="img-fluid" src="${item.image}"></a>
                                            <div class="pt-4">
                                                <a class="fs-16 fw-600 text-reset" >${item.name}</a>
                                                <div class="rating mb-2"><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i></div>
                                                <p class="mar-no text-truncate-3">${item.short_description}</p>
                                            </div>
                                            <div class="card-footer">
                                                <div class="text-center"><div class="btn btn-outline btn-primary">Coming Soon</div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    }

                });
                $('#available-addons-content').html(html);
            });
        })
    </script>

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