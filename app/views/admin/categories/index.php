<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-slate-50 min-h-screen">
    <!-- Header Area -->
    <div class="bg-slate-900 pt-8 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 animate-up">
                <div>
                    <h1 class="text-3xl md:text-5xl font-serif text-white mb-2">Category <span
                            class="text-brand-400">Architecture</span></h1>
                    <p class="text-white/40 font-bold uppercase tracking-widest text-[10px]">Organize your floral
                        ecosystem</p>
                </div>
                <a href="<?php echo URLROOT; ?>/admin/categories/add"
                    class="bg-brand-600 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-2xl hover:bg-brand-500 transition-all transform active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Category
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24">
        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white overflow-hidden animate-up"
            style="animation-delay: 0.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Visual
                                Identity</th>
                            <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                                Display Name</th>
                            <th class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">System
                                Slug</th>
                            <th
                                class="px-8 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400 text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach ($data['categories'] as $category): ?>
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6">
                                    <div
                                        class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 flex-shrink-0">
                                        <img src="<?php echo URLROOT; ?>/img/categories/<?php echo $category->image ?: 'default.jpg'; ?>"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                            onerror="this.src='https://images.unsplash.com/photo-1490750967868-886a502c4482?q=80&w=150&h=150&auto=format&fit=crop'">
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <h4
                                        class="font-bold text-slate-800 text-sm group-hover:text-brand-600 transition-colors">
                                        <?php echo $category->name; ?></h4>
                                </td>
                                <td class="px-8 py-6">
                                    <code
                                        class="bg-slate-100 text-slate-500 px-3 py-1 rounded-lg text-[10px] font-bold border border-slate-200">/<?php echo $category->slug; ?></code>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div
                                        class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                        <a href="<?php echo URLROOT; ?>/admin/categories/edit/<?php echo $category->id; ?>"
                                            class="w-10 h-10 bg-white shadow-sm border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-brand-600 hover:border-brand-100 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form
                                            action="<?php echo URLROOT; ?>/admin/categories/delete/<?php echo $category->id; ?>"
                                            method="POST"
                                            onsubmit="return confirm('Archive this category? This may affect products.');">
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

            <?php if (empty($data['categories'])): ?>
                <div class="p-20 text-center">
                    <span class="text-4xl mb-4 block">📁</span>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Architectural archive is empty</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>