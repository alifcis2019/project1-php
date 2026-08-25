<div class="max-w-screen-xl mx-auto p-6 bg-white rounded-2xl shadow-sm border border-slate-200 mt-8 mb-12" dir="ltr">
    <div class="mb-6 border-b border-slate-200 pb-4">
        <h2 class="text-2xl font-bold text-slate-900">Create New Product</h2>
        <p class="text-sm text-slate-500 mt-1">Fill in the information below to add a new product to your catalog.</p>
    </div>

    <form action="actions/add-new-product.php" method="POST" enctype="multipart/form-data">

        <h3 class="text-lg font-semibold text-slate-800 mb-4">1. Basic Information</h3>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-slate-900">Product Name <span
                        class="text-red-500">*</span></label>
                <input type="text" id="name" name="product[name]"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="e.g. Fancy Wireless Headphones" required>
            </div>
            <div>
                <label for="category" class="block mb-2 text-sm font-medium text-slate-900">Category <span
                        class="text-red-500">*</span></label>
                <select id="category" name="product[category]" required
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option selected disabled value="">Select category</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Home">Home</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label for="description" class="block mb-2 text-sm font-medium text-slate-900">Product
                    Description</label>
                <textarea id="description" name="product[description]" rows="4"
                    class="block p-2.5 w-full text-sm text-slate-900 bg-slate-50 rounded-lg border border-slate-300 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="Write a detailed description here..."></textarea>
            </div>
        </div>

        <h3 class="text-lg font-semibold text-slate-800 mb-4 mt-8">2. Pricing & Inventory</h3>
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <div>
                <label for="current_price" class="block mb-2 text-sm font-medium text-slate-900">Current Price ($) <span
                        class="text-red-500">*</span></label>
                <input type="number" step="0.01" id="current_price" name="product[current_price]"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="0.00" required>
            </div>
            <div>
                <label for="original_price" class="block mb-2 text-sm font-medium text-slate-900">Original Price
                    ($)</label>
                <input type="number" step="0.01" id="original_price" name="product[original_price]"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="e.g. before discount">
            </div>
            <div>
                <label for="stock_status" class="block mb-2 text-sm font-medium text-slate-900">Stock Status</label>
                <select id="stock_status" name="product[stock_status]"
                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="In Stock">In Stock</option>
                    <option value="Low Stock">Low Stock</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-6 mb-8 p-4 bg-slate-50 rounded-xl border border-slate-200">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="product[is_sale]" value="1" class="sr-only peer" id="is_sale">
                <div
                    class="relative w-11 h-6 bg-slate-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-slate-900">On Sale Badge</span>
            </label>

            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="product[has_options]" value="1" class="sr-only peer" id="has_options">
                <div
                    class="relative w-11 h-6 bg-slate-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-slate-900">Product has options (Sizes/Colors)</span>
            </label>
        </div>

        <h3 class="text-lg font-semibold text-slate-800 mb-4">3. Product Media</h3>
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Main Thumbnail</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-main"
                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <p class="mb-2 text-sm text-slate-500"><span class="font-semibold">Click to upload</span>
                            </p>
                            <p class="text-xs text-slate-500">SVG, PNG, or JPG (450x300)</p>
                        </div>
                        <input id="dropzone-main" name="product[main_image]" type="file" class="hidden"
                            accept="image/*" />
                    </label>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-900">Gallery Images (Multiple)</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-gallery"
                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <p class="mb-2 text-sm text-slate-500"><span class="font-semibold">Click to upload</span>
                            </p>
                            <p class="text-xs text-slate-500">Up to 4 images</p>
                        </div>
                        <input id="dropzone-gallery" name="product[gallery][]" type="file" class="hidden" multiple
                            accept="image/*" />
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-200">
            <button type="button"
                class="text-slate-700 bg-white border border-slate-300 focus:ring-4 focus:outline-none focus:ring-slate-100 font-medium rounded-lg text-sm px-5 py-2.5 hover:bg-slate-50 transition-colors">
                Cancel
            </button>
            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors flex items-center gap-2">
                Publish Product
            </button>
        </div>
    </form>
</div>