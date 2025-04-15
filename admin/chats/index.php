<?php
include("../../config.php");
if(!$isLogin || !$isAdmin) header("Location: /");

// Define the missing get_image_path function
function get_image_path($image_id) {
    // Simple implementation - assumes the image ID directly maps to a filename
    // You might need to adjust this based on your actual image storage system
    if (empty($image_id) || $image_id <= 0) {
        return 'placeholder.jpg';
    }
    
    // Query to get the actual file path from the uploads table if needed
    global $conn;
    $query = "SELECT file_name FROM uploads WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $image_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['file_name'];
    }
    
    return 'placeholder.jpg';
}

// Prepare filters
$seller_filter = isset($_GET['seller_id']) ? intval($_GET['seller_id']) : 0;
$user_filter = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$items_per_page = 20;
$offset = ($page - 1) * $items_per_page;

// Build query conditions based on filters
$conditions = [];
$params = [];
$param_types = '';

if($seller_filter > 0) {
    $conditions[] = "c.seller_id = ?";
    $params[] = $seller_filter;
    $param_types .= 'i';
}

if($user_filter > 0) {
    $conditions[] = "c.user_id = ?";
    $params[] = $user_filter;
    $param_types .= 'i';
}

if(!empty($search_query)) {
    $conditions[] = "(c.last_message LIKE ? OR u.full_name LIKE ? OR s.full_name LIKE ? OR s.shop_name LIKE ?)";
    $search_param = "%$search_query%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $param_types .= 'ssss';
}

// Combine conditions
$where_clause = !empty($conditions) ? " WHERE " . implode(" AND ", $conditions) : "";

// Get total count for pagination
$count_query = "SELECT COUNT(*) as total FROM chat_conversations c
               JOIN users u ON c.user_id = u.id
               JOIN sellers s ON c.seller_id = s.id" . $where_clause;

$stmt = $conn->prepare($count_query);
if(!empty($params)) {
    $stmt->bind_param($param_types, ...$params);
}
$stmt->execute();
$total_result = $stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_conversations = $total_row['total'];
$total_pages = ceil($total_conversations / $items_per_page);

// Get conversations with pagination
$query = "SELECT c.*, u.full_name as user_name, s.full_name as seller_name, s.shop_name, 
         IFNULL(u.logo, 0) as user_avatar, IFNULL(s.shop_logo, 0) as seller_avatar
         FROM chat_conversations c
         JOIN users u ON c.user_id = u.id
         JOIN sellers s ON c.seller_id = s.id
         $where_clause
         ORDER BY c.updated_at DESC
         LIMIT ?, ?";

$stmt = $conn->prepare($query);
$param_types .= 'ii';
$params[] = $offset;
$params[] = $items_per_page;
$stmt->bind_param($param_types, ...$params);
$stmt->execute();
$conversations = $stmt->get_result();

// Get all sellers for filter dropdown
$sellers_query = "SELECT id, full_name, shop_name FROM sellers ORDER BY full_name ASC";
$sellers_result = $conn->query($sellers_query);
$sellers = [];
while($row = $sellers_result->fetch_assoc()) {
    $sellers[] = $row;
}

// Get all users for filter dropdown
$users_query = "SELECT id, full_name, email FROM users ORDER BY full_name ASC";
$users_result = $conn->query($users_query);
$users = [];
while($row = $users_result->fetch_assoc()) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="eObVDgS1BnyzqUZf3wNmMehk2sbNi4MatBxDBYhn">
    <meta name="app-url" content="//gmarket-quocte.com/">
    <meta name="file-base-url" content="//gmarket-quocte.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
    <title>Chat Conversations - Takashimaya Admin</title>

    <!-- Google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AIZ core CSS -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-core.css">
</head>

