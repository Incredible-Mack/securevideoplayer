<?php


// Implement your obfuscation logic and generate the obfuscated video URL
$obfuscatedVideoUrl = 'http://localhost/securevideoplayer/video.php?v=plaformguild'; // Replace with the actual obfuscated video URL

// Return the obfuscated video URL as JSON
$response = array(
    'success' => true,
    'obfuscatedVideoUrl' => $obfuscatedVideoUrl
);

header('Content-Type: application/json');
echo json_encode($response);
?>