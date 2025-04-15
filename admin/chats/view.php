<?php
include("../../config.php");
if(!$isLogin || !$isAdmin) header("Location: /");

// Define the missing get_image_path function
function get_image_path($image_id) {
    // Simple implementation - assumes the image ID directly maps to a filename
    // You might need to adjust this based on your actual image storage system
    if (empty($image_id) || $image_id <= 0) {
        return 'placeholder.jpg';
    }
    
    // Query to get the actual file path from the uploads table if needed
    global $conn;
    $query = "SELECT file_name FROM uploads WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $image_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['file_name'];
    }
    
    return 'placeholder.jpg';
}

$conversation_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Redirect if no conversation ID provided
if($conversation_id <= 0) {
    header("Location: index.php");
    exit;
}

// Get conversation details
$conversation_query = "SELECT c.*, 
                      u.full_name as user_name, u.email as user_email, IFNULL(u.logo, 0) as user_avatar,
                      s.full_name as seller_name, s.email as seller_email, s.shop_name, IFNULL(s.shop_logo, 0) as seller_avatar
                      FROM chat_conversations c
                      JOIN users u ON c.user_id = u.id
                      JOIN sellers s ON c.seller_id = s.id
                      WHERE c.id = ? LIMIT 1";

$stmt = $conn->prepare($conversation_query);
$stmt->bind_param("i", $conversation_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
    // Conversation doesn't exist
    header("Location: index.php");
    exit;
}

$conversation = $result->fetch_assoc();

// Get all messages from this conversation
$messages_query = "SELECT m.*, 
                  CASE WHEN m.sender_type = 'user' 
                       THEN (SELECT IFNULL(u.logo, 0) FROM users u WHERE u.id = m.sender_id)
                       ELSE (SELECT IFNULL(s.shop_logo, 0) FROM sellers s WHERE s.id = m.sender_id)
                  END as sender_avatar
                  FROM chat_messages m
                  WHERE m.conversation_id = ?
                  ORDER BY m.created_at ASC";

$stmt = $conn->prepare($messages_query);
$stmt->bind_param("i", $conversation_id);
$stmt->execute();
$messages_result = $stmt->get_result();

$messages = [];
while($message = $messages_result->fetch_assoc()) {
    $messages[] = $message;
}

