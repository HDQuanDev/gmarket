<?php
require_once("./config.php");

// Fetch all categories
$categories_query = "SELECT c.*, 
                    (SELECT COUNT(*) FROM products p WHERE p.category_id = c.id AND p.published = 1) as product_count
                    FROM categories c
                    ORDER BY c.name ASC";
$categories_result = mysqli_query($conn, $categories_query);

// Group categories for better display
$grouped_categories = [];
$col_count = 0;
$row_count = 0;
$row_limit = 3; // Number of categories per row

while ($category = mysqli_fetch_assoc($categories_result)) {
    if (!isset($grouped_categories[$row_count])) {
        $grouped_categories[$row_count] = [];
    }
    
    $grouped_categories[$row_count][] = $category;
    $col_count++;
    
    if ($col_count >= $row_limit) {
        $col_count = 0;
        $row_count++;
    }
}

require_once("./layout/header.php");
?>

<div class="bg-gray-100 py-6 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="text-gray-500 hover:text-shopee-500">
                        <i class="fa-solid fa-home mr-1"></i> Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-angle-right text-gray-400 mx-1"></i>
                        <span class="text-shopee-600 font-medium">All Categories</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Title -->
        <div class="mb-6">
            <h1 class="text-2xl font-medium text-gray-800">All Categories</h1>
            <p class="text-gray-500 mt-1">Browse all product categories</p>
        </div>

        <?php if (mysqli_num_rows($categories_result) > 0): ?>
            <!-- Featured Categories Grid -->
            <div class="mb-10">
                <h2 class="text-xl font-medium text-gray-800 mb-4">Featured Categories</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <?php
                    mysqli_data_seek($categories_result, 0); // Reset the result pointer
                    while ($category = mysqli_fetch_assoc($categories_result)):
                        // Get category image
                        $category_img = $category['img'] ? "/public/uploads/all/" . $category['img'] : "/public/assets/img/placeholder.jpg";
                    ?>
                    <div class="bg-white rounded-md shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                        <a href="/category/<?= $category['path'] ?>" class="block">
                            <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                <img 
                                    src="<?= $category_img ?>" 
                                    alt="<?= htmlspecialchars($category['name']) ?>" 
                                    class="w-full h-48 object-cover transition hover:scale-105"
                                    onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">
                            </div>
                        </a>
                        <div class="p-4">
                            <h3 class="font-medium text-gray-800 mb-1 line-clamp-1">
                                <a href="/category/<?= $category['path'] ?>" class="hover:text-shopee-500 transition">
                                    <?= htmlspecialchars($category['name']) ?>
                                </a>
                            </h3>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fa-solid fa-box-open mr-1 text-shopee-400"></i>
                                <span><?= number_format($category['product_count']) ?> Products</span>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            
            <!-- Categories List -->
            <div class="mb-10">
                <h2 class="text-xl font-medium text-gray-800 mb-4">Categories List</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($grouped_categories as $row): ?>
                    <div class="bg-white rounded-md shadow-sm overflow-hidden">
                        <ul class="divide-y divide-gray-100">
                            <?php foreach($row as $category): ?>
                            <li>
                                <a href="/category/<?= $category['path'] ?>" class="flex items-center p-4 hover:bg-gray-50 transition">
                                    <div class="flex-shrink-0 w-12 h-12 rounded overflow-hidden border border-gray-200">
                                        <?php if($category['img']): ?>
                                        <img 
                                            src="/public/uploads/all/<?= $category['img'] ?>" 
                                            alt="<?= htmlspecialchars($category['name']) ?>"
                                            class="w-full h-full object-cover"
                                            onerror="this.onerror=null;this.src='/public/assets/img/placeholder.jpg';">
                                        <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-shopee-50 text-shopee-500">
                                            <i class="fa-solid fa-tag text-lg"></i>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-800"><?= htmlspecialchars($category['name']) ?></h3>
                                        <p class="text-sm text-gray-500 mt-0.5"><?= number_format($category['product_count']) ?> Products</p>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="fa-solid fa-chevron-right text-gray-400"></i>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="bg-white rounded-md shadow-sm p-10 text-center">
                <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center rounded-full bg-gray-100 text-gray-400">
                    <i class="fa-solid fa-folder-open text-4xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-800 mb-2">No Categories Found</h3>
                <p class="text-gray-500 mb-6">We haven't created any product categories yet.</p>
                <a href="/" class="inline-block bg-shopee-500 hover:bg-shopee-600 text-white font-medium py-2 px-4 rounded-md transition">
                    Back to Home
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include("./layout/footer.php"); ?>
