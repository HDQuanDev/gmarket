<?php
require_once(__DIR__ . "/../config.php");

// Redirect if not logged in or is seller
if (!$isLogin) {
    header("Location: /users/login?redirect=/checkout/payment_select");
    exit;
} else if ($isSeller) {
    header("Location: /seller/index.php");
    exit;
}

// Check if address_id is provided
if (!isset($_POST['address_id']) || empty($_POST['address_id'])) {
    header("Location: /checkout");
    exit;
}

$address_id = $_POST['address_id'];
$shipping_method = isset($_POST['shipping_method']) ? $_POST['shipping_method'] : ['home_delivery'];

// Get address details
$address_check = fetch_array("SELECT * FROM address WHERE id='$address_id' AND user_id='$user_id' LIMIT 1");
if (!$address_check) {
    header("Location: /checkout");
    exit;
}

$address_formatted = $address_check ? $address_check['address'] . ", " . $address_check['post_code'] : "";

// Process order submission
if (isset($_POST['submit'])) {
    $payment_option = $_POST['payment_option'];
    $payment_status = $payment_option == "cash_on_delivery" ? "unpaid" : "paid";
    $additional_info = $_POST['additional_info'];
    $pay_img_id = isset($_POST['photo']) && !empty($_POST['photo']) ? intval($_POST['photo']) : NULL;
    $address = $address_check ? $address_check['address'] . " , " . $address_check['post_code'] : "";
    $phone = $address_check ? $address_check["phone"] : "";
    
    // Calculate order total
    $amount = 0;
    $cart_query = "SELECT c.*, p.seller_id, p.rose, p.name
                  FROM cart c 
                  JOIN products p ON c.product_id = p.id 
                  WHERE c.user_id = ?";
    $stmt = $conn->prepare($cart_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $cart_result = $stmt->get_result();
    $cart_items = [];
    
    while ($item = $cart_result->fetch_assoc()) {
        $price = $item['price'];
        $quantity = $item['quantity'];
        $amount += $quantity * $price;
        $cart_items[] = $item;
    }
    
    // Generate unique order code
    $code = date("Ymd") . "-" . time();
    
    // Create order in database
    $insert_order_query = "INSERT INTO orders(code, amount, additional_info, payment_option,payment_status, pay_img_id, user_id, address, create_date, phone) 
                           VALUES(?, ?, ?,?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($insert_order_query);
    $stmt->bind_param("sdsssiiss", $code, $amount, $additional_info, $payment_option,$payment_status, $pay_img_id, $user_id, $address, $phone);
    $stmt->execute();
    $order_id = $conn->insert_id;
    
    // Create order details and update seller commission if applicable
    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $price = $item['price'];
        $quantity = $item['quantity'];
        $name = $item['name'];
        $rose = $item['rose'];
        $seller_id = $item['seller_id'];
        
        $product_img = fetch_array("SELECT f.src FROM file f 
                                  JOIN products p ON f.id = p.thumbnail_image 
                                  WHERE p.id = '$product_id' LIMIT 1");
        $img_path = $product_img ? "/public/uploads/all/" . $product_img['src'] : "/public/assets/img/placeholder.jpg";
        
        $insert_detail_query = "INSERT INTO detail_orders(
                               rose, from_seller, order_id, price, name, quantity, img, user_id, create_date) 
                               VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $detail_stmt = $conn->prepare($insert_detail_query);
        $detail_stmt->bind_param("diiisdsi", $rose, $seller_id, $order_id, $price, $name, $quantity, $img_path, $user_id);
        $detail_stmt->execute();
        
        if ($seller_id) {
            mysqli_query($conn, "UPDATE sellers SET rose = rose + $rose, money = money + $rose WHERE id = '$seller_id' LIMIT 1");
            mysqli_query($conn, "UPDATE products SET quantity = quantity - $quantity WHERE id = '$product_id' LIMIT 1");
        }
    }
    
    // Clear cart after successful order
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
    
    // Redirect to order confirmation
    header("Location: /checkout/order-confirmed?order=$code");
    exit;
}

// Get cart items grouped by seller
$cart_items = [];
$sellers = [];
$seller_subtotals = [];
$subtotal = 0;
$total_items = 0;

// Query cart items with product and seller details
$cart_query = "SELECT c.*, p.name, p.thumbnail_image, 
              s.id as seller_id, s.full_name as seller_name, s.shop_logo
              FROM cart c 
              JOIN products p ON c.product_id = p.id 
              LEFT JOIN sellers s ON p.seller_id = s.id
              WHERE c.user_id = $user_id
              ORDER BY s.id, c.created_at DESC";
$cart_result = mysqli_query($conn, $cart_query);

// Process cart items
while ($item = mysqli_fetch_assoc($cart_result)) {
    // Get product image
    $product_image = fetch_array("SELECT src FROM file WHERE id = '{$item['thumbnail_image']}' LIMIT 1");
    $img_url = $product_image ? "/public/uploads/all/" . $product_image['src'] : "/public/assets/img/placeholder.jpg";
    
    // Calculate item total
    $item_total = $item['price'] * $item['quantity'];
    $subtotal += $item_total;
    $total_items += $item['quantity'];
    
    $seller_id = $item['seller_id'] ?? 0;
    $seller_name = $item['seller_name'] ?? 'Unknown Seller';
    
    // Initialize seller data if not exists
    if (!isset($sellers[$seller_id])) {
        $sellers[$seller_id] = [
            'id' => $seller_id,
            'name' => $seller_name,
            'logo' => $item['shop_logo'] ?? '',
            'items' => []
        ];
        $seller_subtotals[$seller_id] = 0;
    }
    
    // Add to seller's subtotal
    $seller_subtotals[$seller_id] += $item_total;
    
    // Add to seller's items
    $sellers[$seller_id]['items'][] = [
        'id' => $item['id'],
        'product_id' => $item['product_id'],
        'name' => $item['name'],
        'quantity' => $item['quantity'],
        'price' => $item['price'],
        'item_total' => $item_total,
        'img' => $img_url
    ];
}

// Calculate shipping and total
$shipping_cost = 20000; // Default shipping cost in VND
$shipping_discount = 20000; // Shipping discount for free shipping
$final_shipping_cost = 0; // Free shipping after discount

// Calculate total price including shipping
$total = $subtotal + $final_shipping_cost;

// Payment methods available
$payment_methods = [
    [
        'id' => 'cash_on_delivery',
        'name' => 'Cash On Delivery',
        'description' => 'Pay when you receive the package',
        'image' => '/public/assets/img/cards/cod.png'
    ],
    [
        'id' => 'bank_transfer',
        'name' => 'Bank Transfer',
        'description' => 'Pay via bank transfer',
        'image' => '/public/assets/img/cards/bank_transfer.png'
    ],
    [
        'id' => 'card_payment',
        'name' => 'Credit/Debit Card',
        'description' => 'Visa, Mastercard, Amex, JCB',
        'image' => '/public/assets/img/cards/credit_card.png'
    ]
];

require_once(__DIR__ . "/../layout/header.php");
?>

<style>
  .payment-option.selected {
    border-color: #ee4d2d;
    background-color: #fff0ea;
  }
  .payment-option.selected .check-circle {
    display: flex;
  }
</style>

<div class="bg-shopee-gray min-h-screen pb-10">
  <div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <!-- Checkout Steps -->
    <div class="flex justify-center mb-8">
      <div class="w-full max-w-4xl">
        <div class="flex justify-between">
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-green-600">Cart</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-green-500"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-green-600">Address</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-green-500"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-green-600">Shipping</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-shopee-orange"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-shopee-orange text-white flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <span class="text-xs font-medium text-shopee-orange">Payment</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-gray-200"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-gray-500">Complete</span>
          </div>
        </div>
      </div>
    </div>

    <div class="max-w-4xl mx-auto">
      <!-- Checkout Content -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Left Column - Payment Options -->
        <div class="lg:col-span-2">
          <form action="" method="POST" id="checkout-form">
            <input type="hidden" name="_token" value="<?= md5(time()) ?>"> 
            <input type="hidden" name="address_id" value="<?= $address_id ?>">
            <?php foreach($shipping_method as $seller_id => $method): ?>
              <input type="hidden" name="shipping_method[<?= $seller_id ?>]" value="<?= $method ?>">
            <?php endforeach; ?>
            
            <!-- Shipping Information Summary -->
            <div class="bg-white rounded-sm shadow-sm p-4 mb-4">
              <div class="flex justify-between items-center mb-2">
                <h2 class="text-base font-medium">Delivery Address</h2>
                <a href="/checkout" class="text-shopee-orange text-sm">Change</a>
              </div>
              <div class="text-sm text-gray-600">
                <div class="flex items-start">
                  <div class="text-gray-800 font-medium mr-2">Address:</div>
                  <div><?= htmlspecialchars($address_check['address']) ?></div>
                </div>
                <div class="flex items-start mt-1">
                  <div class="text-gray-800 font-medium mr-2">Postal Code:</div>
                  <div><?= htmlspecialchars($address_check['post_code']) ?></div>
                </div>
                <div class="flex items-start mt-1">
                  <div class="text-gray-800 font-medium mr-2">Phone:</div>
                  <div><?= htmlspecialchars($address_check['phone']) ?></div>
                </div>
              </div>
            </div>
            
            <!-- Payment Methods -->
            <div class="bg-white rounded-sm shadow-sm p-4 mb-4">
              <h2 class="text-base font-medium mb-4">Payment Method</h2>
              
              <div class="space-y-3">
                <?php foreach($payment_methods as $index => $method): ?>
                <div class="payment-option relative border border-gray-200 rounded p-3 cursor-pointer hover:border-gray-300 <?= $index === 0 ? 'selected' : '' ?>"
                     onclick="selectPaymentMethod(this, '<?= $method['id'] ?>')">
                  <input type="radio" name="payment_option" value="<?= $method['id'] ?>" class="hidden" <?= $index === 0 ? 'checked' : '' ?>>
                  
                  <!-- Check circle indicator -->
                  <div class="check-circle absolute top-3 right-3 w-5 h-5 bg-shopee-orange rounded-full items-center justify-center text-white <?= $index === 0 ? 'flex' : 'hidden' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  
                  <div class="flex items-center">
                    <div class="w-12 h-12 flex-shrink-0 mr-4">
                      <img src="<?= $method['image'] ?>" alt="<?= $method['name'] ?>" class="w-full h-full object-contain">
                    </div>
                    <div>
                      <p class="font-medium"><?= $method['name'] ?></p>
                      <p class="text-xs text-gray-500 mt-1"><?= $method['description'] ?></p>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            
            <!-- Additional Information -->
            <div class="bg-white rounded-sm shadow-sm p-4 mb-4">
              <h2 class="text-base font-medium mb-4">Additional Information (Optional)</h2>
              <textarea name="additional_info" rows="3" class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:border-shopee-orange" placeholder="Any special instructions for delivery or order?"></textarea>
            </div>
            
            <!-- Payment Receipt Upload (Optional) -->
            <div class="bg-white rounded-sm shadow-sm p-4 mb-4">
              <h2 class="text-base font-medium mb-4">Payment Receipt (Optional)</h2>
              <div class="flex items-center space-x-4">
                <div class="flex-1">
                  <div class="flex items-center">
                    <div class="relative">
                      <input type="file" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" id="receipt-upload">
                      <div class="border border-dashed border-gray-300 rounded flex items-center justify-center h-10 px-4 text-sm text-gray-500">Choose File</div>
                    </div>
                    <span class="ml-4 text-xs text-gray-500" id="file-name">No file chosen</span>
                    <input type="hidden" name="photo" class="selected-files">
                  </div>
                  <p class="text-xs text-gray-500 mt-1">Upload a screenshot or photo of your payment receipt</p>
                </div>
              </div>
            </div>
            
            <!-- Terms & Conditions -->
            <div class="bg-white rounded-sm shadow-sm p-4 mb-4">
              <div class="flex items-start">
                <input type="checkbox" id="agree_checkbox" class="mt-1" required>
                <label for="agree_checkbox" class="ml-2 text-sm text-gray-700">
                  By completing your purchase, you agree to the 
                  <a href="/terms" class="text-shopee-orange hover:underline">Terms of Service</a>, 
                  <a href="/return-policy" class="text-shopee-orange hover:underline">Return Policy</a> & 
                  <a href="/privacy-policy" class="text-shopee-orange hover:underline">Privacy Policy</a>
                </label>
              </div>
            </div>
            
            <!-- Navigation Buttons -->
            <div class="flex flex-col-reverse sm:flex-row items-center justify-between">
              <a href="/checkout/delivery_info" class="text-shopee-orange hover:underline mt-3 sm:mt-0" onclick="history.back(); return false;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Return to Shipping
              </a>
              <button type="submit" name="submit" class="w-full sm:w-auto bg-shopee-orange text-white py-2.5 px-6 rounded-sm hover:bg-shopee-orange/90 disabled:bg-gray-300 disabled:cursor-not-allowed" id="complete-order-btn" disabled>
                Complete Order
              </button>
            </div>
          </form>
        </div>
        
        <!-- Right Column - Order Summary -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-sm shadow-sm p-4 sticky top-4">
            <h2 class="font-medium mb-4 border-b border-gray-100 pb-2">Order Summary</h2>
            
            <!-- Order Items Summary (Collapsed) -->
            <div class="mb-4">
              <div class="flex items-center justify-between mb-2 cursor-pointer" id="toggle-items">
                <span class="text-sm font-medium"><?= $total_items ?> items in cart</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" id="toggle-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
              
              <div class="hidden border-t border-b border-gray-100 py-2 space-y-2 text-sm" id="order-items">
                <?php foreach ($sellers as $seller): ?>
                  <div class="text-xs font-medium pb-1"><?= htmlspecialchars($seller['name']) ?></div>
                  <?php foreach ($seller['items'] as $item): ?>
                    <div class="flex justify-between items-center">
                      <div class="flex items-center">
                        <span class="text-gray-500"><?= $item['quantity'] ?>×</span>
                        <span class="ml-1 truncate max-w-[120px]"><?= htmlspecialchars($item['name']) ?></span>
                      </div>
                      <span>$<?= number_format($item['item_total'], 0, ',', '.') ?></span>
                    </div>
                  <?php endforeach; ?>
                  <div class="border-t border-dashed border-gray-100 my-1"></div>
                <?php endforeach; ?>
              </div>
            </div>
            
            <!-- Price Details -->
            <div class="space-y-2 text-sm">
              <div class="flex justify-between">
                <span class="text-gray-500">Subtotal:</span>
                <span>$<?= number_format($subtotal, 0, ',', '.') ?></span>
              </div>
              
              <div class="flex justify-between">
                <span class="text-gray-500">Shipping Fee:</span>
                <div class="flex items-center">
                  <?php if ($shipping_cost > 0): ?>
                    <span class="text-gray-400 line-through mr-2">$<?= number_format($shipping_cost, 0, ',', '.') ?></span>
                  <?php endif; ?>
                  <span class="text-shopee-orange"><?= $final_shipping_cost > 0 ? '$'.number_format($final_shipping_cost, 0, ',', '.') : 'FREE' ?></span>
                </div>
              </div>
              
              <!-- Apply Voucher Section (Optional) -->
              <div class="pt-2 pb-2">
                <div class="flex items-center justify-between text-sm border-t border-gray-100 pt-2">
                  <input type="text" placeholder="Enter voucher code" class="border border-gray-300 rounded py-1 px-2 text-xs flex-1 focus:outline-none">
                  <button class="ml-2 bg-gray-100 text-xs py-1 px-2 rounded hover:bg-gray-200">Apply</button>
                </div>
              </div>
              
              <div class="flex justify-between pt-2 border-t border-gray-100 font-medium">
                <span>Total:</span>
                <span class="text-shopee-orange">$<?= number_format($total, 0, ',', '.') ?></span>
              </div>
              
              <!-- Order Protection Banner -->
              <div class="flex items-center mt-4 pt-3 border-t border-gray-100">
                <div class="w-7 h-7 flex-shrink-0 mr-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-shopee-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                  </svg>
                </div>
                <span class="text-xs text-gray-500">Shopee guarantees your order will be delivered or your money back.</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Payment method selection
  function selectPaymentMethod(element, methodId) {
    // Reset all payment options
    document.querySelectorAll('.payment-option').forEach(option => {
      option.classList.remove('selected');
      option.querySelector('.check-circle').classList.add('hidden');
      option.querySelector('.check-circle').classList.remove('flex');
      option.querySelector('input').checked = false;
    });
    
    // Select this option
    element.classList.add('selected');
    element.querySelector('.check-circle').classList.remove('hidden');
    element.querySelector('.check-circle').classList.add('flex');
    element.querySelector('input').checked = true;
  }

  document.addEventListener('DOMContentLoaded', function() {
    // Toggle order items
    const toggleItems = document.getElementById('toggle-items');
    const orderItems = document.getElementById('order-items');
    const toggleIcon = document.getElementById('toggle-icon');
    
    toggleItems.addEventListener('click', function() {
      orderItems.classList.toggle('hidden');
      toggleIcon.classList.toggle('rotate-180');
    });
    
    // File upload handling
    const fileUpload = document.getElementById('receipt-upload');
    const fileName = document.getElementById('file-name');
    const fileInput = document.querySelector('.selected-files');
    
    fileUpload.addEventListener('change', function(e) {
      if (e.target.files.length > 0) {
        fileName.textContent = e.target.files[0].name;
        
        // Here you would normally upload the file to your server
        // and then set the hidden input value to the returned ID
        // For now, we'll just simulate this
        fileInput.value = '123'; // This would be the ID returned from your upload handler
      }
    });
    
    // Agreement checkbox
    const agreeCheckbox = document.getElementById('agree_checkbox');
    const completeOrderBtn = document.getElementById('complete-order-btn');
    
    agreeCheckbox.addEventListener('change', function() {
      completeOrderBtn.disabled = !agreeCheckbox.checked;
    });
    
    // Form validation
    const checkoutForm = document.getElementById('checkout-form');
    checkoutForm.addEventListener('submit', function(e) {
      if (!agreeCheckbox.checked) {
        e.preventDefault();
        alert('Please agree to the terms and conditions before completing your order.');
      }
    });
  });
</script>

<?php include("../layout/footer.php"); ?>