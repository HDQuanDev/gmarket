<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/header.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/markdown.php');

// Get post ID from URL
$id = $_GET['id'] ?? 0;

// Fetch the blog post
try {
    $query = mysqli_query($conn, "SELECT * FROM blog_posts WHERE id = $id");
    $post = mysqli_fetch_assoc($query);
    
    if (!$post) {
        header("Location: /blogs/");
        exit;
    }
    
    // Increment view count
    mysqli_query($conn, "UPDATE blog_posts SET views = views + 1 WHERE id = $id");
    $post['views']++;
    
    // Get the title for SEO
    $page_title = $post['title'];
    $meta_description = substr(strip_tags(parseMarkdown($post['content'])), 0, 160);
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

// Get recent posts for sidebar
$recent_posts_query = mysqli_query($conn, "SELECT id, title, thumbnail, created_at FROM blog_posts WHERE id != $id ORDER BY created_at DESC LIMIT 6");
$recent_posts = [];
while ($row = mysqli_fetch_assoc($recent_posts_query)) {
    $recent_posts[] = $row;
}

// Get related posts (posts with similar words in title)
$related_posts = [];
$words = explode(' ', $post['title']);
$relevant_words = [];

// Filter out common words
foreach ($words as $word) {
    if (strlen($word) > 4) {
        $relevant_words[] = mysqli_real_escape_string($conn, $word);
    }
}

if (!empty($relevant_words)) {
    $search_terms = implode('|', $relevant_words);
    $related_query = mysqli_query($conn, "SELECT id, title, thumbnail, created_at FROM blog_posts 
                                         WHERE id != $id AND (title REGEXP '$search_terms' OR content REGEXP '$search_terms') 
                                         ORDER BY created_at DESC LIMIT 3");
    
    if ($related_query) {
        while ($row = mysqli_fetch_assoc($related_query)) {
            $related_posts[] = $row;
        }
    }
    
    // If we couldn't find related posts, just get other recent posts
    if (empty($related_posts)) {
        $related_query = mysqli_query($conn, "SELECT id, title, thumbnail, created_at FROM blog_posts 
                                             WHERE id != $id ORDER BY created_at DESC LIMIT 3");
        while ($row = mysqli_fetch_assoc($related_query)) {
            $related_posts[] = $row;
        }
    }
}
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="w-full lg:w-2/3">
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <!-- Featured Image -->
                <img src="<?= htmlspecialchars($post['thumbnail']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="w-full h-64 md:h-96 object-cover">
                
                <div class="p-6 md:p-8">
                    <!-- Breadcrumbs -->
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <a href="/" class="hover:text-orange-500">Home</a>
                        <span class="mx-2">›</span>
                        <a href="/blogs/" class="hover:text-orange-500">Blog</a>
                        <span class="mx-2">›</span>
                        <span class="text-gray-700 truncate"><?= htmlspecialchars($post['title']) ?></span>
                    </div>
                
                    <!-- Title -->
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 text-gray-900"><?= htmlspecialchars($post['title']) ?></h1>
                    
                    <!-- Post Meta -->
                    <div class="flex flex-wrap items-center text-sm mb-6 text-gray-500 gap-y-2">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <?= htmlspecialchars($post['author']) ?>
                        </span>
                        <span class="mx-2 text-gray-300">•</span>
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <?= date('M d, Y', strtotime($post['created_at'])) ?>
                        </span>
                        <span class="mx-2 text-gray-300">•</span>
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <?= number_format($post['views']) ?> views
                        </span>
                        <span class="mx-2 text-gray-300">•</span>
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?= ceil(str_word_count($post['content']) / 200) ?> min read
                        </span>
                    </div>
                    
                    <!-- Social Sharing -->
                    <div class="flex items-center gap-2 mb-6">
                        <span class="text-sm text-gray-600">Share:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($_SERVER['REQUEST_URI']) ?>" target="_blank" class="w-8 h-8 bg-orange-500 hover:bg-orange-600 text-white rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode($_SERVER['REQUEST_URI']) ?>&text=<?= urlencode($post['title']) ?>" target="_blank" class="w-8 h-8 bg-orange-500 hover:bg-orange-600 text-white rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($_SERVER['REQUEST_URI']) ?>&title=<?= urlencode($post['title']) ?>" target="_blank" class="w-8 h-8 bg-orange-500 hover:bg-orange-600 text-white rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="mailto:?subject=<?= urlencode($post['title']) ?>&body=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="w-8 h-8 bg-orange-500 hover:bg-orange-600 text-white rounded-full flex items-center justify-center transition-colors">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                    
                    <!-- Content -->
                    <div class="prose max-w-none prose-orange prose-img:rounded-lg prose-headings:font-bold prose-headings:text-gray-900 prose-a:text-orange-600">
                        <?= parseMarkdown($post['content']) ?>
                    </div>
                    
                    <!-- Tags -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex flex-wrap gap-2">
                            <a href="#" class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-full text-sm hover:bg-orange-100 transition-colors">Blog</a>
                            <a href="#" class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-full text-sm hover:bg-orange-100 transition-colors">Article</a>
                            <a href="#" class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-full text-sm hover:bg-orange-100 transition-colors">GMarket</a>
                        </div>
                    </div>
                    
                    <!-- Author Box -->
                    <div class="mt-8 p-6 bg-orange-50 rounded-lg border border-orange-100">
                        <div class="flex flex-col sm:flex-row gap-4 items-center sm:items-start">
                            <div class="w-20 h-20 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 text-2xl font-bold">
                                <?= strtoupper(substr($post['author'], 0, 1)) ?>
                            </div>
                            <div class="text-center sm:text-left">
                                <h3 class="text-lg font-bold text-gray-900"><?= htmlspecialchars($post['author']) ?></h3>
                                <p class="text-gray-600 mt-2">
                                    Content writer at GMarket. Passionate about ecommerce, technology, and creating engaging content that helps customers make informed decisions.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Back to blog list -->
                    <div class="mt-8 flex items-center justify-between">
                        <a href="/blogs/" class="text-orange-500 flex items-center hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to blog list
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Related Posts -->
            <?php if (!empty($related_posts)): ?>
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold mb-4 text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    You May Also Like
                </h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <?php foreach ($related_posts as $related): ?>
                    <div class="group border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                        <a href="/blogs/view.php?id=<?= $related['id'] ?>" class="block">
                            <div class="relative h-48 overflow-hidden">
                                <img src="<?= htmlspecialchars($related['thumbnail']) ?>" alt="<?= htmlspecialchars($related['title']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 ease-in-out">
                                <div class="absolute bottom-0 left-0 bg-orange-500 text-white px-2 py-1 text-xs">
                                    Related
                                </div>
                            </div>
                        </a>
                        <div class="p-3">
                            <h3 class="font-bold text-gray-800 mb-1 line-clamp-2 group-hover:text-orange-500 transition-colors">
                                <a href="/blogs/view.php?id=<?= $related['id'] ?>"><?= htmlspecialchars($related['title']) ?></a>
                            </h3>
                            <p class="text-xs text-gray-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <?= date('M d, Y', strtotime($related['created_at'])) ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Right Sidebar -->
        <div class="w-full lg:w-1/3">
            <!-- Recent Posts -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold border-b border-orange-100 pb-2 mb-4 text-orange-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    RECENT POSTS
                </h3>
                <div class="space-y-4">
                    <?php foreach ($recent_posts as $recent): ?>
                    <!-- Recent Post -->
                    <div class="flex gap-3 border-b border-gray-100 pb-3 hover:bg-orange-50 p-2 rounded-md transition-colors">
                        <div class="flex-shrink-0 w-20 h-16 rounded overflow-hidden">
                            <img src="<?= htmlspecialchars($recent['thumbnail']) ?>" alt="<?= htmlspecialchars($recent['title']) ?>" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm mb-1">
                                <a href="/blogs/view.php?id=<?= $recent['id'] ?>" class="hover:text-orange-500 line-clamp-2">
                                    <?= htmlspecialchars($recent['title']) ?>
                                </a>
                            </h4>
                            <p class="text-gray-500 text-xs flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <?= date('M d, Y', strtotime($recent['created_at'])) ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Popular Tags -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold border-b border-orange-100 pb-2 mb-4 text-orange-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    POPULAR TAGS
                </h3>
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-md text-sm hover:bg-orange-100 transition-colors">General</a>
                    <a href="#" class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-md text-sm hover:bg-orange-100 transition-colors">Design</a>
                    <a href="#" class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-md text-sm hover:bg-orange-100 transition-colors">Fashion</a>
                    <a href="#" class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-md text-sm hover:bg-orange-100 transition-colors">Branding</a>
                    <a href="#" class="px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 rounded-md text-sm hover:bg-orange-100 transition-colors">Modern</a>
                </div>
            </div>
            
            <!-- Newsletter Signup -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                <h3 class="text-lg font-bold border-b border-orange-100 pb-2 mb-4 text-orange-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    NEWSLETTER
                </h3>
                <p class="text-sm text-gray-600 mb-4">Subscribe to receive updates, access to exclusive deals, and more.</p>
                <form action="#" method="post" class="space-y-3">
                    <input type="email" name="email" placeholder="Your email address" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    <button type="submit" class="w-full bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'); ?>
