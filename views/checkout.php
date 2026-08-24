<?php
include_once './helper/functions.php';

$cartItems = $_SESSION['cart'] ?? [];
$allProducts = get_products();
$subtotal = 0;
$items = [];

foreach ($cartItems as $productId => $quantity) {
    $product = null;
    foreach ($allProducts as $p) {
        if ($p['id'] == $productId) {
            $product = $p;
            break;
        }
    }
    if ($product) {
        $priceString = explode('-', $product['priceDisplay'])[0];
        $numericPrice = (float) preg_replace('/[^0-9.]/', '', $priceString);
        $itemTotal = $numericPrice * $quantity;
        $subtotal += $itemTotal;

        $items[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'image' => $product['image'],
            'priceDisplay' => $product['priceDisplay'],
            'quantity' => $quantity,
            'itemTotal' => '$' . number_format($itemTotal, 2)
        ];
    }
}

$shipping = $subtotal > 0 ? 10.00 : 0.00;
$total = $subtotal + $shipping;
$totalItems = array_sum($cartItems);

$userEmail = $_SESSION['user']['email'] ?? '';
$userName = $_SESSION['user']['name'] ?? '';
$nameParts = explode(' ', trim($userName), 2);
$firstName = $nameParts[0] ?? '';
$lastName = $nameParts[1] ?? '';
?>

<div class="max-w-screen-xl mx-auto p-4 py-8">

    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="index.php" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="products.php" class="ms-1 text-sm font-medium text-slate-700 hover:text-primary-600 md:ms-2">Products</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2">Checkout</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Title -->
    <div class="mb-8 border-b border-slate-200 pb-4">
        <h1 class="text-3xl font-extrabold text-slate-900">Checkout</h1>
        <p class="text-sm text-slate-500 mt-1">Please fill in your delivery information to complete your order.</p>
    </div>

    <?php if (empty($cartItems)): ?>

        <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-sm max-w-lg mx-auto my-12">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <h2 class="text-xl font-bold text-slate-900 mb-2">Your Cart is Empty</h2>
            <p class="text-slate-500 text-sm mb-6">Add products to your cart before proceeding to checkout.</p>
            <a href="products.php" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700">
                Browse Products
            </a>
        </div>

    <?php else: ?>

        <form action="checkout.php" method="POST">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Form Fields -->
                <div class="lg:col-span-8 flex flex-col gap-6">

                    <!-- Customer Info -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">1. Customer Information</h2>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-slate-900">First Name <span class="text-red-500">*</span></label>
                                <input type="text" id="first_name" name="first_name" required
                                    value="<?= htmlspecialchars($_POST['first_name'] ?? $firstName) ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="John">
                            </div>

                            <div>
                                <label for="last_name" class="block mb-2 text-sm font-medium text-slate-900">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" id="last_name" name="last_name" required
                                    value="<?= htmlspecialchars($_POST['last_name'] ?? $lastName) ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Doe">
                            </div>

                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-slate-900">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" required
                                    value="<?= htmlspecialchars($_POST['email'] ?? $userEmail) ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="name@example.com">
                            </div>

                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-slate-900">Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" id="phone" name="phone" required
                                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="01xxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">2. Shipping Address</h2>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="address" class="block mb-2 text-sm font-medium text-slate-900">Street Address <span class="text-red-500">*</span></label>
                                <input type="text" id="address" name="address" required
                                    value="<?= htmlspecialchars($_POST['address'] ?? '') ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="123 Main Street">
                            </div>

                            <div>
                                <label for="city" class="block mb-2 text-sm font-medium text-slate-900">City <span class="text-red-500">*</span></label>
                                <input type="text" id="city" name="city" required
                                    value="<?= htmlspecialchars($_POST['city'] ?? '') ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Cairo">
                            </div>

                            <div>
                                <label for="postal_code" class="block mb-2 text-sm font-medium text-slate-900">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code"
                                    value="<?= htmlspecialchars($_POST['postal_code'] ?? '') ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="11221">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="notes" class="block mb-2 text-sm font-medium text-slate-900">Order Notes (Optional)</label>
                                <textarea id="notes" name="notes" rows="3"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" placeholder="Special delivery notes..."><?= htmlspecialchars($_POST['notes'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">3. Payment Method</h2>
                        <div class="space-y-3">
                            <label class="flex items-center justify-between p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="cash_on_delivery" checked
                                        class="w-4 h-4 text-primary-600 bg-white border-slate-300">
                                    <div>
                                        <div class="font-semibold text-slate-900 text-sm">Cash on Delivery (COD)</div>
                                        <div class="text-xs text-slate-500">Pay cash upon delivery</div>
                                    </div>
                                </div>
                            </label>

                            <label class="flex items-center justify-between p-4 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="credit_card"
                                        class="w-4 h-4 text-primary-600 bg-white border-slate-300">
                                    <div>
                                        <div class="font-semibold text-slate-900 text-sm">Credit / Debit Card</div>
                                        <div class="text-xs text-slate-500">Visa, Mastercard</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm sticky top-24">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">
                            Order Summary (<?= $totalItems ?>)
                        </h2>

                        <div class="divide-y divide-slate-100 max-h-72 overflow-y-auto mb-4">
                            <?php foreach ($items as $item): ?>
                                <div class="py-3 flex items-center gap-3">
                                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                                        class="w-14 h-14 rounded-lg object-cover border border-slate-100 shrink-0">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-semibold text-slate-900 truncate"><?= htmlspecialchars($item['name']) ?></h4>
                                        <p class="text-xs text-slate-500 mt-0.5">Qty: <?= $item['quantity'] ?> &times; <?= $item['priceDisplay'] ?></p>
                                    </div>
                                    <div class="text-sm font-bold text-slate-900"><?= $item['itemTotal'] ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="border-t border-slate-100 pt-4 space-y-2 mb-6 text-sm">
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Subtotal</span>
                                <span class="font-medium text-slate-900">$<?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Shipping</span>
                                <span class="font-medium text-slate-900">$<?= number_format($shipping, 2) ?></span>
                            </div>
                            <div class="border-t border-dashed border-slate-200 pt-3 flex items-center justify-between text-base font-bold text-slate-900">
                                <span>Total</span>
                                <span class="text-primary-600 font-extrabold text-xl">$<?= number_format($total, 2) ?></span>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-lg text-sm px-5 py-3 transition-colors">
                            Place Order
                        </button>
                    </div>
                </div>

            </div>
        </form>

    <?php endif; ?>

</div>
