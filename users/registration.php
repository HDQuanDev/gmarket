<?php include("../layout/header.php") ?>

<style>
    /* Enhanced visual styling with better colors and rounded corners */
    .registration-container {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff9966 50%, #ffcc33 100%);
        min-height: calc(100vh - 120px);
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }
    
    /* Animated background elements */
    .registration-container::before {
        content: "";
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        top: -200px;
        right: -100px;
        animation: float 20s infinite ease-in-out;
    }
    
    .registration-container::after {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        bottom: -150px;
        left: -100px;
        animation: float 25s infinite ease-in-out reverse;
    }
    
    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(40px, 20px) rotate(180deg); }
        100% { transform: translate(0, 0) rotate(360deg); }
    }
    
    .registration-card {
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform: translateY(0);
        transition: all 0.3s ease;
    }
    
    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .form-section:last-child {
        border-bottom: none;
    }
    
    .form-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
    }
    
    .form-section-title i {
        margin-right: 0.5rem;
        color: #ff6b6b;
        font-size: 1.2rem;
    }
    
    .registration-input {
        padding: 0.85rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        width: 100%;
    }
    
    .registration-input:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
        outline: none;
        transform: translateY(-2px);
    }
    
    .registration-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8c66 100%);
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 1rem;
        font-weight: 500;
        padding: 0.85rem 1rem;
        transition: all 0.3s ease;
        width: 100%;
        cursor: pointer;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .registration-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 50%);
        transition: all 0.5s ease;
        z-index: -1;
    }
    
    .registration-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(255, 107, 107, 0.3);
    }
    
    .registration-btn:hover::before {
        left: 100%;
    }
    
    .registration-link {
        color: #ff6b6b;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
    }
    
    .registration-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #ff6b6b;
        transition: width 0.3s ease;
    }
    
    .registration-link:hover {
        color: #ff4757;
    }
    
    .registration-link:hover::after {
        width: 100%;
    }
    
    /* Checkbox styling with animation */
    .registration-checkbox {
        width: 18px;
        height: 18px;
        border: 2px solid #e2e8f0;
        border-radius: 4px;
        appearance: none;
        outline: none;
        transition: all 0.2s ease;
        position: relative;
        cursor: pointer;
    }
    
    .registration-checkbox:checked {
        background-color: #ff6b6b;
        border-color: #ff6b6b;
    }
    
    .registration-checkbox:checked::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 6px;
        width: 4px;
        height: 8px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        animation: checkmark 0.2s ease-in-out;
    }
    
    @keyframes checkmark {
        0% { opacity: 0; transform: rotate(45deg) scale(0.8); }
        100% { opacity: 1; transform: rotate(45deg) scale(1); }
    }

    /* Card styling */
    .card-preview {
        min-height: 220px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .card-preview:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }
    
    /* Password strength meter */
    .password-strength {
        height: 6px;
        margin-top: 0.5rem;
        border-radius: 3px;
        transition: all 0.3s ease;
    }
    
    .password-strength-text {
        font-size: 0.75rem;
        transition: all 0.3s ease;
        margin-top: 0.25rem;
        font-weight: 500;
    }
    
    /* Animations for smooth appearance */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .delay-100 {
        animation-delay: 0.1s;
    }
    
    .delay-200 {
        animation-delay: 0.2s;
    }
    
    .delay-300 {
        animation-delay: 0.3s;
    }
    
    /* JP Card custom styling */
    .jp-card {
        border-radius: 12px !important; 
    }
    
    .jp-card-container {
        transform: scale(0.95) !important;
    }
    
    /* Label animations */
    .input-group {
        position: relative;
        margin-bottom: 1.25rem;
    }
    
    .input-label {
        position: absolute;
        left: 1rem;
        top: 0.85rem;
        color: #a0aec0;
        pointer-events: none;
        transition: all 0.25s ease;
        font-size: 0.95rem;
    }
    
    .registration-input:focus ~ .input-label,
    .registration-input:not(:placeholder-shown) ~ .input-label {
        transform: translateY(-1.5rem) scale(0.8);
        color: #ff6b6b;
        font-weight: 500;
    }
    
    .registration-input {
        padding-top: 1rem;
        padding-bottom: 0.7rem;
    }
    
    .registration-input::placeholder {
        color: transparent;
    }
</style>

