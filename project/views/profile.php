<?php
include_once './helper/functions.php';

$user = $_SESSION['user'] ?? [];
$userName = $user['name'] ?? explode('@', $user['email'] ?? 'User')[0];
$userEmail = $user['email'] ?? '';
$userRole = $user['role'] ?? 'Customer';
$userPhone = $user['phone'] ?? '';
$userAddress = $user['address'] ?? '';
$userCity = $user['city'] ?? '';
$userOrders = $userOrders ?? [];

$totalOrdersCount = count($userOrders);
$totalSpent = 0;
foreach ($userOrders as $ord) {
    $priceNum = (float) preg_replace('/[^0-9.]/', '', $ord['total'] ?? '0');
    $totalSpent += $priceNum;
}

$adminMessages = $adminMessages ?? [];
$totalMessagesCount = count($adminMessages);

$initials = strtoupper(substr($userName, 0, 2));
?>

<div class="max-w-screen-xl mx-auto p-4 py-8">
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="index.php" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-primary-600">Home</a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2">My Profile</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header Banner -->
    <div class="bg-white rounded-2xl p-6 mb-8 border border-slate-200 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div class="w-20 h-20 rounded-full bg-primary-600 text-white flex items-center justify-center text-3xl font-extrabold shadow-md shrink-0">
                <?= $initials ?>
            </div>
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900"><?= htmlspecialchars($userName) ?></h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $userRole === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' ?>">
                        <?= ucfirst(htmlspecialchars($userRole)) ?>
                    </span>
                </div>
                <p class="text-sm text-slate-500 mt-1"><?= htmlspecialchars($userEmail) ?></p>
            </div>
        </div>

        <div class="flex items-center gap-4 w-full md:w-auto justify-around md:justify-end border-t md:border-t-0 pt-4 md:pt-0 border-slate-100">
            <div class="text-center px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                <span class="block text-2xl font-extrabold text-slate-900"><?= $totalOrdersCount ?></span>
                <span class="text-xs text-slate-500 font-medium">Total Orders</span>
            </div>
            <div class="text-center px-4 py-2 bg-slate-50 rounded-xl border border-slate-100">
                <span class="block text-2xl font-extrabold text-primary-600">$<?= number_format($totalSpent, 2) ?></span>
                <span class="text-xs text-slate-500 font-medium">Total Spent</span>
            </div>
            <?php if (is_admin()): ?>
                <div class="text-center px-4 py-2 bg-blue-50 rounded-xl border border-blue-100">
                    <span class="block text-2xl font-extrabold text-blue-600"><?= $totalMessagesCount ?></span>
                    <span class="text-xs text-blue-600 font-medium">Messages</span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Profile Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- Tabs Navigation -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm sticky top-24">
                <ul class="space-y-1 font-medium" id="profile-tab" data-tabs-toggle="#profile-tab-content" role="tablist">
                    <li>
                        <button class="flex items-center gap-3 w-full p-3 text-sm rounded-xl text-left font-semibold text-primary-600 bg-primary-50"
                            id="profile-tab-btn" data-tabs-target="#profile-info" type="button" role="tab" aria-controls="profile-info" aria-selected="true">
                            <span>Profile Information</span>
                        </button>
                    </li>
                    <li>
                        <button class="flex items-center gap-3 w-full p-3 text-sm rounded-xl text-left text-slate-600 hover:bg-slate-50"
                            id="orders-tab-btn" data-tabs-target="#orders-history" type="button" role="tab" aria-controls="orders-history" aria-selected="false">
                            <span>My Orders</span>
                            <?php if ($totalOrdersCount > 0): ?>
                                <span class="ms-auto bg-slate-100 text-slate-700 text-xs font-semibold px-2 py-0.5 rounded-full"><?= $totalOrdersCount ?></span>
                            <?php endif; ?>
                        </button>
                    </li>
                    <?php if (is_admin()): ?>
                        <li>
                            <button class="flex items-center gap-3 w-full p-3 text-sm rounded-xl text-left text-slate-600 hover:bg-slate-50"
                                id="messages-tab-btn" data-tabs-target="#messages-tab" type="button" role="tab" aria-controls="messages-tab" aria-selected="false">
                                <span>Customer Messages</span>
                                <?php if ($totalMessagesCount > 0): ?>
                                    <span class="ms-auto bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded-full"><?= $totalMessagesCount ?></span>
                                <?php endif; ?>
                            </button>
                        </li>
                    <?php endif; ?>
                    <li>
                        <button class="flex items-center gap-3 w-full p-3 text-sm rounded-xl text-left text-slate-600 hover:bg-slate-50"
                            id="security-tab-btn" data-tabs-target="#security-tab" type="button" role="tab" aria-controls="security-tab" aria-selected="false">
                            <span>Security & Password</span>
                        </button>
                    </li>
                </ul>

                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="logout.php" class="flex items-center gap-3 w-full p-3 text-sm font-semibold rounded-xl text-red-600 hover:bg-red-50">
                        Sign Out
                    </a>
                </div>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="lg:col-span-8" id="profile-tab-content">

            <!-- TAB 1: Profile Info -->
            <div id="profile-info" role="tabpanel" aria-labelledby="profile-tab-btn">
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">Personal Information</h2>

                    <form action="profile.php" method="POST">
                        <input type="hidden" name="action" value="update_profile">

                        <div class="grid gap-6 sm:grid-cols-2 mb-6">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-slate-900">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" required
                                    value="<?= htmlspecialchars($userName) ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-slate-900">Email Address</label>
                                <input type="email" id="email" disabled
                                    value="<?= htmlspecialchars($userEmail) ?>"
                                    class="bg-slate-100 border border-slate-200 text-slate-500 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed">
                            </div>

                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-slate-900">Phone Number</label>
                                <input type="tel" id="phone" name="phone"
                                    value="<?= htmlspecialchars($userPhone) ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label for="city" class="block mb-2 text-sm font-medium text-slate-900">City</label>
                                <input type="text" id="city" name="city"
                                    value="<?= htmlspecialchars($userCity) ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="address" class="block mb-2 text-sm font-medium text-slate-900">Address</label>
                                <input type="text" id="address" name="address"
                                    value="<?= htmlspecialchars($userAddress) ?>"
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>
                        </div>

                        <button type="submit"
                            class="text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-lg text-sm px-6 py-2.5">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>

            <!-- TAB 2: Orders -->
            <div class="hidden" id="orders-history" role="tabpanel" aria-labelledby="orders-tab-btn">
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">Order History</h2>

                    <?php if (empty($userOrders)): ?>
                        <div class="text-center py-12">
                            <p class="text-sm text-slate-500 mb-4">No orders placed yet.</p>
                            <a href="products.php" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-lg hover:bg-primary-700">
                                Start Shopping
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-6">
                            <?php foreach ($userOrders as $order): ?>
                                <div class="border border-slate-200 rounded-xl p-5">
                                    <div class="flex flex-wrap items-center justify-between gap-3 pb-3 border-b border-slate-100 text-sm">
                                        <div>
                                            <span class="font-bold text-slate-900">#<?= htmlspecialchars($order['id'] ?? 'ORD') ?></span>
                                            <span class="text-slate-400 mx-2">&bull;</span>
                                            <span class="text-slate-500 text-xs"><?= htmlspecialchars($order['created_at'] ?? '') ?></span>
                                        </div>
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                            <?= htmlspecialchars($order['status'] ?? 'Processing') ?>
                                        </span>
                                    </div>

                                    <div class="py-4 space-y-3">
                                        <?php if (isset($order['items']) && is_array($order['items'])): ?>
                                            <?php foreach ($order['items'] as $item): ?>
                                                <div class="flex items-center gap-3">
                                                    <?php if (!empty($item['image'])): ?>
                                                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Product') ?>"
                                                            class="w-12 h-12 rounded-lg object-cover border border-slate-100 shrink-0">
                                                    <?php endif; ?>
                                                    <div class="flex-1 min-w-0">
                                                        <h4 class="text-sm font-semibold text-slate-900 truncate"><?= htmlspecialchars($item['name'] ?? 'Product') ?></h4>
                                                        <span class="text-xs text-slate-500">Qty: <?= $item['quantity'] ?? 1 ?> &times; <?= $item['price'] ?? '' ?></span>
                                                    </div>
                                                    <div class="text-sm font-bold text-slate-900">
                                                        <?= $item['total'] ?? '' ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex items-center justify-between pt-3 border-t border-slate-100 text-sm">
                                        <div class="text-xs text-slate-500">
                                            <span>Address: <strong><?= htmlspecialchars(($order['customer']['address'] ?? '') . ', ' . ($order['customer']['city'] ?? '')) ?></strong></span>
                                        </div>
                                        <div class="text-base font-extrabold text-primary-600">
                                            Total: <?= htmlspecialchars($order['total'] ?? '') ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (is_admin()): ?>
                <!-- TAB: Customer Messages (Admin Only) -->
                <div class="hidden" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab-btn">
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">Customer Messages</h2>
                                <p class="text-xs text-slate-500 mt-1">Inquiries submitted through the Contact Us page</p>
                            </div>
                            <span class="bg-slate-100 text-slate-700 text-xs font-semibold px-3 py-1 rounded-full">
                                Total: <?= $totalMessagesCount ?>
                            </span>
                        </div>

                        <?php if (empty($adminMessages)): ?>
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <p class="text-sm font-medium text-slate-900 mb-1">No messages yet</p>
                                <p class="text-xs text-slate-500">Customer inquiries will appear here.</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach ($adminMessages as $msg): ?>
                                    <div class="border border-slate-200 rounded-xl p-5 hover:border-slate-300 transition-colors bg-slate-50/50">
                                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-slate-900 text-sm"><?= htmlspecialchars($msg['name'] ?? 'Guest') ?></span>
                                                <span class="text-slate-300">&bull;</span>
                                                <a href="mailto:<?= htmlspecialchars($msg['email'] ?? '') ?>" class="text-xs text-primary-600 hover:underline">
                                                    <?= htmlspecialchars($msg['email'] ?? '') ?>
                                                </a>
                                            </div>
                                            <span class="text-xs text-slate-400">
                                                <i class="fa-regular fa-clock me-1"></i><?= htmlspecialchars($msg['created_at'] ?? '') ?>
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                <?= htmlspecialchars($msg['subject'] ?? 'General Inquiry') ?>
                                            </span>
                                        </div>
                                        <div class="text-sm text-slate-700 bg-white p-4 rounded-xl border border-slate-200 leading-relaxed whitespace-pre-line">
                                            <?= htmlspecialchars($msg['message'] ?? '') ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- TAB 3: Password -->
            <div class="hidden" id="security-tab" role="tabpanel" aria-labelledby="security-tab-btn">
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">Change Password</h2>

                    <form action="profile.php" method="POST">
                        <input type="hidden" name="action" value="change_password">

                        <div class="space-y-4 max-w-md mb-6">
                            <div>
                                <label for="current_password" class="block mb-2 text-sm font-medium text-slate-900">Current Password <span class="text-red-500">*</span></label>
                                <input type="password" id="current_password" name="current_password" required
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label for="new_password" class="block mb-2 text-sm font-medium text-slate-900">New Password <span class="text-red-500">*</span></label>
                                <input type="password" id="new_password" name="new_password" required
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label for="confirm_password" class="block mb-2 text-sm font-medium text-slate-900">Confirm Password <span class="text-red-500">*</span></label>
                                <input type="password" id="confirm_password" name="confirm_password" required
                                    class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            </div>
                        </div>

                        <button type="submit"
                            class="text-white bg-primary-600 hover:bg-primary-700 font-semibold rounded-lg text-sm px-6 py-2.5">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
