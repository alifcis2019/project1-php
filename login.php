<?php
include_once './helper/functions.php';
// 1. Tell the app which page this is!
$currentPage = 'Login';
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    if (empty($email)) {
        set_flash_message('error', 'Email is required');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_flash_message('error', 'Email is not valid');
    }

    if (empty($password)) {
        set_flash_message('error', 'Password is required');
    }

    if (!has_flash()) {
        $user = get_user_by_email($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;

            // Load and merge user cart
            $savedCart = get_user_saved_cart($user['id']);
            $guestCart = $_SESSION['cart'] ?? [];

            foreach ($guestCart as $productId => $qty) {
                if (isset($savedCart[$productId])) {
                    $savedCart[$productId] += $qty;
                } else {
                    $savedCart[$productId] = $qty;
                }
            }

            $_SESSION['cart'] = $savedCart;
            save_user_cart($user['id'], $_SESSION['cart']);

            set_flash_message('success', 'Login successful');
            header('Location: index.php');
            exit;
        } else {
            set_flash_message('error', 'Invalid email or password');
        }
    }
}

include './inc/header.php';
include './views/login.php';
include './inc/footer.php';