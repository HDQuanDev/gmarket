<?php
include("../../config.php");

if ($isLogin && $isAdmin) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $unit = $_POST['unit'];
    $weight = $_POST['weight'];
    $min_qty = $_POST['min_qty'];
    $tags = $_POST['tags'];
    $barcode = $_POST['barcode'];
    $video_provider = $_POST['video_provider'];
    $video_link = $_POST['video_link'];
    $choice_attributes = isset($_POST['choice_attributes']) ? $_POST['choice_attributes'] : false;
    $unit_price = $_POST['unit_price'];
    $date_range = $_POST['date_range'];
    $discount = $_POST['discount'];
    $discount_type = $_POST['discount_type'];
    $current_stock = $_POST['current_stock'];
    $sku = $_POST['sku'];
    $external_link = $_POST['external_link'];
    $description = $_POST['description'];
    $pdf_specification = $_POST['pdf'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_img = $_POST['meta_img'];
    $low_stock_quantity = $_POST['low_stock_quantity'];
    $stock_visibility_state = $_POST['stock_visibility_state'];
    $cash_on_delivery = $_POST['cash_on_delivery'];
    $flash_deal_id = $_POST['flash_deal_id'];
    $flash_discount = $_POST['flash_discount'];
    $flash_discount_type = $_POST['flash_discount_type'];
    $est_shipping_days = $_POST['est_shipping_days'];
    $tax_id = $_POST['tax_id']; //arr
    $tax = $_POST['tax']; //arr
    $tax_type = $_POST['tax_type']; //arr

    $thumbnail_image = "";
    $gallery_images = [];

    // Handle Thumbnail Image Upload
    if (isset($_FILES['thumbnail_image']) && $_FILES['thumbnail_image']['error'] == 0) {
        $ext = pathinfo($_FILES['thumbnail_image']['name'], PATHINFO_EXTENSION);
        $thumbnail_image = uniqid() . "." . $ext;
        $thumbnail_path = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $thumbnail_image;
        move_uploaded_file($_FILES['thumbnail_image']['tmp_name'], $thumbnail_path);
    }

    // Handle Gallery Images Upload
    if (isset($_FILES['gallery_images']) && count($_FILES['gallery_images']['name']) > 0) {
        foreach ($_FILES['gallery_images']['name'] as $key => $filename) {
            if ($_FILES['gallery_images']['error'][$key] == 0) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $unique_name = uniqid() . "." . $ext;
                $gallery_path = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $unique_name;
                if (move_uploaded_file($_FILES['gallery_images']['tmp_name'][$key], $gallery_path)) {
                    $gallery_images[] = $unique_name;
                }
            }
        }
    }

    // Convert gallery images array to JSON string
    $gallery_images_json = json_encode($gallery_images);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $external_link = mysqli_real_escape_string($conn, $_POST['external_link']);
    $pdf_specification = mysqli_real_escape_string($conn, $_POST['pdf']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
// và các trường khác nữa nếu cần...

    // Insert product into the database
    $sql = "INSERT INTO products_admin (name, category_id, brand_id, unit, weight, minimum_quantity, tags, barcode, gallery_images, thumbnail_image, video_provider, video_link, unit_price, discount_date_range, discount, quantity, sku, external_link, external_link_button_text, description, pdf_specification, meta_title, slugs, create_date) 
            VALUES ('$name', '$category_id', '$brand_id', '$unit', '$weight', '$min_qty', '', '$barcode', '$gallery_images_json', '$thumbnail_image', '$video_provider', '$video_link', '$unit_price', '', '$discount', '$current_stock', '$sku', '$external_link', '', '$description', '$pdf_specification', '$meta_title', '', NOW())";

    if (mysqli_query($conn, $sql)) {
        header("Location: /admin/products/all.php?status=success&message=Product created successfully");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
