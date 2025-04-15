<?php
include("../../config.php");
if (!$isLogin || !$isAdmin) {
    echo "Unauthorized access";
    exit;
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Get category info to delete associated files
    $category = fetch_array("SELECT * FROM categories WHERE id='$id' LIMIT 1");
    
    if($category) {
        // Delete icon file if exists
        if(!empty($category['img'])) {
            $icon_path = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $category['img'];
            if(file_exists($icon_path)) {
                @unlink($icon_path);
            }
        }
        
        // Delete banner file if exists
        if(!empty($category['banner'])) {
            $banner_path = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $category['banner'];
            if(file_exists($banner_path)) {
                @unlink($banner_path);
            }
        }
        
        // Delete the category record
        $delete_query = "DELETE FROM categories WHERE id='$id'";
        if(mysqli_query($conn, $delete_query)) {
            header("Location: /admin/categories/index.php?status=success&message=Category deleted successfully");
            exit;
        } else {
            header("Location: /admin/categories/index.php?status=error&message=Error deleting category: " . mysqli_error($conn));
            exit;
        }
    } else {
        header("Location: /admin/categories/index.php?status=error&message=Category not found");
        exit;
    }
} else {
    header("Location: /admin/categories/index.php?status=error&message=Invalid category ID");
    exit;
}
?>
