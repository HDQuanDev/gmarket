<?php
require_once(__DIR__ . "/../config.php");
// API for chat functionality
header('Content-Type: application/json');

// Error handling - wrap everything in a try-catch
try {
    // Check if the user is logged in - either as a user or a seller
    $user_id = $_SESSION['user_id'] ?? null;
    $seller_id = $_SESSION['seller_id'] ?? null;

    // Determine user type based on login state
    if ($seller_id) {
        $current_id = $seller_id;
        $user_type = 'seller';
    } elseif ($user_id) {
        $current_id = $user_id;
        $user_type = $_SESSION['role'] ?? 'user'; // Get user role from session
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
        exit;
    }

    // Get request method and action
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';

    // Router for different actions
    switch ($action) {
        case 'get_conversations':
            getConversations($current_id, $user_type);
            break;

        case 'get_messages':
            getMessages($current_id, $user_type);
            break;

        case 'start_conversation':
            startConversation($current_id, $user_type);
            break;

        case 'send_message':
            sendMessage($current_id, $user_type);
            break;
            
        case 'send_message_with_attachment':
            sendMessageWithAttachment($current_id, $user_type);
            break;

        case 'mark_read':
            markMessagesAsRead($current_id, $user_type);
            break;

        default:
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Action not found']);
    }
} catch (Exception $e) {
    // Log error
    error_log('Chat API Error: ' . $e->getMessage());
    
    // Return JSON error
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error occurred',
        'error' => $e->getMessage()
    ]);
}

// Get all conversations for a user or seller
function getConversations($user_id, $user_type)
{
    global $conn;
    
    // Check if conversations table exists
    $check_table = $conn->query("SHOW TABLES LIKE 'chat_conversations'");
    if ($check_table->num_rows == 0) {
        echo json_encode(['success' => true, 'conversations' => []]);
        return;
    }
    
    $id_field = $user_type . '_id';
    $other_type = $user_type === 'user' ? 'seller' : 'user';
    $other_field = $other_type . '_id';

    // Get all conversations with the most recent message
    $query = "
        SELECT 
            c.id as conversation_id,
            c.{$other_field} as other_id,
            o.full_name as other_name,
            " . ($other_type === 'seller' ? "IFNULL(o.shop_name, o.full_name) as display_name" : "o.full_name as display_name") . ",
            (
                SELECT COUNT(*) 
                FROM chat_messages m 
                WHERE m.conversation_id = c.id 
                AND m.sender_type = '{$other_type}' 
                AND m.is_read = 0
            ) as unread_count,
            (   
                SELECT message 
                FROM chat_messages 
                WHERE conversation_id = c.id 
                ORDER BY created_at DESC LIMIT 1
            ) as last_message, 
            (   
                SELECT created_at 
                FROM chat_messages 
                WHERE conversation_id = c.id 
                ORDER BY created_at DESC LIMIT 1
            ) as last_message_time
        FROM 
            chat_conversations c
        LEFT JOIN 
            " . ($other_type === 'user' ? "users" : "sellers") . " o ON c.{$other_field} = o.id
        WHERE 
            c.{$id_field} = ?
        ORDER BY  
            last_message_time DESC
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $conversations = [];
    while ($row = $result->fetch_assoc()) {
        // Format time
        if (!empty($row['last_message_time'])) {
            $timestamp = strtotime($row['last_message_time']);
            $now = time();
            $diff = $now - $timestamp;
            
            if ($diff < 60) {
                $row['time_display'] = 'Just now';
            } elseif ($diff < 3600) {
                $row['time_display'] = floor($diff / 60) . ' min ago';
            } elseif ($diff < 86400) {
                $row['time_display'] = floor($diff / 3600) . ' hours ago';
            } elseif ($diff < 604800) {
                $row['time_display'] = floor($diff / 86400) . ' days ago';
            } else {
                $row['time_display'] = date('M j', $timestamp);
            }
        } else {
            $row['time_display'] = 'N/A';
        }
        
        $conversations[] = $row;
    }
    
    echo json_encode(['success' => true, 'conversations' => $conversations]);
}

