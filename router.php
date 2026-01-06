<?php
/**
 * router.php for PHP built-in server
 * Use: php -S localhost:8000 router.php
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Define public path
$publicDir = __DIR__ . '/public';
$filePath = $publicDir . $uri;

// If the file exists in public/, serve it
if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    $ext = pathinfo($filePath, PATHINFO_EXTENSION);

    // Basic Mime Types
    $mimes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'webp' => 'image/webp',
        'pdf' => 'application/pdf',
        'ico' => 'image/x-icon',
    ];

    if (isset($mimes[$ext])) {
        header('Content-Type: ' . $mimes[$ext]);
    }

    readfile($filePath);
    return true;
}

// Routing for MVC
$_GET['url'] = ltrim($uri, '/');
if ($uri === '/')
    $_GET['url'] = '';

// Crucial: Set current directory to public so index.php paths work
chdir($publicDir);
require_once 'index.php';
