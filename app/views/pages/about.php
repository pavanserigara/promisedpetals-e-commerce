<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="bg-white">
    <!-- Hero Section -->
    <section class="relative py-20 bg-brand-50 overflow-hidden">
        <div class="absolute inset-0 opacity-20 transform -skew-y-6 bg-brand-100 origin-top-left"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-serif text-slate-900 mb-6">Our Story</h1>
                <p class="text-lg text-slate-600 leading-relaxed overflow-hidden animate-up">
                    Founded in 2023, Promised Petals began with a simple belief: that flowers are not just decorations,
                    but a language of emotion. What started as a small garden passion has blossomed into a curated
                    boutique dedicated to bringing nature's finest elegance into your home.
                </p>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/5] animate-up">
                    <img src="<?php echo URLROOT; ?>/img/about-hero.png" alt="Florist arranging flowers"
                        class="w-full h-full object-cover">
                </div>
                <div class="space-y-8 animate-up" style="animation-delay: 0.2s">
                    <div>
                        <h2 class="text-3xl font-serif text-slate-900 mb-4">Crafted with Passion</h2>
                        <div class="h-1 w-20 bg-brand-500 rounded-full mb-6"></div>
                        <p class="text-slate-600 leading-relaxed">
                            Every bouquet we create is a work of art, hand-selected for freshness and arranged with an
                            eye for color, texture, and harmony. We work directly with sustainable farms to ensure that
                            every petal meets our high standards of quality and ethics.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <span class="text-3xl font-bold text-brand-600 block mb-1">100%</span>
                            <span class="text-sm text-slate-500 font-bold uppercase tracking-wider">Fresh
                                Guarantee</span>
                        </div>
                        <div>
                            <span class="text-3xl font-bold text-brand-600 block mb-1">24/7</span>
                            <span class="text-sm text-slate-500 font-bold uppercase tracking-wider">Support</span>
                        </div>
                    </div>

                    <a href="<?php echo URLROOT; ?>/products"
                        class="inline-block bg-slate-900 text-white px-8 py-4 rounded-full font-bold hover:bg-brand-600 transition-all shadow-lg hover:shadow-brand-200">
                        Explore Our Collection
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>