<?php 
require_once("./layout/header.php");
if(!$isLogin) header("Location: /users/login");
else if($isSeller) header("Location: /seller/index.php");

// Get user's order history from database with seller information
$orders_query = "SELECT o.*, 
                (SELECT SUM(quantity) FROM detail_orders WHERE order_id = o.id) as total_items,
                (SELECT GROUP_CONCAT(DISTINCT from_seller) FROM detail_orders WHERE order_id = o.id) as sellers_ids
                FROM orders o
                WHERE o.user_id = ? 
                ORDER BY o.create_date DESC";
$stmt = $conn->prepare($orders_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orders = $stmt->get_result();

// Order status counts
$order_stats_query = "SELECT 
                     COUNT(*) as total_orders,
                     SUM(IF(delivery_status = 'Pending' OR delivery_status IS NULL, 1, 0)) as pending,
                     SUM(IF(delivery_status = 'Processing', 1, 0)) as processing,
                     SUM(IF(delivery_status = 'Shipped', 1, 0)) as shipped,
                     SUM(IF(delivery_status = 'Delivered', 1, 0)) as delivered,
                     SUM(IF(delivery_status = 'Cancelled', 1, 0)) as cancelled
                     FROM orders 
                     WHERE user_id = ?";
$stmt = $conn->prepare($order_stats_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_stats = $stmt->get_result()->fetch_assoc();

// Function to get seller info for an order
function getSellerInfo($conn, $order_id) {
    $sellers = [];
    $query = "SELECT DISTINCT s.id, s.full_name, s.shop_logo 
              FROM detail_orders do
              JOIN sellers s ON do.from_seller = s.id
              WHERE do.order_id = ? AND do.from_seller IS NOT NULL";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $sellers[] = $row;
    }
    
    return $sellers;
}

// Function to check if order has unreviewed products
function hasUnreviewedProducts($conn, $order_id, $user_id) {
    // Check for unreviewed products and return the first product ID for review
    $query = "SELECT do.id, do.name, p.id as product_id, p.thumbnail_image
              FROM detail_orders do
              LEFT JOIN products p ON do.name = p.name
              LEFT JOIN product_reviews pr ON 
                  (pr.detail_order_id = do.id OR pr.product_id = p.id) 
                  AND pr.user_id = ? 
                  AND pr.order_id = ?
              WHERE do.order_id = ? 
                AND do.user_id = ?
                AND pr.id IS NULL
              LIMIT 1";  // Just need to know if there's at least one
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiii", $user_id, $order_id, $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Return the product ID for the review button
        return $result->fetch_assoc()['product_id'];
    }
    
    return false;
}

// Get count of unreviewed orders
function getUnreviewedOrdersCount($conn, $user_id) {
    $query = "SELECT COUNT(DISTINCT do.order_id) as count_orders
              FROM detail_orders do
              LEFT JOIN products p ON do.name = p.name
              LEFT JOIN product_reviews pr ON 
                  (pr.detail_order_id = do.id OR pr.product_id = p.id) 
                  AND pr.user_id = ? 
                  AND pr.order_id = do.order_id
              WHERE do.user_id = ?
                AND pr.id IS NULL";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc()['count_orders'];
}

