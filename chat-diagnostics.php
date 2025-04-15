<?php
require_once(__DIR__ . "/config.php");

// Only admins can access this page
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}

// Get server status
$socket_status = [];
try {
    $socket_url = "http://localhost:3000/health";  // Adjust to your socket server URL
    $context = stream_context_create([
        'http' => [
            'timeout' => 5,
            'ignore_errors' => true
        ]
    ]);
    
    $response = @file_get_contents($socket_url, false, $context);
    
    if ($response === false) {
        $socket_status = [
            'status' => 'error',
            'message' => 'Could not connect to socket server'
        ];
    } else {
        $socket_status = json_decode($response, true);
    }
} catch (Exception $e) {
    $socket_status = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
}

// Get database status
$db_status = [
    'conversations_table' => false,
    'messages_table' => false,
    'notifications_table' => false,
    'conversations_count' => 0,
    'messages_count' => 0,
    'unread_count' => 0
];

$tables = ['chat_conversations', 'chat_messages', 'notifications'];
foreach ($tables as $table) {
    $check = $conn->query("SHOW TABLES LIKE '$table'");
    $field = str_replace('chat_', '', $table) . "_table";
    $db_status[$field] = $check->num_rows > 0;
}

if ($db_status['conversations_table']) {
    $result = $conn->query("SELECT COUNT(*) as count FROM chat_conversations");
    $db_status['conversations_count'] = $result->fetch_assoc()['count'];
}

if ($db_status['messages_table']) {
    $result = $conn->query("SELECT COUNT(*) as count FROM chat_messages");
    $db_status['messages_count'] = $result->fetch_assoc()['count'];
    
    $result = $conn->query("SELECT COUNT(*) as count FROM chat_messages WHERE is_read = 0");
    $db_status['unread_count'] = $result->fetch_assoc()['count'];
}

// Function to create diagnostic log
function createDiagnosticLog() {
    global $conn, $socket_status, $db_status;
    
    $log = [];
    $log[] = "Chat System Diagnostic Log - " . date('Y-m-d H:i:s');
    $log[] = "----------------------------------------------------";
    
    // Socket Server Status
    $log[] = "SOCKET SERVER STATUS:";
    $log[] = "Status: " . ($socket_status['status'] ?? 'unknown');
    if (isset($socket_status['message'])) {
        $log[] = "Message: " . $socket_status['message'];
    }
    if (isset($socket_status['connections'])) {
        $log[] = "Connected users: " . ($socket_status['connections']['count']['users'] ?? 'unknown');
        $log[] = "Connected sellers: " . ($socket_status['connections']['count']['sellers'] ?? 'unknown');
    }
    $log[] = "";
    
    // Database Status
    $log[] = "DATABASE STATUS:";
    $log[] = "Conversations table exists: " . ($db_status['conversations_table'] ? 'Yes' : 'No');
    $log[] = "Messages table exists: " . ($db_status['messages_table'] ? 'Yes' : 'No');
    $log[] = "Notifications table exists: " . ($db_status['notifications_table'] ? 'Yes' : 'No');
    $log[] = "Conversation count: " . $db_status['conversations_count'];
    $log[] = "Message count: " . $db_status['messages_count'];
    $log[] = "Unread message count: " . $db_status['unread_count'];
    $log[] = "";
    
    // Recent Messages
    $log[] = "RECENT MESSAGES (last 20):";
    if ($db_status['messages_table']) {
        $query = "
            SELECT 
                m.id, m.conversation_id, m.sender_type, m.sender_id, 
                LEFT(m.message, 50) as message, m.is_read, m.created_at,
                CASE 
                    WHEN m.sender_type = 'user' THEN u.full_name
                    ELSE s.full_name
                END as sender_name
            FROM 
                chat_messages m
            LEFT JOIN
                users u ON m.sender_id = u.id AND m.sender_type = 'user'
            LEFT JOIN
                sellers s ON m.sender_id = s.id AND m.sender_type = 'seller'
            ORDER BY 
                m.created_at DESC
            LIMIT 20
        ";
        
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $log[] = sprintf(
                    "#%d | %s | %s (%s ID: %d) | %s | Read: %s",
                    $row['id'],
                    $row['created_at'],
                    $row['sender_name'],
                    $row['sender_type'],
                    $row['sender_id'],
                    $row['message'] . (strlen($row['message']) > 50 ? '...' : ''),
                    $row['is_read'] ? 'Yes' : 'No'
                );
            }
        } else {
            $log[] = "No messages found";
        }
    } else {
        $log[] = "Messages table does not exist";
    }
    
    return implode("\n", $log);
}

