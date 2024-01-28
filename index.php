<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="threadimage, threads, sojijr, Soji Jr">
    <meta name="description" content="Takes your thread URL and converts it to an image (threadimage)">
    <meta name="author" content="sojijr">
    <meta name="author" content="Oluwadamilola Soji-Oderinde">
    <meta name="author" content="Soji Jr">
    <meta property="og:title" content="Threadimage: Threads to Images">
    <meta property="og:description" content="Takes your thread URL and converts it to an image (threadimage)">
    <meta property="og:image"
        content="https://raw.githubusercontent.com/sojijr/threadimage/master/assets/images/READMEbanner.png">
    <meta property="og:site_name" content="Threadimage">
    <meta name="twitter:creator" content="@sojiJr">

    <title>Threadimage: Threads to Images</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="https://github.com/sojijr/threadimage" target="_blank" class="github-link">
        <img src="https://cdn1.iconfinder.com/data/icons/logotypes/32/github-512.png" alt="GitHub Icon"
            class="github-icon">
        <span class="github-text">Check on GitHub</span>
    </a>

    <h1>Threadimage</h1>

    <div class="container" id="container">
        <form method="POST" id="form">
            <div class="input-container">
                <input type="text" id="threads-url" name="threads-url" placeholder="Threads Post URL/Link">
                <button type="submit" id="submitBtn">Submit</button>
            </div>
        </form>
        <div class="option-arrow">
            <p>Options <i class="fas fa-chevron-down"></i></p>
        </div>
        <div class="expand-content">
            <label for="colorPicker">Select Color:</label>
            <input type="color" id="colorPicker" name="colorPicker" value="#FFFFFF">
            <label for="fontSelector">Select Font:</label>
            <select id="fontSelector" name="fontSelector">
                <option value="Poppins, sans-serif">Poppins</option>
                <option value="Pacifico, cursive">Pacifico</option>
                <option value="Fugaz One, sans-serif">Fugaz One</option>
                <option value="Georgia, serif">Georgia</option>
                <option value="Courier New, monospace">Courier New</option>
                <option value="Dancing Script, cursive">Dancing Script</option>
                <option value="Sansita Swashed, sans-serif">Sansita</option>
            </select>
        </div>
    </div>

    <div id="loadingSign" style="display: none;">
        <div class="loading-spinner"></div>
        <p>Loading...</p>
    </div>

    <div class="result-box" id="resultBox">
        <div class="centered-text">
            <p></p>
        </div>
        <div class="bottom-left-text">
            <div class="profile-picture-frame">
            </div>
            <p></p>
        </div>
    </div>

    <button type="submit" name="submit" class="downloadBtn" id="downloadBtn">Download Image</button>

    <footer id="footer">
        <p>&copy; 2024. All rights reserved. Developed by <a href="https://twitter.com/sojiJr"
                target="_blank">@sojijr</a>
        </p>
    </footer>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/download.js"></script>
</body>

</html>