<?php
include_once './functions/function.php';
if (isLoggedIn()) {
    header('Location: profile.php');
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
            set_flash_message('success', 'Login successful');
            header('Location: profile.php');
            exit;
        } else {
            set_flash_message('error', 'Invalid email or password');
        }
    }
}

include './inc/header.php';
include './views/login.php';
include './inc/footer.php';
