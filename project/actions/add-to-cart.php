<?php
include_once '../helper/functions.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function add_to_cart($id, $quantity = 1)
{
    $quantity = max(1, (int)$quantity);

    $productDetail = get_product_detail($id);
    if ($productDetail && isset($productDetail['stockStatus']) && $productDetail['stockStatus'] === 'Out of Stock') {
        set_flash_message('error', 'Sorry, this product is out of stock!');
        return;
    }

    if (array_key_exists($id, $_SESSION['cart'])) {
        $_SESSION['cart'][$id] += $quantity;
        set_flash_message('success', 'Product quantity updated in cart successfully!');
    } else {
        $_SESSION['cart'][$id] = $quantity;
        set_flash_message('success', 'Product added to cart successfully!');
    }

    if (isLoggedIn()) {
        save_user_cart($_SESSION['user']['id'], $_SESSION['cart']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if ($id > 0) {
        add_to_cart($id, $quantity);
    }
} elseif (isset($_GET['id']) && !empty($_GET['id'])) {
    add_to_cart((int)$_GET['id'], 1);
}

$redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../index.php';
header("Location: " . $redirectUrl);
exit;