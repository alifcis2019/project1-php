<?php
include_once '../helper/functions.php';

if (!is_admin()) {
    set_flash_message('error', 'Access denied. Only administrators can delete products.');
    header('Location: ../index.php');
    exit;
}

$productsFile = '../database/products.json';
$detailsFile = '../database/product_details.json';
$cartsFile = '../database/carts.json';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];

    // 1. Remove from products.json
    if (file_exists($productsFile)) {
        $products = json_decode(file_get_contents($productsFile), true) ?: [];
        $newProducts = array_values(array_filter($products, function($p) use ($id) {
            return $p['id'] != $id;
        }));
        file_put_contents($productsFile, json_encode($newProducts, JSON_PRETTY_PRINT));
    }

    // 2. Remove from product_details.json
    if (file_exists($detailsFile)) {
        $details = json_decode(file_get_contents($detailsFile), true) ?: [];
        $newDetails = array_values(array_filter($details, function($d) use ($id) {
            return $d['id'] != $id;
        }));
        file_put_contents($detailsFile, json_encode($newDetails, JSON_PRETTY_PRINT));
    }

    // 3. Clean up from session cart & database carts if present
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    if (file_exists($cartsFile)) {
        $carts = json_decode(file_get_contents($cartsFile), true) ?: [];
        foreach ($carts as $userId => &$uCart) {
            if (is_array($uCart) && isset($uCart[$id])) {
                unset($uCart[$id]);
            }
        }
        file_put_contents($cartsFile, json_encode($carts, JSON_PRETTY_PRINT));
    }

    set_flash_message('success', 'Product deleted successfully!');
}

header("Location: ../products.php");
exit;
