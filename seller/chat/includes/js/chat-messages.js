/**
 * Messages handling
 * Manages messages loading, sending and rendering
 */

// Load messages for a conversation
function loadMessages(conversationId) {
    fetch(`${apiUrl}?action=get_messages&conversation_id=${conversationId}`)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Failed to load messages');
            }
            
            renderMessages(data.messages || []);
            
            // Mark messages as read
            markMessagesAsRead(conversationId);
            
            // Update connection status
            updateConnectionStatus(window.socket?.connected || false);
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            showMessagesError();
        });
}

// Render messages
function renderMessages(messages) {
    const messagesContainer = document.getElementById('messages-container');
    
    if (messages.length === 0) {
        messagesContainer.innerHTML = `
            <div class="flex justify-center items-center h-full">
                <div class="text-center text-gray-500">
                    <p>Chưa có tin nhắn nào</p>
                </div>
            </div>
        `;
        return;
    }
    
    let html = '';
    let previousDate = null;
    
    messages.forEach((msg) => {
        // Add date separator if needed
        const msgDate = new Date(msg.created_at).toLocaleDateString();
        if (previousDate !== msgDate) {
            html += `
                <div class="flex justify-center my-2">
                    <div class="bg-gray-100 text-xs text-gray-500 px-2 py-1 rounded-full">
                        ${formatDateDisplay(msg.created_at)}
                    </div>
                </div>
            `;
            previousDate = msgDate;
        }
        
        const isSeller = msg.sender_type === 'seller' || msg.sender_id === window.sellerId;
        html += createMessageHTML(msg, isSeller);
    });
    
    messagesContainer.innerHTML = html;
    scrollToBottom();
    
    // Add click handlers for image attachments
    document.querySelectorAll('.message-image').forEach(img => {
        img.addEventListener('click', function() {
            openImageViewer(this.src);
        });
    });
}

// Mark messages as read
function markMessagesAsRead(conversationId) {
    if (!conversationId || !window.chatState.socket) return;
    
    // Format the data correctly with all required fields
    const markReadData = {
        conversationId: parseInt(conversationId),
        readerType: 'seller',
        readerId: parseInt(window.chatState.sellerId)
    };
    
    // Emit socket event with correct data format
    window.chatState.socket.emit('mark_read', markReadData);
    
    // Update UI to show messages as read
    document.querySelectorAll('.message.received').forEach(msg => {
        const status = msg.querySelector('.message-status');
        if (status) {
            status.innerHTML = getStatusIcon('read');
        }
    });
    
    // Also update conversation list UI
    const conversationItem = document.querySelector(`.conversation-item[data-id="${conversationId}"]`);
    if (conversationItem) {
        const unreadBadge = conversationItem.querySelector('.bg-red-500');
        if (unreadBadge) {
            unreadBadge.remove();
        }
        conversationItem.classList.remove('bg-yellow-50');
    }
}

// Send a message
function sendMessage(message, attachment = null) {
    if (!window.chatState.currentConversation || (!message.trim() && !attachment)) {
        return;
    }
    
    // Create temporary message
    const tempId = 'temp_' + Date.now();
    const tempMessage = {
        id: tempId,
        sender_type: 'seller',
        sender_id: window.chatState.sellerId, // Fix: Use window.chatState.sellerId instead of sellerId
        message: message,
        created_at: new Date().toISOString(),
        status: 'sending'
    };
    
    if (attachment) {
        tempMessage.attachment_url = URL.createObjectURL(attachment);
    }
    
    // Add to UI
    const html = createMessageHTML(tempMessage, true);
    document.getElementById('messages-container').insertAdjacentHTML('beforeend', html);
    scrollToBottom();
    
    // Play sent sound
    playMessageSentSound();
    
    // Send to server
    sendMessageToServer(window.chatState.currentConversation.id, message, attachment, tempId);
}

// Send message to server
function sendMessageToServer(conversationId, message, attachment, tempId) {
    if (attachment) {
        // Send with attachment
        const formData = new FormData();
        formData.append('conversation_id', conversationId);
        formData.append('message', message);
        formData.append('attachment', attachment);

        fetch(`${apiUrl}?action=send_message_with_attachment`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateMessageStatus(tempId, 'sent', data.message.id);
            } else {
                throw new Error(data.message || 'Failed to send message');
            }
        })
        .catch(error => {
            console.error('Error sending message with attachment:', error);
            updateMessageStatus(tempId, 'failed');
        });
    } else {
        // Try socket first
        if (window.chatState.socket?.connected) {
            // Use the new format function
            const messageData = formatMessageData(conversationId, message, tempId);
            console.log('Sending message:', messageData);
            
            window.chatState.socket.emit('send_message', messageData);

            // Fallback to API after timeout
            setTimeout(() => {
                const messageEl = document.getElementById(`message-${tempId}`);
                if (messageEl?.querySelector('.message-status')?.innerHTML.includes('sending')) {
                    sendViaAPI(conversationId, message, tempId);
                }
            }, 5000);
        } else {
            // No socket connection, use API directly
            sendViaAPI(conversationId, message, tempId);
        }
    }
}

// Send message via API
function sendViaAPI(conversationId, message, tempId) {
    // Use the same message format for API
    const messageData = formatMessageData(conversationId, message);
    
    fetch(`${apiUrl}?action=send_message`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(messageData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateMessageStatus(tempId, 'sent', data.message.id);
        } else {
            throw new Error(data.message || 'Failed to send message');
        }
    })
    .catch(error => {
        console.error('Error sending message via API:', error);
        updateMessageStatus(tempId, 'failed');
    });
}

// Create HTML for a message - Fixed to ensure correct bubble layout
function createMessageHTML(message, isSeller) {
    const messageClass = isSeller ? 'sent' : 'received';
    
    let attachmentHTML = '';
    if (message.attachment_url) {
        attachmentHTML = `
            <div class="mb-2">
                <img src="${message.attachment_url}" alt="Attachment" class="message-image">
            </div>
        `;
    }
    
    return `
        <div class="message ${messageClass}" id="message-${message.id}">
            <div class="flex">
                <div class="message-bubble">
                    ${attachmentHTML}
                    ${message.message ? `<div>${escapeHTML(message.message)}</div>` : ''}
                    <div class="message-time flex items-center">
                        <span class="text-xs opacity-70">${formatTime(message.created_at)}</span>
                        ${isSeller ? `
                            <span class="message-status ml-1" title="${message.status || 'sent'}">
                                ${getStatusIcon(message.status || 'sent')}
                            </span>
                        ` : ''}
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Add these utility functions
function escapeHTML(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function scrollToBottom() {
    const messagesContainer = document.getElementById('messages-container');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}
