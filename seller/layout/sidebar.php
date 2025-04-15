<?php
$shop_logo = fetch_array("SELECT  * FROM file WHERE id='$seller_shop_logo' LIMIT 1");
?>

<!-- Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-opacity-50 z-40 hidden lg:hidden"></div>

<!-- Sidebar -->
<aside id="seller-sidebar" class="fixed top-0 left-0 h-full w-64 bg-red-700 text-white z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
    <!-- Header with close button for mobile -->
    <!--<div class="flex items-center justify-between p-4 border-b border-red-600 lg:hidden">-->
    <!--    <h2 class="font-bold text-lg">Quản lý bán hàng</h2>-->
    <!--    <button id="sidebar-close" class="w-8 h-8 flex items-center justify-center rounded-full bg-red-800 text-white">-->
    <!--        <i class="las la-times"></i>-->
    <!--    </button>-->
    <!--</div>-->

    <!-- Logo & Shop Info -->
    <div class="p-4 border-b border-red-600 relative">
        <button id="sidebar-close" class="w-8 h-8 absolute right-1 top-1 flex items-center justify-center rounded-full bg-red-800 text-white">
            <i class="las la-times"></i>
        </button>
        <div class="flex flex-col items-center">
            <div class="bg-white p-2 rounded-lg w-4/5 flex justify-center mb-3">
                <a href="/">
                    <img class="max-w-full h-auto" src="/public/uploads/final-ver1.svg" alt="<?= $seller_shop_name ?>">
                </a>
            </div>
            <h3 class="text-base font-semibold"><?= $seller_shop_name ?></h3>
            <p class="text-sm text-white text-opacity-80"><?= $seller_email ?></p>
        </div>
    </div>

    <!-- Search -->
    <div class="p-4">
        <div class="relative">
            <input
                type="text"
                id="menu-search"
                placeholder="Tìm kiếm trong menu"
                class="w-full bg-red-800 text-white placeholder-red-300 placeholder-opacity-75 rounded py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
                onkeyup="menuSearch()">
            <i class="las la-search absolute right-3 top-2.5 text-red-300"></i>
        </div>
    </div>

    <!-- Menu -->
    <nav>
        <ul id="search-menu" class="hidden"></ul>

        <ul id="main-menu" class="text-sm">
            <!-- Dashboard -->
            <li class="menu-item">
                <a href="/seller/index.php" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-home text-xl mr-3"></i>
                    <span><?= tran("Dashboard") ?></span>
                </a>
            </li>

            <!-- Products -->
            <li class="menu-item">
                <a href="#" class="submenu-toggle flex items-center justify-between px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <div class="flex items-center">
                        <i class="las la-shopping-cart text-xl mr-3"></i>
                        <span><?= tran("Products") ?></span>
                    </div>
                    <i class="las la-angle-right text-sm transition-transform duration-200"></i>
                </a>
                <ul class="submenu bg-red-800 overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
                    <li>
                        <a href="/seller/products/index.php" class="flex items-center pl-14 pr-6 py-2 hover:bg-red-600 transition-colors">
                            <span><?= tran("Products") ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Uploads -->
            <li class="menu-item">
                <a href="/seller/uploads" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-folder-open text-xl mr-3"></i>
                    <span><?= tran("Files Manager") ?></span>
                </a>
            </li>

            <!-- Package -->
            <li class="menu-item">
                <a href="#" class="submenu-toggle flex items-center justify-between px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <div class="flex items-center">
                        <i class="las la-shopping-cart text-xl mr-3"></i>
                        <span><?= tran("Package") ?></span>
                    </div>
                    <i class="las la-angle-right text-sm transition-transform duration-200"></i>
                </a>
                <ul class="submenu bg-red-800 overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
                    <li>
                        <a href="/seller/packages/index.php" class="flex items-center pl-14 pr-6 py-2 hover:bg-red-600 transition-colors">
                            <span><?= tran("Packages") ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/seller/packages/payment_list.php" class="flex items-center pl-14 pr-6 py-2 hover:bg-red-600 transition-colors">
                            <span><?= tran("Purchase Packages") ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- POS System -->
            <li class="menu-item">
                <a href="#" class="submenu-toggle flex items-center justify-between px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <div class="flex items-center">
                        <i class="las la-tasks text-xl mr-3"></i>
                        <span>Kho hàng</span>
                    </div>
                    <i class="las la-angle-right text-sm transition-transform duration-200"></i>
                </a>
                <ul class="submenu bg-red-800 overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
                    <li>
                        <a href="/seller/pos/index.php" class="flex items-center pl-14 pr-6 py-2 hover:bg-red-600 transition-colors">
                            <i class="las la-fax mr-2"></i>
                            <span>Thêm sản phẩm</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Orders -->
            <li class="menu-item">
                <a href="/seller/orders/index.php" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-money-bill text-xl mr-3"></i>
                    <span><?= tran("Orders") ?></span>
                </a>
            </li>

            <!-- Shop Setting -->
            <li class="menu-item">
                <a href="/seller/shop/index.php" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-cog text-xl mr-3"></i>
                    <span><?= tran("Shop Setting") ?></span>
                </a>
            </li>

            <!-- Money Withdraw -->
            <li class="menu-item">
                <a href="/seller/withdraw_requests.php" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-money-bill-wave-alt text-xl mr-3"></i>
                    <span><?= tran("Money Withdraw") ?></span>
                </a>
            </li>

            <!-- Money Recharge -->
            <li class="menu-item">
                <a href="/seller/recharge_requests.php" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-money-bill-wave-alt text-xl mr-3"></i>
                    <span><?= tran("Money Recharge") ?></span>
                </a>
            </li>

            <!-- Commission History -->
            <li class="menu-item">
                <a href="/seller/commission_history.php" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-file-alt text-xl mr-3"></i>
                    <span><?= tran("Commission History") ?></span>
                </a>
            </li>

            <!-- Support Ticket -->
            <li class="menu-item">
                <a href="/seller/support_ticket" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-atom text-xl mr-3"></i>
                    <span><?= tran("Support Ticket") ?></span>
                </a>
            </li>

            <!-- Chat -->
            <li class="menu-item">
                <a href="/seller/chat" class="flex items-center px-6 py-3 hover:bg-red-600 border-l-4 border-transparent hover:border-white transition-colors">
                    <i class="las la-comment text-xl mr-3"></i>
                    <span>Tin nhắn và thông báo</span>
                    <span id="sidebar-chat-badge" class="ml-auto hidden px-2 py-0.5 bg-white text-red-700 text-xs rounded-full">0</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- Add margin for the main content to accommodate sidebar on desktop -->
