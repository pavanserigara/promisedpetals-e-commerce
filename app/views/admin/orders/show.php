<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Back Link -->
        <a href="<?php echo URLROOT; ?>/admin/orders"
            class="text-brand-600 hover:text-brand-800 flex items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            Back to Orders
        </a>

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-gray-900">
                    Order #<?php echo str_pad($data['order']->id, 8, '0', STR_PAD_LEFT); ?>
                </h1>
                <p class="text-sm text-gray-500 mt-1 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Placed on <?php echo date('F j, Y, g:i a', strtotime($data['order']->created_at)); ?>
                </p>
            </div>

            <!-- Status Updater -->
            <div class="mt-4 md:mt-0 bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center gap-4">
                <span class="text-sm font-medium text-gray-700">Current Status:</span>
                <?php
                $statusClasses = [
                    'pending' => 'bg-amber-50 text-amber-700 border border-amber-200',
                    'processing' => 'bg-blue-50 text-blue-700 border border-blue-200',
                    'shipped' => 'bg-violet-50 text-violet-700 border border-violet-200',
                    'delivered' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                    'cancelled' => 'bg-rose-50 text-rose-700 border border-rose-200',
                ];
                $class = isset($statusClasses[$data['order']->status]) ? $statusClasses[$data['order']->status] : 'bg-gray-100 text-gray-800';
                ?>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide <?php echo $class; ?>">
                    <?php echo $data['order']->status; ?>
                </span>

                <form action="<?php echo URLROOT; ?>/admin/update_order_status/<?php echo $data['order']->id; ?>"
                    method="POST" class="flex items-center gap-2 ml-4 border-l pl-4 border-gray-200">
                    <?php csrf_field(); ?>
                    <select name="status"
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm rounded-md">
                        <option value="pending" <?php echo $data['order']->status == 'pending' ? 'selected' : ''; ?>>
                            Pending</option>
                        <option value="processing" <?php echo $data['order']->status == 'processing' ? 'selected' : ''; ?>>Processing</option>
                        <option value="shipped" <?php echo $data['order']->status == 'shipped' ? 'selected' : ''; ?>>
                            Shipped</option>
                        <option value="delivered" <?php echo $data['order']->status == 'delivered' ? 'selected' : ''; ?>>
                            Delivered</option>
                        <option value="cancelled" <?php echo $data['order']->status == 'cancelled' ? 'selected' : ''; ?>>
                            Cancelled</option>
                    </select>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-lg text-white bg-brand-600 hover:bg-brand-700 focus:outline-none transition active:scale-95">
                        Update
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Order Items -->
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Items Ordered</h3>
                    </div>
                    <ul role="list" class="divide-y divide-gray-200">
                        <?php foreach ($data['order']->items as $item): ?>
                            <li class="p-4 flex items-center">
                                <div class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md overflow-hidden">
                                    <?php
                                    $image_path = APPROOT . '/../public/img/products/' . ($item['product_image'] ?? '');
                                    $image_url = URLROOT . '/img/products/' . ($item['product_image'] ?? '');
                                    if (empty($item['product_image']) || !file_exists($image_path)) {
                                        $image_url = URLROOT . '/img/placeholder.jpg';
                                    }
                                    ?>
                                    <img src="<?php echo $image_url; ?>" alt="" class="h-full w-full object-cover">
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between">
                                        <h4 class="text-base font-medium text-gray-900"><?php echo $item['product_name']; ?>
                                        </h4>
                                        <p class="text-sm font-medium text-gray-900">
                                            ₹<?php echo number_format($item['price'], 2); ?></p>
                                    </div>
                                    <p class="text-sm text-gray-500">Qty: <?php echo $item['quantity']; ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div
                        class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center border-t border-gray-200">
                        <span class="text-base font-medium text-gray-900">Total Amount</span>
                        <span
                            class="text-xl font-bold text-brand-600">₹<?php echo number_format($data['order']->total_amount, 2); ?></span>
                    </div>
                </div>
            </div>

            <!-- Customer & Shipping Info -->
            <div class="space-y-6">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Customer Details</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo $data['order']->user_name; ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo $data['order']->user_email; ?></dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Shipping Address</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <address class="text-sm text-gray-900 not-italic leading-relaxed">
                            <?php echo nl2br(htmlspecialchars($data['order']->shipping_address)); ?>
                        </address>
                    </div>
                </div>

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Status</h3>
                        <?php
                        $pStatus = isset($data['order']->payment_status) ? $data['order']->payment_status : 'unpaid';
                        $pClass = ($pStatus == 'paid') ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-amber-100 text-amber-800 border border-amber-200';
                        ?>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase <?php echo $pClass; ?>">
                            <?php echo $pStatus; ?>
                        </span>
                    </div>
                    <div class="px-4 py-5 sm:p-6 italic text-sm text-gray-500">
                        Method: <?php echo ucfirst($data['order']->payment_method); ?>
                        <form action="<?php echo URLROOT; ?>/admin/update_payment/<?php echo $data['order']->id; ?>"
                            method="POST" class="mt-4">
                            <?php csrf_field(); ?>
                            <input type="hidden" name="payment_status"
                                value="<?php echo ($pStatus == 'paid') ? 'unpaid' : 'paid'; ?>">
                            <button type="submit"
                                class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200 font-bold py-2 rounded-lg transition text-xs flex items-center justify-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Mark as <?php echo ($pStatus == 'paid') ? 'Unpaid' : 'Paid'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>