<?php
include("../../config.php");
if (!$isSeller) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// Log incoming request for debugging
error_log("Add to Shop Request: " . json_encode($_POST));

// Check if products data was provided
if (!isset($_POST['products']) || empty($_POST['products'])) {
    echo json_encode(['success' => false, 'message' => 'No products selected']);
    exit;
}

try {
    $products_data = json_decode($_POST['products'], true);
    if (!is_array($products_data)) {
        throw new Exception("Invalid product data format");
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Invalid product data: ' . $e->getMessage()]);
    exit;
}

// $seller_id = $user_id; // Get seller ID from session

error_log("Processing add to shop: Seller ID: $seller_id, Products: " . json_encode($products_data));

// Begin transaction
mysqli_begin_transaction($conn);

try {
    // Get seller's information (max_products limit and current money)
    $stmt = $conn->prepare("SELECT max_products, money FROM sellers WHERE id = ?");
    $stmt->bind_param("i", $seller_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $seller = $result->fetch_assoc();
    $stmt->close();
    
    if (!$seller) {
        throw new Exception("Seller information not found ");
    }
    
    $max_products = intval($seller['max_products'] ?? 0);
    $seller_money = floatval($seller['money'] ?? 0);
    
    // Count current products owned by seller
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM products WHERE seller_id = ?");
    $stmt->bind_param("i", $seller_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count_data = $result->fetch_assoc();
    $current_products_count = intval($count_data['count'] ?? 0);
    $stmt->close();
    
    // Calculate total cost and validate products
    $total_cost = 0;
    $valid_products = [];
    $unavailable_products = [];
    $existing_products = [];
    $new_products = [];
    
    foreach ($products_data as $product_item) {
        $product_id = intval($product_item['id']);
        $quantity = intval($product_item['quantity']);
        
        if ($quantity <= 0) {
            throw new Exception("Invalid quantity for product #$product_id");
        }
        
        // Check if product exists in products_admin table
        $stmt = $conn->prepare("SELECT * FROM products_admin WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
        
        if (!$product) {
            throw new Exception("Product #$product_id not found in inventory");
        }
        
        // Check if product has enough quantity in stock
        $available_quantity = intval($product['quantity'] ?? 0);
        if ($available_quantity <= 0) {
            $unavailable_products[] = $product['name'];
            continue;
        }
        
        // Check if requested quantity exceeds available quantity
        if ($quantity > $available_quantity) {
            throw new Exception("Requested quantity ({$quantity}) for product '{$product['name']}' exceeds available quantity ({$available_quantity})");
        }
        
        // Check if seller already has this product in their inventory
        $stmt = $conn->prepare("SELECT id, quantity FROM products WHERE seller_id = ? AND pos_id = ?");
        $stmt->bind_param("ii", $seller_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $existing_product = $result->fetch_assoc();
        $stmt->close();
        
        if ($existing_product) {
            // Product already exists, will update quantity later
            $existing_products[] = [
                'id' => $existing_product['id'],
                'existing_quantity' => $existing_product['quantity'],
                'additional_quantity' => $quantity,
                'new_quantity' => $existing_product['quantity'] + $quantity,
                'admin_product_id' => $product_id,
                'data' => $product,
                'name' => $product['name']
            ];
        } else {
            // New product
            $new_products[] = [
                'id' => $product_id,
                'quantity' => $quantity,
                'data' => $product
            ];
        }
        
        // Calculate price after discount
        $discount = floatval($product['discount'] ?? 0);
        $final_price = floatval($product['unit_price']) - $discount;
        
        // Calculate cost of this product using the discounted price
        $product_cost = $final_price * $quantity;
        $total_cost += $product_cost;
        
        // Store validated product data
        $valid_products[] = [
            'id' => $product_id,
            'quantity' => $quantity,
            'data' => $product,
            'cost' => $product_cost
        ];
    }
    
    // Check if any products were unavailable
    if (count($unavailable_products) > 0) {
        throw new Exception("The following products are out of stock: " . implode(", ", $unavailable_products));
    }
    
    // Check if we have any valid products after filtering
    if (count($valid_products) == 0) {
        throw new Exception("No valid products to add. All selected products are unavailable.");
    }
    
    // Check if adding these products would exceed the limit - count only new products
    $new_products_count = count($new_products);
    
    error_log("Seller max_products: $max_products, Current products: $current_products_count, Adding new: $new_products_count, Updating existing: " . count($existing_products));
    
    if (($current_products_count + $new_products_count) > $max_products) {
        throw new Exception("Adding these products would exceed your product limit ($max_products). You can add " . 
                           ($max_products - $current_products_count) . " more products.");
    }
    
    // Update each existing product's quantity
    foreach ($existing_products as $existing_product) {
        $product_id = $existing_product['id'];
        $new_quantity = $existing_product['new_quantity'];
        $admin_product_id = $existing_product['admin_product_id'];
        $available_quantity = intval($existing_product['data']['quantity'] ?? 0);
        $additional_quantity = $existing_product['additional_quantity'];
        
        // Update the quantity in products table
        $update_query = "UPDATE products SET quantity = ? WHERE id = ? AND seller_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("iii", $new_quantity, $product_id, $seller_id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update product quantity: " . $stmt->error);
        }
        $stmt->close();
        
        // Update the quantity in products_admin table - subtract the purchased quantity
        $new_admin_qty = max(0, $available_quantity - $additional_quantity);
        
        $update_admin_query = "UPDATE products_admin SET quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($update_admin_query);
        $stmt->bind_param("ii", $new_admin_qty, $admin_product_id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update product quantity in admin inventory: " . $stmt->error);
        }
        $stmt->close();
        
        error_log("Updated existing product #$product_id quantity: {$existing_product['existing_quantity']} -> $new_quantity");
        error_log("Updated products_admin quantity for product #$admin_product_id: $available_quantity -> $new_admin_qty");
    }
    
    // Add each new product to seller's inventory
    foreach ($new_products as $new_product) {
        $product_data = $new_product['data'];
        $quantity = $new_product['quantity'];
        $product_id = $new_product['id'];
        
        // Update the quantity in products_admin table - subtract the purchased quantity
        $current_admin_qty = intval($product_data['quantity'] ?? 0);
        $new_admin_qty = max(0, $current_admin_qty - $quantity);
        
        $update_admin_query = "UPDATE products_admin SET quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($update_admin_query);
        $stmt->bind_param("ii", $new_admin_qty, $product_id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update product quantity in admin inventory: " . $stmt->error);
        }
        $stmt->close();
        
        error_log("Updated products_admin quantity for product #$product_id: $current_admin_qty -> $new_admin_qty");
        
        // Instead of using prepared statements with bind_param, use direct SQL insertion
        // with proper escaping to avoid parameter count issues
        
        $insert_query = "INSERT INTO products (
            name, category_id, brand_id, pos_id, unit, weight, minimum_quantity, 
            tags, barcode, files, gallery_images, thumbnail_image, video_provider, 
            video_link, unit_price, purchase_price, profit, rose, discount_date_range, 
            discount, quantity, sku, external_link, external_link_button_text, 
            description, pdf_specification, meta_title, meta_image, meta_description, 
            slugs, user_id, seller_id, added_by, published, type_product
        ) VALUES (
            '" . mysqli_real_escape_string($conn, $product_data['name'] ?? '') . "',
            " . intval($product_data['category_id'] ?? 0) . ",
            " . intval($product_data['brand_id'] ?? 1) . ",
            " . $product_id . ", /* Store original product_id as pos_id for reference */
            '" . mysqli_real_escape_string($conn, $product_data['unit'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['weight'] ?? '') . "',
            " . intval($product_data['minimum_quantity'] ?? 1) . ",
            '" . mysqli_real_escape_string($conn, $product_data['tags'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['barcode'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['files'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['gallery_images'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['thumbnail_image'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['video_provider'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['video_link'] ?? '') . "',
            " . floatval($product_data['unit_price'] ?? 0) . ",
            " . floatval($product_data['purchase_price'] ?? 0) . ",
            " . floatval($product_data['profit'] ?? 0) . ",
            " . floatval($product_data['rose'] ?? 0) . ",
            '" . mysqli_real_escape_string($conn, $product_data['discount_date_range'] ?? '') . "',
            " . floatval($product_data['discount'] ?? 0) . ",
            " . intval($quantity) . ",  /* Using the quantity from purchase */
            '" . mysqli_real_escape_string($conn, $product_data['sku'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['external_link'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['external_link_button_text'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['description'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['pdf_specification'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['meta_title'] ?? '') . "',
            " . ($product_data['meta_image'] ? intval($product_data['meta_image']) : "NULL") . ",
            '" . mysqli_real_escape_string($conn, $product_data['meta_description'] ?? '') . "',
            '" . mysqli_real_escape_string($conn, $product_data['slugs'] ?? '') . "',
            " . ($product_data['user_id'] ? intval($product_data['user_id']) : "NULL") . ",
            " . intval($seller_id) . ",  /* Set seller_id to current seller */
            'seller',
            1,
            '" . mysqli_real_escape_string($conn, $product_data['type_product'] ?? 'digital') . "'
        )";
        
        if (!mysqli_query($conn, $insert_query)) {
            throw new Exception("Failed to add product: " . mysqli_error($conn));
        }
        
        error_log("Added new product with quantity $quantity to seller #$seller_id inventory");
    }
    
    // Prepare response message
    $response_message = 'Xử lý sản phẩm thành công.';
    
    if (count($new_products) > 0) {
        $response_message .= ' Đã thêm ' . count($new_products) . ' sản phẩm mới vào cửa hàng của bạn.';
    }
    
    if (count($existing_products) > 0) {
        $product_names = array_map(function($p) { return $p['name']; }, $existing_products);
        $response_message .= ' Đã cập nhật số lượng cho các sản phẩm hiện có: ' . implode(', ', $product_names) . '.';
    }
    
    // Commit the transaction if all operations were successful
    mysqli_commit($conn);
    
    echo json_encode([
        'success' => true, 
        'message' => $response_message,
        'current_count' => $current_products_count + count($new_products),
        'max_products' => $max_products,
        'new_products' => count($new_products),
        'updated_products' => count($existing_products),
    ]);
    
    error_log("Products successfully processed. New: " . count($new_products) . ", Updated: " . count($existing_products));
    
} catch (Exception $e) {
    // Rollback the transaction if any operation failed
    mysqli_rollback($conn);
    error_log("Error adding products to shop: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
