<?php
include_once './functions/function.php';
?>
<nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <!-- Logo Area -->
        <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-xl text-gray-900 font-bold whitespace-nowrap">My App</span>
        </a>

        <!-- User Menu & Mobile Toggle -->
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <?php if (isLoggedIn()) : ?>
                <button type="button" class="flex text-sm bg-white rounded-full md:me-0 focus:ring-4 focus:ring-gray-200"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">U
                    </div>
                </button>

                <span class="hidden md:inline-block text-gray-900 font-medium ms-2">
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden bg-white border border-gray-200 rounded-lg shadow-lg w-44" id="user-dropdown">
                        <div class="px-4 py-3 text-sm border-b border-gray-200">
                            <span class="block text-gray-500 truncate">
                                <?= $_SESSION['user']['email']; ?>
                            </span>
                        </div>
                        <ul class="p-2 text-sm text-gray-500 font-medium" aria-labelledby="user-menu-button">
                            <li>
                                <a href="profile.php"
                                    class="inline-flex items-center w-full p-2 hover:bg-gray-100 hover:text-gray-900 rounded-md">Profile</a>
                            </li>
                            <li>
                                <!-- You can point this to a logout script -->
                                <a href="logout.php"
                                    class="inline-flex items-center w-full p-2 hover:bg-gray-100 hover:text-gray-900 rounded-md border-t border-gray-100 mt-1 pt-3">Sign
                                    out</a>
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
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
        </div>


        <?php if (!isLoggedIn()) : ?>
            <!-- Main Navigation Links -->
            <div class="items-center justify-between hidden w-full md:w-auto md:order-1" id="navbar-user">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="login.php"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Login</a>
                    </li>
                    <li>
                        <a href="register.php"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Register</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>

    </div>
</nav>