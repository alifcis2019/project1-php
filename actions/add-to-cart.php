<?php
include_once '../helper/functions.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
function add_to_cart($id)
{
    // Check if the product is already in the cart
    if (array_key_exists($id, $_SESSION['cart'])) {
        set_flash_message('warning', 'Product is already in the cart');
    } else {
        // FIX 1: Assign a quantity of 1 to this product ID
        $_SESSION['cart'][$id] = 1;

        // Optional: Add a success toast here!
        set_flash_message('success', 'Product added to cart successfully!');
    }
}

// FIX 2: Check if the ID exists in the URL before processing
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Cast to integer for security
    add_to_cart((int)$_GET['id']);
}


// FIX 3: Redirect the user back to where they came from
// $_SERVER['HTTP_REFERER'] remembers the previous page. We fall back to index.php just in case.
$redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../index.php';
header("Location: " . $redirectUrl);
exit; // Always call exit after a redirect