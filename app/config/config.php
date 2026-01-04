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
// Automatically detects the domain name. 
// If your site is in a subfolder (e.g. domain.com/shop), append it here.
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
define('URLROOT', $protocol . "://" . $_SERVER['HTTP_HOST']);

// Site Name
define('SITENAME', 'Promised Petals');

// App Version
define('APPVERSION', '1.0.0');
