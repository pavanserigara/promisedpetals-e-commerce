<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="bg-slate-50 min-h-screen py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12 animate-up">
            <h1 class="text-3xl md:text-5xl font-serif text-slate-800">Your Boutique <span
                    class="text-brand-500 italic">Cart</span></h1>
            <a href="<?php echo URLROOT; ?>/products"
                class="text-sm font-bold text-slate-400 hover:text-brand-600 transition-colors uppercase tracking-widest">Back
                to Gallery</a>
        </div>

        <?php if (empty($data['cart_items'])): ?>
            <div class="bg-white rounded-[3rem] p-16 md:p-24 text-center shadow-xl animate-up">
                <div class="w-24 h-24 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-8">
                    <span class="text-4xl">🪴</span>
                </div>
                <h2 class="text-2xl font-serif text-slate-800 mb-4">Your garden is empty</h2>
                <p class="text-slate-500 mb-10 max-w-xs mx-auto">Explore our curated collections and find the perfect
                    flowers for your space.</p>
                <a href="<?php echo URLROOT; ?>/products"
                    class="inline-block bg-brand-600 text-white px-12 py-4 rounded-full font-bold shadow-2xl hover:bg-brand-700 transition transform hover:scale-105">Start
                    Shopping</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Items List -->
                <div class="lg:col-span-2 space-y-6">
                    <?php foreach ($data['cart_items'] as $id => $item): ?>
                        <div class="bg-white rounded-[2rem] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-6 animate-up group"
                            id="cart-item-<?php echo $id; ?>">
                            <div
                                class="w-24 h-24 md:w-32 md:h-32 rounded-2xl overflow-hidden flex-shrink-0 bg-slate-100 border border-slate-100">
                                <img src="<?php echo URLROOT; ?>/img/products/<?php echo $item['image'] ?: 'default.jpg'; ?>"
                                    alt="<?php echo $item['name'] ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    onerror="this.src='https://images.unsplash.com/photo-1519340241574-2dec49daa043?q=80&w=200&h=200&auto=format&fit=crop'">
                            </div>

                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-slate-800 text-lg md:text-xl"><?php echo $item['name']; ?></h3>
                                    <button onclick="removeCartItem(<?php echo $id; ?>)"
                                        class="text-slate-300 hover:text-red-500 transition-colors p-2">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs font-bold text-brand-500 uppercase tracking-widest mb-4">Floral Collection</p>

                                <div class="flex items-center justify-between mt-auto">
                                    <div class="flex items-center bg-slate-100 rounded-xl p-1">
                                        <button onclick="updateCartItem(<?php echo $id; ?>, <?php echo $item['qty'] - 1; ?>)"
                                            class="w-8 h-8 flex items-center justify-center text-slate-500 hover:text-brand-600">-</button>
                                        <input type="text" value="<?php echo $item['qty']; ?>"
                                            class="w-8 text-center bg-transparent border-none text-sm font-bold text-slate-800 p-0 focus:ring-0"
                                            readonly>
                                        <button onclick="updateCartItem(<?php echo $id; ?>, <?php echo $item['qty'] + 1; ?>)"
                                            class="w-8 h-8 flex items-center justify-center text-slate-500 hover:text-brand-600">+</button>
                                    </div>
                                    <div class="font-bold text-slate-900 text-lg">
                                        ₹<?php echo number_format($item['price'] * $item['qty'], 2); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Summary Section -->
                <div class="lg:col-span-1">
                    <div class="bg-slate-900 text-white rounded-[2.5rem] p-8 shadow-2xl sticky top-24 animate-up"
                        style="animation-delay: 0.2s">
                        <h3 class="font-serif text-2xl mb-8">Summary</h3>

                        <div class="space-y-4 mb-8 border-b border-white/10 pb-8 text-sm">
                            <div class="flex justify-between text-white/60">
                                <span>Subtotal</span>
                                <span class="text-white font-bold">₹<?php echo number_format($data['total'], 2); ?></span>
                            </div>
                            <div class="flex justify-between text-white/60">
                                <span>Delivery</span>
                                <span class="text-brand-400 font-bold italic">Free Boutique Shipping</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-end mb-10">
                            <span class="text-white/60 text-sm">Total Value</span>
                            <span
                                class="text-3xl font-serif font-bold text-brand-400">₹<?php echo number_format($data['total'], 2); ?></span>
                        </div>

                        <a href="<?php echo URLROOT; ?>/orders/checkout"
                            class="block w-full bg-brand-600 text-white text-center py-5 rounded-2xl font-bold shadow-xl hover:bg-brand-500 transition-all transform hover:-translate-y-1 active:scale-95">Proceed
                            to Checkout</a>

                        <p class="text-[10px] text-white/30 text-center mt-6 font-bold uppercase tracking-widest">Secure
                            Checkout Powered by SSL</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function updateCartItem(id, qty) {
        if (qty < 1) return;
        fetch('<?php echo URLROOT; ?>/cart/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, qty: qty })
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                }
            });
    }

    function removeCartItem(id) {
        fetch('<?php echo URLROOT; ?>/cart/remove', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                }
            });
    }
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>