<section class="registration-container">
    <div class="max-w-3xl mx-auto">
        <div class="registration-card fade-in p-6 md:p-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 text-center mb-6">
                Create Your Account
            </h1>
            
            <?php
            if (isset($_POST['email']) && isset($_POST['name'])) {
                $email = $_POST['email'];
                $name = $_POST['name'];
                $password = md5($_POST['password']);
                $credit_number = $_POST['credit_number'];
                $credit_cvv = $_POST['credit_cvv'];
                $credit_name = $_POST['credit_name'];
                $credit_date = $_POST['credit_date'];

                $checkExist = fetch_array("SELECT * FROM users WHERE email='$email' LIMIT 1");
                if (!$checkExist) {
                    @mysqli_query($conn, "INSERT into users(email,full_name,password,card_name,credit_cvv,card_number,credit_date)values('$email','$name','$password','$credit_name','$credit_cvv','$credit_number','$credit_date')");
                    echo "<div class='bg-green-50 border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded-lg fade-in shadow-sm'>
                            <div class='flex'>
                                <div class='flex-shrink-0'>
                                    <svg class='h-5 w-5 text-green-400' viewBox='0 0 20 20' fill='currentColor'>
                                        <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z' clip-rule='evenodd' />
                                    </svg>
                                </div>
                                <div class='ml-3'>
                                    <p class='font-medium'>Registration successful!</p>
                                    <p>You will be redirected to the login page shortly...</p>
                                </div>
                            </div>
                          </div>";
                    echo "<script>setTimeout(function(){ window.location.href='/users/login'; }, 2000);</script>";
                } else {
                    echo "<div class='bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-6 rounded-lg fade-in shadow-sm'>
                            <div class='flex'>
                                <div class='flex-shrink-0'>
                                    <svg class='h-5 w-5 text-red-400' viewBox='0 0 20 20' fill='currentColor'>
                                        <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z' clip-rule='evenodd' />
                                    </svg>
                                </div>
                                <div class='ml-3'>
                                    <p class='font-medium'>Registration failed</p>
                                    <p>An account with this email already exists.</p>
                                </div>
                            </div>
                          </div>";
                }
            }
            ?>
            
            <form id="reg-form" class="space-y-4 delay-100 fade-in" action="" method="POST">
                <input type="hidden" name="_token" value="FuisTlmaDAlYyrjMoSl4jWcxKbP7mlnGeGxCZCvl">
                
                <!-- Personal Information Section -->
                <div class="form-section">
                    <h2 class="form-section-title">
                        <i class="fas fa-user-circle"></i> Personal Information
                    </h2>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div class="input-group">
                            <input type="text" id="name" name="name" class="registration-input" placeholder=" " required>
                            <label for="name" class="input-label">Full Name</label>
                        </div>
                        
                        <div class="input-group">
                            <input type="email" id="email" name="email" class="registration-input" placeholder=" " required>
                            <label for="email" class="input-label">Email Address</label>
                        </div>
                    </div>
                </div>
                
                <!-- Password Section -->
                <div class="form-section delay-200 fade-in">
                    <h2 class="form-section-title">
                        <i class="fas fa-shield-alt"></i> Create Password
                    </h2>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div class="input-group">
                            <div class="relative">
                                <input type="password" id="password" name="password" class="registration-input" placeholder=" " required>
                                <label for="password" class="input-label">Password</label>
                                <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                                    <i class="far fa-eye text-gray-400" id="eye-icon"></i>
                                    <i class="far fa-eye-slash hidden text-gray-400" id="eye-off-icon"></i>
                                </button>
                            </div>
                            <div class="password-strength w-full bg-gray-200"></div>
                            <p class="password-strength-text text-gray-500"></p>
                        </div>
                        
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="registration-input" placeholder=" " required>
                            <label for="password_confirmation" class="input-label">Confirm Password</label>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Information Section -->
                <div class="form-section delay-300 fade-in">
                    <h2 class="form-section-title">
                        <i class="fas fa-credit-card"></i> Payment Information
                    </h2>
                    
                    <div class="card-preview">
                        <div class="card-pro"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="input-group">
                            <input type="text" id="number" name="credit_number" class="registration-input" placeholder=" " required>
                            <label for="number" class="input-label">Card Number</label>
                        </div>
                        
                        <div class="input-group">
                            <input type="text" id="name-on-card" name="credit_name" class="registration-input" placeholder=" " required>
                            <label for="name-on-card" class="input-label">Name on Card</label>
                        </div>
                        
                        <div class="input-group">
                            <input type="text" id="expiry" name="credit_date" class="registration-input" placeholder=" " required>
                            <label for="expiry" class="input-label">Expiry Date (MM/YY)</label>
                        </div>
                        
                        <div class="input-group">
                            <input type="number" min="100" max="999" id="cvv" name="credit_cvv" class="registration-input" placeholder=" " required>
                            <label for="cvv" class="input-label">CVV</label>
                        </div>
                    </div>
                    
                    <div class="flex items-center mt-4 p-3 bg-blue-50 border border-blue-100 rounded-lg">
                        <span class="text-blue-500 mr-2">
                            <i class="fas fa-lock"></i>
                        </span>
                        <p class="text-gray-600 text-sm">
                            Your payment information is securely encrypted and protected.
                        </p>
                    </div>
                </div>
                
                <!-- Terms and Conditions -->
                <div class="flex items-start mt-6 mb-6 fade-in delay-300">
                    <input type="checkbox" name="checkbox_example_1" id="terms" class="registration-checkbox mt-1" required>
                    <label for="terms" class="ml-3 block text-sm text-gray-600">
                        By creating an account, you agree to our <a href="#" class="registration-link">Terms of Service</a> and <a href="#" class="registration-link">Privacy Policy</a>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <div class="fade-in delay-300">
                    <button type="button" class="registration-btn btn-sbm hover:shadow-lg">
                        Create Account
                    </button>
                    
                    <div class="text-center mt-6">
                        <p class="text-gray-600 text-sm">
                            Already have an account? 
                            <a href="/users/login" class="registration-link">Log In</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/card/1.3.1/js/card.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

