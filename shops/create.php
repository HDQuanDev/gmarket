<?php include("../layout/header.php") ?>

<style>
    /* Enhanced visual styling with better colors and rounded corners */
    .shop-register-container {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff9966 50%, #ffcc33 100%);
        min-height: calc(100vh - 120px);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
    }
    
    /* Animated background elements */
    .shop-register-container::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -80px;
        animation: float 15s infinite ease-in-out;
        z-index: 0;
    }
    
    .shop-register-container::after {
        content: "";
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -100px;
        left: -50px;
        animation: float 20s infinite ease-in-out reverse;
        z-index: 0;
    }
    
    .content-wrapper {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    
    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(50px, 30px) rotate(180deg); }
        100% { transform: translate(0, 0) rotate(360deg); }
    }
    
    .shop-card {
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform: translateY(0);
        transition: all 0.3s ease;
        margin: 0 auto 1.5rem;
        max-width: 100%;
    }
    
    .shop-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }
    
    .shop-input {
        padding: 0.85rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        width: 100%;
    }
    
    .shop-input:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
        outline: none;
        transform: translateY(-2px);
    }
    
    .shop-btn {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8c66 100%);
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 0.95rem;
        padding: 0.85rem 1rem;
        transition: all 0.3s ease;
        width: 100%;
        cursor: pointer;
        font-weight: 500;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .shop-btn::before {
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
    
    .shop-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(255, 107, 107, 0.3);
    }
    
    .shop-btn:hover::before {
        left: 100%;
    }
    
    .shop-card-header {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff8c66 100%);
        color: white;
        padding: 1.25rem;
        border-radius: 16px 16px 0 0;
        text-align: center;
    }
    
    .shop-card-body {
        padding: 2rem;
    }
    
    @media (max-width: 768px) {
        .shop-card-body {
            padding: 1.5rem;
        }
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #4a5568;
    }
    
    .text-primary {
        color: #ff6b6b !important;
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
    
    .shop-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .shop-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .shop-header p {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.9);
        max-width: 600px;
        margin: 0 auto;
    }
    
    @media (max-width: 576px) {
        .shop-header h1 {
            font-size: 2rem;
        }
        
        .shop-header p {
            font-size: 1rem;
        }
        
        .shop-register-container {
            padding: 2rem 1rem;
        }
    }
    
    .form-check {
        display: flex;
        align-items: flex-start;
    }
    
    .form-check-input {
        margin-top: 0.3rem;
        margin-right: 0.5rem;
    }
</style>

