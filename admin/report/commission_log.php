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
                            <h1 class="h3">Commission History Report</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="card">
                                <form action="#/admin/commission-log" method="GET">
                                    <div class="card-header row gutters-5">
                                        <div class="col text-center text-md-left">
                                            <h5 class="mb-md-0 h6">Commission History</h5>
                                        </div>
                                        <div class="col-md-3 ml-auto">
                                            <select id="demo-ease" class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="seller_id">
                                                <option value="">Choose Seller</option>
                                                <option value="1726">
                                                    Nguyen Hong Thuy
                                                </option>
                                                <option value="1729">
                                                    Phạm Tuệ Doanh
                                                </option>
                                                <option value="1739">
                                                    nguyễn thị thùy
                                                </option>
                                                <option value="1756">
                                                    minhtrang12
                                                </option>
                                                <option value="1757">
                                                    Amy Nguyen
                                                </option>
                                                <option value="1760">
                                                    Dang thanh Tam
                                                </option>
                                                <option value="1761">
                                                    CONG TIEN TRAN
                                                </option>
                                                <option value="1762">
                                                    Trần Quang Minh
                                                </option>
                                                <option value="1764">
                                                    Tran Tien
                                                </option>
                                                <option value="1765">
                                                    Lê Thị Tuyết
                                                </option>
                                                <option value="1767">
                                                    Jessica Vo
                                                </option>
                                                <option value="1768">
                                                    LIEN
                                                </option>
                                                <option value="1769">
                                                    Nguyễn Thu Hà
                                                </option>
                                                <option value="1770">
                                                    nhu y
                                                </option>
                                                <option value="1771">
                                                    Julie nguyen
                                                </option>
                                                <option value="1773">
                                                    Pham tam phuc
                                                </option>
                                                <option value="1775">
                                                    Amy
                                                </option>
                                                <option value="1776">
                                                    Lenna Phan
                                                </option>
                                                <option value="1777">
                                                    Trang
                                                </option>
                                                <option value="1778">
                                                    Angel truong
                                                </option>
                                                <option value="1780">
                                                    TÂM
                                                </option>
                                                <option value="1781">
                                                    Tony Nguyen
                                                </option>
                                                <option value="1782">
                                                    Chi
                                                </option>
                                                <option value="1784">
                                                    Võ Thị Phương Lan
                                                </option>
                                                <option value="1789">
                                                    Vo Phuc
                                                </option>
                                                <option value="1790">
                                                    Kevin Nguyen
                                                </option>
                                                <option value="1792">
                                                    tien ngo
                                                </option>
                                                <option value="1793">
                                                    Van Juan Tran
                                                </option>
                                                <option value="1795">
                                                    Chía Shop
                                                </option>
                                                <option value="1796">
                                                    Diễm Nguyễn
                                                </option>
                                                <option value="1797">
                                                    CHRISTIAN HO
                                                </option>
                                                <option value="1798">
                                                    kim le
                                                </option>
                                                <option value="1800">
                                                    Linh
                                                </option>
                                                <option value="1801">
                                                    Nguyễn Thị Minh
                                                </option>
                                                <option value="1805">
                                                    Đỗ Hiếu
                                                </option>
                                                <option value="1806">
                                                    Kim Gary
                                                </option>
                                                <option value="1808">
                                                    Truong thi tuyet nhung
                                                </option>
                                                <option value="1809">
                                                    Nhi
                                                </option>
                                                <option value="1810">
                                                    KristyThao
                                                </option>
                                                <option value="1811">
                                                    Leon Nguyen
                                                </option>
                                                <option value="1812">
                                                    Loc truong
                                                </option>
                                                <option value="1813">
                                                    Xuan
                                                </option>
                                                <option value="1814">
                                                    Nina Tran
                                                </option>
                                                <option value="1815">
                                                    Paul Nguyen
                                                </option>
                                                <option value="1816">
                                                    Thao
                                                </option>
                                                <option value="1818">
                                                    Ut Chang
                                                </option>
                                                <option value="1819">
                                                    Thanh Minh Pham
                                                </option>
                                                <option value="1820">
                                                    Kristine Nguyen
                                                </option>
                                                <option value="1821">
                                                    Kari bui
                                                </option>
                                                <option value="1822">
                                                    Linh La
                                                </option>
                                                <option value="1823">
                                                    Duy Thai Nguyen
                                                </option>
                                                <option value="1824">
                                                    dat ly
                                                </option>
                                                <option value="1825">
                                                    Nga Nguyen
                                                </option>
                                                <option value="1826">
                                                    Mandy Van
                                                </option>
                                                <option value="1827">
                                                    Thu Hang
                                                </option>
                                                <option value="1828">
                                                    Kristy
                                                </option>
                                                <option value="1829">
                                                    July Mai Nguyễn
                                                </option>
                                                <option value="1830">
                                                    Destiny
                                                </option>
                                                <option value="1832">
                                                    HA
                                                </option>
                                                <option value="1833">
                                                    Hà Tú Phấn
                                                </option>
                                                <option value="1834">
                                                    David
                                                </option>
                                                <option value="1835">
                                                    Nhan Thanh
                                                </option>
                                                <option value="1836">
                                                    Tuyen
                                                </option>
                                                <option value="1837">
                                                    Khoa Nghiem
                                                </option>
                                                <option value="1838">
                                                    Lana Nguyen
                                                </option>
                                                <option value="1839">
                                                    Kenny Pham
                                                </option>
                                                <option value="1840">
                                                    Nguyễn Thúy Hằng
                                                </option>
                                                <option value="1841">
                                                    TopCopia
                                                </option>
                                                <option value="1842">
                                                    Nancy huynh
                                                </option>
                                                <option value="1844">
                                                    Michealchan To
                                                </option>
                                                <option value="1845">
                                                    Thanh dinh
                                                </option>
                                                <option value="1846">
                                                    Cathy Zimmerman
                                                </option>
                                                <option value="1847">
                                                    Hang Vu
                                                </option>
                                                <option value="1849">
                                                    Anh nguyen
                                                </option>
                                                <option value="1850">
                                                    Thu Thi nguyen
                                                </option>
                                                <option value="1852">
                                                    Danny Nguyen
                                                </option>
                                                <option value="1853">
                                                    THIVAN PHAM
                                                </option>
                                                <option value="1854">
                                                    Laney Tran
                                                </option>
                                                <option value="1855">
                                                    CUONG HUNG NGUYEN
                                                </option>
                                                <option value="1856">
                                                    Nancy huynh
                                                </option>
                                                <option value="1857">
                                                    Ngo Thi kim Thoa
                                                </option>
                                                <option value="1858">
                                                    Hong Vo
                                                </option>
                                                <option value="1859">
                                                    Emily pham
                                                </option>
                                                <option value="1860">
                                                    NHUNG LE
                                                </option>
                                                <option value="1861">
                                                    Nhan
                                                </option>
                                                <option value="1881">
                                                    Ngọc Do ,t
                                                </option>
                                                <option value="1882">
                                                    Thuy Tran
                                                </option>
                                                <option value="1883">
                                                    Cẩm hương thì Nguyễn
                                                </option>
                                                <option value="1884">
                                                    Tiana
                                                </option>
                                                <option value="1885">
                                                    nông Huế linh
                                                </option>
                                                <option value="1886">
                                                    Trang quach
                                                </option>
                                                <option value="1887">
                                                    Ha
                                                </option>
                                                <option value="1888">
                                                    Trinh Nguyen
                                                </option>
                                                <option value="1890">
                                                    Duc
                                                </option>
                                                <option value="1892">
                                                    Nhan nguyen
                                                </option>
                                                <option value="1894">
                                                    Thi reading
                                                </option>
                                                <option value="1895">
                                                    Thy
                                                </option>
                                                <option value="1896">
                                                    Jenny
                                                </option>
                                                <option value="1897">
                                                    Hue
                                                </option>
                                                <option value="1898">
                                                    Cindy Farrell
                                                </option>
                                                <option value="1899">
                                                    Kevin
                                                </option>
                                                <option value="1901">
                                                    Quach Thao
                                                </option>
                                                <option value="1902">
                                                    Tram Huỳnh
                                                </option>
                                                <option value="1903">
                                                    Ngô Nguyễn Bảo Thạch
                                                </option>
                                                <option value="1904">
                                                    Dung Pham
                                                </option>
                                                <option value="1905">
                                                    Kathy
                                                </option>
                                                <option value="1906">
                                                    Liem D Tran
                                                </option>
                                                <option value="1907">
                                                    Nguyên Huynh
                                                </option>
                                                <option value="1909">
                                                    Jenny Thai
                                                </option>
                                                <option value="1910">
                                                    Nancy Nguyen
                                                </option>
                                                <option value="1911">
                                                    Binh ly
                                                </option>
                                                <option value="1912">
                                                    Jasmine Luu
                                                </option>
                                                <option value="1913">
                                                    Sùng thị mỷ
                                                </option>
                                                <option value="1914">
                                                    Chan van nguyen
                                                </option>
                                                <option value="1915">
                                                    Võ thị Giác
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-0">
                                                <input type="text" class="form-control form-control-sm aiz-date-range" id="search" name="date_range" placeholder="Daterange">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-md btn-primary" type="submit">
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">

                                    <table class="table aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-breakpoints="lg">Order Code:</th>
                                                <th>Admin Commission</th>
                                                <th>Seller Earning</th>
                                                <th data-breakpoints="lg">Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    20240922-22000283
                                                </td>
                                                <td>167.21</td>
                                                <td>1096.14</td>
                                                <td>2024-09-24 00:26:22</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    20240922-22292488
                                                </td>
                                                <td>17.71</td>
                                                <td>116.08</td>
                                                <td>2024-09-24 00:26:17</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    20240922-22292488
                                                </td>
                                                <td>29.07</td>
                                                <td>190.56</td>
                                                <td>2024-09-24 00:26:17</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>
                                                    20240922-22292488
                                                </td>
                                                <td>14.4</td>
                                                <td>94.41</td>
                                                <td>2024-09-24 00:26:17</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>
                                                    20240922-16142080
                                                </td>
                                                <td>87.85</td>
                                                <td>575.89</td>
                                                <td>2024-09-24 00:26:11</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    20240922-16100927
                                                </td>
                                                <td>48.58</td>
                                                <td>318.46</td>
                                                <td>2024-09-24 00:25:57</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>
                                                    20240922-16100927
                                                </td>
                                                <td>34.59</td>
                                                <td>226.78</td>
                                                <td>2024-09-24 00:25:57</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>
                                                    20240922-16100927
                                                </td>
                                                <td>39.75</td>
                                                <td>260.57</td>
                                                <td>2024-09-24 00:25:57</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>
                                                    20240922-16100927
                                                </td>
                                                <td>20.61</td>
                                                <td>135.11</td>
                                                <td>2024-09-24 00:25:57</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>
                                                    20240922-16100927
                                                </td>
                                                <td>17.3</td>
                                                <td>113.39</td>
                                                <td>2024-09-24 00:25:57</td>
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
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=2">2</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=3">3</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=4">4</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=5">5</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=6">6</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=7">7</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=8">8</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=9">9</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=10">10</a></li>

                                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>





                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=1177">1177</a></li>
                                                <li class="page-item"><a class="page-link" href="/admin/commission_log.php?page=1178">1178</a></li>


                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/commission_log.php?page=2" rel="next" aria-label="Next »">&rsaquo;</a>
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