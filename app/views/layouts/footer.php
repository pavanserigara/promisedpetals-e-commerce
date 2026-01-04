</main>
</div>

<!-- Footer -->
<footer class="bg-white border-t border-brand-100 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php if (strpos($_SERVER['REQUEST_URI'], '/admin') === false): ?>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-1">
                    <h3 class="font-serif text-xl font-bold text-brand-800 mb-4">Promised Petals</h3>
                    <p class="text-slate-600 text-sm">Delivering emotions through exquisite floral arrangements. Make every
                        moment memorable with our premium blooms.</p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-bold text-brand-900 mb-4">Shop</h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="<?php echo URLROOT; ?>/pages/about" class="hover:text-brand-600">About Us</a></li>
                        <li><a href="<?php echo URLROOT; ?>/products" class="hover:text-brand-600">All Flowers</a></li>
                        <li><a href="<?php echo URLROOT; ?>/products?cat=bouquets" class="hover:text-brand-600">Bouquets</a>
                        </li>
                        <li><a href="<?php echo URLROOT; ?>/products?cat=wedding" class="hover:text-brand-600">Wedding</a>
                        </li>
                        <li><a href="<?php echo URLROOT; ?>/products?cat=gifts" class="hover:text-brand-600">Gifts</a>
                        </li>
                    </ul>
                </div>

                <!-- Help -->
                <div>
                    <h4 class="font-bold text-brand-900 mb-4">Help</h4>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-brand-600">Shipping & Delivery</a></li>
                        <li><a href="#" class="hover:text-brand-600">Returns Policy</a></li>
                        <li><a href="#" class="hover:text-brand-600">FAQ</a></li>
                        <li><a href="#" class="hover:text-brand-600">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="font-bold text-brand-900 mb-4">Stay in Bloom</h4>
                    <p class="text-slate-600 text-sm mb-4">Subscribe for latest updates and offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email"
                            class="flex-1 px-4 py-2 border border-brand-200 rounded-l-lg focus:outline-none focus:border-brand-500">
                        <button
                            class="bg-brand-600 text-white px-4 py-2 rounded-r-lg hover:bg-brand-700 transition">Subscribe</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <div class="border-t border-brand-100 mt-12 pt-8 text-center text-sm text-slate-500">
            &copy; <?php echo date('Y'); ?> Promised Petals. All rights reserved.
        </div>
    </div>
</footer>
<div class="h-32 md:hidden"></div>


