/**
 * ShopChatUI - UI component for ShopChat
 * Handles all UI rendering and interactions
 */
class ShopChatUI {
    constructor(shopChat) {
        this.shopChat = shopChat;
        this.chatContainer = null;
        this.chatLauncher = null;
    }
    
    /**
     * Initialize UI components
     */
    initializeUI() {
        this._createChatUI();
        this._setupEventListeners();
    }
    
    /**
     * Create the chat UI elements
     */
    _createChatUI() {
        // Create chat container if it doesn't exist
        if (document.getElementById('shop-chat-container')) {
            return;
        }
        
        const chatHTML = `
            <div id="shop-chat-container" class="hidden fixed bottom-4 right-4 z-50 flex flex-col shadow-xl rounded-lg w-96 transition-all duration-300">
                <!-- Chat Header -->
                <div id="shop-chat-header" class="bg-shopee-orange text-white p-3 rounded-t-lg flex justify-between items-center cursor-pointer">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="chat-header-title" class="font-medium">Chat</span>
                        <span id="chat-unread-count" class="ml-2 bg-white text-shopee-orange rounded-full text-xs px-2 py-0.5 hidden">0</span>
                    </div>
                    <div class="flex items-center">
                        <button id="shop-chat-minimize" class="focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Chat Body -->
                <div id="shop-chat-body" class="bg-white flex flex-col h-[500px]">
                    <!-- Conversations List -->
                    <div id="shop-chat-conversations" class="flex-1 overflow-y-auto p-2">
                        <div id="chat-loading" class="flex items-center justify-center h-full text-gray-500">
                            <svg class="animate-spin h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Loading conversations...</span>
                        </div>
                        <div id="chat-no-conversations" class="hidden flex flex-col items-center justify-center h-full text-gray-500 py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm">No conversations yet</p>
                            <p class="text-xs mt-1">Start chatting with a shop!</p>
                        </div>
                        <div id="chat-conversation-list" class="hidden"></div>
                    </div>
                    
                    <!-- Single Conversation View -->
                    <div id="shop-chat-conversation" class="hidden flex flex-col h-full">
                        <!-- Conversation Header -->
                        <div class="border-b p-3 flex items-center">
                            <button id="back-to-conversations" class="mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden mr-2" id="conversation-avatar">
                                <img id="conversation-avatar-img" src="" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 truncate">
                                <div id="conversation-name" class="font-medium truncate"></div>
                                <div id="conversation-status" class="text-xs text-gray-500"></div>
                            </div>
                        </div>
                        
                        <!-- Messages Area -->
                        <div id="conversation-messages" class="flex-1 overflow-y-auto p-3 space-y-3"></div>
                        
                        <!-- Typing Indicator -->
                        <div id="typing-indicator" class="px-3 py-1 text-xs text-gray-500 hidden">
                            <div class="flex items-center">
                                <div class="typing-dots">
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                                <span class="ml-2">Typing...</span>
                            </div>
                        </div>
                        
                        <!-- Attachment Preview Area -->
                        <div id="attachment-preview" class="p-2 hidden border-t border-gray-100"></div>
                        
                        <!-- Message Input -->
                        <div class="border-t p-2">
                            <form id="message-form" class="flex flex-col">
                                <div class="flex items-center">
                                    <button type="button" id="attachment-button" class="text-gray-500 hover:text-shopee-orange p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                    </button>
                                    <textarea 
                                        id="message-input" 
                                        class="flex-1 border rounded-l-lg px-3 py-2 resize-none focus:outline-none focus:border-shopee-orange" 
                                        placeholder="Type a message..." 
                                        rows="1"></textarea>
                                    <button type="submit" class="bg-shopee-orange text-white px-4 py-2 h-full rounded-r-lg hover:bg-shopee-orange/90">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                    </button>
                                </div>
                                <input type="file" id="attachment-input" accept="image/*" class="hidden">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chat Launcher Button (when minimized) -->
            <div id="shop-chat-launcher" class="hidden fixed bottom-4 right-4 z-50 w-14 h-14 bg-shopee-orange rounded-full shadow-lg flex items-center justify-center cursor-pointer hover:bg-shopee-orange/90">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span id="launcher-unread-count" class="hidden absolute -top-1 -right-2 bg-white text-shopee-orange text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">0</span>
                </div>
            </div>
            
            <!-- Audio elements for notifications -->
            <audio id="chat-notification-sound" preload="auto">
                <source src="/public/assets/audio/notification.mp3" type="audio/mpeg">
            </audio>
            <audio id="chat-sent-sound" preload="auto">
                <source src="/public/assets/audio/message-sent.mp3" type="audio/mpeg">
            </audio>
            
            <style>
                #shop-chat-container {
                    max-height: 90vh;
                    max-width: 90%;
                }
                @media (min-width: 640px) {
                    #shop-chat-container {
                        max-width: 420px;
                    }
                }
                .dot {
                    display: inline-block;
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    margin-right: 3px;
                    background-color: #ccc;
                    animation: wave 1.3s linear infinite;
                }
                .dot:nth-child(2) {
                    animation-delay: -1.1s;
                }
                .dot:nth-child(3) {
                    animation-delay: -0.9s;
                }
                @keyframes wave {
                    0%, 60%, 100% {
                        transform: initial;
                    }
                    30% {
                        transform: translateY(-5px);
                    }
                }
                .message-bubble {
                    max-width: 80%;
                }
                .message-status {
                    font-size: 10px;
                }
                #typing-indicator {
                    height: 24px;
                }
                #message-input {
                    min-height: 40px;
                    max-height: 100px;
                }
                /* Autogrow textarea styles */
                .autogrow {
                    overflow-y: hidden;
                }
                /* Attachment preview styles */
                #attachment-preview {
                    max-height: 150px;
                    overflow-y: auto;
                }
                .attachment-preview-item {
                    position: relative;
                    display: inline-block;
                    margin-right: 8px;
                }
                .attachment-remove {
                    position: absolute;
                    top: -8px;
                    right: -8px;
                    background-color: #ff4d4f;
                    color: white;
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    cursor: pointer;
                    font-size: 12px;
                }
                .image-attachment {
                    max-width: 120px;
                    max-height: 120px;
                    border-radius: 8px;
                    border: 1px solid #e0e0e0;
                }
                /* Image viewer modal styles */
                #shop-chat-image-modal img {
                    max-height: 80vh;
                    max-width: 90vw;
                }
            </style>
        `;
        
        const chatContainer = document.createElement('div');
        chatContainer.innerHTML = chatHTML;
        document.body.appendChild(chatContainer);
        
        this.chatContainer = document.getElementById('shop-chat-container');
        this.chatLauncher = document.getElementById('shop-chat-launcher');
        
        // Show the chat launcher by default
        this.chatLauncher.classList.remove('hidden');
        
        // Add click event for attachment button
        document.getElementById('attachment-button').addEventListener('click', () => {
            document.getElementById('attachment-input').click();
        });
    }
    
