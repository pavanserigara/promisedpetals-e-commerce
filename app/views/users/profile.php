<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="bg-gray-50 min-h-screen pb-12">
    <!-- Hero/Header -->
    <div class="bg-brand-900 pb-32">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-serif font-bold tracking-tight text-white animate-up">My Account</h1>
            <p class="mt-2 text-brand-100 animate-up">Manage your profile and view your order history.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 -mt-24">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

            <!-- User Info Sidebar -->
            <div class="md:col-span-1 animate-up">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-brand-50 p-6 text-center border-b border-brand-100">
                        <div
                            class="inline-block h-24 w-24 rounded-full overflow-hidden bg-white border-4 border-white shadow-md mb-4">
                            <svg class="h-full w-full text-brand-200" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900"><?php echo $data['user']->name; ?></h2>
                        <p class="text-sm text-gray-500"><?php echo $data['user']->email; ?></p>
                        <span
                            class="inline-flex mt-3 items-center px-3 py-1 rounded-full text-xs font-medium bg-brand-100 text-brand-800 capitalize">
                            <?php echo $data['user']->role; ?>
                        </span>
                    </div>
                    <div class="p-6">
                        <?php flash('profile_message'); ?>
                        <nav class="space-y-1">
                            <a href="<?php echo URLROOT; ?>/users/profile"
                                class="bg-brand-50 text-brand-700 group flex items-center px-3 py-2 text-sm font-medium rounded-md"
                                aria-current="page">
                                <svg class="text-brand-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span class="truncate">Order History</span>
                            </a>
                            <!-- Placeholder links for future features -->
                            <a href="#"
                                class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                <span class="truncate">Payment Methods</span>
                            </a>
                            <a href="<?php echo URLROOT; ?>/users/edit"
                                class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="truncate">Edit Profile</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content Area (Orders) -->
            <div class="md:col-span-2 animate-up" style="animation-delay: 0.1s;">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 bg-white flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 font-serif">Recent Orders</h3>
                        <span
                            class="px-3 py-1 bg-brand-50 text-brand-700 rounded-full text-xs font-semibold"><?php echo count($data['orders']); ?>
                            Orders</span>
                    </div>

                    <?php if (empty($data['orders'])): ?>
                        <div class="p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No orders yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by browsing our fresh collection.</p>
                            <div class="mt-6">
                                <a href="<?php echo URLROOT; ?>/products"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <ul role="list" class="divide-y divide-gray-100">
                            <?php foreach ($data['orders'] as $order): ?>
                                <li class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg font-bold text-gray-900">Order
                                                #<?php echo str_pad($order->id, 8, '0', STR_PAD_LEFT); ?></span>
                                            <span class="text-sm text-gray-500">•
                                                <?php echo date('F j, Y', strtotime($order->created_at)); ?></span>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <?php
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'processing' => 'bg-blue-100 text-blue-800',
                                                'shipped' => 'bg-purple-100 text-purple-800',
                                                'delivered' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ];
                                            $class = isset($statusClasses[$order->status]) ? $statusClasses[$order->status] : 'bg-gray-100 text-gray-800';
                                            ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $class; ?> capitalize">
                                                <?php echo $order->status; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-end mt-4">
                                        <div>
                                            <p class="text-sm text-gray-600 flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                Deliver to: <?php echo explode(',', $order->shipping_address)[0]; ?>...
                                            </p>
                                        </div>
                                        <p class="text-xl font-bold text-brand-600 font-serif">
                                            ₹<?php echo number_format($order->total_amount, 2); ?>
                                        </p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>