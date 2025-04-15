<?php
include("../../config.php");
if (!$isSeller) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// Log incoming request for debugging
error_log("AJAX Products Request: " . json_encode($_POST));

$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;
$category_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? intval($_POST['category_id']) : null;
$search = isset($_POST['search']) && !empty($_POST['search']) ? $_POST['search'] : null;

// Build the query
$query = "SELECT * FROM products_admin WHERE seller_id IS NULL";

// Add category filter if provided
if ($category_id) {
    $query .= " AND category_id = " . $category_id;
}

// Add search filter if provided
if ($search) {
    $query .= " AND (name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' OR barcode LIKE '%" . mysqli_real_escape_string($conn, $search) . "%')";
}

// Log the query for debugging
error_log("Products Query: " . $query);

// Count total matching products
$count_query = str_replace("SELECT *", "SELECT COUNT(*) as total", $query);
$count_result = mysqli_query($conn, $count_query);

if (!$count_result) {
    error_log("Count Query Error: " . mysqli_error($conn));
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
    exit;
}

$total_count = mysqli_fetch_assoc($count_result)['total'];

// Add limit and offset
$query .= " ORDER BY id DESC LIMIT " . $offset . ", " . $limit;

// Execute the query
$result = mysqli_query($conn, $query);

if (!$result) {
    error_log("Main Query Error: " . mysqli_error($conn));
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
    exit;
}

// Fetch products
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Ensure product ID is properly cast to integer
    $row['id'] = intval($row['id']);
    
    // Check if thumbnail image is a JSON string and extract the first image
    if (!empty($row['thumbnail_image'])) {
        if (isJSON($row['thumbnail_image'])) {
            $images = json_decode($row['thumbnail_image'], true);
            if (is_array($images) && !empty($images)) {
                $row['thumbnail_image'] = "/public/uploads/all/" . $images[0];
            }
        } else {
            $row['thumbnail_image'] = "/public/uploads/all/" . $row['thumbnail_image'];
        }
    }
    
    // Calculate price after discount
    $discount = floatval($row['discount'] ?? 0);
    $original_price = floatval($row['unit_price']);
    $final_price = $original_price - $discount;
    
    // Ensure numeric values are properly formatted
    $row['numeric_purchase_price'] = $final_price; // Price after discount for calculations
    $row['original_price'] = number_format($original_price, 0, '.', ','); // Original price for display
    $row['purchase_price'] = number_format($final_price, 0, '.', ','); // Display price after discount
    $row['has_discount'] = $discount > 0; // Flag to indicate if product has discount
    $row['discount_amount'] = $discount; // Store the discount amount
    
    // Make sure quantity is included
    $row['available_quantity'] = intval($row['quantity'] ?? 0);
    
    $products[] = $row;
}

// Check if there are more products
$has_more = ($offset + $limit) < $total_count;

// Prepare response
$response = [
    'success' => true,
    'products' => $products,
    'has_more' => $has_more,
    'total' => $total_count
];

// Log response for debugging
error_log("Products Response: " . count($products) . " products returned");

// Return response
echo json_encode($response);

// Helper function to check if a string is valid JSON
function isJSON($string) {
    if (!is_string($string)) return false;
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}
?>
