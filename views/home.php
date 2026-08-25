<?php
// Ensure helper functions are loaded
include_once './helper/functions.php';

$allProducts = get_products();
$featuredProducts = array_slice($allProducts, 0, 8);
?>

<!-- 1. Hero Section -->
<section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-primary-950 text-white overflow-hidden py-12 md:py-20">
    <!-- Glow and decorative backdrop -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10 grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
        <!-- Left Hero Text -->
        <div class="md:col-span-7 text-center md:text-left">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-primary-500/20 text-primary-300 border border-primary-500/30 mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-primary-400 animate-pulse"></span>
                New Season Collection 2026
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight leading-tight mb-6 text-white">
                Discover Quality Products at <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-blue-300">Unbeatable Prices</span>
            </h1>

            <p class="text-slate-300 text-base sm:text-lg mb-8 max-w-xl mx-auto md:mx-0 leading-relaxed">
                Shop the latest arrivals curated with care. Enjoy fast delivery across Egypt, flexible payment methods including Cash on Delivery, and hassle-free returns.
            </p>

            <div class="flex flex-wrap gap-4 justify-center md:justify-start items-center">
                <a href="products.php"
                    class="inline-flex items-center justify-center gap-2 px-7 py-3.5 text-base font-bold text-white bg-primary-600 hover:bg-primary-500 rounded-xl shadow-lg hover:shadow-primary-600/30 focus:ring-4 focus:ring-primary-300 transition-all">
                    Shop Collection
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <a href="about.php"
                    class="inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-slate-300 hover:text-white bg-white/10 hover:bg-white/15 rounded-xl border border-white/20 backdrop-blur-md transition-all">
                    Learn More
                </a>
            </div>

            <!-- Highlights checklist -->
            <div class="mt-10 pt-6 border-t border-slate-700/60 flex flex-wrap gap-6 justify-center md:justify-start text-xs sm:text-sm text-slate-400 font-medium">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-check text-green-400"></i>
                    <span>Free delivery over $50</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-check text-green-400"></i>
                    <span>100% Genuine Products</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-check text-green-400"></i>
                    <span>Instant COD Option</span>
                </div>
            </div>
        </div>

        <!-- Right Hero Illustration / Promo Visual -->
        <div class="md:col-span-5 flex justify-center relative">
            <div class="relative w-full max-w-sm sm:max-w-md">
                <div class="bg-gradient-to-tr from-primary-600/30 to-blue-400/20 rounded-3xl p-6 border border-white/10 backdrop-blur-xl shadow-2xl">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/10 text-xs">
                        <span class="font-bold uppercase tracking-wider text-primary-300">🔥 Hot Deals Today</span>
                        <span class="bg-red-500/20 text-red-300 font-bold px-2 py-0.5 rounded-full">Save Up to 50%</span>
                    </div>

                    <img src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/girl-shopping-list.svg" 
                         alt="Shopping Hero Illustration" 
                         class="w-full h-56 sm:h-64 object-contain mx-auto drop-shadow-xl hover:scale-105 transition-transform duration-300">

                    <div class="mt-4 p-3 bg-white/10 rounded-xl flex items-center justify-between text-xs sm:text-sm">
                        <div>
                            <span class="block font-bold text-white">Special Promo Discount</span>
                            <span class="text-slate-400">Apply code <code class="text-yellow-300 font-mono font-bold">ERAA20</code> at checkout</span>
                        </div>
                        <a href="products.php" class="px-3 py-1.5 bg-primary-600 hover:bg-primary-500 text-white font-bold rounded-lg transition-colors">
                            Claim
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Value Propositions Bar -->
<section class="bg-white border-b border-slate-200 py-8">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-primary-600 flex items-center justify-center shrink-0 text-xl">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Fast & Free Shipping</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Prompt delivery across all governorates</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 text-xl">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Safe & Secure Payment</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Cash on Delivery & Secure Cards</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 text-xl">
                    <i class="fa-solid fa-rotate-left"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Easy 30-Day Returns</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Money back guarantee policy</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-xl">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">24/7 Dedicated Support</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Always ready to answer your inquiries</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Featured Categories -->
<section class="py-12 bg-slate-50">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Explore Popular Categories</h2>
                <p class="text-sm text-slate-500 mt-1">Browse items handpicked for your lifestyle</p>
            </div>
            <a href="products.php" class="text-sm font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                View All <i class="fa-solid fa-chevron-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <a href="products.php" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-primary-300 transition-all text-center flex flex-col items-center">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 text-primary-600 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-shirt"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-primary-600 transition-colors">Clothing & Apparel</h3>
                <span class="text-xs text-slate-400 mt-1">Trending Styles</span>
            </a>

            <a href="products.php" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-primary-300 transition-all text-center flex flex-col items-center">
                <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-laptop"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-primary-600 transition-colors">Electronics</h3>
                <span class="text-xs text-slate-400 mt-1">Smart Gadgets</span>
            </a>

            <a href="products.php" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-primary-300 transition-all text-center flex flex-col items-center">
                <div class="w-16 h-16 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-glasses"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-primary-600 transition-colors">Accessories</h3>
                <span class="text-xs text-slate-400 mt-1">Everyday Essentials</span>
            </a>

            <a href="products.php" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-primary-300 transition-all text-center flex flex-col items-center">
                <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-couch"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-sm sm:text-base group-hover:text-primary-600 transition-colors">Home & Living</h3>
                <span class="text-xs text-slate-400 mt-1">Comfort Decor</span>
            </a>
        </div>
    </div>
