<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");

if(!isset($_GET['id']) || $_GET['id']=='')die();

$seller=fetch_array("SELECT * FROM sellers WHERE id='{$_GET['id']}' LIMIT 1");

if(!$seller)die();

// Handle form submission
if(isset($_POST['submit'])){
    // Basic seller information
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    // Password handling - only update if provided
    $password = ($_POST['password'] == "") ? $seller['password'] : md5($_POST['password']);
    
    // Shop information
    $shop_name = mysqli_real_escape_string($conn, $_POST['shop_name']);
    $shop_phone = mysqli_real_escape_string($conn, $_POST['shop_phone']);
    $shop_address = mysqli_real_escape_string($conn, $_POST['shop_address']);
    
    // Financial information
    $money = floatval($_POST['balance']);
    $rose = floatval($_POST['rose']);
    $rating = floatval($_POST['rating']);
    $visitors = intval($_POST['visitors']);
    
    // Bank details
    $bank_account_name = mysqli_real_escape_string($conn, $_POST['bank_account_name']);
    $bank_account_number = mysqli_real_escape_string($conn, $_POST['bank_account_number']);
    $bank_routing_number = mysqli_real_escape_string($conn, $_POST['bank_routing_number']);
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    
    // Payment options
    $cash_payment = isset($_POST['cash_payment']) ? 1 : 0;
    $bank_payment = isset($_POST['bank_payment']) ? 1 : 0;
    
    // Status
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $is_verified = isset($_POST['is_verified']) ? 1 : 0;
    
    // Social media
    $facebook_url = mysqli_real_escape_string($conn, $_POST['facebook_url']);
    $instagram_url = mysqli_real_escape_string($conn, $_POST['instagram_url']);
    $twitter_url = mysqli_real_escape_string($conn, $_POST['twitter_url']);
    $youtube_url = mysqli_real_escape_string($conn, $_POST['youtube_url']);
    
    // Update the seller record
    $update_query = "UPDATE sellers SET 
        full_name = '$full_name',
        email = '$email',
        password = '$password',
        money = '$money',
        rose = '$rose',
        rating = '$rating',
        visitors = '$visitors',
        phone = '$phone',
        bank_account_name = '$bank_account_name',
        bank_account_number = '$bank_account_number',
        bank_routing_number = '$bank_routing_number',
        bank_name = '$bank_name',
        cash_payment = '$cash_payment',
        bank_payment = '$bank_payment',
        shop_name = '$shop_name',
        shop_phone = '$shop_phone',
        shop_address = '$shop_address',
        facebook_url = '$facebook_url',
        instagram_url = '$instagram_url',
        twitter_url = '$twitter_url',
        youtube_url = '$youtube_url',
        is_verified = '$is_verified',
        status = '$status'
        WHERE id = '{$seller['id']}'";
    
    $result = mysqli_query($conn, $update_query);
    
    if($result){
        $success_msg = "Seller information updated successfully!";
        // Refresh seller data
        $seller = fetch_array("SELECT * FROM sellers WHERE id='{$_GET['id']}' LIMIT 1");
    } else {
        $error_msg = "Error updating seller information: " . mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="eqjqtUtxseorsGoZu7TnivtNRjQVUkt0un4xjOJ8">
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
                        <h5 class="mb-0 h6">Edit Seller Information</h5>
                    </div>

                    <div class="col-lg-10 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">Seller Information</h5>
                            </div>

                            <div class="card-body">
                                <?php if(isset($success_msg)): ?>
                                <div class="alert alert-success">
                                    <?php echo $success_msg; ?>
                                </div>
                                <?php endif; ?>
                                
                                <?php if(isset($error_msg)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $error_msg; ?>
                                </div>
                                <?php endif; ?>
                                
                                <form action="" method="POST">
                                    <input name="_method" type="hidden" value="PATCH">
                                    <input type="hidden" name="_token" value="eqjqtUtxseorsGoZu7TnivtNRjQVUkt0un4xjOJ8">
                                    
                                    <h6 class="fw-600">Basic Information</h6>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="name">Full Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Full Name" id="name" name="full_name" class="form-control" value="<?=$seller['full_name']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="email">Email Address</label>
                                        <div class="col-sm-9">
                                            <input type="email" placeholder="Email Address" id="email" name="email" class="form-control" value="<?=$seller['email']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="phone">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Phone Number" id="phone" name="phone" class="form-control" value="<?=$seller['phone']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="password">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" placeholder="Password (leave empty to keep current)" id="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <h6 class="fw-600 mt-4">Shop Information</h6>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="shop_name">Shop Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Shop Name" id="shop_name" name="shop_name" class="form-control" value="<?=$seller['shop_name']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="shop_phone">Shop Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Shop Phone" id="shop_phone" name="shop_phone" class="form-control" value="<?=$seller['shop_phone']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="shop_address">Shop Address</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="shop_address" name="shop_address" placeholder="Shop Address"><?=$seller['shop_address']?></textarea>
                                        </div>
                                    </div>

                                    <h6 class="fw-600 mt-4">Bank Information</h6>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="bank_name">Bank Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Bank Name" id="bank_name" name="bank_name" class="form-control" value="<?=$seller['bank_name']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="bank_account_name">Account Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Bank Account Name" id="bank_account_name" name="bank_account_name" class="form-control" value="<?=$seller['bank_account_name']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="bank_account_number">Account Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Bank Account Number" id="bank_account_number" name="bank_account_number" class="form-control" value="<?=$seller['bank_account_number']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="bank_routing_number">Routing Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Bank Routing Number" id="bank_routing_number" name="bank_routing_number" class="form-control" value="<?=$seller['bank_routing_number']?>">
                                        </div>
                                    </div>
                                    
                                    <h6 class="fw-600 mt-4">Payment Options</h6>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label">Cash Payment</label>
                                        <div class="col-sm-9">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" name="cash_payment" <?=$seller['cash_payment']==1?'checked':''?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label">Bank Payment</label>
                                        <div class="col-sm-9">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" name="bank_payment" <?=$seller['bank_payment']==1?'checked':''?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <h6 class="fw-600 mt-4">Social Media Links</h6>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="facebook">Facebook</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Facebook URL" id="facebook" name="facebook_url" class="form-control" value="<?=$seller['facebook_url']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="instagram">Instagram</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Instagram URL" id="instagram" name="instagram_url" class="form-control" value="<?=$seller['instagram_url']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="twitter">Twitter</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="Twitter URL" id="twitter" name="twitter_url" class="form-control" value="<?=$seller['twitter_url']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="youtube">YouTube</label>
                                        <div class="col-sm-9">
                                            <input type="text" placeholder="YouTube URL" id="youtube" name="youtube_url" class="form-control" value="<?=$seller['youtube_url']?>">
                                        </div>
                                    </div>

                                    <h6 class="fw-600 mt-4">Performance Metrics</h6>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="rating">Rating</label>
                                        <div class="col-sm-9">
                                            <input type="number" step="0.1" min="0" max="5" placeholder="Rating" id="rating" name="rating" class="form-control" value="<?=$seller['rating']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="visitors">Visitors</label>
                                        <div class="col-sm-9">
                                            <input type="number" placeholder="Visitors" id="visitors" name="visitors" class="form-control" value="<?=$seller['visitors']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="balance">Balance</label>
                                        <div class="col-sm-9">
                                            <input type="number" placeholder="Balance" id="balance" name="balance" class="form-control" value="<?=$seller['money']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="rose">Commission</label>
                                        <div class="col-sm-9">
                                            <input type="number" placeholder="Commission" id="rose" name="rose" class="form-control" value="<?=$seller['rose']?>">
                                        </div>
                                    </div>

                                    <h6 class="fw-600 mt-4">Status</h6>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label" for="status">Account Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="status" name="status">
                                                <option value="active" <?=$seller['status']=='active'?'selected':''?>>Active</option>
                                                <option value="inactive" <?=$seller['status']=='inactive'?'selected':''?>>Inactive</option>
                                                <option value="banned" <?=$seller['status']=='banned'?'selected':''?>>Banned</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-from-label">Verification Status</label>
                                        <div class="col-sm-9">
                                            <label class="aiz-switch aiz-switch-success mb-0">
                                                <input type="checkbox" name="is_verified" <?=$seller['is_verified']==1?'checked':''?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
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
                        _token: 'eqjqtUtxseorsGoZu7TnivtNRjQVUkt0un4xjOJ8',
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