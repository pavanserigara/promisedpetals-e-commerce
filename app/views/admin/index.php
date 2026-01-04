<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-slate-50 min-h-screen pb-20">
    <!-- Admin Hero -->
    <!-- Admin Hero -->
    <div class="bg-gray-900 pt-8 pb-32 md:pb-48 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-brand-900/30 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 rounded-full bg-purple-900/20 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 animate-up">
                <div>
                    <h1 class="text-3xl md:text-5xl font-serif text-white mb-2 tracking-tight">Admin <span
                            class="text-brand-300">Dashboard</span></h1>
                    <p class="text-white/50 font-bold uppercase tracking-[0.2em] text-[10px]">Hello Admin, here is your
                        overview</p>
                </div>
                <div class="flex gap-4 w-full md:w-auto">
                    <a href="<?php echo URLROOT; ?>/admin/products/add"
                        class="flex-1 md:flex-none bg-brand-600 text-white px-6 py-3.5 rounded-xl font-bold text-sm shadow-xl shadow-brand-900/20 hover:bg-brand-500 transition-all transform active:scale-95 text-center flex items-center justify-center gap-2 border border-transparent hover:border-brand-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Product
                    </a>
                    <a href="<?php echo URLROOT; ?>/admin/orders"
                        class="flex-1 md:flex-none bg-white/5 backdrop-blur-md text-slate-200 border border-white/10 px-6 py-3.5 rounded-xl font-bold text-sm hover:bg-white/10 transition-all text-center flex items-center justify-center">Orders</a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 md:-mt-32">
        <!-- Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12 animate-up" style="animation-delay: 0.1s">
            <div
                class="bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] shadow-xl border border-white/50 group hover:bg-brand-600 transition-all duration-500">
                <div
                    class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 mb-6 group-hover:bg-white/20 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <p
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-white/60 transition-colors">
                    Total Orders</p>
                <p class="text-3xl font-serif font-bold text-slate-900 group-hover:text-white transition-colors">
                    <?php echo $data['orders_count']; ?>
                </p>
            </div>

            <div
                class="bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] shadow-xl border border-white/50 group hover:bg-green-600 transition-all duration-500">
                <div
                    class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-6 group-hover:bg-white/20 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-white/60 transition-colors">
                    Revenue</p>
                <p class="text-3xl font-serif font-bold text-slate-900 group-hover:text-white transition-colors">
                    ₹<?php echo number_format($data['total_revenue'], 2); ?></p>
            </div>

            <div
                class="bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] shadow-xl border border-white/50 group hover:bg-yellow-500 transition-all duration-500">
                <div
                    class="w-12 h-12 bg-yellow-50 rounded-2xl flex items-center justify-center text-yellow-600 mb-6 group-hover:bg-white/20 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-white/60 transition-colors">
                    Pending</p>
                <p class="text-3xl font-serif font-bold text-slate-900 group-hover:text-white transition-colors">
                    <?php echo $data['pending_orders_count']; ?>
                </p>
            </div>

            <div
                class="bg-white/80 backdrop-blur-xl p-8 rounded-[2.5rem] shadow-xl border border-white/50 group hover:bg-blue-600 transition-all duration-500">
                <div
                    class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:bg-white/20 group-hover:text-white transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <p
                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 group-hover:text-white/60 transition-colors">
                    Customers</p>
                <p class="text-3xl font-serif font-bold text-slate-900 group-hover:text-white transition-colors">
                    <?php echo $data['users_count']; ?>
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Feed -->
            <div class="lg:col-span-2 space-y-8 animate-up" style="animation-delay: 0.2s">
                <div class="bg-white rounded-[2.5rem] shadow-xl p-8 md:p-12 border border-slate-100">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-2xl font-serif text-slate-800">Recent <span
                                class="text-brand-500">Activity</span></h3>
                        <a href="<?php echo URLROOT; ?>/admin/orders"
                            class="text-xs font-bold text-slate-400 hover:text-brand-600 transition-colors uppercase tracking-widest">View
                            All Orders</a>
                    </div>

                    <div class="space-y-6">
                        <?php if ($data['pending_orders_count'] > 0): ?>
                            <div class="flex gap-6 p-6 bg-brand-50 rounded-3xl border border-brand-100 animate-pulse">
                                <div
                                    class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-brand-600 shadow-sm flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-brand-900 text-sm mb-1">Attention Required</h4>
                                    <p class="text-xs text-brand-600 font-medium">You have
                                        <?php echo $data['pending_orders_count']; ?> pending orders that need processing.
                                        Fresh blooms are waiting!
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="flex gap-6 p-6 hover:bg-slate-50 rounded-3xl transition-colors group">
                            <div
                                class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500 shadow-sm flex-shrink-0 group-hover:bg-brand-100 group-hover:text-brand-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-800 text-sm mb-1">Order Delivered</h4>
                                <p class="text-xs text-slate-400 font-medium italic">Order #1240 was successfully
                                    delivered to NYC. Customer left 5 stars.</p>
                                <span class="text-[9px] font-bold text-slate-300 uppercase tracking-widest mt-2 block">2
                                    HOURS AGO</span>
                            </div>
                        </div>

                        <div class="flex gap-6 p-6 hover:bg-slate-50 rounded-3xl transition-colors group">
                            <div
                                class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500 shadow-sm flex-shrink-0 group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-800 text-sm mb-1">New Member</h4>
                                <p class="text-xs text-slate-400 font-medium italic">Julian Smith joined the floral
                                    family.</p>
                                <span class="text-[9px] font-bold text-slate-300 uppercase tracking-widest mt-2 block">4
                                    HOURS AGO</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-8 animate-up" style="animation-delay: 0.3s">
                <div class="bg-white rounded-[2.5rem] shadow-xl p-8 border border-slate-100">
                    <h3 class="text-xl font-serif text-slate-800 mb-8 border-b border-slate-50 pb-6">Quick <span
                            class="text-brand-500">Links</span></h3>
                    <div class="space-y-4">
                        <a href="<?php echo URLROOT; ?>/admin/products"
                            class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl hover:bg-brand-50 hover:translate-x-2 transition-all group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 group-hover:text-brand-600 shadow-sm">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <span
                                    class="font-bold text-slate-700 text-sm group-hover:text-brand-900 transition-colors">Products</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-brand-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="<?php echo URLROOT; ?>/admin/categories"
                            class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl hover:bg-purple-50 hover:translate-x-2 transition-all group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 group-hover:text-purple-600 shadow-sm">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <span
                                    class="font-bold text-slate-700 text-sm group-hover:text-purple-900 transition-colors">Categories</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-purple-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="<?php echo URLROOT; ?>/admin/users"
                            class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl hover:bg-blue-50 hover:translate-x-2 transition-all group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 group-hover:text-blue-600 shadow-sm">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <span
                                    class="font-bold text-slate-700 text-sm group-hover:text-blue-900 transition-colors">Users</span>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-blue-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>