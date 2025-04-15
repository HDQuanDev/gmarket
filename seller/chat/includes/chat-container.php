<?php
/**
 * Main chat container HTML structure - Redesigned for better UI and responsive design
 */
?>
<!-- Full-screen chat interface with improved design -->
<div class="chat-app-container">
    <!-- Top navigation bar -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-md">
        <div class="container-fluid">
            <div class="flex items-center justify-between py-3 px-4">
                <div class="flex items-center space-x-4">
                    <a href="/seller/index.php" class="flex items-center text-white hover:text-blue-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="hidden sm:inline">Quay lại Dashboard</span>
                    </a>
                </div>
                <h1 class="text-base sm:text-lg font-bold truncate">Hệ thống tin nhắn khách hàng</h1>
                <div>
                    <span id="connection-status" class="px-2 py-1 rounded-full bg-green-500 text-xs">Đã kết nối</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main chat interface container -->
    <div id="seller-chat-container" class="h-[calc(100vh-60px)] bg-gray-50">
        <div class="flex flex-col md:flex-row h-full relative">
            <!-- Mobile overlay for sidebar -->
            <div id="sidebar-overlay" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>
            
            <!-- Left sidebar - Conversations list -->
            <div id="conversations-sidebar" class="w-full md:w-1/4 bg-white shadow-md flex flex-col md:static fixed inset-0 z-40 transform transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0">
                <!-- Mobile close button -->
                <div class="md:hidden absolute top-3 right-3">
                    <button id="close-sidebar-btn" class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Search box -->
                <div class="p-4 border-b">
                    <div class="relative">
                        <input type="text" id="conversation-search" placeholder="Tìm kiếm cuộc trò chuyện..." 
                               class="w-full pl-10 pr-4 py-2 border rounded-full bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                
                <!-- Header -->
                <div class="p-3 border-b bg-gray-50 flex justify-between items-center">
                    <h3 class="font-medium text-gray-700">Cuộc trò chuyện</h3>
                    <span id="unread-count-badge" class="hidden px-2 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full"></span>
                </div>
                
                <!-- Loading state -->
                <div id="conversations-loading" class="flex-grow flex items-center justify-center p-5 text-gray-500">
                    <div class="flex flex-col items-center">
                        <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full text-blue-500 border-t-transparent" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-3">Đang tải cuộc trò chuyện...</p>
                    </div>
                </div>
                
                <!-- No conversations state -->
                <div id="conversations-empty" class="hidden flex-grow flex items-center justify-center p-5 text-center text-gray-500">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="font-medium mb-1">Chưa có cuộc trò chuyện nào</p>
                        <p class="text-sm">Cuộc trò chuyện sẽ xuất hiện khi khách hàng nhắn tin</p>
                    </div>
                </div>
                
                <!-- Conversations list -->
                <div id="conversations-list" class="hidden flex-grow overflow-y-auto"></div>
            </div>
            
            <!-- Right side - Chat messages -->
            <div id="conversation-area" class="w-full md:w-3/4 flex flex-col bg-gray-50 h-full">
                <!-- Mobile toggle button for sidebar -->
                <div class="md:hidden p-3 border-b bg-white">
                    <button id="toggle-sidebar-btn" class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                
                <!-- No selection state -->
                <div id="no-conversation-selected" class="h-full flex items-center justify-center text-gray-500 absolute w-full inset-0 top-12 md:top-0">
                    <div class="text-center max-w-md p-6 bg-white rounded-lg shadow-sm mx-4">
                        <svg class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h3 class="mb-2 text-base sm:text-lg font-medium text-gray-700">Chào mừng đến với tin nhắn khách hàng</h3>
                        <p class="text-gray-500 text-sm sm:text-base">Chọn một cuộc trò chuyện từ danh sách để bắt đầu nhắn tin với khách hàng.</p>
                    </div>
                </div>
                
                <!-- Chat content (hidden initially) -->
                <div id="chat-content" class="hidden flex flex-col h-full absolute inset-0 top-12 md:top-0 w-full bg-white">
                    <!-- Chat header -->
                    <div id="chat-header" class="p-4 bg-white border-b border-gray-200 shadow-sm flex items-center">
                        <div class="md:hidden mr-2">
                            <button id="back-to-conversations" class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                        </div>
                        
                        <div id="chat-user-avatar" class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 text-white flex items-center justify-center mr-3 font-bold">
                            <span id="chat-avatar-text">U</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h4 id="chat-user-name" class="text-base font-medium text-gray-800 truncate">Tên khách hàng</h4>
                            <div class="flex items-center">
                                <span id="chat-user-status" class="text-xs text-gray-500">Đang hoạt động</span>
                                <span class="online-indicator ml-2 w-2 h-2 rounded-full bg-green-500"></span>
                            </div>
                        </div>
                        <div>
                            <button id="chat-options" class="p-2 rounded-full hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Messages container -->
                    <div id="messages-container" class="flex-1 overflow-y-auto p-4 space-y-4"></div>
                    
                    <!-- Typing indicator -->
                    <div id="typing-indicator" class="hidden px-4 py-2 bg-gray-50 border-t border-gray-200">
                        <div class="flex items-center text-gray-500 text-sm">
                            <div class="typing-animation mr-2">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                            <span>Đang nhập...</span>
                        </div>
                    </div>
                    
                    <!-- Message input -->
                    <div class="border-t border-gray-200 p-4 bg-white">
                        <div id="attachment-preview" class="hidden mb-3 p-2 border border-gray-200 rounded-lg bg-gray-50">
                            <div class="flex items-center">
                                <img id="attachment-image" class="h-16 rounded" alt="Attachment preview">
                                <button id="remove-attachment" class="ml-2 text-red-500 hover:text-red-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <form id="message-form" class="flex items-end space-x-2">
                            <div class="flex-shrink-0">
                                <button type="button" id="attachment-button" class="p-2 sm:p-3 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <textarea id="message-input" 
                                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                                    placeholder="Nhập tin nhắn của bạn..." rows="1"></textarea>
                            </div>
                            
                            <div class="flex-shrink-0">
                                <button type="submit" class="p-2 sm:p-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <input type="file" id="attachment-input" class="hidden" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add JavaScript for mobile sidebar toggle -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const sidebar = document.getElementById('conversations-sidebar');
    const toggleBtn = document.getElementById('toggle-sidebar-btn');
    const closeBtn = document.getElementById('close-sidebar-btn');
    const backBtn = document.getElementById('back-to-conversations');
    const overlay = document.getElementById('sidebar-overlay');
    const chatContent = document.getElementById('chat-content');
    const noConversation = document.getElementById('no-conversation-selected');
    
    // Detect if we're on iOS Safari
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    
    // Helper functions for sidebar visibility
    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Prevent body scroll
    }
    
    function closeSidebar() {
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Helper functions for chat/conversation visibility on mobile
    function showChat() {
        if (window.innerWidth < 768) {
            chatContent.classList.remove('hidden');
            noConversation.classList.add('hidden');
            closeSidebar();
            
            // iOS fix: Force height recalculation 
            if (isIOS) setTimeout(setViewportHeight, 100);
        }
    }
    
    function showConversationList() {
        if (window.innerWidth < 768) {
            chatContent.classList.add('hidden');
            noConversation.classList.remove('hidden');
            openSidebar();
            
            // iOS fix: Force height recalculation
            if (isIOS) setTimeout(setViewportHeight, 100);
        }
    }
    
    // Set up event listeners
    if (toggleBtn) {
        toggleBtn.addEventListener('click', openSidebar);
    }
    
    if (closeBtn) {
        closeBtn.addEventListener('click', closeSidebar);
    }
    
    if (backBtn) {
        backBtn.addEventListener('click', showConversationList);
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }
    
    // Create a handler for conversation items
    document.addEventListener('click', function(e) {
        // Target conversation item clicks to show chat on mobile
        if (e.target.closest('.conversation-item')) {
            showChat();
        }
    });
    
    // Fix iOS viewport height issue
    function setViewportHeight() {
        const vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
    
    // Run on load and resize
    setViewportHeight();
    window.addEventListener('resize', function() {
        setViewportHeight();
        
        // Reset UI state on desktop view
        if (window.innerWidth >= 768) {
            closeSidebar();
            
            // On desktop, we can show the chat area by default
            if (!chatContent.classList.contains('hidden')) {
                noConversation.classList.add('hidden');
            }
        }
    });
    
    // Fix for orientation change on mobile
    window.addEventListener('orientationchange', function() {
        setTimeout(setViewportHeight, 200);
    });
    
    // Run on page load to ensure proper initial state
    if (window.innerWidth < 768) {
        chatContent.classList.add('hidden');
        noConversation.classList.remove('hidden');
    }
});
</script>
