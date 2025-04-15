<?php include("../layout/header.php");
if ($isLogin) header("Location: /"); ?>

<style>
    /* Enhanced visual styling with better colors and rounded corners */
    .login-container {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff9966 50%, #ffcc33 100%);
        min-height: calc(100vh - 120px);
        position: relative;
        overflow: hidden;
    }
    
    /* Animated background elements */
    .login-container::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -80px;
        animation: float 15s infinite ease-in-out;
    }
    
    .login-container::after {
        content: "";
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -100px;
        left: -50px;
        animation: float 20s infinite ease-in-out reverse;
    }
    
    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(50px, 30px) rotate(180deg); }
        100% { transform: translate(0, 0) rotate(360deg); }
    }
    
    .login-card {
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transform: translateY(0);
        transition: all 0.3s ease;
    }
    
    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }
    
    .login-input {
        padding: 0.85rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .login-input:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
        outline: none;
        transform: translateY(-2px);
    }
    
    .login-btn {
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
    
    .login-btn::before {
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
    
    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(255, 107, 107, 0.3);
    }
    
    .login-btn:hover::before {
        left: 100%;
    }
    
    .login-link {
        color: #ff6b6b;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
    }
    
    .login-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #ff6b6b;
        transition: width 0.3s ease;
    }
    
    .login-link:hover {
        color: #ff4757;
    }
    
    .login-link:hover::after {
        width: 100%;
    }
    
    /* Checkbox styling with animation */
    .login-checkbox {
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
    
    .login-checkbox:checked {
        background-color: #ff6b6b;
        border-color: #ff6b6b;
    }
    
    .login-checkbox:checked::after {
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
    
    /* Button animation for app download links */
    .app-btn {
        transition: all 0.3s ease;
        transform: translateY(0);
    }
    
    .app-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Glowing effect on focus for inputs */
    .input-group {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        transition: all 0.3s ease;
    }
    
    .login-input:focus + .input-icon {
        color: #ff6b6b;
    }
</style>

<section class="login-container flex items-center justify-center py-10 px-4">
    <div class="w-full max-w-md fade-in">
        <!-- Login Card -->
        <div class="login-card bg-white overflow-hidden">
            <div class="p-8">
                <div class="text-center mb-8 fade-in">
                    <img src="/public/uploads/final-ver1.svg" 
                         alt="Gmarket Logo" 
                         class="h-16 mx-auto mb-4 object-contain" 
                         style="width: 200px;">
                    <h2 class="text-2xl font-bold text-gray-800">
                        Welcome Back
                    </h2>
                    <p class="text-gray-500 text-sm mt-2">
                        Log in to your Takashimaya account
                    </p>
                </div>
                
                <?php
                if (isset($_POST['email']) && isset($_POST['password'])) {
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);

                    $checkExist = fetch_array("SELECT * FROM users WHERE email='$email' and password='$password' LIMIT 1");
                    if ($checkExist) {
                        $_SESSION['user_id'] = $checkExist['id'];
                        echo "<div id='login-success' class='bg-green-50 border-l-4 border-green-400 text-green-700 p-4 mb-5 rounded-lg animate__animated animate__fadeIn'>
                                <div class='flex'>
                                    <div class='flex-shrink-0'>
                                        <svg class='h-5 w-5 text-green-400' viewBox='0 0 20 20' fill='currentColor'>
                                            <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z' clip-rule='evenodd' />
                                        </svg>
                                    </div>
                                    <div class='ml-3'>
                                        <p class='font-medium'>Login successful!</p>
                                        <p class='text-sm'>Redirecting to home page...</p>
                                    </div>
                                </div>
                              </div>";
                        echo "<script>setTimeout(function(){ window.location.href='/'; }, 1500);</script>";
                    } else {
                            echo "<div class='bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-5 rounded-lg animate__animated animate__shakeX'>
                                    <div class='flex'>
                                        <div class='flex-shrink-0'>
                                            <svg class='h-5 w-5 text-red-400' viewBox='0 0 20 20' fill='currentColor'>
                                                <path fill-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z' clip-rule='evenodd' />
                                            </svg>
                                        </div>
                                        <div class='ml-3'>
                                            <p class='font-medium'>Login failed</p>
                                            <p class='text-sm'>Invalid email or password. Please try again.</p>
                                        </div>
                                    </div>
                                  </div>";
                        }
                }
                ?>
                
                <form class="space-y-6 fade-in delay-100" action="" method="POST">
                    <input type="hidden" name="_token" value="FuisTlmaDAlYyrjMoSl4jWcxKbP7mlnGeGxCZCvl">
                    
                    <div class="input-group">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <input type="email" name="email" id="email" 
                                class="login-input w-full pl-10" 
                                placeholder="name@company.com" required>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="/password/reset" class="text-xs login-link">
                                Forgot password?
                            </a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="password" 
                                class="login-input w-full pl-10" 
                                placeholder="••••••••" required>
                            <i class="far fa-lock-alt input-icon"></i>
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                                <i class="far fa-eye" id="eye-icon"></i>
                                <i class="far fa-eye-slash hidden" id="eye-off-icon"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox" class="login-checkbox">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-600">
                                Remember me
                            </label>
                        </div>
                    </div>
                    
                    <div class="fade-in delay-200">
                        <button type="submit" class="login-btn hover:shadow-lg">
                            Sign In
                        </button>
                    </div>
                </form>
                
                <div class="mt-8 pt-5 border-t border-gray-100 text-center fade-in delay-300">
                    <p class="text-gray-600 text-sm">
                        Don't have an account yet? 
                        <a href="/users/registration" class="login-link font-medium">
                            Create an account
                        </a>
                    </p>
                </div>
                <div class="mt-8 pt-5 border-t border-gray-100 text-center fade-in delay-300">
                    <p class="text-gray-600 text-sm">
                        
                        <a href="/seller/login.php" class="login-link font-medium">
                            Login as Seller
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- App Promotion -->
        <div class="mt-8 text-center fade-in delay-300">
            <p class="text-white text-sm mb-3 drop-shadow-md">
                Get the best shopping experience with our app
            </p>
            <div class="flex items-center justify-center space-x-4">
                <a href="#" class="app-btn bg-black text-white text-xs py-3 px-4 rounded-xl flex items-center space-x-2 transition-all">
                    <i class="fab fa-apple text-2xl"></i>
                    <div>
                        <div class="text-[0.6rem] opacity-75">Download on the</div>
                        <div class="font-medium">App Store</div>
                    </div>
                </a>
                <a href="#" class="app-btn bg-black text-white text-xs py-3 px-4 rounded-xl flex items-center space-x-2 transition-all">
                    <i class="fab fa-google-play text-2xl"></i>
                    <div>
                        <div class="text-[0.6rem] opacity-75">GET IT ON</div>
                        <div class="font-medium">Google Play</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
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
    
    // Input focus effect
    const inputs = document.querySelectorAll('.login-input');
    inputs.forEach(input => {
        const parentIcon = input.parentElement.querySelector('.input-icon');
        
        input.addEventListener('focus', () => {
            input.style.borderColor = '#ff6b6b';
            if (parentIcon) parentIcon.style.color = '#ff6b6b';
        });
        
        input.addEventListener('blur', () => {
            if (!input.value) {
                input.style.borderColor = '#e2e8f0';
                if (parentIcon) parentIcon.style.color = '#a0aec0';
            }
        });
    });
    
    // Add ripple effect to button
    const loginBtn = document.querySelector('.login-btn');
    loginBtn.addEventListener('mousedown', function(e) {
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
</script>

<?php include("../layout/footer.php") ?>