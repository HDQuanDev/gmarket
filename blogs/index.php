<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/header.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/markdown.php');

// Pagination setup
$posts_per_page = 6;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, $current_page); // Ensure page is at least 1
$offset = ($current_page - 1) * $posts_per_page;

// Get total post count
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM blog_posts");
$total_posts = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_posts / $posts_per_page);

// Get featured blog (most viewed)
$featured_query = mysqli_query($conn, "SELECT * FROM blog_posts ORDER BY views DESC LIMIT 1");
$featured_post = mysqli_fetch_assoc($featured_query);

// Set featured ID (to exclude from recent posts)
$featured_id = $featured_post ? $featured_post['id'] : 0;

// Get recent blog posts (excluding featured) with pagination
$posts_query = mysqli_query($conn, "SELECT * FROM blog_posts WHERE id != $featured_id ORDER BY created_at DESC LIMIT $offset, $posts_per_page");
$posts = [];
while ($row = mysqli_fetch_assoc($posts_query)) {
    $posts[] = $row;
}

// Get popular posts (most viewed)
$popular_query = mysqli_query($conn, "SELECT id, title, thumbnail, author, views, created_at FROM blog_posts ORDER BY views DESC LIMIT 4");
$popular_posts = [];
while ($row = mysqli_fetch_assoc($popular_query)) {
    $popular_posts[] = $row;
}

// Get all categories for filter (this is a placeholder - you would typically have a blog_categories table)
$categories = ['All', 'Shopping', 'Technology', 'Fashion', 'Lifestyle', 'Home & Living'];

?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-orange-500 via-orange-400 to-red-500 py-12 md:py-20">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight animate__animated animate__fadeInDown">
                Discover Our Latest Insights & Stories
            </h1>
            <p class="mt-4 md:mt-6 text-lg md:text-xl text-white/90 animate__animated animate__fadeInUp animate__delay-1s">
                Explore trending topics, shopping guides, and lifestyle inspiration
            </p>
        </div>
    </div>
</div>

