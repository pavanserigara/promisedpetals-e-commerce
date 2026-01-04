<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
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
        @layer base {
            html { scroll-behavior: smooth; }
        }
        @layer utilities {
            .glass-morphism {
                @apply bg-white/80 backdrop-blur-xl border-b border-white/20;
            }
            .hero-gradient {
                background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            .nav-link {
                @apply relative text-slate-600 hover:text-brand-600 font-medium transition-all duration-300;
            }
            .nav-link::after {
                content: '';
                @apply absolute bottom-0 left-0 w-0 h-0.5 bg-brand-500 transition-all duration-300;
            }
            .nav-link:hover::after {
                @apply w-full;
            }
        }
        .cursor-dot, .cursor-outline {
            position: fixed;
            top: 0;
            left: 0;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: 10000;
            pointer-events: none;
        }
        .cursor-dot { width: 6px; height: 6px; background-color: #db2777; transition: width 0.3s, height 0.3s; }
        .cursor-outline { width: 30px; height: 30px; border: 2px solid rgba(219, 39, 119, 0.3); transition: width 0.3s, height 0.3s; }
        body { @apply text-slate-800 bg-white overflow-x-hidden transition-colors duration-500; }
        @media (max-width: 768px) {
            .cursor-dot, .cursor-outline { display: none !important; }
            body { cursor: auto !important; }
        }
    </style>
</head>

<body class="antialiased font-sans">
    <!-- Splash Screen -->
    <div id="splash-screen"
        class="fixed inset-0 z-[10000] bg-white flex flex-col items-center justify-center transition-all duration-500">
        <div class="relative">
            <div class="w-24 h-24 border-4 border-brand-100 border-t-brand-600 rounded-full animate-spin"></div>
            <span class="absolute inset-0 flex items-center justify-center text-2xl">🌸</span>
        </div>
        <h2 class="mt-6 font-serif text-2xl text-brand-900 animate-pulse tracking-widest text-center">Promised
            Petals<br><span class="text-[10px] font-bold uppercase tracking-[0.5em] text-slate-400">Loading
                Excellence</span></h2>
    </div>

    <!-- Custom Cursor -->
    <div class="cursor-dot" data-cursor-dot></div>
    <div class="cursor-outline" data-cursor-outline></div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 glass-morphism" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo URLROOT; ?>"
                        class="font-serif text-lg md:text-2xl font-bold bg-gradient-to-r from-brand-600 to-brand-400 bg-clip-text text-transparent flex items-center gap-2">
                        <span class="text-xl md:text-3xl filter drop-shadow-sm">🌸</span> <span
                            class="tracking-tight">Promised Petals</span>
                    </a>
                </div>

                <!-- Desktop Menu (Center) -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="<?php echo URLROOT; ?>" class="nav-link">Home</a>
                    <a href="<?php echo URLROOT; ?>/products" class="nav-link">Shop</a>
                    <a href="<?php echo URLROOT; ?>/pages/about" class="nav-link">About Us</a>
                    <a href="<?php echo URLROOT; ?>/pages/contact" class="nav-link">Contact</a>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                        <a href="<?php echo URLROOT; ?>/admin"
                            class="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm font-bold shadow hover:bg-slate-700 transition">Admin
                            Panel</a>
                    <?php endif; ?>
                </div>

                <!-- Desktop Menu (Right) -->
                <div class="hidden md:flex items-center space-x-6">
                    <!-- Search Icon (Expands on Desktop) -->
                    <div class="relative group hidden lg:block">
                        <form action="<?php echo URLROOT; ?>/products" method="GET">
                            <input type="text" name="q" placeholder="Search..."
                                class="w-32 group-hover:w-64 bg-slate-100 border-none rounded-full py-2 px-4 pl-10 focus:ring-2 focus:ring-brand-400 transition-all duration-500 text-sm">
                            <button type="submit"
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-hover:text-brand-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="<?php echo URLROOT; ?>/cart"
                            class="text-slate-700 hover:text-brand-600 relative transition-transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span id="cart-count"
                                class="<?php echo (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) ? 'hidden' : ''; ?> absolute -top-1 -right-1 bg-brand-600 text-white text-[8px] font-bold rounded-full h-4 w-4 flex items-center justify-center">
                                <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?>
                            </span>
                        </a>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="<?php echo URLROOT; ?>/users/profile"
                                class="p-1 border-2 border-transparent hover:border-brand-300 rounded-full transition-all">
                                <div
                                    class="w-10 h-10 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-sm shadow-inner">
                                    <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
                                </div>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo URLROOT; ?>/users/login"
                                class="bg-slate-900 text-white px-8 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-xl hover:bg-brand-600 transition-all duration-300">Login</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Mobile Header Actions -->
                <div class="flex md:hidden items-center gap-4">
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                        <a href="<?php echo URLROOT; ?>/admin"
                            class="text-brand-600 font-bold text-[10px] uppercase tracking-widest border border-brand-200 px-3 py-1 rounded-full">Admin</a>
                    <?php endif; ?>
                    <button class="text-slate-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg></button>
                </div>
            </div>
        </div>
    </nav>

    <div id="main-content" class="opacity-0 transition-opacity duration-1000">
        <main class="pt-16 md:pt-20 min-h-screen">