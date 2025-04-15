<?php
require_once(__DIR__ . "/../config.php");

// Redirect if not logged in or is seller
if (!$isLogin) {
    header("Location: /users/login?redirect=/checkout/delivery_info");
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

// Get address details
$address_id = $_POST['address_id'];
$address_query = "SELECT * FROM address WHERE id = $address_id AND user_id = $user_id LIMIT 1";
$address_result = mysqli_query($conn, $address_query);
$address = mysqli_fetch_assoc($address_result);

if (!$address) {
    header("Location: /checkout");
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
    
    $img_url = $item['thumbnail_image'] ? get_image($conn, $item['thumbnail_image']) : "/public/assets/img/placeholder.jpg";
    
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
$final_shipping_cost = 0; // After discount

// Calculate total price including shipping
$total = $subtotal + $final_shipping_cost;

// Available shipping methods
$shipping_methods = [
    [
        'id' => 'standard',
        'name' => 'Standard Delivery',
        'description' => 'Estimated delivery: 3-5 days',
        'is_free' => true,
        'original_cost' => $shipping_cost,
        'final_cost' => $final_shipping_cost
    ],
    [
        'id' => 'express',
        'name' => 'Express Delivery',
        'description' => 'Estimated delivery: 1-2 days',
        'is_free' => false,
        'original_cost' => 35000,
        'final_cost' => 35000
    ]
];

// Update session with delivery info
$_SESSION['checkout_address'] = $address;
$_SESSION['cart_summary'] = [
    'subtotal' => $subtotal,
    'shipping_cost' => $final_shipping_cost,
    'total' => $total,
    'items' => $total_items,
    'sellers' => array_keys($sellers)
];

require_once(__DIR__ . "/../layout/header.php");
?>

<style>
  body {
    background-color: #f5f5f5;
    font-family: Roboto, Helvetica, Arial, sans-serif;
  }
  .line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
  }
  .shipping-option.selected {
    border-color: #ee4d2d;
    background-color: #fff0ea;
  }
  .shipping-option.selected .check-circle {
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
            <div class="h-0.5 w-full bg-shopee-orange"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-shopee-orange text-white flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
              </svg>
            </div>
            <span class="text-xs font-medium text-shopee-orange">Shipping</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-gray-200"></div>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <span class="text-xs text-gray-500">Payment</span>
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

    <!-- Checkout Content -->
    <div class="max-w-4xl mx-auto">
      <!-- Delivery Address Summary -->
      <div class="bg-white rounded-sm shadow-sm p-4 mb-4">
        <div class="flex justify-between items-center mb-2">
          <h2 class="text-base font-medium">Delivery Address</h2>
          <a href="/checkout" class="text-shopee-orange text-sm">Change</a>
        </div>
        <div class="text-sm text-gray-600">
          <div class="flex items-start">
            <div class="text-gray-800 font-medium mr-2">Address:</div>
            <div><?= htmlspecialchars($address['address']) ?></div>
          </div>
          <div class="flex items-start mt-1">
            <div class="text-gray-800 font-medium mr-2">Postal Code:</div>
            <div><?= htmlspecialchars($address['post_code']) ?></div>
          </div>
          <div class="flex items-start mt-1">
            <div class="text-gray-800 font-medium mr-2">Phone:</div>
            <div><?= htmlspecialchars($address['phone']) ?></div>
          </div>
        </div>
      </div>

      <!-- Form Container -->
      <form action="/checkout/payment_select" method="POST">
        <input type="hidden" name="_token" value="<?= md5(time()) ?>">
        <input type="hidden" name="address_id" value="<?= $address_id ?>">
        
        <!-- Order Items by Seller -->
        <?php foreach ($sellers as $seller_id => $seller): ?>
          <div class="bg-white rounded-sm shadow-sm mb-4">
            <!-- Seller Header -->
            <div class="p-4 border-b border-gray-100 flex items-center">
              <?php if (!empty($seller['logo'])): ?>
                <img src="<?= get_image($conn,$seller['logo'] )?>" alt="<?= $seller['name'] ?>" class="w-6 h-6 rounded-full">
              <?php else: ?>
                <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center text-white text-xs">
                  <?= strtoupper(substr($seller['name'], 0, 1)) ?>
                </div>
              <?php endif; ?>
              <span class="ml-2 font-medium"><?= htmlspecialchars($seller['name']) ?></span>
            </div>
            
            <!-- Products List -->
            <div class="p-4">
              <?php foreach ($seller['items'] as $item): ?>
                <div class="flex items-center py-2 border-b border-gray-100 last:border-0">
                  <div class="w-12 h-12 flex-shrink-0">
                    <img src="<?= $item['img'] ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-cover rounded">
                  </div>
                  <div class="ml-3 flex-1">
                    <div class="text-sm line-clamp-2"><?= htmlspecialchars($item['name']) ?></div>
                    <div class="text-xs text-gray-500 mt-1">Qty: <?= $item['quantity'] ?></div>
                  </div>
                  <div class="text-shopee-orange text-sm">$<?= number_format($item['item_total'], 0, ',', '.') ?></div>
                </div>
              <?php endforeach; ?>
            </div>
            
            <!-- Shipping Options -->
            <div class="p-4 bg-gray-50">
              <h3 class="text-sm font-medium mb-3">Shipping Method</h3>
              
              <?php foreach ($shipping_methods as $index => $method): ?>
                <div class="shipping-option relative border border-gray-200 rounded p-3 mb-2 <?= $index === 0 ? 'selected' : '' ?> cursor-pointer" 
                     onclick="selectShippingMethod(this, '<?= $method['id'] ?>', <?= $seller_id ?>)">
                  <input type="radio" name="shipping_method[<?= $seller_id ?>]" value="<?= $method['id'] ?>" class="hidden" <?= $index === 0 ? 'checked' : '' ?>>
                  
                  <!-- Check circle indicator -->
                  <div class="check-circle absolute top-3 right-3 w-5 h-5 bg-shopee-orange rounded-full items-center justify-center text-white <?= $index === 0 ? 'flex' : 'hidden' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  
                  <div class="flex flex-col">
                    <div class="flex items-center mb-1">
                      <span class="text-sm font-medium"><?= $method['name'] ?></span>
                      <?php if ($method['is_free']): ?>
                        <span class="ml-2 text-xs bg-shopee-light text-shopee-orange px-1 py-0.5 rounded">Free</span>
                      <?php endif; ?>
                    </div>
                    <div class="text-xs text-gray-500"><?= $method['description'] ?></div>
                    <div class="flex items-center mt-1">
                      <?php if ($method['is_free'] && $method['original_cost'] > 0): ?>
                        <span class="text-xs text-gray-400 line-through mr-2">$<?= number_format($method['original_cost'], 0, ',', '.') ?></span>
                        <span class="text-xs text-shopee-orange">$<?= number_format($method['final_cost'], 0, ',', '.') ?></span>
                      <?php else: ?>
                        <span class="text-xs">$<?= number_format($method['final_cost'], 0, ',', '.') ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>

        <!-- Order Summary -->
        <div class="bg-white rounded-sm shadow-sm p-6">
          <h2 class="font-medium mb-4 border-b border-gray-100 pb-2">Order Summary</h2>
          <div class="space-y-2 text-sm">
            <div class="flex justify-between">
              <span class="text-gray-500">Subtotal (<?= $total_items ?> items):</span>
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
            
            <div class="flex justify-between pt-2 border-t border-gray-100 font-medium">
              <span>Total:</span>
              <span class="text-shopee-orange">$<?= number_format($total, 0, ',', '.') ?></span>
            </div>
          </div>
          
          <!-- Navigation Buttons -->
          <div class="flex flex-col-reverse sm:flex-row items-center justify-between mt-6">
            <a href="/checkout" class="text-shopee-orange hover:underline mt-3 sm:mt-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Return to Address
            </a>
            <button type="submit" class="w-full sm:w-auto bg-shopee-orange text-white py-2.5 px-6 rounded-sm hover:bg-shopee-orange/90">
              Continue to Payment
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Shipping method selection
  function selectShippingMethod(element, methodId, sellerId) {
    // Find all shipping options for this seller
    const sellerOptions = document.querySelectorAll(`.shipping-option input[name="shipping_method[${sellerId}]"]`);
    
    // Reset all options for this seller
    sellerOptions.forEach(input => {
      input.parentElement.classList.remove('selected');
      input.parentElement.querySelector('.check-circle').classList.add('hidden');
      input.parentElement.querySelector('.check-circle').classList.remove('flex');
      input.checked = false;
    });
    
    // Select this option
    element.classList.add('selected');
    element.querySelector('.check-circle').classList.remove('hidden');
    element.querySelector('.check-circle').classList.add('flex');
    element.querySelector('input').checked = true;
    
    // Here you could also update the shipping cost if needed with AJAX
    // For now, we'll just submit the form when they continue
  }
</script>

<?php include("../layout/footer.php"); ?>