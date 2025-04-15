<?php
$footer_setting = fetch_array("SELECT * FROM website_footer LIMIT 1");
?>

<!-- Modern Features Section with Tailwind -->
<section class="bg-white py-10 border-t border-gray-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Fast Delivery -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 group">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-shopee-50 rounded-full flex items-center justify-center mb-5 group-hover:bg-shopee-100 transition-colors">
                        <i class="fa-solid fa-truck-fast text-2xl text-shopee-500"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Fast Delivery</h3>
                    <p class="text-gray-600 text-sm">Quick shipping from Korea directly to your doorstep</p>
                </div>
            </div>

            <!-- Secure Payment -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 group">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-5 group-hover:bg-green-100 transition-colors">
                        <i class="fa-solid fa-shield-halved text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Secure Payment</h3>
                    <p class="text-gray-600 text-sm">Multiple payment options with enhanced security</p>
                </div>
            </div>

            <!-- 24/7 Support -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 group">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-5 group-hover:bg-blue-100 transition-colors">
                        <i class="fa-solid fa-headset text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">24/7 Support</h3>
                    <p class="text-gray-600 text-sm">Dedicated service team ready to assist anytime</p>
                </div>
            </div>

            <!-- Easy Returns -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 group">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-5 group-hover:bg-red-100 transition-colors">
                        <i class="fa-solid fa-rotate-left text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Easy Returns</h3>
                    <p class="text-gray-600 text-sm">Hassle-free 30-day return policy guarantee</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Main Footer -->
<footer class="bg-gray-900 pt-16 pb-6">
    <div class="container mx-auto px-4">
        <!-- Company Information Section -->
        <div class="pt-8 pb-6">
            <div class="max-w-4xl mx-auto text-gray-400 text-sm leading-relaxed">
                <div class="flex justify-center mb-6">
                    <img src="/public/uploads/final-ver1.svg" alt="Takashimaya VN" class="h-12">
                </div>
                <p class="text-center mb-4">
                    Công ty TNHH Takashimaya Việt Nam thành lập và hoạt động theo Giấy Chứng Nhận Đăng Ký Doanh Nghiệp số 0312505165 do Sở kế hoạch và đầu tư Thành phố Hồ Chí Minh<br class="hidden md:block">
                    cấp lần đầu vào ngày 13 tháng 09 năm 2023, địa chỉ tại Saigon Centre, số 65, đường Lê Lợi, Phường Bến Nghé, Quận 1, Thành phố Hồ Chí Minh, Việt Nam. 
                </p>
                
                <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 mb-4">
                    <a href="tel:+842838278555" class="text-shopee-500 hover:text-shopee-400 transition-colors flex items-center">
                        <i class="fa-solid fa-phone mr-2"></i> (028) 3827-8555
                    </a>
                    <span class="hidden md:inline text-gray-600">|</span>
                    <a href="mailto:online@takashimaya-vn.com.vn" class="text-shopee-500 hover:text-shopee-400 transition-colors flex items-center">
                        <i class="fa-solid fa-envelope mr-2"></i> online@takashimaya-vn.com.vn
                    </a>
                    <span class="hidden md:inline text-gray-600">|</span>
                    <a href="https://takashimayavn.com" class="text-shopee-500 hover:text-shopee-400 transition-colors flex items-center">
                        <i class="fa-solid fa-globe mr-2"></i> takashimayavn.com
                    </a>
                </div>
                
                <p class="text-center mb-4">
                    Bản quyền thuộc Takashimaya Việt Nam.<br class="md:hidden">
                    Website: <a href="https://takashimayavn.com" class="text-shopee-500 hover:text-shopee-400 transition-colors">takashimayavn.com</a> 
                    thuộc quyền sở hữu của Công ty TNHH Takashimaya Việt Nam và được phát triển bởi Teko.
                </p>
                
                <div class="flex flex-wrap justify-center items-center mt-6">
                    <a href="#" target="_blank" rel="noreferrer noopener" class="mx-4 transform hover:scale-105 transition-transform">
                        <img alt="Đã đăng ký Bộ Công Thương" title="Đã đăng ký Bộ Công Thương" src="https://shopfront-cdn.tekoapis.com/common/da-dang-ky.png" class="h-16 inline-block">
                    </a>
                    <a href="#" target="_blank" rel="noreferrer noopener" class="mx-4 transform hover:scale-105 transition-transform">
                        <img alt="Đã đăng ký Bộ Công Thương" title="Đã đăng ký Bộ Công Thương" src="https://shopfront-cdn.tekoapis.com/common/da-dang-ky.png" class="h-16 inline-block">
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                <a href="/shops/create.php" class="inline-flex items-center px-5 py-2 bg-shopee-500 hover:bg-shopee-600 text-white rounded-full text-sm font-medium transition-colors">
                    <i class="fa-solid fa-store mr-2"></i> <?= tran("Become a Seller") ?>
                </a>
            </div>
            <div class="text-gray-500 text-sm">
                &copy; <?= date('Y') ?> Takashimaya. <?= tran("All Rights Reserved") ?>
            </div>
        </div>
    </div>
