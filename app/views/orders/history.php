<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="bg-white min-h-screen">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-serif font-bold tracking-tight text-brand-900 mb-8 animate-up">Your Orders</h1>

        <?php flash('order_success'); ?>

        <?php if (empty($data['orders'])): ?>
            <div class="text-center py-20 bg-brand-50 rounded-lg animate-up">
                <p class="text-brand-800 text-xl font-serif mb-4">You haven't placed any orders yet.</p>
                <a href="<?php echo URLROOT; ?>/products" class="text-brand-600 font-medium hover:underline">Start
                    Shopping</a>
            </div>
        <?php else: ?>
            <div class="space-y-8 animate-up">
                <?php foreach ($data['orders'] as $order): ?>
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                        <div class="flex items-center justify-between p-6 bg-gray-50 border-b border-gray-200">
                            <dl class="flex-1 grid grid-cols-2 gap-x-6 text-sm sm:grid-cols-4 lg:col-span-2">
                                <div>
                                    <dt class="font-medium text-gray-900">Order number</dt>
                                    <dd class="mt-1 text-gray-500">#<?php echo str_pad($order->id, 8, '0', STR_PAD_LEFT); ?>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-900">Date placed</dt>
                                    <dd class="mt-1 text-gray-500"><?php echo date('M d, Y', strtotime($order->created_at)); ?>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-900">Total amount</dt>
                                    <dd class="mt-1 font-medium text-gray-900">₹<?php echo $order->total_amount; ?></dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-900">Status</dt>
                                    <dd class="mt-1 text-brand-600 capitalize"><?php echo $order->status; ?></dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>