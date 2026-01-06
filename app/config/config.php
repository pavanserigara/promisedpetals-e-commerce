<?php
// Database configuration
// UPDATE THESE WITH YOUR HOSTINGER DATABASE DETAILS
define('DB_HOST', 'localhost');
define('DB_USER', 'u123456789_user');     // Replace with Hostinger Database Username
define('DB_PASS', 'YourStrongPassword');  // Replace with Hostinger Database Password
define('DB_NAME', 'u123456789_db');       // Replace with Hostinger Database Name

// App Root
define('APPROOT', dirname(dirname(__FILE__)));

// URL Root
// Automatically detects the domain name and base path.
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$script_name = dirname($_SERVER['SCRIPT_NAME']);
// Remove /public if it's in the path (since we rewrite to it) but keep other subdirs
$script_name = str_replace('/public', '', $script_name);
// Normalize slashes
$script_name = rtrim($script_name, '/\\');

define('URLROOT', $protocol . "://" . $host . $script_name);

// Site Name
define('SITENAME', 'Promised Petals');

// App Version
define('APPVERSION', '1.0.0');
