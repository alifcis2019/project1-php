<?php
// 1. Tell the app which page this is!
$currentPage = 'Checkout';

// check is loggen or not
include_once './helper/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
}

include './inc/header.php';
include './views/checkout.php';
include './inc/footer.php';