<?php
// Ensure functions are loaded and session is started
include_once './helper/functions.php';

// Safely get cart items from the session
$cartItems = $_SESSION['cart'] ?? [];
$allProducts = get_products();

$subtotal = 0;
$totalItems = array_sum($cartItems);
?>

<!-- Cart Drawer Component -->
<div id="drawer-cart"
    class="fixed top-0 right-0 z-40 h-screen p-4 transition-transform translate-x-full bg-white w-80 lg:w-96 flex flex-col shadow-2xl"
    tabindex="-1" aria-labelledby="drawer-cart-label">

    <!-- Drawer Header -->
    <div class="flex items-center justify-between mb-6">
        <h5 id="drawer-cart-label" class="inline-flex items-center text-lg font-semibold text-gray-900">
            <svg class="w-5 h-5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 18 21">
                <path
                    d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.184.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
            </svg>
            Your Cart (<?= $totalItems ?>)
        </h5>
        <button type="button" data-drawer-hide="drawer-cart" aria-controls="drawer-cart"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center transition-colors">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>

    <!-- Drawer Body (Products) -->
    <div class="flex-1 overflow-y-auto flex flex-col gap-5 pr-1">
        <?php if (empty($cartItems)): ?>

            <!-- Empty Cart State -->
            <div class="flex flex-col items-center justify-center h-full text-center opacity-70">
                <svg class="w-16 h-16 text-slate-300 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                </svg>
                <p class="text-slate-500 font-medium text-sm">Your cart is currently empty.</p>
            </div>

        <?php else: ?>

            <!-- Dynamically Loaded Products -->
            <?php foreach ($cartItems as $productId => $quantity): ?>
                <?php
                // Find the product details in the JSON array
                $product = null;
                foreach ($allProducts as $p) {
                    if ($p['id'] == $productId) {
                        $product = $p;
                        break;
                    }
                }

                if ($product):
                    // Extract numeric price safely (removes '$' so we can do math)
                    $priceString = explode('-', $product['priceDisplay'])[0]; // Takes first price if it's a range
                    $numericPrice = (float) preg_replace('/[^0-9.]/', '', $priceString);

                    // Calculate subtotal
                    $subtotal += ($numericPrice * $quantity);
                ?>
                    <div class="flex items-center gap-4">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                            class="w-16 h-16 rounded-lg object-cover border border-gray-100">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate"><?= htmlspecialchars($product['name']) ?></p>

                            <div class="flex items-center gap-1 mt-1">
                                <p class="text-sm font-bold text-gray-900"><?= htmlspecialchars($product['priceDisplay']) ?></p>
                                <span class="text-xs text-gray-400">x<?= $quantity ?></span>
                            </div>
                        </div>

                        <!-- Remove from Cart Action -->
                        <a href="./actions/remove-from-cart.php?id=<?= $productId ?>"
                            class="text-red-500 hover:text-red-700 p-2 transition-colors focus:outline-none" title="Remove item">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>

    <!-- Drawer Footer (Checkout) -->
    <div class="mt-auto pt-5 border-t border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <span class="text-base font-semibold text-gray-900">Subtotal</span>
            <!-- Render formatted subtotal -->
            <span class="text-base font-bold text-gray-900">$<?= number_format($subtotal, 2) ?></span>
        </div>

        <a href="checkout.php"
            class="flex items-center justify-center w-full px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 transition-colors <?= empty($cartItems) ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' ?>">
            Proceed to Checkout
        </a>

        <button type="button" data-drawer-hide="drawer-cart"
            class="flex items-center justify-center w-full px-5 py-2.5 mt-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-primary-600 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 transition-colors">
            Continue Shopping
        </button>
    </div>

</div>