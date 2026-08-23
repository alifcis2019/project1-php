<?php
include_once '../helper/functions.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
function remove_from_cart($id)
{
    // Check if the product is already in the cart
    if (!array_key_exists($id, $_SESSION['cart'])) {
        set_flash_message('warning', 'Product isn\'t already in the cart');
    } else {
        // remove the product from the cart
        unset($_SESSION['cart'][$id]);
        // Optional: Add a success toast here!
        set_flash_message('success', 'Product removed from cart successfully!');
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Cast to integer for security
    remove_from_cart((int)$_GET['id']);
    //update_cart total;

}

$redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../index.php';
header("Location: " . $redirectUrl);
exit;
