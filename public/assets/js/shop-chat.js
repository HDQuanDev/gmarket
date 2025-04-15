/**
 * ShopChat - A real-time chat system for GMarket e-commerce platform
 * This class handles communication with both WebSocket server and REST API.
 */
class ShopChat {
    constructor(options = {}) {
        this.userId = options.userId || null;
        this.userName = options.userName || 'User';
        this.userType = options.userType || (options.isSeller ? 'seller' : 'user');
        this.socketUrl = options.socketUrl || 'https://chat.takashimayavn.com';
        this.apiUrl = options.apiUrl || '/api/chat.php';
        
        // State variables
        this.socket = null;
        this.connected = false;
        this.conversations = [];
        this.currentConversation = null;
        this.isTyping = false;
        this.typingTimeout = null;
        this.chatContainer = null;
        this.isMinimized = true;
        this.unreadCount = 0;
        this.UI = null;
        this.pendingMessage = null;
        
        // Initialize if user is logged in
        if (this.userId) {
            this._initialize();
        }
    }
    
    /**
     * Initialize the chat system
     */
    _initialize() {
        // Initialize UI
        this.UI = new ShopChatUI(this);
        this.UI.initializeUI();
        
        // Initialize WebSocket connection
        this._initializeSocket();
        
        // Load user conversations
        this._loadConversations();
        
        // Set up chat buttons
        this._setupChatButtons();
    }

