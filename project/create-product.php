<?php
include_once './helper/functions.php';
// 1. Tell the app which page this is!
$currentPage = 'Create Product';

if (!is_admin()) {
    set_flash_message('error', 'Access denied. Only administrators can access this page.');
    header('Location: index.php');
    exit;
}

include './inc/header.php';
include './views/create-product.php';
include './inc/footer.php';