<?php include("../config.php");
if (!$isSeller) header("Location: /users/login");

// Calculate pending balance from unprocessed orders
$pending_query = "SELECT SUM(d.price * d.quantity) AS pending_amount, o.payment_status 
                  FROM detail_orders d
                  JOIN orders o ON d.order_id = o.id
                  WHERE d.from_seller = '$seller_id' AND o.payment_status = 'unpaid'
                  GROUP BY o.payment_status";
$pending_result = mysqli_query($conn, $pending_query);
$pending_amount = 0; 
if ($pending_result && mysqli_num_rows($pending_result) > 0) {
    $pending_data = mysqli_fetch_assoc($pending_result);
    $pending_amount = $pending_data['pending_amount'] ?? 0;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="c6MXnpe4lPP7N32uzv6W24NEiPEWxjq4Y54fVWYP">
    <meta name="app-url" content="//gmarketagents.com/">
    <meta name="file-base-url" content="//gmarketagents.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
    <title>TAKASHIMAYA ONLINE STORE VIETNAM | Mua sản phẩm nội địa Nhật Bản với giá gốc từ nhà sản xuất</title>
    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-seller.css">

    <style>
        body {
            font-size: 12px;
        }

        #map {
            width: 100%;
            height: 250px;
        }

        #edit_map {
            width: 100%;
            height: 250px;
        }

        .pac-container {
            z-index: 100000;
        }
    </style>
    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Không có gì được chọn',
            nothing_found: 'Không tìm thấy',
            choose_file: 'Chọn tệp',
            file_selected: 'Tệp đã được chọn',
            files_selected: 'Các tệp đã được chọn',
            add_more_files: 'Thêm nhiều tệp hơn',
            adding_more_files: 'Đang thêm nhiều tệp hơn',
            drop_files_here_paste_or: 'Thả tệp vào đây, dán hoặc',
            browse: 'Duyệt',
            upload_complete: 'Tải lên hoàn tất',
            upload_paused: 'Tải lên đã tạm dừng',
            resume_upload: 'Tiếp tục tải lên',
            pause_upload: 'Tạm dừng tải lên',
            retry_upload: 'Thử tải lại',
            cancel_upload: 'Hủy tải lên',
            uploading: 'Đang tải lên',
            processing: 'Đang xử lý',
            complete: 'Hoàn tất',
            file: 'Tệp',
            files: 'Các tệp',
        }
    </script>

</head>