</footer>

<!-- Content Padding for Mobile Navigation -->
<div class="lg:hidden h-16 w-full"><!-- Spacer to prevent content from being hidden behind mobile nav --></div>

<!-- Modern Mobile Navigation -->
<div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white shadow-[0_-2px_10px_rgba(0,0,0,0.1)] z-50 border-t border-gray-200">
    <div class="grid grid-cols-5 gap-1">
        <!-- Home -->
        <a href="/" class="flex flex-col items-center justify-center py-2 <?= $_SERVER['REQUEST_URI'] == '/' ? 'text-shopee-500' : 'text-gray-600' ?>">
            <i class="fa-solid fa-home text-xl"></i>
            <span class="text-xs mt-1">Home</span>
        </a>

        <!-- Categories -->
        <a href="/categories" class="flex flex-col items-center justify-center py-2 <?= strpos($_SERVER['REQUEST_URI'], '/categories') === 0 ? 'text-shopee-500' : 'text-gray-600' ?>">
            <i class="fa-solid fa-th-large text-xl"></i>
            <span class="text-xs mt-1">Categories</span>
        </a>

        <!-- Cart in the middle -->
        <a href="/cart" class="relative flex flex-col items-center justify-center py-2 <?= strpos($_SERVER['REQUEST_URI'], '/cart') === 0 ? 'text-shopee-500' : 'text-gray-600' ?>">
            <i class="fa-solid fa-shopping-bag text-xl"></i>
            <span class="text-xs mt-1">Cart</span>
            <?php if ($count_cart > 0): ?>
                <span class="absolute top-0 right-1/4 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full"><?= $count_cart > 9 ? '9+' : $count_cart ?></span>
            <?php endif; ?>
        </a>

        <!-- Settings - Link to dedicated settings page -->
        <a href="/settings.php" class="flex flex-col items-center justify-center py-2 <?= strpos($_SERVER['REQUEST_URI'], '/settings.php') === 0 ? 'text-shopee-500' : 'text-gray-600' ?>">
            <i class="fa-solid fa-cog text-xl"></i>
            <span class="text-xs mt-1">Settings</span>
        </a>

        <!-- Account -->
        <?php if ($isLogin): ?>
        <a href="/purchase_history" class="flex flex-col items-center justify-center py-2 <?= strpos($_SERVER['REQUEST_URI'], '/purchase_history') === 0 || strpos($_SERVER['REQUEST_URI'], '/dashboard') === 0 ? 'text-shopee-500' : 'text-gray-600' ?>">
            <i class="fa-solid fa-user text-xl"></i>
            <span class="text-xs mt-1">Account</span>
        </a>
        <?php else: ?>
        <a href="/users/login" class="flex flex-col items-center justify-center py-2 <?= strpos($_SERVER['REQUEST_URI'], '/users/login') === 0 ? 'text-shopee-500' : 'text-gray-600' ?>">
            <i class="fa-solid fa-user text-xl"></i>
            <span class="text-xs mt-1"><?= tran("Account") ?></span>
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- Modern Cookie Alert -->
<div class="fixed bottom-20 lg:bottom-8 left-4 right-4 md:left-auto md:right-8 md:max-w-sm bg-white shadow-xl rounded-xl overflow-hidden z-50 border border-gray-200 aiz-cookie-alert" style="display: none;">
    <div class="p-4">
        <div class="mb-3">
            <h3 class="text-gray-800 font-bold text-lg mb-2"><?= tran("Cookies Consent") ?></h3>
            <p class="text-gray-600 text-sm"><?= tran("We use cookies to enhance your experience. By continuing to browse, you agree to our") ?> <a href="/privacy-policy" class="text-shopee-500 hover:text-shopee-600"><?= tran("Privacy Policy") ?></a>.</p>
        </div>
        <div class="flex justify-end">
            <button class="aiz-cookie-accept bg-shopee-500 hover:bg-shopee-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                <?= tran("Accept & Continue") ?>
            </button>
        </div>
    </div>
