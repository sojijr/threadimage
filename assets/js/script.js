document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const resultBox = document.getElementById("resultBox");
    const downloadBtn = document.getElementById("downloadBtn");
    const footer = document.getElementById("footer");
    const threadsUrlInput = document.getElementById("threads-url");
    const loadingSign = document.getElementById("loadingSign");
    const container = document.getElementById("container");
    var h1Element = document.getElementsByTagName("h1")[0];
    const optionArrow = document.querySelector(".option-arrow");
    const optionContent = document.querySelector(".expand-content");
    const colorPicker = document.getElementById("colorPicker");

    // Option arrow dropdown
    optionArrow.addEventListener("click", function () {
        optionArrow.classList.toggle("active");
        container.classList.toggle("expanded");
        optionContent.classList.toggle("show");
    });

    // Color picker
    colorPicker.addEventListener("input", function () {
        const selectedColor = colorPicker.value;
        resultBox.style.backgroundColor = selectedColor;

        const brightness = getBrightness(selectedColor);

        const paragraphs = resultBox.querySelectorAll("p");
    
        // Set font color for all <p> tags based on brightness
        const fontColor = brightness <= 128 ? "white" : "black";
        paragraphs.forEach(function (paragraph) {
            paragraph.style.color = fontColor;
        });
    });
    
    // Function to calculate brightness of a color
    function getBrightness(color) {
        const hex = color.slice(1);
        const r = parseInt(hex.slice(0, 2), 16);
        const g = parseInt(hex.slice(2, 4), 16);
        const b = parseInt(hex.slice(4, 6), 16);
        const brightness = (r + g + b) / 3;
        return brightness;
    }
    
    // Font picker
    fontSelector.addEventListener("change", function () {
        const selectedFont = fontSelector.value;
        resultBox.style.fontFamily = selectedFont;
    });

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission

        const urlPattern = /^https:\/\/www\.threads\.net\/@[a-zA-Z0-9_.-]+\/post\/[a-zA-Z0-9_\-]+(\/\?.*)?$/;
        
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

            // Use fetch to retrieve data
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
                    container.classList.toggle("options");
                    optionArrow.style.display = "block";

                    // Set the inner HTML of resultBox with the data
                    resultBox.innerHTML = data;

                    // Check viewport width and adjust the form's position after data is loaded
                    if (window.innerWidth <= 480) {
                        h1Element.style.top = "60px";
                        form.style.marginTop = "1px";
                        container.style.top = "60px";
                        footer.style.top = "70px";
                    }
                    else{
                    // Adjust the form's position after data is loaded
                    h1Element.style.top = "40px";
                    form.style.marginTop = "10px";
                    container.style.top = "50px";
                    resultBox.style.top = "45px";
                    resultBox.style.marginTop = "20px";
                    downloadBtn.style.top = "40px";
                    footer.style.top = "80px";
                    }

                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred while fetching data.");
                });
        }
    });
});
