<?php
/**
 * This script creates necessary directories and files for the chat system
 */

// Path where the avatar image will be stored
$avatarDir = __DIR__ . '/public/assets/img/avatars';
$defaultAvatarPath = $avatarDir . '/default.jpg';

// Create the directory if it doesn't exist
if (!is_dir($avatarDir)) {
    if (!mkdir($avatarDir, 0755, true)) {
        die("Failed to create avatar directory");
    }
    echo "Created avatar directory: $avatarDir\n";
}

// Check if default avatar exists
if (!file_exists($defaultAvatarPath)) {
    // Create a simple default avatar (a colored circle with a letter)
    $image = imagecreatetruecolor(200, 200);
    
    // Set background color (blue)
    $bg_color = imagecolorallocate($image, 65, 105, 225);
    imagefill($image, 0, 0, $bg_color);
    
    // Add letter 'U' in white
    $white = imagecolorallocate($image, 255, 255, 255);
    imagestring($image, 5, 90, 80, 'U', $white);
    
    // Save the image
    imagejpeg($image, $defaultAvatarPath, 90);
    imagedestroy($image);
    
    echo "Created default avatar at: $defaultAvatarPath\n";
} else {
    echo "Default avatar already exists\n";
}

// Create the chat uploads directory
$chatUploadsDir = __DIR__ . '/public/uploads/chat';
if (!is_dir($chatUploadsDir)) {
    if (!mkdir($chatUploadsDir, 0755, true)) {
        die("Failed to create chat uploads directory");
    }
    echo "Created chat uploads directory: $chatUploadsDir\n";
} else {
    echo "Chat uploads directory already exists\n";
}

// Set proper permissions for the uploads directory
chmod($chatUploadsDir, 0755);

echo "Chat uploads directory setup complete.\n";

echo "Chat assets setup complete. You can now use the chat system.\n";
