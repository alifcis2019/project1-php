<?php
include_once './helper/functions.php';

// Catch the variable from the parent file. Fallback to 'Home' if missing.
$currentPage = $currentPage ?? 'Home';

// Define the navigation links dynamically
$navLinks = [
    ['title' => 'Home', 'url' => 'index.php', 'active' => $currentPage === 'Home'],
    ['title' => 'Products', 'url' => 'products.php', 'active' => $currentPage === 'Products'],
    ['title' => 'Create Product', 'url' => 'create-product.php', 'active' => $currentPage === 'Create Product'],
    ['title' => 'About', 'url' => 'about.php', 'active' => $currentPage === 'About'],
    ['title' => 'Contact', 'url' => 'contact.php', 'active' => $currentPage === 'Contact'],
];

// Ensure functions are loaded and session is started
include_once './helper/functions.php';

// Safely get cart items from the session
$cartItems = $_SESSION['cart'] ?? [];
$allProducts = get_products();

$subtotal = 0;
$totalItems = array_sum($cartItems);
?>
<!-- Navbar -->
<nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <!-- Logo Area -->
        <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-xl text-gray-900 font-medium whitespace-nowrap">EraaSoft PMS</span>
        </a>

        <!-- Right Side: Cart & Mobile Toggle -->
        <div class="flex items-center gap-2 md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

            <!-- Cart Button Trigger -->
            <button type="button" data-drawer-target="drawer-cart" data-drawer-show="drawer-cart"
                data-drawer-placement="right" aria-controls="drawer-cart"
                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-700 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 transition-colors">
                <svg class="w-4 h-4 me-2 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 18 21">
                    <path
                        d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.184.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                </svg>
                Cart
                <span
                    class="inline-flex items-center justify-center w-5 h-5 ms-2 text-xs font-semibold text-white bg-gray-800 rounded-full">
                    <?php
                    echo $totalItems;
                    ?>
                </span>
            </button>

            <!-- User Menu & Mobile Toggle -->
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <?php if (isLoggedIn()) : 
                    $userInitial = strtoupper(substr($_SESSION['user']['name'] ?? $_SESSION['user']['email'] ?? 'U', 0, 1));
                ?>
                <button type="button"
                    class="flex items-center text-sm bg-white rounded-full focus:ring-4 focus:ring-gray-200"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <div
                        class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                        <?= $userInitial ?>
                    </div>
                </button>

                <!-- Dropdown menu -->
                <div class="z-50 hidden bg-white border border-gray-200 rounded-xl shadow-xl w-48 py-1"
                    id="user-dropdown">
                    <div class="px-4 py-3 text-sm border-b border-gray-100">
                        <span class="block font-semibold text-gray-900 truncate">
                            <?= htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?>
                        </span>
                        <span class="block text-xs text-gray-500 truncate mt-0.5">
                            <?= htmlspecialchars($_SESSION['user']['email']) ?>
                        </span>
                    </div>
                    <ul class="p-1 text-sm text-gray-700 font-medium" aria-labelledby="user-menu-button">
                        <li>
                            <a href="profile.php"
                                class="flex items-center gap-2 w-full p-2.5 hover:bg-gray-50 hover:text-primary-600 rounded-lg transition-colors">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a href="logout.php"
                                class="flex items-center gap-2 w-full p-2.5 text-red-600 hover:bg-red-50 rounded-lg border-t border-gray-100 mt-1 transition-colors">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Sign out
                            </a>
                        </li>
                    </ul>
                </div>
                <?php else : ?>
                <a href="login.php"
                    class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 transition-colors duration-200 shadow-sm">
                    Login
                </a>
                <?php endif; ?>
                    <!-- Mobile Menu Hamburger -->
                    <button data-collapse-toggle="navbar-user" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        aria-controls="navbar-user" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="M5 7h14M5 12h14M5 17h14" />
                        </svg>
                    </button>
            </div>


            <!-- Mobile Menu Hamburger -->
            <button data-collapse-toggle="navbar-main" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ms-3"
                aria-controls="navbar-main" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <!-- Center: Main Navigation Links -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-main">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">

                <?php foreach ($navLinks as $link): ?>
                <li>
                    <a href="<?= htmlspecialchars($link['url']) ?>"
                        class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 transition-colors duration-200 
                                  <?= $link['active'] ? 'text-primary-600 md:text-primary-700 font-semibold' : 'text-slate-600 hover:text-primary-600 md:hover:text-primary-600' ?>">
                        <?= htmlspecialchars($link['title']) ?>
                    </a>
                </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</nav>

<?php include 'carts.php'; ?>