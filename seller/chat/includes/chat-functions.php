<?php
/**
 * Helper functions for the chat interface
 */

/**
 * Format time for display in chat
 * 
 * @param string $timestamp The timestamp to format
 * @return string Formatted time string
 */
function format_chat_time($timestamp) {
    $date = new DateTime($timestamp);
    $now = new DateTime();
    $diff = $date->diff($now);
    
    // Today
    if ($date->format('Y-m-d') == $now->format('Y-m-d')) {
        return $date->format('H:i');
    }
    
    // Yesterday
    $yesterday = new DateTime('yesterday');
    if ($date->format('Y-m-d') == $yesterday->format('Y-m-d')) {
        return 'Hôm qua ' . $date->format('H:i');
    }
    
    // This week
    if ($diff->days < 7) {
        $days = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        return $days[$date->format('w')] . ' ' . $date->format('H:i');
    }
    
    // This year
    if ($date->format('Y') == $now->format('Y')) {
        return $date->format('d/m H:i');
    }
    
    // Older
    return $date->format('d/m/Y H:i');
}

/**
 * Generate avatar from name
 * 
 * @param string $name User name
 * @return string First letter of name
 */
function get_avatar_letter($name) {
    if (empty($name)) return 'U';
    $name = trim($name);
    $firstLetter = mb_substr($name, 0, 1, 'UTF-8');
    return mb_strtoupper($firstLetter, 'UTF-8');
}

/**
 * Count unread messages for a seller
 * 
 * @param array $conversations List of conversations
 * @return int Number of unread messages
 */
function count_unread_messages($conversations) {
    $count = 0;
    if (!empty($conversations)) {
        foreach ($conversations as $conversation) {
            $count += (int)($conversation['unread_count'] ?? 0);
        }
    }
    return $count;
}

/**
 * Sanitize message text for display
 * 
 * @param string $text Message text
 * @return string Sanitized text
 */
function sanitize_message($text) {
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    // Convert URLs to clickable links
    $text = preg_replace('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank" class="text-blue-500 underline">$1</a>', $text);
    // Convert line breaks to <br>
    $text = nl2br($text);
    return $text;
}