</section>

<!-- 4. Featured Products Section -->
<section class="py-12 bg-white" id="featured-deals">
    <div class="max-w-screen-xl mx-auto px-4">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 pb-4 border-b border-slate-100 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-primary-600 bg-primary-50 px-2.5 py-1 rounded-full">Top Picks</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Featured Products</h2>
                <p class="text-sm text-slate-500 mt-1">Discover our top-rated recommendations and special deals.</p>
            </div>
            <a href="products.php" class="inline-flex items-center text-sm font-bold text-primary-600 hover:text-primary-700 transition-colors">
                Explore All Products (<?= count($allProducts) ?>)
                <svg class="w-4 h-4 ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <?php if (empty($featuredProducts)): ?>
            <!-- Empty Products State -->
            <div class="text-center py-12 bg-slate-50 rounded-2xl border border-slate-200">
                <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400 text-2xl">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1">No Products Available Yet</h3>
                <p class="text-sm text-slate-500 mb-6">Products added will appear right here.</p>
                <?php if (function_exists('is_admin') && is_admin()): ?>
                    <a href="create-product.php" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-xl hover:bg-primary-700">
                        Create New Product
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($featuredProducts as $product): ?>
                    <?php 
                    $detail = get_product_detail($product['id']);
                    $isOutOfStock = ($detail && isset($detail['stockStatus']) && $detail['stockStatus'] === 'Out of Stock');
                    ?>
                    <div class="group bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-xl hover:border-slate-300 transition-all duration-300 overflow-hidden flex flex-col">
                        
                        <!-- Product Thumbnail & Badges -->
                        <div class="relative bg-slate-100 aspect-[4/3] overflow-hidden">
                            <!-- Sale / Out of Stock Badge -->
                            <?php if ($isOutOfStock): ?>
                                <span class="absolute top-3 start-3 bg-slate-900 text-white text-xs font-bold px-2.5 py-1 rounded-lg z-10 shadow-sm">
                                    Out of Stock
                                </span>
                            <?php elseif (isset($product['isSale']) && $product['isSale']): ?>
                                <span class="absolute top-3 start-3 bg-red-600 text-white text-xs font-extrabold px-2.5 py-1 rounded-lg z-10 shadow-sm">
                                    SALE
                                </span>
                            <?php endif; ?>

                            <a href="product.php?id=<?= $product['id'] ?>" class="block w-full h-full">
                                <img src="<?= htmlspecialchars($product['image']) ?>" 
                                     alt="<?= htmlspecialchars($product['name']) ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-1 flex flex-col">
                            <!-- Rating -->
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

                            <!-- Product Name -->
                            <a href="product.php?id=<?= $product['id'] ?>" class="block mb-2">
                                <h3 class="text-base font-bold text-slate-900 group-hover:text-primary-600 transition-colors line-clamp-1">
                                    <?= htmlspecialchars($product['name']) ?>
                                </h3>
                            </a>

                            <!-- Price -->
                            <div class="flex items-center gap-2 mb-4 mt-auto">
                                <span class="text-lg font-extrabold text-slate-900">
                                    <?= htmlspecialchars($product['priceDisplay']) ?>
                                </span>
                                <?php if (!empty($product['originalPriceDisplay'])): ?>
                                    <span class="text-xs text-slate-400 line-through">
                                        <?= htmlspecialchars($product['originalPriceDisplay']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-100">
                                <a href="product.php?id=<?= $product['id'] ?>"
                                    class="flex items-center justify-center px-3 py-2 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                                    Details
                                </a>

                                <?php if ($isOutOfStock): ?>
                                    <button type="button" disabled
                                        class="flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-semibold text-slate-400 bg-slate-100 rounded-xl cursor-not-allowed">
                                        Out of stock
                                    </button>
                                <?php elseif (isset($product['buttonType']) && $product['buttonType'] === 'options'): ?>
                                    <a href="product.php?id=<?= $product['id'] ?>"
                                        class="flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-xl shadow-sm transition-all">
                                        Options
                                    </a>
                                <?php else: ?>
                                    <form action="actions/add-to-cart.php" method="POST" class="w-full">
                                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="w-full h-full flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-xl shadow-sm transition-all">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            Add
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- 5. Flash Sale Promo Banner -->
<section class="py-12 bg-slate-50">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="relative bg-gradient-to-r from-primary-700 to-indigo-900 rounded-3xl p-8 sm:p-12 text-white overflow-hidden shadow-xl">
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-8">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-400 text-slate-950 mb-4">
                        LIMITED TIME PROMOTION
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight mb-3">
                        Upgrade Your Wardrobe & Tech with Instant Discounts
                    </h2>
                    <p class="text-primary-100 text-sm sm:text-base mb-6 max-w-xl">
                        Get flat 20% discount on all orders. Free shipping applied automatically at checkout!
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="products.php" 
                            class="px-6 py-3 bg-white text-slate-900 hover:bg-slate-100 font-bold text-sm rounded-xl shadow-lg transition-all">
                            Grab Deal Now
                        </a>
                        <span class="text-xs text-primary-200">Use coupon: <strong class="text-white font-mono">SAVE20</strong></span>
                    </div>
                </div>

                <div class="md:col-span-4 flex justify-center md:justify-end">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-2xl text-center w-full max-w-xs">
                        <span class="text-xs font-semibold uppercase tracking-wider text-primary-200">Hurry Up! Offer Ends Soon</span>
                        <div class="flex items-center justify-center gap-3 mt-4 text-center">
                            <div class="bg-slate-900/60 rounded-xl p-2.5 min-w-[55px]">
                                <span class="block text-xl font-bold text-white">12</span>
                                <span class="text-[10px] text-slate-400 uppercase">Hours</span>
                            </div>
                            <span class="text-xl font-bold">:</span>
                            <div class="bg-slate-900/60 rounded-xl p-2.5 min-w-[55px]">
                                <span class="block text-xl font-bold text-white">45</span>
                                <span class="text-[10px] text-slate-400 uppercase">Mins</span>
                            </div>
                            <span class="text-xl font-bold">:</span>
                            <div class="bg-slate-900/60 rounded-xl p-2.5 min-w-[55px]">
                                <span class="block text-xl font-bold text-white">30</span>
                                <span class="text-[10px] text-slate-400 uppercase">Secs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Background subtle glow -->
            <div class="absolute -right-16 -top-16 w-80 h-80 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        </div>
    </div>
</section>

<!-- 6. Customer Testimonials -->
<section class="py-16 bg-white">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-wider text-primary-600 bg-primary-50 px-3 py-1 rounded-full">Testimonials</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Loved by Thousands of Shoppers</h2>
            <p class="text-slate-500 text-sm mt-1">Here is what our verified buyers say about their shopping experience.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Review 1 -->
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center text-yellow-400 gap-1 mb-4">
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-700 text-sm leading-relaxed mb-6">
                        "Ordered wireless headphones and received them the next day in Cairo. The packaging was immaculate and the sound quality is incredible."
                    </p>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-slate-200/60">
                    <div class="w-10 h-10 rounded-full bg-primary-600 text-white flex items-center justify-center font-bold text-sm">
                        M
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Mahmoud Hassan</h4>
                        <span class="text-xs text-green-600 flex items-center gap-1"><i class="fa-solid fa-circle-check text-[10px]"></i> Verified Buyer</span>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center text-yellow-400 gap-1 mb-4">
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-700 text-sm leading-relaxed mb-6">
                        "The checkout process was super fast and smooth. Cash on Delivery gave me total confidence. Will definitely shop here again!"
                    </p>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-slate-200/60">
                    <div class="w-10 h-10 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold text-sm">
                        N
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Nour El-Din</h4>
                        <span class="text-xs text-green-600 flex items-center gap-1"><i class="fa-solid fa-circle-check text-[10px]"></i> Verified Buyer</span>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex flex-col justify-between">
                <div>
                    <div class="flex items-center text-yellow-400 gap-1 mb-4">
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                        <i class="fa-solid fa-star text-sm"></i>
                    </div>
                    <p class="text-slate-700 text-sm leading-relaxed mb-6">
                        "Great customer support. I had a question regarding delivery time and they replied immediately within 15 minutes. 10/10 service!"
                    </p>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-slate-200/60">
                    <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">
                        Y
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Yasmine Tarek</h4>
                        <span class="text-xs text-green-600 flex items-center gap-1"><i class="fa-solid fa-circle-check text-[10px]"></i> Verified Buyer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. Newsletter / Subscribe CTA -->
<section class="py-12 bg-slate-900 text-white">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 border border-slate-700 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-xl text-center md:text-left">
                <span class="text-xs font-bold uppercase tracking-wider text-primary-400">Join Our Newsletter</span>
                <h3 class="text-2xl sm:text-3xl font-extrabold mt-1">Get 10% Off Your First Order</h3>
                <p class="text-slate-400 text-sm mt-2">Subscribe to receive exclusive weekly offers, product drops, and flash discounts directly in your inbox.</p>
            </div>

            <div class="w-full md:w-auto flex-1 max-w-md">
                <form action="contact.php" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input type="email" placeholder="Enter your email address..." required
                        class="bg-slate-700/80 border border-slate-600 text-white text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 block w-full p-3 placeholder-slate-400">
                    <button type="submit"
                        class="px-6 py-3 text-sm font-bold text-white bg-primary-600 hover:bg-primary-500 rounded-xl shadow-md transition-colors whitespace-nowrap">
                        Subscribe
                    </button>
                </form>
                <span class="block text-[11px] text-slate-500 mt-2 text-center md:text-left">No spam guaranteed. Unsubscribe anytime.</span>
            </div>
        </div>
    </div>
</section>