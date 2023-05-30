var elem = document.getElementById("videoPlayer");

function toggleFullScreen() {
    if (!document.fullscreenElement) {
        elem.requestFullscreen().catch((err) => {
            alert(
                `Error attempting to enable full-screen mode: ${err.message} (${err.name})`
            );
        });
    } else {
        document.exitFullscreen();
    }
}
elem.addEventListener("click", function () {
    toggleFullScreen();
});
