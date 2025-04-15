<?php
require_once(__DIR__ . "/config.php");

// Redirect to login if not logged in
if (!isset($user_id) || $user_id <= 0) {
    header("Location: /users/login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

// Get all conversations for this user
$conversations_query = "SELECT c.*, 
                        s.full_name as seller_name, 
                        s.shop_logo, 
                        MAX(m.created_at) as last_message_time,
                        (SELECT message FROM chat_messages WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) as last_message,
                        (SELECT COUNT(*) FROM chat_messages WHERE conversation_id = c.id AND sender_type = 'seller' AND is_read = 0) as unread_count
                      FROM chat_conversations c
                      JOIN sellers s ON c.seller_id = s.id
                      LEFT JOIN chat_messages m ON m.conversation_id = c.id
                      WHERE c.user_id = $user_id
                      GROUP BY c.id
                      ORDER BY last_message_time DESC";
                      
$conversations_result = mysqli_query($conn, $conversations_query);
$conversations = [];

if ($conversations_result) {
    while ($conversation = mysqli_fetch_assoc($conversations_result)) {
        $conversations[] = $conversation;
    }
}

// If a specific seller is requested, load that conversation
$active_seller_id = null;
$active_seller = null;

if (isset($_GET['seller']) && !empty($_GET['seller'])) {
    $active_seller_id = intval($_GET['seller']);
    
    // Get seller information
    $seller_query = "SELECT id, full_name, shop_logo FROM sellers WHERE id = $active_seller_id";
    $seller_result = mysqli_query($conn, $seller_query);
    
    if ($seller_result && mysqli_num_rows($seller_result) > 0) {
        $active_seller = mysqli_fetch_assoc($seller_result);
    }
}

// Get user information
$user_query = "SELECT full_name, avatar FROM users WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

require_once(__DIR__ . "/layout/header.php");
?>

<!-- Add meta tags for chat functionality -->
<meta name="user-id" content="<?= $user_id ?>">
<meta name="user-name" content="<?= htmlspecialchars($user['full_name'] ?? '') ?>">
<meta name="csrf-token" content="<?= isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '' ?>">

<!-- Include the shop-chat.js script -->
<script src="/public/assets/js/shop-chat.js"></script>

<div class="container mx-auto py-6 px-4">
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="md:flex">
            <!-- Conversations List -->
            <div class="md:w-1/3 border-r">
                <div class="p-4 border-b">
                    <h2 class="font-medium text-lg">Messages</h2>
                </div>
                
                <div class="overflow-y-auto h-[calc(100vh-200px)]">
                    <?php if (empty($conversations)): ?>
                        <div class="p-6 text-center text-gray-500">
                            <div class="text-5xl mb-3">
                                <i class="far fa-comments"></i>
                            </div>
                            <p>You don't have any conversations yet.</p>
                            <p class="mt-2 text-sm">Start by contacting a seller from a product page.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($conversations as $conversation): ?>
                            <a href="?seller=<?= $conversation['seller_id'] ?>" class="block p-4 border-b hover:bg-gray-50 <?= $active_seller_id == $conversation['seller_id'] ? 'bg-gray-50' : '' ?>">
                                <div class="flex">
                                    <div class="relative">
                                        <div class="w-12 h-12 rounded-full border overflow-hidden">
                                            <img src="<?= !empty($conversation['shop_logo']) ? '/public/uploads/' . $conversation['shop_logo'] : '/public/assets/img/placeholder.jpg' ?>" alt="<?= htmlspecialchars($conversation['seller_name']) ?>" class="w-full h-full object-cover">
                                        </div>
                                        <?php if ($conversation['unread_count'] > 0): ?>
                                            <div class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                                <?= $conversation['unread_count'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <div class="flex justify-between">
                                            <h3 class="font-medium"><?= htmlspecialchars($conversation['seller_name']) ?></h3>
                                            <span class="text-xs text-gray-500"><?= date('h:i A', strtotime($conversation['last_message_time'])) ?></span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate"><?= htmlspecialchars($conversation['last_message']) ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Chat Area -->
            <div class="md:w-2/3">
                <?php if ($active_seller): ?>
                    <div class="p-4 border-b flex items-center">
                        <div class="w-10 h-10 rounded-full border overflow-hidden">
                            <img src="<?= !empty($active_seller['shop_logo']) ? '/public/uploads/' . $active_seller['shop_logo'] : '/public/assets/img/placeholder.jpg' ?>" alt="<?= htmlspecialchars($active_seller['full_name']) ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="ml-3">
                            <h3 class="font-medium"><?= htmlspecialchars($active_seller['full_name']) ?></h3>
                            <div id="shop-status" class="text-xs text-green-600">Online</div>
                        </div>
                    </div>
                    
                    <!-- Chat container - will be populated by shop-chat.js -->
                    <div id="chat-container" class="h-[calc(100vh-250px)] flex flex-col">
                        <div id="chat-loading" class="flex-1 flex items-center justify-center">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-shopee-orange mx-auto"></div>
                                <p class="mt-3 text-gray-500">Loading messages...</p>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Initialize chat with this seller when page loads
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(() => {
                                if (window.shopChat) {
                                    window.shopChat.openChatWithSeller(
                                        <?= $active_seller_id ?>, 
                                        "<?= addslashes(htmlspecialchars($active_seller['full_name'])) ?>"
                                    );
                                }
                            }, 500);
                        });
                    </script>
                <?php else: ?>
                    <div class="h-[calc(100vh-200px)] flex items-center justify-center">
                        <div class="text-center p-6">
                            <div class="text-5xl mb-3 text-gray-300">
                                <i class="far fa-comment-dots"></i>
                            </div>
                            <h3 class="font-medium text-lg mb-2">No Conversation Selected</h3>
                            <p class="text-gray-500">Select a conversation from the list or start a new one from a product page.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . "/layout/footer.php"); ?>
