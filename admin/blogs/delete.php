<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php'); // Need this for database connection

// Get post ID from URL
$id = $_GET['id'] ?? 0;

if (!empty($id)) {
    try {
        // First get the post to find the thumbnail
        $query = mysqli_query($conn, "SELECT thumbnail FROM blog_posts WHERE id = $id");
        $post = mysqli_fetch_assoc($query);
        
        if ($post) {
            // Delete the thumbnail file if it exists
            if (!empty($post['thumbnail']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $post['thumbnail'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $post['thumbnail']);
            }
            
            // Delete the post from database
            mysqli_query($conn, "DELETE FROM blog_posts WHERE id = $id");
        }
    } catch (Exception $e) {
        // Log error if needed
    }
}

// Redirect back to blog list
header("Location: /admin/blogs/index.php");
exit;
