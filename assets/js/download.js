document.addEventListener("DOMContentLoaded", function () {
    // Get a reference to the DownloadBtn
    const downloadBtn = document.getElementById("downloadBtn");

    // Add a click event listener to the DownloadBtn
    downloadBtn.addEventListener("click", function () {
        // Get a reference to the result-box div
        const resultBox = document.getElementById("resultBox");

        // Use html2canvas to capture the content of the result-box
        html2canvas(resultBox, {
            useCORS: true, // Allow cross-origin images (for rounded corners)
            backgroundColor: null, // Transparent background
            scale: 2, // Increase scale for better resolution
            logging: false, // Disable logging (optional)
            borderRadius: 15, // Set the desired border radius
        }).then(function (canvas) {
            // Convert the canvas content to a data URL (PNG format)
            const dataURL = canvas.toDataURL("image/png");

            // Create a download link
            const a = document.createElement("a");
            a.href = dataURL;
            a.download = "threadimage.png";

            // Trigger a click event on the link to start the download
            a.click();
        });
    });
});
