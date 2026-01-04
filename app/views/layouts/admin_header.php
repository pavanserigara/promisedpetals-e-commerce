<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo SITENAME; ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            200: '#fbcfe8',
                            300: '#f9a8d4',
                            400: '#f472b6',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                            800: '#9d174d',
                            900: '#831843',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Custom CSS -->
    <style type="text/tailwindcss">
        @layer utilities {
            .glass-morphism {
                @apply bg-slate-900/90 backdrop-blur-xl border-b border-white/5;
            }
            .animate-up {
                animation: up 0.8s ease-out forwards;
                opacity: 0;
                transform: translateY(20px);
            }
            @keyframes up {
                to { opacity: 1; transform: translateY(0); }
            }
            .nav-link-admin {
                @apply text-slate-400 hover:text-white font-bold uppercase tracking-widest text-[10px] transition-all;
            }
        }
        .cursor-dot, .cursor-outline {
            position: fixed;
            top: 0; left: 0;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: 10000;
            pointer-events: none;
        }
        .cursor-dot { width: 6px; height: 6px; background-color: #f472b6; }
        .cursor-outline { width: 30px; height: 30px; border: 2px solid rgba(244, 114, 182, 0.3); }
        body { @apply text-slate-800 bg-slate-50 cursor-none; }
        @media (max-width: 768px) {
            .cursor-dot, .cursor-outline { display: none !important; }
            body { cursor: auto !important; }
        }
    </style>
</head>

<body class="antialiased font-sans">
    <!-- Splash Screen -->
    <div id="splash-screen"
        class="fixed inset-0 z-[10000] bg-slate-900 flex flex-col items-center justify-center transition-all duration-500">
        <div class="relative">
            <div class="w-24 h-24 border-4 border-slate-800 border-t-brand-400 rounded-full animate-spin"></div>
            <span class="absolute inset-0 flex items-center justify-center text-2xl">🏛️</span>
        </div>
        <h2 class="mt-6 font-serif text-2xl text-white animate-pulse tracking-widest text-center">Admin
            Dashboard<br><span class="text-[10px] font-bold uppercase tracking-[0.5em] text-slate-500">Secure
                Access</span></h2>
    </div>

    <!-- Custom Cursor -->
    <div class="cursor-dot" data-cursor-dot></div>
    <div class="cursor-outline" data-cursor-outline></div>

    <nav class="fixed w-full z-50 transition-all duration-300 glass-morphism">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo URLROOT; ?>/admin" class="flex items-center gap-3">
                        <span class="text-2xl filter drop-shadow-md">🌸</span>
                        <div class="flex flex-col">
                            <span class="font-serif text-lg text-white font-bold leading-none tracking-tight">Admin
                                Panel</span>
                            <span
                                class="text-[8px] font-bold text-brand-400 uppercase tracking-widest mt-1"><?php echo SITENAME; ?></span>
                        </div>
                    </a>
                </div>

                <!-- Admin Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="<?php echo URLROOT; ?>/admin"
                        class="nav-link-admin <?php echo (strpos($_SERVER['REQUEST_URI'], '/admin') !== false && !strpos($_SERVER['REQUEST_URI'], '/admin/')) ? 'text-brand-400 border-b-2 border-brand-400' : ''; ?>">Dashboard</a>
                    <a href="<?php echo URLROOT; ?>/admin/products"
                        class="nav-link-admin <?php echo (strpos($_SERVER['REQUEST_URI'], 'products') !== false) ? 'text-brand-400 border-b-2 border-brand-400' : ''; ?>">Products</a>
                    <a href="<?php echo URLROOT; ?>/admin/categories"
                        class="nav-link-admin <?php echo (strpos($_SERVER['REQUEST_URI'], 'categories') !== false) ? 'text-brand-400 border-b-2 border-brand-400' : ''; ?>">Categories</a>
                    <a href="<?php echo URLROOT; ?>/admin/orders"
                        class="nav-link-admin <?php echo (strpos($_SERVER['REQUEST_URI'], 'orders') !== false) ? 'text-brand-400 border-b-2 border-brand-400' : ''; ?>">Orders</a>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-4">
                    <a href="<?php echo URLROOT; ?>" target="_blank"
                        class="hidden sm:flex bg-white/5 border border-white/10 text-white/60 hover:text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all gap-2 items-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        View Site
                    </a>
                    <a href="<?php echo URLROOT; ?>/users/logout"
                        class="bg-brand-600 text-white px-6 py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest shadow-lg shadow-brand-900/20">Exit</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Removed traditional Mobile Menu as we'll use Bottom Nav -->

    <!-- Content Wrapper -->
    <div id="main-content" class="opacity-0 transition-opacity duration-1000">
        <main class="pt-16 md:pt-20 min-h-screen">