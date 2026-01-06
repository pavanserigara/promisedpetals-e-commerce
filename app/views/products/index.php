<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumbs & Title -->
        <nav class="flex mb-8 animate-up" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-xs font-bold uppercase tracking-widest text-slate-400">
                <li><a href="<?php echo URLROOT; ?>" class="hover:text-brand-600">Home</a></li>
                <li class="flex items-center space-x-2">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <a href="<?php echo URLROOT; ?>/products" class="hover:text-brand-600">Shop</a>
                </li>
                <?php if (isset($data['current_category'])): ?>
                    <li class="flex items-center space-x-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-brand-600"><?php echo $data['current_category']->name; ?></span>
                    </li>
                <?php endif; ?>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar (Sticky on Desktop) -->
            <aside class="w-full lg:w-64 flex-shrink-0 animate-up">
                <div class="sticky top-24 space-y-8">
                    <!-- search -->
                    <div class="lg:hidden mb-8">
                        <form action="<?php echo URLROOT; ?>/products" method="GET" class="relative">
                            <input type="text" name="q" placeholder="Search products..."
                                class="w-full bg-white border-none rounded-2xl py-4 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-brand-400">
                            <svg class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div>
                        <h3
                            class="text-xs font-bold uppercase tracking-widest text-slate-900 mb-6 pb-2 border-b-2 border-brand-100">
                            Categories</h3>
                        <ul class="space-y-4">
                            <li><a href="<?php echo URLROOT; ?>/products"
                                    class="flex items-center justify-between text-sm font-medium hover:text-brand-600 transition <?php echo !isset($category_slug) ? 'text-brand-600 font-bold' : 'text-slate-500'; ?>">
                                    <span>All Products</span>
                                    <span class="text-[10px] bg-slate-100 px-2 py-0.5 rounded-full">Explore</span>
                                </a></li>
                            <?php foreach ($data['all_categories'] as $cat): ?>
                                <li><a href="<?php echo URLROOT; ?>/products?cat=<?php echo $cat->slug; ?>"
                                        class="flex items-center justify-between text-sm font-medium hover:text-brand-600 transition <?php echo (isset($category_slug) && $category_slug == $cat->slug) ? 'text-brand-600 font-bold' : 'text-slate-500'; ?>">
                                        <span><?php echo $cat->name; ?></span>
                                        <svg class="h-4 w-4 opacity-0 group-hover:opacity-100 transition-opacity"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Filter Form -->
                    <form action="<?php echo URLROOT; ?>/products" method="GET" id="filter-form" class="space-y-8">
                        <div>
                            <h3
                                class="text-xs font-bold uppercase tracking-widest text-slate-900 mb-6 pb-2 border-b-2 border-brand-100">
                                Price Range</h3>
                            <div class="space-y-3">
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" name="price[]" value="0-50"
                                        class="w-4 h-4 rounded text-brand-600 focus:ring-brand-500 border-slate-300 transition-all">
                                    <span
                                        class="ml-3 text-sm text-slate-500 group-hover:text-slate-900 transition-colors italic">Under
                                        ₹50</span>
                                </label>
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" name="price[]" value="50-100"
                                        class="w-4 h-4 rounded text-brand-600 focus:ring-brand-500 border-slate-300 transition-all">
                                    <span
                                        class="ml-3 text-sm text-slate-500 group-hover:text-slate-900 transition-colors italic">₹50
                                        - ₹100</span>
                                </label>
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" name="price[]" value="100+"
                                        class="w-4 h-4 rounded text-brand-600 focus:ring-brand-500 border-slate-300 transition-all">
                                    <span
                                        class="ml-3 text-sm text-slate-500 group-hover:text-slate-900 transition-colors italic">₹100+</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-sm hover:bg-brand-600 transition-all shadow-xl hover:shadow-brand-100">
                            Refine Results
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Product Display Area -->
            <div class="flex-1">
                <div class="flex items-center justify-between mb-12 animate-up">
                    <h1 class="text-3xl md:text-5xl font-serif text-slate-900">
                        <?php echo $data['title']; ?>
                        <span
                            class="block text-xs font-bold uppercase tracking-widest text-brand-400 mt-2"><?php echo count($data['products']); ?>
                            Arrangements Found</span>
                    </h1>

                    <div class="hidden md:block">
                        <select name="sort" onchange="document.getElementById('filter-form').submit()"
                            form="filter-form"
                            class="bg-white border-none rounded-xl py-3 pl-4 pr-10 text-sm font-bold shadow-sm focus:ring-2 focus:ring-brand-400">
                            <option value="">Sort: Featured</option>
                            <option value="price_low">Price: Low to High</option>
                            <option value="price_high">Price: High to Low</option>
                            <option value="newest">Newest First</option>
                        </select>
                    </div>
                </div>

                <?php if (empty($data['products'])): ?>
                    <div class="bg-white rounded-[3rem] p-20 text-center shadow-sm animate-up">
                        <span class="text-6xl mb-6 block">🪴</span>
                        <h2 class="text-2xl font-serif text-slate-800 mb-4">No results found</h2>
                        <p class="text-slate-500 mb-8 max-w-sm mx-auto">Try adjusting your filters or browse our other
                            beautiful collections.</p>
                        <a href="<?php echo URLROOT; ?>/products"
                            class="inline-block bg-brand-600 text-white px-8 py-3 rounded-full font-bold">Clear All
                            Filters</a>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        <?php foreach ($data['products'] as $product): ?>
                            <div
                                class="group relative bg-white rounded-3xl p-4 transition-all duration-700 hover:shadow-2xl hover:-translate-y-3 border border-slate-100 animate-up">
                                <div
                                    class="relative overflow-hidden rounded-[1.5rem] aspect-[9/11] mb-6 border border-slate-100 bg-slate-50">
                                    <img src="<?php echo getProductImage($product->image); ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]"
                                        alt="<?php echo $product->name; ?>" loading="lazy">

                                    <!-- Action Buttons -->
                                    <div class="absolute bottom-4 left-4 right-4 flex gap-2">
                                        <a href="<?php echo URLROOT; ?>/products/show/<?php echo $product->id; ?>"
                                            class="flex-1 bg-white/90 backdrop-blur-md text-slate-900 py-3 rounded-xl font-bold text-sm text-center shadow-lg hover:bg-brand-600 hover:text-white transition-all whitespace-nowrap">Details</a>
                                        <button onclick="addToCart(<?php echo $product->id; ?>)"
                                            class="w-12 h-12 bg-white/90 backdrop-blur-md rounded-xl flex items-center justify-center text-brand-600 shadow-lg hover:bg-brand-600 hover:text-white transition-all transform active:scale-95 flex-shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Tag -->
                                    <?php if ($product->price > 100): ?>
                                        <span
                                            class="absolute top-4 left-4 bg-black/80 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest">Premium</span>
                                    <?php endif; ?>
                                </div>

                                <div class="px-3 pb-2">
                                    <span
                                        class="text-[10px] uppercase tracking-widest text-brand-500 font-bold mb-1 block"><?php echo $product->category_name; ?></span>
                                    <h3
                                        class="text-xl font-bold text-slate-800 mb-3 truncate group-hover:text-brand-600 transition-colors">
                                        <?php echo $product->name; ?>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-2xl font-serif font-bold text-slate-900">₹<?php echo number_format($product->price, 2); ?></span>
                                        <div class="flex items-center gap-1">
                                            <div class="flex text-yellow-400">
                                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                                </svg>
                                            </div>
                                            <span class="text-slate-400 text-[10px] font-bold">(24)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
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
                    // Update badges
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

                    // Show floating message
                    const msg = document.createElement('div');
                    msg.className = 'fixed top-24 right-4 md:right-8 bg-brand-600 text-white px-6 py-4 rounded-2xl shadow-2xl z-[150] animate-up flex items-center gap-3';
                    msg.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span class="font-bold">Added to Cart</span>';
                    document.body.appendChild(msg);
                    setTimeout(() => {
                        msg.classList.add('opacity-0', 'translate-y-full');
                        setTimeout(() => msg.remove(), 500);
                    }, 3000);
                }
            });
    }
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>