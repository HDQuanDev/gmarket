<!-- Main chat container -->
<div class="container-fluid">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="flex flex-col md:flex-row h-[calc(100vh-12rem)]">
            <!-- Overlay for mobile when sidebar is open -->
            <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>
            
            <!-- Conversations List -->
            <div id="conversations-sidebar" class="w-full md:w-1/3 border-r border-gray-200 md:static fixed inset-0 z-40 bg-white transform transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full">
                <!-- Mobile Close Button (visible on mobile only) -->
                <div class="absolute top-4 right-4 md:hidden">
                    <button id="close-sidebar-btn" class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Header -->
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="font-medium">Trò chuyện</h3>
                </div>

                <!-- Conversations Container -->
                <div class="h-[calc(100%-4rem)] overflow-y-auto">
                    <!-- Loading State -->
                    <div id="conversations-loading" class="flex items-center justify-center h-full p-4">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                    </div>

                    <!-- Empty State -->
                    <div id="conversations-empty" class="hidden text-center p-4 text-gray-500">
                        <p>Chưa có cuộc trò chuyện nào</p>
                    </div>

                    <!-- Conversations List -->
                    <div id="conversations-list" class="hidden"></div>
                </div>
            </div>

            <!-- Chat Area -->
            <div class="w-full md:w-2/3 flex flex-col relative h-full">
                <!-- Mobile Toggle Button (visible on mobile only) -->
                <div class="md:hidden p-2 border-b bg-white">
                    <button id="toggle-sidebar-btn" class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Initial State -->
                <div id="no-conversation-selected" class="h-full flex items-center justify-center absolute inset-0 bg-gray-50">
                    <div class="text-center text-gray-500 px-4">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <p>Chọn một cuộc trò chuyện để bắt đầu</p>
                    </div>
                </div>

                <!-- Active Chat -->
                <div id="chat-content" class="hidden h-full flex flex-col absolute inset-0 bg-white">
                    <!-- Chat Header -->
                    <div class="p-4 border-b flex items-center bg-white">
                        <div class="md:hidden mr-2">
                            <button id="back-to-conversations" class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold mr-3">
                            <span id="chat-avatar-text">U</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 id="chat-user-name" class="font-medium truncate">Tên khách hàng</h4>
                            <p id="chat-user-status" class="text-sm text-gray-500">Đang hoạt động</p>
                        </div>
                    </div>

                    <!-- Messages Container -->
                    <div id="messages-container" class="flex-1 overflow-y-auto p-4 bg-gray-50">
                        <div id="messages-list"></div>
                    </div>

                    <!-- Typing Indicator -->
                    <div id="typing-indicator" class="hidden px-4 py-2 bg-gray-50 text-sm text-gray-500">
                        <span>Đang nhập tin nhắn...</span>
                    </div>

                    <!-- Message Input -->
                    <div class="border-t p-4 bg-white">
                        <form id="message-form" class="flex items-end space-x-2">
                            <button type="button" id="attachment-btn" class="p-2 text-gray-500 hover:text-blue-500 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                    </path>
                                </svg>
                            </button>
                            <div class="flex-1 min-w-0">
                                <textarea id="message-input" rows="1" 
                                    class="w-full p-3 border rounded-lg focus:outline-none focus:border-blue-500 resize-none"
                                    placeholder="Nhập tin nhắn..."></textarea>
                                <div id="attachment-preview" class="hidden mt-2"></div>
                            </div>
                            <button type="submit" class="p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </form>
                        <input type="file" id="attachment-input" class="hidden" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile sidebar toggle script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('conversations-sidebar');
    const toggleBtn = document.getElementById('toggle-sidebar-btn');
    const closeBtn = document.getElementById('close-sidebar-btn');
    const backBtn = document.getElementById('back-to-conversations');
    const overlay = document.getElementById('sidebar-overlay');
    const chatContent = document.getElementById('chat-content');
    const noConversation = document.getElementById('no-conversation-selected');
    
    function openSidebar() {
        sidebar.classList.add('translate-x-0');
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    }
    
    function closeSidebar() {
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }
    
    if (toggleBtn) {
        toggleBtn.addEventListener('click', openSidebar);
    }
    
    if (closeBtn) {
        closeBtn.addEventListener('click', closeSidebar);
    }
    
    if (backBtn) {
        backBtn.addEventListener('click', function() {
            if (window.innerWidth < 768) {
                // On mobile, toggle visibility
                chatContent.classList.add('hidden');
                noConversation.classList.remove('hidden');
                openSidebar();
            }
        });
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }
    
    // Handle conversation item clicks to show chat on mobile
    document.addEventListener('click', function(e) {
        if (e.target.closest('.conversation-item') && window.innerWidth < 768) {
            chatContent.classList.remove('hidden');
            noConversation.classList.add('hidden');
            closeSidebar();
        }
    });
    
    // Fix iOS viewport height issues
    function setIOSHeight() {
        if (/iPhone|iPad|iPod/.test(navigator.userAgent)) {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        }
    }
    
    setIOSHeight();
    window.addEventListener('resize', setIOSHeight);
    
    // Reset on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            // Reset sidebar state to default on desktop
            sidebar.classList.remove('-translate-x-full', 'translate-x-0');
            overlay.classList.add('hidden');
        }
    });
    
    // Initial state setup for mobile
    if (window.innerWidth < 768) {
        noConversation.classList.remove('hidden');
        chatContent.classList.add('hidden');
    }
});
</script>
