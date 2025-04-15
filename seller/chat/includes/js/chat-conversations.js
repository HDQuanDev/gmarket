/**
 * Conversations handling
 * Manages loading and rendering conversations list
 */

// Load conversations from API
function loadConversations() {
    // Show loading state
    const conversationsList = document.getElementById('conversations-list');
    const conversationsLoading = document.getElementById('conversations-loading');
    const conversationsEmpty = document.getElementById('conversations-empty');
    
    conversationsList.innerHTML = '';
    conversationsLoading.classList.remove('hidden');
    conversationsEmpty.classList.add('hidden');
    conversationsList.classList.add('hidden');
    
    // Return a Promise so we can chain actions after loading
    return new Promise((resolve, reject) => {
        // Fetch from API
        fetch(`${apiUrl}?action=get_conversations`)
            .then(response => response.json())
            .then(data => {
                conversationsLoading.classList.add('hidden');
                
                if (data.success) {
                    window.conversations = data.conversations || [];
                    
                    if (window.conversations.length === 0) {
                        conversationsEmpty.classList.remove('hidden');
                    } else {
                        renderConversations();
                        conversationsList.classList.remove('hidden');
                    }
                    resolve(window.conversations); // Resolve the promise with conversations
                } else {
                    throw new Error(data.message || 'Failed to load conversations');
                }
            })
            .catch(error => {
                console.error('Error loading conversations:', error);
                conversationsLoading.classList.add('hidden');
                
                const errorDiv = document.createElement('div');
                errorDiv.className = 'p-5 text-center';
                errorDiv.innerHTML = `
                    <p class="text-red-500 mb-2">Không thể tải cuộc trò chuyện</p>
                    <button id="retry-button" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Thử lại</button>
                `;
                conversationsList.innerHTML = '';
                conversationsList.appendChild(errorDiv);
                conversationsList.classList.remove('hidden');
                
                document.getElementById('retry-button').addEventListener('click', loadConversations);
                reject(error); // Reject the promise with the error
            });
    });
}

// Render conversations list
function renderConversations() {
    const conversationsList = document.getElementById('conversations-list');
    let html = '';
    
    window.conversations.forEach(conv => {
        const unread = parseInt(conv.unread_count || 0);
        const isActive = window.chatState.currentConversation && 
            (window.chatState.currentConversation.id === conv.conversation_id ||
             window.chatState.currentConversation.conversation_id === conv.conversation_id);
        const userName = conv.display_name || conv.other_name || 'Khách hàng';
        const userInitial = userName.charAt(0).toUpperCase();
        const lastMessage = conv.last_message || 'Chưa có tin nhắn';
        const timeDisplay = formatTime(conv.updated_at || conv.created_at);
        
        html += `
            <div class="conversation-item p-3 border-b border-gray-200 cursor-pointer 
                      ${isActive ? 'bg-blue-50' : ''} ${unread > 0 ? 'bg-yellow-50' : ''}"
                 data-id="${conv.conversation_id}" data-user-id="${conv.other_id}" data-user-name="${userName}">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold flex-shrink-0 mr-3">
                        ${userInitial}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center">
                            <h3 class="font-medium truncate text-sm">${userName}</h3>
                            <span class="text-xs text-gray-500 ml-2 flex-shrink-0">${timeDisplay}</span>
                        </div>
                        <p class="text-sm text-gray-600 truncate mt-1">${lastMessage}</p>
                    </div>
                    ${unread > 0 ? `
                        <div class="ml-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs flex-shrink-0">
                            ${unread}
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    });
    
    conversationsList.innerHTML = html;
    
    // Add click handlers
    document.querySelectorAll('.conversation-item').forEach(item => {
        item.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            
            openConversation({
                id: id,
                conversation_id: id,
                other_id: userId,
                other_name: userName
            });
        });
    });
}

// Add this function to properly store selected conversation
function openConversation(conversation) {
    // Update global state
    window.chatState.currentConversation = {
        id: conversation.id,
        conversation_id: conversation.id || conversation.conversation_id,
        other_id: conversation.other_id || conversation.userId,
        other_name: conversation.other_name || conversation.userName
    };
    
    // Show loading state and fetch messages
    loadConversationMessages(conversation.id || conversation.conversation_id);
}

// Add this function to load messages
function loadConversationMessages(conversationId) {
    // Update UI
    document.getElementById('no-conversation-selected').classList.add('hidden');
    document.getElementById('chat-content').classList.remove('hidden');
    
    // Update header based on current conversation
    const conversation = window.chatState.currentConversation;
    document.getElementById('chat-user-name').textContent = conversation.other_name;
    document.getElementById('chat-avatar-text').textContent = conversation.other_name.charAt(0).toUpperCase();
    document.getElementById('chat-user-status').textContent = 'Đang tải...';
    
    // Show loading state in messages area
    document.getElementById('messages-container').innerHTML = `
        <div class="flex justify-center items-center h-full">
            <div class="flex flex-col items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
                <p class="mt-2 text-gray-500">Đang tải tin nhắn...</p>
            </div>
        </div>
    `;
    
    // Highlight selected conversation in list
    highlightSelectedConversation(conversationId);
    
    // Load messages from API
    fetch(`${apiUrl}?action=get_messages&conversation_id=${conversationId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderMessages(data.messages || []);
                markMessagesAsRead(conversationId);
            } else {
                throw new Error(data.message || 'Failed to load messages');
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            document.getElementById('messages-container').innerHTML = `
                <div class="flex justify-center items-center h-full">
                    <div class="text-center text-red-500">
                        <p>Không thể tải tin nhắn. Vui lòng thử lại.</p>
                        <button class="mt-2 px-4 py-2 bg-blue-500 text-white rounded" 
                                onclick="loadConversationMessages('${conversationId}')">
                            Thử lại
                        </button>
                    </div>
                </div>
            `;
        });
}