</div>

<script>
    // AJAX Search Implementation
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile language switcher functionality
        function updateMobileLanguage(lang) {
            if (document.getElementById('mobile-current-language')) {
                document.getElementById('mobile-current-language').textContent = lang === 'vi' ? 'Vietnamese' : 'USA';
            }
        }
        
        // Initialize mobile language display
        function initMobileLanguageDisplay() {
            const currentLang = detectCurrentLanguage();
            updateMobileLanguage(currentLang);
            
            // Also update the header flag in case we're loading the page fresh
            if (document.getElementById('current-language-flag')) {
                document.getElementById('current-language-flag').src = currentLang === 'vi' ? 
                    'https://cdn.shopify.com/static/images/flags/vn.svg?width=32' : 
                    'https://cdn.shopify.com/static/images/flags/us.svg?width=32';
                
                document.getElementById('current-language').textContent = currentLang === 'vi' ? 'Vietnamese' : 'USA';
            }
        }
        
        // Call initialization after a short delay to ensure language detection works
        setTimeout(initMobileLanguageDisplay, 500);
        
        // Make updateMobileLanguage function globally available
        window.updateMobileLanguage = function(lang) {
            const langText = lang === 'vi' ? 'Vietnamese' : 'USA';
            
            // Update mobile language display
            if (document.getElementById('mobile-current-language')) {
                document.getElementById('mobile-current-language').textContent = langText;
            }
            
            // Update header language display
            if (document.getElementById('current-language-flag')) {
                document.getElementById('current-language-flag').src = lang === 'vi' ? 
                    'https://cdn.shopify.com/static/images/flags/vn.svg?width=32' : 
                    'https://cdn.shopify.com/static/images/flags/us.svg?width=32';
                
                document.getElementById('current-language').textContent = langText;
            }
        };

        // Rest of the existing search functionality
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');
        const searchResultsContent = document.getElementById('search-results-content');
        const searchLoading = document.getElementById('search-loading');

        // Only proceed if all necessary elements exist
        if (searchInput && searchResults && searchResultsContent && searchLoading) {
            let searchTimeout;
            let currentSearchTerm = '';

            // Show/hide search results
            searchInput.addEventListener('focus', function() {
                if (searchInput.value.trim().length >= 2) {
                    searchResults.classList.add('active');
                }
            });

            // Hide search results when clicking outside
            document.addEventListener('click', function(event) {
                if (!searchResults.contains(event.target) && event.target !== searchInput) {
                    searchResults.classList.remove('active');
                }
            });

            // Search on input
            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.trim();

                // Clear previous timeout
                clearTimeout(searchTimeout);

                if (searchTerm.length < 2) {
                    searchResults.classList.remove('active');
                    return;
                }

                if (searchTerm === currentSearchTerm) {
                    searchResults.classList.add('active');
                    return;
                }

                // Show loading state
                searchResults.classList.add('active');
                searchLoading.style.display = 'block';
                searchResultsContent.innerHTML = '';

                // Delay search to avoid excessive requests
                searchTimeout = setTimeout(function() {
                    fetchSearchResults(searchTerm);
                }, 300);
            });

            // Function to fetch search results
            function fetchSearchResults(term) {
                fetch(`/ajax-search.php?q=${encodeURIComponent(term)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        searchLoading.style.display = 'none';
                        renderSearchResults(data, term);
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        searchLoading.style.display = 'none';
                        searchResultsContent.innerHTML = `
                        <div class="search-no-results">
                            <i class="las la-exclamation-circle text-2xl text-red-500 mb-2"></i>
                            <p>An error occurred. Please try again.</p>
                        </div>
                    `;
                    });
            }

            // Function to render search results
            function renderSearchResults(data, term) {
                if ((data.products && data.products.length > 0) || (data.sellers && data.sellers.length > 0) || (data.categories && data.categories.length > 0)) {
                    let html = '';

                    // Products section
                    if (data.products && data.products.length > 0) {
                        html += '<div class="search-results-section">';
                        html += '<div class="search-results-header">Products</div>';

                        data.products.forEach(product => {
                            html += `
                        <a href="/product/${product.id}" class="search-results-item">
                            <div class="search-item-image">
                                <img src="${product.image || '/public/assets/img/placeholder.jpg'}" alt="${product.name}" onerror="this.src='/public/assets/img/placeholder.jpg'">
                            </div>
                            <div class="search-item-info">
                                <div class="search-item-title">${product.name}</div>
                                <div class="search-item-subtitle">${product.category_name || ''}</div>
                            </div>
                            <div class="search-item-price">${formatPrice(product.price)}</div>
                        </a>`;
                        });

                        html += '</div>';
                    }

                    // Sellers section
                    if (data.sellers && data.sellers.length > 0) {
                        html += '<div class="search-results-section">';
                        html += '<div class="search-results-header">Shops</div>';

                        data.sellers.forEach(seller => {
                            html += `
                        <a href="/shop.php?id=${seller.id}" class="search-results-item">
                            <div class="search-item-image">
                                <img src="${seller.logo || '/public/assets/img/placeholder.jpg'}" alt="${seller.name}" onerror="this.src='/public/assets/img/placeholder.jpg'">
                            </div>
                            <div class="search-item-info">
                                <div class="search-item-title">${seller.name}</div>
                                <div class="search-item-subtitle">${seller.product_count || 0} products</div>
                            </div>
                        </a>`;
                        });

                        html += '</div>';
                    }

                    // Categories section
                    if (data.categories && data.categories.length > 0) {
                        html += '<div class="search-results-section">';
                        html += '<div class="search-results-header">Categories</div>';

                        data.categories.forEach(category => {
                            html += `
                        <a href="/category/${category.path}" class="search-results-item">
                            <div class="search-item-image">
                                <img src="${category.image || '/public/assets/img/placeholder.jpg'}" alt="${category.name}" onerror="this.src='/public/assets/img/placeholder.jpg'">
                            </div>
                            <div class="search-item-info">
                                <div class="search-item-title">${category.name}</div>
                                <div class="search-item-subtitle">${category.product_count || 0} products</div>
                            </div>
                        </a>`;
                        });

                        html += '</div>';
                    }

                    // View all results footer
                    html += `
                <div class="search-footer">
                    <a href="/search?q=${encodeURIComponent(term)}" class="search-view-all">
                        View All Results
                    </a>
                </div>`;

                    searchResultsContent.innerHTML = html;

                } else {
                    // No results found
                    searchResultsContent.innerHTML = `
                <div class="search-no-results">
                    <i class="las la-search text-2xl mb-2 text-gray-400"></i>
                    <p>No results found for "${term}"</p>
                    <p class="text-sm text-gray-500 mt-1">Try different or more general keywords</p>
                </div>`;
                }
            }
        }

        // Format price with thousand separator - keep this outside as it might be used elsewhere
        function formatPrice(price) {
            return (parseFloat(price)).toLocaleString('vi-VN') + ' đ';
        }
    });

    // Cart functionality
    function removeFromCart(cartItemId) {
        if (confirm('Are you sure you want to remove this item from your cart?')) {
            fetch('/remove-from-cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'cart_item_id=' + cartItemId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh the page to update cart
                        window.location.reload();
                    } else {
                        alert(data.message || 'Failed to remove item from cart.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the item from cart.');
                });
        }
    }
</script>
<script src="https://cdn.socket.io/4.4.1/socket.io.min.js"
    integrity="sha384-fKnu0iswBIqkjxrhQCTZ7qlLHOFEgNkRmK2vaO/LbTZSXdJfAu6ewRBdwHPhBo/H"
    crossorigin="anonymous"></script>
<script src="/public/assets/js/shop-chat.js?v=<?php echo time(); ?>"></script>
<script src="/public/assets/js/shop-chat-ui.js?v=<?php echo time(); ?>"></script>

<?php 
// Include bootstrap file for dynamic script loading
// include_once($_SERVER['DOCUMENT_ROOT'] . '/public/bootstrap.php');
// // Output the notification loader HTML
// echo getNotificationLoaderHTML();
?>

