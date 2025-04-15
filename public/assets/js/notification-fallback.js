/**
 * Emergency fallback for demo notification
 * This script will load the notification directly if other methods fail
 */
(function() {
    console.log('Using fallback notification loader');
    
    // First try to load the script normally
    fetch('/public/assets/js/demo-notification.js?' + Date.now())
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(code => {
            // Execute the script
            const script = document.createElement('script');
            script.textContent = code;
            document.head.appendChild(script);
        })
        .catch(error => {
            console.error('Error loading notification script:', error);
            
            // On failure, use an inline version as absolute last resort
            const script = document.createElement('script');
            script.src = '/public/assets/js/demo-notification.js?' + Math.random().toString(36).substring(2, 15);
            script.onerror = function() {
                alert('This is a demo website. The notification system could not be loaded.');
            };
            document.head.appendChild(script);
        });
})();
