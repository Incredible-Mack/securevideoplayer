<?php
$videoName = $_GET['v']; // Get the obfuscated video name from the query parameter

// Map obfuscated video names to actual file URLs
$videoMap = [  
    'plaformguild' => 'http://localhost/securevideoplayer/esther.mp4',
    //'plaformguild' => 'https://d1ent1.loveworldcloud.com/~kiddiesmedia/LOVETOONS_TV/yourloveworld/Islt-Platform-Guide%20Updated.mp4',
    // Add more mappings as needed
];

if (isset($videoMap[$videoName])) {
    $videoUrl = $videoMap[$videoName];

    // Fetch video using cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $videoUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_RANGE, $_SERVER['HTTP_RANGE']); // Handle range requests
    $videoData = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        // Serve the video with appropriate headers
        header('Content-Type: video/mp4');
        header('Content-Length: ' . strlen($videoData));
        header('Content-Disposition: inline; filename="video.mp4"'); // Suggest filename
        echo $videoData;
        exit;
    }
}

// Video not found
http_response_code(404);
echo 'Video not found.';


?>

