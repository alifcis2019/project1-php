<?php
include_once './functions/function.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$email = htmlspecialchars($user['email']);
$userId = htmlspecialchars($user['id']);

$initial = strtoupper(substr($email, 0, 1));

?>

<!-- Profile Page Content -->
<div class="min-h-screen bg-gray-50 pt-24 pb-12 px-4">
    <div class="max-w-3xl mx-auto">

        <!-- Profile Card -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

            <!-- Header Section -->
            <div class="bg-blue-600 px-6 py-8 text-center sm:text-left sm:flex sm:items-center sm:space-x-6">
                <!-- Avatar -->
                <div
                    class="inline-flex items-center justify-center w-24 h-24 bg-white text-blue-600 rounded-full text-4xl font-bold border-4 border-white shadow-sm flex-shrink-0 mx-auto sm:mx-0">
                    <?php echo $initial; ?>
                </div>
                <!-- User Title -->
                <div class="mt-4 sm:mt-0 text-white">
                    <h1 class="text-2xl font-bold"><?php echo explode('@', $email)[0]; ?></h1>
                    <!-- بيعرض الجزء اللي قبل @ كاسم -->
                    <p class="text-blue-100 text-sm mt-1">Member Account</p>
                </div>
            </div>

            <!-- User Details Section -->
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-100 pb-2">Account Information
                </h3>

                <dl class="divide-y divide-gray-100">

                    <!-- Email Row -->
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex justify-between items-center">
                            <span><?php echo $email; ?></span>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-200">Verified</span>
                        </dd>
                    </div>

                    <!-- User ID Row -->
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Account ID</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <code
                                class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs"><?php echo $userId; ?></code>
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Actions Section -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-end space-x-3">
                <a href="logout.php"
                    class="px-4 py-2 text-sm font-medium text-red-600 bg-white border border-gray-300 rounded-lg hover:bg-red-50 focus:ring-4 focus:ring-red-100 transition-colors duration-200">
                    Sign Out
                </a>
            </div>

        </div>
    </div>
</div>