<?php
// webmention-cache.php
$domain = 'yourdomain.com'; // <-- Hier deine Domain rein
$cacheDir = __DIR__ . '/cache';
$cacheFile = $cacheDir . '/webmentions.json';
$cacheTTL = 3600; // Cache-Zeit in Sekunden (1 Stunde)

// Cache-Ordner anlegen, falls nicht vorhanden
if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

function fetch_webmentions($domain, $cacheFile, $cacheTTL) {
    if (file_exists($cacheFile)) {
        $cacheAge = time() - filemtime($cacheFile);
        if ($cacheAge < $cacheTTL) {
            return json_decode(file_get_contents($cacheFile), true);
        }
    }

    $url = "https://webmention.io/api/mentions.jf2?domain=" . urlencode($domain);
    $response = @file_get_contents($url);

    if ($response === false) {
        if (file_exists($cacheFile)) {
            return json_decode(file_get_contents($cacheFile), true);
        }
        return null;
    }

    file_put_contents($cacheFile, $response);
    return json_decode($response, true);
}

$webmentions = fetch_webmentions($domain, $cacheFile, $cacheTTL);

if ($webmentions && isset($webmentions['children'])) {
    echo '<section class="webmentions">';
    echo '<h2>Webmentions</h2>';
    echo '<ul>';
    foreach ($webmentions['children'] as $mention) {
        $author = $mention['author']['name'] ?? 'Anonymous';
        $url = $mention['url'] ?? '#';
        $content = $mention['content']['text'] ?? '';
        $published = isset($mention['published']) ? date('Y-m-d', strtotime($mention['published'])) : '';

        echo '<li>';
        echo '<strong><a href="' . htmlspecialchars($url) . '" target="_blank" rel="nofollow noopener noreferrer">' . htmlspecialchars($author) . '</a></strong>';
        echo ' on <em>' . $published . '</em>: ';
        echo htmlspecialchars($content);
        echo '</li>';
    }
    echo '</ul>';
    echo '</section>';
} else {
    echo '<p>No Webmentions found.</p>';
}
?>

