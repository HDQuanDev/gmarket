<?php 
include("../../config.php");
if (!$isLogin || !$isAdmin) header("Location: /");

// Check if ID is provided
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /admin/brands/index.php?status=error&message=Invalid brand ID");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$brand = fetch_array("SELECT * FROM brands WHERE id='$id' LIMIT 1");

if(!$brand) {
    header("Location: /admin/brands/index.php?status=error&message=Brand not found");
    exit;
}

// Handle form submission
if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $path = mysqli_real_escape_string($conn, $_POST['path']);
    $title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    
    // Auto-generate path if empty
    if(empty($path)) {
        // Convert name to lowercase, replace spaces with hyphens and remove special characters
        $path = preg_replace('/[^a-z0-9\-]/', '', str_replace(' ', '-', strtolower($name)));
        
        // Ensure path is unique by checking database
        $path_check = fetch_array("SELECT COUNT(*) as count FROM brands WHERE path='$path' AND id != '$id'");
        if($path_check && $path_check['count'] > 0) {
            // Append a number if path already exists
            $path = $path . '-' . rand(100, 999);
        }
    }
    
    // Initialize update query
    $update_query = "UPDATE brands SET name='$name', path='$path', title='$title', description='$description'";
    
    // Process logo upload
    if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES['logo']['name'];
        $filetype = $_FILES['logo']['type'];
        $filesize = $_FILES['logo']['size'];
        
        // Validate file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(array_key_exists($ext, $allowed)) {
            // Generate unique filename
            $newname = uniqid() . "." . $ext;
            $path_logo = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $newname;
            
            if(move_uploaded_file($_FILES['logo']['tmp_name'], $path_logo)) {
                // Delete old logo if exists
                if(!empty($brand['logo'])) {
                    $old_path = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $brand['logo'];
                    if(file_exists($old_path)) {
                        @unlink($old_path);
                    }
                }
                
                $update_query .= ", logo='$newname'";
            } else {
                $error_msg = "Error uploading brand logo";
            }
        } else {
            $error_msg = "Invalid file type for logo. Only JPG, JPEG, PNG and GIF types are accepted.";
        }
    }
    
    // Update brand if no errors
    if(!isset($error_msg)) {
        $update_query .= " WHERE id='$id'";
        if(mysqli_query($conn, $update_query)) {
            $success_msg = "Brand updated successfully";
            // Refresh brand data
            $brand = fetch_array("SELECT * FROM brands WHERE id='$id' LIMIT 1");
        } else {
            $error_msg = "Error: " . mysqli_error($conn);
        }
    }
}
?>

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
    <title>Takashimaya | Edit Brand</title>

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
                        <h5 class="mb-0 h6"><?=tran("Edit Brand")?></h5>
                    </div>
                    
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6"><?=tran("Brand Information")?></h5>
                            </div>
                            <div class="card-body">
                                <?php if(isset($error_msg)): ?>
                                    <div class="alert alert-danger"><?= $error_msg ?></div>
                                <?php endif; ?>
                                
                                <?php if(isset($success_msg)): ?>
                                    <div class="alert alert-success"><?= $success_msg ?></div>
                                <?php endif; ?>
                                
                                <form class="form-horizontal" action="edit.php?id=<?=$id?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Name")?> <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="<?=tran("Name")?>" name="name" class="form-control" required value="<?=$brand['name']?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Path")?></label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="<?=tran("Path")?>" name="path" class="form-control" value="<?=$brand['path']?>">
                                            <small class="text-muted"><?=tran("URL path for this brand. Leave blank to auto-generate.")?></small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Logo")?> <small>(120x80)</small></label>
                                        <div class="col-md-9">
                                            <input type="file" name="logo" class="form-control">
                                            <small class="text-muted"><?=tran("Brand logo. Use high quality image.")?></small>
                                            <?php if(!empty($brand['logo'])): ?>
                                                <div class="mt-3">
                                                    <img src="/public/uploads/all/<?=$brand['logo']?>" alt="Current Logo" class="img-fluid" style="max-height: 80px;">
                                                    <p class="text-muted mb-0 mt-2"><?=tran("Current Logo")?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Meta Title")?></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="meta_title" placeholder="<?=tran("Meta Title")?>" value="<?=$brand['title']?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"><?=tran("Meta Description")?></label>
                                        <div class="col-md-9">
                                            <textarea name="meta_description" rows="5" class="form-control"><?=$brand['description']?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="submit" class="btn btn-primary"><?=tran("Update")?></button>
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