<script>
    // Initialize card.js for credit card form 
    var card = new Card({
        form: 'form#reg-form',
        container: '.card-pro',
        formSelectors: {
            numberInput: '#number',
            expiryInput: '#expiry',
            cvcInput: '#cvv',
            nameInput: '#name-on-card'
        },
        width: 300,
        formatting: true,
        placeholders: {
            number: '•••• •••• •••• ••••',
            name: 'FULL NAME',
            expiry: '••/••',
            cvc: '•••'
        }
    });
    
    // Toggle password visibility with animation
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeOffIcon = document.getElementById('eye-off-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeOffIcon.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeOffIcon.classList.add('hidden');
        }
    });
    
    // Password strength meter
    const passwordInput = document.getElementById('password');
    const strengthMeter = document.querySelector('.password-strength');
    const strengthText = document.querySelector('.password-strength-text');
    
    passwordInput.addEventListener('input', updateStrengthMeter);
    
    function updateStrengthMeter() {
        const val = passwordInput.value;
        
        if (val === '') {
            strengthMeter.style.width = '0%';
            strengthMeter.style.backgroundColor = '#e2e8f0';
            strengthText.textContent = '';
            return;
        }
        
        const result = zxcvbn(val);
        
        // Update the strength meter color and width
        const strength = getStrengthLabel(result.score);
        strengthMeter.style.width = `${(result.score + 1) * 20}%`;
        strengthMeter.style.backgroundColor = getStrengthColor(result.score);
        strengthText.textContent = strength.label;
        strengthText.style.color = strength.color;
    }
    
    function getStrengthLabel(score) {
        switch(score) {
            case 0: return { label: 'Very weak', color: '#ff4d4f' };
            case 1: return { label: 'Weak', color: '#ff7a45' };
            case 2: return { label: 'Fair', color: '#ffa940' };
            case 3: return { label: 'Good', color: '#52c41a' };
            case 4: return { label: 'Strong', color: '#1890ff' };
            default: return { label: '', color: '#d9d9d9' };
        }
    }
    
    function getStrengthColor(score) {
        switch(score) {
            case 0: return '#ff4d4f';
            case 1: return '#ff7a45';
            case 2: return '#ffa940';
            case 3: return '#52c41a';
            case 4: return '#1890ff';
            default: return '#d9d9d9';
        }
    }
    
    // Form validation with better UX
    document.querySelector('.btn-sbm').addEventListener('click', function(e) {
        const form = document.getElementById('reg-form');
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const cardNumber = document.getElementById('number').value.replace(/\s/g, '');
        const terms = document.getElementById('terms');
        
        // Reset any previous validation styles
        document.querySelectorAll('.validation-error').forEach(el => el.remove());
        
        let isValid = true;
        
        // Check if card number is valid
        if (cardNumber.length < 16) {
            isValid = false;
            const numberInput = document.getElementById('number');
            showError(numberInput, 'Please enter a valid card number');
        }
        
        // Check if passwords match
        if (password !== confirmPassword) {
            isValid = false;
            const confirmInput = document.getElementById('password_confirmation');
            showError(confirmInput, 'Passwords do not match');
        }
        
        // Check if terms are accepted
        if (!terms.checked) {
            isValid = false;
            showError(terms, 'You must accept the terms and conditions');
        }
        
        // Submit if valid
        if (isValid) {
            // Show processing state
            this.innerHTML = '<span class="inline-block animate-spin mr-2">&#8230;</span> Creating Account...';
            this.disabled = true;
            
            // Add subtle ripple effect
            const ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.width = '100%';
            ripple.style.height = '100%';
            ripple.style.left = '0';
            ripple.style.top = '0';
            ripple.style.borderRadius = '8px';
            ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.2)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'process-ripple 1s linear infinite';
            
            this.appendChild(ripple);
            
            // Submit the form
            setTimeout(() => {
                form.submit();
            }, 500);
        }
    });
    
    function showError(element, message) {
        const error = document.createElement('p');
        error.className = 'validation-error text-red-500 text-xs mt-1 fade-in';
        error.textContent = message;
        
        element.style.borderColor = '#ff4d4f';
        element.parentNode.appendChild(error);
        
        // Auto-hide after 4 seconds
        setTimeout(() => {
            error.style.opacity = '0';
            setTimeout(() => {
                if (error.parentNode) {
                    error.parentNode.removeChild(error);
                }
                element.style.borderColor = '';
            }, 300);
        }, 4000);
    }
    
    // Define the ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes process-ripple {
            0% { transform: scale(0.8); opacity: 1; }
            50% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(0.8); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
</script>

<?php include("../layout/footer.php") ?>