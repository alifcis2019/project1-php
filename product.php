<?php
// 1. Get the product ID from the URL (default to 1 if missing for testing)
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// 2. Set the active page
$currentPage = 'Product';

// 3. Include components
include './inc/header.php';
include './views/product.php';
include './inc/footer.php';
