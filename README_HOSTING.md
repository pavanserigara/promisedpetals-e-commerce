# Hostinger Deployment Guide

This project is ready to be hosted on Hostinger (or any PHP/MySQL shared hosting).

## 1. File Upload
1. Go to your Hostinger **File Manager**.
2. Upload all the files from this folder to `public_html`.
   - If you want it in a subfolder (e.g., `yourdomain.com/shop`), create a folder named `shop` inside `public_html` and upload there.

## 2. Database Setup
1. Go to **MySQL Databases** in Hostinger dashboard.
2. Create a new Database.
   - Note down the **Database Name** (e.g., `u123456_shop`).
   - Note down the **Database Username** (e.g., `u123456_admin`).
   - Note down the **Password** you set.
3. Open **phpMyAdmin**.
4. Select your new database.
5. Click **Import** tab.
6. Upload the `database.sql` file included in this folder.
7. Click **Go** to run the script. This will create all tables and default users.

## 3. Configuration
1. In File Manager, open `app/config/config.php`.
2. Edit the following lines with your specific details:

```php
define('DB_USER', 'u123456_admin');     // Your Hostinger DB Username
define('DB_PASS', 'YourPassword');      // Your Hostinger DB Password
define('DB_NAME', 'u123456_shop');      // Your Hostinger DB Name
```

## 4. Default Login
- **Admin Email**: `admin@promisedpetals.com`
- **Password**: `password123`
(Note: You can change this in the Users table via phpMyAdmin or functionality if built).

## Troubleshooting
- If you see a "500 Internal Server Error", check `public/.htaccess` file permissions. They should be 644.
- Make sure PHP version 8.0 or higher is selected in Hostinger PHP Configuration.
