<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="bg-gray-50 min-h-screen pb-12">
    <div class="bg-brand-900 pb-32">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-serif font-bold tracking-tight text-white mb-2 animate-up">Edit Profile</h1>
            <p class="text-brand-100 text-lg">Update your personal information and security settings.</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24">
        <div class="bg-white rounded-2xl shadow-xl p-8 animate-up">
            <form action="<?php echo URLROOT; ?>/users/edit" method="POST" class="space-y-6">
                <!-- CSRF Protection -->
                <?php csrf_field(); ?>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($data['name']); ?>"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 sm:text-sm px-4 py-3 border <?php echo (!empty($data['name_err'])) ? 'border-red-500' : ''; ?>">
                        <span class="text-red-500 text-xs italic"><?php echo $data['name_err']; ?></span>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email"
                            value="<?php echo htmlspecialchars($data['email']); ?>"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 sm:text-sm px-4 py-3 border <?php echo (!empty($data['email_err'])) ? 'border-red-500' : ''; ?>">
                        <span class="text-red-500 text-xs italic"><?php echo $data['email_err']; ?></span>
                    </div>

                    <div class="sm:col-span-2 border-t border-gray-100 pt-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Security <span
                                class="text-xs font-normal text-gray-500 ml-2">(Leave passwords blank to keep current
                                password)</span></h2>

                        <label for="current_password" class="block text-sm font-medium text-gray-700">Current
                            Password</label>
                        <input type="password" name="current_password" id="current_password"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 sm:text-sm px-4 py-3 border <?php echo (!empty($data['current_password_err'])) ? 'border-red-500' : ''; ?>">
                        <span class="text-red-500 text-xs italic"><?php echo $data['current_password_err']; ?></span>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 sm:text-sm px-4 py-3 border <?php echo (!empty($data['password_err'])) ? 'border-red-500' : ''; ?>">
                        <span class="text-red-500 text-xs italic"><?php echo $data['password_err']; ?></span>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-8 border-t border-gray-100">
                    <a href="<?php echo URLROOT; ?>/users/profile"
                        class="text-sm font-medium text-gray-500 hover:text-brand-600 transition">Cancel</a>
                    <button type="submit"
                        class="bg-brand-600 text-white px-8 py-3 rounded-lg font-bold shadow-lg hover:bg-brand-700 transition transform hover:-translate-y-1">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>