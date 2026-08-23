<?php
include_once './helper/functions.php';

// get all products
$products = get_products();
?>

<?php if (!empty($products)): ?>
    <div class="max-w-screen-xl mx-auto p-4 py-8">

        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Our Products</h1>
            <p class="text-slate-500">Browse our latest collection and special offers.</p>
        </div>

        <!-- Responsive Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <?php foreach ($products as $product): ?>
                <!-- Product Card -->
                <div
                    class="relative bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden group flex flex-col">

                    <!-- Sale Badge (Conditional) -->
                    <?php if (isset($product['isSale']) && $product['isSale']): ?>
                        <span class="absolute top-3 right-3 bg-slate-900 text-white text-xs font-bold px-2.5 py-1 rounded z-10">
                            Sale
                        </span>
                    <?php endif; ?>

                    <!-- Product Image -->
                    <a href="product.php?id=<?= $product['id'] ?>" class="block overflow-hidden bg-slate-100 aspect-[4/3]">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    </a>

                    <!-- Product Details -->
                    <div class="p-5 text-center flex-1 flex flex-col">

                        <!-- Title -->
                        <a href="product.php?id=<?= $product['id'] ?>">
                            <h5 class="text-lg font-bold text-slate-900 mb-1 hover:text-primary-600 transition-colors">
                                <?= htmlspecialchars($product['name']) ?>
                            </h5>
                        </a>

                        <!-- Star Rating (Conditional) -->
                        <?php if (isset($product['rating']) && $product['rating'] > 0): ?>
                            <div class="flex items-center justify-center gap-1 mb-2">
                                <?php for ($i = 0; $i < $product['rating']; $i++): ?>
                                    <svg class="w-4 h-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                <?php endfor; ?>
                            </div>
                        <?php else: ?>
                            <!-- Spacer to keep cards aligned if there are no stars -->
                            <div class="h-6 mb-2"></div>
                        <?php endif; ?>

                        <!-- Price -->
                        <div class="mb-5 mt-auto">
                            <?php if (isset($product['originalPriceDisplay']) && $product['originalPriceDisplay']): ?>
                                <span
                                    class="text-sm text-slate-400 line-through me-1.5"><?= htmlspecialchars($product['originalPriceDisplay']) ?></span>
                            <?php endif; ?>
                            <span class="text-slate-900 font-medium"><?= htmlspecialchars($product['priceDisplay']) ?></span>
                        </div>

                        <!-- Action Button -->
                        <?php if (isset($product['buttonType']) && $product['buttonType'] === 'options'): ?>
                            <a href="product.php?id=<?= $product['id'] ?>"
                                class="mt-auto inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-slate-900 bg-transparent border border-slate-900 rounded-lg hover:bg-slate-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-slate-200 transition-colors">
                                View options
                            </a>
                        <?php else: ?>
                            <a href="../actions/add-to-cart.php?id=<?= $product['id'] ?>"
                                class="mt-auto inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-slate-900 bg-transparent border border-slate-900 rounded-lg hover:bg-slate-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-slate-200 transition-colors">
                                Add to cart
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="flex justify-center mt-8">
        <p class="text-sm font-medium text-slate-900">No products found.</p>
    </div>
<?php endif; ?>