$diagnostic_log = createDiagnosticLog();

// Handle actions
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create_tables':
                // Create tables
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
                
                $conn->query("
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
                
                $message = 'Tables created successfully';
                // Refresh the page to update diagnostics
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
                
                break;
                
            case 'download_log':
                // Download diagnostic log
                header('Content-Type: text/plain');
                header('Content-Disposition: attachment; filename="chat-diagnostics.log"');
                echo $diagnostic_log;
                exit;
                
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System Diagnostics</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Chat System Diagnostics</h1>
        
        <?php if ($message): ?>
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Socket Server Status</h2>
                
                <div class="mb-4">
                    <div class="flex items-center">
                        <span class="font-medium mr-2">Status:</span>
                        <?php if (isset($socket_status['status']) && $socket_status['status'] === 'ok'): ?>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Online</span>
                        <?php else: ?>
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Offline or Error</span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (isset($socket_status['message'])): ?>
                        <div class="mt-2 text-gray-700">
                            <span class="font-medium">Message:</span> <?php echo $socket_status['message']; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($socket_status['connections'])): ?>
                        <div class="mt-4">
                            <div class="font-medium mb-2">Connected Clients:</div>
                            <div class="pl-4">
                                <div>Users: <?php echo $socket_status['connections']['count']['users'] ?? 0; ?></div>
                                <div>Sellers: <?php echo $socket_status['connections']['count']['sellers'] ?? 0; ?></div>
                                <div>Total: <?php echo $socket_status['connections']['count']['total'] ?? 0; ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Database Status</h2>
                
                <div class="mb-4">
                    <div class="grid grid-cols-2 gap-2">
                        <div>Conversations table:</div>
                        <div><?php echo $db_status['conversations_table'] ? 'Exists' : 'Missing'; ?></div>
                        
                        <div>Messages table:</div>
                        <div><?php echo $db_status['messages_table'] ? 'Exists' : 'Missing'; ?></div>
                        
                        <div>Notifications table:</div>
                        <div><?php echo $db_status['notifications_table'] ? 'Exists' : 'Missing'; ?></div>
                        
                        <div>Total conversations:</div>
                        <div><?php echo $db_status['conversations_count']; ?></div>
                        
                        <div>Total messages:</div>
                        <div><?php echo $db_status['messages_count']; ?></div>
                        
                        <div>Unread messages:</div>
                        <div><?php echo $db_status['unread_count']; ?></div>
                    </div>
                </div>
                
                <?php if (!$db_status['conversations_table'] || !$db_status['messages_table'] || !$db_status['notifications_table']): ?>
                    <form method="post" class="mt-4">
                        <input type="hidden" name="action" value="create_tables">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Create Missing Tables
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="mt-8 bg-white p-6 rounded shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Diagnostic Log</h2>
                <form method="post">
                    <input type="hidden" name="action" value="download_log">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-sm">
                        Download Log
                    </button>
                </form>
            </div>
            
            <pre class="bg-gray-100 p-4 rounded text-sm overflow-auto h-96"><?php echo htmlspecialchars($diagnostic_log); ?></pre>
        </div>
    </div>
</body>
</html>
