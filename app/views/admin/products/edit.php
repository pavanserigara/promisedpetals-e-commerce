<?php require APPROOT . '/views/layouts/admin_header.php'; ?>

<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="<?php echo URLROOT; ?>/admin/products"
            class="text-brand-600 hover:text-brand-800 flex items-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            Back to Catalog
        </a>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-white border-b border-brand-100 py-6 px-8">
                <h1 class="text-2xl font-serif font-bold text-slate-800">Edit Bloom</h1>
                <p class="text-slate-500 mt-1 text-sm">Update product details to keep your catalog fresh.</p>
            </div>

            <form action="<?php echo URLROOT; ?>/admin/edit_product/<?php echo $data['product']->id; ?>" method="POST"
                enctype="multipart/form-data" class="p-8 space-y-8">
                <?php csrf_field(); ?>

                <!-- Basic Info Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1 md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" id="name" required value="<?php echo $data['product']->name; ?>"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm transition">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Collection</label>
                        <select id="category" name="category_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm rounded-lg transition">
                            <?php foreach ($data['categories'] as $cat): ?>
                                <option value="<?php echo $cat->id; ?>" <?php echo $data['product']->category_id == $cat->id ? 'selected' : ''; ?>>
                                    <?php echo $cat->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                        <input type="number" name="stock" id="stock" value="<?php echo $data['product']->stock; ?>"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm transition">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm font-serif italic">$</span>
                            </div>
                            <input type="number" step="0.01" name="price" id="price" required
                                value="<?php echo $data['product']->price; ?>"
                                class="focus:ring-brand-500 focus:border-brand-500 block w-full pl-7 pr-3 py-2 sm:text-sm border-gray-300 rounded-lg"
                                placeholder="0.00">
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="4"
                            class="shadow-sm focus:ring-brand-500 focus:border-brand-500 block w-full sm:text-sm border border-gray-300 rounded-lg p-3 transition"><?php echo $data['product']->description; ?></textarea>
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Product Photography</label>
                    <div class="flex items-center gap-4 mt-2">
                        <?php if ($data['product']->image): ?>
                            <div class="flex-shrink-0">
                                <img src="<?php echo getProductImage($data['product']->image); ?>" alt="Current Image"
                                    class="h-20 w-20 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-center text-gray-500 mt-1">Current</p>
                            </div>
                        <?php endif; ?>

                        <div
                            class="flex-grow mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-brand-100 border-dashed rounded-xl hover:border-brand-400 hover:bg-brand-50/30 transition-all group cursor-pointer relative">
                            <input id="file-upload" name="image" type="file"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-brand-500 transition"
                                    stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <span
                                        class="relative bg-white rounded-md font-medium text-brand-600 group-hover:text-brand-500">
                                        Change Image
                                    </span>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">Leave blank to keep current image</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-gray-100 flex justify-between">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all transform active:scale-95 hover:-translate-y-1">
                        Update Bloom
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>