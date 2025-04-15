<?php
require_once(__DIR__ . "/../config.php");

// Redirect if not logged in or is seller
if (!$isLogin) {
    header("Location: /users/login");
    exit;
} else if ($isSeller) {
    header("Location: /seller/index.php");
    exit;
}

// Get order code from query string
$order_code = isset($_GET['order']) ? $_GET['order'] : null;

// If no order code is provided, get the latest order
if (!$order_code) {
    $latest_order = fetch_array("SELECT * FROM orders WHERE user_id=$user_id ORDER by id DESC LIMIT 1");
    if (!$latest_order) {
        // Redirect to home if no orders found
        echo "<script>history.back()</script>";
        die();
    }
    $order = $latest_order;
} else {
    // Get specific order by code
    $order = fetch_array("SELECT * FROM orders WHERE code='$order_code' AND user_id=$user_id LIMIT 1");
    if (!$order) {
        // Redirect back if order not found
        echo "<script>history.back()</script>";
        die();
    }
}

// Get order details
$order_details = [];
$order_items_by_seller = [];
$sellers = [];

// Query order details with seller information
$order_details_query = "SELECT od.*, s.full_name as seller_name, s.shop_logo, s.id as seller_id 
                        FROM detail_orders od 
                        LEFT JOIN sellers s ON od.from_seller = s.id
                        WHERE od.order_id = '{$order['id']}'
                        ORDER BY od.from_seller, od.id";
$order_details_result = mysqli_query($conn, $order_details_query);

while ($detail = mysqli_fetch_assoc($order_details_result)) {
    $order_details[] = $detail;
    
    // Group by seller
    $seller_id = $detail['from_seller'] ?? 0;
    $seller_name = $detail['seller_name'] ?? 'Marketplace';
    
    if (!isset($sellers[$seller_id])) {
        $sellers[$seller_id] = [
            'id' => $seller_id,
            'name' => $seller_name,
            'logo' => $detail['shop_logo'] ?? '',
            'items' => []
        ];
    }
    
    $sellers[$seller_id]['items'][] = $detail;
}

// Get shipping address
$address_parts = explode(',', $order['address']);
$shipping_address = trim($address_parts[0]);

require_once(__DIR__ . "/../layout/header.php");
?>

<style>
  .order-steps .step-item.complete .step-icon {
    @apply bg-green-500 text-white;
  }
  .order-steps .step-item.complete .step-title {
    @apply text-green-600;
  }
  .order-steps .step-item.active .step-icon {
    @apply bg-shopee-orange text-white;
  }
  .order-steps .step-item.active .step-title {
    @apply text-shopee-orange font-medium;
  }
</style>

