<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-serif font-bold text-gray-900">Orders</h1>
            <form action="<?php echo URLROOT; ?>/admin/orders" method="GET" class="relative">
                <input type="text" name="q" placeholder="Search orders..."
                    value="<?php echo isset($data['search']) ? $data['search'] : ''; ?>"
                    class="bg-white border border-gray-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-brand-500">
                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>
        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Order ID</th>
                                    <th scope="col"
                                        class="hidden md:table-cell px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        User ID</th>
                                    <th scope="col"
                                        class="hidden sm:table-cell px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Address</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Total</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Status</th>
                                    <th scope="col"
                                        class="hidden lg:table-cell px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Date</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <?php foreach ($data['orders'] as $order): ?>
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-brand-600 font-mono">
                                                #<?php echo str_pad($order->id, 8, '0', STR_PAD_LEFT); ?></div>
                                        </td>
                                        <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500"><?php echo $order->user_id; ?></div>
                                        </td>
                                        <td class="hidden sm:table-cell px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate">
                                                <?php echo explode(',', $order->shipping_address)[0]; ?>...
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">
                                                ₹<?php echo number_format($order->total_amount, 2); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php
                                            $statusClasses = [
                                                'pending' => 'bg-amber-50 text-amber-700 border border-amber-200',
                                                'processing' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                                'shipped' => 'bg-violet-50 text-violet-700 border border-violet-200',
                                                'delivered' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                                                'cancelled' => 'bg-rose-50 text-rose-700 border border-rose-200',
                                            ];
                                            $class = isset($statusClasses[$order->status]) ? $statusClasses[$order->status] : 'bg-gray-100 text-gray-800';
                                            ?>
                                            <span
                                                class="px-2.5 py-0.5 inline-flex text-[11px] leading-5 font-bold rounded-full <?php echo $class; ?> capitalize">
                                                <?php echo $order->status; ?>
                                            </span>
                                        </td>
                                        <td class="hidden lg:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo date('M d, Y', strtotime($order->created_at)); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="<?php echo URLROOT; ?>/admin/order_details/<?php echo $order->id; ?>"
                                                class="text-brand-600 hover:text-brand-900 bg-brand-50 hover:bg-brand-100 px-3 py-1.5 rounded-lg transition-all font-semibold">Details</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>