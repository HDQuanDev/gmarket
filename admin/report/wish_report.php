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

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class=" align-items-center">
                            <h1 class="h3">Product Wish Report</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form action="#/admin/wish_report" method="GET">
                                        <div class="form-group row offset-lg-2">
                                            <label class="col-md-3 col-form-label">Sort by Category:</label>
                                            <div class="col-md-5">
                                                <select id="demo-ease" class="from-control aiz-selectpicker" name="category_id" required>
                                                    <option value="1">Ladies clothing</option>
                                                    <option value="2">Men&#039;s clothing</option>
                                                    <option value="3">Electronics - Refrigeration</option>
                                                    <option value="4">Mother and baby items</option>
                                                    <option value="7">Jewelry &amp; Watches</option>
                                                    <option value="8">Smart Phone, Tablet and Accessory</option>
                                                    <option value="9">Sports</option>
                                                    <option value="11">Toy</option>
                                                    <option value="12">Beauty salons</option>
                                                    <option value="13">Shoes</option>
                                                    <option value="14">Interior - Decoration</option>
                                                    <option value="16">Pet accessories</option>
                                                    <option value="17">Home electric</option>
                                                    <option value="18">Perfume</option>
                                                    <option value="20">Cars - Motorcycles - Bicycles - Accessories</option>
                                                    <option value="21">Camera Camcorder</option>
                                                    <option value="22">Kitchen accessories</option>
                                                    <option value="23">Fashion accessories</option>
                                                    <option value="24">Nail and eyelash accessories</option>
                                                    <option value="25">Baby shoes</option>
                                                    <option value="26">Functional foods - Health</option>
                                                    <option value="27">Nutritional milk</option>
                                                    <option value="28">Backpack - Suitcase</option>
                                                    <option value="29">Hand Bag</option>
                                                    <option value="30">Snacks</option>
                                                    <option value="31">Beer - Wine - Drinks</option>
                                                    <option value="32">Souvenir</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary" type="submit">Filter</button>
                                            </div>
                                        </div>
                                    </form>

                                    <table class="table table-bordered aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Number of Wish</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Grass Rattan Teng Woven Storage Cabinet Drawer Woven Wardrobe Wardrobe Creative Bedside Locker Pastoral Rattan Home</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Cabinet Locker Multi-Functional Creative Large Capacity Home Fashion Simple Storage Cabinet Drawer Wooden Nordic</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>[Bulky] Wooden Multi Rack / Telephone Rack / Side Table / Utility Rack</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Meiling desktop circulation fan light sound electric fan household shaking head small fan student desktop turbine convection table fan</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Factory direct supply BlenderY-88 electric mixer stainless steel cup cooking machine export British regulations European regulations US regulations</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>New handheld fan USB rechargeable cross-border small fan portable student gift household mini small fan</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Home Use Mini Donut Maker Cookies Cake Machine Electric Roun</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Jewin Factory 1500W 5.5L Electric Multi-Grill with Hotpo t</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Electric Coffee Maker 220V Portable Home Office Moka Pot Gre</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Grill pan home roast meat hot pot pot electric grill pan home barbecue 1</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="aiz-pagination mt-4">
                                        <nav>
                                            <ul class="pagination">

                                                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                </li>





                                                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=2">2</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=3">3</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=4">4</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=5">5</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=6">6</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=7">7</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=8">8</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=9">9</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=10">10</a></li>

                                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>





                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=3587">3587</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/wish_report.php?page=3588">3588</a></li>


                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/wish_report.php?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
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