<!-- Stats Bar -->
<div class="bg-gradient-to-r from-orange-100 to-white py-3 shadow-md relative z-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center md:justify-around gap-4 text-center">
            <div class="px-4 py-2">
                <span class="block text-xl font-bold text-orange-500"><?= number_format($total_posts) ?></span>
                <span class="text-sm text-gray-500">Articles</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-xl font-bold text-orange-500">50+</span>
                <span class="text-sm text-gray-500">Writers</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-xl font-bold text-orange-500">24/7</span>
                <span class="text-sm text-gray-500">Fresh Content</span>
            </div>
            <div class="px-4 py-2">
                <span class="block text-xl font-bold text-orange-500">100K+</span>
                <span class="text-sm text-gray-500">Monthly Readers</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8 md:py-12">
    <!-- Featured Post Section -->
    <?php if ($featured_post): ?>
    <div class="mb-12 animate__animated animate__fadeIn">
        <div class="flex items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Featured Article</h2>
            <div class="ml-4 h-px bg-gradient-to-r from-orange-400 to-transparent flex-grow"></div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl transform hover:-translate-y-1">
            <div class="grid md:grid-cols-2 items-center">
                <div class="h-64 md:h-full overflow-hidden relative">
                    <img src="<?= htmlspecialchars($featured_post['thumbnail']) ?>" alt="<?= htmlspecialchars($featured_post['title']) ?>" 
                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                    <div class="absolute top-0 left-0 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-br-lg font-bold">
                        FEATURED
                    </div>
                </div>
                
                <div class="p-6 md:p-8 flex flex-col">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($featured_post['author']) ?>&background=random" 
                            alt="<?= htmlspecialchars($featured_post['author']) ?>" 
                            class="w-8 h-8 rounded-full mr-2">
                        <span><?= htmlspecialchars($featured_post['author']) ?></span>
                        <span class="mx-2">•</span>
                        <span><?= date('M d, Y', strtotime($featured_post['created_at'])) ?></span>
                        <span class="flex items-center ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <?= number_format($featured_post['views']) ?>
                        </span>
                    </div>
                    
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3 line-clamp-2 hover:text-blue-600 transition-colors">
                        <a href="/blogs/view.php?id=<?= $featured_post['id'] ?>">
                            <?= htmlspecialchars($featured_post['title']) ?>
                        </a>
                    </h2>
                    
                    <p class="text-gray-600 mb-6 line-clamp-3">
                        <?= substr(strip_tags(parseMarkdown($featured_post['content'])), 0, 250) ?>...
                    </p>
                    
                    <div class="mt-auto flex justify-between items-center">
                        <div class="flex space-x-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">Trending</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                                <?= ceil(str_word_count($featured_post['content']) / 200) ?> min read
                            </span>
                        </div>
                        
                        <a href="/blogs/view.php?id=<?= $featured_post['id'] ?>" 
                            class="inline-flex items-center gap-1 text-orange-500 font-semibold group">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Grid Section -->
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column - Articles -->
        <div class="w-full lg:w-2/3">
            <div class="flex items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Latest Articles</h2>
                <div class="ml-4 h-px bg-gradient-to-r from-orange-400 to-transparent flex-grow"></div>
            </div>
            
            <!-- Article Grid -->
            <div class="grid sm:grid-cols-2 gap-6">
                <?php foreach ($posts as $index => $post): ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden group animate__animated animate__fadeInUp" 
                    style="animation-delay: <?= 0.1 * $index ?>s">
                    <div class="relative h-52 overflow-hidden">
                        <img src="<?= htmlspecialchars($post['thumbnail']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" 
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end">
                            <div class="p-4 w-full">
                                <div class="flex items-center text-white/90 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <?= ceil(str_word_count($post['content']) / 200) ?> min read
                                    
                                    <span class="mx-2">•</span>
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <?= number_format($post['views']) ?> views
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <span class="inline-block w-8 h-8 rounded-full mr-2 bg-gradient-to-r from-orange-400 to-red-500 text-white flex items-center justify-center font-bold">
                                <?= strtoupper(substr($post['author'], 0, 1)) ?>
                            </span>
                            <span><?= htmlspecialchars($post['author']) ?></span>
                            <span class="ml-auto text-sm text-gray-400"><?= date('M d, Y', strtotime($post['created_at'])) ?></span>
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-orange-500 transition-colors">
                            <a href="/blogs/view.php?id=<?= $post['id'] ?>">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            <?= substr(strip_tags(parseMarkdown($post['content'])), 0, 120) ?>...
                        </p>
                        
                        <a href="/blogs/view.php?id=<?= $post['id'] ?>" 
                            class="inline-flex items-center text-sm font-medium text-orange-500 hover:text-orange-600 transition-colors group">
                            Read Article
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Enhanced Pagination -->
            <?php if ($total_pages > 1): ?>
            <div class="mt-10">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-600">
                        Showing <?= ($offset + 1) ?> to <?= min($offset + count($posts), $total_posts) ?> of <?= $total_posts ?> articles
                    </p>
                    
                    <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                        <?php if ($current_page > 1): ?>
                            <a href="?page=<?= $current_page - 1 ?>" class="relative inline-flex items-center px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                <span class="sr-only">Previous</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        <?php else: ?>
                            <span class="relative inline-flex items-center px-3 py-2 rounded-l-md border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                <span class="sr-only">Previous</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        <?php endif; ?>
                        
                        <?php
                        // Calculate the range of page numbers to display
                        $range = 2; // Number of pages before and after current page
                        $start_page = max(1, $current_page - $range);
                        $end_page = min($total_pages, $current_page + $range);
                        
                        // Always show first page
                        if ($start_page > 1) {
                            echo '<a href="?page=1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">1</a>';
                            
                            // Add ellipsis if there's a gap
                            if ($start_page > 2) {
                                echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                            }
                        }
                        
                        // Generate the page links
                        for ($i = $start_page; $i <= $end_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span aria-current="page" class="z-10 bg-orange-50 border-orange-500 text-orange-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">' . $i . '</span>';
                            } else {
                                echo '<a href="?page=' . $i . '" class="bg-white border-gray-300 text-gray-700 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium transition-colors">' . $i . '</a>';
                            }
                        }
                        
                        // Always show last page
                        if ($end_page < $total_pages) {
                            // Add ellipsis if there's a gap
                            if ($end_page < $total_pages - 1) {
                                echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                            }
                            
                            echo '<a href="?page=' . $total_pages . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">' . $total_pages . '</a>';
                        }
                        ?>
                        
                        <?php if ($current_page < $total_pages): ?>
                            <a href="?page=<?= $current_page + 1 ?>" class="relative inline-flex items-center px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                <span class="sr-only">Next</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        <?php else: ?>
                            <span class="relative inline-flex items-center px-3 py-2 rounded-r-md border border-gray-300 bg-gray-100 text-sm font-medium text-gray-400 cursor-not-allowed">
                                <span class="sr-only">Next</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Right Column - Sidebar -->
        <div class="w-full lg:w-1/3">
            <!-- Newsletter Signup -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl shadow-lg p-6 mb-8 animate__animated animate__fadeIn">
                <div class="flex items-center justify-center w-12 h-12 bg-white/20 rounded-full mb-4 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white text-center mb-2">Join Our Newsletter</h3>
                <p class="text-white/80 text-sm text-center mb-4">Get the latest posts delivered right to your inbox</p>
                
                <form action="#" method="post" class="space-y-3">
                    <input type="email" name="email" placeholder="Your email address" 
                        class="w-full px-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-white/50 bg-white/10 text-white placeholder-white/60" 
                        required>
                    <button type="submit" 
                        class="w-full px-4 py-3 bg-white text-blue-600 font-medium rounded-lg hover:bg-blue-50 transition-colors">
                        Subscribe
                    </button>
                </form>
                
                <p class="text-white/60 text-xs text-center mt-3">
                    We respect your privacy. Unsubscribe at any time.
                </p>
            </div>
            
            <!-- Most Popular -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 animate__animated animate__fadeIn animate__delay-1s">
                <div class="flex items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Most Popular</h3>
                    <div class="ml-4 h-px bg-gradient-to-r from-orange-400 to-transparent flex-grow"></div>
                </div>
                
                <div class="space-y-6">
                    <?php foreach ($popular_posts as $index => $post): ?>
                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0 relative w-16 h-16 md:w-20 md:h-20 rounded-lg overflow-hidden">
                            <span class="absolute top-0 left-0 bg-orange-500 text-white w-5 h-5 flex items-center justify-center text-xs font-bold">
                                <?= $index + 1 ?>
                            </span>
                            <img src="<?= htmlspecialchars($post['thumbnail']) ?>" 
                                alt="<?= htmlspecialchars($post['title']) ?>" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-800 line-clamp-2 group-hover:text-orange-500 transition-colors">
                                <a href="/blogs/view.php?id=<?= $post['id'] ?>">
                                    <?= htmlspecialchars($post['title']) ?>
                                </a>
                            </h4>
                            <div class="flex items-center mt-2 text-xs text-gray-500">
                                <span><?= date('M d, Y', strtotime($post['created_at'])) ?></span>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <?= number_format($post['views']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Popular Tags -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 animate__animated animate__fadeIn animate__delay-2s">
                <div class="flex items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Popular Tags</h3>
                    <div class="ml-4 h-px bg-gradient-to-r from-orange-400 to-transparent flex-grow"></div>
                </div>
                
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="px-3 py-1.5 bg-orange-100 text-orange-600 rounded-md text-sm hover:bg-orange-200 transition-colors">
                        Shopping
                    </a>
                    <a href="#" class="px-3 py-1.5 bg-blue-100 text-blue-600 rounded-md text-sm hover:bg-blue-200 transition-colors">
                        Electronics
                    </a>
                    <a href="#" class="px-3 py-1.5 bg-green-100 text-green-600 rounded-md text-sm hover:bg-green-200 transition-colors">
                        Eco-friendly
                    </a>
                    <a href="#" class="px-3 py-1.5 bg-pink-100 text-pink-600 rounded-md text-sm hover:bg-pink-200 transition-colors">
                        Fashion
                    </a>
                    <a href="#" class="px-3 py-1.5 bg-purple-100 text-purple-600 rounded-md text-sm hover:bg-purple-200 transition-colors">
                        Lifestyle
                    </a>
                    <a href="#" class="px-3 py-1.5 bg-yellow-100 text-yellow-600 rounded-md text-sm hover:bg-yellow-200 transition-colors">
                        Deals
                    </a>
                    <a href="#" class="px-3 py-1.5 bg-red-100 text-red-600 rounded-md text-sm hover:bg-red-200 transition-colors">
                        Technology
                    </a>
                    <a href="#" class="px-3 py-1.5 bg-indigo-100 text-indigo-600 rounded-md text-sm hover:bg-indigo-200 transition-colors">
                        Home
                    </a>
                    <a href="#" class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-md text-sm hover:bg-gray-200 transition-colors">
                        Tips
                    </a>
                </div>
            </div>
            
            <!-- Follow Us -->
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-lg p-6 animate__animated animate__fadeIn animate__delay-3s">
                <h3 class="text-lg font-bold text-white mb-4 text-center">Follow Us</h3>
                
                <div class="grid grid-cols-4 gap-3">
                    <a href="#" class="flex items-center justify-center w-full h-12 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition-colors">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="flex items-center justify-center w-full h-12 rounded-lg bg-blue-400 hover:bg-blue-500 text-white transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="flex items-center justify-center w-full h-12 rounded-lg bg-gradient-to-br from-pink-500 via-red-500 to-yellow-500 hover:from-pink-600 hover:via-red-600 hover:to-yellow-600 text-white transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="flex items-center justify-center w-full h-12 rounded-lg bg-red-600 hover:bg-red-700 text-white transition-colors">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Animation and Styling -->
<style>
    /* Pattern Background */
    .bg-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    
    /* Animate CSS classes */
    .animate__animated {
        animation-duration: 0.8s;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 20px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    .animate__fadeInUp {
        animation-name: fadeInUp;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    .animate__fadeIn {
        animation-name: fadeIn;
    }
    
    .animate__delay-1s {
        animation-delay: 0.2s;
    }
    
    .animate__delay-2s {
        animation-delay: 0.4s;
    }
    
    .animate__delay-3s {
        animation-delay: 0.6s;
    }
    
    /* Line Clamp */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<!-- Animation Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reveal animations when scrolling
    const animateElements = document.querySelectorAll('.animate__animated');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__fadeIn');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    animateElements.forEach(element => {
        observer.observe(element);
    });
});
</script>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'); ?>