<?php
include_once './helper/functions.php';
$flash_messages = get_flash_messages();

if (!empty($flash_messages)) :
?>
    <div class="fixed top-20 right-4 z-50 flex flex-col gap-3 w-full max-w-sm">

        <?php foreach ($flash_messages as $index => $flash) :
            $icon_color = 'text-blue-500';
            $icon_path = 'M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z';
            $bg_color = 'bg-blue-100';

            switch ($flash['type']) {
                case 'success':
                    $icon_color = 'text-green-500';
                    $bg_color = 'bg-green-100';
                    $icon_path = 'M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z';
                    break;
                case 'error':
                    $icon_color = 'text-red-500';
                    $bg_color = 'bg-red-100';
                    $icon_path = 'm15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z';
                    break;
            }
        ?>

            <div id="toast-<?php echo $index; ?>"
                class="flex items-center gap-2 w-full p-4 text-slate-600 <?php echo $bg_color; ?> rounded-lg shadow-md border border-gray-200 transition-all duration-300"
                role="alert">

                <svg class="w-6 h-6 <?php echo $icon_color; ?> shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="<?php echo $icon_path; ?>" />
                </svg>

                <div class="ms-2.5 text-sm font-medium border-s border-gray-200 ps-3.5 text-slate-800">
                    <?php echo htmlspecialchars($flash['message']); ?>
                </div>

                <button type="button"
                    class="ms-auto flex items-center justify-center text-gray-400 hover:text-gray-900 bg-transparent hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 rounded-lg p-1.5 h-8 w-8 transition-colors focus:outline-none"
                    data-dismiss-target="#toast-<?php echo $index; ?>" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </button>

            </div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>