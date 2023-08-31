<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Threadimage: Threads to Images</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="https://github.com/sojijr/threadimage" target="_blank" class="github-link">
        <img src="https://cdn1.iconfinder.com/data/icons/logotypes/32/github-512.png" alt="GitHub Icon"
            class="github-icon">
        <span class="github-text">Check on GitHub</span>
    </a>

    <h1>Threadimage</h1>

    <div class="container">
        <form method="POST" id="form">
            <div class="input-container">
                <input type="text" id="threads-url" name="threads-url" placeholder="Threads Post URL/Link">
                <button type="submit" id="submitBtn">Submit</button>
            </div>
        </form>
    </div>

    <div id="loadingSign" style="display: none;">
        <div class="loading-spinner"></div>
        <p>Loading...</p>
    </div>

    <div class="result-box" id="resultBox">
        <div class="centered-text">
            <p>This is the centered text.</p>
        </div>
        <div class="bottom-left-text">
            <p>This is the bottom left text.</p>
        </div>
    </div>

    <button type="submit" name="submit" class="downloadBtn" id="downloadBtn">Download Image</button>

    <footer id="footer">
        <p>&copy; 2023. All rights reserved. Created by <a href="https://twitter.com/sojiJr" target="_blank">@sojijr</a>
        </p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>

</html>