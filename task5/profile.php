<?php
include_once './functions/function.php';
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
include './inc/header.php';
include './views/profile.php';
include './inc/footer.php';