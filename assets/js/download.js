document.addEventListener("DOMContentLoaded", function () {
    const downloadBtn = document.getElementById("downloadBtn");

    downloadBtn.addEventListener("click", function () {
        const resultBox = document.getElementById("resultBox");

        // Use html2canvas to capture the content of the result-box
        html2canvas(resultBox, {
            useCORS: true, // Allow cross-origin images (for rounded corners)
            backgroundColor: null, // Transparent background
            scale: 2, // Increase scale for better resolution
            logging: false, // Disable logging (optional)
            borderRadius: 15,
        }).then(function (canvas) {
            // Convert the canvas content to a data URL (PNG format)
            const dataURL = canvas.toDataURL("image/png");

            // Create a download link
            const a = document.createElement("a");
            a.href = dataURL;
            a.download = "threadimage.png";

            a.click();
        });
    });
});