<body>
    <div class="aiz-main-wrapper">
        <?php include("../layout/sidebar.php") ?>

        <div class="aiz-content-wrapper">
            <?php include("../layout/topbar.php") ?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <div class="bg-white rounded-lg shadow-sm mb-4">
                        <div class="p-4 border-b border-gray-200">
                            <h1 class="text-xl font-medium text-gray-800">Chat Conversations</h1>
                            <p class="text-sm text-gray-500 mt-1">Monitor all conversations between sellers and users</p>
                        </div>

                        <!-- Filters Section -->
                        <div class="p-4 border-b border-gray-200 bg-gray-50">
                            <form action="" method="get" class="flex flex-wrap gap-4">
                                <div class="w-full md:w-auto">
                                    <label class="text-xs text-gray-500 mb-1 block">Search</label>
                                    <input type="text" name="search" value="<?= htmlspecialchars($search_query) ?>" 
                                           placeholder="Search messages or names" 
                                           class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div class="w-full md:w-auto">
                                    <label class="text-xs text-gray-500 mb-1 block">Seller</label>
                                    <select name="seller_id" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">All Sellers</option>
                                        <?php foreach($sellers as $seller): ?>
                                        <option value="<?= $seller['id'] ?>" <?= $seller_filter == $seller['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($seller['full_name']) ?> (<?= htmlspecialchars($seller['shop_name']) ?>)
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="w-full md:w-auto">
                                    <label class="text-xs text-gray-500 mb-1 block">User</label>
                                    <select name="user_id" class="form-control rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">All Users</option>
                                        <?php foreach($users as $user): ?>
                                        <option value="<?= $user['id'] ?>" <?= $user_filter == $user['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($user['full_name']) ?> (<?= htmlspecialchars($user['email']) ?>)
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="w-full md:w-auto flex items-end">
                                    <button type="submit" class="btn btn-primary rounded-md">
                                        <i class="fas fa-filter mr-1"></i> Filter
                                    </button>
                                    <?php if(!empty($search_query) || $seller_filter > 0 || $user_filter > 0): ?>
                                    <a href="index.php" class="btn btn-soft-secondary rounded-md ml-2">
                                        <i class="fas fa-times mr-1"></i> Clear
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>

                        <!-- Conversations List -->
                        <div class="overflow-hidden">
                            <?php if($conversations->num_rows > 0): ?>
                                <div class="overflow-x-auto">
                                    <table class="w-full">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seller</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Message</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unread</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php while($conversation = $conversations->fetch_assoc()): ?>
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-4 py-3 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <?php if($conversation['user_avatar']): ?>
                                                                    <img class="h-10 w-10 rounded-full object-cover" src="/public/uploads/all/<?= get_image_path($conversation['user_avatar']) ?>" alt="User">
                                                                <?php else: ?>
                                                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                                        <span class="text-blue-600 font-medium"><?= substr($conversation['user_name'] ?? 'U', 0, 1) ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($conversation['user_name'] ?? '') ?></div>
                                                                <div class="text-sm text-gray-500">User #<?= $conversation['user_id'] ?></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <?php if($conversation['seller_avatar']): ?>
                                                                    <img class="h-10 w-10 rounded-full object-cover" src="/public/uploads/all/<?= get_image_path($conversation['seller_avatar']) ?>" alt="Seller">
                                                                <?php else: ?>
                                                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                                        <span class="text-green-600 font-medium"><?= substr($conversation['seller_name'] ?? 'S', 0, 1) ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($conversation['seller_name'] ?? '') ?></div>
                                                                <div class="text-sm text-gray-500"><?= htmlspecialchars($conversation['shop_name'] ?? '') ?></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <div class="text-sm text-gray-900 truncate max-w-[200px]"><?= htmlspecialchars($conversation['last_message'] ?? '') ?></div>
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap">
                                                        <?php if($conversation['unread_user'] > 0 || $conversation['unread_seller'] > 0): ?>
                                                            <div class="flex gap-2">
                                                                <?php if($conversation['unread_user'] > 0): ?>
                                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                                        User: <?= $conversation['unread_user'] ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                                <?php if($conversation['unread_seller'] > 0): ?>
                                                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                        Seller: <?= $conversation['unread_seller'] ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <span class="text-gray-500 text-sm">None</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">
                                                            <?= !empty($conversation['updated_at']) ? 
                                                                date('d M Y, H:i', strtotime($conversation['updated_at'])) : 
                                                                'Not available' ?>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="view.php?id=<?= $conversation['id'] ?>" class="text-indigo-600 hover:text-indigo-900">
                                                            View Conversation
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <?php if($total_pages > 1): ?>
                                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                                    <div class="flex flex-1 justify-between sm:hidden">
                                        <?php if($page > 1): ?>
                                        <a href="?page=<?= $page-1 ?><?= !empty($search_query) ? '&search='.urlencode($search_query) : '' ?><?= $seller_filter ? '&seller_id='.$seller_filter : '' ?><?= $user_filter ? '&user_id='.$user_filter : '' ?>" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                                        <?php endif; ?>
                                        
                                        <?php if($page < $total_pages): ?>
                                        <a href="?page=<?= $page+1 ?><?= !empty($search_query) ? '&search='.urlencode($search_query) : '' ?><?= $seller_filter ? '&seller_id='.$seller_filter : '' ?><?= $user_filter ? '&user_id='.$user_filter : '' ?>" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700">
                                                Showing <span class="font-medium"><?= ($offset + 1) ?></span> to <span class="font-medium"><?= min($offset + $items_per_page, $total_conversations) ?></span> of <span class="font-medium"><?= $total_conversations ?></span> conversations
                                            </p>
                                        </div>
                                        <div>
                                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                                <?php if($page > 1): ?>
                                                <a href="?page=<?= $page-1 ?><?= !empty($search_query) ? '&search='.urlencode($search_query) : '' ?><?= $seller_filter ? '&seller_id='.$seller_filter : '' ?><?= $user_filter ? '&user_id='.$user_filter : '' ?>" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                                    <span class="sr-only">Previous</span>
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                                <?php endif; ?>
                                                
                                                <?php
                                                $start_page = max(1, $page - 2);
                                                $end_page = min($total_pages, $page + 2);
                                                
                                                if($start_page > 1): ?>
                                                <a href="?page=1<?= !empty($search_query) ? '&search='.urlencode($search_query) : '' ?><?= $seller_filter ? '&seller_id='.$seller_filter : '' ?><?= $user_filter ? '&user_id='.$user_filter : '' ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">1</a>
                                                <?php if($start_page > 2): ?>
                                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                
                                                <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                                                <a href="?page=<?= $i ?><?= !empty($search_query) ? '&search='.urlencode($search_query) : '' ?><?= $seller_filter ? '&seller_id='.$seller_filter : '' ?><?= $user_filter ? '&user_id='.$user_filter : '' ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold <?= $i == $page ? 'bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' ?>"><?= $i ?></a>
                                                <?php endfor; ?>
                                                
                                                <?php if($end_page < $total_pages): ?>
                                                <?php if($end_page < $total_pages - 1): ?>
                                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                                                <?php endif; ?>
                                                <a href="?page=<?= $total_pages ?><?= !empty($search_query) ? '&search='.urlencode($search_query) : '' ?><?= $seller_filter ? '&seller_id='.$seller_filter : '' ?><?= $user_filter ? '&user_id='.$user_filter : '' ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"><?= $total_pages ?></a>
                                                <?php endif; ?>
                                                
                                                <?php if($page < $total_pages): ?>
                                                <a href="?page=<?= $page+1 ?><?= !empty($search_query) ? '&search='.urlencode($search_query) : '' ?><?= $seller_filter ? '&seller_id='.$seller_filter : '' ?><?= $user_filter ? '&user_id='.$user_filter : '' ?>" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                                    <span class="sr-only">Next</span>
                                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                                <?php endif; ?>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="p-10 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No conversations found</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        <?= !empty($search_query) || $seller_filter > 0 || $user_filter > 0 ? 'Try adjusting your search or filter criteria.' : 'No messages have been exchanged between sellers and users yet.' ?>
                                    </p>
                                    <?php if(!empty($search_query) || $seller_filter > 0 || $user_filter > 0): ?>
                                        <div class="mt-6">
                                            <a href="index.php" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <i class="fas fa-times mr-2"></i> Clear Filters
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; Gmarket Vietnam</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
