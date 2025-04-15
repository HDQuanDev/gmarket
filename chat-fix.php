<?php
require_once(__DIR__ . "/config.php");

// Only allow admins to run this script
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Only administrators can run this script.");
}

// Check if we need to execute the fix
$execute = isset($_GET['execute']) && $_GET['execute'] === 'true';

// Output will be stored here
$output = [];

// Check if attachment_url column exists
$check_attachment_url = $conn->query("SHOW COLUMNS FROM chat_messages LIKE 'attachment_url'");
$has_attachment_url = $check_attachment_url && $check_attachment_url->num_rows > 0;

// Check if attachment column exists
$check_attachment = $conn->query("SHOW COLUMNS FROM chat_messages LIKE 'attachment'");
$has_attachment = $check_attachment && $check_attachment->num_rows > 0;

$output[] = "Current database status:";
$output[] = "- attachment_url column exists: " . ($has_attachment_url ? "Yes" : "No");
$output[] = "- attachment column exists: " . ($has_attachment ? "Yes" : "No");

if ($execute) {
    if ($has_attachment_url && !$has_attachment) {
        // Case 1: Only attachment_url exists - rename it to attachment
        $conn->query("ALTER TABLE chat_messages CHANGE COLUMN attachment_url attachment VARCHAR(255) DEFAULT NULL");
        $output[] = "Renamed attachment_url column to attachment.";
    } 
    elseif ($has_attachment_url && $has_attachment) {
        // Case 2: Both columns exist - copy data from attachment_url to attachment
        $conn->query("UPDATE chat_messages SET attachment = attachment_url WHERE attachment IS NULL AND attachment_url IS NOT NULL");
        $conn->query("ALTER TABLE chat_messages DROP COLUMN attachment_url");
        $output[] = "Copied data from attachment_url to attachment and dropped attachment_url column.";
    }
    elseif (!$has_attachment_url && !$has_attachment) {
        // Case 3: Neither column exists - add attachment column
        $conn->query("ALTER TABLE chat_messages ADD COLUMN attachment VARCHAR(255) DEFAULT NULL AFTER message");
        $output[] = "Added attachment column to chat_messages table.";
    }
    // Case 4: Only attachment exists - already good, do nothing
    
    // Verify the fix
    $check_attachment = $conn->query("SHOW COLUMNS FROM chat_messages LIKE 'attachment'");
    $has_attachment = $check_attachment && $check_attachment->num_rows > 0;
    
    $check_attachment_url = $conn->query("SHOW COLUMNS FROM chat_messages LIKE 'attachment_url'");
    $has_attachment_url = $check_attachment_url && $check_attachment_url->num_rows > 0;
    
    $output[] = "\nAfter fix:";
    $output[] = "- attachment_url column exists: " . ($has_attachment_url ? "Yes" : "No");
    $output[] = "- attachment column exists: " . ($has_attachment ? "Yes" : "No");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat Attachment Fix</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        pre { background: #f5f5f5; padding: 10px; border-radius: 5px; overflow-x: auto; }
        .button { display: inline-block; background: #4CAF50; color: white; padding: 10px 15px; 
                text-decoration: none; border-radius: 4px; margin-top: 20px; }
        .warning { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chat Attachment Column Fix</h1>
        
        <?php if (!$execute): ?>
            <p>This script will fix the column name in the chat_messages table, changing from 'attachment_url' to 'attachment'.</p>
            <p class="warning">Important: Please backup your database before proceeding.</p>
            <a href="?execute=true" class="button">Execute Fix</a>
        <?php else: ?>
            <h3>Fix Complete</h3>
            <pre><?php echo implode("\n", $output); ?></pre>
            <a href="chat-diagnostics.php" class="button">Go to Chat Diagnostics</a>
        <?php endif; ?>
    </div>
</body>
</html>
