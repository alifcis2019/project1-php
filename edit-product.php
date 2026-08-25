<?php
include_once './helper/functions.php';
// 1. Tell the app which page this is!
$currentPage = 'Edit Product';

if (!is_admin()) {
    set_flash_message('error', 'Access denied. Only administrators can access this page.');
    header('Location: index.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;
$productDetail = null;

$products = get_products();
$details = get_products_details();

foreach ($products as $p) {
    if ($p['id'] == $id) {
        $product = $p;
        break;
    }
}

foreach ($details as $d) {
    if ($d['id'] == $id) {
        $productDetail = $d;
        break;
    }
}

if (!$product || !$productDetail) {
    set_flash_message('error', 'Product not found.');
    header('Location: products.php');
    exit;
}

$currentPriceClean = (float) preg_replace('/[^0-9.]/', '', $product['priceDisplay']);
$origPriceClean = !empty($product['originalPriceDisplay']) ? (float) preg_replace('/[^0-9.]/', '', $product['originalPriceDisplay']) : '';

include './inc/header.php';
include './views/edit-product.php';
include './inc/footer.php';