    /**
     * Set up all event listeners for the chat UI
     */
    _setupEventListeners() {
        // Chat launcher (minimized state)
        document.getElementById('shop-chat-launcher').addEventListener('click', () => {
            this.shopChat.toggleChatWindow();
        });
        
        // Minimize button
        document.getElementById('shop-chat-minimize').addEventListener('click', () => {
            this.shopChat.toggleChatWindow();
        });
        
        // Back button in conversation view
        document.getElementById('back-to-conversations').addEventListener('click', () => {
            this.shopChat.showConversationsList();
        });
        
        // Message form submission
        document.getElementById('message-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value.trim();
            const attachmentInput = document.getElementById('attachment-input');
            const attachment = attachmentInput.files.length > 0 ? attachmentInput.files[0] : null;
            
            if (message || attachment) {
                this.shopChat.sendMessage(message, attachment);
                messageInput.value = '';
                messageInput.style.height = 'auto';
                
                // Clear attachment if any
                this._clearAttachmentPreview();
                attachmentInput.value = '';
                
                // Play message sent sound
                this._playMessageSentSound();
            }
        });
        
        // Handle attachment selection
        const attachmentInput = document.getElementById('attachment-input');
        attachmentInput.addEventListener('change', () => {
            const file = attachmentInput.files[0];
            if (file) {
                this._showAttachmentPreview(file);
            }
        });
        
