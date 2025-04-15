<?php
require_once(__DIR__ . "/config.php");

// Return JSON response
header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'You need to be logged in to add items to your cart'
    ]);
    exit;
}

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
    exit;
}

// Get the product details from the request
$product_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$seller_id = isset($_POST['seller']) ? intval($_POST['seller']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$user_id = $_SESSION['user_id'];

// Validate inputs
if ($product_id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid product ID'
    ]);
    exit;
}

if ($quantity <= 0) {
    $quantity = 1; // Default to 1 if invalid quantity provided
}

// Check if the product exists and is available
$product_query = "SELECT p.*, 
                 p.unit_price + p.rose + p.profit as price,
                 p.discount
                 FROM products p
                 WHERE p.id = $product_id AND p.published = 1 LIMIT 1";
$product_result = mysqli_query($conn, $product_query);

if (!$product_result || mysqli_num_rows($product_result) === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Product not found or unavailable'
    ]);
    exit;
}

$product = mysqli_fetch_assoc($product_result);

// Check if product is in stock
if ($product['quantity'] < $quantity) {
    echo json_encode([
        'success' => false,
        'message' => 'Not enough stock available'
    ]);
    exit;
}

// Calculate the correct price (applying discount if available)
$calculated_price = $product['price'];
if (!empty($product['discount']) && $product['discount'] > 0) {
    $calculated_price = $product['price'] - $product['discount']; 
}

// If the user provided a price, validate it matches our calculation (security check)
if ($price > 0 && abs($price - $calculated_price) > 0.01) {
    // Log the mismatch for security purposes
    error_log("Price mismatch for product $product_id: User sent $price, server calculated $calculated_price");
    // Use our calculated price instead
}

// Check if the product is already in cart
$cart_check_query = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id LIMIT 1";
$cart_check_result = mysqli_query($conn, $cart_check_query);

if ($cart_check_result && mysqli_num_rows($cart_check_result) > 0) {
    // Update existing cart item
    $cart_item = mysqli_fetch_assoc($cart_check_result);
    $new_quantity = $cart_item['quantity'] + $quantity;
    
    // Check if new quantity exceeds stock
    if ($new_quantity > $product['quantity']) {
        $new_quantity = $product['quantity'];
    }
    
    $update_query = "UPDATE cart SET quantity = $new_quantity, price = $calculated_price, updated_at = NOW() WHERE id = {$cart_item['id']}";
    $update_result = mysqli_query($conn, $update_query);
    
    if (!$update_result) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update cart: ' . mysqli_error($conn)
        ]);
        exit;
    }
} else {
    // Create new cart item
    $insert_query = "INSERT INTO cart (user_id, product_id, seller_id, quantity, price, created_at, updated_at) 
                    VALUES ($user_id, $product_id, $seller_id, $quantity, $calculated_price, NOW(), NOW())";
    $insert_result = mysqli_query($conn, $insert_query);
    
    if (!$insert_result) {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to add to cart: ' . mysqli_error($conn)
        ]);
        exit;
    }
}

// Get the cart count for the user
$cart_count_query = "SELECT SUM(quantity) as cart_count FROM cart WHERE user_id = $user_id";
$cart_count_result = mysqli_query($conn, $cart_count_query);
$cart_count = 0;

if ($cart_count_result && $row = mysqli_fetch_assoc($cart_count_result)) {
    $cart_count = $row['cart_count'] ?? 0;
}

// Return success response
echo json_encode([
    'success' => true,
    'message' => 'Product added to cart successfully',
    'cartCount' => $cart_count
]);
exit;
?>