<div class="bg-shopee-gray min-h-screen pb-10">
  <div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <!-- Checkout Steps -->
    <div class="flex justify-center mb-8">
      <div class="w-full max-w-4xl">
        <div class="flex justify-between order-steps">
          <div class="flex flex-col items-center step-item complete">
            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center mb-2 step-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-green-600 step-title">Cart</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-green-500"></div>
          </div>
          
          <div class="flex flex-col items-center step-item complete">
            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center mb-2 step-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-green-600 step-title">Address</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-green-500"></div>
          </div>
          
          <div class="flex flex-col items-center step-item complete">
            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center mb-2 step-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-green-600 step-title">Shipping</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-green-500"></div>
          </div>
          
          <div class="flex flex-col items-center step-item complete">
            <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center mb-2 step-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs text-green-600 step-title">Payment</span>
          </div>
          
          <div class="flex-1 flex items-center">
            <div class="h-0.5 w-full bg-green-500"></div>
          </div>
          
          <div class="flex flex-col items-center step-item active">
            <div class="w-10 h-10 rounded-full bg-shopee-orange text-white flex items-center justify-center mb-2 step-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <span class="text-xs font-medium text-shopee-orange step-title">Complete</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Message -->
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-sm shadow-sm p-6 mb-6 text-center">
        <div class="w-20 h-20 rounded-full bg-green-100 text-green-500 flex items-center justify-center mx-auto mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <h1 class="text-2xl font-medium mb-2">Order Successfully Placed!</h1>
        <p class="text-gray-500 mb-4">Thank you for your purchase. Your order has been received.</p>
        <div class="inline-block bg-gray-100 rounded-lg px-4 py-2 mb-4">
          <div class="text-sm text-gray-500">Order Code</div>
          <div class="text-shopee-orange font-medium text-xl"><?= $order['code'] ?></div>
        </div>
        <p class="text-sm text-gray-500">A confirmation email has been sent to <?= $user_email ?></p>
      </div>

      <!-- Order Information -->
      <div class="bg-white rounded-sm shadow-sm p-6 mb-6">
        <h2 class="text-lg font-medium mb-4">Order Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <div class="text-sm mb-4">
              <div class="text-gray-500 mb-1">Order Date</div>
              <div><?= date('d M Y, h:i A', strtotime($order['create_date'])) ?></div>
            </div>
            <div class="text-sm mb-4">
              <div class="text-gray-500 mb-1">Customer</div>
              <div><?= $user_name ?></div>
            </div>
            <div class="text-sm">
              <div class="text-gray-500 mb-1">Contact</div>
              <div><?= $user_email ?></div>
            </div>
          </div>
          <div>
            <div class="text-sm mb-4">
              <div class="text-gray-500 mb-1">Order Status</div>
              <div class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-100 text-blue-800">
                <?= $order['delivery_status'] ?: 'Pending' ?>
              </div>
            </div>
            <div class="text-sm mb-4">
              <div class="text-gray-500 mb-1">Payment Method</div>
              <div><?= ucwords(str_replace('_', ' ', $order['payment_option'])) ?></div>
            </div>
            <div class="text-sm">
              <div class="text-gray-500 mb-1">Shipping Address</div>
              <div class="text-sm"><?= htmlspecialchars($order['address']) ?></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Order Details -->
      <div class="bg-white rounded-sm shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium">Order Details</h2>
        </div>
        
        <?php foreach ($sellers as $seller_id => $seller): ?>
        <div class="border-b border-gray-200 last:border-b-0">
          <!-- Seller Header -->
          <?php if (count($sellers) > 1): ?>
          <div class="px-6 py-3 bg-gray-50 flex items-center">
            <?php if (!empty($seller['logo'])): ?>
              <img src="<?= '/public/uploads/' . $seller['logo'] ?>" alt="<?= htmlspecialchars($seller['name']) ?>" class="w-6 h-6 rounded-full">
            <?php else: ?>
              <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center text-white text-xs">
                <?= strtoupper(substr($seller['name'], 0, 1)) ?>
              </div>
            <?php endif; ?>
            <span class="ml-2 text-sm font-medium"><?= htmlspecialchars($seller['name']) ?></span>
          </div>
          <?php endif; ?>
          
          <!-- Items from this seller -->
          <div class="divide-y divide-gray-100">
            <?php foreach ($seller['items'] as $item): ?>
            <div class="px-6 py-4 flex">
              <div class="flex-shrink-0 w-16 h-16">
                <img src="<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full h-full object-cover rounded">
              </div>
              <div class="ml-4 flex-grow">
                <h3 class="text-sm font-medium"><?= htmlspecialchars($item['name']) ?></h3>
                <div class="mt-1 text-xs text-gray-500">
                  <span>Quantity: <?= $item['quantity'] ?></span>
                </div>
              </div>
              <div class="ml-4 text-right">
                <div class="text-sm text-shopee-orange font-medium">$<?= number_format($item['price'], 0, ',', '.') ?></div>
                <div class="text-xs text-gray-500 mt-1">Total: $<?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
        
        <!-- Order Summary -->
        <div class="px-6 py-4 bg-gray-50">
          <div class="flex justify-end">
            <div class="w-full md:w-1/2 lg:w-1/3">
              <div class="flex justify-between mb-2">
                <span class="text-sm text-gray-500">Subtotal:</span>
                <span class="text-sm">$<?= number_format($order['amount'], 0, ',', '.') ?></span>
              </div>
              <div class="flex justify-between mb-2">
                <span class="text-sm text-gray-500">Shipping Fee:</span>
                <div class="flex items-center">
                  <span class="text-gray-400 line-through text-xs mr-2">$20.000</span>
                  <span class="text-sm text-shopee-orange">Free</span>
                </div>
              </div>
              <div class="flex justify-between pt-2 border-t border-gray-200">
                <span class="font-medium">Total:</span>
                <span class="font-medium text-shopee-orange">$<?= number_format($order['amount'], 0, ',', '.') ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Purchase Protection -->
      <div class="bg-shopee-light border border-shopee-orange border-opacity-20 rounded-sm p-4 mb-6 flex items-start">
        <div class="w-10 h-10 rounded-full bg-shopee-orange bg-opacity-10 flex items-center justify-center mr-4 flex-shrink-0">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-shopee-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
          </svg>
        </div>
        <div>
          <h4 class="font-medium text-shopee-orange mb-1">Shopee Purchase Protection</h4>
          <p class="text-sm text-gray-600">Shop with confidence! We've got you covered with our purchase protection program.</p>
        </div>
      </div>
      
      <!-- Action Buttons -->
      <div class="flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
        <a href="/dashboard/orders" class="bg-shopee-orange text-white py-2 px-6 rounded-sm hover:bg-opacity-90 transition-all text-center">
          View My Orders
        </a>
        <a href="/" class="border border-shopee-orange text-shopee-orange py-2 px-6 rounded-sm hover:bg-shopee-light transition-all text-center">
          Continue Shopping
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  // Redirect users to top of the page when it loads
  window.onload = function() {
    window.scrollTo(0, 0);
    
    // Display a toast notification
    // If you have any toast notification library, you can use it here
    // Example: toastr.success('Your order has been placed successfully!');
  };
</script>

<?php include("../layout/footer.php"); ?>