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
                            <h1 class="h3">Inhouse Product sale report</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="GET">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Sort by Category :</label>
                                            <div class="col-md-5">
                                                <select id="demo-ease" class="aiz-selectpicker" name="category_id" required>
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
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Num of Sale</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Tiesu new technology three-dimensional 5D flower nail stickers embossed adhesive nail stickers exquisite series</td>
                                                <td>1256</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>naisl frosted toenail manicure pieces toe nail patches wholesale wearable nail products full stickers for nail salons</td>
                                                <td>674</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Foreign trade export to Russia/Uv Gel Nail Polish</td>
                                                <td>604</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Cross-border wholesale nail art jewelry alloy diamond jewelry three-dimensional love diamond ocean heart nail decoration accessories</td>
                                                <td>596</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Internet celebrity silver alloy butterfly nail art jewelry light luxury style high-end metal three-dimensional nail decoration small accessories wholesale</td>
                                                <td>586</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Cross-border foreign trade special supply of nail polish 60 colors solid color sequin nail polish one bottle one color nail polish factory wholesale</td>
                                                <td>585</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Nail polish wholesale 27 colors no-bake peelable nail polish summer new style odorless water-based peelable nail polish</td>
                                                <td>584</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>New arrival 42 colors of moisturizing skin jelly ice transparent color nail gel nail art shop ice transparent nude nail polish Glue set glue</td>
                                                <td>581</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Cross-border hot sale 48 colors UV light therapy nail polish set nail color glue wholesale nail polish Glue Wholesale</td>
                                                <td>580</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Autumn and winter new products bright starlight fine glitter broken diamond glue 12 colors net celebrity disco flash reflective broken diamond nail polish glue</td>
                                                <td>577</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Full-size manicure patch, free of engraving, semi-frosted, trapezoidal, fully pasted, pointed nails, water drop fake nails, 500 boxes</td>
                                                <td>574</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Manicure Nail Patch NO-C Semi-Patch Nail Patch XXL Water Pipe Nail Patch Wearable Nail Patch Fake Nail 500 Pieces Cross-Border Nail</td>
                                                <td>570</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Nail Art Accessories Small Crown Moon Butterfly Super Flash Silver Alloy Square Diamond Internet Celebrity Full Diamond Bow Nail Accessories</td>
                                                <td>569</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Eight big and eight small Shiyue face pointed bottom nail art diamonds 4/6/8mm Shiyue face crystal glass diamond DIY jewelry a</td>
                                                <td>569</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>TENCOCO hot selling 12ML phototherapy nail polish set glue nail polish color glue beauty Nail Polish</td>
                                                <td>569</td>
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
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=2">2</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=3">3</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=4">4</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=5">5</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=6">6</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=7">7</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=8">8</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=9">9</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=10">10</a></li>

                                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>





                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=2241">2241</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/in_house_sale_report.php?page=2242">2242</a></li>


                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/in_house_sale_report.php?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
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