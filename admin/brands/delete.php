<?php
include("../../config.php");
if (!$isLogin || !$isAdmin) {
    echo "Unauthorized access";
    exit;
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Get brand info to delete associated logo file
    $brand = fetch_array("SELECT * FROM brands WHERE id='$id' LIMIT 1");
    
    if($brand) {
        // Delete logo file if exists
        if(!empty($brand['logo'])) {
            $logo_path = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $brand['logo'];
            if(file_exists($logo_path)) {
                @unlink($logo_path);
            }
        }
        
        // Delete the brand record
        $delete_query = "DELETE FROM brands WHERE id='$id'";
        if(mysqli_query($conn, $delete_query)) {
            header("Location: /admin/brands/index.php?status=success&message=Brand deleted successfully");
            exit;
        } else {
            header("Location: /admin/brands/index.php?status=error&message=Error deleting brand: " . mysqli_error($conn));
            exit;
        }
    } else {
        header("Location: /admin/brands/index.php?status=error&message=Brand not found");
        exit;
    }
} else {
    header("Location: /admin/brands/index.php?status=error&message=Invalid brand ID");
    exit;
}
?>
