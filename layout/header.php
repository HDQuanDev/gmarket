<?php
require_once(__DIR__ . "/../config.php");

// Get cart items from database instead of session
$cart_items = [];
$count_cart = 0;
$total_cart = 0;

// Only query cart data if user is logged in
if ($isLogin) {
    // Get cart count and total
    $cart_query = "SELECT c.*, p.name, p.thumbnail_image 
                  FROM cart c 
                  JOIN products p ON c.product_id = p.id 
                  WHERE c.user_id = ?";
    $stmt = $conn->prepare($cart_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $cart_result = $stmt->get_result();

    // Process cart items
    while ($item = $cart_result->fetch_assoc()) {
        // Get product image
        $img_url = $item['thumbnail_image'] ? "/public/uploads/all/" . $item['thumbnail_image']: "/public/assets/img/placeholder.jpg";

        // Add to cart items array
        $cart_items[] = [
            'id' => $item['id'],
            'product_id' => $item['product_id'],
            'name' => $item['name'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'img' => $img_url
        ];

        // Update count and total
        $count_cart += $item['quantity'];
        $total_cart += $item['price'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="aCXlmkGIF8M5mTlqrTsNo6sGJQysBJlDUqOh9JGt">
    <meta name="app-url" content="//tmdtquocte.com/">
    <meta name="file-base-url" content="//tmdtquocte.com/public/">
    <title>Takashimaya Online Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Buy Korean domestic products at original prices from the manufacturer" />
    <meta name="keywords" content="Takashimaya">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Takashimaya">
    <meta itemprop="description" content="Buy Korean domestic products at original prices from the manufacturer">
    <meta itemprop="image" content="/public/uploads/final-ver1.svg">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="Takashimaya">
    <meta name="twitter:description" content="Buy Korean domestic products at original prices from the manufacturer">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="/public/uploads/final-ver1.svg">

    <!-- Open Graph data -->
    <meta property="og:title" content="Takashimaya" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="/public/uploads/final-ver1.svg" />
    <meta property="og:description" content="Buy Korean domestic products at original prices from the manufacturer" />
    <meta property="og:site_name" content="Takashimaya" />
    <meta property="fb:app_id" content="">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/icon.PNG">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <!-- Extend Tailwind with Shopee colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'shopee': {
                            50: '#ffebee',
                            100: '#ffcdd2',
                            200: '#ef9a9a',
                            300: '#e57373',
                            400: '#ef5350',
                            500: '#f44336',
                            /* Main Shopee Red */
                            600: '#e53935',
                            /* Shopee's bright red */
                            700: '#d32f2f',
                            800: '#c62828',
                            900: '#b71c1c',
                            'shopee-orange': '#f44336',
                            'shopee-light': '#ffebee',
                            'shopee-yellow': '#ffcdd2',
                            'shopee-gray': '#f5f5f5',
                        },
                        'shopee-orange': '#f44336',
                        'shopee-light': '#ffebee',
                        'shopee-yellow': '#ffcdd2',
                        'shopee-gray': '#f5f5f5',
                    },
                    fontFamily: {
                        sans: ['"Roboto"', 'sans-serif'],
                    },
                },
            },
        }
    </script>

    <!-- Adding Roboto font for Shopee-like styling -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Add Font Awesome for better icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/public/assets/css/custom-style.css?v=12">
</head>

