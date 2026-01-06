<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-slate-50 min-h-screen">
    <!-- Header Area -->
    <div class="bg-slate-900 pt-8 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 animate-up">
                <div>
                    <h1 class="text-3xl md:text-5xl font-serif text-white mb-2">Products</h1>
                    <p class="text-white/40 font-bold uppercase tracking-widest text-[10px]">Manage your catalog</p>
                </div>
                <a href="<?php echo URLROOT; ?>/admin/add_product"
                    class="bg-brand-600 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-2xl hover:bg-brand-500 transition-all transform active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Product
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24">
        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white overflow-hidden animate-up"
            style="animation-delay: 0.1s">
            <div
                class="p-8 md:p-12 border-b border-slate-50 flex flex-col md:flex-row justify-between gap-6 items-center">
                <form action="<?php echo URLROOT; ?>/admin/products" method="GET" class="relative w-full md:w-96">
                    <input type="text" name="q" placeholder="Search products..."
                        value="<?php echo isset($data['search']) ? $data['search'] : ''; ?>"
                        class="w-full bg-slate-50 border-none rounded-2xl py-4 pl-12 pr-4 text-sm font-medium focus:ring-2 focus:ring-brand-400">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>

                <div class="flex gap-4 items-center overflow-x-auto no-scrollbar w-full md:w-auto">
                    <span
                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">Filter
                        by Status</span>
                    <button
                        class="bg-brand-50 text-brand-600 px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest whitespace-nowrap">All</button>
                    <button
                        class="text-slate-400 hover:text-slate-600 px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest whitespace-nowrap">In
                        Stock</button>
                    <button
                        class="text-slate-400 hover:text-slate-600 px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest whitespace-nowrap">Low
                        Stock</button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                                Name</th>
                            <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                                Category</th>
                            <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Price
                            </th>
                            <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                                Stock</th>
                            <th
                                class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach ($data['products'] as $product): ?>
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 flex-shrink-0">
                                            <img src="<?php echo getProductImage($product->image); ?>"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        </div>
                                        <div>
                                            <h4
                                                class="font-bold text-slate-800 text-sm group-hover:text-brand-600 transition-colors">
                                                <?php echo $product->name; ?>
                                            </h4>
                                            <span
                                                class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1 block">SKU:
                                                <?php echo str_pad($product->id, 5, '0', STR_PAD_LEFT); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">
                                        <?php echo $product->category_name ?: 'Global'; ?>
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <span
                                        class="font-serif font-bold text-slate-900">₹<?php echo number_format($product->price, 2); ?></span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col gap-1">
                                        <div class="text-[10px] font-bold text-slate-700"><?php echo $product->stock; ?>
                                            Units</div>
                                        <div class="w-24 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full <?php echo $product->stock > 10 ? 'bg-green-400' : 'bg-red-400'; ?>"
                                                style="width: <?php echo min(100, $product->stock * 5); ?>%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div
                                        class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                        <a href="<?php echo URLROOT; ?>/admin/edit_product/<?php echo $product->id; ?>"
                                            class="w-10 h-10 bg-white shadow-sm border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-brand-600 hover:border-brand-100 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form
                                            action="<?php echo URLROOT; ?>/admin/delete_product/<?php echo $product->id; ?>"
                                            method="POST" onsubmit="return confirm('Delete this product?');">
                                            <?php csrf_field(); ?>
                                            <button type="submit"
                                                class="w-10 h-10 bg-white shadow-sm border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-red-500 hover:border-red-100 transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (empty($data['products'])): ?>
                <div class="p-20 text-center">
                    <span class="text-4xl mb-4 block">🥀</span>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">No entries found in archive</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>