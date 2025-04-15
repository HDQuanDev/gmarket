<?php
require_once("config.php");

// Get search query
$search_term = isset($_GET['q']) ? $_GET['q'] : '';

// Initialize results array
$results = [
    'products' => [],
    'sellers' => [],
    'categories' => []
];

if (!empty($search_term)) {
    // Search in products
    $product_query = "SELECT p.id, p.name, p.purchase_price as price, p.discount, 
                            f.src as image_src, c.name as category_name
                     FROM products p
                     LEFT JOIN file f ON p.thumbnail_image = f.id
                     LEFT JOIN categories c ON p.category_id = c.id
                     WHERE p.published = 1 
                     AND (p.name LIKE ? OR p.description LIKE ?)
                     ORDER BY p.name ASC
                     LIMIT 5";
    
    $stmt = $conn->prepare($product_query);
    $search_param = "%$search_term%";
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $product_result = $stmt->get_result();
    
    while ($product = $product_result->fetch_assoc()) {
        // Calculate final price if there's a discount
        $price = $product['price'];
        if (!empty($product['discount']) && $product['discount'] > 0) {
            $price = $product['price'] - $product['discount'];
        }
        
        $results['products'][] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $price,
            'image' => !empty($product['image_src']) ? "/public/uploads/all/" . $product['image_src'] : "/public/assets/img/placeholder.jpg",
            'category_name' => $product['category_name']
        ];
    }
    
    // Search in sellers/shops
    $seller_query = "SELECT s.id, s.full_name as name, f.src as logo_src,
                           COUNT(p.id) as product_count
                    FROM sellers s
                    LEFT JOIN file f ON s.shop_logo = f.id
                    LEFT JOIN products p ON s.id = p.seller_id
                    WHERE s.status = 'active' 
                    AND (s.full_name LIKE ? OR s.full_name LIKE ?)
                    GROUP BY s.id
                    ORDER BY s.full_name ASC
                    LIMIT 3";
    
    $stmt = $conn->prepare($seller_query);
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $seller_result = $stmt->get_result();
    
    while ($seller = $seller_result->fetch_assoc()) {
        $results['sellers'][] = [
            'id' => $seller['id'],
            'name' => $seller['name'],
            'logo' => !empty($seller['logo_src']) ? "/public/uploads/all/" . $seller['logo_src'] : "/public/assets/img/shop-placeholder.jpg",
            'product_count' => $seller['product_count']
        ];
    }
    
    // Search in categories
    $category_query = "SELECT c.id, c.name, c.img, c.banner, c.path,
                              COUNT(p.id) as product_count
                       FROM categories c
                       LEFT JOIN products p ON c.id = p.category_id
                       WHERE c.name LIKE ?
                       GROUP BY c.id
                       ORDER BY c.name ASC
                       LIMIT 3";
    
    $stmt = $conn->prepare($category_query);
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $category_result = $stmt->get_result();
    
    while ($category = $category_result->fetch_assoc()) {
        $results['categories'][] = [
            'id' => $category['id'],
            'name' => $category['name'],
            'path' => $category['path'],
            'image' => !empty($category['img']) ? "/public/uploads/all/" . $category['img'] : "/public/assets/img/placeholder.jpg",
            'product_count' => $category['product_count']
        ];
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($results);
?>
