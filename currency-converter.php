<?php
require_once("./layout/header.php");
?>

<div class="min-h-screen bg-gray-100 pb-10">
    <!-- Page Header -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-medium text-gray-800">
                        Currency Converter <span class="text-shopee-500">VND</span>
                    </h1>
                    <p class="text-sm text-gray-500 mt-0.5">
                        Convert Vietnamese Dong (VND) to other currencies
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Converter Card -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-exchange-alt text-shopee-500 mr-2"></i>
                        VND Currency Converter
                    </h2>
                    
                    <!-- Converter Form -->
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-grow">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Amount (VND)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">₫</span>
                                    </div>
                                    <input 
                                        type="number" 
                                        id="vnd-amount" 
                                        class="block w-full pl-8 pr-12 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-shopee-500 focus:border-shopee-500"
                                        value="1000000"
                                    >
                                </div>
                                <p id="formatted-amount" class="mt-1 text-xs text-gray-500"></p>
                            </div>
                            
                            <div class="w-full sm:w-48">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Target Currency</label>
                                <select 
                                    id="target-currency" 
                                    class="block w-full py-3 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-shopee-500 focus:border-shopee-500"
                                >
                                    <option value="" selected disabled>Select currency</option>
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>
                            
                            <div class="w-full">
                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2 mt-4">
                                    <button type="button" data-value="100000" class="quick-amount px-2 py-1.5 text-xs rounded border border-gray-300 hover:bg-shopee-50 hover:border-shopee-500 transition-colors">
                                        100,000 ₫
                                    </button>
                                    <button type="button" data-value="500000" class="quick-amount px-2 py-1.5 text-xs rounded border border-gray-300 hover:bg-shopee-50 hover:border-shopee-500 transition-colors">
                                        500,000 ₫
                                    </button>
                                    <button type="button" data-value="1000000" class="quick-amount px-2 py-1.5 text-xs rounded border border-gray-300 hover:bg-shopee-50 hover:border-shopee-500 transition-colors active bg-shopee-50 border-shopee-500">
                                        1,000,000 ₫
                                    </button>
                                    <button type="button" data-value="5000000" class="quick-amount px-2 py-1.5 text-xs rounded border border-gray-300 hover:bg-shopee-50 hover:border-shopee-500 transition-colors">
                                        5,000,000 ₫
                                    </button>
                                    <button type="button" data-value="10000000" class="quick-amount px-2 py-1.5 text-xs rounded border border-gray-300 hover:bg-shopee-50 hover:border-shopee-500 transition-colors">
                                        10,000,000 ₫
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Conversion Result -->
                    <div id="result-container" class="hidden p-4 border border-shopee-100 rounded-lg bg-shopee-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">
                                    <span id="result-vnd-amount">1,000,000</span> VND =
                                </p>
                                <p class="text-xl font-bold text-shopee-500 mt-1">
                                    <span id="result-converted-amount">0</span>
                                    <span id="result-currency-code" class="ml-1">USD</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-2" id="result-rate">
                                    1 VND = <span id="rate-per-unit">0</span> <span id="rate-currency"></span>
                                </p>
                            </div>
                            <div class="text-5xl opacity-10">
                                <i class="fa-solid fa-exchange-alt"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Loading State -->
                    <div id="loading-container" class="hidden text-center py-4">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-shopee-500"></div>
                        <p class="text-sm text-gray-500 mt-2">Fetching latest exchange rates...</p>
                    </div>
                    
                    <!-- Error State -->
                    <div id="error-container" class="hidden p-4 border border-red-100 rounded-lg bg-red-50 text-red-700">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-exclamation-circle"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium">Error loading exchange rates</h3>
                                <div class="mt-2 text-sm">
                                    <p id="error-message">Please try again later.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-info-circle text-shopee-500 mr-2"></i>
                        About Currency Conversion
                    </h2>
                    <div class="text-sm text-gray-600 space-y-3">
                        <p>Exchange rates are updated daily from reliable sources.</p>
                        <p>The Vietnamese đồng (VND) is the official currency of Vietnam.</p>
                        <p>This converter provides real-time conversion between VND and major world currencies.</p>
                        <div class="pt-2 border-t border-gray-100 mt-4">
                            <p class="text-xs text-gray-500">
                                <span class="font-medium">Last updated:</span> 
                                <span id="last-updated-date">Loading...</span>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                <span class="font-medium">Source:</span> 
                                <a href="https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/vnd.json" 
                                   class="text-shopee-500 hover:underline"
                                   target="_blank">
                                   currency-api (cdn.jsdelivr.net)
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Popular Conversions -->
                <div class="bg-white rounded-lg shadow-sm p-6 mt-4">
                    <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-star text-shopee-500 mr-2"></i>
                        Popular Conversions
                    </h2>
                    <ul id="popular-conversions" class="space-y-3">
                        <li class="text-sm text-gray-500">Loading popular conversions...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const vndAmountInput = document.getElementById('vnd-amount');
    const formattedAmount = document.getElementById('formatted-amount');
    const targetCurrencySelect = document.getElementById('target-currency');
    const resultContainer = document.getElementById('result-container');
    const loadingContainer = document.getElementById('loading-container');
    const errorContainer = document.getElementById('error-container');
    const errorMessage = document.getElementById('error-message');
    const lastUpdatedDate = document.getElementById('last-updated-date');
    const popularConversions = document.getElementById('popular-conversions');
    
    const resultVndAmount = document.getElementById('result-vnd-amount');
    const resultConvertedAmount = document.getElementById('result-converted-amount');
    const resultCurrencyCode = document.getElementById('result-currency-code');
    const ratePerUnit = document.getElementById('rate-per-unit');
    const rateCurrency = document.getElementById('rate-currency');
    
    let currencyData = null;
    const popularCurrencies = ['usd', 'eur', 'jpy', 'gbp', 'aud', 'cad', 'sgd', 'krw', 'cny'];
    
    // Format number with commas
    function formatNumber(num) {
        return new Intl.NumberFormat().format(num);
    }
    
    // Update the formatted amount display
    vndAmountInput.addEventListener('input', function() {
        formattedAmount.textContent = formatNumber(this.value) + ' VND';
        if (currencyData) {
            updateConversion();
        }
    });
    
    // Quick amount buttons
    document.querySelectorAll('.quick-amount').forEach(button => {
        button.addEventListener('click', function() {
            const value = this.dataset.value;
            vndAmountInput.value = value;
            formattedAmount.textContent = formatNumber(value) + ' VND';
            
            // Update active state
            document.querySelectorAll('.quick-amount').forEach(btn => {
                btn.classList.remove('active', 'bg-shopee-50', 'border-shopee-500');
            });
            this.classList.add('active', 'bg-shopee-50', 'border-shopee-500');
            
            if (currencyData) {
                updateConversion();
            }
        });
    });
    
    // Target currency selection change
    targetCurrencySelect.addEventListener('change', function() {
        if (currencyData) {
            updateConversion();
        }
    });
    
    // Format the initial amount
    formattedAmount.textContent = formatNumber(vndAmountInput.value) + ' VND';
    
    // Fetch currency data
    function fetchCurrencyData() {
        loadingContainer.classList.remove('hidden');
        resultContainer.classList.add('hidden');
        errorContainer.classList.add('hidden');
        
        fetch('https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/vnd.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                currencyData = data;
                
                // Update last updated date
                lastUpdatedDate.textContent = new Date(data.date).toLocaleDateString();
                
                // Populate dropdown with currencies
                const currencies = Object.keys(data.vnd).sort();
                targetCurrencySelect.innerHTML = '<option value="" disabled>Select currency</option>';
                
                currencies.forEach(currency => {
                    const option = document.createElement('option');
                    option.value = currency;
                    option.textContent = currency.toUpperCase();
                    
                    // Select USD by default if available
                    if (currency === 'usd') {
                        option.selected = true;
                    }
                    
                    targetCurrencySelect.appendChild(option);
                });
                
                // Show popular conversions
                updatePopularConversions();
                
                // Update conversion if we have a selected currency
                if (targetCurrencySelect.value) {
                    updateConversion();
                }
                
                loadingContainer.classList.add('hidden');
            })
            .catch(error => {
                console.error('Error fetching currency data:', error);
                errorMessage.textContent = error.message || 'Could not load exchange rates. Please try again later.';
                loadingContainer.classList.add('hidden');
                errorContainer.classList.remove('hidden');
            });
    }
    
    // Update conversion result
    function updateConversion() {
        const vndAmount = parseFloat(vndAmountInput.value) || 0;
        const targetCurrency = targetCurrencySelect.value;
        
        if (!targetCurrency || !currencyData || !currencyData.vnd[targetCurrency]) {
            resultContainer.classList.add('hidden');
            return;
        }
        
        const rate = currencyData.vnd[targetCurrency];
        const convertedAmount = vndAmount * rate;
        
        resultVndAmount.textContent = formatNumber(vndAmount);
        resultConvertedAmount.textContent = convertedAmount < 0.01 
            ? convertedAmount.toFixed(8) 
            : convertedAmount.toFixed(2);
        resultCurrencyCode.textContent = targetCurrency.toUpperCase();
        
        ratePerUnit.textContent = rate < 0.01 
            ? rate.toFixed(8) 
            : rate.toFixed(6);
        rateCurrency.textContent = targetCurrency.toUpperCase();
        
        resultContainer.classList.remove('hidden');
    }
    
    // Update popular conversions list
    function updatePopularConversions() {
        if (!currencyData) return;
        
        const html = popularCurrencies.map(code => {
            if (!currencyData.vnd[code]) return '';
            
            const rate = currencyData.vnd[code];
            const convertedAmount = 1000000 * rate;
            
            return `
                <li class="flex justify-between items-center py-1.5 border-b border-gray-100 last:border-0">
                    <div class="text-sm">
                        <span class="font-medium">1,000,000 VND</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-shopee-500 font-medium">${convertedAmount < 0.01 ? convertedAmount.toFixed(5) : convertedAmount.toFixed(2)}</span>
                        <span class="text-xs ml-1">${code.toUpperCase()}</span>
                    </div>
                </li>
            `;
        }).join('');
        
        popularConversions.innerHTML = html || '<li class="text-sm text-gray-500">No popular conversions available</li>';
    }
    
    // Initialize
    fetchCurrencyData();
});
</script>

<?php require_once("./layout/footer.php"); ?>
