<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/admin_header.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_POST['author'] ?? '';
    $thumbnail = '';
    $show_on_homepage = isset($_POST['show_on_homepage']) ? 1 : 0;
    
    // Handle file upload
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['thumbnail']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($ext), $allowed)) {
            $new_filename = uniqid() . '.' . $ext;
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/blog/';
            
            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_dir . $new_filename)) {
                $thumbnail = '/uploads/blog/' . $new_filename;
            }
        }
    }
    
    if (empty($title) || empty($content) || empty($author) || empty($thumbnail)) {
        $message = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">All fields are required.</div>';
    } else {
        try {
            // Escape strings to prevent SQL injection
            $title = mysqli_real_escape_string($conn, $title);
            $content = mysqli_real_escape_string($conn, $content);
            $author = mysqli_real_escape_string($conn, $author);
            $thumbnail = mysqli_real_escape_string($conn, $thumbnail);
            
            $sql = "INSERT INTO blog_posts (title, content, thumbnail, author, show_on_homepage) 
                    VALUES ('$title', '$content', '$thumbnail', '$author', $show_on_homepage)";
            if (mysqli_query($conn, $sql)) {
                header("Location: /admin/blogs/index.php");
                exit;
            } else {
                throw new Exception(mysqli_error($conn));
            }
        } catch (Exception $e) {
            $message = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">Error: ' . $e->getMessage() . '</div>';
        }
    }
}
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Create New Blog Post</h1>
        <a href="/admin/blogs/index.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Back to List
        </a>
    </div>
    
    <?= $message ?>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" id="title" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            
            <div class="mb-4">
                <label for="author" class="block text-gray-700 font-bold mb-2">Author</label>
                <input type="text" id="author" name="author" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            </div>
            
            <div class="mb-4">
                <label for="thumbnail" class="block text-gray-700 font-bold mb-2">Thumbnail Image</label>
                <input type="file" id="thumbnail" name="thumbnail" class="w-full" required>
                <p class="text-gray-500 text-sm mt-1">Recommended size: 600x300 pixels</p>
            </div>
            
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content (Markdown)</label>
                <textarea id="content" name="content" rows="12" class="w-full px-3 py-2 border border-gray-300 rounded-md font-mono" required></textarea>
                <p class="text-gray-500 text-sm mt-1">You can use Markdown formatting for your content.</p>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="show_on_homepage" class="mr-2 h-5 w-5">
                    <span class="text-gray-700 font-bold">Show on homepage</span>
                </label>
                <p class="text-gray-500 text-sm mt-1">If checked, this post will be displayed on the homepage.</p>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Create Post
                </button>
            </div>
        </form>
    </div>
</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/layout/admin_footer.php'); ?>
