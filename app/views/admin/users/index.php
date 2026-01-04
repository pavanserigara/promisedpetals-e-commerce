<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-serif font-bold text-gray-900">User Management</h1>
            <div class="flex items-center gap-4">
                <form action="<?php echo URLROOT; ?>/admin/users" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Search users..."
                        value="<?php echo isset($data['search']) ? $data['search'] : ''; ?>"
                        class="bg-white border border-gray-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-brand-500">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
                <a href="<?php echo URLROOT; ?>/admin/add_user"
                    class="bg-brand-600 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-brand-900/20 hover:bg-brand-500 hover:scale-105 active:scale-95 flex items-center gap-2 transition-all font-bold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add User
                </a>
            </div>
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
                                        ID</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Name</th>
                                    <th scope="col"
                                        class="hidden md:table-cell px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Role</th>
                                    <th scope="col"
                                        class="hidden lg:table-cell px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">
                                        Joined Date</th>
                                    <th scope="col" class="relative px-6 py-4">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <?php foreach ($data['users'] as $user): ?>
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-brand-600 font-mono">
                                                #<?php echo $user->id; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div
                                                        class="h-10 w-10 rounded-xl bg-gradient-to-br from-brand-100 to-brand-50 flex items-center justify-center text-brand-600 font-bold text-lg shadow-inner">
                                                        <?php echo strtoupper(substr($user->name, 0, 1)); ?>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-gray-900">
                                                        <?php echo $user->name; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500"><?php echo $user->email; ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2.5 py-0.5 inline-flex text-[10px] leading-5 font-bold uppercase tracking-wide rounded-full <?php echo $user->role === 'admin' ? 'bg-purple-100 text-purple-800 border border-purple-200' : 'bg-green-100 text-green-800 border border-green-200'; ?>">
                                                <?php echo ucfirst($user->role); ?>
                                            </span>
                                        </td>
                                        <td class="hidden lg:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo date('M d, Y', strtotime($user->created_at)); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="<?php echo URLROOT; ?>/admin/edit_user/<?php echo $user->id; ?>"
                                                    class="text-brand-600 hover:text-brand-900 bg-brand-50 hover:bg-brand-100 p-2 rounded-lg transition"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </a>
                                                <?php if ($user->id !== $_SESSION['user_id']): // Prevent self-delete ?>
                                                    <form
                                                        action="<?php echo URLROOT; ?>/admin/delete_user/<?php echo $user->id; ?>"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                        class="inline">
                                                        <?php csrf_field(); ?>
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition"
                                                            title="Delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
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