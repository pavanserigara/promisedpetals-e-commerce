<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-gray-900 tracking-tight">Sales Reports & Analytics</h1>
                <p class="text-gray-500 mt-1">Monitor your shop's performance and growth.</p>
            </div>
            <div class="mt-4 md:mt-0 flex gap-3">
                <a href="<?php echo URLROOT; ?>/admin/export_orders"
                    class="bg-green-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-green-700 transition flex items-center gap-2 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <?php
            $totalRev = 0;
            $totalOrders = 0;
            foreach ($data['sales_data'] as $day) {
                $totalRev += $day['revenue'];
                $totalOrders += $day['orders'];
            }
            ?>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-up">
                <p class="text-sm font-medium text-gray-500 mb-1">Total Revenue</p>
                <h3 class="text-2xl font-bold text-brand-900">₹<?php echo number_format($totalRev, 2); ?></h3>
                <div class="mt-2 text-xs text-green-600 font-medium">Lifetime sales</div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-up"
                style="animation-delay: 0.1s;">
                <p class="text-sm font-medium text-gray-500 mb-1">Total Orders</p>
                <h3 class="text-2xl font-bold text-brand-900"><?php echo $totalOrders; ?></h3>
                <div class="mt-2 text-xs text-brand-600 font-medium tracking-wide">Customer trust</div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-up"
                style="animation-delay: 0.2s;">
                <p class="text-sm font-medium text-gray-500 mb-1">Average Order Value</p>
                <h3 class="text-2xl font-bold text-gray-900">
                    ₹<?php echo $totalOrders > 0 ? number_format($totalRev / $totalOrders, 2) : '0'; ?></h3>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-up"
                style="animation-delay: 0.3s;">
                <p class="text-sm font-medium text-gray-500 mb-1">Days Active</p>
                <h3 class="text-2xl font-bold text-gray-900"><?php echo count($data['sales_data']); ?></h3>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-up"
            style="animation-delay: 0.4s;">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-gray-900">Daily Sales Breakdown</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                Date</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                Orders</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">
                                Revenue</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">
                                Trend</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach (array_reverse($data['sales_data']) as $date => $day): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?php echo date('M d, Y', strtotime($date)); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <?php echo $day['orders']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold text-brand-900">
                                    ₹<?php echo number_format($day['revenue'], 2); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="inline-flex items-center text-green-600 text-xs font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Stable
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($data['sales_data'])): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">No sales data recorded
                                    yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>