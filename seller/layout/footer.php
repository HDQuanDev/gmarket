<!-- Seller Chat Scripts -->
<?php if (isset($seller_id)): ?>
<meta name="user-id" content="<?= $seller_id ?>">
<meta name="user-type" content="seller">
<meta name="user-name" content="<?= htmlspecialchars($seller_full_name ?? '') ?>">

<!-- Make sure these scripts load at the end of the body for best performance -->
<script src="https://cdn.socket.io/4.4.1/socket.io.min.js"></script>
<script src="/public/assets/js/seller-chat-socket.js"></script>
<script src="/public/assets/js/seller-chat-api.js"></script>
<script src="/public/assets/js/seller-chat-ui.js"></script>
<script src="/public/assets/js/seller-chat.js"></script>

<!-- Add script to update unread count in the sidebar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update the sidebar chat badge when unread count changes
        if (typeof window.sellerChat !== 'undefined' && window.sellerChat) {
            // Check every second if sellerChat is initialized
            const checkInterval = setInterval(function() {
                if (window.sellerChat && window.sellerChat.UI) {
                    clearInterval(checkInterval);
                    
                    // Store original updateUnreadCount method
                    const originalUpdateUnreadCount = window.sellerChat.UI.updateUnreadCount;
                    
                    // Override the updateUnreadCount method
                    window.sellerChat.UI.updateUnreadCount = function(count) {
                        // Call original method
                        originalUpdateUnreadCount.call(window.sellerChat.UI, count);
                        
                        // Update sidebar badge
                        const sidebarBadge = document.getElementById('sidebar-chat-badge');
                        if (sidebarBadge) {
                            if (count > 0) {
                                sidebarBadge.textContent = count;
                                sidebarBadge.classList.remove('d-none');
                            } else {
                                sidebarBadge.classList.add('d-none');
                            }
                        }
                    };
                }
            }, 1000);
        }
    });
</script>
<?php endif; ?>
