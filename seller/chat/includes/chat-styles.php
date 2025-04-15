<?php
/**
 * CSS styles for chat interface - Enhanced mobile-specific fixes
 */
?>
<style>
    /* Fix for iOS viewport height issue */
    :root {
        --vh: 1vh;
    }
    
    /* Force the body and html to full height */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Prevent horizontal scrolling */
        width: 100%;
    }
    
    /* Force container to take full height */
    .chat-app-container,
    #seller-chat-container {
        min-height: 100%;
        width: 100%;
    }
    
    /* Custom animations and dynamic elements */
    .typing-animation .dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        margin-right: 3px;
        background-color: #9ca3af;
        animation: typing-dot 1.5s infinite ease-in-out;
    }
    
    .typing-animation .dot:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .typing-animation .dot:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    @keyframes typing-dot {
        0%, 60%, 100% { transform: initial; }
        30% { transform: translateY(-4px); }
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }
    
    /* Transition animation for mobile sidebar */
    #conversations-sidebar {
        will-change: transform;
    }
    
    /* Fix for iOS devices where 100vh doesn't work correctly */
    @supports (-webkit-touch-callout: none) {
        .h-screen {
            height: calc(var(--vh, 1vh) * 100);
        }
        .h-\[calc\(100vh-60px\)\] {
            height: calc(var(--vh, 1vh) * 100 - 60px) !important;
        }
        .h-\[calc\(100vh-12rem\)\] {
            height: calc(var(--vh, 1vh) * 100 - 12rem) !important;
        }
    }
    
    /* Specifically target mobile devices */
    @media (max-width: 767px) {
        /* Fixed height for the container */
        .h-\[calc\(100vh-12rem\)\] {
            height: calc(100vh - 6rem) !important;
            max-height: none !important;
        }
        
        /* Fix chat area to be full width on mobile */
        #conversation-area {
            width: 100% !important;
        }
        
        /* Ensure the sidebar takes full height and width */
        #conversations-sidebar {
            height: 100% !important;
            width: 100% !important;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        
        /* Ensure chat containers have correct height */
        #chat-content, 
        #no-conversation-selected {
            top: 50px !important; /* Account for the mobile header */
        }
        
        /* Ensure correct positioning for overlays */
        #sidebar-overlay {
            position: fixed;
            inset: 0;
        }
        
        /* Fix the attachment preview to fit mobile */
        #attachment-preview img {
            max-width: 100%;
            max-height: 150px;
        }
        
        /* Fix for mobile keyboard pushing content */
        .keyboard-open {
            max-height: calc(100vh - 250px) !important;
        }
        
        /* Ensure message bubbles are properly sized */
        .message-bubble {
            max-width: 85% !important;
            word-break: break-word;
        }
    }
    
    /* Fix issue with conversations list scrolling */
    #conversations-list {
        height: auto;
        flex: 1 1 auto;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Fix for flex display issues on some mobile browsers */
    .flex {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }
    
    .flex-col {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }
    
    /* Mobile-first approach for common elements */
    button, input, textarea {
        -webkit-appearance: none;
        border-radius: 0;
        font-size: 16px; /* Prevent iOS zoom on focus */
    }
    
    /* Fix for iOS textarea resizing */
    textarea {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    
    /* Force the sidebar to properly translate */
    .translate-x-0 {
        -webkit-transform: translateX(0) !important;
        transform: translateX(0) !important;
    }
    
    .-translate-x-full {
        -webkit-transform: translateX(-100%) !important;
        transform: translateX(-100%) !important;
    }
    
    /* Ensure transitions work properly */
    .transition-transform {
        -webkit-transition-property: -webkit-transform;
        transition-property: transform;
        transition-property: transform, -webkit-transform;
    }
</style>
