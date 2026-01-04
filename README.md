# Promised Petals 🌸

A premium e-commerce website for a boutique flower brand, built with Core PHP, MySQL, and Tailwind CSS.

## Features ✨

*   **User Authentication**: Secure Signup, Login, and Session management.
*   **Product Catalogue**: Browse bouquets, roses, and gifts with category filtering.
*   **Shopping Cart**: AJAX-powered cart management without page reloads.
*   **Checkout Flow**: Seamless checkout with order placement and history.
*   **Admin Panel**: Dashboard for managing products and viewing basic stats.
*   **Responsive Design**: Mobile-friendly layout using Tailwind CSS.
*   **Animations**: Smooth transitions and scroll effects using GSAP.

## Tech Stack 🛠️

*   **Backend**: PHP (MVC Architecture)
*   **Database**: MySQL
*   **Frontend**: HTML5, Tailwind CSS
*   **Scripting**: JavaScript (Fetch API, GSAP)

## Setup Instructions 🚀

1.  **Database Setup**:
    *   Create a MySQL database named `promised_petals`.
    *   Import the `database.sql` file located in the root directory.

2.  **Configuration**:
    *   Open `app/config/config.php`.
    *   Update `DB_USER`, `DB_PASS` if your local environment differs from default (`root`/``).
    *   The `URLROOT` is dynamically calculated, but ensure your server points to `public/` as the document root or alias.

3.  **Running the Project**:
    *   If using XAMPP/WAMP, place the folder in `htdocs` or `www`.
    *   Navigate to `http://localhost/promised%20petals/public` (or your specific URL).

## Admin Access 🔑

*   **Email**: `admin@promisedpetals.com`
*   **Password**: `password123` (Note: In a real deployment, change this immediately via database hash).

## Project Structure 📂

```
promised petals/
├── app/
│   ├── config/      # Database & App Config
│   ├── controllers/ # Request handlers
│   ├── core/        # Router, Database, Controller Base
│   ├── helpers/     # Session & Auth helpers
│   ├── models/      # Database interactions
│   └── views/       # HTML Templates
├── public/
│   ├── assets/      # JS, CSS
│   ├── img/         # Product Images
│   └── index.php    # Entry Point
└── database.sql     # Database Schema
```
