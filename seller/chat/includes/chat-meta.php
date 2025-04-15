<?php
/**
 * Meta tags and basic configuration for the chat interface
 */
?>
<!-- Meta tags for chat functionality -->
<meta name="user-id" content="<?= $seller_id ?>">
<meta name="user-type" content="seller">
<meta name="user-name" content="<?= htmlspecialchars($seller_data['full_name'] ?? '') ?>">

<!-- Include Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'chat-blue': '#3b82f6',
                    'chat-blue-light': '#eff6ff',
                    'chat-gray': '#f1f5f9',
                    'chat-gray-dark': '#64748b'
                }
            }
        }
    }
</script>

<!-- Sound notifications -->
<audio id="notification-sound" preload="auto" src="/public/assets/audio/notification.mp3"></audio>
<audio id="message-sent-sound" preload="auto" src="/public/assets/audio/message-sent.mp3"></audio>
