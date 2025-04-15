<?php
require_once("./config.php");

// Redirect if not logged in
if (!$isLogin) {
  header("Location: /users/login?redirect=/dashboard");
  exit;
}

// Get user's basic information
$user_info_query = "SELECT * FROM users WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($user_info_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_info = $stmt->get_result()->fetch_assoc();

// Get user's recent orders (last 5)
$recent_orders_query = "SELECT o.*, 
                       (SELECT COUNT(id) FROM detail_orders WHERE order_id = o.id) as total_items
                       FROM orders o 
                       WHERE o.user_id = ? 
                       ORDER BY o.create_date DESC 
                       LIMIT 5";
$stmt = $conn->prepare($recent_orders_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$recent_orders = $stmt->get_result();

// Get order counts by status
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

// Get address count
$address_query = "SELECT COUNT(*) as address_count FROM address WHERE user_id = ?";
$stmt = $conn->prepare($address_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$address_count = $stmt->get_result()->fetch_assoc()['address_count'];

require_once("./layout/header.php");
?>

<!-- Add Tailwind CSS if not included in header -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          'shopee-orange': '#ee4d2d',
          'shopee-light': '#fff0ea',
          'shopee-yellow': '#faca51',
          'shopee-gray': '#f5f5f5',
        },
      }
    }
  }
</script>
<style>
  body {
    background-color: #f5f5f5;
    font-family: Roboto, Helvetica, Arial, sans-serif;
  }

  .user-menu-item:hover {
    color: #ee4d2d;
    background-color: rgba(255, 87, 34, 0.05);
  }

  .user-menu-item.active {
    color: #ee4d2d;
    background-color: rgba(255, 87, 34, 0.1);
  }

  .stat-card {
    transition: all 0.3s ease;
  }

  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
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
                <h2 class="text-base font-medium">
                  <?= isset($user_info['full_name']) && !empty($user_info['full_name']) ?
                    htmlspecialchars($user_info['full_name']) :
                    'Người dùng' ?>
                </h2>
              </div>
            </div>
          </div>

          <!-- Account Balance (Optional) -->
          <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <div class="text-sm text-gray-500">Account Balance</div>
            <div class="text-shopee-orange font-medium">$0</div>
          </div>

          <!-- Menu Items -->
          <div class="py-1">
            <a href="/dashboard" class="user-menu-item active flex items-center px-4 py-3 text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              Dashboard
            </a>
            <a href="/purchase_history" class="user-menu-item flex items-center px-4 py-3 text-sm">
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
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-shopee-orange to-pink-500 text-white rounded-sm shadow-sm p-6 mb-6">
          <h1 class="text-xl font-medium mb-2">Welcome back, <?= isset($user_info['full_name']) && !empty($user_info['full_name']) ?
                                                                htmlspecialchars($user_info['full_name']) :
                                                                'Người dùng' ?>!</h1>
          <p class="opacity-80 text-sm">
            From your dashboard, you can view your recent orders, track shipments, manage your shipping addresses and update your account settings.
          </p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
          <div class="bg-white rounded-sm shadow-sm p-4 text-center stat-card">
            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center mx-auto mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
            </div>
            <div class="text-2xl font-medium text-gray-700"><?= $order_stats['total_orders'] ?: 0 ?></div>
            <div class="text-sm text-gray-500">Total Orders</div>
          </div>

          <div class="bg-white rounded-sm shadow-sm p-4 text-center stat-card">
            <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-500 flex items-center justify-center mx-auto mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="text-2xl font-medium text-gray-700"><?= $order_stats['pending'] + $order_stats['processing'] ?: 0 ?></div>
            <div class="text-sm text-gray-500">Pending Orders</div>
          </div>

          <div class="bg-white rounded-sm shadow-sm p-4 text-center stat-card">
            <div class="w-10 h-10 rounded-full bg-green-100 text-green-500 flex items-center justify-center mx-auto mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <div class="text-2xl font-medium text-gray-700"><?= $order_stats['delivered'] ?: 0 ?></div>
            <div class="text-sm text-gray-500">Completed Orders</div>
          </div>

          <div class="bg-white rounded-sm shadow-sm p-4 text-center stat-card">
            <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-500 flex items-center justify-center mx-auto mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div class="text-2xl font-medium text-gray-700"><?= $address_count ?: 0 ?></div>
            <div class="text-sm text-gray-500">Saved Addresses</div>
          </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-sm shadow-sm mb-6">
          <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="font-medium">Recent Orders</h2>
            <a href="/dashboard/orders" class="text-sm text-shopee-orange hover:underline">View All</a>
          </div>

          <?php if ($recent_orders->num_rows > 0): ?>
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Order Code</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                  <?php while ($order = $recent_orders->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-4 text-sm"><?= $order['code'] ?></td>
                      <td class="px-6 py-4 text-sm text-gray-500"><?= date('d M Y', strtotime($order['create_date'])) ?></td>
                      <td class="px-6 py-4 text-sm"><?= $order['total_items'] ?> items</td>
                      <td class="px-6 py-4 text-sm">$<?= number_format($order['amount'], 0, ',', '.') ?></td>
                      <td class="px-6 py-4">
                        <?php
                        $status = $order['delivery_status'] ?: 'Pending';
                        $status_color = 'bg-gray-100 text-gray-800';

                        if ($status == 'Processing') $status_color = 'bg-blue-100 text-blue-800';
                        elseif ($status == 'Shipped') $status_color = 'bg-indigo-100 text-indigo-800';
                        elseif ($status == 'Delivered') $status_color = 'bg-green-100 text-green-800';
                        elseif ($status == 'Cancelled') $status_color = 'bg-red-100 text-red-800';
                        ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $status_color ?>">
                          <?= $status ?>
                        </span>
                      </td>
                      <td class="px-6 py-4 text-sm">
                        <a href="/purchase_history_detail.php?code=<?= $order['code'] ?>" class="text-shopee-orange hover:underline">
                          Details
                        </a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div class="py-16 text-center">
              <div class="w-16 h-16 mx-auto mb-4 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
              </div>
              <h3 class="text-gray-500 mb-2">No orders yet</h3>
              <a href="/" class="inline-flex items-center text-shopee-orange hover:underline">
                <span>Start Shopping</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </a>
            </div>
          <?php endif; ?>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-sm shadow-sm">
          <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-medium">Quick Links</h2>
          </div>
          <div class="p-6">
            <div class="grid grid-cols-6 sm:grid-cols-6 gap-2">
              <!-- Order Links -->
              <a href="/purchase_history" transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-sm font-medium text-gray-700">My Orders</span>
              </a>

              <!-- Profile Link -->
              <a href="/dashboard" class="bg-purple-50 hover:bg-purple-100 p-4 rounded-sm flex flex-col items-center justify-center text-center transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-sm font-medium text-gray-700">My Profile</span>
              </a>

              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              <span class="text-sm font-medium text-gray-700">Support Tickets</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("./layout/footer.php"); ?>