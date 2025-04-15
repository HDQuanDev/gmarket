/**
 * Chat utility functions
 * Common functions used across other modules
 */

// Format time for display
function formatTime(timeStr) {
    if (!timeStr) return '';
    
    try {
        const date = new Date(timeStr);
        const now = new Date();
        
        // If today, show only time
        if (date.toDateString() === now.toDateString()) {
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
        
        // If yesterday, show "Hôm qua"
        const yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);
        if (date.toDateString() === yesterday.toDateString()) {
            return 'Hôm qua';
        }
        
        // If this year, show date without year
        if (date.getFullYear() === now.getFullYear()) {
            return date.toLocaleDateString([], { month: 'numeric', day: 'numeric' });
        }
        
        // Otherwise, show full date
        return date.toLocaleDateString();
    } catch (e) {
        return timeStr;
    }
}

// Format date for display in message separators
function formatDateDisplay(dateStr) {
    if (!dateStr) return '';
    
    try {
        const date = new Date(dateStr);
        const now = new Date();
        
        // Today
        if (date.toDateString() === now.toDateString()) {
            return 'Hôm nay';
        }
        
        // Yesterday
        const yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - 1);
        if (date.toDateString() === yesterday.toDateString()) {
            return 'Hôm qua';
        }
        
        // In this week
        const daysDiff = Math.round((now - date) / (1000 * 60 * 60 * 24));
        if (daysDiff < 7) {
            const days = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
            return days[date.getDay()];
        }
        
        // Regular date
        return date.toLocaleDateString('vi-VN', { year: 'numeric', month: 'numeric', day: 'numeric' });
    } catch (e) {
        return dateStr;
    }
}

// Escape HTML to prevent XSS attacks
function escapeHTML(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Get status icon for messages
function getStatusIcon(status) {
    switch (status) {
        case 'sending':
            return '<span class="ml-1 inline-block" title="Đang gửi...">⌛</span>';
        case 'sent':
            return '<span class="ml-1 inline-block" title="Đã gửi">✓</span>';
        case 'failed':
            return '<span class="ml-1 text-red-300 inline-block" title="Lỗi">⚠️</span>';
        default:
            return '';
    }
}

// Play notification sound
function playNotificationSound() {
    try {
        const sound = document.getElementById('notification-sound');
        sound.currentTime = 0;
        sound.play().catch(err => console.log('Could not play notification sound'));
    } catch (e) {
        console.log('Error playing notification sound:', e);
    }
}

// Play message sent sound
function playMessageSentSound() {
    try {
        const sound = document.getElementById('message-sent-sound');
        sound.currentTime = 0;
        sound.play().catch(err => console.log('Could not play sent sound'));
    } catch (e) {
        console.log('Error playing sent sound:', e);
    }
}

// Scroll messages container to bottom
function scrollToBottom() {
    const messagesContainer = document.getElementById('messages-container');
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Handle typing indicator
function handleTypingIndicator(isTyping) {
    // Clear previous timeout
    if (window.typingTimeout) {
        clearTimeout(window.typingTimeout);
    }
    
    // Update local state
    if (isTyping !== window.isTyping) {
        window.isTyping = isTyping;
        
        // Send typing status to server
        if (window.chatState.socket && window.chatState.currentConversation) { // Fix: Use window.chatState.socket and window.chatState.currentConversation
            window.chatState.socket.emit('typing', {
                conversation_id: window.chatState.currentConversation.id,
                typing: isTyping
            });
        }
    }
    
    // Set timeout to automatically turn off typing indicator
    if (isTyping) {
        window.typingTimeout = setTimeout(() => {
            window.isTyping = false;
            if (window.chatState.socket && window.chatState.currentConversation) { // Fix: Same here
                window.chatState.socket.emit('typing', {
                    conversation_id: window.chatState.currentConversation.id,
                    typing: false
                });
            }
        }, 5000);
    }
}
