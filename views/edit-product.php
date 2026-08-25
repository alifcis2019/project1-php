<div class="max-w-screen-xl mx-auto p-6 bg-white rounded-2xl shadow-sm border border-slate-200 mt-8 mb-12" dir="ltr">
    <div class="mb-6 border-b border-slate-200 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Edit Product: <?= htmlspecialchars($product['name']) ?></h2>
            <p class="text-sm text-slate-500 mt-1">Update the product information, pricing, or media below.</p>
        </div>
        <a href="actions/delete-product.php?id=<?= $product['id'] ?>"
            onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.');"
            class="px-4 py-2 text-sm font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Delete Product
        </a>
    </div>

    <form action="actions/edit-product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <h3 class="text-lg font-semibold text-slate-800 mb-4">1. Basic Information</h3>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-slate-900">Product Name <span
                        class="text-red-500">*</span></label>
                <input type="text" id="name" name="product[name]"
                    value="<?= htmlspecialchars($product['name']) ?>"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    required>
            </div>
            <div>
                <label for="category" class="block mb-2 text-sm font-medium text-slate-900">Category <span
                        class="text-red-500">*</span></label>
                <select id="category" name="product[category]" required
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="Clothing" <?= ($productDetail['category'] ?? '') === 'Clothing' ? 'selected' : '' ?>>Clothing</option>
                    <option value="Accessories" <?= ($productDetail['category'] ?? '') === 'Accessories' ? 'selected' : '' ?>>Accessories</option>
                    <option value="Electronics" <?= ($productDetail['category'] ?? '') === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                    <option value="Home" <?= ($productDetail['category'] ?? '') === 'Home' ? 'selected' : '' ?>>Home</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label for="description" class="block mb-2 text-sm font-medium text-slate-900">Product
                    Description</label>
                <textarea id="description" name="product[description]" rows="4"
                    class="block p-2.5 w-full text-sm text-slate-900 bg-slate-50 rounded-lg border border-slate-300 focus:ring-primary-500 focus:border-primary-500"><?= htmlspecialchars($productDetail['description'] ?? '') ?></textarea>
            </div>
        </div>

        <h3 class="text-lg font-semibold text-slate-800 mb-4 mt-8">2. Pricing & Inventory</h3>
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <div>
                <label for="current_price" class="block mb-2 text-sm font-medium text-slate-900">Current Price ($) <span
                        class="text-red-500">*</span></label>
                <input type="number" step="0.01" id="current_price" name="product[current_price]"
                    value="<?= $currentPriceClean ?>"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    required>
            </div>
            <div>
                <label for="original_price" class="block mb-2 text-sm font-medium text-slate-900">Original Price ($)</label>
                <input type="number" step="0.01" id="original_price" name="product[original_price]"
                    value="<?= $origPriceClean ?>"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
            </div>
            <div>
                <label for="stock_status" class="block mb-2 text-sm font-medium text-slate-900">Stock Status</label>
                <select id="stock_status" name="product[stock_status]"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="In Stock" <?= ($productDetail['stockStatus'] ?? '') === 'In Stock' ? 'selected' : '' ?>>In Stock</option>
                    <option value="Low Stock" <?= ($productDetail['stockStatus'] ?? '') === 'Low Stock' ? 'selected' : '' ?>>Low Stock</option>
                    <option value="Out of Stock" <?= ($productDetail['stockStatus'] ?? '') === 'Out of Stock' ? 'selected' : '' ?>>Out of Stock</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-6 mb-8 p-4 bg-slate-50 rounded-xl border border-slate-200">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="product[is_sale]" value="1" class="sr-only peer" id="is_sale" <?= !empty($product['isSale']) ? 'checked' : '' ?>>
                <div
                    class="relative w-11 h-6 bg-slate-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-slate-900">On Sale Badge</span>
            </label>

            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="product[has_options]" value="1" class="sr-only peer" id="has_options" <?= !empty($productDetail['hasOptions']) ? 'checked' : '' ?>>
                <div
                    class="relative w-11 h-6 bg-slate-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-slate-900">Product has options (Sizes/Colors)</span>
            </label>
        </div>

        <h3 class="text-lg font-semibold text-slate-800 mb-4">3. Product Media</h3>
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Current Main Thumbnail</label>
                <div class="mb-3">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="Thumbnail" class="w-32 h-24 object-cover rounded-lg border border-slate-200 shadow-sm">
                </div>
                <label class="block mb-2 text-xs text-slate-500">Upload New Thumbnail (Leave empty to keep current)</label>
                <input name="product[main_image]" type="file"
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200"
                    accept="image/*" />
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Gallery Images</label>
                <div class="flex gap-2 mb-3 overflow-x-auto">
                    <?php if (!empty($productDetail['gallery'])): ?>
                        <?php foreach ($productDetail['gallery'] as $img): ?>
                            <img src="<?= htmlspecialchars($img) ?>" alt="Gallery" class="w-16 h-16 object-cover rounded-lg border border-slate-200 shadow-sm">
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <label class="block mb-2 text-xs text-slate-500">Upload New Gallery Images (Leave empty to keep current)</label>
                <input name="product[gallery][]" type="file" multiple
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200"
                    accept="image/*" />
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-200">
            <a href="products.php"
                class="text-slate-700 bg-white border border-slate-300 focus:ring-4 focus:outline-none focus:ring-slate-100 font-medium rounded-lg text-sm px-5 py-2.5 hover:bg-slate-50 transition-colors">
                Cancel
            </a>
            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors flex items-center gap-2">
                Update Product
            </button>
        </div>
    </form>
</div>