// Get count of unreviewed orders
$unreviewedOrdersCount = getUnreviewedOrdersCount($conn, $user_id);

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
  .tab-item {
    position: relative;
  }
  .tab-item.active {
    color: #ee4d2d;
  }
  .tab-item.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #ee4d2d;
  }
  
  .review-alert {
    background-color: #fff9e6;
    border-left: 4px solid #f59e0b;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }
  
  .order-row {
    transition: all 0.2s ease;
  }
  
  .order-row:hover {
    background-color: #fffaf0;
  }
  
  .status-badge {
    transition: all 0.2s ease;
  }
  
  .status-badge:hover {
    transform: translateY(-1px);
  }
  
  .action-button {
    transition: all 0.2s ease;
  }
  
  .action-button:hover {
    transform: translateY(-1px);
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
      <div class="w-full md:w-3/4">
        <!-- Order Statistics -->
        <div class="bg-white rounded-sm shadow-sm overflow-hidden mb-6">
          <div class="grid grid-cols-5 divide-x divide-gray-100">
            <div class="p-4 text-center">
              <div class="text-xl font-medium text-gray-700"><?= $order_stats['total_orders'] ?: 0 ?></div>
              <div class="text-xs text-gray-500 mt-1">Total</div>
            </div>
            <div class="p-4 text-center">
              <div class="text-xl font-medium text-amber-500"><?= $order_stats['pending'] ?: 0 ?></div>
              <div class="text-xs text-gray-500 mt-1">Pending</div>
            </div>
            <div class="p-4 text-center">
              <div class="text-xl font-medium text-blue-500"><?= $order_stats['processing'] + $order_stats['shipped'] ?: 0 ?></div>
              <div class="text-xs text-gray-500 mt-1">Processing</div>
            </div>
            <div class="p-4 text-center">
              <div class="text-xl font-medium text-green-500"><?= $order_stats['delivered'] ?: 0 ?></div>
              <div class="text-xs text-gray-500 mt-1">Delivered</div>
            </div>
            <div class="p-4 text-center">
              <div class="text-xl font-medium text-red-500"><?= $order_stats['cancelled'] ?: 0 ?></div>
              <div class="text-xs text-gray-500 mt-1">Cancelled</div>
            </div>
          </div>
        </div>
        
        <!-- Unreview Alert - displays only if there are unreviewed orders -->
        <?php if ($unreviewedOrdersCount > 0): ?>
        <div class="review-alert p-4 mb-6 rounded-lg shadow-sm relative overflow-hidden">
          <div class="absolute right-0 top-0 -mt-8 -mr-8 bg-yellow-300 bg-opacity-20 w-32 h-32 rounded-full"></div>
          <div class="absolute right-0 bottom-0 -mb-8 -mr-8 bg-yellow-300 bg-opacity-10 w-32 h-32 rounded-full"></div>
          
          <div class="flex items-start relative z-10">
            <div class="flex-shrink-0 bg-yellow-50 rounded-full p-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
              </svg>
            </div>
            <div class="ml-4 flex-1">
              <h3 class="text-lg font-medium text-yellow-800">Your reviews help others!</h3>
              <p class="mt-1 text-yellow-700">
                You have <span class="font-bold"><?= $unreviewedOrdersCount ?></span> 
                <?= $unreviewedOrdersCount == 1 ? 'order' : 'orders' ?> with products waiting for your review.
                Share your honest feedback to help other shoppers make informed decisions.
              </p>
              <div class="mt-3">
                <a href="?status=delivered" class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600 transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  View Delivered Orders
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        
        <!-- Orders List -->
        <div class="bg-white rounded-sm shadow-sm">
          <div class="border-b border-gray-100">
            <div class="flex overflow-x-auto">
              <a href="?status=all" class="tab-item active px-6 py-4 text-sm font-medium whitespace-nowrap">All Orders</a>
              <a href="?status=pending" class="tab-item px-6 py-4 text-sm font-medium whitespace-nowrap">Pending</a>
              <a href="?status=processing" class="tab-item px-6 py-4 text-sm font-medium whitespace-nowrap">Processing</a>
              <a href="?status=delivered" class="tab-item px-6 py-4 text-sm font-medium whitespace-nowrap">Delivered</a>
              <a href="?status=cancelled" class="tab-item px-6 py-4 text-sm font-medium whitespace-nowrap">Cancelled</a>
            </div>
          </div>
          
          <!-- Search Bar -->
          <div class="p-4 border-b border-gray-100">
            <div class="relative">
              <input type="text" placeholder="Search by Order Code" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-shopee-orange text-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
            </div>
          </div>
          
          <!-- Orders Table -->
          <?php if ($orders->num_rows > 0): ?>
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50 text-xs uppercase">
                  <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Order Code</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Date</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Items</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Seller(s)</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Amount</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500">Status</th>
                    <th class="px-6 py-3 text-right font-medium text-gray-500">Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                  <?php while ($order = $orders->fetch_assoc()): ?>
                    <?php 
                    $sellers_info = getSellerInfo($conn, $order['id']); 
                    $productToReview = hasUnreviewedProducts($conn, $order['id'], $user_id);
                    ?>
                    <tr class="order-row hover:bg-gray-50">
                      <td class="px-6 py-4">
                        <a href="/purchase_history_detail.php?code=<?= $order['code'] ?>" class="text-shopee-orange hover:underline font-medium">
                          <?= $order['code'] ?>
                        </a>
                      </td>
                      <td class="px-6 py-4 text-sm text-gray-500">
                        <?= date('d M Y, H:i', strtotime($order['create_date'])) ?>
                      </td>
                      <td class="px-6 py-4 text-sm text-gray-700">
                        <?= $order['total_items'] ?> items
                      </td>
                      <td class="px-6 py-4 text-sm text-gray-700">
                        <?php if (!empty($sellers_info)): ?>
                          <div class="flex flex-col space-y-1">
                            <?php foreach($sellers_info as $index => $seller): ?>
                              <?php if ($index < 2): ?>
                                <a href="/shop.php?id=<?= $seller['id'] ?>" class="text-shopee-orange hover:underline flex items-center">
                                  <?php if (!empty($seller['shop_logo'])): ?>
                                    <img src="/public/uploads/<?= $seller['shop_logo'] ?>" class="w-4 h-4 rounded-full mr-1 border border-gray-200" alt="<?= htmlspecialchars($seller['full_name']) ?>">
                                  <?php endif; ?>
                                  <?= htmlspecialchars($seller['full_name']) ?>
                                </a>
                              <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (count($sellers_info) > 2): ?>
                              <span class="text-xs text-gray-500 mt-1">+<?= count($sellers_info) - 2 ?> more</span>
                            <?php endif; ?>
                          </div>
                        <?php else: ?>
                          <span class="text-gray-500">-</span>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-4 text-sm font-medium">
                        $<?= number_format($order['amount'], 0, ',', '.') ?>
                      </td>
                      <td class="px-6 py-4">
                        <?php 
                        $status = $order['delivery_status'] ?: 'Pending';
                        $status_color = 'bg-yellow-100 text-yellow-800';
                        $status_hover = 'hover:bg-yellow-200';
                        
                        if ($status == 'Processing') {
                            $status_color = 'bg-blue-100 text-blue-800';
                            $status_hover = 'hover:bg-blue-200';
                        }
                        elseif ($status == 'Shipped') {
                            $status_color = 'bg-indigo-100 text-indigo-800';
                            $status_hover = 'hover:bg-indigo-200';
                        }
                        elseif ($status == 'Delivered') {
                            $status_color = 'bg-green-100 text-green-800';
                            $status_hover = 'hover:bg-green-200';
                        }
                        elseif ($status == 'Cancelled') {
                            $status_color = 'bg-red-100 text-red-800';
                            $status_hover = 'hover:bg-red-200';
                        }
                        ?>
                        <span class="status-badge inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium <?= $status_color ?> <?= $status_hover ?>">
                          <?= $status ?>
                        </span>
                      </td>
                      <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                        <a href="/purchase_history_detail.php?code=<?= $order['code'] ?>" class="action-button inline-flex items-center px-2.5 py-1.5 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 hover:border-gray-400">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                          Details
                        </a>
                        <?php if ($status != 'Delivered' && $status != 'Cancelled'): ?>
                          <button type="button" onclick="cancelOrder(<?= $order['id'] ?>)" class="action-button inline-flex items-center px-2.5 py-1.5 border border-red-300 text-xs font-medium rounded text-red-700 bg-white hover:bg-red-50 hover:border-red-400 hover:text-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                          </button>
                        <?php endif; ?>
                        <?php if ($productToReview): ?>
                          <a href="/product/<?= $productToReview ?>#product-reviews" class="action-button inline-flex items-center px-2.5 py-1.5 border border-yellow-300 text-xs font-medium rounded text-yellow-700 bg-white hover:bg-yellow-50 hover:border-yellow-400 hover:text-yellow-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Review
                          </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
            
            <!-- Pagination -->
            <div class="p-4 border-t border-gray-100 flex items-center justify-between">
              <span class="text-sm text-gray-500">Showing 1 to <?= min($orders->num_rows, 10) ?> of <?= $orders->num_rows ?> entries</span>
              <div class="flex space-x-1">
                <button disabled class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-400 bg-gray-50">Previous</button>
                <button class="px-3 py-1 border border-gray-300 rounded text-sm bg-shopee-orange text-white">1</button>
                <button class="px-3 py-1 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">Next</button>
              </div>
            </div>
          <?php else: ?>
            <div class="py-16 text-center">
              <div class="w-16 h-16 mx-auto mb-4 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
              </div>
              <h3 class="text-gray-500 mb-2">No orders yet</h3>
              <a href="/" class="mt-4 inline-block px-4 py-2 bg-shopee-orange text-white rounded hover:bg-opacity-90">
                Start Shopping
              </a>
            </div>
          <?php endif; ?>
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
  // Set active tab based on URL parameter
  document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    if (status) {
      document.querySelectorAll('.tab-item').forEach(tab => {
        tab.classList.remove('active');
      });
      
      const activeTab = document.querySelector(`.tab-item[href="?status=${status}"]`);
      if (activeTab) {
        activeTab.classList.add('active');
      }
    }
  });
  
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
