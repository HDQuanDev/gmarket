<?php include("../../config.php");if(!$isLogin || !$isAdmin)header("Location: /");

// Handle form submission for adding new brand
if(isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    
    // Generate path from brand name if not provided
    $path = !empty($_POST['path']) ? mysqli_real_escape_string($conn, $_POST['path']) : 
            preg_replace('/[^a-z0-9\-]/', '', str_replace(' ', '-', strtolower($name)));
    
    // Check if path already exists
    $path_check = fetch_array("SELECT COUNT(*) as count FROM brands WHERE path='$path'");
    if($path_check && $path_check['count'] > 0) {
        // Append a number if path already exists
        $path = $path . '-' . rand(100, 999);
    }
    
    // Process logo upload
    $logo = "";
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
                $logo = $newname;
            } else {
                $error_msg = "Error uploading brand logo";
            }
        } else {
            $error_msg = "Invalid file type for logo. Only JPG, JPEG, PNG and GIF types are accepted.";
        }
    }
    
    // Insert brand if no errors
    if(!isset($error_msg)) {
        $sql = "INSERT INTO brands (name, title, description, logo, path) 
                VALUES ('$name', '$title', '$description', '$logo', '$path')";
        
        if(mysqli_query($conn, $sql)) {
            $success_msg = "Brand added successfully!";
        } else {
            $error_msg = "Error: " . mysqli_error($conn);
        }
    }
}

// Set up pagination
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Get search condition
$search_condition = "";
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $search_condition = "WHERE name LIKE '%$search%'";
}

// Get total count for pagination
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM brands $search_condition");
$total_brands = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_brands / $limit);

// Ensure current page is valid
if($page > $total_pages && $total_pages > 0) {
    $page = $total_pages;
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
    <title>Takashimaya | Brand Management</title>

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
        .brand-logo {
            height: 60px;
            width: auto;
            object-fit: contain;
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
                    <!-- Status messages section -->
                    <?php if(isset($success_msg)): ?>
                    <div class="alert alert-success"><?= $success_msg ?></div>
                    <?php endif; ?>
                    
                    <?php if(isset($error_msg)): ?>
                    <div class="alert alert-danger"><?= $error_msg ?></div>
                    <?php endif; ?>
                    
                    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <div class="alert alert-success"><?= $_GET['message'] ?? 'Operation completed successfully!' ?></div>
                    <?php elseif(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                    <div class="alert alert-danger"><?= $_GET['message'] ?? 'An error occurred!' ?></div>
                    <?php endif; ?>

                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="align-items-center">
                            <h1 class="h3"><?=tran("All Brands")?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-header row gutters-5">
                                    <div class="col text-center text-md-left">
                                        <h5 class="mb-md-0 h6"><?=tran("Brands")?></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <form class="" id="sort_brands" action="" method="GET">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="search" name="search" 
                                                    placeholder="Type name & Enter" 
                                                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="las la-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?=tran("Name")?></th>
                                                <th><?=tran("Logo")?></th>
                                                <th class="text-right"><?=tran("Options")?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Get brands for current page
                                            $sql = mysqli_query($conn, "SELECT * FROM brands $search_condition ORDER BY id DESC LIMIT $limit OFFSET $offset");
                                            $i = $offset;
                                            while($row = fetch_assoc($sql)){
                                                $i++;
                                            ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?=$row['name']?></td>
                                                <td>
                                                    <?php if(!empty($row['logo'])): ?>
                                                    <img src="/public/uploads/all/<?=$row['logo']?>" alt="<?=$row['name']?>" class="brand-logo">
                                                    <?php else: ?>
                                                    <span class="text-muted">No logo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="/admin/brands/edit.php?id=<?=$row['id']?>" title="Edit">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="/admin/brands/delete.php?id=<?=$row['id']?>" title="Delete">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            
                                            <?php if($i == $offset): ?>
                                            <tr>
                                                <td colspan="4" class="text-center"><?=tran("No brands found")?></td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    
                                    <!-- Pagination -->
                                    <div class="aiz-pagination mt-3">
                                        <?php if($total_pages > 1): ?>
                                        <nav>
                                            <ul class="pagination">
                                                <!-- Previous page link -->
                                                <?php if($page > 1): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?=$page-1?><?=isset($_GET['search']) ? '&search='.urlencode($_GET['search']) : ''?>" aria-label="Previous">
                                                        <span aria-hidden="true">&lsaquo;</span>
                                                    </a>
                                                </li>
                                                <?php else: ?>
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                                </li>
                                                <?php endif; ?>
                                                
                                                <!-- Page numbers -->
                                                <?php 
                                                $start_page = max(1, $page - 2);
                                                $end_page = min($total_pages, $page + 2);
                                                
                                                for($i = $start_page; $i <= $end_page; $i++): 
                                                ?>
                                                <li class="page-item <?=$i == $page ? 'active' : ''?>">
                                                    <a class="page-link" href="?page=<?=$i?><?=isset($_GET['search']) ? '&search='.urlencode($_GET['search']) : ''?>">
                                                        <?=$i?>
                                                    </a>
                                                </li>
                                                <?php endfor; ?>
                                                
                                                <!-- Next page link -->
                                                <?php if($page < $total_pages): ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?=$page+1?><?=isset($_GET['search']) ? '&search='.urlencode($_GET['search']) : ''?>" aria-label="Next">
                                                        <span aria-hidden="true">&rsaquo;</span>
                                                    </a>
                                                </li>
                                                <?php else: ?>
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                                </li>
                                                <?php endif; ?>
                                            </ul>
                                        </nav>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?=tran("Add New Brand")?></h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group mb-3">
                                            <label for="name"><?=tran("Name")?> <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Brand Name" name="name" class="form-control" required>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label for="path"><?=tran("Path")?></label>
                                            <input type="text" placeholder="URL Path (leave empty to auto-generate)" name="path" class="form-control">
                                            <small class="text-muted"><?=tran("URL path for this brand. Leave blank to auto-generate from name.")?></small>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label for="logo"><?=tran("Logo")?> <small>(120x80)</small></label>
                                            <input type="file" name="logo" class="form-control">
                                            <small class="text-muted"><?=tran("Brand logo. Use high quality image.")?></small>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label for="meta_title"><?=tran("Meta Title")?></label>
                                            <input type="text" class="form-control" name="meta_title" placeholder="Meta Title">
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label for="meta_description"><?=tran("Meta Description")?></label>
                                            <textarea name="meta_description" rows="5" class="form-control"></textarea>
                                        </div>
                                        
                                        <div class="form-group mb-3 text-right">
                                            <button type="submit" name="submit" class="btn btn-primary"><?=tran("Save")?></button>
                                        </div>
                                    </form>
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

    <!-- delete Modal -->
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6"><?=tran("Delete Confirmation")?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1"><?=tran("Are you sure to delete this brand?")?></p>
                    <button type="button" class="btn btn-link mt-2" data-dismiss="modal"><?=tran("Cancel")?></button>
                    <a href="" id="delete-link" class="btn btn-primary mt-2"><?=tran("Delete")?></a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->

    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>

    <script type="text/javascript">
        // Delete confirmation
        $(document).on('click', '.confirm-delete', function(e) {
            e.preventDefault();
            $('#delete-modal').modal('show');
            document.getElementById('delete-link').setAttribute('href', $(this).data('href'));
        });
        
        // Submit search form when Enter is pressed
        $('#search').keypress(function(e) {
            if(e.which == 13) {
                $('#sort_brands').submit();
            }
        });
    </script>

</body>

</html>