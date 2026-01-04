<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="<?php echo URLROOT; ?>/admin/users" class="text-brand-600 hover:text-brand-800 flex items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            Back to Users
        </a>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-brand-900 py-6 px-8">
                <h1 class="text-2xl font-serif font-bold text-white">Edit User</h1>
                <p class="text-brand-100 mt-1 text-sm">Update account details for <?php echo $data['user']->name; ?>.
                </p>
            </div>

            <form action="<?php echo URLROOT; ?>/admin/edit_user/<?php echo $data['user']->id; ?>" method="POST"
                class="p-8 space-y-6">
                <?php csrf_field(); ?>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $data['user']->name; ?>" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" value="<?php echo $data['user']->email; ?>" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password <span
                            class="text-gray-400 font-normal">(Leave blank to keep unchanged)</span></label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm rounded-md">
                        <option value="customer" <?php echo $data['user']->role == 'customer' ? 'selected' : ''; ?>>
                            Customer</option>
                        <option value="admin" <?php echo $data['user']->role == 'admin' ? 'selected' : ''; ?>>Admin
                        </option>
                    </select>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>