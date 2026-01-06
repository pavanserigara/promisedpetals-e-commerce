<?php require APPROOT . '/views/layouts/header.php'; ?>

<!-- Slider Hero Section (Desktop & Mobile) -->
<div class="relative group">
    <div class="swiper heroSwiper h-[70vh] md:h-[85vh]">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide relative overflow-hidden">
                <img src="<?php echo URLROOT; ?>/img/hero/hero-1.jpg"
                    class="absolute inset-0 w-full h-full object-cover transform scale-110" alt="Luxury Boutique">
                <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-2xl">
                            <h2
                                class="text-brand-300 font-bold uppercase tracking-[0.3em] mb-4 text-sm md:text-base animate-up">
                                Luxury Floral Experience</h2>
                            <h1 class="text-3xl md:text-7xl font-serif text-white leading-tight mb-8 animate-up"
                                style="animation-delay: 0.1s">Crafting Moments <br> With Nature's Art</h1>
                            <div class="animate-up" style="animation-delay: 0.2s">
                                <a href="<?php echo URLROOT; ?>/products"
                                    class="inline-flex items-center bg-white text-brand-900 px-8 py-4 rounded-full font-bold shadow-2xl hover:bg-brand-50 transition-all transform hover:scale-105 active:scale-95">
                                    Shop Collection
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide relative">
                <img src="<?php echo URLROOT; ?>/img/hero/hero-2.jpg"
                    class="absolute inset-0 w-full h-full object-cover" alt="Exotic Orchids">
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="absolute inset-0 flex items-center justify-center text-center">
                    <div class="max-w-3xl px-4">
                        <h2 class="text-white font-medium mb-4 animate-up">Freshness Guaranteed</h2>
                        <h1 class="text-3xl md:text-8xl font-serif text-white mb-8 animate-up">Exotic Blooms</h1>
                        <a href="<?php echo URLROOT; ?>/products"
                            class="bg-brand-600 text-white px-10 py-5 rounded-full font-bold shadow-xl hover:bg-brand-700 transition">Explore
                            More</a>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide relative">
                <img src="<?php echo URLROOT; ?>/img/hero/hero-3.jpg"
                    class="absolute inset-0 w-full h-full object-cover" alt="Romantic Roses">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-20 left-0 w-full">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h1 class="text-3xl md:text-6xl font-serif text-white mb-4">The Perfect Gift</h1>
                        <p class="text-white/80 max-w-lg mb-8">Express your feelings with our handpicked red roses,
                            delivered with love and care.</p>
                        <a href="<?php echo URLROOT; ?>/products"
                            class="text-white border-2 border-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-brand-900 transition">Order
                            Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination & Navigation -->
        <div class="swiper-pagination !bottom-10"></div>
        <div class="swiper-button-next !text-white/50 hover:!text-white hidden md:flex"></div>
        <div class="swiper-button-prev !text-white/50 hover:!text-white hidden md:flex"></div>
    </div>
</div>

<!-- Category Circles (Premium) -->
<section class="py-12 bg-white">
    <div
        class="max-w-7xl mx-auto px-4 overflow-x-auto no-scrollbar scroll-smooth flex justify-between gap-6 md:gap-12 md:justify-center">
        <?php foreach ($data['categories'] as $category): ?>
            <a href="<?php echo URLROOT; ?>/products?category=<?php echo $category->slug; ?>"
                class="flex-shrink-0 flex flex-col items-center group">
                <div
                    class="w-16 h-16 md:w-24 md:h-24 rounded-full overflow-hidden border-2 border-brand-100 group-hover:border-brand-500 transition-all duration-500 transform group-hover:scale-110 shadow-sm group-hover:shadow-lg">
                    <img src="<?php echo getCategoryImage($category->image); ?>"
                        class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-700"
                        alt="<?php echo $category->name; ?>" loading="lazy"
                        onerror="this.src='https://images.unsplash.com/photo-1526047932273-341f2a7631f9?q=80&w=200&h=200&auto=format&fit=crop'">
                </div>
                <span
                    class="mt-3 text-xs md:text-sm font-bold text-slate-700 group-hover:text-brand-600 transition-colors tracking-wide"><?php echo $category->name; ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Featured Products Grid (6 items, 2 per row) -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h2 class="text-2xl md:text-5xl font-serif text-slate-900 mb-2">Featured Collection</h2>
            <div class="h-1.5 w-20 bg-brand-500 rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php
            $featured_count = 0;
            foreach ($data['featured_products'] as $product):
                if ($featured_count >= 8)
                    break;
                $featured_count++;
                ?>
                <div
                    class="group relative bg-white rounded-3xl p-4 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 border border-slate-100/50">
                    <div
                        class="relative overflow-hidden rounded-2xl aspect-[9/11] mb-6 border border-slate-100 bg-slate-50">
                        <img src="<?php echo getProductImage($product->image); ?>"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            alt="<?php echo $product->name; ?>">

                        <!-- Quick Add -->
                        <div class="absolute bottom-3 left-3 right-3 flex gap-2">
                            <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>"
                                class="flex-1 bg-white/90 backdrop-blur-md text-slate-900 py-3 rounded-xl font-bold text-xs md:text-sm text-center shadow-lg hover:bg-brand-600 hover:text-white transition-all whitespace-nowrap">Details</a>
                            <button onclick="addToCart(<?php echo $product->id; ?>)"
                                class="w-10 md:w-12 h-full bg-white/90 backdrop-blur-md rounded-xl flex items-center justify-center text-brand-600 shadow-lg hover:bg-brand-600 hover:text-white transition-all flex-shrink-0">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <span
                            class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-1 block"><?php echo $product->category_name; ?></span>
                        <h3 class="text-lg font-bold text-slate-800 mb-2 truncate"><?php echo $product->name; ?></h3>
                        <div class="flex items-center justify-between">
                            <span
                                class="text-xl font-bold text-brand-600">₹<?php echo number_format($product->price, 2); ?></span>
                            <div class="flex items-center text-yellow-400">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>
                                <span class="text-slate-400 text-xs ml-1">(4.8)</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us (Iconic) -->
