/**
 * CurrencyConverter - Module xử lý chuyển đổi tiền tệ dựa trên ngôn ngữ
 * 
 * Module này cung cấp các chức năng để chuyển đổi giá sản phẩm giữa USD và VND
 * dựa trên ngôn ngữ hiện tại của người dùng trên trang web.
 */
const CurrencyConverter = (function() {
    // Tỷ giá mặc định trong trường hợp không thể lấy từ API
    const DEFAULT_EXCHANGE_RATE = 0.000041; // USD to VND
    
    // Lưu trữ loại tiền tệ đã chọn
    let selectedCurrency = localStorage.getItem('selectedCurrency') || 'auto';
    
    // Theo dõi ngôn ngữ hiện tại để phát hiện thay đổi
    let currentLanguage = '';
    
    /**
     * Cập nhật hiển thị tiền tệ theo ngôn ngữ được chọn hoặc tùy chọn thủ công
     * @param {string} language - Mã ngôn ngữ hiện tại (en hoặc vi)
     * @param {boolean} forceUpdate - Buộc cập nhật ngay cả khi ngôn ngữ không thay đổi
     */
    function updateCurrencyDisplay(language, forceUpdate = false) {
        // Ghi nhận ngôn ngữ vừa cập nhật và kiểm tra xem có thay đổi không
        const languageChanged = (currentLanguage !== language) || forceUpdate;
        currentLanguage = language;
        
        // Đảm bảo xóa tất cả các đánh dấu xử lý trước nếu ngôn ngữ thay đổi
        if (languageChanged) {
            document.querySelectorAll('.currency-processed').forEach(el => {
                el.classList.remove('currency-processed');
            });
        }
        
        // Kiểm tra xem người dùng có cài đặt thủ công không
        if (selectedCurrency === 'USD') {
            resetPricesToUSD();
        } else if (selectedCurrency === 'VND') {
            // Chuyển đổi sang VND bất kể ngôn ngữ
            fetchExchangeRates().then(rates => {
                convertPricesToVND(rates);
            }).catch(error => {
                console.error('Lỗi khi lấy tỷ giá hối đoái:', error);
            });
        } else {
            // Chế độ auto - dựa vào ngôn ngữ
            if (language === 'vi') {
                // Lấy tỷ giá mới nhất cho VND
                fetchExchangeRates().then(rates => {
                    // Chuyển đổi giá trên trang
                    convertPricesToVND(rates);
                }).catch(error => {
                    console.error('Lỗi khi lấy tỷ giá hối đoái:', error);
                });
            } else {
                // Nếu ngôn ngữ là tiếng Anh hoặc ngôn ngữ khác, sử dụng USD
                resetPricesToUSD();
            }
        }
    }
    
    /**
     * Đặt loại tiền tệ hiển thị thủ công
     * @param {string} currency - Loại tiền tệ (USD, VND hoặc 'auto')
     */
    function setDisplayCurrency(currency) {
        if (['USD', 'VND', 'auto'].includes(currency)) {
            // Kiểm tra nếu đang chọn loại tiền tệ đã được chọn
            if (currency === selectedCurrency) {
                // Không thay đổi gì nếu loại tiền tệ giống nhau
                return true;
            }
            
            selectedCurrency = currency;
            localStorage.setItem('selectedCurrency', currency);
            localStorage.setItem('currencyChanging', 'true');
            
            // Tải lại trang để đảm bảo tất cả phần tử được cập nhật đúng
            window.location.reload();
            
            return true;
        }
        return false;
    }
    
    /**
     * Lấy loại tiền tệ hiện tại đang được chọn
     * @returns {string} Loại tiền tệ hiện tại (USD, VND hoặc 'auto')
     */
    function getSelectedCurrency() {
        return selectedCurrency;
    }
    
    /**
     * Cập nhật trạng thái hiển thị cho các nút chọn tiền tệ
     */
    function updateCurrencySelectors() {
        // Cập nhật các phần tử hiển thị tiền tệ hiện tại trên giao diện
        document.querySelectorAll('.current-currency').forEach(el => {
            el.textContent = selectedCurrency === 'auto' ? 'Auto' : selectedCurrency;
        });
        
        // Đánh dấu nút tiền tệ đang được chọn
        document.querySelectorAll('.currency-selector-item').forEach(item => {
            const currencyValue = item.dataset.currency;
            if (currencyValue === selectedCurrency) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    }
    
    /**
     * Lấy tỷ giá hối đoái mới nhất từ API
     * @returns {Promise} Promise với dữ liệu tỷ giá
     */
    function fetchExchangeRates() {
        return fetch('https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/vnd.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể lấy tỷ giá hối đoái');
                }
                return response.json();
            })
            .then(data => {
                // Lưu trữ tỷ giá trong localStorage để sử dụng ngoại tuyến
                localStorage.setItem('exchangeRates', JSON.stringify(data));
                localStorage.setItem('ratesLastUpdated', new Date().toISOString());
                return data;
            })
            .catch(error => {
                console.error('Lỗi khi lấy tỷ giá:', error);
                
                // Thử sử dụng tỷ giá đã lưu trong bộ nhớ cache nếu có
                const cachedRates = localStorage.getItem('exchangeRates');
                if (cachedRates) {
                    return JSON.parse(cachedRates);
                }
                
                // Trở về tỷ giá mặc định nếu không có tỷ giá trong bộ nhớ cache
                return { 
                    date: new Date().toISOString().split('T')[0], 
                    vnd: { usd: DEFAULT_EXCHANGE_RATE } 
                };
            });
    }
    
    /**
     * Chuyển đổi tất cả giá trên trang từ USD sang VND
     * @param {Object} rates - Dữ liệu tỷ giá hối đoái
     */
    function convertPricesToVND(rates) {
        if (!rates || !rates.vnd || !rates.vnd.usd) {
            console.error('Dữ liệu tỷ giá không hợp lệ');
            return;
        }
        
        const usdToVndRate = 1 / rates.vnd.usd; // Chuyển đổi từ USD sang VND
        
        // Đảm bảo bắt đầu với trạng thái sạch
        resetPricesToUSD();
        
        // Sử dụng ID cụ thể cho các phần tử trang sản phẩm trước để nhắm mục tiêu chính xác hơn
        const originalPriceEl = document.getElementById('product-original-price');
        const finalPriceEl = document.getElementById('product-final-price');
        const discountPercentEl = document.getElementById('product-discount-percent');
        
        if (finalPriceEl) {
            const priceText = finalPriceEl.textContent.trim();
            if (priceText.includes('$')) {
                const numericValue = parseFloat(priceText.replace('$', '').replace(/,/g, ''));
                if (!isNaN(numericValue)) {
                    // Chuyển đổi sang VND
                    const vndValue = Math.round(numericValue * usdToVndRate);
                    finalPriceEl.textContent = vndValue.toLocaleString('vi-VN') + ' ₫';
                    // Đánh dấu là đã xử lý
                    finalPriceEl.classList.add('currency-processed');
                    // Lưu trữ giá trị gốc để chuyển đổi lại
                    finalPriceEl.dataset.usdPrice = numericValue;
                }
            }
        }
        
        if (originalPriceEl) {
            const priceText = originalPriceEl.textContent.trim();
            if (priceText.includes('$')) {
                const numericValue = parseFloat(priceText.replace('$', '').replace(/,/g, ''));
                if (!isNaN(numericValue)) {
                    // Chuyển đổi sang VND
                    const vndValue = Math.round(numericValue * usdToVndRate);
                    originalPriceEl.textContent = vndValue.toLocaleString('vi-VN') + ' ₫';
                    // Đánh dấu là đã xử lý
                    originalPriceEl.classList.add('currency-processed');
                    // Lưu trữ giá trị gốc để chuyển đổi lại
                    originalPriceEl.dataset.usdPrice = numericValue;
                }
            }
        }
        
        if (discountPercentEl) {
            // Chúng ta không thay đổi phần trăm, chỉ đánh dấu là đã xử lý
            discountPercentEl.classList.add('currency-processed');
        }
        
        // Tìm tất cả các phần tử có id="product-final-price" khác
        const allFinalPriceElements = document.querySelectorAll('[id="product-final-price"]');
        allFinalPriceElements.forEach(el => {
            if (!el.classList.contains('currency-processed')) {
                const priceText = el.textContent.trim();
                if (priceText.includes('$')) {
                    const numericValue = parseFloat(priceText.replace('$', '').replace(/,/g, ''));
                    if (!isNaN(numericValue)) {
                        // Chuyển đổi sang VND
                        const vndValue = Math.round(numericValue * usdToVndRate);
                        el.textContent = vndValue.toLocaleString('vi-VN') + ' ₫';
                        // Đánh dấu là đã xử lý
                        el.classList.add('currency-processed');
                        // Lưu trữ giá trị gốc để chuyển đổi lại
                        el.dataset.usdPrice = numericValue;
                    }
                }
            }
        });
        
        // Tìm các phần tử có hiển thị tiền tệ trong văn bản (đối với các phần tử không có ID cụ thể)
        const priceElements = document.querySelectorAll('.text-shopee-orange:not(.currency-processed), .text-gray-500.line-through:not(.currency-processed), .text-orange-500:not(.currency-processed)');
        priceElements.forEach(el => {
            const priceText = el.textContent.trim();
            if (priceText.includes('$')) {
                const numericValue = parseFloat(priceText.replace('$', '').replace(/,/g, ''));
                if (!isNaN(numericValue)) {
                    // Chuyển đổi sang VND
                    const vndValue = Math.round(numericValue * usdToVndRate);
                    el.textContent = priceText.replace('$' + numericValue.toLocaleString('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2}), 
                                                       vndValue.toLocaleString('vi-VN') + ' ₫');
                    // Đánh dấu là đã xử lý
                    el.classList.add('currency-processed');
                    // Lưu trữ giá trị gốc để chuyển đổi lại
                    el.dataset.usdPrice = numericValue;
                }
            }
        });
        
        // Xử lý các phần tử hiển thị "Save X" cho số tiền giảm giá
        const discountElements = document.querySelectorAll('.bg-shopee-orange.text-white.text-xs:not(.currency-processed), .bg-orange-50.text-orange-500:not(.currency-processed)');
        discountElements.forEach(el => {
            const discountText = el.textContent.trim();
            if (discountText.includes('Save $')) {
                const numericValue = parseFloat(discountText.replace('Save $', '').replace(/,/g, ''));
                if (!isNaN(numericValue)) {
                    // Chuyển đổi sang VND
                    const vndValue = Math.round(numericValue * usdToVndRate);
                    el.textContent = 'Save ' + vndValue.toLocaleString('vi-VN') + ' ₫';
                    // Đánh dấu là đã xử lý
                    el.classList.add('currency-processed');
                    // Lưu trữ giá trị gốc để chuyển đổi lại
                    el.dataset.usdPrice = numericValue;
                }
            }
        });
        
        // Kiểm tra meta tag giá sản phẩm (trên trang chi tiết sản phẩm)
        const productPriceMeta = document.querySelector('meta[name="product-price"]');
        const productDiscountMeta = document.querySelector('meta[name="product-discount"]');
        const productFinalPriceMeta = document.querySelector('meta[name="product-final-price"]');
        
        if (productPriceMeta && productFinalPriceMeta && !finalPriceEl) {
            // Chỉ sử dụng meta tag nếu chúng ta chưa cập nhật bằng ID
            const originalPrice = parseFloat(productPriceMeta.content);
            const finalPrice = parseFloat(productFinalPriceMeta.content);
            const discount = productDiscountMeta ? parseFloat(productDiscountMeta.content) : 0;
            
            if (!isNaN(originalPrice)) {
                const vndOriginalPrice = Math.round(originalPrice * usdToVndRate);
                const vndFinalPrice = Math.round(finalPrice * usdToVndRate);
                const vndDiscount = Math.round(discount * usdToVndRate);
                
                // Cập nhật hiển thị giá trên trang sản phẩm
                document.querySelectorAll('.text-3xl.font-medium:not(.currency-processed), .text-shopee-orange.text-3xl.font-medium:not(.currency-processed)').forEach(el => {
                    el.textContent = vndFinalPrice.toLocaleString('vi-VN') + ' ₫';
                    el.classList.add('currency-processed');
                    el.dataset.usdPrice = finalPrice;
                });
                
                // Cập nhật giá gốc nếu có giảm giá
                if (discount > 0) {
                    document.querySelectorAll('.text-gray-500.line-through:not(.currency-processed)').forEach(el => {
                        el.textContent = vndOriginalPrice.toLocaleString('vi-VN') + ' ₫';
                        el.classList.add('currency-processed');
                        el.dataset.usdPrice = originalPrice;
                    });
                }
            }
        }
        
        // Các phần tử giá trong giỏ hàng
        document.querySelectorAll('.cart-dropdown .font-bold.text-shopee-500:not(.currency-processed)').forEach(el => {
            const priceText = el.textContent.trim();
            if (priceText.includes('đ')) {
                const numericValue = parseFloat(priceText.replace(/\./g, '').replace(' đ', ''));
                if (!isNaN(numericValue)) {
                    // Đã ở định dạng VND, chỉ đánh dấu là đã xử lý
                    el.classList.add('currency-processed');
                }
            } else if (priceText.includes('$')) {
                const numericValue = parseFloat(priceText.replace('$', '').replace(/,/g, ''));
                if (!isNaN(numericValue)) {
                    // Chuyển đổi sang VND
                    const vndValue = Math.round(numericValue * usdToVndRate);
                    el.textContent = vndValue.toLocaleString('vi-VN') + ' ₫';
                    el.classList.add('currency-processed');
                    el.dataset.usdPrice = numericValue;
                }
            }
        });
    }
    
    /**
     * Đặt lại tất cả giá về định dạng USD
     */
    function resetPricesToUSD() {
        // Tìm các phần tử được đánh dấu là đã xử lý và chuyển đổi lại về USD
        document.querySelectorAll('.currency-processed').forEach(el => {
            if (el.dataset.usdPrice) {
                const usdPrice = parseFloat(el.dataset.usdPrice);
                if (!isNaN(usdPrice)) {
                    // Kiểm tra xem nó có phải là phần tử giảm giá không
                    if (el.textContent.includes('Save')) {
                        el.textContent = 'Save $' + usdPrice.toLocaleString('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2});
                    } else {
                        el.textContent = '$' + usdPrice.toLocaleString('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2});
                    }
                }
            }
            el.classList.remove('currency-processed');
        });
        
        // Cập nhật trạng thái chọn tiền tệ trên giao diện
        updateCurrencySelectors();
    }
    
    // Trả về các phương thức công khai
    return {
        updateCurrencyDisplay: updateCurrencyDisplay,
        convertPricesToVND: convertPricesToVND,
        resetPricesToUSD: resetPricesToUSD,
        fetchExchangeRates: fetchExchangeRates,
        setDisplayCurrency: setDisplayCurrency,
        getSelectedCurrency: getSelectedCurrency,
        updateCurrencySelectors: updateCurrencySelectors
    };
})();

// Kiểm tra nếu trang được tải lại để cập nhật tiền tệ
document.addEventListener('DOMContentLoaded', function() {
    // Kiểm tra xem có phải vừa thay đổi tiền tệ không
    const isCurrencyChanging = localStorage.getItem('currencyChanging') === 'true';
    const isLanguageChanging = localStorage.getItem('languageChanging') === 'true';
    
    // Xóa trạng thái đánh dấu để ngăn vòng lặp tải lại
    if (isCurrencyChanging) {
        localStorage.removeItem('currencyChanging');
    }
    
    if (isLanguageChanging) {
        localStorage.removeItem('languageChanging');
    }
    
    // Lắng nghe sự kiện thay đổi ngôn ngữ nếu có
    if (window.addEventListener) {
        window.addEventListener('languageChanged', function(e) {
            if (e.detail && e.detail.language) {
                CurrencyConverter.updateCurrencyDisplay(e.detail.language, true);
            }
        });
    }
    
    // Lấy ngôn ngữ hiện tại
    setTimeout(function() {
        // Đảm bảo các biến liên quan đến ngôn ngữ đã được khởi tạo
        if (typeof getCookie === 'function') {
            // Kiểm tra URL hash parameter trước (đáng tin cậy nhất sau khi thay đổi)
            const hash = window.location.hash;
            let currentLang = 'en';
            
            if (hash && hash.includes('googtrans(')) {
                try {
                    const langMatch = hash.match(/googtrans\(([^)]+)\)/);
                    if (langMatch && langMatch[1]) {
                        currentLang = langMatch[1] === 'vi' ? 'vi' : 'en';
                    }
                } catch (e) {
                    console.error('Error parsing language from URL hash:', e);
                }
            } else {
                // Kiểm tra cookie Google Translate
                const googleTranslateCookie = getCookie('googtrans');
                if (googleTranslateCookie) {
                    const langParts = googleTranslateCookie.split('/');
                    if (langParts.length > 2) {
                        currentLang = langParts[2] === 'vi' ? 'vi' : 'en';
                    }
                }
            }
            
            // Cập nhật hiển thị giao diện ngôn ngữ
            const langDisplay = document.getElementById('current-language');
            const langFlag = document.getElementById('current-language-flag');
            
            if (langDisplay) {
                langDisplay.textContent = currentLang === 'vi' ? 'Vietnamese' : 'USA';
            }
            
            if (langFlag) {
                langFlag.src = currentLang === 'vi' ? 
                    'https://cdn.shopify.com/static/images/flags/vn.svg?width=32' : 
                    'https://cdn.shopify.com/static/images/flags/us.svg?width=32';
            }
            
            // Cập nhật chuyển đổi tiền tệ
            CurrencyConverter.updateCurrencyDisplay(currentLang, true);
            
            // Khởi tạo hiển thị trạng thái chọn tiền tệ
            CurrencyConverter.updateCurrencySelectors();
        } else if (typeof detectCurrentLanguage === 'function') {
            // Phương thức dự phòng nếu getCookie không tồn tại
            const currentLang = detectCurrentLanguage();
            CurrencyConverter.updateCurrencyDisplay(currentLang, true);
            CurrencyConverter.updateCurrencySelectors();
        }
    }, 1000); // Tăng thời gian chờ để đảm bảo Google Translate đã hoạt động
});