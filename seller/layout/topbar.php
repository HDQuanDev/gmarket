<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/translate.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/livechat.php');
?>

<div class="bg-white border-b border-gray-200 shadow-sm py-3 px-4 lg:px-6">
    <div class="flex items-center justify-between">
        <!-- Left side with sidebar toggle and logo -->
        <div class="flex items-center space-x-4">
            <!-- Sidebar Toggle Button -->
            <button id="sidebar-toggle-btn" class="lg:hidden w-10 h-10 flex items-center justify-center text-red-700 hover:bg-red-50 rounded-md">
                <i class="las la-bars text-2xl"></i>
            </button>
            
            <!-- Print/POS Button -->
            <a href="/seller/pos" target="_blank" class="w-10 h-10 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full transition-colors" title="POS">
                <i class="las la-print text-xl"></i>
            </a>
        </div>
        
        <!-- Right side with user menu and notifications -->
        <div class="flex items-center space-x-3">
            <!-- Language Selector -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center hover:bg-gray-100 rounded-full p-2">
                    <?php if($_SESSION['country']=='en'){ ?>
                        <img src="/public/assets/img/flags/en.png" alt="English" class="h-4">
                    <?php }else if($_SESSION['country']=='vi'){ ?>
                        <img src="/public/assets/img/flags/vn.png" alt="Vietnamese" class="h-4">
                    <?php }else if($_SESSION['country']=='ko'){ ?>
                        <img src="/public/assets/img/flags/kr.png" alt="Korean" class="h-4">
                    <?php }else if($_SESSION['country']=='ja'){ ?>
                        <img src="/public/assets/img/flags/jp.png" alt="Japanese" class="h-4">
                    <?php } ?>
                    <i class="las la-angle-down ml-1 text-sm text-gray-500"></i>
                </button>
                
                <!-- Language Dropdown -->
                <div @click.away="open = false" x-show="open" class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md overflow-hidden z-30 border border-gray-200" x-transition>
                    <a href="javascript:void(0)" data-flag="en" class="flex items-center px-4 py-2 hover:bg-gray-100 <?=$_SESSION['country']=='en'?'bg-gray-50':''?>">
                        <img src="/public/assets/img/flags/en.png" class="h-4 mr-2">
                        <span>English</span>
                    </a>
                    <a href="javascript:void(0)" data-flag="vn" class="flex items-center px-4 py-2 hover:bg-gray-100 <?=$_SESSION['country']=='vi'?'bg-gray-50':''?>">
                        <img src="/public/assets/img/flags/vn.png" class="h-4 mr-2">
                        <span>Vietnam</span>
                    </a>
                </div>
            </div>
            
            <!-- User Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 hover:bg-gray-100 rounded-full p-1.5">
                    <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden">
                        <img src="/public/assets/img/avatar-place.png" alt="<?=$seller_full_name?>" class="w-full h-full object-cover">
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium text-gray-700"><?=$seller_full_name?></p>
                        <p class="text-xs text-gray-500">Người bán hàng</p>
                    </div>
                    <i class="las la-angle-down text-gray-500"></i>
                </button>
                
                <!-- User Dropdown Menu -->
                <div @click.away="open = false" x-show="open" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md overflow-hidden z-30 border border-gray-200" x-transition>
                    <a href="/seller/shop/profile.php" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <i class="las la-user-circle text-lg text-gray-600 mr-2"></i>
                        <span><?=tran("Profile")?></span>
                    </a>
                    <a href="/logout" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <i class="las la-sign-out-alt text-lg text-gray-600 mr-2"></i>
                        <span><?=tran("Logout")?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Make sure Alpine.js is available
if (typeof window.Alpine === 'undefined') {
    document.write('<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer><\/script>');
}

// Add language selector functionality
document.addEventListener('DOMContentLoaded', function() {
    const langLinks = document.querySelectorAll('[data-flag]');
    langLinks.forEach(link => {
        link.addEventListener('click', function() {
            const flag = this.getAttribute('data-flag');
            // Set cookie and redirect
            document.cookie = "lang=" + flag + "; path=/";
            window.location.reload();
        });
    });
    
    // Link the topbar toggle button to the sidebar
    const topbarToggleBtn = document.getElementById('sidebar-toggle-btn');
    if (topbarToggleBtn) {
        topbarToggleBtn.addEventListener('click', function() {
            // Trigger the sidebar toggle
            const sidebarToggleEvent = new Event('sidebar-toggle');
            document.dispatchEvent(sidebarToggleEvent);
        });
    }
});
</script>