<?php
// Catch the variable from the parent file. Fallback to 'Home' if missing.
$currentPage = $currentPage ?? 'Home';

// Define the footer links
$footerLinks = [
    ['title' => 'About', 'url' => 'about.php', 'active' => $currentPage === 'About'],
    ['title' => 'Contact', 'url' => 'contact.php', 'active' => $currentPage === 'Contact'],
];
?>
</main>

<footer class="bg-white rounded-2xl shadow-sm border border-slate-200 m-4 mt-auto">
    <div class="w-full max-w-7xl mx-auto p-4 md:py-8">
        <div class="sm:flex w-full sm:items-center sm:justify-between">

            <a href="index.php" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse group">
                <!-- Decorative Icon using Primary Theme -->
                <div
                    class="w-8 h-8 bg-primary-600 group-hover:bg-primary-700 transition-colors rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14v4m-4 1h8M1 10h18M2 1h16a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                    </svg>
                </div>
                <span class="self-center text-2xl font-bold text-slate-900 tracking-tight whitespace-nowrap">EraaSoft
                    PMS</span>
            </a>

            <!-- Footer Links -->
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-slate-500 sm:mb-0">
                <?php
                $totalLinks = count($footerLinks);
                foreach ($footerLinks as $index => $link):
                    // Add margin-right to all items EXCEPT the very last one
                    $marginClass = ($index < $totalLinks - 1) ? 'me-4 md:me-6' : '';

                    // If active, make it primary colored and bold. Otherwise, keep it slate with a hover effect.
                    $activeClass = $link['active'] ? 'text-primary-600 font-semibold' : 'hover:text-primary-600';
                ?>
                <li>
                    <a href="<?= htmlspecialchars($link['url']) ?>"
                        class="transition-colors duration-200 <?= $marginClass ?> <?= $activeClass ?>">
                        <?= htmlspecialchars($link['title']) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <hr class="my-6 border-slate-100 sm:mx-auto lg:my-8" />

        <!-- Copyright Section -->
        <span class="block text-sm text-slate-500 sm:text-center">
            © <?= date('Y') ?> <a href="index.php"
                class="hover:text-primary-600 font-medium transition-colors duration-200">EraaSoft PMS™</a>. All Rights
            Reserved.
        </span>
    </div>
</footer>

<!-- Flowbite JS (Corrected CDN Version) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>