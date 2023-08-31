document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const submitBtn = document.getElementById("submitBtn");
    const resultBox = document.getElementById("resultBox");
    const downloadBtn = document.getElementById("downloadBtn");
    const footer = document.getElementById("footer");
    const threadsUrlInput = document.getElementById("threads-url");
    const loadingSign = document.getElementById("loadingSign");
    const container = document.getElementById("container");
    var h1Element = document.getElementsByTagName("h1")[0];

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission

        const urlPattern = /^https:\/\/www\.threads\.net\/@[a-zA-Z0-9_]+\/post\/[a-zA-Z0-9_]+$/;

        if (
            threadsUrlInput.value.trim() === "" ||
            !urlPattern.test(threadsUrlInput.value.trim())
        ) {
            alert("Please enter a valid Threads URL.");
        } else {
            // Hide the result box and download button, show loading sign
            resultBox.style.display = "none";
            downloadBtn.style.display = "none";
            loadingSign.style.display = "block";

            // Adjust the form's position
            form.style.marginTop = "10px";
            footer.style.top = "70px";

            // Use fetch to retrieve data (replace with your actual fetching code)
            fetch("././thread.php", {
                method: "POST",
                body: new FormData(form),
            })
                .then(response => response.text())
                .then(data => {
                    // Hide the loading sign
                    loadingSign.style.display = "none";

                    // Display the result box and download button
                    resultBox.style.display = "block";
                    downloadBtn.style.display = "block";

                    // Set the inner HTML of resultBox with the scraped data
                    resultBox.innerHTML = data;

                    // Adjust the form's position after data is loaded
                    h1Element.style.top = "20px";
                    form.style.marginTop = "10px";
                    container.style.top = "20px";
                    footer.style.top = "50px";
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred while fetching data.");
                });
        }
    });
});
