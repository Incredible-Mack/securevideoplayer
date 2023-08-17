<?php
$videoDirectory = './'; // Set the actual path to your video directory

$videoName = 'est';

//$_GET['v']; // Get the obfuscated video name from the query parameter

// Map obfuscated video names to actual file names (you can implement your own mapping logic)
$videoMap = [
    'est' => 'Esther.mp4',
    // Add more mappings as needed
];

if (isset($videoMap[$videoName])) {
    $videoFile = $videoMap[$videoName];
    $filePath = $videoDirectory . $videoFile;

    if (file_exists($filePath)) {
        // Serve the video with appropriate headers
        header('Content-Type: video/mp4');
        header('Content-Length:' . filesize($filePath));
        readfile($filePath);
        exit;
    }
}

// Video not found
http_response_code(404);
echo 'Video not found.';
?>