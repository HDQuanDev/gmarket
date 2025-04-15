<?php
/**
 * JavaScript for chat functionality
 */
?>
<!-- Include Socket.IO -->
<script src="https://cdn.socket.io/4.4.1/socket.io.min.js"></script>

<!-- Define global variables and handlers first -->
<script>
// Global API endpoint
const apiUrl = '/api/chat.php';

// Message handlers
function handleNewMessage(message) {
    console.log('New message received:', message);
    
    // DEBUG: Log important state info
    console.log('Current conversation:', window.chatState.currentConversation);
    console.log('Message conversation ID:', message.conversation_id);
    
    // Kiểm tra xem đang ở trong cuộc hội thoại của tin nhắn mới không
    if (window.chatState.currentConversation && 
        (message.conversation_id == window.chatState.currentConversation.id || 
         message.conversation_id == window.chatState.currentConversation.conversation_id)) {
        
        console.log('Message belongs to current conversation - adding to chat');
        
        // FIXED: Correctly determine if message is from seller based on sender_type
        const isSeller = (message.sender_type === 'seller');
        
        console.log('Message from seller?', isSeller, 
                   'sender_type:', message.sender_type,
                   'sender_id:', message.sender_id, 
                   'Current seller ID:', window.chatState.sellerId);
        
        // Modified message HTML structure for correct layout
        const messageHtml = `
            <div class="message ${isSeller ? 'sent' : 'received'}" id="message-${message.id}">
                <div class="flex">
                    <div class="message-bubble ${isSeller ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800'}">
                        ${message.attachment_url ? `
                            <div class="mb-2">
                                <img src="${message.attachment_url}" alt="Attachment" class="max-w-[200px] rounded">
                            </div>
                        ` : ''}
                        ${message.message ? `<div>${escapeHTML(message.message)}</div>` : ''}
                        <div class="flex justify-end text-xs opacity-75 mt-1">
                            ${formatTime(message.created_at)}
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add message to container and scroll down
        const messagesContainer = document.getElementById('messages-container');
        messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        // Mark as read if from other person
        if (!isSeller) {
            markMessagesAsRead(message.conversation_id);
            // Play notification sound
            playNotificationSound();
        }
        
        // Update conversation in list
        updateConversationInList(message);
    } else {
        console.log('Message for another conversation - updating list only');
        // Update list only
        updateConversationInList(message);
        playNotificationSound();
        
        // Update badge
        const badge = document.getElementById('unread-count-badge');
        if (badge) {
            const count = parseInt(badge.textContent || '0') + 1;
            badge.textContent = count;
            badge.classList.remove('hidden');
        }
    }
}

// Thêm hàm mới để chỉ cập nhật 1 cuộc hội thoại trong danh sách
function updateConversationInList(message) {
    // Tìm cuộc hội thoại tương ứng trong danh sách
    const conversations = window.conversations || [];
    const conversationId = message.conversation_id;
    
    // Tìm conversation item trong DOM
    const conversationItem = document.querySelector(`.conversation-item[data-id="${conversationId}"]`);
    
    if (conversationItem) {
        // Cập nhật tin nhắn mới nhất
        const lastMessageEl = conversationItem.querySelector('p.text-sm.text-gray-600');
        if (lastMessageEl) {
            lastMessageEl.textContent = message.message || 'Đã gửi một hình ảnh';
        }
        
        // Cập nhật thời gian
        const timeEl = conversationItem.querySelector('.text-xs.text-gray-500');
        if (timeEl) {
            timeEl.textContent = formatTime(message.created_at || new Date().toISOString());
        }
        
        // Thêm badge số tin nhắn chưa đọc nếu không phải tin nhắn của mình
        const isSeller = message.sender_type === 'seller';
        if (!isSeller) {
            // Nếu không phải đang xem cuộc hội thoại này
            if (!window.chatState.currentConversation || 
                (window.chatState.currentConversation.id != conversationId && 
                 window.chatState.currentConversation.conversation_id != conversationId)) {
                // Thêm highlight cho cuộc hội thoại có tin nhắn mới
                conversationItem.classList.add('bg-yellow-50');
                
                // Tìm hoặc tạo badge
                let badgeEl = conversationItem.querySelector('.bg-red-500');
                if (!badgeEl) {
                    badgeEl = document.createElement('div');
                    badgeEl.className = 'ml-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs';
                    badgeEl.textContent = '1';
                    
                    // Thêm vào cuối div.flex-1
                    const containerEl = conversationItem.querySelector('.flex-1').nextElementSibling;
                    if (containerEl) {
                        containerEl.appendChild(badgeEl);
                    } else {
                        const flexContainer = conversationItem.querySelector('.flex');
                        if (flexContainer) {
                            flexContainer.appendChild(badgeEl);
                        }
                    }
                } else {
                    // Tăng số lượng tin nhắn chưa đọc
                    badgeEl.textContent = (parseInt(badgeEl.textContent) || 0) + 1;
                }
            }
        }
        
        // Di chuyển cuộc trò chuyện này lên đầu danh sách
        const conversationsList = document.getElementById('conversations-list');
        if (conversationsList && conversationsList.firstChild) {
            conversationsList.insertBefore(conversationItem, conversationsList.firstChild);
        }
    } else {
        // Nếu không tìm thấy trong DOM, cần tải lại danh sách
        loadConversations();
    }
    
    // Cập nhật lại dữ liệu cuộc hội thoại trong bộ nhớ
    const conversationIndex = conversations.findIndex(conv => 
        conv.conversation_id == conversationId || conv.id == conversationId);
    
    if (conversationIndex >= 0) {
        // Cập nhật thông tin cuộc hội thoại
        conversations[conversationIndex].last_message = message.message || 'Đã gửi một hình ảnh';
        conversations[conversationIndex].updated_at = message.created_at;
        
        // Tăng số tin nhắn chưa đọc nếu không phải tin nhắn của mình và không đang xem
        const isSeller = message.sender_type === 'seller';
        const isViewingConversation = window.chatState.currentConversation && 
            (window.chatState.currentConversation.id == conversationId || 
             window.chatState.currentConversation.conversation_id == conversationId);
        
        if (!isSeller && !isViewingConversation) {
            conversations[conversationIndex].unread_count = 
                (parseInt(conversations[conversationIndex].unread_count) || 0) + 1;
        }
        
        // Sắp xếp lại danh sách cuộc hội thoại theo thời gian cập nhật
        conversations.sort((a, b) => {
            const timeA = new Date(a.updated_at || a.created_at || '').getTime();
            const timeB = new Date(b.updated_at || b.created_at || '').getTime();
            return timeB - timeA; // Sắp xếp giảm dần (mới nhất đầu tiên)
        });
        
        // Lưu lại danh sách đã cập nhật
        window.conversations = conversations;
    }
}

function handleMessageSent(data) {
    console.log('Message sent confirmation:', data);
    updateMessageStatus(data.tempId || data.id, 'sent', data.id);
}

// Add updateMessageStatus function
function updateMessageStatus(messageId, status, newId = null) {
    const messageElement = document.getElementById(`message-${messageId}`);
    const statusEl = messageElement ? messageElement.querySelector('.message-status') : null;
    
    if (!messageElement || !statusEl) return;
    
    if (status === 'sent') {
        statusEl.innerHTML = '<span title="Đã gửi">✓</span>';
        statusEl.classList.remove('text-red-500');
        
        // Update message ID if new one provided
        if (newId && messageId !== newId) {
            messageElement.id = `message-${newId}`;
        }
    } else if (status === 'failed') {
        statusEl.innerHTML = '<span title="Lỗi gửi">⚠️</span>';
        statusEl.classList.add('text-red-500');
        
        // Add retry button
        if (!messageElement.querySelector('.retry-button')) {
            const messageText = messageElement.querySelector('.message-bubble')?.textContent;
            if (messageText) {
                const retryBtn = document.createElement('button');
                retryBtn.className = 'retry-button text-xs text-red-400 hover:text-red-600 ml-2';
                retryBtn.textContent = 'Thử lại';
                retryBtn.onclick = (e) => {
                    e.preventDefault();
                    messageElement.remove();
                    sendMessage(messageText);
                };
                statusEl.appendChild(retryBtn);
            }
        }
    }
}

// Add this new function to format message data
function formatMessageData(conversationId, message, tempId = null) {
    return {
        conversationId: parseInt(conversationId), // Make sure it's a number
        senderType: 'seller',
        senderId: parseInt(window.chatState.sellerId), // Make sure it's a number 
        message: message || '',
        tempId: tempId // Use tempId instead of temp_id
    };
}

function handleTypingEvent(data) {
    console.log('Typing event:', data);
    const typingIndicator = document.getElementById('typing-indicator');
    if (window.chatState.currentConversation && 
        data.conversation_id === window.chatState.currentConversation.id) {
        typingIndicator.classList.toggle('hidden', !data.typing);
    }
}

function handleMessagesRead(data) {
    console.log('Messages read:', data);
    if (window.chatState.currentConversation && 
        data.conversation_id === window.chatState.currentConversation.id) {
        const messages = document.querySelectorAll('.message.sent');
        messages.forEach(msg => {
            const status = msg.querySelector('.message-status');
            if (status) {
                status.innerHTML = getStatusIcon('read');
            }
        });
    }
}

// Add typing handler
function handleTyping(event) {
    if (window.chatState.currentConversation) {
        const isTyping = event.target.value.trim().length > 0;
        
        // Clear existing timeout
        if (window.chatState.typingTimeout) {
            clearTimeout(window.chatState.typingTimeout);
        }
        
        // Set new timeout
        window.chatState.typingTimeout = setTimeout(() => {
            if (window.chatState.socket) {
                window.chatState.socket.emit('typing', {
                    conversation_id: window.chatState.currentConversation.id,
                    typing: false
                });
            }
        }, 3000);
        
        // Emit typing event
        if (window.chatState.socket) {
            window.chatState.socket.emit('typing', {
                conversation_id: window.chatState.currentConversation.id,
                typing: isTyping
            });
        }
    }
}

// Expose seller ID globally
window.sellerId = "<?= $seller_id ?>";
</script>

<!-- Include our modular JavaScript files -->
<script src="includes/js/chat-utils.js?v=1"></script>
<script src="includes/js/chat-connection.js?v=1"></script>
<script src="includes/js/chat-conversations.js?v=1"></script>
<script src="includes/js/chat-messages.js?v=1"></script>
<script src="includes/js/chat-ui.js?v=1"></script>

<!-- Initialize chat -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get seller information
    const sellerId = document.querySelector('meta[name="user-id"]')?.content;
    const sellerName = document.querySelector('meta[name="user-name"]')?.content;

    if (!sellerId) {
        console.error('Seller ID not found');
        return;
    }

    // Initialize state
    window.chatState = {
        sellerId: sellerId,
        sellerName: sellerName,
        socket: null,
        currentConversation: null,
        conversations: [],
        unreadCount: 0,
        isTyping: false,
        typingTimeout: null,
        selectedAttachment: null
    };

    // Initialize socket connection with authentication
    try {
        window.chatState.socket = io('https://chat.takashimayavn.com');
        window.chatState.socket.on('connect', () => {
            console.log('Connected to chat server');
            
            // Authenticate immediately after connection
            window.chatState.socket.emit('authenticate', { 
                type: 'seller',
                sellerId: sellerId,
                name: sellerName
            });
        });
        
        // Listen for authentication success
        window.chatState.socket.on('auth_success', (data) => {
            console.log('Authentication successful');
            updateConnectionStatus(true);
            
            // Only after successful authentication, join seller's room
            window.chatState.socket.emit('join', { 
                userId: sellerId,
                userType: 'seller' 
            });
        });

        window.chatState.socket.on('auth_error', (error) => {
            console.error('Authentication failed:', error);
            updateConnectionStatus(false);
        });
        
        window.chatState.socket.on('disconnect', () => {
            console.log('Disconnected from chat server');
            updateConnectionStatus(false);
        });

        // Register chat events
        setupSocketEvents();
        
    } catch (error) {
        console.error('Socket connection error:', error);
    }

    // Load initial conversations
    loadConversations();
    
    // Setup UI event listeners
    setupEventListeners();
});

// Event listeners setup
function setupEventListeners() {
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const attachmentButton = document.getElementById('attachment-btn');
    const attachmentInput = document.getElementById('attachment-input');

    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = messageInput.value.trim();
            if (message || window.chatState.selectedAttachment) {
                sendMessage(message, window.chatState.selectedAttachment);
                messageInput.value = '';
                clearAttachmentPreview();
            }
        });
    }

    if (attachmentButton && attachmentInput) {
        attachmentButton.addEventListener('click', () => {
            attachmentInput.click();
        });

        attachmentInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                showAttachmentPreview(this.files[0]);
            }
        });
    }

    if (messageInput) {
        messageInput.addEventListener('input', handleTyping);
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                messageForm.dispatchEvent(new Event('submit'));
            }
        });
    }
}

// Socket events setup
function setupSocketEvents() {
    if (!window.chatState.socket) return;
    
    const socket = window.chatState.socket;
    
    socket.on('new_message', handleNewMessage);
    socket.on('message_sent', handleMessageSent);
    socket.on('typing', handleTypingEvent);
    socket.on('message_read', handleMessagesRead);
    
    // Add error handler
    socket.on('error', function(error) {
        console.error('Socket error:', error);
        // If there's a temp_id in the error, mark that message as failed
        if (error.tempId) {
            updateMessageStatus(error.tempId, 'failed');
        }
    });
}
</script>
