<?php
/**
 * Chat authentication helper
 * For generating authentication tokens for the chat system
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Get authenticated chat user details
 * Returns user ID, type, and name if authenticated, false otherwise
 */
function get_chat_user() {
    global $isLogin, $isAdmin, $isSeller;
    
    if (!$isLogin) {
        return false;
    }
    
    if ($isSeller) {
        // User is a seller
        global $seller_id, $seller_full_name;
        return [
            'id' => $seller_id,
            'type' => 'seller',
            'name' => $seller_full_name ?? ''
        ];
    } else {
        // User is regular user
        global $user_id, $user_name;
        
        $type = $isAdmin ? 'admin' : 'user';
        return [
            'id' => $user_id,
            'type' => $type,
            'name' => $user_name ?? ''
        ];
    }
}

/**
 * Generate chat meta tags for the HTML head
 */
function get_chat_meta_tags() {
    $user = get_chat_user();
    
    if (!$user) {
        return '<!-- User not authenticated for chat -->';
    }
    
    // Generate meta tags without CSRF token
    return <<<HTML
    <meta name="user-id" content="{$user['id']}">
    <meta name="user-type" content="{$user['type']}">
    <meta name="user-name" content="{$user['name']}">
HTML;
}

/**
 * Add chat markup to the page and check if user is logged in
 * Returns object with isLoggedIn status and markup for chat button
 */
function get_chat_button_for_seller($seller_id, $seller_name) {
    $user = get_chat_user();
    
    if (!$user) {
        // Not logged in - return login button
        $current_url = urlencode($_SERVER['REQUEST_URI']);
        return [
            'isLoggedIn' => false,
            'markup' => <<<HTML
            <a href="/users/login.php?redirect={$current_url}" class="flex-1 py-2 border border-gray-300 rounded text-center hover:bg-gray-50 text-gray-700 text-sm">
                <i class="far fa-comment-dots mr-1"></i> Login to Chat
            </a>
HTML
        ];
    }
    
    // Logged in - return chat button
    return [
        'isLoggedIn' => true,
        'markup' => <<<HTML
        <button class="shop-chat-button flex-1 py-2 border border-gray-300 rounded text-center hover:bg-gray-50 text-gray-700 text-sm"
            data-seller-id="{$seller_id}" 
            data-seller-name="{$seller_name}">
            <i class="far fa-comment-dots mr-1"></i> Chat Now
        </button>
HTML
    ];
}
?>