    /**
     * Set up shop chat buttons throughout the site
     */
    _setupChatButtons() {
        document.querySelectorAll('.shop-chat-button').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                
                const sellerId = button.dataset.sellerId;
                const sellerName = button.dataset.sellerName;
                
                if (sellerId) {
                    this.openChatWithSeller(sellerId, sellerName);
                }
            });
        });
    }
    
    /**
     * Initialize connection to the WebSocket server
     */
    _initializeSocket() {
        try {
            // Connect to Socket.io server with better error logging
            console.log('Attempting to connect to Socket.IO server at:', this.socketUrl);
            this.socket = io(this.socketUrl, {
                reconnectionAttempts: 5,
                timeout: 10000,
                transports: ['websocket', 'polling']
            });
            
            // Connection events
            this.socket.on('connect', () => {
                console.log('Chat socket connected with ID:', this.socket.id);
                this.connected = true;
                
                // Ensure userType is normalized when authenticating
                const normalizedUserType = this.userType.toLowerCase().trim() === 'seller' ? 'seller' : 'user';
                
                // Authenticate with the server based on user type
                const authData = normalizedUserType === 'seller' 
                    ? { type: 'seller', sellerId: this.userId }
                    : { type: 'user', userId: this.userId };
                
                console.log('Authenticating with socket server:', authData);
                this.socket.emit('authenticate', authData);
                
                // Update UI to show connected status
                this.UI.updateConnectionStatus(true);
            });
            
            this.socket.on('connect_error', (err) => {
                console.error('Socket connection error:', err);
                this.UI.showError('Connection to chat server failed. Messages will be sent via API.');
            });
            
            this.socket.on('disconnect', () => {
                console.log('Chat socket disconnected');
                this.connected = false;
                this.UI.updateConnectionStatus(false);
            });
            
            // Chat events with improved error handling
            this.socket.on('new_message', (data) => {
                console.log('Received new message:', data);
                this._handleNewMessage(data);
            });
            
            this.socket.on('message_sent', (data) => {
                console.log('Message sent confirmation received:', data);
                
                // Find any pending message with this conversation ID and mark it as sent
                if (this.pendingMessage && 
                    this.pendingMessage.data.conversation_id === data.conversation_id) {
                    
                    // Update UI to show message was sent successfully
                    this.UI.updateMessageStatus(this.pendingMessage.tempId, 'sent', data.id);
                    
                    // Clear the pending message since it's now confirmed
                    this.pendingMessage = null;
                } else {
                    // Try to find by conversation ID only if tempId is not matched
                    const messagesContainer = document.getElementById('conversation-messages');
                    if (messagesContainer) {
                        const tempMessages = messagesContainer.querySelectorAll('.message-status[data-message-id^="temp_"]');
                        tempMessages.forEach(statusEl => {
                            const tempId = statusEl.getAttribute('data-message-id');
                            this.UI.updateMessageStatus(tempId, 'sent', data.id);
                        });
                    }
                }
            });
            
            this.socket.on('messages_read', (data) => {
                if (this.currentConversation && 
                    data.conversation_id === this.currentConversation.conversation_id) {
                    this.UI.markMessagesAsRead();
                }
            });
            
            this.socket.on('typing_indicator', (data) => {
                if (this.currentConversation && 
                    data.conversation_id === this.currentConversation.conversation_id) {
                    this.UI.showTypingIndicator(data.typing);
                }
            });
            
            this.socket.on('error', (error) => {
                console.error('Socket server error:', error);
                this.UI.showError(error.message || 'An error occurred with the chat service');
                
                // If we get an error while sending a message, fall back to API
                if (this.pendingMessage) {
                    console.log('Retrying failed message via API:', this.pendingMessage);
                    this._sendMessageViaAPI(this.pendingMessage.data, this.pendingMessage.tempId);
                    this.pendingMessage = null;
                }
            });
        } catch (error) {
            console.error('Failed to initialize socket:', error);
            // Will fallback to AJAX-only mode
        }
    }
    
    /**
     * Load conversations from the API
     */
    _loadConversations() {
        fetch(`${this.apiUrl}?action=get_conversations`, {
            method: 'GET',
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load conversations');
            }
            return response.text().then(text => {
                try {
                    // First try to parse as JSON
                    return JSON.parse(text);
                } catch (e) {
                    // If it's not valid JSON, it might be a PHP error
                    console.error('API returned non-JSON response:', text);
                    throw new Error('Invalid response from server');
                }
            });
        })
        .then(data => {
            if (data.success) {
                this.conversations = data.conversations;
                this.UI.renderConversationsList(this.conversations);
                
                // Update unread count
                this.unreadCount = this.conversations.reduce(
                    (total, conv) => total + parseInt(conv.unread_count || 0), 0
                );
                this.UI.updateUnreadCount(this.unreadCount);
            } else {
                this.UI.showError('Failed to load conversations');
            }
        })
        .catch(error => {
            console.error('Error loading conversations:', error);
            this.UI.showLoadingError();
        });
    }
    
    /**
     * Handle new incoming message
     */
    _handleNewMessage(messageData) {
        // Check if this is a message for the current conversation
        if (this.currentConversation && 
            messageData.conversation_id === this.currentConversation.conversation_id) {
            // Add message to current conversation view
            this.UI.addMessageToConversation(messageData, true); // Changed to true to auto-scroll
            
            // Mark as read if chat is open
            if (!this.isMinimized) {
                this._markMessagesAsRead(messageData.conversation_id);
            } else {
                // Increment unread count
                this.unreadCount++;
                this.UI.updateUnreadCount(this.unreadCount);
                
                // Show notification and play sound
                this.UI.showMessageNotification(messageData);
            }
        } else {
            // Update the conversation in our local data
            const convIndex = this.conversations.findIndex(
                c => c.conversation_id === messageData.conversation_id
            );
            
            if (convIndex >= 0) {
                // Update existing conversation
                this.conversations[convIndex].last_message = messageData.message;
                this.conversations[convIndex].time_display = this.UI._formatTime(messageData.formatted_time);
                this.conversations[convIndex].unread_count = parseInt(this.conversations[convIndex].unread_count || 0) + 1;
                
                // Move this conversation to the top of the list
                const updatedConv = this.conversations.splice(convIndex, 1)[0];
                this.conversations.unshift(updatedConv);
            } else {
                // If conversation not in list, fetch all conversations
                this._loadConversations();
            }
            
            // Update UI with the modified conversations list
            this.UI.renderConversationsList(this.conversations);
            
            // Increment unread count
            this.unreadCount++;
            this.UI.updateUnreadCount(this.unreadCount);
            
            // Show notification and play sound
            this.UI.showMessageNotification(messageData);
        }
    }
    
    /**
     * Mark messages as read in a conversation
     */
    _markMessagesAsRead(conversationId) {
        if (!conversationId) return;
        
        // Send via socket if connected
        if (this.connected && this.socket) {
            this.socket.emit('mark_read', {
                conversationId: conversationId,
                readerType: this.userType,
                readerId: this.userId
            });
        }
        
        // Also send via API for redundancy
        fetch(`${this.apiUrl}?action=mark_read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                conversation_id: conversationId
            }),
            credentials: 'same-origin'
        }).catch(error => {
            console.error('Error marking messages as read:', error);
        });
        
        // Update local unread count
        if (this.currentConversation) {
            const convIndex = this.conversations.findIndex(
                c => c.conversation_id === conversationId
            );
            if (convIndex >= 0) {
                const unreadBefore = parseInt(this.conversations[convIndex].unread_count || 0);
                this.conversations[convIndex].unread_count = 0;
                this.unreadCount = Math.max(0, this.unreadCount - unreadBefore);
                this.UI.updateUnreadCount(this.unreadCount);
            }
        }
    }
    
    /**
     * Send typing indicator
     */
    _sendTypingIndicator(isTyping) {
        if (!this.connected || !this.socket || !this.currentConversation) return;
        
        this.socket.emit(isTyping ? 'typing' : 'stop_typing', {
            conversationId: this.currentConversation.conversation_id,
            userType: this.userType,
            userId: this.userId
        });
    }
    
    /**
     * Open a conversation
     */
    openConversation(conversationData) {
        this.currentConversation = conversationData;
        
        // Load messages
        fetch(`${this.apiUrl}?action=get_messages&conversation_id=${conversationData.conversation_id}`, {
            method: 'GET',
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load messages');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update UI with messages
                this.UI.showConversation(conversationData, data.messages);
                
                // Mark messages as read
                this._markMessagesAsRead(conversationData.conversation_id);
            } else {
                this.UI.showError('Failed to load messages');
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            this.UI.showError('Failed to load messages');
        });
    }
    
    /**
     * Send a message with optional attachment
     */
    sendMessage(message, attachment = null) {
        if (!message && !attachment || !this.currentConversation) return;
        
        const messageData = {
            conversation_id: this.currentConversation.conversation_id,
            message: message || ''
        };
        
        // Add message to UI immediately with "sending" status
        const tempId = 'temp_' + Date.now();
        const tempMessage = {
            id: tempId,
            conversation_id: this.currentConversation.conversation_id,
            sender_type: this.userType,
            sender_id: this.userId,
            message: message || '',
            is_read: 0,
            formatted_time: this._formatCurrentTime(),
            is_sender: true,
            status: 'sending'
        };
        
        // Add attachment if present
        if (attachment) {
            tempMessage.attachment = attachment;
        }
        
        this.UI.addMessageToConversation(tempMessage, true);
        
        // If message has an attachment, always send via API
        if (attachment) {
            this._sendMessageWithAttachmentViaAPI(messageData, attachment, tempId);
        }
        // Otherwise try to send via socket if connected
        else if (this.connected && this.socket) {
            // Store pending message for potential fallback
            this.pendingMessage = {
                data: messageData,
                tempId: tempId
            };
            
            // Ensure senderType is exactly 'user' or 'seller'
            const normalizedUserType = this.userType.toLowerCase().trim() === 'seller' ? 'seller' : 'user';
            
            const socketData = {
                conversationId: parseInt(this.currentConversation.conversation_id),
                senderType: normalizedUserType,
                senderId: parseInt(this.userId),
                message: message
            };
            
            console.log('Sending message via socket:', socketData);
            this.socket.emit('send_message', socketData);
            
            // Set a timeout to fall back to API if socket doesn't respond
            setTimeout(() => {
                // Check if this specific message is still pending
                if (this.pendingMessage && this.pendingMessage.tempId === tempId) {
                    console.log('Socket message timeout, falling back to API');
                    this._sendMessageViaAPI(messageData, tempId);
                    this.pendingMessage = null; // Clear to avoid double sends
                }
            }, 5000);
        } else {
            // Fall back to API
            console.log('Socket not connected, using API fallback');
            this._sendMessageViaAPI(messageData, tempId);
        }
        
        // Play sent sound (only when we actually send a message, not when it's confirmed)
        this.UI._playMessageSentSound();
    }
    
    /**
     * Send message with attachment via API
     */
    _sendMessageWithAttachmentViaAPI(messageData, attachment, tempId) {
        // Create form data for file upload
        const formData = new FormData();
        formData.append('conversation_id', messageData.conversation_id);
        formData.append('message', messageData.message);
        formData.append('attachment', attachment);
        
        fetch(`${this.apiUrl}?action=send_message_with_attachment`, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to send message with attachment');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log('Message with attachment sent successfully:', data.message);
                this.UI.updateMessageStatus(tempId, 'sent', data.message.id);
            } else {
                this.UI.updateMessageStatus(tempId, 'failed');
                this.UI.showError('Failed to send message: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error sending message with attachment:', error);
            this.UI.updateMessageStatus(tempId, 'failed');
            this.UI.showError('Failed to send attachment: ' + error.message);
        });
    }
    
    /**
     * Format file size
     */
    _formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    /**
     * Start a new conversation with a seller
     */
    openChatWithSeller(sellerId, sellerName, initialMessage = null) {
        if (!sellerId) return;
        
        // Show the chat window
        this.UI.openChatWindow();
        
        // Check if conversation already exists
        const existingConversation = this.conversations.find(c => c.other_id == sellerId);
        
        if (existingConversation) {
            // Open existing conversation
            this.openConversation(existingConversation);
            return;
        }
        
        // Show loading state in chat window
        this.UI.showLoadingInConversation(`Starting conversation with ${sellerName}...`);
        
        // Start new conversation
        fetch(`${this.apiUrl}?action=start_conversation`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                seller_id: sellerId,
                message: initialMessage
            }),
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to start conversation');
            }
            return response.text().then(text => {
                try {
                    // First try to parse as JSON
                    return JSON.parse(text);
                } catch (e) {
                    // If it's not valid JSON, it might be a PHP error
                    console.error('API returned non-JSON response:', text);
                    throw new Error('Invalid response from server');
                }
            });
        })
        .then(data => {
            if (data.success) {
                // Create new conversation object
                const newConversation = {
                    conversation_id: data.conversation_id,
                    other_id: sellerId,
                    other_name: sellerName,
                    display_name: sellerName,
                    profile_image: '/public/assets/img/avatars/default.jpg',
                    unread_count: 0
                };
                
                // Add to conversations list
                this.conversations.unshift(newConversation);
                
                // Open the new conversation
                this.openConversation(newConversation);
                
                // If there was an initial message, it was already sent through the API
                if (initialMessage) {
                    this._loadConversations(); // Refresh conversations to get the message
                }
            } else {
                this.UI.showError('Failed to start conversation');
            }
        })
        .catch(error => {
            console.error('Error starting conversation:', error);
            this.UI.showError('Failed to start conversation');
        });
    }
    
    /**
     * Format current time to string
     */
    _formatCurrentTime() {
        const now = new Date();
        return now.toISOString().replace('T', ' ').substr(0, 19);
    }
    
    /**
     * Toggle chat window visibility
     */
    toggleChatWindow() {
        this.isMinimized = !this.isMinimized;
        this.UI.toggleChatWindow(this.isMinimized);
        
        // Reset unread count when opening
        if (!this.isMinimized && this.currentConversation) {
            this._markMessagesAsRead(this.currentConversation.conversation_id);
        }
    }
    
    /**
     * Show the conversations list view
     */
    showConversationsList() {
        this.currentConversation = null;
        this.UI.showConversationsList();
    }
}

// Initialize chat system when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // First check if ShopChat is already defined to avoid duplicate declarations
    if (window.ShopChat) {
        console.log('ShopChat already initialized');
        return;
    }
    
    // Load Socket.IO library if not already loaded
    if (!window.io) {
        const socketScript = document.createElement('script');
        socketScript.src = 'https://cdn.socket.io/4.4.1/socket.io.min.js';
        socketScript.integrity = 'sha384-fKnu0iswBIqkjxrhQCTZ7qlLHOFEgNkRmK2vaO/LbTZSXdJfAu6ewRBdwHPhBo/H';
        socketScript.crossOrigin = 'anonymous';
        
        socketScript.onload = loadUIScript;
        document.head.appendChild(socketScript);
    } else {
        loadUIScript();
    }
    
    function loadUIScript() {
        // Only load UI script if not already loaded
        if (!window.ShopChatUI) {
            const uiScript = document.createElement('script');
            uiScript.src = '/public/assets/js/shop-chat-ui.js?v=' + new Date().getTime(); // Add timestamp to avoid caching
            uiScript.onload = function() {
                console.log('Shop Chat scripts loaded');
                initializeChat();
            };
            document.head.appendChild(uiScript);
        } else {
            initializeChat();
        }
    }
    
    function initializeChat() {
        // Get user ID from meta tag
        const userId = document.querySelector('meta[name="user-id"]')?.content;
        const userName = document.querySelector('meta[name="user-name"]')?.content;
        const userType = document.querySelector('meta[name="user-type"]')?.content;
        
        // Initialize chat only if user is logged in
        if (userId) {
            window.shopChat = new ShopChat({
                userId: userId,
                userName: userName,
                userType: userType,
                isSeller: userType === 'seller'
            });
            
            console.log('Chat system initialized');
        } else {
            // Add login redirect to chat buttons if not logged in
            document.querySelectorAll('.shop-chat-button').forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    window.location.href = '/users/login.php?redirect=' + encodeURIComponent(window.location.href);
                });
            });
        }
    }
});