        // Auto-resize message input
        const messageInput = document.getElementById('message-input');
        messageInput.addEventListener('input', () => {
            // Auto-grow textarea
            messageInput.style.height = 'auto';
            messageInput.style.height = Math.min(messageInput.scrollHeight, 100) + 'px';
            
            // Handle typing indicator
            if (messageInput.value.trim() && !this.shopChat.isTyping) {
                this.shopChat.isTyping = true;
                this.shopChat._sendTypingIndicator(true);
            } else if (!messageInput.value.trim() && this.shopChat.isTyping) {
                this.shopChat.isTyping = false;
                this.shopChat._sendTypingIndicator(false);
            }
            
            // Reset typing timeout
            clearTimeout(this.shopChat.typingTimeout);
            this.shopChat.typingTimeout = setTimeout(() => {
                if (this.shopChat.isTyping) {
                    this.shopChat.isTyping = false;
                    this.shopChat._sendTypingIndicator(false);
                }
            }, 3000);
        });
        
        // Add keyboard shortcut to send message with Enter (but not with Shift+Enter)
        messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                document.getElementById('message-form').dispatchEvent(new Event('submit'));
            }
        });
    }
    
    /**
     * Toggle between minimized and expanded chat window
     */
    toggleChatWindow(isMinimized) {
        if (isMinimized) {
            this.chatLauncher.classList.remove('hidden');
            this.chatContainer.classList.add('hidden');
        } else {
            this.chatLauncher.classList.add('hidden');
            this.chatContainer.classList.remove('hidden');
            this.resetUnreadCount();
        }
    }
    
    /**
     * Open the chat window
     */
    openChatWindow() {
        this.shopChat.isMinimized = false;
        this.toggleChatWindow(false);
    }
    
    /**
     * Generate avatar from name
     */
    _generateAvatar(name, size = 40) {
        // Get first character of name
        const firstChar = name ? name.charAt(0).toUpperCase() : '?';
        
        // Generate random color based on name hash
        const hash = name ? name.split('').reduce((a, b) => {
            a = ((a << 5) - a) + b.charCodeAt(0);
            return a & a;
        }, 0) : 0;
        
        const hue = Math.abs(hash % 360);
        const saturation = 70 + Math.abs(hash % 30);
        const lightness = 50 + Math.abs(hash % 20);
        
        const bgColor = `hsl(${hue}, ${saturation}%, ${lightness}%)`;
        const textColor = lightness > 70 ? '#333' : '#fff';
        
        // Create SVG
        const svg = `
        <svg xmlns="http://www.w3.org/2000/svg" width="${size}" height="${size}" viewBox="0 0 ${size} ${size}">
            <rect width="${size}" height="${size}" fill="${bgColor}" />
            <text x="50%" y="50%" dy=".1em" fill="${textColor}" 
                  font-size="${size * 0.5}" font-weight="bold" 
                  text-anchor="middle" dominant-baseline="middle">${firstChar}</text>
        </svg>`;
        
        return `data:image/svg+xml;charset=UTF-8,${encodeURIComponent(svg)}`;
    }
    
    /**
     * Render the list of conversations
     */
    renderConversationsList(conversations) {
        const loading = document.getElementById('chat-loading');
        const noConversations = document.getElementById('chat-no-conversations');
        const conversationList = document.getElementById('chat-conversation-list');
        
        // Hide loading indicator
        loading.classList.add('hidden');
        
        // Show appropriate view based on conversations count
        if (conversations.length === 0) {
            noConversations.classList.remove('hidden');
            conversationList.classList.add('hidden');
            return;
        }
        
        // Show conversation list
        noConversations.classList.add('hidden');
        conversationList.classList.remove('hidden');
        
        // Generate conversation items HTML
        let conversationsHTML = '';
        
        conversations.forEach(conv => {
            const unread = parseInt(conv.unread_count);
            
            // Generate avatar from name instead of using profile_image
            const avatarSrc = this._generateAvatar(conv.display_name || conv.other_name);
            
            conversationsHTML += `
                <div class="conversation-item p-2 rounded hover:bg-gray-100 cursor-pointer mb-1 ${unread > 0 ? 'bg-shopee-light' : ''}" 
                    data-conversation-id="${conv.conversation_id}" 
                    data-other-id="${conv.other_id}"
                    data-other-name="${conv.other_name}"
                    data-display-name="${conv.display_name}">
                    <div class="flex items-start">
                        <div class="w-10 h-10 rounded-full flex-shrink-0 mr-2 overflow-hidden">
                            <img src="${avatarSrc}" alt="${conv.display_name}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between">
                                <div class="font-medium text-sm truncate ${unread > 0 ? 'text-shopee-orange' : ''}">${conv.display_name}</div>
                                <div class="text-xs text-gray-500">${conv.time_display}</div>
                            </div>
                            <div class="text-xs text-gray-500 truncate">${conv.last_message || 'No messages yet'}</div>
                        </div>
                        ${unread > 0 ? `<div class="ml-1 bg-shopee-orange text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">${unread}</div>` : ''}
                    </div>
                </div>
            `;
        });
        
        // Update the list
        conversationList.innerHTML = conversationsHTML;
        
        // Add click event listeners to conversation items
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.addEventListener('click', () => {
                const conversationId = item.getAttribute('data-conversation-id');
                const otherId = item.getAttribute('data-other-id');
                const otherName = item.getAttribute('data-other-name');
                const displayName = item.getAttribute('data-display-name');
                
                this.shopChat.openConversation({
                    conversation_id: conversationId,
                    other_id: otherId,
                    other_name: otherName,
                    display_name: displayName
                });
            });
        });
    }
    
    /**
     * Show conversations list view
     */
    showConversationsList() {
        document.getElementById('shop-chat-conversations').classList.remove('hidden');
        document.getElementById('shop-chat-conversation').classList.add('hidden');
        document.getElementById('chat-header-title').textContent = 'Chat';
    }
    
    /**
     * Show loading state in conversation view
     */
    showLoadingInConversation(message = 'Loading conversation...') {
        // Update conversation view
        document.getElementById('shop-chat-conversations').classList.add('hidden');
        document.getElementById('shop-chat-conversation').classList.remove('hidden');
        
        // Update header
        document.getElementById('chat-header-title').textContent = 'Loading...';
        document.getElementById('conversation-name').textContent = 'Loading...';
        document.getElementById('conversation-status').textContent = '';
        
        // Set default avatar
        const avatarImg = document.getElementById('conversation-avatar-img');
        avatarImg.src = '/public/assets/img/avatars/default.jpg';
        
        // Show loading in messages area
        const messagesContainer = document.getElementById('conversation-messages');
        messagesContainer.innerHTML = `
            <div class="flex flex-col items-center justify-center h-full py-10">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-shopee-orange mb-3"></div>
                <p class="text-gray-500">${message}</p>
            </div>
        `;
        
        // Hide typing indicator
        this.showTypingIndicator(false);
        
        // Disable message input
        const messageInput = document.getElementById('message-input');
        messageInput.disabled = true;
        messageInput.placeholder = 'Please wait...';
    }
    
    /**
     * Show a specific conversation
     */
    showConversation(conversationData, messages) {
        // Update conversation view
        document.getElementById('shop-chat-conversations').classList.add('hidden');
        document.getElementById('shop-chat-conversation').classList.remove('hidden');
        
        // Update header
        document.getElementById('chat-header-title').textContent = conversationData.display_name;
        document.getElementById('conversation-name').textContent = conversationData.display_name;
        document.getElementById('conversation-status').textContent = 'Active now'; // Default status
        
        // Set avatar from generated SVG
        const avatarImg = document.getElementById('conversation-avatar-img');
        avatarImg.src = this._generateAvatar(conversationData.display_name || conversationData.other_name);
        avatarImg.alt = conversationData.display_name;
        
        // Clear messages
        const messagesContainer = document.getElementById('conversation-messages');
        messagesContainer.innerHTML = '';
        
        // Add messages
        messages.forEach(message => {
            this.addMessageToConversation(message, false);
        });
        
        // Scroll to bottom
        this.scrollToBottom();
        
        // Hide typing indicator
        this.showTypingIndicator(false);
        
        // Enable message input
        const messageInput = document.getElementById('message-input');
        messageInput.disabled = false;
        messageInput.placeholder = 'Type a message...';
        messageInput.focus();
    }
    
    /**
     * Add a message to the current conversation
     */
    addMessageToConversation(message, scroll = true) {
        const messagesContainer = document.getElementById('conversation-messages');
        
        const messageId = message.id || 'temp_' + Date.now();
        const isSender = message.is_sender || message.sender_type === this.shopChat.userType;
        const status = message.status || 'sent';
        const hasAttachment = message.attachment_url || message.attachment;
        
        // Debug message info
        console.log(`Adding message - ID: ${messageId}, Sender: ${isSender ? 'me' : 'other'}, Status: ${status}`);
        
        let attachmentHTML = '';
        
        // Handle attachment if present
        if (hasAttachment) {
            const attachmentUrl = message.attachment_url || 
                                 (message.attachment ? URL.createObjectURL(message.attachment) : '');
            
            attachmentHTML = `
                <div class="mb-2">
                    <img src="${attachmentUrl}" alt="Image attachment" 
                         class="max-w-full max-h-40 rounded cursor-pointer" 
                         onclick="window.shopChat.UI._openImageViewer('${attachmentUrl}')"
                         onerror="this.onerror=null; this.src='/public/assets/img/image-error.png';">
                </div>
            `;
        }
        
        const messageHTML = `
            <div class="message ${isSender ? 'sent' : 'received'}" id="message-${messageId}">
                <div class="flex ${isSender ? 'justify-end' : 'justify-start'}">
                    <div class="message-bubble ${isSender ? 'bg-shopee-orange text-white' : 'bg-gray-100 text-gray-800'} rounded-lg px-3 py-2">
                        ${attachmentHTML}
                        ${message.message ? `<div class="text-sm">${this._escapeHtml(message.message)}</div>` : ''}
                        <div class="flex items-center justify-end mt-1">
                            <span class="text-xs opacity-70">${this._formatTime(message.formatted_time)}</span>
                            ${isSender ? `
                                <span class="message-status ml-1 ${status === 'failed' ? 'text-red-400' : ''}" data-message-id="${messageId}" title="${status === 'sending' ? 'Sending...' : status === 'sent' ? 'Sent' : 'Failed to send'}">
                                    ${status === 'sending' ? 
                                        '<svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' : 
                                        status === 'sent' ? 
                                            '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' : 
                                            '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                                    }
                                </span>
                            ` : ''}
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Check if we need to append or replace an existing temporary message
        const existingMessage = document.getElementById(`message-${messageId}`);
        if (existingMessage) {
            existingMessage.outerHTML = messageHTML;
        } else {
            messagesContainer.innerHTML += messageHTML;
        }
        
        if (scroll) {
            this.scrollToBottom();
        }
    }
    
    /**
     * Update the status of a message
     */
    updateMessageStatus(messageId, status, newId = null) {
        console.log(`Updating message status - ID: ${messageId}, Status: ${status}, New ID: ${newId}`);
        const messageElement = document.getElementById(`message-${messageId}`);
        const statusEl = messageElement ? messageElement.querySelector('.message-status') : null;
        
        if (!statusEl) {
            console.error(`Status element not found for message ID: ${messageId}`);
            return;
        }
        
        if (status === 'sent') {
            statusEl.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            statusEl.classList.remove('text-red-400');
            statusEl.title = 'Sent';
            
            // If a new ID was provided, update the message ID
            if (newId && messageId !== newId) {
                messageElement.id = `message-${newId}`;
                statusEl.setAttribute('data-message-id', newId);
                console.log(`Updated message ID from ${messageId} to ${newId}`);
            }
        } else if (status === 'sending') {
            statusEl.innerHTML = '<svg class="w-3 h-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
            statusEl.classList.remove('text-red-400');
            statusEl.title = 'Sending...';
        } else if (status === 'failed') {
            statusEl.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
            statusEl.classList.add('text-red-400');
            statusEl.title = 'Failed to send';
            
            // Add retry option
            if (!messageElement.querySelector('.retry-button')) {
                const messageText = messageElement.querySelector('.text-sm').textContent;
                const retryBtn = document.createElement('button');
                retryBtn.className = 'retry-button text-xs text-red-500 hover:text-red-700 mt-1';
                retryBtn.textContent = 'Retry';
                retryBtn.onclick = (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    // Remove the message and retry sending
                    messageElement.remove();
                    this.shopChat.sendMessage(messageText);
                };
                messageElement.querySelector('.message-bubble').appendChild(retryBtn);
            }
        }
    }
    
    /**
     * Mark all messages in the current conversation as read
     */
    markMessagesAsRead() {
        // Visual indication that all messages are read
        document.querySelectorAll('.message.received .message-status').forEach(el => {
            el.classList.remove('text-yellow-400');
            el.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
        });
    }
    
    /**
     * Show/hide typing indicator
     */
    showTypingIndicator(isTyping) {
        const typingIndicator = document.getElementById('typing-indicator');
        if (isTyping) {
            typingIndicator.classList.remove('hidden');
        } else {
            typingIndicator.classList.add('hidden');
        }
        
        // Scroll to bottom when showing typing indicator
        if (isTyping) {
            this.scrollToBottom();
        }
    }
    
    /**
     * Update connection status
     */
    updateConnectionStatus(isConnected) {
        const statusEl = document.getElementById('conversation-status');
        if (statusEl && this.shopChat.currentConversation) {
            statusEl.textContent = isConnected ? 'Active now' : 'Offline';
            statusEl.classList.toggle('text-shopee-orange', isConnected);
            statusEl.classList.toggle('text-gray-500', !isConnected);
        }
    }
    
    /**
     * Update unread count badge
     */
    updateUnreadCount(count) {
        const headerCountEl = document.getElementById('chat-unread-count');
        const launcherCountEl = document.getElementById('launcher-unread-count');
        
        if (count > 0) {
            headerCountEl.textContent = count;
            headerCountEl.classList.remove('hidden');
            
            launcherCountEl.textContent = count;
            launcherCountEl.classList.remove('hidden');
        } else {
            headerCountEl.classList.add('hidden');
            launcherCountEl.classList.add('hidden');
        }
    }
    
    /**
     * Reset unread count
     */
    resetUnreadCount() {
        this.updateUnreadCount(0);
    }
    
    /**
     * Scroll messages container to bottom
     */
    scrollToBottom() {
        const messagesContainer = document.getElementById('conversation-messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    /**
     * Format message time for display
     */
    _formatTime(timeStr) {
        if (!timeStr) return '';
        
        try {
            const date = new Date(timeStr);
            const now = new Date();
            
            // For today, just show the time
            if (date.toDateString() === now.toDateString()) {
                return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }
            
            // For this year, show day and month
            if (date.getFullYear() === now.getFullYear()) {
                return date.toLocaleDateString([], { month: 'short', day: 'numeric' });
            }
            
            // Otherwise show date with year
            return date.toLocaleDateString([], { year: 'numeric', month: 'short', day: 'numeric' });
        } catch (e) {
            return timeStr;
        }
    }
    
    /**
     * Escape HTML for display
     */
    _escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML
            .replace(/\n/g, '<br>')
            .replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" class="underline">$1</a>');
    }
    
    /**
     * Show attachment preview
     */
    _showAttachmentPreview(file) {
        // Only allow images
        if (!file.type.startsWith('image/')) {
            this.showError('Only image files are supported');
            return;
        }
        
        // Check file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            this.showError('Image is too large. Maximum size is 5MB');
            return;
        }
        
        const previewArea = document.getElementById('attachment-preview');
        previewArea.innerHTML = '';
        previewArea.classList.remove('hidden');
        
        // Create preview item
        const previewItem = document.createElement('div');
        previewItem.className = 'attachment-preview-item';
        
        // Create image preview
        const img = document.createElement('img');
        img.className = 'image-attachment';
        img.src = URL.createObjectURL(file);
        
        // Create remove button
        const removeButton = document.createElement('span');
        removeButton.className = 'attachment-remove';
        removeButton.innerHTML = '×';
        removeButton.addEventListener('click', () => {
            this._clearAttachmentPreview();
            document.getElementById('attachment-input').value = '';
        });
        
        // Append elements
        previewItem.appendChild(img);
        previewItem.appendChild(removeButton);
        previewArea.appendChild(previewItem);
    }
    
    /**
     * Clear attachment preview
     */
    _clearAttachmentPreview() {
        const previewArea = document.getElementById('attachment-preview');
        previewArea.innerHTML = '';
        previewArea.classList.add('hidden');
    }
    
    /**
     * Open image viewer for attachments
     */
    _openImageViewer(imageUrl) {
        // Create modal if it doesn't exist
        let imageModal = document.getElementById('shop-chat-image-modal');
        
        if (!imageModal) {
            imageModal = document.createElement('div');
            imageModal.id = 'shop-chat-image-modal';
            imageModal.className = 'fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4';
            
            const closeBtn = document.createElement('button');
            closeBtn.className = 'absolute top-4 right-4 text-white text-3xl hover:text-gray-300';
            closeBtn.innerHTML = '×';
            closeBtn.onclick = () => imageModal.classList.add('hidden');
            
            const img = document.createElement('img');
            img.id = 'shop-chat-modal-image';
            img.className = 'max-w-full max-h-[80vh] mx-auto rounded shadow-lg';
            img.alt = 'Image attachment';
            
            imageModal.appendChild(closeBtn);
            imageModal.appendChild(img);
            document.body.appendChild(imageModal);
            
            // Close on click outside the image
            imageModal.addEventListener('click', (e) => {
                if (e.target === imageModal) {
                    imageModal.classList.add('hidden');
                }
            });
            
            // Close on Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !imageModal.classList.contains('hidden')) {
                    imageModal.classList.add('hidden');
                }
            });
        }
        
        // Set image source and show modal
        const modalImage = document.getElementById('shop-chat-modal-image');
        modalImage.src = imageUrl;
        imageModal.classList.remove('hidden');
    }
    
    /**
     * Show an error message with better feedback
     */
    showError(message) {
        console.error('Chat UI Error:', message);
        
        // Create or update error toast
        let errorToast = document.getElementById('chat-error-toast');
        
        if (!errorToast) {
            errorToast = document.createElement('div');
            errorToast.id = 'chat-error-toast';
            errorToast.className = 'fixed bottom-20 right-4 z-50 bg-red-500 text-white px-4 py-2 rounded shadow-lg transform translate-y-2 opacity-0 transition-all duration-300';
            document.body.appendChild(errorToast);
        }
        
        errorToast.textContent = message;
        errorToast.classList.remove('opacity-0', 'translate-y-2');
        
        // Hide after 3 seconds
        setTimeout(() => {
            errorToast.classList.add('opacity-0', 'translate-y-2');
        }, 5000);
    }
    
    /**
     * Show loading error
     */
    showLoadingError() {
        const loading = document.getElementById('chat-loading');
        if (loading) {
            loading.innerHTML = `
                <div class="text-center text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>Failed to load conversations</p>
                    <button id="retry-load-conversations" class="mt-2 px-3 py-1 bg-shopee-orange text-white rounded text-sm">
                        Try Again
                    </button>
                </div>
            `;
            
            document.getElementById('retry-load-conversations')?.addEventListener('click', () => {
                loading.innerHTML = `
                    <svg class="animate-spin h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Loading conversations...</span>
                `;
                this.shopChat._loadConversations();
            });
        }
    }
    
    /**
     * Show notification for a new message
     */
    showMessageNotification(messageData) {
        // Play notification sound if message is not from current user and chat is minimized
        if (!messageData.is_sender && this.shopChat.isMinimized) {
            this._playNotificationSound();
        }
        
        // Only show if browser notifications are supported
        if (!("Notification" in window)) return;
        
        // Create notification if permission is granted
        if (Notification.permission === "granted") {
            this._createNotification(messageData);
        } 
        // Otherwise request permission
        else if (Notification.permission !== "denied") {
            Notification.requestPermission().then(permission => {
                if (permission === "granted") {
                    this._createNotification(messageData);
                }
            });
        }
    }
    
    /**
     * Create browser notification
     */
    _createNotification(messageData) {
        // Find conversation details
        let senderName = 'Shop';
        let avatarUrl = '/public/assets/img/avatars/default.jpg';
        
        const conversation = this.shopChat.conversations.find(
            c => c.conversation_id === messageData.conversation_id
        );
        
        if (conversation) {
            senderName = conversation.display_name;
            avatarUrl = this._generateAvatar(conversation.display_name || conversation.other_name);
        }
        
        // Create notification
        const notification = new Notification(senderName, {
            body: messageData.message,
            icon: avatarUrl,
            badge: '/public/assets/img/logo-small.png'
        });
        
        // Handle click on notification
        notification.onclick = () => {
            window.focus();
            
            if (conversation) {
                this.shopChat.openConversation(conversation);
                this.openChatWindow();
            }
            
            notification.close();
        };
        
        // Auto close after 5 seconds
        setTimeout(() => {
            notification.close();
        }, 5000);
    }
    
    /**
     * Play notification sound
     */
    _playNotificationSound() {
        const sound = document.getElementById('chat-notification-sound');
        if (sound) {
            // Reset sound to beginning and play
            sound.currentTime = 0;
            sound.play().catch(err => {
                console.log("Could not play notification sound. This is often because the user hasn't interacted with the page yet.");
            });
        }
    }
    
    /**
     * Play message sent sound
     */
    _playMessageSentSound() {
        const sound = document.getElementById('chat-sent-sound');
        if (sound) {
            // Reset sound to beginning and play
            sound.currentTime = 0;
            sound.play().catch(err => {
                // This is usually fine - browsers often block autoplay until user interacts
                console.log("Could not play sent sound.");
            });
        }
    }
}
