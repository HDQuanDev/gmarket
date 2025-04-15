<?php
require_once(__DIR__ . "/../config.php");

// Check if user is logged in and is a seller
if (!isset($seller_id)) {
    header("Location: /seller/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Chat Debug</title>
    
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'shopee-orange': '#ee4d2d',
                        'shopee-light': '#fff0ee',
                        'shopee-yellow': '#faca51'
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/assets/css/seller-chat.css">
    
    <meta name="user-id" content="<?= $seller_id ?>">
    <meta name="user-type" content="seller">
    <meta name="user-name" content="<?= htmlspecialchars($seller_full_name ?? '') ?>">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Seller Chat Debugging</h1>
        
        <div class="bg-white p-6 rounded shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Chat Status</h2>
            <div id="chat-status" class="text-gray-600">Checking chat status...</div>
            
            <div class="mt-4">
                <button id="init-chat-btn" class="bg-shopee-orange text-white px-4 py-2 rounded hover:bg-shopee-orange/90 mr-2">
                    Initialize Chat
                </button>
                <button id="toggle-chat-btn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mr-2">
                    Toggle Chat
                </button>
                <button id="recreate-ui-btn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Recreate UI
                </button>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">UI Visibility Fix</h2>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <div class="text-gray-700">Chat Container</div>
                    <div>
                        <button id="show-container" class="bg-green-500 text-white px-2 py-1 rounded text-sm mr-1">Show</button>
                        <button id="hide-container" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Hide</button>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-gray-700">Chat Launcher</div>
                    <div>
                        <button id="show-launcher" class="bg-green-500 text-white px-2 py-1 rounded text-sm mr-1">Show</button>
                        <button id="hide-launcher" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Hide</button>
                    </div>
                </div>
                <div class="mt-4">
                    <button id="fix-toggle-state" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Fix isMinimized State
                    </button>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Technical Information</h2>
            <div id="tech-info" class="text-gray-600 text-sm">
                <p><strong>Seller ID:</strong> <?= $seller_id ?></p>
                <p><strong>Seller Name:</strong> <?= htmlspecialchars($seller_full_name ?? '') ?></p>
                <p><strong>Browser:</strong> <span id="browser-info"></span></p>
                <p><strong>Viewport Size:</strong> <span id="viewport-size"></span></p>
            </div>
        </div>
        
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-semibold mb-4">API Test</h2>
                <div class="mb-4">
                    <button id="test-api-btn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Test API Connection
                    </button>
                </div>
                <pre id="api-result" class="bg-gray-100 p-3 rounded text-xs max-h-64 overflow-auto">Click the button above to test API</pre>
            </div>
            
            <div class="bg-white p-6 rounded shadow-md">
                <h2 class="text-xl font-semibold mb-4">Socket Test</h2>
                <div class="mb-4">
                    <button id="test-socket-btn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Test Socket Connection
                    </button>
                </div>
                <pre id="socket-result" class="bg-gray-100 p-3 rounded text-xs max-h-64 overflow-auto">Click the button above to test Socket</pre>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.socket.io/4.4.1/socket.io.min.js"></script>
    <script src="/public/assets/js/seller-chat-socket.js"></script>
    <script src="/public/assets/js/seller-chat-api.js"></script>
    <script src="/public/assets/js/seller-chat-ui.js"></script>
    <script src="/public/assets/js/seller-chat.js"></script>
    
    <script>
        // Update technical info
        document.getElementById('browser-info').textContent = navigator.userAgent;
        function updateViewportSize() {
            document.getElementById('viewport-size').textContent = 
                `${window.innerWidth}px × ${window.innerHeight}px`;
        }
        updateViewportSize();
        window.addEventListener('resize', updateViewportSize);
        
        // Check chat status
        function updateChatStatus() {
            const statusEl = document.getElementById('chat-status');
            if (window.sellerChat) {
                const ui = window.sellerChat.UI;
                const socket = window.sellerChat.socket;
                
                let status = 'Chat initialized. ';
                status += `UI ${ui && ui.chatContainer ? 'created' : 'not created'}. `;
                status += `Socket ${socket && socket.connected ? 'connected' : 'not connected'}. `;
                status += `Chat window is ${ui && !ui.isMinimized ? 'open' : 'closed'}. `;
                
                statusEl.textContent = status;
                statusEl.classList.remove('text-red-500');
                statusEl.classList.add('text-green-600');
            } else {
                statusEl.textContent = 'Chat not initialized';
                statusEl.classList.remove('text-green-600');
                statusEl.classList.add('text-red-500');
            }
        }
        
        // Initialize sellerChat if needed
        document.getElementById('init-chat-btn').addEventListener('click', function() {
            const sellerId = document.querySelector('meta[name="user-id"]')?.content;
            const sellerName = document.querySelector('meta[name="user-name"]')?.content;
            
            if (!window.sellerChat && sellerId) {
                window.sellerChat = new SellerChat({
                    sellerId: sellerId,
                    sellerName: sellerName
                });
                console.log('Chat initialized manually');
            }
            updateChatStatus();
        });
        
        // Toggle chat window
        document.getElementById('toggle-chat-btn').addEventListener('click', function() {
            if (window.sellerChat && window.sellerChat.UI) {
                window.sellerChat.UI.toggleChatWindow();
                console.log('Chat window toggled');
            } else {
                console.error('Chat not initialized');
            }
            updateChatStatus();
        });
        
        // Recreate UI
        document.getElementById('recreate-ui-btn').addEventListener('click', function() {
            if (window.sellerChat && window.sellerChat.UI) {
                window.sellerChat.UI._createChatUI();
                window.sellerChat.UI._setupEventListeners();
                console.log('Chat UI recreated');
            } else {
                console.error('Chat not initialized');
            }
            updateChatStatus();
        });
        
        // UI Visibility Fix controls
        document.getElementById('show-container').addEventListener('click', function() {
            const container = document.getElementById('seller-chat-container');
            if (container) {
                container.classList.remove('hidden');
                console.log('Chat container shown');
            }
        });
        
        document.getElementById('hide-container').addEventListener('click', function() {
            const container = document.getElementById('seller-chat-container');
            if (container) {
                container.classList.add('hidden');
                console.log('Chat container hidden');
            }
        });
        
        document.getElementById('show-launcher').addEventListener('click', function() {
            const launcher = document.getElementById('seller-chat-launcher');
            if (launcher) {
                launcher.classList.remove('hidden');
                console.log('Chat launcher shown');
            }
        });
        
        document.getElementById('hide-launcher').addEventListener('click', function() {
            const launcher = document.getElementById('seller-chat-launcher');
            if (launcher) {
                launcher.classList.add('hidden');
                console.log('Chat launcher hidden');
            }
        });
        
        document.getElementById('fix-toggle-state').addEventListener('click', function() {
            if (window.sellerChat && window.sellerChat.UI) {
                const container = document.getElementById('seller-chat-container');
                const launcher = document.getElementById('seller-chat-launcher');
                
                // Determine the correct minimized state based on visibility
                const shouldBeMinimized = container.classList.contains('hidden');
                
                // Fix the state
                window.sellerChat.UI.isMinimized = shouldBeMinimized;
                console.log('Fixed isMinimized state to:', shouldBeMinimized);
                
                // Update the status display
                updateChatStatus();
            } else {
                console.error('Chat not initialized');
            }
        });
        
        // API Test
        document.getElementById('test-api-btn').addEventListener('click', async function() {
            const resultEl = document.getElementById('api-result');
            resultEl.textContent = 'Testing API connection...';
            
            try {
                const response = await fetch('/api/chat.php?action=get_conversations', {
                    method: 'GET',
                    headers: {
                        'Cache-Control': 'no-cache'
                    }
                });
                
                const data = await response.json();
                resultEl.textContent = JSON.stringify(data, null, 2);
                
                if (data.success) {
                    resultEl.classList.add('text-green-800');
                    resultEl.classList.remove('text-red-800');
                } else {
                    resultEl.classList.add('text-red-800');
                    resultEl.classList.remove('text-green-800');
                }
            } catch (error) {
                resultEl.textContent = 'Error: ' + error.message;
                resultEl.classList.add('text-red-800');
                resultEl.classList.remove('text-green-800');
            }
        });
        
        // Socket Test
        document.getElementById('test-socket-btn').addEventListener('click', function() {
            const resultEl = document.getElementById('socket-result');
            resultEl.textContent = 'Testing Socket connection...';
            
            try {
                if (!window.io) {
                    resultEl.textContent = 'Error: Socket.io library not loaded';
                    return;
                }
                
                const socket = io('http://localhost:3000', {
                    reconnectionAttempts: 2,
                    timeout: 5000,
                    transports: ['websocket', 'polling']
                });
                
                socket.on('connect', () => {
                    resultEl.textContent = 'Connected to socket server with ID: ' + socket.id;
                    resultEl.classList.add('text-green-800');
                    resultEl.classList.remove('text-red-800');
                    
                    // Disconnect after successful test
                    setTimeout(() => {
                        socket.disconnect();
                        resultEl.textContent += '\n\nTest complete. Socket disconnected.';
                    }, 2000);
                });
                
                socket.on('connect_error', (err) => {
                    resultEl.textContent = 'Socket connection error: ' + err.message;
                    resultEl.classList.add('text-red-800');
                    resultEl.classList.remove('text-green-800');
                });
                
                socket.on('disconnect', () => {
                    resultEl.textContent += '\nSocket disconnected';
                });
                
                socket.on('error', (err) => {
                    resultEl.textContent += '\nSocket error: ' + err.message;
                });
            } catch (error) {
                resultEl.textContent = 'Error initializing socket: ' + error.message;
                resultEl.classList.add('text-red-800');
                resultEl.classList.remove('text-green-800');
            }
        });
        
        // Check status periodically
        setInterval(updateChatStatus, 2000);
        
        // Initialize chat automatically
        document.addEventListener('DOMContentLoaded', function() {
            const sellerId = document.querySelector('meta[name="user-id"]')?.content;
            const sellerName = document.querySelector('meta[name="user-name"]')?.content;
            
            if (!window.sellerChat && sellerId) {
                setTimeout(() => {
                    window.sellerChat = new SellerChat({
                        sellerId: sellerId,
                        sellerName: sellerName
                    });
                    console.log('Chat auto-initialized');
                    updateChatStatus();
                }, 500);
            }
        });
    </script>
</body>
</html>