// Get messages for a specific conversation
function getMessages($user_id, $user_type)
{
    global $conn;
    
    $conversation_id = $_GET['conversation_id'] ?? 0;
    if (!$conversation_id) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Conversation ID is required']);
        return;
    }

    // Verify that the user is part of this conversation
    $field = $user_type . '_id';
    $query = "SELECT id FROM chat_conversations WHERE id = ? AND {$field} = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $conversation_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'You do not have access to this conversation']);
        return;
    }

    // Get conversation details for display
    $other_type = $user_type === 'user' ? 'seller' : 'user';
    $other_field = $other_type . '_id';

    $query = "
        SELECT 
            c.id as conversation_id,
            c.{$other_field} as other_id,
            o.full_name as other_name,
            " . ($other_type === 'seller' ? "IFNULL(o.shop_name, o.full_name) as display_name" : "o.full_name as display_name") . "
        FROM 
            chat_conversations c
        LEFT JOIN 
            " . ($other_type === 'user' ? "users" : "sellers") . " o ON c.{$other_field} = o.id
        WHERE 
            c.id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $conversation_id);
    $stmt->execute();
    $conversation_result = $stmt->get_result();
    $conversation = $conversation_result->fetch_assoc();

    // Check if chat_messages table has attachment column
    $has_attachment_column = false;
    $check_column = $conn->query("SHOW COLUMNS FROM chat_messages LIKE 'attachment'");
    if ($check_column->num_rows > 0) {
        $has_attachment_column = true;
    }

    // Get messages with pagination
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;
    $offset = ($page - 1) * $limit;

    $query = "
        SELECT 
            m.*,
            DATE_FORMAT(m.created_at, '%Y-%m-%d %H:%i:%s') as formatted_time
            " . ($has_attachment_column ? "" : ", NULL as attachment") . "
        FROM 
            chat_messages m
        WHERE 
            m.conversation_id = ?
        ORDER BY 
            m.created_at DESC
        LIMIT ?, ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $conversation_id, $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $row['is_sender'] = ($row['sender_type'] === $user_type && intval($row['sender_id']) === intval($user_id));
        
        // Add full URL to attachment if present and create attachment_url for client compatibility
        if (!empty($row['attachment'])) {
            $row['attachment_url'] = '/public/uploads/' . $row['attachment'];
        }
        
        $messages[] = $row;
    }

    // Reverse to get chronological order
    $messages = array_reverse($messages);

    // Mark messages from the other party as read
    $stmt = $conn->prepare("
        UPDATE chat_messages 
        SET is_read = 1 
        WHERE conversation_id = ? AND sender_type = ? AND is_read = 0
    ");
    $stmt->bind_param('is', $conversation_id, $other_type);
    $stmt->execute();

    echo json_encode([
        'success' => true,
        'conversation' => $conversation,
        'messages' => $messages,
        'pagination' => [
            'page' => $page,
            'limit' => $limit,
            'more' => count($messages) >= $limit
        ]
    ]);
}

