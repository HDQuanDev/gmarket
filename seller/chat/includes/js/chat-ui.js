/**
 * UI Interactions for the chat interface
 * Enhanced with improved UI functionality
 */

// Set up event listeners with improved mobile support
function setupEventListeners() {
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const attachmentButton = document.getElementById('attachment-button');
    const attachmentInput = document.getElementById('attachment-input');
    const removeAttachment = document.getElementById('remove-attachment');
    const conversationSearch = document.getElementById('conversation-search');
    
    // Auto-resize textarea
    if (messageInput) {
        messageInput.addEventListener('input', function() {
            // Reset height to auto to get the right scrollHeight
            this.style.height = 'auto';
            // Set new height based on scrollHeight, with a max of 120px
            const newHeight = Math.min(this.scrollHeight, 120);
            this.style.height = `${newHeight}px`;
            
            // Handle typing status
            handleTypingIndicator(this.value.trim().length > 0);
        });
        
        // Focus and blur events to handle mobile keyboard better
        messageInput.addEventListener('focus', function() {
            // Scroll the messages container to bottom when input is focused
            setTimeout(scrollToBottom, 300); // Slight delay to allow keyboard to show
            
            // On mobile, add a class to the message container to adjust its height
            if (window.innerWidth < 768) {
                document.getElementById('messages-container').classList.add('keyboard-open');
            }
        });
        
        messageInput.addEventListener('blur', function() {
            // Remove the keyboard-open class when input loses focus
            document.getElementById('messages-container').classList.remove('keyboard-open');
        });
    }
    
    // Message form submission with touch optimization
    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = messageInput.value.trim();
            
            if (message || window.selectedAttachment) {
                // Disable submit button to prevent double send on mobile
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                
                sendMessage(message, window.selectedAttachment);
                messageInput.value = '';
                messageInput.style.height = 'auto';
                clearAttachmentPreview();
                
                // Re-enable the button after a short delay
                setTimeout(() => {
                    submitBtn.disabled = false;
                    messageInput.focus();
                }, 300);
            }
        });
    }
    
    // Attachment handling for mobile
    if (attachmentButton && attachmentInput) {
        attachmentButton.addEventListener('click', function() {
            // Add active state visual feedback for touch devices
            this.classList.add('bg-gray-300');
            setTimeout(() => {
                this.classList.remove('bg-gray-300');
            }, 200);
            
            attachmentInput.click();
        });
    }
    
    // Attachment input change with better mobile support
    if (attachmentInput) {
        attachmentInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                // For mobile, check file size more strictly
                const file = this.files[0];
                
                if (file.size > 3 * 1024 * 1024 && window.innerWidth < 768) {
                    // Stricter limit on mobile due to bandwidth concerns
                    showToast('File quá lớn. Giới hạn 3MB trên thiết bị di động', 'error');
                    this.value = '';
                    return;
                }
                
                showAttachmentPreview(file);
            }
        });
    }
    
    // Enter to send (Shift+Enter for new line) with mobile optimization
    if (messageInput) {
        messageInput.addEventListener('keydown', function(e) {
            // Only handle enter key on desktop, mobile usually has a send button on keyboard
            if (window.innerWidth >= 768 && e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                messageForm.dispatchEvent(new Event('submit'));
            }
        });
    }
    
    // Touch-optimized conversation search
    if (conversationSearch) {
        conversationSearch.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();
            filterConversations(searchTerm);
        });
        
        // Clear search button for mobile
        const searchContainer = conversationSearch.parentElement;
        const clearButton = document.createElement('button');
        clearButton.type = 'button';
        clearButton.className = 'absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 hidden';
        clearButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
        `;
        
        conversationSearch.addEventListener('input', function() {
            clearButton.style.display = this.value ? 'block' : 'none';
        });
        
        clearButton.addEventListener('click', function() {
            conversationSearch.value = '';
            conversationSearch.dispatchEvent(new Event('input'));
            this.style.display = 'none';
        });
        
        searchContainer.appendChild(clearButton);
    }
    
    // Connection status animation
    animateConnectionStatus();
    
    // Add viewport height adjustment on resize and orientation change
    window.addEventListener('resize', updateMobileViewportHeight);
    window.addEventListener('orientationchange', function() {
        // Small delay to ensure orientation change completes
        setTimeout(updateMobileViewportHeight, 300);
    });
    
    // Run once on load
    updateMobileViewportHeight();
}

// Filter conversations based on search term
function filterConversations(searchTerm) {
    const conversations = document.querySelectorAll('.conversation-item');
    
    if (conversations.length === 0) return;
    
    if (!searchTerm) {
        // If search is empty, show all conversations
        conversations.forEach(conv => {
            conv.classList.remove('hidden');
        });
        return;
    }
    
    // Filter conversations based on name and last message
    conversations.forEach(conv => {
        const username = conv.getAttribute('data-user-name').toLowerCase();
        const lastMessage = conv.querySelector('.text-sm')?.textContent.toLowerCase() || '';
        
        if (username.includes(searchTerm) || lastMessage.includes(searchTerm)) {
            conv.classList.remove('hidden');
        } else {
            conv.classList.add('hidden');
        }
    });
}

// Show attachment preview with improved UI
function showAttachmentPreview(file) {
    if (!file.type.startsWith('image/')) {
        showToast('Chỉ hỗ trợ file hình ảnh', 'error');
        return;
    }
    
    if (file.size > 5 * 1024 * 1024) {
        showToast('Kích thước file quá lớn (tối đa 5MB)', 'error');
        return;
    }
    
    const previewContainer = document.getElementById('attachment-preview');
    const previewImage = document.getElementById('attachment-image');
    
    if (previewImage) {
        previewImage.src = URL.createObjectURL(file);
        previewImage.onload = () => URL.revokeObjectURL(previewImage.src);
    }
    
    previewContainer.classList.remove('hidden');
    previewContainer.classList.add('fade-in');
    window.selectedAttachment = file;
}

// Clear attachment preview with animation
function clearAttachmentPreview() {
    const previewContainer = document.getElementById('attachment-preview');
    const attachmentInput = document.getElementById('attachment-input');
    
    previewContainer.classList.add('hidden');
    
    // Clear after animation completes
    setTimeout(() => {
        if (attachmentInput) attachmentInput.value = '';
        window.selectedAttachment = null;
    }, 300);
}

// Highlight selected conversation with animation
function highlightSelectedConversation(conversationId) {
    document.querySelectorAll('.conversation-item').forEach(item => {
        const isSelected = item.getAttribute('data-id') === conversationId.toString();
        
        // Remove existing selected class from all items
        item.classList.remove('bg-blue-50');
        
        if (isSelected) {
            // Add selected class with animation
            item.classList.add('bg-blue-50');
            
            // Scroll into view if needed
            item.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            
            // Remove unread marker
            item.classList.remove('bg-yellow-50');
            const badge = item.querySelector('.bg-red-500');
            if (badge) badge.remove();
        }
    });
}

// Mobile-optimized toast notification
function showToast(message, type = 'info') {
    // Remove existing toast
    const existingToast = document.getElementById('chat-toast');
    if (existingToast) {
        document.body.removeChild(existingToast);
    }
    
    // Create new toast with better mobile positioning
    const toast = document.createElement('div');
    toast.id = 'chat-toast';
    toast.className = `fixed ${window.innerWidth < 768 ? 'top-4' : 'bottom-4'} left-1/2 transform -translate-x-1/2 px-4 py-3 rounded-md shadow-lg text-white z-50 ${
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    } transition-opacity duration-300 opacity-0 max-w-[90%]`;
    toast.textContent = message;
    
    // Add to body
    document.body.appendChild(toast);
    
    // Show with animation
    requestAnimationFrame(() => {
        toast.classList.remove('opacity-0');
    });
    
    // Auto hide after 3 seconds
    setTimeout(() => {
        toast.classList.add('opacity-0');
        
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 300);
    }, 3000);
}

// Open image viewer with improved mobile support
function openImageViewer(imageUrl) {
    // Create modal if it doesn't exist
    let modal = document.getElementById('image-viewer-modal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'image-viewer-modal';
        modal.className = 'fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-90 opacity-0 transition-opacity duration-300';
        modal.innerHTML = `
            <button id="close-modal-btn" class="absolute top-4 right-4 text-white text-3xl p-2 hover:opacity-80 touch-manipulation">×</button>
            <img id="modal-image" alt="Enlarged image" class="max-w-[90%] max-h-[90vh] object-contain transform scale-95 transition-transform duration-300" draggable="false">
        `;
        document.body.appendChild(modal);
        
        // Close when clicking on backdrop or button
        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.id === 'close-modal-btn') {
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.style.display = 'none';
                    document.body.classList.remove('overflow-hidden'); // Allow scrolling again
                }, 300);
            }
        });
        
        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display !== 'none') {
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.style.display = 'none';
                    document.body.classList.remove('overflow-hidden'); // Allow scrolling again
                }, 300);
            }
        });
        
        // Mobile optimization - add swipe down to close
        let startY = 0;
        let distY = 0;
        
        modal.addEventListener('touchstart', function(e) {
            startY = e.touches[0].clientY;
        }, { passive: true });
        
        modal.addEventListener('touchmove', function(e) {
            distY = e.touches[0].clientY - startY;
            
            if (distY > 0) {
                // Only allow downward swipe
                const scale = 1 - Math.min(distY / 400, 0.3);
                const opacity = 1 - Math.min(distY / 400, 0.7);
                document.getElementById('modal-image').style.transform = `scale(${scale})`;
                modal.style.backgroundColor = `rgba(0, 0, 0, ${opacity})`;
                e.preventDefault();
            }
        });
        
        modal.addEventListener('touchend', function() {
            if (distY > 100) {
                // Close if dragged down enough
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.style.display = 'none';
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            } else {
                // Reset position
                document.getElementById('modal-image').style.transform = `scale(1)`;
                modal.style.backgroundColor = `rgba(0, 0, 0, 0.9)`;
            }
            
            startY = 0;
            distY = 0;
        });
    }
    
    // Set image source and display with animation
    document.getElementById('modal-image').src = imageUrl;
    document.body.classList.add('overflow-hidden'); // Prevent body scrolling
    modal.style.display = 'flex';
    
    // Force reflow to make sure transition works
    modal.offsetWidth;
    
    modal.classList.remove('opacity-0');
    
    // Scale up the image
    setTimeout(() => {
        document.getElementById('modal-image').classList.remove('scale-95');
        document.getElementById('modal-image').style.transform = 'scale(1)';
    }, 50);
}

// Animate connection status
function animateConnectionStatus() {
    const statusEl = document.getElementById('connection-status');
    if (!statusEl) return;
    
    // Set initial class based on connection state
    if (window.chatState?.socket?.connected) {
        statusEl.classList.add('connected');
        statusEl.textContent = 'Đã kết nối';
    } else {
        statusEl.classList.add('disconnected');
        statusEl.textContent = 'Mất kết nối';
    }
}

// Update connection status with animation
function updateConnectionStatusUI(isConnected) {
    const statusEl = document.getElementById('connection-status');
    if (!statusEl) return;
    
    // Update status element
    if (isConnected) {
        statusEl.classList.remove('disconnected');
        statusEl.classList.add('connected');
        statusEl.textContent = 'Đã kết nối';
    } else {
        statusEl.classList.remove('connected');
        statusEl.classList.add('disconnected');
        statusEl.textContent = 'Mất kết nối';
    }
    
    // Flashing animation for status change
    statusEl.classList.add('animate-pulse');
    setTimeout(() => {
        statusEl.classList.remove('animate-pulse');
    }, 1500);
    
    // Update conversation status if active
    const chatUserStatus = document.getElementById('chat-user-status');
    if (chatUserStatus && window.chatState?.currentConversation) {
        chatUserStatus.textContent = isConnected ? 'Đang hoạt động' : 'Ngoại tuyến';
        chatUserStatus.className = `text-xs ${isConnected ? 'text-green-500' : 'text-gray-500'}`;
    }
}

// Update mobile viewport height for iOS
function updateMobileViewportHeight() {
    // This is important for iOS where 100vh doesn't account for browser chrome
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

// Initialize UI elements once DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
});
