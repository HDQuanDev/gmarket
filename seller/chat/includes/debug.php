<?php
/**
 * Debug helper for chat styling issues
 */
?>

<!-- Add this button to the chat interface for debugging -->
<button id="debug-toggle-button" class="fixed top-2 right-2 bg-red-500 text-white px-2 py-1 rounded z-50" style="display: none;">
    Debug CSS
</button>

<script>
// Add a debug mode toggle in development environments
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    document.addEventListener('DOMContentLoaded', function() {
        const debugButton = document.getElementById('debug-toggle-button');
        debugButton.style.display = 'block';
        
        // Toggle debug mode
        let debugMode = false;
        debugButton.addEventListener('click', function() {
            debugMode = !debugMode;
            toggleDebugMode(debugMode);
            debugButton.textContent = debugMode ? 'Hide Debug' : 'Debug CSS';
            debugButton.classList.toggle('bg-green-500', debugMode);
            debugButton.classList.toggle('bg-red-500', !debugMode);
        });
        
        function toggleDebugMode(active) {
            const messages = document.querySelectorAll('.message');
            messages.forEach(msg => {
                if (active) {
                    msg.style.outline = '1px solid red';
                    msg.querySelector('.flex').style.outline = '1px solid blue';
                    msg.querySelector('.message-bubble').style.outline = '1px solid green';
                } else {
                    msg.style.outline = '';
                    msg.querySelector('.flex').style.outline = '';
                    msg.querySelector('.message-bubble').style.outline = '';
                }
            });
            
            // Log information about message dimensions
            if (active) {
                console.log('Debug information:');
                messages.forEach((msg, i) => {
                    const flex = msg.querySelector('.flex');
                    const bubble = msg.querySelector('.message-bubble');
                    console.log(`Message #${i+1}:`);
                    console.log('- Type:', msg.classList.contains('sent') ? 'sent' : 'received');
                    console.log('- Message width:', msg.offsetWidth);
                    console.log('- Flex width:', flex.offsetWidth);
                    console.log('- Bubble width:', bubble.offsetWidth);
                });
            }
        }
    });
}
</script>
