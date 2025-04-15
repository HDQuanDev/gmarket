/**
 * Chat connection handling
 * Manages socket connection and related events
 */

// Socket connection handling
function connectSocket(sellerId) {
    try {
        const socket = io('https://chat.takashimayavn.com');
            
        // Connection events
        socket.on('connect', function() {
            console.log('Connected to chat server');
            socket.emit('join', { userId: sellerId, userType: 'seller' });
            updateConnectionStatus(true);
        });
            
        socket.on('disconnect', function() {
            console.log('Disconnected from chat server');
            updateConnectionStatus(false);
        });
            
        // Register chat event handlers
        registerSocketEvents(socket);
            
        return socket;
    } catch (error) {
        console.error('Error connecting to socket server:', error);
        updateConnectionStatus(false);
        return null;
    }
}

// Update connection status in the UI
function updateConnectionStatus(isConnected) {
    const statusEl = document.getElementById('chat-user-status');
    if (statusEl && window.currentConversation) {
        statusEl.textContent = isConnected ? 'Đang hoạt động' : 'Ngoại tuyến';
        statusEl.className = 'text-xs ' + (isConnected ? 'text-green-500' : 'text-gray-500');
    }
}

// Register socket event handlers
function registerSocketEvents(socket) {
    socket.on('new_message', handleNewMessage);
    socket.on('message_sent', handleMessageSent);
    socket.on('typing', handleTypingEvent);
    socket.on('message_read', handleMessagesRead);
}
