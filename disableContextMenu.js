// disableContextMenu.js
document.addEventListener('DOMContentLoaded', function() {
    const videoElement = document.querySelector('video');

    if (videoElement) {
       // videoElement.controlsList.add('nodownload');

        videoElement.addEventListener('contextmenu', (event) => {
            event.preventDefault();
        });

        const randomAttributeName = 'data-' + Math.random().toString(36).substr(2, 10);
    
        // Add the nodownload-like behavior using the random attribute
        videoElement.setAttribute(randomAttributeName, 'true');


        document.addEventListener('keydown', (event) => {
            if (event.ctrlKey && (event.key === 'c' || event.key === 'x')) {
                event.preventDefault();
            }
        });




    }
});