// Function to format dates in a readable way
function formatMessageDate($date) {
    $timestamp = strtotime($date);
    $now = time();
    $diff = $now - $timestamp;
    
    if($diff < 60) {
        return "Just now";
    } elseif($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . " " . ($minutes == 1 ? "minute" : "minutes") . " ago";
    } elseif($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . " " . ($hours == 1 ? "hour" : "hours") . " ago";
    } elseif($diff < 172800) {
        return "Yesterday at " . date('h:i A', $timestamp);
    } else {
        return date('M d, Y h:i A', $timestamp);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="eObVDgS1BnyzqUZf3wNmMehk2sbNi4MatBxDBYhn">
    <meta name="app-url" content="//gmarket-quocte.com/">
    <meta name="file-base-url" content="//gmarket-quocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
    <title>Conversation Details - Gmarket Admin</title>

    <!-- Google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AIZ core CSS -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-core.css">

    <style>
        .message-bubble {
            max-width: 70%;
        }
        .message-bubble img, .message-bubble video {
            max-width: 300px;
            max-height: 200px;
            border-radius: 8px;
        }
        .message-time {
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="aiz-main-wrapper">
        <?php include("../layout/sidebar.php") ?>

        <div class="aiz-content-wrapper">
            <?php include("../layout/topbar.php") ?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <div class="bg-white rounded-lg shadow-sm mb-4">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <div>
                                <h1 class="text-xl font-medium text-gray-800">
                                    <a href="index.php" class="mr-2 text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                    Conversation Details
                                </h1>
                                <p class="text-sm text-gray-500 mt-1">Chat between seller and user</p>
                            </div>
                            <div>
                                <button onclick="exportConversation()" class="btn btn-soft-primary rounded-md">
                                    <i class="fas fa-download mr-1"></i> Export
                                </button>
                            </div>
                        </div>

                        <!-- Conversation Participants -->
                        <div class="p-4 border-b border-gray-200 bg-gray-50">
                            <div class="flex flex-wrap md:flex-nowrap justify-between">
                                <div class="w-full md:w-1/2 mb-4 md:mb-0 md:pr-4">
                                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-14 w-14">
                                                <?php if($conversation['user_avatar']): ?>
                                                    <img class="h-14 w-14 rounded-full object-cover" src="/public/uploads/all/<?= get_image_path($conversation['user_avatar']) ?>" alt="User">
                                                <?php else: ?>
                                                    <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center">
                                                        <span class="text-blue-600 font-medium text-xl"><?= substr($conversation['user_name'] ?? 'U', 0, 1) ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-4">
                                                <h2 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($conversation['user_name']) ?></h2>
                                                <p class="text-sm text-gray-500">
                                                    <i class="fas fa-envelope mr-1"></i> <?= htmlspecialchars($conversation['user_email']) ?>
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    <i class="fas fa-user mr-1"></i> User #<?= $conversation['user_id'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 md:pl-4">
                                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-14 w-14">
                                                <?php if($conversation['seller_avatar']): ?>
                                                    <img class="h-14 w-14 rounded-full object-cover" src="/public/uploads/all/<?= get_image_path($conversation['seller_avatar']) ?>" alt="Seller">
                                                <?php else: ?>
                                                    <div class="h-14 w-14 rounded-full bg-green-100 flex items-center justify-center">
                                                        <span class="text-green-600 font-medium text-xl"><?= substr($conversation['seller_name'] ?? 'S', 0, 1) ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-4">
                                                <h2 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($conversation['seller_name']) ?></h2>
                                                <p class="text-sm text-gray-500">
                                                    <i class="fas fa-store mr-1"></i> <?= htmlspecialchars($conversation['shop_name']) ?>
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    <i class="fas fa-envelope mr-1"></i> <?= htmlspecialchars($conversation['seller_email']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Messages -->
                        <div class="px-4 py-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Chat History</h3>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 h-[600px] overflow-y-auto">
                                <?php if(count($messages) > 0): ?>
                                    <?php foreach($messages as $message): ?>
                                        <div class="mb-4">
                                            <?php if($message['sender_type'] == 'user'): ?>
                                                <div class="flex justify-start">
                                                    <div class="flex items-start">
                                                        <div class="flex-shrink-0 mr-3">
                                                            <?php if($message['sender_avatar']): ?>
                                                                <img class="h-8 w-8 rounded-full object-cover" src="/public/uploads/all/<?= get_image_path($message['sender_avatar']) ?>" alt="User">
                                                            <?php else: ?>
                                                                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                                    <span class="text-blue-600 font-medium"><?= substr($conversation['user_name'] ?? 'U', 0, 1) ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="message-bubble bg-blue-100 p-3 rounded-lg">
                                                            <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($conversation['user_name']) ?> <span class="text-xs font-normal text-gray-500">(User)</span></p>
                                                            <?php if($message['attachment']): ?>
                                                                <div class="mt-2">
                                                                    <?php
                                                                    $file_ext = pathinfo($message['attachment'], PATHINFO_EXTENSION);
                                                                    $image_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                                    $video_extensions = ['mp4', 'webm', 'ogg'];
                                                                    
                                                                    if(in_array(strtolower($file_ext), $image_extensions)):
                                                                    ?>
                                                                        <img src="/public/uploads/all/<?= $message['attachment'] ?>" alt="Attachment" class="rounded-md">
                                                                    <?php elseif(in_array(strtolower($file_ext), $video_extensions)): ?>
                                                                        <video controls class="rounded-md">
                                                                            <source src="/public/uploads/all/<?= $message['attachment'] ?>" type="video/<?= $file_ext ?>">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    <?php else: ?>
                                                                        <a href="/public/uploads/all/<?= $message['attachment'] ?>" target="_blank" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                                            <i class="fas fa-file mr-2"></i> Download Attachment
                                                                        </a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <p class="text-gray-700 mt-1"><?= nl2br(htmlspecialchars($message['message'])) ?></p>
                                                            <p class="message-time text-gray-500 mt-1"><?= formatMessageDate($message['created_at']) ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="flex justify-end">
                                                    <div class="flex items-start">
                                                        <div class="message-bubble bg-green-100 p-3 rounded-lg text-right">
                                                            <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($conversation['seller_name']) ?> <span class="text-xs font-normal text-gray-500">(Seller)</span></p>
                                                            <?php if($message['attachment']): ?>
                                                                <div class="mt-2">
                                                                    <?php
                                                                    $file_ext = pathinfo($message['attachment'], PATHINFO_EXTENSION);
                                                                    $image_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                                    $video_extensions = ['mp4', 'webm', 'ogg'];
                                                                    
                                                                    if(in_array(strtolower($file_ext), $image_extensions)):
                                                                    ?>
                                                                        <img src="/public/uploads/all/<?= $message['attachment'] ?>" alt="Attachment" class="rounded-md">
                                                                    <?php elseif(in_array(strtolower($file_ext), $video_extensions)): ?>
                                                                        <video controls class="rounded-md">
                                                                            <source src="/public/uploads/all/<?= $message['attachment'] ?>" type="video/<?= $file_ext ?>">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    <?php else: ?>
                                                                        <a href="/public/uploads/all/<?= $message['attachment'] ?>" target="_blank" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                                            <i class="fas fa-file mr-2"></i> Download Attachment
                                                                        </a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <p class="text-gray-700 mt-1"><?= nl2br(htmlspecialchars($message['message'])) ?></p>
                                                            <p class="message-time text-gray-500 mt-1"><?= formatMessageDate($message['created_at']) ?></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ml-3">
                                                            <?php if($message['sender_avatar']): ?>
                                                                <img class="h-8 w-8 rounded-full object-cover" src="/public/uploads/all/<?= get_image_path($message['sender_avatar']) ?>" alt="Seller">
                                                            <?php else: ?>
                                                                <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                                                    <span class="text-green-600 font-medium"><?= substr($conversation['seller_name'] ?? 'S', 0, 1) ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-10">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No messages found</h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            This conversation doesn't have any messages yet.
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex justify-between">
                            <a href="index.php" class="btn btn-soft-secondary rounded-md">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Conversations
                            </a>
                        </div>
                    </div>
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; Gmarket Vietnam</p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle the export functionality -->
    <script>
        function exportConversation() {
            const conversationId = <?= $conversation_id ?>;
            const userId = <?= $conversation['user_id'] ?>;
            const sellerId = <?= $conversation['seller_id'] ?>;
            const userName = "<?= addslashes($conversation['user_name']) ?>";
            const sellerName = "<?= addslashes($conversation['seller_name']) ?>";
            const shopName = "<?= addslashes($conversation['shop_name']) ?>";

            // Create a formatted text file with the conversation
            let exportContent = `Conversation between User: ${userName} (ID: ${userId}) and Seller: ${sellerName} (${shopName}) (ID: ${sellerId})\n`;
            exportContent += `Exported on: ${new Date().toLocaleString()}\n`;
            exportContent += `----------------------------------------------------------\n\n`;

            <?php if(count($messages) > 0): ?>
                <?php foreach($messages as $message): ?>
                    <?php
                    $sender_name = $message['sender_type'] == 'user' ? $conversation['user_name'] : $conversation['seller_name'] . ' (' . $conversation['shop_name'] . ')';
                    $formatted_date = date('M d, Y h:i A', strtotime($message['created_at']));
                    $message_content = $message['message'];
                    $has_attachment = !empty($message['attachment']);
                    ?>
                    
                    exportContent += `[${<?= json_encode($formatted_date) ?>}] <?= addslashes($sender_name) ?> (<?= $message['sender_type'] ?>):\n`;
                    exportContent += `${<?= json_encode($message_content) ?>}\n`;
                    <?php if($has_attachment): ?>
                    exportContent += `[Attachment: <?= addslashes($message['attachment']) ?>]\n`;
                    <?php endif; ?>
                    exportContent += `\n`;
                <?php endforeach; ?>
            <?php else: ?>
                exportContent += `No messages in this conversation.\n`;
            <?php endif; ?>

            // Create a blob and download the file
            const blob = new Blob([exportContent], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `conversation_${conversationId}_export.txt`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }
    </script>
</body>
</html>
