<?php

include_once './helper/functions.php';
// 1. Fetch Data
$productsData = get_products();
$detailsData = get_products_details();
$productId = (isset($_GET['id']) ? (int)$_GET['id'] : null);

// 2. Find the specific product
$baseProduct = null;
$productDetail = null;
$exists = checkExistsProduct($productId);
$exists_detail = checkExistsProductDetail($productId);
foreach ($productsData as $p) {
    if ($p['id'] === $productId) $baseProduct = $p;
}
foreach ($detailsData as $d) {
    if ($d['id'] === $productId) $productDetail = $d;
}
?>
<?php if ($exists && $exists_detail): ?>
    <div class="max-w-screen-xl mx-auto p-4 py-8">

        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="index.php"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="products.php"
                            class="ms-1 text-sm font-medium text-slate-700 hover:text-primary-600 md:ms-2">Products</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span
                            class="ms-1 text-sm font-medium text-slate-500 md:ms-2"><?= htmlspecialchars($baseProduct['name']) ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Product Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 mb-16">

            <!-- Left: Image Gallery -->
            <div class="flex flex-col gap-4">
                <!-- Main Large Image -->
                <div class="overflow-hidden rounded-xl bg-slate-100 aspect-square border border-slate-200">
                    <img src="<?= htmlspecialchars($productDetail['gallery'][0] ?? $baseProduct['image']) ?>"
                        alt="<?= htmlspecialchars($baseProduct['name']) ?>" class="w-full h-full object-cover">
                </div>
                <!-- Thumbnails -->
                <?php if (isset($productDetail['gallery']) && count($productDetail['gallery']) > 1): ?>
                    <div class="grid grid-cols-4 gap-4">
                        <?php foreach ($productDetail['gallery'] as $img): ?>
                            <button
                                class="overflow-hidden rounded-lg border-2 border-transparent hover:border-primary-500 transition-colors aspect-square focus:outline-none focus:border-primary-500">
                                <img src="<?= htmlspecialchars($img) ?>" class="w-full h-full object-cover" alt="Thumbnail">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right: Product Info -->
            <div class="flex flex-col">
                <!-- Title & Category -->
                <span
                    class="text-sm font-medium text-primary-600 mb-2"><?= htmlspecialchars($productDetail['category'] ?? 'General') ?></span>
                <h1 class="text-3xl font-extrabold text-slate-900 sm:text-4xl mb-4">
                    <?= htmlspecialchars($baseProduct['name']) ?>
                </h1>

                <!-- Price & Stock -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-end gap-2">
                        <span
                            class="text-3xl font-bold text-slate-900"><?= htmlspecialchars($baseProduct['priceDisplay']) ?></span>
                        <?php if (isset($baseProduct['originalPriceDisplay']) && $baseProduct['originalPriceDisplay']): ?>
                            <span
                                class="text-lg text-slate-400 line-through mb-1"><?= htmlspecialchars($baseProduct['originalPriceDisplay']) ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Stock Badge -->
                    <?php
                    $stockColor = $productDetail['stockStatus'] === 'In Stock' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                    ?>
                    <span class="text-xs font-medium px-3 py-1 rounded-full <?= $stockColor ?>">
                        <?= htmlspecialchars($productDetail['stockStatus']) ?>
                    </span>
                </div>

                <!-- Description -->
                <p class="text-slate-600 mb-8 leading-relaxed">
                    <?= htmlspecialchars($productDetail['description']) ?>
                </p>

                <!-- Dynamic Options (If Variable Product) -->
                <?php if ($productDetail['hasOptions']): ?>
                    <hr class="border-slate-200 mb-6">

                    <!-- Colors -->
                    <?php if (isset($productDetail['options']['colors'])): ?>
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-slate-900 mb-3">Color</h3>
                            <div class="flex flex-wrap gap-3">
                                <?php foreach ($productDetail['options']['colors'] as $color): ?>
                                    <button type="button"
                                        class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-primary-600 focus:z-10 focus:ring-2 focus:ring-primary-500 transition-colors">
                                        <?= htmlspecialchars($color) ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Sizes -->
                    <?php if (isset($productDetail['options']['sizes'])): ?>
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-slate-900 mb-3">Size</h3>
                            <div class="flex flex-wrap gap-3">
                                <?php foreach ($productDetail['options']['sizes'] as $size): ?>
                                    <button type="button"
                                        class="w-10 h-10 flex items-center justify-center text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-primary-600 focus:z-10 focus:ring-2 focus:ring-primary-500 transition-colors">
                                        <?= htmlspecialchars($size) ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <hr class="border-slate-200 my-6">

                <!-- Add to Cart Action -->
                <div
                    class="flex gap-4 mt-auto <?php if ($productDetail['stockStatus'] == 'Out of Stock'): ?>hidden<?php endif; ?>">
                    <!-- Quantity Selector -->
                    <div class="relative flex items-center max-w-[110px]">
                        <button type="button"
                            class="bg-slate-100 hover:bg-slate-200 border border-slate-300 rounded-s-lg p-3 h-12 focus:ring-primary-500 focus:ring-2 focus:outline-none transition-colors">
                            <svg class="w-3 h-3 text-slate-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 1h16" />
                            </svg>
                        </button>
                        <input type="text" value="1"
                            class="bg-slate-50 border-x-0 border-slate-300 h-12 text-center text-slate-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5"
                            required />
                        <button type="button"
                            class="bg-slate-100 hover:bg-slate-200 border border-slate-300 rounded-e-lg p-3 h-12 focus:ring-primary-500 focus:ring-2 focus:outline-none transition-colors">
                            <svg class="w-3 h-3 text-slate-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <a href='../actions/add-to-cart.php?id=<?= $productDetail['id'] ?>' class=" flex-1 text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none
                focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition-colors flex
                items-center justify-center gap-2">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 21">
                            <path
                                d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.184.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                        </svg>
                        Add to Cart
                    </a>
                </div>

            </div>
        </div>

        <!-- Related Products Footer Section -->
        <div class="mt-20 border-t border-slate-200 pt-12">
            <h2 class="text-2xl font-bold text-slate-900 mb-8">Customers also bought</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                $count = 0;
                foreach ($productsData as $relatedProduct):
                    // Skip the current product and only show up to 4 items
                    if ($relatedProduct['id'] === $productId || $count >= 4) continue;
                    $count++;
                ?>
                    <!-- Reused Product Card -->
                    <div
                        class="relative bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden group flex flex-col">
                        <a href="product.php?id=<?= $relatedProduct['id'] ?>"
                            class="block overflow-hidden bg-slate-100 aspect-[4/3]">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                src="<?= htmlspecialchars($relatedProduct['image']) ?>"
                                alt="<?= htmlspecialchars($relatedProduct['name']) ?>">
                        </a>
                        <div class="p-5 text-center flex-1 flex flex-col">
                            <a href="product.php?id=<?= $relatedProduct['id'] ?>">
                                <h5 class="text-lg font-bold text-slate-900 mb-1 hover:text-primary-600 transition-colors">
                                    <?= htmlspecialchars($relatedProduct['name']) ?>
                                </h5>
                            </a>
                            <div class="mb-5 mt-auto pt-4">
                                <span
                                    class="text-slate-900 font-medium"><?= htmlspecialchars($relatedProduct['priceDisplay']) ?></span>
                            </div>
                            <a href="product.php?id=<?= $relatedProduct['id'] ?>"
                                class="mt-auto inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-slate-900 bg-transparent border border-slate-900 rounded-lg hover:bg-slate-900 hover:text-white transition-colors">
                                View details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php elseif (!$exists): ?>
    <div class="flex items-center justify-center min-h-[60vh] px-4">
        <div class="text-center max-w-screen-sm mx-auto py-16">
            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600">404</h1>
            <p class="mb-4 text-3xl tracking-tight font-bold text-red-600 md:text-4xl">Product not found.</p>
            <p class="mb-8 text-lg font-light text-slate-500">
                Sorry, we couldn't find the product you're looking for. It might have been removed or the link is incorrect.
            </p>
            <a href="products.php"
                class="inline-flex text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition-colors">
                Back to Products
            </a>
        </div>
    </div>
<?php endif; ?>