<body class="min-h-screen flex flex-col bg-gray-100">
    <!-- Top Banner - Desktop Only -->
    <div data-content-region-name="topBanner" data-track-content="true" class="hidden lg:block w-full">
        <a target="_self" href="#" class="block w-full bg-white">
            <div class="h-14 overflow-hidden w-full">
                <picture>
                    <source srcset="https://lh3.googleusercontent.com/PjgN4jD5OCj4ycz0LpIX9lM9aUwrsak5pEpBc_CSLhbAkPd80J9_oQ2zXCzow3rzZACcfGuJRyobJr9j23vSk1eEzNRV64Qlqg=w1920-rw" type="image/webp">
                    <source srcset="https://lh3.googleusercontent.com/PjgN4jD5OCj4ycz0LpIX9lM9aUwrsak5pEpBc_CSLhbAkPd80J9_oQ2zXCzow3rzZACcfGuJRyobJr9j23vSk1eEzNRV64Qlqg=w1920" type="image/png">
                    <img class="lazyload w-full h-full object-cover object-center" alt="Special Promotion Banner" src="https://lh3.googleusercontent.com/PjgN4jD5OCj4ycz0LpIX9lM9aUwrsak5pEpBc_CSLhbAkPd80J9_oQ2zXCzow3rzZACcfGuJRyobJr9j23vSk1eEzNRV64Qlqg=w1920-rw" loading="lazy" decoding="async">
                </picture>
            </div>
        </a>
    </div>

    <!-- Top Bar - Hide most elements on small screens -->
    <div class="bg-gradient-to-r from-shopee-600 to-shopee-500 text-white py-1 text-xs">
        <div class="container mx-auto px-2 sm:px-4">
            <div class="flex justify-between items-center">
                <!-- Left side elements - Hidden on mobile -->
                <div class="hidden sm:flex items-center space-x-4">
                    <a href="#" class="hover:text-white/80 transition">Seller Center</a>
                    <span class="h-4 border-r border-white/30"></span>
                    <a href="#" class="hover:text-white/80 transition flex items-center gap-1">
                        <span>Download</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <span class="h-4 border-r border-white/30"></span>
                    <div class="flex items-center gap-1">
                        <span>Follow us on</span>
                        <a href="#" class="hover:text-white/80 transition">
                            <i class="lab la-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="hover:text-white/80 transition">
                            <i class="lab la-instagram text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Right side - Simplified for mobile -->
                <div class="flex items-center space-x-2 sm:space-x-4 w-full sm:w-auto justify-end">
                    <!-- Only show Help on mobile -->
                    <a href="#" class="flex items-center gap-1 hover:text-white/80 transition sm:hidden">
                        <i class="las la-question-circle"></i>
                    </a>

                    <!-- Hidden on mobile -->
                    <a href="#" class="hidden sm:flex items-center gap-1 hover:text-white/80 transition">
                        <i class="las la-bell"></i>
                        <span>Notifications</span>
                    </a>
                    <a href="#" class="hidden sm:flex items-center gap-1 hover:text-white/80 transition">
                        <i class="las la-question-circle"></i>
                        <span>Help</span>
                    </a>

                    <!-- Language and Currency selector in top navigation -->
                    <div class="hidden sm:flex items-center space-x-2">
                        <!-- Language selector with improved Google Translate integration -->
                        <div class="relative group" id="language-selector-container">
                            <button class="flex items-center gap-1 hover:text-white/80 transition" id="language-selector-btn">
                                <img src="https://cdn.shopify.com/static/images/flags/us.svg?width=32" alt="USA" class="w-4 h-auto" id="current-language-flag">
                                <span class="sm:inline" id="current-language">USA</span>
                                <i class="fas fa-angle-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 top-full mt-1 bg-white text-gray-800 shadow-lg rounded-md py-2 w-40 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                <a href="javascript:void(0)" onclick="doGTranslate('en|en')" class="block px-4 py-1 hover:bg-gray-100 flex items-center">
                                    <img src="https://cdn.shopify.com/static/images/flags/us.svg?width=32" alt="USA" class="w-4 h-auto mr-2">
                                    USA
                                </a>
                                <a href="javascript:void(0)" onclick="doGTranslate('en|vi')" class="block px-4 py-1 hover:bg-gray-100 flex items-center">
                                    <img src="https://cdn.shopify.com/static/images/flags/vn.svg?width=32" alt="Vietnamese" class="w-4 h-auto mr-2">
                                    Vietnamese
                                </a>
                            </div>

                            <!-- GTranslate: https://gtranslate.io/ -->
                            <div id="google_translate_element2"></div>
                        </div>
                        
                        <!-- Currency selector - new addition -->
                        <span class="h-4 border-r border-white/30"></span>
                        <div class="relative group" id="currency-selector-container">
                            <button class="flex items-center gap-1 hover:text-white/80 transition" id="currency-selector-btn">
                                <span class="sm:inline"><span class="current-currency">USD</span></span>
                                <i class="fas fa-angle-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 top-full mt-1 bg-white text-gray-800 shadow-lg rounded-md py-2 w-40 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                <a href="javascript:void(0)" onclick="CurrencyConverter.setDisplayCurrency('USD')" class="currency-selector-item block px-4 py-1 hover:bg-gray-100 flex items-center" data-currency="USD">
                                    <span class="mr-2 text-sm">$</span>
                                    <span>USD</span>
                                </a>
                                <a href="javascript:void(0)" onclick="CurrencyConverter.setDisplayCurrency('VND')" class="currency-selector-item block px-4 py-1 hover:bg-gray-100 flex items-center" data-currency="VND">
                                    <span class="mr-2 text-sm">₫</span>
                                    <span>VND</span>
                                </a>
                                <a href="javascript:void(0)" onclick="CurrencyConverter.setDisplayCurrency('auto')" class="currency-selector-item block px-4 py-1 hover:bg-gray-100 flex items-center" data-currency="auto">
                                    <span class="mr-2 text-sm"><i class="fas fa-sync-alt"></i></span>
                                    <span>Auto</span>
                                </a>
                            </div>
                        </div>

                        <!-- Updated GTranslate Script -->
                        <script type="text/javascript">
                            function googleTranslateElementInit2() {
                                new google.translate.TranslateElement({
                                    pageLanguage: 'en',
                                    autoDisplay: false
                                }, 'google_translate_element2');
                            }

                            // Helper function to get cookie by name
                            function getCookie(name) {
                                const value = `; ${document.cookie}`;
                                const parts = value.split(`; ${name}=`);
                                if (parts.length === 2) return parts.pop().split(';').shift();
                            }

                            // Detect current language based on URL or cookie
                            function detectCurrentLanguage() {
                                // Check URL hash parameter first (most reliable after a change)
                                const hash = window.location.hash;
                                if (hash && hash.includes('googtrans(')) {
                                    const langCode = hash.match(/googtrans\(([^)]+)\)/)[1];
                                    return langCode === 'vi' ? 'vi' : 'en';
                                }
                                
                                // Then check if Google Translate cookie exists
                                const googleTranslateCookie = getCookie('googtrans');
                                if (googleTranslateCookie) {
                                    const langCode = googleTranslateCookie.split('/').pop();
                                    return langCode === 'vi' ? 'vi' : 'en';
                                }
                                
                                // Fallback to default language (English)
                                return 'en';
                            }

                            // Function to perform translation with improved implementation
                            function doGTranslate(lang_pair) {
                                if (lang_pair.value) lang_pair = lang_pair.value;
                                if (lang_pair === '') return;
                                const lang = lang_pair.split('|')[1];
                                
                                // Set a flag to indicate language is changing
                                localStorage.setItem('languageChanging', 'true');
                                localStorage.setItem('selectedLanguage', lang);
                                
                                // Update UI immediately 
                                document.getElementById('current-language').textContent = lang === 'vi' ? 'Vietnamese' : 'USA';
                                document.getElementById('current-language-flag').src = lang === 'vi' ? 
                                    'https://cdn.shopify.com/static/images/flags/vn.svg?width=32' : 
                                    'https://cdn.shopify.com/static/images/flags/us.svg?width=32';
                                
                                // Clear any existing translate cookies
                                document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                                document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + document.domain;
                                document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=.' + document.domain;
                                
                                // Set the new cookie with proper domain settings
                                const cookieValue = '/en/' + lang;
                                document.cookie = 'googtrans=' + cookieValue + '; path=/; domain=' + document.domain;
                                
                                // Reload the page to apply language change
                                window.location.href = window.location.href.split('#')[0] + '#googtrans(' + lang + ')';
                                window.location.reload();
                            }

                            // Initialize language on page load
                            document.addEventListener('DOMContentLoaded', function() {
                                // Clear the flag immediately to prevent reload loops
                                localStorage.removeItem('languageChanging');
                                
                                // Create the Google Translate script if it doesn't exist
                                if (!document.getElementById('google_translate_script')) {
                                    const script = document.createElement('script');
                                    script.id = 'google_translate_script';
                                    script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2';
                                    document.body.appendChild(script);
                                }
                                
                                // Set correct initial language display based on cookie
                                const currentLang = detectCurrentLanguage();
                                
                                // Force initialize the translator
                                setTimeout(function() {
                                    // Update the UI to match the actual language
                                    document.getElementById('current-language').textContent = currentLang === 'vi' ? 'Vietnamese' : 'USA';
                                    document.getElementById('current-language-flag').src = currentLang === 'vi' ? 
                                        'https://cdn.shopify.com/static/images/flags/vn.svg?width=32' : 
                                        'https://cdn.shopify.com/static/images/flags/us.svg?width=32';
                                    
                                    // If there's a stored language that doesn't match current, apply it
                                    const storedLang = localStorage.getItem('selectedLanguage');
                                    if (storedLang && storedLang !== currentLang) {
                                        doGTranslate('en|' + storedLang);
                                    }
                                }, 500);
                            });
                        </script>

                        <!-- Currency conversion script for multilingual support -->
                        <script src="/public/assets/js/currency-converter.js?v=5"></script>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Initialize currency display
                                const currentCurrency = localStorage.getItem('selectedCurrency') || 'auto';
                                const currencyDisplayEl = document.querySelector('.current-currency');
                                if (currencyDisplayEl) {
                                    currencyDisplayEl.textContent = currentCurrency === 'auto' ? 'Auto' : currentCurrency;
                                }
                                
                                // Check if we're in a currency-changing state
                                const isCurrencyChanging = localStorage.getItem('currencyChanging') === 'true';
                                if (isCurrencyChanging) {
                                    localStorage.removeItem('currencyChanging');
                                }
                                
                                // Update currency selectors
                                const currencyItems = document.querySelectorAll('.currency-selector-item');
                                currencyItems.forEach(item => {
                                    if (item.dataset.currency === currentCurrency) {
                                        item.classList.add('active', 'bg-gray-100');
                                    }
                                    
                                    // Override the click event to reload page
                                    item.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        const currency = this.dataset.currency;
                                        
                                        // Check if currency is already selected to prevent reload loop
                                        if (currency === currentCurrency) {
                                            return;
                                        }
                                        
                                        localStorage.setItem('selectedCurrency', currency);
                                        localStorage.setItem('currencyChanging', 'true');
                                        
                                        // Reload the page to apply all currency changes
                                        window.location.reload();
                                    });
                                });
                            });
                        </script>

                        <style>
                            /* Styling for active currency */
                            .currency-selector-item.active {
                                font-weight: bold;
                                background-color: #f9fafb;
                            }
                            
                            /* Hide Google translate widget but keep functionality */
                            .skiptranslate,
                            .goog-te-banner-frame {
                                display: none !important;
                            }
                            
                            /* Fix Google Translate body positioning */
                            body {
                                top: 0 !important;
                                position: static !important;
                            }
                            
                            /* Fix for translated content */
                            .goog-text-highlight {
                                background-color: transparent !important;
                                box-shadow: none !important;
                            }
                        </style>
                    </div>

                    <?php if (!$isLogin): ?>
                        <div class="flex items-center space-x-2">
                            <a href="/users/login" class="hover:text-white/80 transition">Login</a>
                        </div>
                    <?php else: ?>
                        <div class="relative group">
                            <button class="flex items-center gap-1 hover:text-white/80 transition">
                                <i class="las la-user-circle text-base"></i>
                                <span class="hidden sm:inline">Account</span>
                                <i class="las la-angle-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 top-full mt-1 bg-white text-gray-800 shadow-lg rounded-md py-1 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                <!-- <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                                    <i class="las la-user text-shopee-500"></i>
                                    <span>My Profile</span>
                                </a> -->
                                <a href="/purchase_history" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                                    <i class="las la-shopping-bag text-shopee-500"></i>
                                    <span>Dashboard</span>
                                </a>
                                <a href="/logout" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2 text-red-600">
                                    <i class="las la-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header with Search and Cart Icons - More compact -->
    <header class="bg-white py-2 sticky top-0 z-40 shadow-sm">
        <div class="container mx-auto px-2 md:px-4">
            <div class="flex items-center gap-2 md:gap-4">
                <!-- Logo - Optimized size -->
                <div class="flex-shrink-0 mr-1">
                    <a href="/" class="block">
                        <img src="/public/uploads/final-ver1.svg" alt="Takashimaya" class="h-8 w-auto">
                    </a>
                </div>

                <!-- Enhanced Search Bar - More compact -->
                <div class="search-container flex-1">
                    <form action="/search" method="GET" class="search-form" id="search-form">
                        <input
                            type="text"
                            id="search-input"
                            class="search-input border border-gray-300 rounded-l focus:outline-none focus:border-shopee-500"
                            placeholder="Search"
                            name="q"
                            autocomplete="off">
                        <button type="submit" class="search-button bg-shopee-500 text-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>

                    <!-- Search dropdown & popular searches -->
                    <div class="search-results-container" id="search-results">
                        <div class="search-loading" id="search-loading">
                            <div class="search-spinner"></div>
                        </div>
                        <div class="search-results-content" id="search-results-content"></div>
                    </div>
                </div>

                <!-- Navigation Icons - More compact -->
                <div class="nav-icon-container flex items-center">
                    <!-- Cart Icon -->
                    <div class="nav-icon cart-button relative">
                        <a href="/cart" class="block p-1 text-gray-700 hover:text-shopee-500">
                            <i class="fa-solid fa-cart-shopping text-lg"></i>
                            <?php if ($count_cart > 0): ?>
                                <span class="cart-count bg-shopee-500 text-white"><?= $count_cart > 99 ? '99+' : $count_cart ?></span>
                            <?php endif; ?>
                        </a>

                        <!-- Cart Dropdown - Fix position -->
                        <div class="cart-dropdown absolute right-0 top-full bg-white mt-2 z-50">
                            <?php if ($count_cart == 0): ?>
                                <div class="p-6 text-center">
                                    <i class="fa-solid fa-cart-shopping text-gray-300 text-5xl mb-3"></i>
                                    <p class="text-gray-500">Your cart is empty</p>
                                    <a href="/" class="mt-3 inline-block text-shopee-500 hover:underline">Start Shopping</a>
                                </div>
                            <?php else: ?>
                                <div class="p-3 border-b">
                                    <h3 class="font-medium text-gray-700">Recently Added Products</h3>
                                </div>
                                <div class="max-h-60 overflow-y-auto">
                                    <?php foreach (array_slice($cart_items, 0, 3) as $item): ?>
                                        <div class="flex p-3 border-b last:border-b-0 hover:bg-gray-50">
                                            <div class="w-12 h-12 flex-shrink-0 overflow-hidden rounded border border-gray-200">
                                                <img src="<?= $item['img'] ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-cover">
                                            </div>
                                            <div class="ml-3 flex-1 flex flex-col">
                                                <div class="flex justify-between text-sm font-medium text-gray-900">
                                                    <h3 class="text-sm line-clamp-1">
                                                        <a href="/product/<?= $item['product_id'] ?>"><?= $item['name'] ?></a>
                                                    </h3>
                                                    <p class="ml-1"><?= number_format($item['price'], 0, ',', '.') ?> $</p>
                                                </div>
                                                <div class="flex justify-between items-end flex-1">
                                                    <p class="text-xs text-gray-500">Qty: <?= $item['quantity'] ?></p>
                                                    <button type="button" class="text-shopee-500 hover:text-shopee-600 text-xs" onclick="removeFromCart(<?= $item['id'] ?>)">
                                                        <i class="fa-solid fa-xmark"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="p-3 border-t">
                                    <div class="flex justify-between text-sm my-2">
                                        <span class="font-medium">Subtotal (<?= $count_cart ?> items):</span>
                                        <span class="font-bold text-shopee-500"><?= number_format($total_cart, 0, ',', '.') ?> $</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="/cart" class="block flex-1 text-center px-4 py-2 border border-shopee-500 text-shopee-500 rounded hover:bg-shopee-50 transition text-sm font-medium">
                                            <i class="fa-solid fa-basket-shopping mr-1"></i> View Cart
                                        </a>
                                        <a href="/checkout" class="block flex-1 text-center px-4 py-2 bg-shopee-500 text-white rounded hover:bg-shopee-600 transition text-sm font-medium">
                                            <i class="fa-solid fa-credit-card mr-1"></i> Checkout
                                        </a>
                                    </div>
                                    <?php if (count($cart_items) > 3): ?>
                                        <div class="text-center mt-2 text-xs text-gray-500">
                                            and <?= count($cart_items) - 3 ?> more item(s)
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- User Icon -->
                    <?php if ($isLogin): ?>
                        <div class="relative group">
                            <a href="/dashboard" class="nav-icon p-1 text-gray-700 hover:text-shopee-500">
                                <i class="fa-solid fa-user text-lg"></i>
                            </a>
                            <div class="absolute right-0 top-full mt-2 bg-white text-gray-800 shadow-lg rounded-md py-1 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                <a href="/purchase_history" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                                    <i class="fa-solid fa-box text-shopee-500 w-4"></i>
                                    <span>Dashboard</span>
                                </a>
                                <a href="/logout" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2 text-red-600">
                                    <i class="fa-solid fa-right-from-bracket w-4"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/users/login" class="nav-icon p-1 text-gray-700 hover:text-shopee-500">
                            <i class="fa-solid fa-user text-lg"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Categories Menu Bar - More compact -->
    <div class="bg-white shadow-sm relative" id="categories-container">
        <div class="container mx-auto relative">
            <!-- Left scroll indicator -->
            <div class="absolute left-0 top-0 bottom-0 w-8 bg-gradient-to-r from-white to-transparent pointer-events-none" id="scroll-left-indicator"></div>

            <!-- Categories container - Centered -->
            <div class="relative overflow-hidden">
                <div class="flex items-center justify-center space-x-2 overflow-x-auto py-2 scrollbar-hide scroll-smooth" id="categories-scroll">
                    <?php
                    $sql = "SELECT id, name, img, banner, path FROM categories ORDER BY create_date DESC LIMIT 15";
                    $result = $conn->query($sql);

                    // Display categories
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="/category/' . $row['path'] . '" class="text-sm whitespace-nowrap py-1 px-2 hover:text-shopee-500 transition flex-shrink-0">
                                ' . $row['name'] . '
                            </a>';
                        }
                        echo '<a href="/categories" class="text-sm whitespace-nowrap py-1 px-2 hover:text-shopee-500 transition flex-shrink-0">
                            ' . tran("View All") . '
                        </a>';
                    }
                    ?>
                </div>
            </div>

            <!-- Right scroll indicator -->
            <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none" id="scroll-right-indicator"></div>

            <!-- One scroll button is enough for space efficiency -->
            <button class="absolute right-1 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-white/80 shadow text-shopee-500 flex items-center justify-center z-20 hover:bg-white" id="scroll-right-btn">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>

    <!-- Improved CSS for tighter layout -->
    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* Improve search experience */
        .search-container {
            max-width: calc(100% - 110px);
        }

        .search-input {
            height: 36px;
            padding: 0 10px;
            font-size: 14px;
        }

        .search-button {
            width: 36px;
        }

        /* Better touch targets */
        .nav-icon {
            padding: 6px;
        }

        /* Fix cart dropdown positioning */
        .cart-dropdown {
            width: 280px;
            right: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Add main content padding to prevent header overlay */
        .flex-grow {
            padding-bottom: 60px;
            /* Ensure content isn't covered at bottom */
        }

        @media (max-width: 640px) {

            /* Optimize for mobile */
            .container {
                padding-left: 8px !important;
                padding-right: 8px !important;
            }

            .search-input {
                padding-right: 36px;
            }

            /* Make touch targets easier to hit */
            .nav-icon {
                padding: 8px;
            }

            /* Optimize dropdowns for mobile */
            .cart-dropdown {
                width: 290px;
                right: -80px;
            }

            /* Mobile header adjustments to prevent content overlap */
            header.sticky {
                position: fixed;
                width: 100%;
                top: 0;
                z-index: 40;
            }

            /* Add padding to categories container when header is fixed */
            body.has-fixed-header #categories-container {
                margin-top: 32px;
                /* Match header height to prevent overlap */
            }

            /* Add padding to body when header is fixed */
            body.has-fixed-header .flex-grow {
                padding-top: 60px;
                /* Match header height plus margins */
            }
        }
    </style>

    <!-- Optimized scroll script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.getElementById('categories-scroll');
            const rightBtn = document.getElementById('scroll-right-btn');
            const leftIndicator = document.getElementById('scroll-left-indicator');
            const rightIndicator = document.getElementById('scroll-right-indicator');
            const categoriesContainer = document.getElementById('categories-container');

            // Mobile header fix - Add classes for fixed header
            const header = document.querySelector('header');
            const body = document.body;

            // Only apply fixed header behavior on mobile
            // if (window.innerWidth <= 640) {
            //     header.classList.add('sticky');
            //     body.classList.add('has-fixed-header');

            //     // Calculate header height and apply it as margin-top to categories container
            //     const headerHeight = header.offsetHeight;
            //     categoriesContainer.style.marginTop = headerHeight + 'px';

            //     // Adjust header behavior on scroll
            //     let lastScroll = 0;
            //     window.addEventListener('scroll', () => {
            //         const currentScroll = window.pageYOffset;

            //         // Show/hide header based on scroll direction
            //         if (currentScroll <= 0) {
            //             // At top of page
            //             header.style.transform = 'translateY(0)';
            //             categoriesContainer.style.marginTop = headerHeight + 'px';
            //         } else if (currentScroll > lastScroll && currentScroll > 60) {
            //             // Scrolling down & not at top
            //             header.style.transform = 'translateY(-100%)';
            //             categoriesContainer.style.marginTop = '0px';
            //         } else {
            //             // Scrolling up
            //             header.style.transform = 'translateY(0)';
            //             categoriesContainer.style.marginTop = headerHeight + 'px';
            //         }

            //         lastScroll = currentScroll;
            //     });
            // }

            // Listen for orientation changes and window resizes
            window.addEventListener('resize', function() {
                if (window.innerWidth <= 640) {
                    if (!body.classList.contains('has-fixed-header')) {
                        body.classList.add('has-fixed-header');
                        header.classList.add('sticky');

                        // Recalculate header height
                        const headerHeight = header.offsetHeight;
                        categoriesContainer.style.marginTop = headerHeight + 'px';
                    }
                } else {
                    // Remove mobile-specific styles on larger screens
                    body.classList.remove('has-fixed-header');
                    header.classList.remove('sticky');
                    categoriesContainer.style.marginTop = '0';
                    header.style.transform = '';
                }
            });

            // Simplified scroll check
            function updateScrollIndicators() {
                if (scrollContainer.scrollWidth > scrollContainer.clientWidth) {
                    // Show indicator when more content available
                    const isAtEnd = scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth - 20;
                    rightIndicator.style.opacity = isAtEnd ? '0' : '1';
                    rightBtn.style.display = isAtEnd ? 'none' : 'flex';

                    // Left indicator shows based on scroll position
                    leftIndicator.style.opacity = scrollContainer.scrollLeft > 20 ? '1' : '0';
                } else {
                    // No scroll needed
                    leftIndicator.style.opacity = '0';
                    rightIndicator.style.opacity = '0';
                    rightBtn.style.display = 'none';
                }
            }

            // Scroll button
            if (rightBtn) {
                rightBtn.addEventListener('click', () => {
                    scrollContainer.scrollBy({
                        left: 200,
                        behavior: 'smooth'
                    });
                });
            }

            // Update on scroll & resize
            scrollContainer.addEventListener('scroll', updateScrollIndicators);
            window.addEventListener('resize', updateScrollIndicators);

            // Initial check
            updateScrollIndicators();
        });
    </script>
</body>

</html>