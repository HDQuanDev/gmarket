<?php 
require_once(__DIR__ . "/../layout/header.php");

// Redirect to login if not logged in
if (!$isLogin) {
    header("Location: /users/login?redirect=/cart");
    exit;
}

// Get cart items from database
$cart_items = [];
$subtotal = 0;
$total_items = 0;
$shipping_cost = 20000; // Default shipping cost in VND
$shipping_discount = 20000; // Shipping discount in VND
$final_shipping_cost = $shipping_cost - $shipping_discount; // Final shipping cost after discount

// Query cart items with product details, including seller information
$cart_query = "SELECT c.*, p.name, p.thumbnail_image, p.quantity as available_quantity,
              s.id as seller_id, s.full_name as seller_name, s.shop_logo
              FROM cart c 
              JOIN products p ON c.product_id = p.id 
              LEFT JOIN sellers s ON p.seller_id = s.id
              WHERE c.user_id = ?
              ORDER BY s.id, c.created_at DESC"; // Group by seller_id first

$stmt = $conn->prepare($cart_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Process cart items and organize by seller
$sellers = [];
$seller_subtotals = [];

// Process cart items
while ($item = $result->fetch_assoc()) {
    // Get product image
    $product_image = fetch_array("SELECT src FROM file WHERE id = '{$item['thumbnail_image']}' LIMIT 1");
    $img_url = $item['thumbnail_image'] ? "/public/uploads/all/" . $item['thumbnail_image'] : "/public/assets/img/placeholder.jpg";
    
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
        'img' => $img_url,
        'available_quantity' => $item['available_quantity']
    ];
}

// Sort sellers by total purchase amount
uasort($sellers, function($a, $b) use ($seller_subtotals) {
    return $seller_subtotals[$b['id']] <=> $seller_subtotals[$a['id']];
});

// Calculate total price including shipping
$total = $subtotal + $final_shipping_cost;

// Store cart summary in session for checkout
$_SESSION['cart_summary'] = [
    'subtotal' => $subtotal,
    'shipping_cost' => $final_shipping_cost,
    'total' => $total,
    'items' => $total_items,
    'sellers' => array_keys($sellers) // Store seller IDs for checkout processing
];
?>


<style>
  .line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
  }
  .seller-section:not(:last-child) {
    border-bottom: 1px solid #f0f0f0;
    margin-bottom: 8px;
  }
</style>

