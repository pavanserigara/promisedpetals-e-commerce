<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="bg-slate-50 min-h-screen">
    <!-- Header -->
    <div class="bg-slate-900 pt-32 pb-48">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left">
            <h1 class="text-4xl md:text-6xl font-serif text-white mb-4 animate-up">Final <span
                    class="text-brand-400">Step</span></h1>
            <p class="text-white/40 font-bold uppercase tracking-widest text-xs animate-up"
                style="animation-delay: 0.1s">Secure Checkout Experience</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32 pb-24">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Form Section -->
            <div class="flex-1 lg:max-w-3xl animate-up" style="animation-delay: 0.2s">
                <form action="<?php echo URLROOT; ?>/orders/place" method="POST" class="space-y-8">
                    <?php csrf_field(); ?>

                    <!-- Delivery Info -->
                    <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-slate-200/50">
                        <div class="flex items-center gap-4 mb-10">
                            <div
                                class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 shadow-sm border border-brand-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-serif text-slate-800">Boutique Delivery</h2>
                        </div>

                        <div class="space-y-8">
                            <div>
                                <label
                                    class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-3">Street
                                    Address</label>
                                <input type="text" name="address" required placeholder="Apartment, suite, unit, etc."
                                    class="w-full bg-slate-50 border-none rounded-2xl py-5 px-6 placeholder:text-slate-300 focus:ring-2 focus:ring-brand-400 transition-all font-medium text-slate-700">
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-3">Phone
                                    Number</label>
                                <input type="tel" name="phone" required placeholder="+91 XXXXX XXXXX"
                                    class="w-full bg-slate-50 border-none rounded-2xl py-5 px-6 placeholder:text-slate-300 focus:ring-2 focus:ring-brand-400 transition-all font-medium text-slate-700">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label
                                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-3">City</label>
                                    <input type="text" name="city" required placeholder="Paris, NY, London..."
                                        class="w-full bg-slate-50 border-none rounded-2xl py-5 px-6 placeholder:text-slate-300 focus:ring-2 focus:ring-brand-400 transition-all font-medium text-slate-700">
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-3">Zip
                                        Code</label>
                                    <input type="text" name="zip" required placeholder="XXXXX"
                                        class="w-full bg-slate-50 border-none rounded-2xl py-5 px-6 placeholder:text-slate-300 focus:ring-2 focus:ring-brand-400 transition-all font-medium text-slate-700">
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-3">Preferred
                                    Delivery Date</label>
                                <input type="date" name="delivery_date" required min="<?php echo date('Y-m-d'); ?>"
                                    class="w-full bg-slate-50 border-none rounded-2xl py-5 px-6 focus:ring-2 focus:ring-brand-400 transition-all font-medium text-slate-700">
                                <p class="text-[10px] text-brand-400 font-bold mt-3">✨ We ensure freshness on your
                                    selected date.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-slate-200/50">
                        <div class="flex items-center gap-4 mb-10">
                            <div
                                class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 shadow-sm border border-blue-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-serif text-slate-800">Secure Payment</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <label
                                class="relative flex flex-col p-6 bg-brand-50 border-2 border-brand-500 rounded-3xl cursor-pointer group">
                                <input type="radio" name="payment" value="cod" checked class="hidden">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="font-bold text-brand-900">Cash on Delivery</span>
                                    <span class="w-5 h-5 rounded-full border-2 border-brand-500 bg-brand-500"></span>
                                </div>
                                <span class="text-xs text-brand-600/70 font-medium">Pay securely at your
                                    doorstep.</span>
                            </label>

                            <label
                                class="relative flex flex-col p-6 bg-slate-50 border-2 border-transparent rounded-3xl opacity-50 cursor-not-allowed">
                                <input type="radio" name="payment" value="card" disabled class="hidden">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="font-bold text-slate-400">Card Payment</span>
                                    <span class="w-5 h-5 rounded-full border-2 border-slate-200"></span>
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-300">Coming
                                    Soon</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 text-white py-6 rounded-3xl font-bold text-lg shadow-2xl hover:bg-black hover:-translate-y-1 transition-all transform active:scale-95 flex items-center justify-center gap-3">
                        Place My Order
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>

                    <div
                        class="flex items-center justify-center gap-6 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                        <span class="flex items-center gap-2 decoration-brand-400 underline decoration-2">SSL
                            SECURED</span>
                        <span class="flex items-center gap-2 decoration-brand-400 underline decoration-2">BOUTIQUE
                            PACKAGING</span>
                    </div>
                </form>
            </div>

            <!-- Summary Sidebar -->
            <div class="lg:w-96 flex-shrink-0 animate-up" style="animation-delay: 0.3s">
                <div class="glass-morphism rounded-[2.5rem] p-8 md:p-10 sticky top-24 shadow-xl border border-white">
                    <h3
                        class="font-serif text-2xl text-slate-800 mb-8 border-b border-slate-100 pb-6 uppercase tracking-tight">
                        Order <span class="text-brand-500">Manifest</span></h3>

                    <div class="space-y-6 mb-10 overflow-y-auto max-h-[40vh] no-scrollbar pr-2">
                        <?php foreach ($data['cart'] as $item): ?>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-slate-50 border border-slate-100">
                                    <img src="<?php echo getProductImage($item['image']); ?>"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-slate-800 text-sm truncate"><?php echo $item['name']; ?></h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Qty
                                        <?php echo $item['qty']; ?>
                                    </p>
                                </div>
                                <div class="font-bold text-slate-900 text-sm">
                                    ₹<?php echo number_format($item['price'] * $item['qty'], 2); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="space-y-4 pt-6 border-t border-slate-100">
                        <div class="flex justify-between text-slate-400 text-xs font-bold uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="text-slate-900">₹<?php echo number_format($data['total'], 2); ?></span>
                        </div>
                        <div class="flex justify-between text-slate-400 text-xs font-bold uppercase tracking-widest">
                            <span>Shipping</span>
                            <span class="text-green-600">Complimentary</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-900 pt-6 border-t border-slate-100">
                            <span class="font-serif text-xl">Total Paid</span>
                            <span
                                class="font-serif text-3xl font-bold text-brand-600">₹<?php echo number_format($data['total'], 2); ?></span>
                        </div>
                    </div>

                    <!-- Gift Box -->
                    <div class="mt-10 bg-brand-50 rounded-2xl p-6 border border-brand-100">
                        <div class="flex gap-4">
                            <span class="text-2xl">🎁</span>
                            <div>
                                <h4 class="font-bold text-brand-900 text-xs uppercase tracking-widest mb-1">Gifting Mode
                                </h4>
                                <p class="text-[10px] text-brand-600/80 leading-relaxed font-medium italic">
                                    Complimentary luxury wrapping and personal message card included with every order.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>