<section class="py-20 bg-brand-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div
                class="flex flex-col items-center text-center p-6 bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 animate-up">
                <div class="w-16 h-16 bg-brand-100 rounded-2xl flex items-center justify-center text-brand-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
                <h3 class="font-bold text-slate-800 mb-2">Same Day</h3>
                <p class="text-xs text-slate-500">Order by 2PM</p>
            </div>
            <div class="flex flex-col items-center text-center p-6 bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 animate-up"
                style="animation-delay: 0.1s">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="font-bold text-slate-800 mb-2">Fresh Blooom</h3>
                <p class="text-xs text-slate-500">Direct from farm</p>
            </div>
            <div class="flex flex-col items-center text-center p-6 bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 animate-up"
                style="animation-delay: 0.2s">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="font-bold text-slate-800 mb-2">Secure Pay</h3>
                <p class="text-xs text-slate-500">100% Protection</p>
            </div>
            <div class="flex flex-col items-center text-center p-6 bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 animate-up"
                style="animation-delay: 0.3s">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center text-green-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="font-bold text-slate-800 mb-2">With Love</h3>
                <p class="text-xs text-slate-500">Handcrafted</p>
            </div>
        </div>
    </div>
</section>

<!-- Trending Products (Dynamic) -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-2xl md:text-5xl font-serif text-slate-900 mb-2">Trending Now</h2>
                <div class="h-1.5 w-20 bg-brand-500 rounded-full"></div>
            </div>
            <a href="<?php echo URLROOT; ?>/products"
                class="text-brand-600 font-bold hover:text-brand-800 transition flex items-center gap-1 group">
                View All Collection <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <!-- Horizontal Scrollable Container -->
        <div class="overflow-x-auto no-scrollbar -mx-4 px-4">
            <div class="flex gap-6 pb-4">
                <?php foreach ($data['featured_products'] as $product): ?>
                    <div
                        class="flex-shrink-0 w-72 group relative bg-white rounded-3xl p-4 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 border border-slate-100/50">
                        <div class="relative overflow-hidden rounded-2xl aspect-[9/11] mb-6">
                            <img src="<?php echo getProductImage($product->image); ?>"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                alt="<?php echo $product->name; ?>">
                            <!-- Quick Add -->
                            <div
                                class="absolute bottom-4 left-4 right-4 translate-y-20 group-hover:translate-y-0 transition-transform duration-500 flex gap-2">
                                <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>"
                                    class="flex-1 bg-white/90 backdrop-blur-md text-slate-900 py-3 rounded-xl font-bold text-sm text-center shadow-lg hover:bg-brand-600 hover:text-white transition-all">Details</a>
                                <button onclick="addToCart(<?php echo $product->id; ?>)"
                                    class="w-12 h-12 bg-white/90 backdrop-blur-md rounded-xl flex items-center justify-center text-brand-600 shadow-lg hover:bg-brand-600 hover:text-white transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <span
                                class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-1 block"><?php echo $product->category_name; ?></span>
                            <h3 class="text-lg font-bold text-slate-800 mb-2 truncate"><?php echo $product->name; ?></h3>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xl font-bold text-brand-600">₹<?php echo number_format($product->price, 2); ?></span>
                                <div class="flex items-center text-yellow-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <span class="text-slate-400 text-xs ml-1">(4.8)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Call to action (Aesthetic) -->
<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-brand-900">
        <img src="https://images.unsplash.com/photo-1549490349-8643362247b5?q=80&w=2000&auto=format&fit=crop"
            class="w-full h-full object-cover opacity-20" alt="CTA BG">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-2xl md:text-6xl font-serif mb-8 max-w-3xl mx-auto">Spread Love with Our Monthly Flower
            Subscription</h2>
        <p class="text-brand-100/80 mb-12 max-w-xl mx-auto italic">Receive fresh bouquets every week or month, curated
            by our master florists and delivered straight to your door.</p>
        <a href="#"
            class="inline-block bg-white text-brand-900 px-12 py-5 rounded-full font-bold shadow-2xl hover:bg-brand-50 transition transform hover:scale-105">View
            Plans</a>
    </div>
</section>

<!-- Swiper Initialization & Actions -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            effect: 'fade',
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            preloadImages: false,
            lazy: true,
            watchSlidesProgress: true,
            touchEventsTarget: 'container',
        });
    });

    function addToCart(id) {
        event.preventDefault();
        event.stopPropagation();

        fetch('<?php echo URLROOT; ?>/cart/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, qty: 1 })
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const countBadge = document.getElementById('cart-count');
                    const countBadgeMobile = document.getElementById('cart-count-mobile');
                    if (countBadge) {
                        countBadge.innerText = data.count;
                        countBadge.classList.remove('hidden');
                    }
                    if (countBadgeMobile) {
                        countBadgeMobile.innerText = data.count;
                        countBadgeMobile.classList.remove('hidden');
                    }

                    const toast = document.createElement('div');
                    toast.className = 'fixed top-24 right-4 md:right-8 bg-brand-600 text-white px-6 py-4 rounded-2xl shadow-2xl z-[150] animate-up flex items-center gap-3';
                    toast.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span class="font-bold">Added to Cart</span>';
                    document.body.appendChild(toast);
                    setTimeout(() => {
                        toast.classList.add('opacity-0');
                        setTimeout(() => toast.remove(), 700);
                    }, 2000);
                }
            });
    }
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>