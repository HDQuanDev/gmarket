<?php
require_once(__DIR__ . "/config.php");

// Check if user is logged in
if (!isset($user_id) || $user_id <= 0) {
    header("Location: /users/login.php?redirect=" . urlencode($_SERVER['HTTP_REFERER']));
    exit;
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

// Get form data
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
$detail_order_id = isset($_POST['detail_order_id']) ? intval($_POST['detail_order_id']) : 0;
$rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
$comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

// Add debug output
error_log("Review submission - Product ID: $product_id, Order ID: $order_id, Detail ID: $detail_order_id");

// Validate data
$errors = [];

if ($product_id <= 0) {
    $errors[] = "Invalid product";
}

if ($order_id <= 0 || $detail_order_id <= 0) {
    $errors[] = "Invalid order information";
}

if ($rating <= 0 || $rating > 5) {
    $errors[] = "Please select a rating between 1 and 5 stars";
}

if (empty($comment)) {
    $errors[] = "Please write a review comment";
}

// If there are errors, redirect back with error message
if (!empty($errors)) {
    $error_message = implode("<br>", $errors);
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=" . urlencode($error_message));
    exit;
}

// Verify that this order detail belongs to the current user and hasn't been reviewed yet
$verify_query = "SELECT d.id, o.id as order_id, o.delivery_status 
                FROM detail_orders d
                JOIN orders o ON d.order_id = o.id
                LEFT JOIN product_reviews r ON r.detail_order_id = d.id
                WHERE d.id = $detail_order_id
                AND d.order_id = $order_id
                AND d.user_id = $user_id
                AND r.id IS NULL
                LIMIT 1";
                
$verify_result = mysqli_query($conn, $verify_query);

if (!$verify_result || mysqli_num_rows($verify_result) == 0) {
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=" . urlencode("You cannot review this order or it has already been reviewed"));
    exit;
}

// Process uploaded images if any
$images = [];
if (!empty($_FILES['review_images']['name'][0])) {
    $upload_dir = __DIR__ . "/public/uploads/reviews/";
    
    // Create directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    foreach ($_FILES['review_images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['review_images']['error'][$key] == 0) {
            $filename = time() . '_' . $_FILES['review_images']['name'][$key];
            $filename = preg_replace('/[^A-Za-z0-9.\-_]/', '', $filename); // Sanitize filename
            $destination = $upload_dir . $filename;
            
            if (move_uploaded_file($tmp_name, $destination)) {
                $images[] = $filename;
            }
        }
    }
}

// Insert the review into the database
$images_str = !empty($images) ? implode(",", $images) : null;
$status = "approved"; // Auto-approve reviews for now

$stmt = $conn->prepare("INSERT INTO product_reviews (product_id, user_id, order_id, detail_order_id, rating, comment, images, status, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("iiiiisss", $product_id, $user_id, $order_id, $detail_order_id, $rating, $comment, $images_str, $status);

if ($stmt->execute()) {
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=" . urlencode("Thank you! Your review has been submitted."));
} else {
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=" . urlencode("Failed to submit review. Please try again. " . $stmt->error));
}

$stmt->close();
?>
