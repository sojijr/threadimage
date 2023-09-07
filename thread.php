<?php

require('assets/simple_html_dom.php');

// Function to make URLs clickable links with link previews
function makeLinksClickable($text)
{
    // Define a regular expression pattern to match URLs
    $pattern = '/(https?:\/\/[^\s]+)|((www\.)?[a-zA-Z0-9.-]+\.(com|net|org|edu|be|ng|gov|int|info|io|me|co|biz|tv|tech|vercel\.app)[^\s]*)/';

    // Replace URLs with clickable links
    $text = preg_replace_callback($pattern, function ($matches) {
        $url = $matches[0];
        // Check if the URL starts with http:// or https://, and add it if missing
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        // Fetch Open Graph tags for link previews
        $ogTags = getOpenGraphTags($url);
        
        // Build the link preview HTML
        $linkPreview = '<a href="' . $url . '" target="_blank" class="link-preview-box">';
        $linkPreview .= '<div class="link-preview-content">';
        if (!empty($ogTags['og:image'])) {
            $linkPreview .= '<img src="' . $ogTags['og:image'] . '" alt="Link Preview Image">';
        }
        $linkPreview .= '<div class="link-preview-info">';
        if (!empty($ogTags['og:title'])) {
            $linkPreview .= '<strong>' . $ogTags['og:title'] . '</strong><br>';
        }
        // if (!empty($ogTags['og:description'])) {
        //     $linkPreview .= '<p>' . $ogTags['og:description'] . '</p>';
        // }
        $linkPreview .= '</div>'; // Close link-preview-info
        $linkPreview .= '</div>'; // Close link-preview-content
        $linkPreview .= '</a>'; // Close link-preview-box


        // Create a link with the link preview
        $link = '<a href="' . $url . '" target="_blank">' . $url . '</a>';
        $link .= $linkPreview;

        return $link;
    }, $text);

    return $text;
}

// Function to fetch Open Graph tags from a URL
function getOpenGraphTags($url)
{
    $curl = curl_init($url);

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0',
        CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $html = curl_exec($curl);

    if (curl_errno($curl)) {
        echo "cURL Error #" . curl_errno($curl) . ": " . curl_error($curl);
        exit;
    }

    curl_close($curl);

    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $ogTags = array();

    // Get all meta tags with property starting with 'og:'
    $metaTags = $doc->getElementsByTagName('meta');
    foreach ($metaTags as $tag) {
        $property = $tag->getAttribute('property');
        if (strpos($property, 'og:') === 0) {
            $ogTags[$property] = $tag->getAttribute('content');
        }
    }

    return $ogTags;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $threadsUrl = $_POST["threads-url"];

    // Initialize cURL session
    $curl = curl_init($threadsUrl);

    // Set cURL options
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0', // Set a user agent to avoid blocking
        CURLOPT_SSL_VERIFYPEER => false, // Ignore SSL certificate validation
    ]);

    // Execute the cURL request
    $html = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        echo "cURL Error #" . curl_errno($curl) . ": " . curl_error($curl);
        exit;
    }

    // Close cURL session
    curl_close($curl);

    // Extract @username from the Threads URL
    $parsedUrl = parse_url($threadsUrl);
    $path = explode('/', $parsedUrl['path']);
    $username = isset($path[1]) ? $path[1] : '';

    // Extract image links using regular expressions
    $imageLinks = [];
    $pattern = '/https?:\/\/scontent\.cdninstagram\.com\/v\/[^\s]+/i';
    preg_match_all($pattern, $html, $matches);
    if (!empty($matches[0])) {
        // Filter and keep only the first link that starts with 'https://scontent.cdninstagram.com/v/'
        $filteredLinks = array_filter($matches[0], function ($link) {
            return strpos($link, 'https://scontent.cdninstagram.com/v/') === 0;
        });
        if (!empty($filteredLinks)) {
            $imageLinks[] = reset($filteredLinks);
        }
    }

    // Create a Simple HTML DOM object to find the og:description meta tag
    $dom = str_get_html($html);
    $element = $dom->find('meta[property=og:description]', 0);

    if ($element !== null) {
        $text = $element->content;

        // Decode HTML entities to display html entities correctly
        $text = htmlspecialchars_decode($text, ENT_QUOTES);

        // Make URLs clickable links with link previews
        $text = makeLinksClickable($text);

        // Check if there are image links and if the content has any links
        $hasImageLinks = !empty($imageLinks);
        $hasContentLinks = preg_match('/<a\s*[^>]*href="([^"]*)"[^>]*>.*<\/a>/i', $text);

        echo "<div class='centered-text'><p>". $text . "</p></div>";

        if ($hasImageLinks && !$hasContentLinks) {
            // Remove trailing double quote from $imageLinks[0]
            $imageLinks[0] = rtrim($imageLinks[0], '"');
            $imageLinks[0] = html_entity_decode($imageLinks[0]);

            // Proxy the image through your server
            $imageContents = file_get_contents($imageLinks[0]);
            $imageDataUrl = 'data:image/jpeg;base64,' . base64_encode($imageContents);
            
            echo "<img width='50%' height='auto' src='$imageDataUrl'>";
        }
        
        echo "<div class='bottom-left-text'><p>". htmlentities($username) . "</p></div>";
       
    } else {
        echo "Threads page not found  :(";
    }

    // Clean up the Simple HTML DOM object
    $dom->clear();
} else {
    echo "Invalid request method.";
}
