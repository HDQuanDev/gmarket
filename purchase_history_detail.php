<?php
require_once("./config.php");
if (!$isLogin) header("Location: /users/login");
else if ($isSeller) header("Location: /seller/index.php");

// Get order code from query string
$order_code = isset($_GET['code']) ? $_GET['code'] : '';

// Validate order code
if (empty($order_code)) {
    header("Location: /purchase_history.php");
    exit;
}

// Get order details from database
$order_query = "SELECT * FROM orders WHERE code = ? AND user_id = ? LIMIT 1";
$stmt = $conn->prepare($order_query);
$stmt->bind_param("si", $order_code, $user_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    header("Location: /purchase_history.php");
    exit;
}

// Get order items grouped by seller
$order_items = [];
$sellers = [];
$seller_subtotals = [];
$subtotal = 0;

// Query order items with seller information and join with products table
$items_query = "SELECT od.*, 
                s.id as seller_id, s.full_name as seller_name, s.shop_name, s.shop_logo, s.shop_address, s.rating,
                p.id as product_id, p.slugs, p.thumbnail_image, p.unit_price, p.category_id, p.seller_id as product_seller_id
                FROM detail_orders od 
                LEFT JOIN sellers s ON od.from_seller = s.id 
                LEFT JOIN products p ON od.name = p.name
                WHERE od.order_id = ? AND od.user_id = ?
                ORDER BY s.id, od.id";
$stmt = $conn->prepare($items_query);
$stmt->bind_param("ii", $order['id'], $user_id);
$stmt->execute();
$items_result = $stmt->get_result();

// Check for items with unreviewed products
function isItemReviewed($conn, $order_id, $detail_order_id, $user_id) {
    $query = "SELECT id FROM product_reviews 
              WHERE order_id = ? AND detail_order_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $order_id, $detail_order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Process items by seller
while ($item = $items_result->fetch_assoc()) {
    // Check if this item has been reviewed
    $item['is_reviewed'] = isItemReviewed($conn, $order['id'], $item['id'], $user_id);
    
    // Set the image path - prioritize product thumbnail
    $item['image_path'] = !empty($item['thumbnail_image']) ? 
        '/public/uploads/all/' . $item['thumbnail_image'] : 
        (!empty($item['img']) ? $item['img'] : '/public/assets/img/product-placeholder.png');
    
    // Ensure we have valid seller information
    if (empty($item['seller_id']) && !empty($item['product_seller_id'])) {
        // If direct seller is missing but product has seller, get it from there
        $seller_query = "SELECT id, full_name, shop_name, shop_logo, shop_address, rating FROM sellers WHERE id = ?";
        $stmt = $conn->prepare($seller_query);
        $stmt->bind_param("i", $item['product_seller_id']);
        $stmt->execute();
        $seller_result = $stmt->get_result();
        if ($seller_result->num_rows > 0) {
            $seller_data = $seller_result->fetch_assoc();
            $item['seller_id'] = $seller_data['id'];
            $item['seller_name'] = $seller_data['full_name'];
            $item['shop_name'] = $seller_data['shop_name'];
            $item['shop_logo'] = $seller_data['shop_logo'];
            $item['shop_address'] = $seller_data['shop_address'];
            $item['rating'] = $seller_data['rating'];
        }
    }
    
    $order_items[] = $item;
    
    // Calculate item total
    $item_total = $item['price'] * $item['quantity'];
    $subtotal += $item_total;
    
    $seller_id = $item['seller_id'] ?? 0;
    $seller_name = !empty($item['shop_name']) ? $item['shop_name'] : ($item['seller_name'] ?? 'Marketplace');
    
    // Initialize seller data if not exists
    if (!isset($sellers[$seller_id])) {
        $sellers[$seller_id] = [
            'id' => $seller_id,
            'name' => $seller_name,
            'full_name' => $item['seller_name'] ?? 'Unknown Seller',
            'logo' => $item['shop_logo'] ?? '',
            'address' => $item['shop_address'] ?? '',
            'rating' => $item['rating'] ?? 0,
            'items' => []
        ];
        $seller_subtotals[$seller_id] = 0;
    }
    
    // Add to seller's subtotal
    $seller_subtotals[$seller_id] += $item_total;
    
    // Add to seller's items
    $sellers[$seller_id]['items'][] = $item;
}

// Determine current status for progress bar
$current_status = $order['delivery_status'] ?: 'Pending';
$status_steps = ['Pending', 'Processing', 'Shipped', 'Delivered'];
$current_step = array_search($current_status, $status_steps);
$progress_percentage = $current_step !== false ? ($current_step / (count($status_steps) - 1)) * 100 : 0;
if ($current_status === 'Cancelled') {
    $progress_percentage = 0;
}

require_once("./layout/header.php");
?>

<style>
  .user-menu-item:hover {
    color: #ee4d2d;
    background-color: rgba(255, 87, 34, 0.05);
  }
  .user-menu-item.active {
    color: #ee4d2d;
    background-color: rgba(255, 87, 34, 0.1);
  }
  .status-step.active {
    color: #ee4d2d;
  }
  .status-step.active .status-icon {
    background-color: #ee4d2d;
    border-color: #ee4d2d;
  }
  .status-step.active .status-line {
    background-color: #ee4d2d;
  }
  .status-step.complete .status-icon {
    background-color: #4ade80;
    border-color: #4ade80;
  }
  .status-step.complete .status-line {
    background-color: #4ade80;
  }
  .status-step.cancelled .status-icon {
    background-color: #ef4444;
    border-color: #ef4444;
  }
  
  .product-card {
    transition: all 0.3s ease;
  }
  
  .product-card:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
  }
  
  .product-image {
    transition: transform 0.3s ease;
  }
  
  .product-card:hover .product-image {
    transform: scale(1.05);
  }
  
  .review-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 10;
  }
