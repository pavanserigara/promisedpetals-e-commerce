<?php
// router.php for PHP Built-in Server

// Enable Error Reporting for Debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Get the requested URI path without query string
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Check if the file exists in the public directory
if (file_exists(__DIR__ . $path) && is_file(__DIR__ . $path)) {
    return false; // Let the built-in server serve the static file
}

// Handle special case for root (index)
if ($path === '/') {
    $_GET['url'] = '';
} else {
    // Populate $_GET['url'] for the app's Core class to use
    // ltrim removes the leading slash so '/products' becomes 'products'
    $_GET['url'] = ltrim($path, '/');
}

// Include the main index file
require_once 'index.php';