<div class="shop-register-container">
    <div class="content-wrapper">
        <div class="shop-header fade-in">
            <h1>Register Your Shop</h1>
            <p>Start selling your products to millions of customers</p>
        </div>
        
        <?php
        if (isset($_POST['submit'])) {
            $name = trim($_POST['name']);
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $password_confirmation = md5($_POST['password_confirmation']);
            $shop_name = $_POST['shop_name'];
            $address = $_POST['address'];
            $referral_code = $_POST['referral_code'];

            // Get the list of valid referral codes from the system
            $website_config = fetch_array("SELECT referal_code FROM website_appearance LIMIT 1");
            $valid_referral_codes = [];
            
            if (!empty($website_config['referal_code'])) {
                $valid_referral_codes = array_map('trim', explode(',', $website_config['referal_code']));
            }
            
            // Check if the provided referral code is valid
            if (empty($referral_code) || !in_array($referral_code, $valid_referral_codes)) {
                echo "<div class='alert alert-danger rounded-lg shadow-sm mb-4' role='alert'>
                        <div class='d-flex'>
                            <div class='mr-3'>
                                <i class='fas fa-exclamation-circle fa-2x'></i>
                            </div>
                            <div>
                                <h4 class='alert-heading'>Invalid Referral Code</h4>
                                <p class='mb-0'>Please enter a valid referral code to register your shop.</p>
                            </div>
                        </div>
                      </div>";
            } else if ($password != $password_confirmation) {
                echo "<div class='alert alert-danger rounded-lg shadow-sm mb-4' role='alert'>
                        <div class='d-flex'>
                            <div class='mr-3'>
                                <i class='fas fa-exclamation-circle fa-2x'></i>
                            </div>
                            <div>
                                <h4 class='alert-heading'>Password Mismatch</h4>
                                <p class='mb-0'>The two passwords do not match. Please try again.</p>
                            </div>
                        </div>
                      </div>";
            } else {
                $ExistUser = fetch_array("SELECT id FROM users WHERE email='$email' LIMIT 1 ") || fetch_array("SELECT id FROM sellers WHERE email='$email' LIMIT 1 ");
                if ($ExistUser) {
                    echo "<div class='alert alert-danger rounded-lg shadow-sm mb-4' role='alert'>
                            <div class='d-flex'>
                                <div class='mr-3'>
                                    <i class='fas fa-exclamation-circle fa-2x'></i>
                                </div>
                                <div>
                                    <h4 class='alert-heading'>Email Already Exists</h4>
                                    <p class='mb-0'>An account with this email already exists.</p>
                                </div>
                            </div>
                          </div>";
                } else {
                    // Set default status to 'lock' for admin approval
                    $status = 'lock';
                    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                    
                    $query = "INSERT INTO sellers(
                        full_name, 
                        email, 
                        password, 
                        shop_name, 
                        shop_address, 
                        phone, 
                        status, 
                        inviter,
                        is_verified
                    ) VALUES (
                        '$name', 
                        '$email', 
                        '$password', 
                        '$shop_name', 
                        '$address', 
                        '$phone', 
                        '$status', 
                        '$referral_code',
                        0
                    )";
                    
                    $success = mysqli_query($conn, $query);
                    
                    if ($success) {
                        echo "<div class='bg-green-50 border-l-4 border-green-400 p-4 mb-5 rounded-lg'>
                                <div class='flex'>
                                    <div class='flex-shrink-0 mr-3'>
                                        <svg class='h-5 w-5 text-green-400' viewBox='0 0 20 20' fill='currentColor'>
                                            <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z' clip-rule='evenodd' />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class='font-medium text-green-800'>Registration Successful!</p>
                                        <p class='text-sm text-green-700'>Your shop has been registered successfully and is pending approval from our administrators. 
                                        You'll receive an email when your account is approved.</p>
                                    </div>
                                </div>
                              </div>";
                        echo "<script>setTimeout(function(){ window.location.href='/users/login.php'; }, 5000);</script>";
                    } else {
                        echo "<div class='bg-red-50 border-l-4 border-red-400 p-4 mb-5 rounded-lg'>
                                <div class='flex'>
                                    <div class='flex-shrink-0 mr-3'>
                                        <svg class='h-5 w-5 text-red-400' viewBox='0 0 20 20' fill='currentColor'>
                                            <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z' clip-rule='evenodd' />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class='font-medium text-red-800'>Registration Failed</p>
                                        <p class='text-sm text-red-700'>Something went wrong. Please try again later.</p>
                                        <p class='text-xs text-gray-500'>" . mysqli_error($conn) . "</p>
                                    </div>
                                </div>
                              </div>";
                    }
                }
            }
        }
        ?>
        
        <form id="shop" action="" method="POST" enctype="multipart/form-data">
            <!-- Personal Info Card -->
            <div class="shop-card fade-in delay-100">
                <div class="shop-card-header">
                    <h3 class="m-0 font-bold text-lg">Personal Information</h3>
                </div>
                <div class="shop-card-body">
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Your Name <span class="text-red-500">*</span></label>
                        <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-300 focus:border-red-400 focus:outline-none transition-all duration-300" 
                            placeholder="Enter your full name" name="name" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-300 focus:border-red-400 focus:outline-none transition-all duration-300" 
                            placeholder="name@example.com" name="email" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Password <span class="text-red-500">*</span></label>
                        <input type="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-300 focus:border-red-400 focus:outline-none transition-all duration-300" 
                            placeholder="Create a strong password" name="password" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Confirm Password <span class="text-red-500">*</span></label>
                        <input type="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-300 focus:border-red-400 focus:outline-none transition-all duration-300" 
                            placeholder="Repeat your password" name="password_confirmation" required>
                    </div>
                     <div class="mb-0">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Referral Code <span class="text-red-500">*</span></label>
                        <input type="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-300 focus:border-red-400 focus:outline-none transition-all duration-300" 
                            placeholder="referral code" name="referral_code" required>
                    </div>
                </div>
            </div>
            
            <!-- Shop Info Card -->
            <div class="shop-card fade-in delay-200">
                <div class="shop-card-header">
                    <h3 class="m-0 font-bold text-lg">Shop Information</h3>
                </div>
                <div class="shop-card-body">
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Shop Name <span class="text-red-500">*</span></label>
                        <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-300 focus:border-red-400 focus:outline-none transition-all duration-300" 
                            placeholder="Enter your shop name" name="shop_name" required>
                    </div>
                    
                    <div class="mb-0">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Shop Address <span class="text-red-500">*</span></label>
                        <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-300 focus:border-red-400 focus:outline-none transition-all duration-300" 
                            placeholder="Enter your shop address" name="address" required>
                    </div>
                </div>
            </div>
            
            <!-- Terms and Conditions -->
            <div class="shop-card fade-in delay-300">
                <div class="shop-card-body">
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0 mr-3">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-blue-700">Your shop registration will be reviewed by our administrators. 
                                You'll be notified by email once your account is approved.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-start mb-6">
                        <input class="mr-2 mt-1 h-4 w-4 text-red-500 focus:ring-red-400 border-gray-300 rounded" type="checkbox" id="terms" required>
                        <label class="text-sm text-gray-700" for="terms">
                            I agree to the <a href="#" class="text-red-500 hover:underline">Terms of Service</a> and <a href="#" class="text-red-500 hover:underline">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <button type="submit" name="submit" class="shop-btn w-full bg-gradient-to-r from-red-400 to-red-500 text-white py-3 px-4 rounded-lg font-medium hover:from-red-500 hover:to-red-600 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-300 shadow-md hover:shadow-lg">
                        Register Your Shop
                    </button>
                    
                    <div class="text-center mt-6 text-gray-600">
                        Already have a shop account? <a href="/users/login.php" class="text-red-500 font-medium hover:underline">Login here</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Add ripple effect to button
    const shopBtn = document.querySelector('.shop-btn');
    shopBtn.addEventListener('mousedown', function(e) {
        const x = e.clientX - e.target.getBoundingClientRect().left;
        const y = e.clientY - e.target.getBoundingClientRect().top;
        
        const ripple = document.createElement('span');
        ripple.style.position = 'absolute';
        ripple.style.width = '100px';
        ripple.style.height = '100px';
        ripple.style.borderRadius = '50%';
        ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
        ripple.style.transform = 'scale(0)';
        ripple.style.left = `${x}px`;
        ripple.style.top = `${y}px`;
        ripple.style.animation = 'ripple 0.6s linear';
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
    
    // Define the ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Input focus effect
    const inputs = document.querySelectorAll('.shop-input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.borderColor = '#ff6b6b';
        });
        
        input.addEventListener('blur', () => {
            if (!input.value) {
                input.style.borderColor = '#e2e8f0';
            }
        });
    });
</script>

<?php include("../layout/footer.php") ?>