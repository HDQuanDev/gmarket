<?php
/**
 * This script downloads notification sound files for the chat system
 */

// Create audio directory if it doesn't exist
$audioDir = __DIR__ . '/public/assets/audio';
if (!is_dir($audioDir)) {
    if (!mkdir($audioDir, 0755, true)) {
        die("Failed to create audio directory");
    }
    echo "Created audio directory: $audioDir\n";
}

// Sound files to download
$sounds = [
    'notification.mp3' => 'https://cdn.pixabay.com/download/audio/2021/08/04/audio_12b0c19614.mp3?filename=notification-sound-7062.mp3',
    'message-sent.mp3' => 'https://cdn.pixabay.com/download/audio/2022/03/15/audio_75e9dab92c.mp3?filename=message-notification-3341.mp3'
];

foreach ($sounds as $filename => $url) {
    $filePath = $audioDir . '/' . $filename;
    
    if (file_exists($filePath)) {
        echo "Sound file $filename already exists.\n";
        continue;
    }
    
    echo "Downloading $filename... ";
    $fileContent = @file_get_contents($url);
    
    if ($fileContent === false) {
        echo "FAILED\n";
        echo "Could not download $url. Please download it manually and save it as $filePath\n";
        continue;
    }
    
    if (file_put_contents($filePath, $fileContent)) {
        echo "SUCCESS\n";
    } else {
        echo "FAILED to save file\n";
    }
}

echo "\nChat sound setup complete. You can now use the notification sounds in the chat system.\n";
echo "If you had trouble downloading the sounds, you can manually download notification sounds from pixabay.com or another free sound source.\n";
