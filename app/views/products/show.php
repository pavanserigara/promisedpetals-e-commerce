<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="bg-white min-h-screen">
    <!-- Breadcrumbs -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <nav class="flex text-xs font-bold uppercase tracking-widest text-slate-400" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?php echo URLROOT; ?>" class="hover:text-brand-600 transition-colors">Home</a></li>
                <li class="flex items-center space-x-2">
                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <a href="<?php echo URLROOT; ?>/products" class="hover:text-brand-600 transition-colors">Shop</a>
                </li>
                <li class="flex items-center space-x-2">
                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-brand-600"><?php echo $data['product']->category_name; ?></span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 lg:grid lg:grid-cols-2 lg:gap-x-16">
        <!-- Image Section -->
        <div class="mb-12 lg:mb-0 animate-up">
            <div class="relative group rounded-[2.5rem] overflow-hidden shadow-2xl bg-slate-50 border border-slate-100">
                <img src="<?php echo getProductImage($data['product']->image); ?>"
                    alt="<?php echo $data['product']->name; ?>"
                    class="w-full aspect-[4/5] object-cover transition-transform duration-[2s] group-hover:scale-110">

                <div class="absolute top-8 right-8">
                    <button
                        class="bg-white/80 backdrop-blur-md p-4 rounded-full shadow-lg text-brand-500 hover:bg-brand-500 hover:text-white transition-all transform active:scale-90">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Thumbnails (Small Preview) -->
            <div class="mt-8 grid grid-cols-4 gap-4">
                <div class="aspect-square rounded-2xl overflow-hidden border-2 border-brand-500">
                    <img src="<?php echo getProductImage($data['product']->image); ?>"
                        class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="flex flex-col animate-up" style="animation-delay: 0.1s">
            <div class="mb-10">
                <span
                    class="inline-block bg-brand-50 text-brand-600 px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest mb-6 border border-brand-100"><?php echo $data['product']->category_name; ?></span>
                <h1 class="text-4xl md:text-6xl font-serif text-slate-900 leading-tight mb-4">
                    <?php echo $data['product']->name; ?>
                </h1>

                <div class="flex items-center gap-4 mb-8">
                    <div class="flex text-yellow-400">
                        <?php for ($i = 0; $i < 5; $i++): ?><svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                            </svg><?php endfor; ?>
                    </div>
                    <span class="text-slate-400 text-sm font-bold">(120+ Reviews)</span>
                </div>

                <div class="text-4xl font-serif font-bold text-slate-900 mb-8">
                    ₹<?php echo number_format($data['product']->price, 2); ?></div>

                <p class="text-slate-600 text-lg leading-relaxed mb-10 italic border-l-4 border-brand-200 pl-6">
                    <?php echo $data['product']->description ?: 'Experience the elegance of our handpicked floral arrangements. Perfectly crafted for your special moments.'; ?>
                </p>
            </div>

            <!-- Features -->
            <div class="grid grid-cols-2 gap-6 mb-12">
                <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                    <div
                        class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-brand-600 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700">Fresh Today</span>
                </div>
                <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-blue-600 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700">Fast Delivery</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="space-y-6 mt-auto">
                <div class="flex items-center justify-between p-2 bg-slate-100 rounded-3xl w-full sm:w-48">
                    <button onclick="updateQty(-1)"
                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-500 hover:text-brand-600 shadow-sm transition-all">-</button>
                    <input type="number" id="qty" value="1" min="1"
                        class="w-12 text-center bg-transparent border-none font-bold text-slate-900 focus:ring-0">
                    <button onclick="updateQty(1)"
                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-slate-500 hover:text-brand-600 shadow-sm transition-all">+</button>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button onclick="addToCartDetail(<?php echo $data['product']->id; ?>)"
                        class="flex-1 bg-brand-600 text-white py-5 rounded-[2rem] font-bold text-lg shadow-2xl shadow-brand-200 hover:bg-brand-700 hover:-translate-y-1 transition-all active:scale-95">Add
                        to Collection</button>
                    <button onclick="buyNow(<?php echo $data['product']->id; ?>)"
                        class="flex-1 bg-slate-900 text-white py-5 rounded-[2rem] font-bold text-lg hover:bg-black hover:-translate-y-1 transition-all active:scale-95">Checkout
                        Now</button>
                </div>
            </div>

            <!-- Extra Details -->
            <div class="mt-16 border-t border-slate-100 pt-10">
                <div class="space-y-6">
                    <details class="group">
                        <summary class="flex justify-between items-center cursor-pointer list-none">
                            <span class="font-bold text-slate-900">Care Instructions</span>
                            <span class="text-xl group-open:rotate-45 transition-transform">+</span>
                        </summary>
                        <div class="pt-4 text-slate-500 text-sm leading-relaxed">
                            Keep in a cool place, away from direct sunlight. Change water every 2 days and trim stems at
                            a 45-degree angle.
                        </div>
                    </details>
                    <details class="group border-t border-slate-100 pt-6">
                        <summary class="flex justify-between items-center cursor-pointer list-none">
                            <span class="font-bold text-slate-900">Returns & Gifting</span>
                            <span class="text-xl group-open:rotate-45 transition-transform">+</span>
                        </summary>
                        <div class="pt-4 text-slate-500 text-sm leading-relaxed">
                            Includes a free personalized note cards. 100% Satisfaction guarantee or money back.
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateQty(change) {
        const qtyParams = document.getElementById('qty');
        let val = parseInt(qtyParams.value) + change;
        if (val < 1) val = 1;
        qtyParams.value = val;
    }

    function addToCartDetail(id) {
        const qty = document.getElementById('qty').value;
        fetch('<?php echo URLROOT; ?>/cart/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, qty: parseInt(qty) })
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

                    // Show floating message
                    const msg = document.createElement('div');
                    msg.className = 'fixed bottom-12 left-1/2 -translate-x-1/2 bg-black text-white px-10 py-5 rounded-full shadow-2xl z-[100] animate-up flex items-center gap-4';
                    msg.innerHTML = '<span class="text-2xl animate-pulse">✨</span> <span class="font-bold">Arrangement added to cart</span>';
                    document.body.appendChild(msg);
                    setTimeout(() => {
                        msg.classList.add('opacity-0', 'translate-y-12');
                        setTimeout(() => msg.remove(), 700);
                    }, 3000);
                }
            });
    }

    function buyNow(id) {
        const qty = document.getElementById('qty').value;
        fetch('<?php echo URLROOT; ?>/cart/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, qty: parseInt(qty) })
        })
            .then(() => {
                window.location.href = '<?php echo URLROOT; ?>/cart';
            });
    }
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>