<div class="lg:ml-64 transition-all duration-300 ease-in-out" id="content-wrapper">
    <!-- This div will be empty but will wrap around the content to add margin -->
</div>

<!-- Meta tags for chat functionality -->
<meta name="user-id" content="<?= $seller_id ?>">
<meta name="user-type" content="seller">
<meta name="user-name" content="<?= htmlspecialchars($seller_full_name ?? '') ?>">

<!-- Include Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'shopee-orange': '#ee4d2d',
                    'shopee-light': '#fff0ee',
                    'shopee-yellow': '#faca51',
                    'shopee-red': '#d40000' // Added deeper red color
                }
            }
        }
    }
</script>

<!-- Custom styles for seller sidebar -->
<style>
    .aiz-sidebar {
        background-color: #d40000 !important;
        /* Changed to deeper red */
        color: white !important;
    }

    .aiz-side-nav-icon,
    .aiz-side-nav-text,
    .aiz-side-nav-arrow {
        color: white !important;
    }

    .aiz-side-nav-item a:hover,
    .aiz-side-nav-item.active a {
        background-color: rgba(255, 255, 255, 0.15) !important;
    }

    .aiz-side-nav-item a:hover .aiz-side-nav-text,
    .aiz-side-nav-item.active a .aiz-side-nav-text,
    .aiz-side-nav-item a:hover .aiz-side-nav-icon,
    .aiz-side-nav-item.active a .aiz-side-nav-icon {
        color: white !important;
        opacity: 1 !important;
    }

    .aiz-side-nav-item a {
        border-left: 3px solid transparent;
    }

    .aiz-side-nav-item.active a {
        border-left-color: white !important;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .aiz-side-nav-list.level-2 {
        background-color: #b00000 !important;
        /* Darker red for submenu */
    }

    .badge-danger {
        background-color: white !important;
        color: #d40000 !important;
        /* Deeper red */
    }

    /* Fix for sidebar overlapping content */
    @media (min-width: 1024px) {
        body {
            padding-left: 16rem; /* Same as sidebar width (w-64 = 16rem) */
        }
        
        /* Target the most common content containers */
        .app-content,
        .aiz-main-content,
        .content-container,
        main {
            margin-left: 0 !important; /* Override any other margins */
        }
    }
    
    /* Ensure sidebar is always visible on large screens */
    @media (min-width: 1024px) {
        #seller-sidebar {
            transform: translateX(0) !important;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('seller-sidebar');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        // Listen for the sidebar toggle event from topbar
        document.addEventListener('sidebar-toggle', function() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        });

        // Close button inside sidebar for better UX on mobile
        if (sidebarClose) {
            sidebarClose.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
        }

        // Also support toggling from the original aiz topbar if it exists
        const aizMobileToggler = document.querySelector('.aiz-mobile-toggler');
        if (aizMobileToggler) {
            aizMobileToggler.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            });
        }

        // Force sidebar state on page load based on screen size
        window.addEventListener('load', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Update sidebar state on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Handle submenu toggles
        const submenuToggles = document.querySelectorAll('.submenu-toggle');
        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();

                const parent = this.parentNode;
                const submenu = this.nextElementSibling;
                const icon = this.querySelector('.la-angle-right');

                // Close other submenus
                document.querySelectorAll('.menu-item.active').forEach(item => {
                    if (item !== parent) {
                        const otherSubmenu = item.querySelector('.submenu');
                        const otherIcon = item.querySelector('.la-angle-right');
                        if (otherSubmenu) {
                            otherSubmenu.style.maxHeight = '0px';
                            otherIcon.classList.remove('rotate-90');
                            item.classList.remove('active');
                        }
                    }
                });

                // Toggle this submenu
                if (parent.classList.contains('active')) {
                    submenu.style.maxHeight = '0px';
                    icon.classList.remove('rotate-90');
                    parent.classList.remove('active');
                } else {
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    icon.classList.add('rotate-90');
                    parent.classList.add('active');
                }
            });
        });

        // Set active menu based on current URL
        const currentPath = window.location.pathname;
        document.querySelectorAll('#main-menu a:not(.submenu-toggle)').forEach(link => {
            const href = link.getAttribute('href');
            if (href && href !== '#' && currentPath.includes(href)) {
                link.classList.add('bg-red-600', 'border-white');

                // If it's in a submenu, activate the parent
                const submenuParent = link.closest('.submenu')?.parentNode;
                if (submenuParent) {
                    const toggle = submenuParent.querySelector('.submenu-toggle');
                    const submenu = submenuParent.querySelector('.submenu');
                    const icon = toggle.querySelector('.la-angle-right');

                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    icon.classList.add('rotate-90');
                    submenuParent.classList.add('active');
                }
            }
        });

        // Search menu functionality
        window.menuSearch = function() {
            const searchTerm = document.getElementById('menu-search').value.toLowerCase();
            const mainMenu = document.getElementById('main-menu');
            const searchMenu = document.getElementById('search-menu');

            if (searchTerm.length > 0) {
                mainMenu.classList.add('hidden');
                searchMenu.classList.remove('hidden');

                // Clear previous search results
                searchMenu.innerHTML = '';

                // Clone and filter menu items
                document.querySelectorAll('#main-menu .menu-item').forEach(item => {
                    const text = item.textContent.toLowerCase();

                    if (text.includes(searchTerm)) {
                        const clonedItem = item.cloneNode(true);
                        searchMenu.appendChild(clonedItem);
                    }
                });

                if (searchMenu.children.length === 0) {
                    searchMenu.innerHTML = '<li class="px-6 py-4 text-center text-red-300">No menu items found</li>';
                }
            } else {
                mainMenu.classList.remove('hidden');
                searchMenu.classList.add('hidden');
            }
        };

        // Fix content wrapper to prevent sidebar from covering content
        const contentWrapper = document.getElementById('content-wrapper');
        const mainContent = document.querySelector('.app-content');
        
        // If app-content exists, add margin to prevent sidebar overlap
        if (mainContent && !mainContent.closest('#content-wrapper')) {
            // Move the main content inside our wrapper
            contentWrapper.appendChild(mainContent);
        }
        
        // Or add the class directly to the main content if it exists
        document.querySelectorAll('.app-content, .aiz-main-content').forEach(content => {
            if (content) {
                content.classList.add('lg:ml-64');
            }
        });
    });
</script>