<?php 
include("../../config.php");
if (!$isLogin || !$isAdmin) header("Location: /");

// Handle form submission
if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $path = mysqli_real_escape_string($conn, $_POST['path']);
    
    // Auto-generate path if empty
    if(empty($path)) {
        // Convert name to lowercase, replace spaces with hyphens and remove special characters
        $path = preg_replace('/[^a-z0-9\-]/', '', str_replace(' ', '-', strtolower($name)));
        
        // Ensure path is unique by checking database
        $path_check = fetch_array("SELECT COUNT(*) as count FROM categories WHERE path='$path'");
        if($path_check && $path_check['count'] > 0) {
            // Append a number if path already exists
            $path = $path . '-' . rand(100, 999);
        }
    }
    
    // Default value for image
    $img = "";
    
    // Process banner upload
    if(isset($_FILES['banner']) && $_FILES['banner']['error'] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES['banner']['name'];
        $filetype = $_FILES['banner']['type'];
        $filesize = $_FILES['banner']['size'];
        
        // Validate file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(array_key_exists($ext, $allowed)) {
            // Generate unique filename
            $newname = uniqid() . "." . $ext;
            $path_banner = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $newname;
            
            if(move_uploaded_file($_FILES['banner']['tmp_name'], $path_banner)) {
                $img = $newname;
            } else {
                $error_msg = "Error uploading banner image";
            }
        } else {
            $error_msg = "Invalid file type for banner. Only JPG, JPEG, PNG and GIF types are accepted.";
        }
    }
    
    // Insert category if no errors
    if(!isset($error_msg)) {
        $sql = "INSERT INTO categories (name, img, path) VALUES ('$name', '$img', '$path')";
        if(mysqli_query($conn, $sql)) {
            header("Location: /admin/categories/index.php?status=success&message=Category created successfully");
            exit;
        } else {
            $error_msg = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="3p5l8u6VIdvfsdtb3Yo0crd2vdDbPppm1jXQxA6F">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/ImUXrP5YC9e0hsv4zR6xjoYJCuxmFYkonSInvGtJ.jpg">
    <title>Takashimaya | Create Category</title>

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
                        <h5 class="mb-0 h6"><?=tran("Add New Category")?></h5>
                    </div>
                    
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6"><?=tran("Category Information")?></h5>
                            </div>
                            <div class="card-body">
                                <?php if(isset($error_msg)): ?>
                                    <div class="alert alert-danger"><?= $error_msg ?></div>
                                <?php endif; ?>
                                
                                <form class="form-horizontal" action="create.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Name")?> <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="<?=tran("Name")?>" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Path")?></label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="<?=tran("Path")?>" name="path" class="form-control">
                                            <small class="text-muted"><?=tran("URL path for this category. Leave blank to auto-generate.")?></small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Banner")?> <small>(1200x300)</small></label>
                                        <div class="col-md-9">
                                            <input type="file" name="banner" class="form-control">
                                            <small class="text-muted"><?=tran("Category banner for display in homepage or category page.")?></small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="submit" class="btn btn-primary"><?=tran("Save")?></button>
                                    </div>
                                </form>
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
</body>
</html>