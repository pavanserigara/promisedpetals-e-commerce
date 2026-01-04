<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-gray-100 min-h-screen">
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg px-8 py-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Add New Category</h2>
                <p class="mt-1 text-sm text-gray-600">Create a new product category.</p>
            </div>

            <form action="<?php echo URLROOT; ?>/admin/add_category" method="POST" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" required
                                class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border">
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="3"
                                class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"></textarea>
                        </div>
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category Image</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-brand-600 hover:text-brand-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand-500">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="<?php echo URLROOT; ?>/admin/categories"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            Save Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/layouts/footer.php'; ?>