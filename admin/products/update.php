<?php
include("../../config.php");

if ($isLogin && $isAdmin) {
    $id = mysqli_real_escape_string($conn, $_POST['id']); // Lấy id từ form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $unit = $_POST['unit'];
    $weight = $_POST['weight'];
    $min_qty = $_POST['min_qty'];
    $tags = implode(',', $_POST['tags']); // Chuyển tags từ mảng thành chuỗi
    $barcode = $_POST['barcode'];
    $video_provider = $_POST['video_provider'];
    $video_link = $_POST['video_link'];
    $choice_attributes = isset($_POST['choice_attributes']) ? json_encode($_POST['choice_attributes']) : '';
    $unit_price = $_POST['unit_price'];
    $date_range = $_POST['date_range'];
    $discount = $_POST['discount'];
    $discount_type = $_POST['discount_type'];
    $current_stock = $_POST['current_stock'];
    $sku = $_POST['sku'];
    $external_link = $_POST['external_link'];
    $external_link_btn = $_POST['external_link_btn'];
    $description = $_POST['description'];
    $pdf_specification = $_POST['pdf'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_img = $_POST['meta_img'];
    $low_stock_quantity = $_POST['low_stock_quantity'];
    $stock_visibility_state = $_POST['stock_visibility_state'];
    $cash_on_delivery = isset($_POST['cash_on_delivery']) ? 1 : 0;
    $featured = isset($_POST['featured']) ? 1 : 0;
    $todays_deal = isset($_POST['todays_deal']) ? 1 : 0;
    $flash_deal_id = $_POST['flash_deal_id'];
    $flash_discount = $_POST['flash_discount'];
    $flash_discount_type = $_POST['flash_discount_type'];
    $est_shipping_days = $_POST['est_shipping_days'];
    $tax_id = $_POST['tax_id']; // arr
    $tax = $_POST['tax']; // arr
    $tax_type = $_POST['tax_type']; // arr

    // Lấy dữ liệu hiện tại để giữ nguyên nếu không upload file mới
    $current_product = fetch_array("SELECT thumbnail_image, gallery_images FROM products_admin WHERE id='$id'");
    $thumbnail_image = $current_product['thumbnail_image'];
    $gallery_images = json_decode($current_product['gallery_images'], true) ?? [];

    // Handle Thumbnail Image Upload
    if (isset($_FILES['thumbnail_image']) && $_FILES['thumbnail_image']['error'] == 0) {
        $ext = pathinfo($_FILES['thumbnail_image']['name'], PATHINFO_EXTENSION);
        $thumbnail_image = uniqid() . "." . $ext;
        $thumbnail_path = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $thumbnail_image;
        move_uploaded_file($_FILES['thumbnail_image']['tmp_name'], $thumbnail_path);
    }

    // Handle Gallery Images Upload
    if (isset($_FILES['gallery_images']) && count($_FILES['gallery_images']['name']) > 0) {
        $new_gallery_images = [];
        foreach ($_FILES['gallery_images']['name'] as $key => $filename) {
            if ($_FILES['gallery_images']['error'][$key] == 0) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $unique_name = uniqid() . "." . $ext;
                $gallery_path = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/all/" . $unique_name;
                if (move_uploaded_file($_FILES['gallery_images']['tmp_name'][$key], $gallery_path)) {
                    $new_gallery_images[] = $unique_name;
                }
            }
        }
        // Gộp ảnh mới với ảnh cũ nếu không muốn thay thế hoàn toàn
        $gallery_images = array_merge($gallery_images, $new_gallery_images);
    }

    // Convert gallery images array to JSON string
    $gallery_images_json = json_encode($gallery_images);

    // Update product in the database
    $sql = "UPDATE products_admin SET 
            name='$name', 
            category_id='$category_id', 
            brand_id='$brand_id', 
            unit='$unit', 
            weight='$weight', 
            minimum_quantity='$min_qty', 
            tags='$tags', 
            barcode='$barcode', 
            gallery_images='$gallery_images_json', 
            thumbnail_image='$thumbnail_image', 
            video_provider='$video_provider', 
            video_link='$video_link', 
            unit_price='$unit_price', 
            discount_date_range='$date_range', 
            discount='$discount', 
            quantity='$current_stock', 
            sku='$sku', 
            external_link='$external_link', 
            external_link_button_text='$external_link_btn', 
            description='$description', 
            pdf_specification='$pdf_specification', 
            meta_title='$meta_title', 
            meta_description='$meta_description'
            WHERE id='$id'";
    try {
      
    if (mysqli_query($conn, $sql)) {
        
        // Xử lý VAT & TAX (cập nhật hoặc thêm mới)
        for ($i = 0; $i < count($tax_id); $i++) {
            $tax_value = $tax[$i];
            $tax_type_value = $tax_type[$i];
            $current_tax_id = $tax_id[$i];
            // $tax_sql = "INSERT INTO product_taxes (product_id, tax_id, tax, tax_type) 
            //             VALUES ('$id', '$current_tax_id', '$tax_value', '$tax_type_value') 
            //             ON DUPLICATE KEY UPDATE tax='$tax_value', tax_type='$tax_type_value'";
            // mysqli_query($conn, $tax_sql);
        }

        $status = $_POST['button'] == 'publish' ? 'success' : 'unpublished';
        header("Location: /admin/products/all.php?status=$status&message=Product updated successfully");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
     
    } catch (Exception $ex) {
        dd($ex);
    }
}

?>