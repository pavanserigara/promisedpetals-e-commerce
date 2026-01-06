<?php
// router.php for PHP built-in server to simulate Apache .htaccess rewrites

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Check if file exists in public directory
$publicFile = __DIR__ . '/public' . $uri;

if ($uri !== '/' && file_exists($publicFile) && !is_dir($publicFile)) {
    // Serve static file from public
    // We need to adjust SCRIPT_FILENAME to point to public
    // But PHP built-in server with router script handles serving if we return false?
    // No, if we return false, it serves the file from the startup directory.
    // But our files are in public/.
    // So we should just output the file or redirect?
    // Simpler: Serve it.

    // Actually, simpler approach:
    // User requested /css/style.css
    // We want to serve public/css/style.css
    // But we are running from root.
    // If we run `php -S localhost:8000 -t public`, we don't need this mapping.
    // But we need to handle rewrites.

    return false; // This works if -t public is NOT used, but we are in root.
    // Wait, if we run in root, and request /css/style.css, local file ./css/style.css does NOT exist. ./public/css/style.css exists.
    // So we must serve it manually or chdir?
}

// If we are here, it's a rewrite or the root.
// Map to public/index.php
$_GET['url'] = ltrim($uri, '/');
if ($uri === '/')
    $_GET['url'] = '';

// Needed for the app to find files relative to index.php
chdir(__DIR__ . '/public');
require_once __DIR__ . '/public/index.php';
