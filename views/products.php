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
                <div class="group bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-xl hover:border-slate-300 transition-all duration-300 overflow-hidden flex flex-col">

                    <!-- Sale Badge (Conditional) -->
                    <div class="relative bg-slate-100 aspect-[4/3] overflow-hidden">
                        <?php if (isset($product['isSale']) && $product['isSale']): ?>
                            <span class="absolute top-3 start-3 bg-red-600 text-white text-xs font-extrabold px-2.5 py-1 rounded-lg z-10 shadow-sm">
                                SALE
                            </span>
                        <?php endif; ?>

                        <!-- Product Image -->
                        <a href="product.php?id=<?= $product['id'] ?>" class="block w-full h-full">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        </a>
                    </div>

                    <!-- Product Details -->
                    <div class="p-5 flex-1 flex flex-col">

                        <!-- Star Rating (Conditional) -->
                        <div class="flex items-center gap-1 mb-2">
                            <?php 
                            $rating = (int)($product['rating'] ?? 0);
                            for ($i = 0; $i < 5; $i++): 
                            ?>
                                <svg class="w-3.5 h-3.5 <?= $i < $rating ? 'text-yellow-400' : 'text-slate-200' ?>" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            <?php endfor; ?>
                            <?php if ($rating > 0): ?>
                                <span class="text-xs text-slate-400 ms-1">(<?= $rating ?>.0)</span>
                            <?php endif; ?>
                        </div>

                        <!-- Title -->
                        <a href="product.php?id=<?= $product['id'] ?>" class="block mb-2">
                            <h5 class="text-base font-bold text-slate-900 group-hover:text-primary-600 transition-colors line-clamp-1">
                                <?= htmlspecialchars($product['name']) ?>
                            </h5>
                        </a>

                        <!-- Price -->
                        <div class="flex items-center gap-2 mb-4 mt-auto">
                            <span class="text-lg font-extrabold text-slate-900"><?= htmlspecialchars($product['priceDisplay']) ?></span>
                            <?php if (isset($product['originalPriceDisplay']) && $product['originalPriceDisplay']): ?>
                                <span class="text-xs text-slate-400 line-through"><?= htmlspecialchars($product['originalPriceDisplay']) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-100">
                            <a href="product.php?id=<?= $product['id'] ?>"
                                class="flex items-center justify-center px-3 py-2 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                Details
                            </a>

                            <?php if (isset($product['buttonType']) && $product['buttonType'] === 'options'): ?>
                                <a href="product.php?id=<?= $product['id'] ?>"
                                    class="flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-xl transition-colors">
                                    Options
                                </a>
                            <?php else: ?>
                                <a href="actions/add-to-cart.php?id=<?= $product['id'] ?>"
                                    class="flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-xl transition-colors">
                                    Add to cart
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
   <!-- Enhanced Empty State -->
<section class="max-w-screen-xl mx-auto px-4 py-16 sm:py-24">
    <div class="flex flex-col items-center justify-center text-center max-w-2xl mx-auto bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 p-8 sm:p-14">
        
        <!-- Icon (Package/Box) -->
        <div class="p-4 bg-white rounded-full shadow-sm mb-5">
            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
        </div>

        <!-- Text Content -->
        <h2 class="text-2xl font-bold text-slate-900 mb-2">No products found</h2>
        <p class="text-slate-500 mb-6 max-w-md">Your inventory is currently empty. Be the first to add a new product and get started.</p>

        <!-- Call to Action Button -->
        <a href="create-product.php" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-xl transition-all duration-200 shadow-sm hover:shadow focus:ring-4 focus:outline-none focus:ring-primary-300">
            <!-- Plus Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Product
        </a>
        
    </div>
</section>
<?php endif; ?>