// Start a new conversation
function startConversation($user_id, $user_type)
{
    global $conn;
    
    // Check if conversations table exists
    $check_table = $conn->query("SHOW TABLES LIKE 'chat_conversations'");
    if ($check_table->num_rows == 0) {
        // Create the tables if they don't exist
        createChatTables();
    }
    
    // Only users can start conversations with sellers
    if ($user_type !== 'user') {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Only users can start new conversations']);
        return;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $seller_id = $data['seller_id'] ?? $_POST['seller_id'] ?? null;
    $initial_message = $data['message'] ?? $_POST['message'] ?? null;

    if (!$seller_id) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Seller ID is required']);
        return;
    }

    // Check if seller exists and is active
    $stmt = $conn->prepare("SELECT id FROM sellers WHERE id = ? AND status = 'active'");
    $stmt->bind_param('i', $seller_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Seller not found or inactive']);
        return;
    }

    // Check if conversation already exists
    $stmt = $conn->prepare("SELECT id FROM chat_conversations WHERE user_id = ? AND seller_id = ?");
    $stmt->bind_param('ii', $user_id, $seller_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing = $result->fetch_assoc();

    $conversation_id = null;
    if ($existing) {
        // Use existing conversation
        $conversation_id = $existing['id'];
    } else {
        // Create new conversation
        $stmt = $conn->prepare("INSERT INTO chat_conversations (user_id, seller_id, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param('ii', $user_id, $seller_id);
        $stmt->execute();
        $conversation_id = $conn->insert_id;
    }

    // If there's an initial message, add it
    if ($initial_message && $conversation_id) {
        $stmt = $conn->prepare("
            INSERT INTO chat_messages 
            (conversation_id, sender_type, sender_id, message, is_read, created_at) 
            VALUES (?, 'user', ?, ?, 0, NOW())
        ");
        $stmt->bind_param('iis', $conversation_id, $user_id, $initial_message);
        $stmt->execute();
    }

    echo json_encode([
        'success' => true,
        'conversation_id' => $conversation_id,
        'is_new' => !$existing
    ]);
}

// Send a message in an existing conversation
function sendMessage($user_id, $user_type)
{
    global $conn;

    $data = json_decode(file_get_contents('php://input'), true);
    $conversation_id = $data['conversation_id'] ?? $_POST['conversation_id'] ?? null;
    $message = $data['message'] ?? $_POST['message'] ?? null;

    if (!$conversation_id || !$message) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Conversation ID and message are required']);
        return;
    }

    // Verify that the user is part of this conversation
    $field = $user_type . '_id';
    $query = "SELECT id FROM chat_conversations WHERE id = ? AND {$field} = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $conversation_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'You do not have access to this conversation']);
        return;
    }

    // Normalize sender_type to ensure it's either 'user' or 'seller' exactly
    $normalized_user_type = (strtolower(trim($user_type)) === 'seller') ? 'seller' : 'user';

    // Insert the message
    $stmt = $conn->prepare("
        INSERT INTO chat_messages 
        (conversation_id, sender_type, sender_id, message, is_read, created_at) 
        VALUES (?, ?, ?, ?, 0, NOW())
    ");
    $stmt->bind_param('issi', $conversation_id, $normalized_user_type, $user_id, $message);
    $stmt->execute();
    $message_id = $conn->insert_id;

    // Get the message with timestamp
    $stmt = $conn->prepare("
        SELECT 
            id, conversation_id, sender_type, sender_id, message, is_read,
            DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as formatted_time,
            created_at
        FROM chat_messages
        WHERE id = ?
    ");
    $stmt->bind_param('i', $message_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $message_data = $result->fetch_assoc();

    echo json_encode(['success' => true, 'message' => $message_data]);
}

/**
 * Send a message with an attachment
 */
function sendMessageWithAttachment($user_id, $user_type)
{
    global $conn;

    $conversation_id = $_POST['conversation_id'] ?? null;
    $message = $_POST['message'] ?? '';
    
    if (!$conversation_id) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Conversation ID is required']);
        return;
    }

    // Verify that the user is part of this conversation
    $field = $user_type . '_id';
    $query = "SELECT id FROM chat_conversations WHERE id = ? AND {$field} = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $conversation_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'You do not have access to this conversation']);
        return;
    }

    // Process attachment file
    $attachment_url = null;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['attachment'];
        
        // Validate file is an image
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowed_types)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Only image files are allowed']);
            return;
        }
        
        // Validate file size (max 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'File size exceeds the 5MB limit']);
            return;
        }
        
        // Create uploads directory if it doesn't exist
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/chat/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        // Generate unique filename
        $filename = uniqid('chat_') . '_' . time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '', $file['name']);
        $filepath = $upload_dir . $filename;
        
        // Save the file
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            $attachment_url = 'chat/' . $filename;
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to upload attachment']);
            return;
        }
    }

    // Normalize sender_type to ensure it's either 'user' or 'seller' exactly
    $normalized_user_type = (strtolower(trim($user_type)) === 'seller') ? 'seller' : 'user';

    // Check if chat_messages table has attachment column, add if not
    $check_column = $conn->query("SHOW COLUMNS FROM chat_messages LIKE 'attachment'");
    if ($check_column->num_rows === 0) {
        // Add the column
        $conn->query("ALTER TABLE chat_messages ADD COLUMN attachment VARCHAR(255) NULL AFTER message");
    }
    
    // Insert the message with attachment
    $stmt = $conn->prepare("
        INSERT INTO chat_messages 
        (conversation_id, sender_type, sender_id, message, attachment, is_read, created_at) 
        VALUES (?, ?, ?, ?, ?, 0, NOW())
    ");
    $stmt->bind_param('issss', $conversation_id, $normalized_user_type, $user_id, $message, $attachment_url);
    $stmt->execute();
    $message_id = $conn->insert_id;

    // Get the message with timestamp
    $stmt = $conn->prepare("
        SELECT 
            id, conversation_id, sender_type, sender_id, message, attachment, is_read,
            DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') as formatted_time,
            created_at
        FROM chat_messages
        WHERE id = ?
    ");
    $stmt->bind_param('i', $message_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $message_data = $result->fetch_assoc();
    
    // Add full URL to the attachment
    if ($message_data['attachment']) {
        $message_data['attachment_url'] = '/public/uploads/' . $message_data['attachment'];
    }

    echo json_encode(['success' => true, 'message' => $message_data]);
}

// Mark messages as read in conversation
function markMessagesAsRead($user_id, $user_type)
{
    global $conn;

    $data = json_decode(file_get_contents('php://input'), true);
    $conversation_id = $data['conversation_id'] ?? null;
    
    if (!$conversation_id) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Conversation ID is required']);
        return;
    }

    // Verify that the user is part of this conversation
    $field = $user_type . '_id';
    $query = "SELECT id FROM chat_conversations WHERE id = ? AND {$field} = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $conversation_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'You do not have access to this conversation']);
        return;
    }

    // Mark messages from the other party as read
    $other_type = $user_type === 'user' ? 'seller' : 'user';
    $stmt = $conn->prepare("
        UPDATE chat_messages 
        SET is_read = 1 
        WHERE conversation_id = ? AND sender_type = ? AND is_read = 0
    ");
    $stmt->bind_param('is', $conversation_id, $other_type);
    $stmt->execute();

    echo json_encode([
        'success' => true,
        'message' => 'Messages marked as read'
    ]);
}

// Create necessary tables for chat
function createChatTables()
{
    global $conn;

    // Create chat_conversations table
    $conn->query("
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

    // Create chat_messages table with attachment support
    $conn->query("
        CREATE TABLE IF NOT EXISTS `chat_messages` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `conversation_id` int(11) NOT NULL,
          `sender_type` enum('user','seller') NOT NULL,
          `sender_id` int(11) NOT NULL,
          `message` text NOT NULL,
          `attachment` varchar(255) DEFAULT NULL,
          `is_read` tinyint(1) NOT NULL DEFAULT '0',
          `created_at` datetime NOT NULL,
          PRIMARY KEY (`id`),
          KEY `conversation_id` (`conversation_id`),
          KEY `sender_id_type` (`sender_id`,`sender_type`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    // Create notifications table
    $conn->query("
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
}
?>