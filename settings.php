<?php
require_once(__DIR__ . "/config.php");
require_once(__DIR__ . "/layout/header.php");
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b">
            <h1 class="text-xl font-medium text-gray-900"><?= tran("Settings") ?></h1>
            <p class="mt-1 text-sm text-gray-500"><?= tran("Customize your browsing experience") ?></p>
        </div>
        
        <div class="p-6">
            <!-- Language Settings Section -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 mb-4"><?= tran("Language") ?></h2>
                <p class="text-sm text-gray-500 mb-4"><?= tran("Select your preferred display language") ?></p>
                
                <div class="grid grid-cols-2 gap-4">
                    <a href="javascript:void(0)" onclick="switchToLanguage('en')" 
                       class="language-option flex items-center justify-between p-4 border rounded-lg hover:border-shopee-500 transition-colors" 
                       data-lang="en">
                        <div class="flex items-center">
                            <img src="https://cdn.shopify.com/static/images/flags/us.svg?width=32" alt="USA" class="w-6 h-auto mr-3">
                            <span class="font-medium">English</span>
                        </div>
                        <div class="language-check text-shopee-500 hidden">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </a>
                    
                    <a href="javascript:void(0)" onclick="switchToLanguage('vi')" 
                       class="language-option flex items-center justify-between p-4 border rounded-lg hover:border-shopee-500 transition-colors" 
                       data-lang="vi">
                        <div class="flex items-center">
                            <img src="https://cdn.shopify.com/static/images/flags/vn.svg?width=32" alt="Vietnamese" class="w-6 h-auto mr-3">
                            <span class="font-medium">Tiếng Việt</span>
                        </div>
                        <div class="language-check text-shopee-500 hidden">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Currency Settings Section -->
            <div>
                <h2 class="text-lg font-medium text-gray-900 mb-4"><?= tran("Currency") ?></h2>
                <p class="text-sm text-gray-500 mb-4"><?= tran("Choose how prices are displayed") ?></p>
                
                <div class="grid grid-cols-1 gap-4">
                    <a href="javascript:void(0)" onclick="switchToCurrency('USD')" 
                       class="currency-option flex items-center justify-between p-4 border rounded-lg hover:border-shopee-500 transition-colors" 
                       data-currency="USD">
                        <div class="flex items-center">
                            <div class="w-6 text-center font-semibold mr-3">$</div>
                            <div>
                                <span class="font-medium">US Dollar (USD)</span>
                                <p class="text-xs text-gray-500 mt-1"><?= tran("Always show prices in USD") ?></p>
                            </div>
                        </div>
                        <div class="currency-check text-shopee-500 hidden">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </a>
                    
                    <a href="javascript:void(0)" onclick="switchToCurrency('VND')" 
                       class="currency-option flex items-center justify-between p-4 border rounded-lg hover:border-shopee-500 transition-colors" 
                       data-currency="VND">
                        <div class="flex items-center">
                            <div class="w-6 text-center font-semibold mr-3">₫</div>
                            <div>
                                <span class="font-medium">Vietnamese Dong (VND)</span>
                                <p class="text-xs text-gray-500 mt-1"><?= tran("Always show prices in VND") ?></p>
                            </div>
                        </div>
                        <div class="currency-check text-shopee-500 hidden">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </a>
                    
                    <!--<a href="javascript:void(0)" onclick="switchToCurrency('auto')" -->
                    <!--   class="currency-option flex items-center justify-between p-4 border rounded-lg hover:border-shopee-500 transition-colors" -->
                    <!--   data-currency="auto">-->
                    <!--    <div class="flex items-center">-->
                    <!--        <div class="w-6 text-center mr-3"><i class="fa-solid fa-sync-alt"></i></div>-->
                    <!--        <div>-->
                    <!--            <span class="font-medium"><?= tran("Automatic") ?></span>-->
                    <!--            <p class="text-xs text-gray-500 mt-1"><?= tran("USD for English, VND for Vietnamese") ?></p>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="currency-check text-shopee-500 hidden">-->
                    <!--        <i class="fa-solid fa-check"></i>-->
                    <!--    </div>-->
                    <!--</a>-->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Helper functions for switching language and currency
function switchToLanguage(lang) {
    if (lang === 'en') {
        doGTranslate('en|en');
    } else if (lang === 'vi') {
        doGTranslate('en|vi');
    }
    updateLanguageUI(lang);
}

function switchToCurrency(currency) {
    if (typeof CurrencyConverter !== 'undefined' && CurrencyConverter.setDisplayCurrency) {
        CurrencyConverter.setDisplayCurrency(currency);
        updateCurrencyUI();
    } else {
        console.error('CurrencyConverter module not loaded or setDisplayCurrency not available');
    }
}

// Function to update language UI - defined globally
function updateLanguageUI(lang) {
    const currentLang = lang || detectCurrentLanguage();
    document.querySelectorAll('.language-option').forEach(option => {
        const optionLang = option.getAttribute('data-lang');
        const checkmark = option.querySelector('.language-check');
        
        if (optionLang === currentLang) {
            option.classList.add('border-shopee-500', 'bg-shopee-50');
            checkmark.classList.remove('hidden');
        } else {
            option.classList.remove('border-shopee-500', 'bg-shopee-50');
            checkmark.classList.add('hidden');
        }
    });
}

// Function to update currency UI - defined globally
function updateCurrencyUI() {
    if (typeof CurrencyConverter !== 'undefined' && CurrencyConverter.getSelectedCurrency) {
        const currentCurrency = CurrencyConverter.getSelectedCurrency();
        document.querySelectorAll('.currency-option').forEach(option => {
            const optionCurrency = option.getAttribute('data-currency');
            const checkmark = option.querySelector('.currency-check');
            
            if (optionCurrency === currentCurrency) {
                option.classList.add('border-shopee-500', 'bg-shopee-50');
                checkmark.classList.remove('hidden');
            } else {
                option.classList.remove('border-shopee-500', 'bg-shopee-50');
                checkmark.classList.add('hidden');
            }
        });
    } else {
        console.error('CurrencyConverter module not loaded or getSelectedCurrency not available');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize UI based on current settings
    setTimeout(() => {
        updateLanguageUI(detectCurrentLanguage());
        updateCurrencyUI();
    }, 500); // Small delay to ensure the language detection works
});
</script>

<?php
require_once(__DIR__ . "/layout/footer.php");
?>