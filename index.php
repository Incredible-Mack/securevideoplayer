<?php session_start(); $_SESSION['videoplayer'] = 1;?>
<!DOCTYPE html>
<html>
<head>
    <title>Delayed Video Playback</title>
    <link href="./vid.css" rel="stylesheet">
    <script src='./disableContextMenu.js' ></script>
</head>
<body>
    <video
        id="my-video"
        class="video-js"
        controls
        preload="auto"
        width="640"
        height="360"
        data-setup='{"remainingTimeDisplay": false}'>
        <!-- <source src="https://d1ent1.loveworldcloud.com/~kiddiesmedia/LOVETOONS_TV/three%20hours/Lovetoons%203Hr%20Episode%2031.mp4" type="video/mp4"> -->

        <!-- <source src="http://localhost/securevideoplayer/esther.mp4" type="video/mp4"> -->
    </video>

    <script src="./jquery.js"></script>
    <script src="./vid.js"></script>
    <script>
// Make an AJAX request to get the obfuscated video URL
$.ajax({
    url: 'get_video_url.php', // Replace with the actual URL to your PHP script
    method: 'GET',
    dataType: 'json',
    success: function (response) {
        if (response.success) {
            var obfuscatedVideoUrl = response.obfuscatedVideoUrl;
            initializeVideoPlayer(obfuscatedVideoUrl);
        } else {
            console.error('Failed to retrieve obfuscated video URL.');
        }
    },
    error: function () {
        console.error('AJAX request failed.');
    }
});

// Initialize Video.js player
function initializeVideoPlayer(videoUrl) {
    var player = videojs('my-video');
    player.src({ type: 'video/mp4', src: videoUrl });

    const nigeriaTime = new Date().toLocaleString('en-US', { timeZone: 'Africa/Lagos' });
    const startTime = new Date(nigeriaTime);
    startTime.setHours(17); // Set the desired start time hours (7:00 PM)
    startTime.setMinutes(25); // Set the desired start time minutes (21 minutes)

    // When the Video.js player is ready
    player.ready(function () {
        handlePlayback(player, startTime);
    });

    // When the video is paused
    player.on('pause', function () {
        handlePause(player);
    });
}

// Handle playback and seeking
function handlePlayback(player, startTime) {
    const currentTime = Math.floor((Date.now() - startTime) / 1000) * 1000;
    
    // Set the initial playback position
    player.currentTime(currentTime / 1000); // Convert back to seconds

    // Start playing the video
    player.play();

    // When seeking is initiated
    player.on('seeking', function () {
        handleSeeking(player, startTime);
    });
}

// Handle seeking based on current time frame
function handleSeeking(player, startTime) {
    const currentTime = Math.floor((Date.now() - startTime) / 1000) * 1000;
    
    // Allow seeking up to the total play time
    if (player.currentTime() > currentTime / 1000) {
        player.currentTime(currentTime / 1000); // Convert back to seconds
    }
    console.log(currentTime);
}

// Handle pause and automatic resume
function handlePause(player) {
    if (player.currentTime() < player.duration() - 1) {
        setTimeout(function () {
            player.play();
        }, 1000); // Delay in milliseconds before resuming playback
    }
}


    </script>
</body>
</html>



<!-- <source src="https://d1ent1.loveworldcloud.com/~kiddiesmedia/LOVETOONS_TV/three%20hours/Lovetoons%203Hr%20Episode%2031.mp4" type="video/mp4"> -->
<!-- console.log(timeDifference) -->