<!-- High-End Mobile Navigation -->
<nav class="md:hidden fixed bottom-6 left-6 right-6 z-[100] pb-safe">
    <div
        class="bg-white/90 backdrop-blur-xl rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-white/20 px-6 py-4 flex justify-between items-center max-w-sm mx-auto">
        <?php if (strpos($_SERVER['REQUEST_URI'], '/admin') !== false): ?>
            <!-- Admin Links -->
            <a href="<?php echo URLROOT; ?>/admin" class="group flex flex-col items-center gap-1 min-w-[3rem]">
                <div
                    class="relative p-2 transition-all duration-300 <?php echo ($_SERVER['REQUEST_URI'] == '/admin') ? 'text-brand-600 -translate-y-1' : 'text-slate-400'; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <?php if ($_SERVER['REQUEST_URI'] == '/admin'): ?>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-brand-600 rounded-full"></span>
                    <?php endif; ?>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/admin/products" class="group flex flex-col items-center gap-1 min-w-[3rem]">
                <div
                    class="relative p-2 transition-all duration-300 <?php echo (strpos($_SERVER['REQUEST_URI'], 'admin/products') !== false && strpos($_SERVER['REQUEST_URI'], 'add') === false) ? 'text-brand-600 -translate-y-1' : 'text-slate-400'; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </a>

            <!-- FAB: Add Product -->
            <a href="<?php echo URLROOT; ?>/admin/products/add" class="-mt-8 group">
                <div
                    class="w-14 h-14 bg-brand-600 text-white rounded-full flex items-center justify-center shadow-lg shadow-brand-600/30 transition-transform active:scale-95 border-[4px] border-[#f8fafc]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/admin/orders" class="group flex flex-col items-center gap-1 min-w-[3rem]">
                <div
                    class="relative p-2 transition-all duration-300 <?php echo (strpos($_SERVER['REQUEST_URI'], 'admin/orders') !== false) ? 'text-brand-600 -translate-y-1' : 'text-slate-400'; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <?php if (strpos($_SERVER['REQUEST_URI'], 'admin/orders') !== false): ?>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-brand-600 rounded-full"></span>
                    <?php endif; ?>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/admin/users" class="group flex flex-col items-center gap-1 min-w-[3rem]">
                <div
                    class="relative p-2 transition-all duration-300 <?php echo (strpos($_SERVER['REQUEST_URI'], 'admin/users') !== false) ? 'text-brand-600 -translate-y-1' : 'text-slate-400'; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </a>

        <?php else: ?>
            <!-- Customer Links -->
            <a href="<?php echo URLROOT; ?>" class="group flex flex-col items-center gap-1 min-w-[3rem]">
                <div
                    class="relative p-2 transition-all duration-300 <?php echo ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index' || $_SERVER['REQUEST_URI'] == '/index.php') ? 'text-brand-600 -translate-y-1' : 'text-slate-400'; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <?php if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index' || $_SERVER['REQUEST_URI'] == '/index.php'): ?>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-brand-600 rounded-full"></span>
                    <?php endif; ?>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/products" class="group flex flex-col items-center gap-1 min-w-[3rem]">
                <div
                    class="relative p-2 transition-all duration-300 <?php echo (strpos($_SERVER['REQUEST_URI'], 'products') !== false) ? 'text-brand-600 -translate-y-1' : 'text-slate-400'; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <?php if (strpos($_SERVER['REQUEST_URI'], 'products') !== false): ?>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-brand-600 rounded-full"></span>
                    <?php endif; ?>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/cart" class="group flex flex-col items-center gap-1 min-w-[3rem] relative">
                <div
                    class="relative p-2 transition-all duration-300 <?php echo (strpos($_SERVER['REQUEST_URI'], 'cart') !== false) ? 'text-brand-600 -translate-y-1' : 'text-slate-400'; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span id="cart-count-mobile"
                        class="<?php echo (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) ? 'hidden' : ''; ?> absolute top-1 right-0 bg-brand-600 text-white text-[9px] font-bold rounded-full w-4 h-4 flex items-center justify-center shadow-sm">
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?>
                    </span>
                    <?php if (strpos($_SERVER['REQUEST_URI'], 'cart') !== false): ?>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-brand-600 rounded-full"></span>
                    <?php endif; ?>
                </div>
            </a>

            <a href="<?php echo URLROOT; ?>/users/profile" class="group flex flex-col items-center gap-1 min-w-[3rem]">
                <div
                    class="relative p-2 transition-all duration-300 <?php echo (strpos($_SERVER['REQUEST_URI'], 'profile') !== false) ? 'text-brand-600 -translate-y-1' : 'text-slate-400'; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <?php if (strpos($_SERVER['REQUEST_URI'], 'profile') !== false): ?>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-brand-600 rounded-full"></span>
                    <?php endif; ?>
                </div>
            </a>
        <?php endif; ?>
    </div>
</nav>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<!-- Main JS Essentials -->
<script>
    // Intelligent Splash Screen Handler
    const hideSplash = () => {
        const splash = document.getElementById('splash-screen');
        const main = document.getElementById('main-content');
        if (!splash || splash.classList.contains('hidden')) return;

        splash.style.opacity = '0';
        setTimeout(() => {
            splash.style.display = 'none';
            splash.classList.add('hidden');
            if (main) {
                main.classList.remove('opacity-0');
                main.style.opacity = '1';
            }
            initGSAP();
        }, 500);
    };

    // Hide on load OR after 1.5s max (Performance Fallback)
    window.addEventListener('load', hideSplash);
    setTimeout(hideSplash, 1500);

    function initGSAP() {
        if (window.gsapInitialized) return;
        window.gsapInitialized = true;
        gsap.registerPlugin(ScrollTrigger);

        // Optimized scrolling
        const nav = document.querySelector('nav');
        window.addEventListener('scroll', () => {
            if (!nav) return;
            if (window.scrollY > 20) {
                nav.classList.add('shadow-xl', 'bg-white/95');
                nav.style.transform = 'translateY(0)';
            } else {
                nav.classList.remove('shadow-xl', 'bg-white/95');
            }
        }, { passive: true });

        // Lightweight entrance
        gsap.utils.toArray('.animate-up').forEach(el => {
            gsap.from(el, {
                scrollTrigger: {
                    trigger: el,
                    start: "top 95%",
                    toggleActions: "play none none none"
                },
                y: 30,
                opacity: 0,
                duration: 0.6,
                ease: "power2.out"
            });
        });
    }

    // Smoother Cursor
    const dot = document.querySelector('[data-cursor-dot]');
    const outline = document.querySelector('[data-cursor-outline]');
    if (dot && outline && window.innerWidth > 1024) {
        window.addEventListener('mousemove', e => {
            gsap.to(dot, { x: e.clientX, y: e.clientY, duration: 0 });
            gsap.to(outline, { x: e.clientX, y: e.clientY, duration: 0.3 });
        }, { passive: true });
    }
</script>
</body>

</html>