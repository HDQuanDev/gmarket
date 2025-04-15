<?php
include_once '../../config.php';

// Authentication check
if (!isset($_SESSION['seller_id'])) {
    header('Location: /seller/login.php');
    exit();
}

$seller_id = $_SESSION['seller_id'];
$seller_query = "SELECT * FROM sellers WHERE id = '$seller_id'";
$seller_data = fetch_array($seller_query);

// Include bootstrap file for dynamic script loading
// include_once($_SERVER['DOCUMENT_ROOT'] . '/public/bootstrap.php');
// // Output the notification loader HTML
// echo getNotificationLoaderHTML();
// Page configuration
$page_title = "Tin nhắn với khách hàng";
$hide_sidebar = true; // We're using full screen layout
$hide_header = true;  // We have our own custom header

// Include required components
require_once 'includes/chat-meta.php';        // Meta tags and basic configuration
require_once 'includes/chat-styles.php';      // Enhanced CSS styles
require_once 'includes/chat-container.php';   // Redesigned HTML structure for chat interface

// Include only necessary scripts
require_once 'includes/chat-scripts.php';