<div class="bg-shopee-gray min-h-screen pb-10">
  <div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <!-- Cart Steps -->
    <div class="flex justify-center mb-8">
      <div class="w-full max-w-4xl relative">
        <!-- Progress Bar -->
        <div class="absolute top-5 left-0 right-0 h-0.5 bg-gray-200">
          <div class="h-0.5 bg-shopee-shopee-orange" style="width: 0%"></div>
        </div>
        
        <!-- Steps -->
        <div class="flex justify-between relative z-10">
          <!-- Step 1: Cart -->
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-shopee-shopee-orange text-white flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
            </div>
            <span class="text-xs font-medium text-shopee-shopee-orange">Cart</span>
          </div>

          <!-- Step 2: Address -->
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <span class="text-xs text-gray-500">Address</span>
          </div>

          <!-- Step 3: Payment -->
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <span class="text-xs text-gray-500">Payment</span>
          </div>

          <!-- Step 4: Complete -->
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

    <!-- Cart Content -->
    <?php if (count($sellers) > 0): ?>
      <!-- Cart Header -->
      <div class="flex items-center justify-between mb-3">
        <h1 class="text-xl font-medium">Shopping Cart</h1>
        <span class="text-gray-500 text-sm"><?= $total_items ?> item(s)</span>
      </div>
      
      <!-- Seller Sections -->
      <?php foreach ($sellers as $seller): ?>
        <div class="bg-white rounded-sm shadow-sm mb-3">
          <!-- Seller Header -->
          <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center">
              <?php if (!empty($seller['logo'])): ?>
                <img src="<?= '/public/uploads/' . $seller['logo'] ?>" alt="<?= $seller['name'] ?>" class="w-6 h-6 rounded-full">
              <?php else: ?>
                <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center text-white text-xs">
                  <?= strtoupper(substr($seller['name'], 0, 1)) ?>
                </div>
              <?php endif; ?>
              <span class="ml-2 font-medium"><?= $seller['name'] ?></span>
              <span class="ml-auto text-shopee-orange text-sm">$<?= number_format($seller_subtotals[$seller['id']], 0, ',', '.') ?></span>
            </div>
          </div>
          
          <!-- Item Headers -->
          <div class="grid grid-cols-12 gap-4 px-6 py-3 border-b border-gray-100 text-sm font-medium text-gray-500 hidden md:grid">
            <div class="col-span-6">Product</div>
            <div class="col-span-2 text-center">Unit Price</div>
            <div class="col-span-2 text-center">Quantity</div>
            <div class="col-span-1 text-center">Total</div>
            <div class="col-span-1 text-center">Actions</div>
          </div>

          <!-- Cart Items for this seller -->
          <?php foreach ($seller['items'] as $item): ?>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-4 md:px-6 py-4 border-b border-gray-100 items-center" id="cart-item-<?= $item['id'] ?>">
              <!-- Product info (mobile) -->
              <div class="md:hidden flex items-start space-x-3 mb-3">
                <div class="w-16 h-16 flex-shrink-0">
                  <img src="<?= $item['img'] ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-contain">
                </div>
                <div>
                  <a href="/product/<?= $item['product_id'] ?>" class="line-clamp-2 text-gray-800 font-medium">
                    <?= $item['name'] ?>
                  </a>
                </div>
              </div>
              
              <!-- Desktop layout -->
              <div class="md:col-span-6 hidden md:block">
                <div class="flex items-center">
                  <div class="w-16 h-16 flex-shrink-0">
                    <img src="<?= $item['img'] ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-contain">
                  </div>
                  <div class="ml-4">
                    <a href="/product/<?= $item['product_id'] ?>" class="text-sm font-medium line-clamp-2 hover:text-shopee-orange">
                      <?= $item['name'] ?>
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- Price -->
              <div class="md:col-span-2 md:text-center flex justify-between md:block">
                <div class="text-gray-500 md:hidden">Price:</div>
                <div class="text-sm text-shopee-orange">$<?= number_format($item['price'], 0, ',', '.') ?></div>
              </div>
              
              <!-- Quantity -->
              <div class="md:col-span-2 flex justify-between items-center md:justify-center">
                <div class="text-gray-500 md:hidden">Quantity:</div>
                <div class="flex border border-gray-300 rounded-sm">
                  <button type="button" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 text-gray-600 btn-update-quantity" 
                          data-cart-id="<?= $item['id'] ?>" data-action="decrease">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                  </button>
                  <input type="number" class="w-10 text-center border-x border-gray-300 focus:outline-none text-sm" 
                         value="<?= $item['quantity'] ?>" 
                         min="1" 
                         max="<?= $item['available_quantity'] ?>" 
                         data-cart-id="<?= $item['id'] ?>" 
                         onchange="updateCartQuantity(<?= $item['id'] ?>, this.value)">
                  <button type="button" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 text-gray-600 btn-update-quantity" 
                          data-cart-id="<?= $item['id'] ?>" data-action="increase">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                  </button>
                </div>
              </div>
              
              <!-- Total -->
              <div class="md:col-span-1 md:text-center flex justify-between md:block">
                <div class="text-gray-500 md:hidden">Total:</div>
                <span class="text-sm text-shopee-orange font-medium">$<?= number_format($item['item_total'], 0, ',', '.') ?></span>
              </div>
              
              <!-- Actions -->
              <div class="md:col-span-1 flex md:justify-center">
                <button class="text-gray-500 hover:text-red-500" onclick="removeCartItem(<?= $item['id'] ?>)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </div>
            </div>
          <?php endforeach; ?>
          
          <!-- Seller Footer -->
          <div class="px-6 py-3 bg-gray-50 text-right">
            <span class="text-gray-700">Subtotal from this seller: </span>
            <span class="text-shopee-orange font-medium">$<?= number_format($seller_subtotals[$seller['id']], 0, ',', '.') ?></span>
          </div>
        </div>
      <?php endforeach; ?>
      
      <!-- Cart Footer -->
      <div class="bg-white rounded-sm shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div class="flex items-center mb-4 md:mb-0">
            <a href="/" class="text-shopee-orange hover:underline flex items-center text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
              Continue Shopping
            </a>
          </div>
          
          <div class="w-full md:w-auto">
            <div class="flex flex-col">
              <div class="flex justify-between items-center mb-2">
                <span class="text-gray-500">Subtotal (<?= $total_items ?> items):</span>
                <span class="text-lg font-medium">$<?= number_format($subtotal, 0, ',', '.') ?></span>
              </div>
              
              <div class="flex justify-between items-center mb-2">
                <span class="text-gray-500">Shipping Fee:</span>
                <div class="flex items-center">
                  <span class="text-gray-400 line-through mr-2">₫<?= number_format($shipping_cost, 0, ',', '.') ?></span>
                  <span class="text-shopee-orange">$<?= number_format($final_shipping_cost, 0, ',', '.') ?></span>
                </div>
              </div>
              
              <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                <span class="text-gray-800 font-medium">Total:</span>
                <span class="text-xl text-shopee-orange font-medium">$<?= number_format($total, 0, ',', '.') ?></span>
              </div>
              
              <button class="mt-4 bg-shopee-orange text-white py-3 px-6 rounded-sm hover:bg-opacity-90 transition-all" onclick="proceedToCheckout()">
                Proceed to Checkout (<?= $total_items ?>)
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Shipping Discount Banner -->
      <div class="bg-shopee-light border border-shopee-orange border-opacity-20 rounded-sm shadow-sm p-4 mt-4 flex items-center">
        <div class="w-10 h-10 rounded-full bg-shopee-orange bg-opacity-10 flex items-center justify-center mr-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-shopee-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <div>
          <h4 class="font-medium text-shopee-orange">Free Shipping Applied!</h4>
          <p class="text-sm text-gray-600">You've received a shipping discount of ₫<?= number_format($shipping_discount, 0, ',', '.') ?>.</p>
        </div>
      </div>
      
    <?php else: ?>
      <!-- Empty Cart -->
      <div class="bg-white rounded-sm shadow-sm p-10 text-center">
        <div class="w-32 h-32 mx-auto mb-6 text-gray-300">
          <svg viewBox="0 0 24 24" class="h-full w-full" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
          </svg>
        </div>
        <h2 class="text-xl font-medium mb-2">Your Shopping Cart is Empty</h2>
        <p class="text-gray-500 mb-6">Looks like you haven't added any products to your cart yet.</p>
        <div class="space-y-4">
          <a href="/" class="bg-shopee-orange text-white py-2 px-6 rounded inline-block hover:bg-opacity-90 transition-all">
            Start Shopping
          </a>
          <?php if ($isLogin): ?>
          <div>
            <a href="/user/wishlist" class="text-shopee-orange underline text-sm">Check your wishlist</a>
          </div>
          <?php else: ?>
          <div>
            <a href="/users/login" class="text-shopee-orange underline text-sm">Log in</a> to see your saved items
          </div>
          <?php endif; ?>
        </div>
      </div>
      
      <!-- Recommended Products for Empty Cart -->
      <div class="mt-8">
        <h3 class="text-lg font-medium mb-4">Recommended For You</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
          <!-- This would be populated with recommended products -->
          <div class="text-center text-gray-500 col-span-full py-8">
            <p>Featured products will be shown here</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
  // Update cart item quantity
  function updateCartQuantity(cartId, newQuantity) {
    fetch('/update-cart-quantity.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `cart_item_id=${cartId}&quantity=${newQuantity}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Reload page to reflect changes
        window.location.reload();
      } else {
        alert(data.message || 'Failed to update cart.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred while updating the cart.');
    });
  }

  // Remove cart item
  function removeCartItem(cartId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
      fetch('/remove-from-cart.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `cart_item_id=${cartId}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Update cart count in header
          if (document.querySelector('.cart-count')) {
            document.querySelector('.cart-count').textContent = data.cartCount;
          }
          
          // Remove item from DOM
          document.getElementById(`cart-item-${cartId}`).remove();
          
          // If cart is empty or needs recalculation, reload the page
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

  // Quantity buttons functionality
  document.querySelectorAll('.btn-update-quantity').forEach(button => {
    button.addEventListener('click', function() {
      const cartId = this.getAttribute('data-cart-id');
      const action = this.getAttribute('data-action');
      const inputElement = document.querySelector(`input[data-cart-id="${cartId}"]`);
      
      let currentValue = parseInt(inputElement.value);
      const minValue = parseInt(inputElement.getAttribute('min'));
      const maxValue = parseInt(inputElement.getAttribute('max'));
      
      if (action === 'decrease' && currentValue > minValue) {
        currentValue -= 1;
      } else if (action === 'increase' && currentValue < maxValue) {
        currentValue += 1;
      }
      
      inputElement.value = currentValue;
      updateCartQuantity(cartId, currentValue);
    });
  });

  // Proceed to checkout
  function proceedToCheckout() {
    window.location.href = '/checkout';
  }
</script>

<?php 
require_once("../layout/footer.php");
?>