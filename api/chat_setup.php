<?php
require_once(__DIR__ . "/../config.php");
header('Content-Type: application/json');

try {
    // Check admin privileges
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
        exit;
    }

    // Create tables
    createChatTables();
    
    echo json_encode([
        'success' => true,
        'message' => 'Chat tables created successfully'
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error creating tables',
        'error' => $e->getMessage()
    ]);
}

/**
 * Create necessary tables for chat
 */
function createChatTables() {
    global $conn;
    
    // Create chat_conversations table
    $result1 = $conn->query("
        CREATE TABLE IF NOT EXISTS `chat_conversations` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL,
          `seller_id` int(11) NOT NULL,
          `created_at` datetime NOT NULL,
          `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          KEY `user_id` (`user_id`),
          KEY `seller_id` (`seller_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    
    // Create chat_messages table
    $result2 = $conn->query("
        CREATE TABLE IF NOT EXISTS `chat_messages` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `conversation_id` int(11) NOT NULL,
          `sender_type` enum('user','seller') NOT NULL,
          `sender_id` int(11) NOT NULL,
          `message` text NOT NULL,
          `is_read` tinyint(1) NOT NULL DEFAULT '0',
          `created_at` datetime NOT NULL,
          PRIMARY KEY (`id`),
          KEY `conversation_id` (`conversation_id`),
          KEY `sender_id_type` (`sender_id`,`sender_type`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    
    // Create notifications table
    $result3 = $conn->query("
        CREATE TABLE IF NOT EXISTS `notifications` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `receiver_id` int(11) NOT NULL,
          `receiver_type` enum('user','seller','admin') NOT NULL,
          `type` varchar(50) NOT NULL,
          `title` varchar(255) NOT NULL,
          `content` text,
          `reference_id` int(11) DEFAULT NULL,
          `is_read` tinyint(1) NOT NULL DEFAULT '0',
          `created_at` datetime NOT NULL,
          PRIMARY KEY (`id`),
          KEY `receiver_id_type` (`receiver_id`,`receiver_type`),
          KEY `is_read` (`is_read`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    
    if (!$result1 || !$result2 || !$result3) {
        throw new Exception("Error creating tables: " . $conn->error);
    }
    
    return true;
}
?>