</style>

<div class="bg-shopee-gray min-h-screen pb-12">
  <div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-6">
      
      <!-- Left Sidebar - User Menu -->
      <div class="w-full md:w-1/4">
        <!-- User Profile Card -->
        <div class="bg-white rounded-sm shadow-sm mb-6">
          <div class="p-4 border-b border-gray-100">
            <div class="flex items-center">
              <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-100 border border-gray-200 mr-4">
                <img src="/public/assets/img/avatar-place.png" alt="User Avatar" class="w-full h-full object-cover">
              </div>
              <div>
                <h2 class="text-base font-medium"><?= htmlspecialchars($user_name) ?></h2>
              </div>
            </div>
          </div>
          
          <!-- Menu Items -->
          <div class="py-1">
            <a href="/dashboard" class="user-menu-item flex items-center px-4 py-3 text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              Dashboard
            </a>
            <a href="/purchase_history.php" class="user-menu-item active flex items-center px-4 py-3 text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
              My Orders
            </a>
          </div>
          
          <!-- Logout Button -->
          <div class="p-4 border-t border-gray-100">
            <a href="/logout" class="flex items-center text-gray-700 hover:text-shopee-orange text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              Logout
            </a>
          </div>
        </div>
      </div>
      
      <!-- Right Content Area -->
      <div class="w-full md:w-3/4 space-y-6">
        <!-- Order Header -->
        <div class="bg-white rounded-sm shadow-sm p-6">
          <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
            <div>
              <div class="flex items-center mb-2">
                <h1 class="text-xl font-medium mr-3">Order #<?= htmlspecialchars($order['code']) ?></h1>
                <?php if ($current_status === 'Delivered'): ?>
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Completed
                  </span>
                <?php elseif ($current_status === 'Cancelled'): ?>
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    Cancelled
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    In Progress
                  </span>
                <?php endif; ?>
              </div>
              <p class="text-gray-500 text-sm">Placed on <?= date('F d, Y, h:i A', strtotime($order['create_date'])) ?></p>
            </div>
            <div class="mt-4 sm:mt-0">
              <?php if ($current_status !== 'Delivered' && $current_status !== 'Cancelled'): ?>
                <button type="button" onclick="cancelOrder(<?= $order['id'] ?>)" class="inline-flex items-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                  Cancel Order
                </button>
              <?php endif; ?>
              <a href="/invoice/<?= $order['code'] ?>" class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Download Invoice
              </a>
            </div>
          </div>
          
          <!-- Order Status Timeline -->
          <?php if ($current_status !== 'Cancelled'): ?>
          <div class="border rounded-md p-4 mb-6">
            <h3 class="text-base font-medium mb-4">Order Status</h3>
            
            <div class="relative">
              <!-- Progress Bar -->
              <div class="h-2 bg-gray-200 rounded-full">
                <div class="h-full bg-shopee-orange rounded-full" style="width: <?= $progress_percentage ?>%;"></div>
              </div>
              
              <!-- Status Steps -->
              <div class="flex justify-between mt-2">
                <?php foreach ($status_steps as $index => $step): ?>
                  <?php 
                    $stepClass = '';
                    if (array_search($current_status, $status_steps) > $index) {
                      $stepClass = 'complete';
                    } elseif ($current_status === $step) {
                      $stepClass = 'active';
                    }
                  ?>
                  <div class="status-step <?= $stepClass ?> flex flex-col items-center relative">
                    <div class="status-icon w-6 h-6 rounded-full border-2 border-gray-300 bg-white flex items-center justify-center text-xs text-white">
                      <?php if ($stepClass === 'complete' || $stepClass === 'active'): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                      <?php else: ?>
                        &nbsp;
                      <?php endif; ?>
                    </div>
                    <span class="text-xs mt-1"><?= $step ?></span>
                    <?php if ($index < count($status_steps) - 1): ?>
                      <div class="status-line absolute h-0.5 bg-gray-200 w-full top-3 left-1/2"></div>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php else: ?>
          <div class="border border-red-200 rounded-md bg-red-50 p-4 mb-6">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Order Cancelled</h3>
                <div class="mt-1 text-sm text-red-700">
                  This order has been cancelled and cannot be processed further.
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
          
          <!-- Order Information -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h3 class="text-base font-medium mb-2">Shipping Address</h3>
              <div class="text-sm text-gray-600">
                <?= nl2br(htmlspecialchars($order['address'])) ?>
              </div>
            </div>
            
            <div>
              <h3 class="text-base font-medium mb-2">Payment Information</h3>
              <div class="text-sm text-gray-600">
                <div class="flex items-start">
                  <span class="font-medium mr-2">Method:</span>
                  <span><?= ucwords(str_replace('_', ' ', $order['payment_option'])) ?></span>
                </div>
                <div class="flex items-start mt-1">
                  <span class="font-medium mr-2">Status:</span>
                  <span><?= $order['payment_status'] ?: 'Pending' ?></span>
                </div>
                <?php if (!empty($order['additional_info'])): ?>
                <div class="mt-2 pt-2 border-t border-gray-100">
                  <span class="font-medium">Additional Information:</span>
                  <p class="mt-1"><?= nl2br(htmlspecialchars($order['additional_info'])) ?></p>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Order Items -->
        <?php foreach ($sellers as $seller_id => $seller): ?>
        <div class="bg-white rounded-sm shadow-sm overflow-hidden">
          <!-- Seller Header -->
          <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex items-center">
            <?php if (!empty($seller['logo'])): ?>
              <img src="<?= '/public/uploads/' . $seller['logo'] ?>" alt="<?= htmlspecialchars($seller['name']) ?>" class="w-10 h-10 rounded-full object-cover border border-gray-200">
            <?php else: ?>
              <div class="w-10 h-10 bg-shopee-orange rounded-full flex items-center justify-center text-white text-sm font-medium">
                <?= strtoupper(substr($seller['name'], 0, 1)) ?>
              </div>
            <?php endif; ?>
            <div class="ml-3">
              <h3 class="font-medium flex items-center">
                <?= htmlspecialchars($seller['name']) ?>
                <?php if ($seller['rating'] > 0): ?>
                <span class="ml-2 flex items-center text-sm text-yellow-500">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                  <?= number_format($seller['rating'], 1) ?>
                </span>
                <?php endif; ?>
              </h3>
              <?php if (!empty($seller['address'])): ?>
              <p class="text-xs text-gray-500"><?= htmlspecialchars($seller['address']) ?></p>
              <?php else: ?>
              <p class="text-xs text-gray-500"><?= count($seller['items']) ?> items in this order</p>
              <?php endif; ?>
            </div>
            
            <?php if ($seller_id > 0): ?>
            <a href="/shop.php?id=<?= $seller_id ?>" class="ml-auto text-sm text-shopee-orange hover:underline flex items-center">
              <span>Visit Store</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </a>
            <?php endif; ?>
          </div>
          
          <!-- Item List -->
          <div class="divide-y divide-gray-100">
            <?php foreach ($seller['items'] as $item): ?>
            <div class="p-6 product-card relative">
              <?php if ($item['is_reviewed']): ?>
              <span class="review-badge inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Reviewed
              </span>
              <?php endif; ?>
              
              <div class="flex flex-col sm:flex-row">
                <div class="flex-shrink-0 w-full sm:w-auto sm:mr-6 mb-4 sm:mb-0">
                  <div class="w-24 h-24 mx-auto sm:mx-0 rounded-md overflow-hidden border border-gray-200">
                    <img src="<?= $item['image_path'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-full h-full object-contain product-image">
                  </div>
                </div>
                <div class="flex-grow">
                  <h4 class="text-base font-medium mb-1 hover:text-shopee-orange">
                    <?php
                    // Determine the correct product URL
                    $product_url = !empty($item['product_id']) ? 
                      "/product/{$item['product_id']}" : 
                      (!empty($item['slugs']) ? "/product/{$item['slugs']}" : "#");
                    ?>
                    <a href="<?= $product_url ?>"><?= htmlspecialchars($item['name']) ?></a>
                  </h4>
                  
                  <div class="text-sm text-gray-500 mb-3 flex flex-wrap items-center">
                    <span class="mr-4">Quantity: <?= $item['quantity'] ?></span>
                    <span>Unit Price: <span class="text-shopee-orange font-medium">$<?= number_format($item['price'], 0, ',', '.') ?></span></span>
                  </div>
                  
                  <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <div class="mb-3 sm:mb-0">
                      <?php if (!$item['is_reviewed']): ?>
                      <a href="<?= $product_url ?>#product-reviews" class="inline-flex items-center px-3 py-1.5 bg-shopee-orange text-white text-sm font-medium rounded-md hover:bg-opacity-90 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Write a Review
                      </a>
                      <?php elseif ($current_status === 'Cancelled'): ?>
                      <a href="<?= $product_url ?>" class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Buy Again
                      </a>
                      <?php endif; ?>
                    </div>
                    
                    <div class="text-right">
                      <div class="text-sm text-gray-500">Total:</div>
                      <div class="text-shopee-orange font-medium text-lg">$<?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          
          <!-- Seller Total -->
          <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
            <span class="text-sm"><?= count($seller['items']) ?> item(s) from this seller</span>
            <div>
              <span class="text-gray-500">Subtotal: </span>
              <span class="font-medium text-shopee-orange">$<?= number_format($seller_subtotals[$seller_id], 0, ',', '.') ?></span>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        
        <!-- Order Summary -->
        <div class="bg-white rounded-sm shadow-sm p-6">
          <h3 class="text-base font-medium mb-4">Order Summary</h3>
          <div class="w-full sm:w-96 ml-auto">
            <div class="flex justify-between mb-2 text-sm">
              <span class="text-gray-500">Subtotal:</span>
              <span>$<?= number_format($subtotal, 0, ',', '.') ?></span>
            </div>
            <div class="flex justify-between mb-2 text-sm">
              <span class="text-gray-500">Shipping Fee:</span>
              <span>$0</span>
            </div>
            <div class="flex justify-between pt-2 border-t border-gray-100 font-medium">
              <span>Total:</span>
              <span class="text-shopee-orange">$<?= number_format($order['amount'], 0, ',', '.') ?></span>
            </div>
          </div>
        </div>
        
        <!-- Customer Support -->
        <div class="bg-white rounded-sm shadow-sm p-6">
          <h3 class="text-base font-medium mb-4">Need Help with Your Order?</h3>
          <div class="flex flex-col sm:flex-row gap-4">
            <a href="/support/contact?order=<?= $order['code'] ?>" class="inline-flex items-center justify-center px-4 py-2 border border-shopee-orange text-shopee-orange rounded-sm hover:bg-shopee-light">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
              Contact Support
            </a>
            
            <a href="/faq/orders" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-sm hover:bg-gray-50">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              FAQ
            </a>
            
            <a href="/purchase_history.php" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-sm hover:bg-gray-50">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
              </svg>
              Back to My Orders
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Cancel Order Confirmation Modal -->
<div id="cancelModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white rounded-lg w-full max-w-md mx-4 overflow-hidden">
    <div class="px-4 py-3 border-b border-gray-200">
      <h3 class="text-lg font-medium">Cancel Order</h3>
    </div>
    <div class="p-4">
      <p class="mb-4">Are you sure you want to cancel this order? This action cannot be undone.</p>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Reason for cancellation:</label>
        <select id="cancelReason" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-shopee-orange focus:border-shopee-orange sm:text-sm">
          <option value="changed_mind">Changed my mind</option>
          <option value="delivery_time">Delivery time is too long</option>
          <option value="found_alternative">Found better alternative</option>
          <option value="wrong_item">Ordered wrong item</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="flex justify-end space-x-3">
        <button type="button" onclick="closeCancelModal()" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded hover:bg-gray-200">
          Cancel
        </button>
        <button type="button" id="confirmCancel" class="px-4 py-2 bg-red-600 text-white font-medium rounded hover:bg-red-700">
          Confirm
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Cancel order functionality
  let orderIdToCancel = null;
  
  function cancelOrder(orderId) {
    orderIdToCancel = orderId;
    document.getElementById('cancelModal').classList.remove('hidden');
  }
  
  function closeCancelModal() {
    document.getElementById('cancelModal').classList.add('hidden');
    orderIdToCancel = null;
  }
  
  document.getElementById('confirmCancel').addEventListener('click', function() {
    if (!orderIdToCancel) return;
    
    const reason = document.getElementById('cancelReason').value;
    
    // Send AJAX request to cancel the order
    fetch('/cancel-order.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `order_id=${orderIdToCancel}&reason=${reason}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Reload the page to show updated status
        window.location.reload();
      } else {
        alert(data.message || 'Failed to cancel order.');
        closeCancelModal();
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred while cancelling the order.');
      closeCancelModal();
    });
  });
</script>

<?php include("./layout/footer.php"); ?>