<body class="">

    <div class="aiz-main-wrapper">
        <?php include("./layout/sidebar.php") ?>

        <div class="py-3 px-4 lg:px-6">
            <?php include("./layout/topbar.php") ?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">

                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3"><?= tran("Money Withdraw") ?></h1>
                            </div>
                        </div>
                    </div>

                    <div class="row gutters-10">
                        <div class="col-md-3 mb-4 mx-auto">
                            <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
                                <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                                    <i class="las la-dollar-sign la-2x text-white"></i>
                                </span>
                                <div class="px-3 pt-3 pb-3">
                                    <div class="h4 fw-700 text-center"><?= number_format($pending_amount,2) ?>$</div>
                                    <div class="opacity-50 text-center"><?= tran("Pending Balance") ?>
                                        <!--                  
                  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 mx-auto">
                            <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
                                <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                                    <i class="las la-dollar-sign la-2x text-white"></i>
                                </span>
                                <div class="px-3 pt-3 pb-3">
                                    <div class="h4 fw-700 text-center"><?= number_format($seller_money,2) ?>$</div>
                                    <div class="opacity-50 text-center"><?= tran("Wallet Balance") ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 mx-auto">
                            <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition" onclick="show_request_modal()">
                                <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                                    <i class="las la-plus la-3x text-white"></i>
                                </span>
                                <div class="fs-18 text-primary"><?= tran("Send Withdraw Request") ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6"><?= tran("Withdraw Request history") ?></h5>
                        </div>
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= tran("Date") ?></th>
                                        <th><?= tran("Amount") ?></th>
                                        <th data-breakpoints="lg"><?= tran("Status") ?></th>
                                        <th data-breakpoints="lg" width="60%"><?= tran("Message") ?></th>
                                        <th data-breakpoints="lg" width="40%"><?= tran("Reply") ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $sql = mysqli_query($conn, "SELECT * FROM history_payment WHERE type='Withdraw' AND seller_id='$seller_id' ORDER BY id DESC");
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $row['create_date'] ?></td>
                                            <td><?= $row['amount'] ?>$</td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 'Success') {
                                                ?>
                                                    <span class="badge badge-inline badge-success"><?= tran("Paid") ?></span>
                                                <?php } else if ($row['status'] == 'Pending') { ?>
                                                    <span class="badge badge-inline badge-info"><?= tran("Pending") ?></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-inline badge-danger"><?= tran("Cancel") ?></span>
                                                <?php } ?>
                                            </td>
                                            <td><?= $row['message'] ?></td>
                                            <td><?= $row['reply'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="aiz-pagination">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto border-sm-top">
                    <p class="mb-0"></p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    <div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= tran("Send A Withdraw Request") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php
                if ($seller_bank_routing_number == "" || $seller_bank_name == "" || $seller_bank_account_number == "" || $seller_bank_account_name == "") {
                ?>
                    <div class="px-3 pt-3 pb-3 text-center">
                        <div style="font-size:14px">Vui lòng liên kết ngân hàng trước khi rút tiền</div>
                        <button class="btn btn-sm btn-primary mt-3" onclick="window.location.href = '/seller/shop/profile.php'">Liên kết ngay</button>
                    </div>
                <?php } else { ?>
                    <div class="px-3 py-3">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td><?= tran("Bank Name") ?></td>
                                    <td><?= $seller_bank_name ?></td>
                                </tr>
                                <tr>
                                    <td><?= tran("Bank Account Name") ?></td>
                                    <td><?= $seller_bank_account_name ?></td>
                                </tr>
                                <tr>
                                    <td><?= tran("Bank Account Number") ?></td>
                                    <td><?= $seller_bank_account_number ?></td>
                                </tr>
                                <tr>
                                    <td>Bank Routing Number</td>
                                    <td><?= $seller_bank_routing_number ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    if (isset($_POST['send1'])) {
                        $amount = floatval($_POST['amount']);
                        $message = mysqli_real_escape_string($conn, $_POST['message']);

                        if ($amount <= 0) {
                            echo "<script>AIZ.plugins.notify('danger', 'Số tiền phải lớn hơn 0');</script>";
                        } else if ($amount > $seller_money) {
                            echo "<script>AIZ.plugins.notify('danger', 'Tài khoản không đủ tiền');</script>";
                        } else {
                            // Default name_payment to the bank name
                            $name_payment = mysqli_real_escape_string($conn, $seller_bank_name);

                            $insert_query = "INSERT INTO history_payment(type, name_payment, seller_id, amount, message, status, create_date) 
                                            VALUES ('Withdraw', '$name_payment', '$seller_id', '$amount', '$message', 'Pending', '$createDate')";

                            $result = mysqli_query($conn, $insert_query);

                            if ($result) {
                                $update_result = mysqli_query($conn, "UPDATE sellers SET money=money-$amount WHERE id='$seller_id' LIMIT 1");
                                if ($update_result) {
                                    echo "<script>AIZ.plugins.notify('success', 'Yêu cầu rút tiền đã được gửi thành công');</script>";
                                    echo "<script>setTimeout(function(){ window.location.href=''; }, 1500);</script>";
                                } else {
                                    echo "<script>AIZ.plugins.notify('danger', 'Có lỗi xảy ra khi cập nhật số dư');</script>";
                                }
                            } else {
                                echo "<script>AIZ.plugins.notify('danger', 'Có lỗi xảy ra khi gửi yêu cầu');</script>";
                            }
                        }
                    }
                    ?>
                    <form class="" action="" method="post">
                        <input type="hidden" name="_token" value="sY3tzsrJ2efBsz6gfCOaAFhO1F38qubVTunRAMoB">
                        <div class="modal-body gry-bg px-3 pt-1">
                            <div class="row">
                                <div class="col-md-3">
                                    <label><?= tran("Amount") ?> <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="number" lang="en" class="form-control mb-3" name="amount" min="1" step="0.01" placeholder="<?= tran("Amount") ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label><?= tran("Message") ?></label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="message" rows="2" class="form-control mb-3" placeholder="<?= tran("Additional information") ?>" maxlength="500"></textarea>
                                </div>
                            </div>
                            <div class="form-group text-left">
                                <button type="submit" class="btn btn-sm btn-primary" name="send1"><?= tran("Send") ?></button>
                            </div>
                        </div>
                    </form>




                <?php } ?>
            </div>
        </div>
    </div>

    <!-- delete Modal -->
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6"><?= tran("Delete Confirmation") ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1"><?= tran("Are you sure to delete this?") ?></p>
                    <button type="button" class="btn btn-link mt-2" data-dismiss="modal"><?= tran("Cancel") ?></button>
                    <a href="" id="delete-link" class="btn btn-primary mt-2"><?= tran("Delete") ?></a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    <div class="modal fade" id="message_modal" style="margin-top: 15%;">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <form class="" action="/seller/process-money" method="post" style="display:none">
        <input type="hidden" name="_token" value="c6MXnpe4lPP7N32uzv6W24NEiPEWxjq4Y54fVWYP"> <input type="number" class="form-control mb-3" name="amount" value="0" />
        <button type="submit" class="btn btn-sm btn-primary submit-process"></button>
    </form>


    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>

    <script type="text/javascript">
        function show_request_modal() {
            $('#request_modal').modal('show');
        }

        function show_request_zhuan() {
            $.get('/seller/withdraw/zhuan', {
                _token: 'c6MXnpe4lPP7N32uzv6W24NEiPEWxjq4Y54fVWYP'
            }, function(data) {
                $('#message_modal .modal-content').html(data);
                $('#message_modal').modal('show', {
                    backdrop: 'static'
                });
            });
        }

        function show_message_modal(id) {
            $.post('/admin/withdraw_request/message_modal', {
                _token: 'c6MXnpe4lPP7N32uzv6W24NEiPEWxjq4Y54fVWYP',
                id: id
            }, function(data) {
                $('#message_modal .modal-content').html(data);
                $('#message_modal').modal('show', {
                    backdrop: 'static'
                });
            });
        }

        function process_now(amount) {
            $('.btn-process').hide();
            $('.submit-process').click();
            /*$.post('/seller/process-money',{_token:'c6MXnpe4lPP7N32uzv6W24NEiPEWxjq4Y54fVWYP', amount: amount}, function(data){
                AIZ.plugins.notify('success', data.message );
                setTimeout(function(){window.location.reload()},1500)
            });*/
            //AIZ.plugins.notify('success','Send request successfully');
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
                        _token: 'c6MXnpe4lPP7N32uzv6W24NEiPEWxjq4Y54fVWYP',
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
                    $("#search-menu").html(`<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">Không tìm thấy</span></li>`);
                }
            } else {
                $("#main-menu").removeClass('d-none');
                $("#search-menu").html('')
            }
        }
    </script>


</body>

</html>