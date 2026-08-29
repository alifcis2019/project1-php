<?php
include_once './helper/functions.php';
// 1. Tell the app which page this is!
$currentPage = 'Register';
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($email)) {
        set_flash_message('error', 'Email is required');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_flash_message('error', 'Please enter a valid email address');
    } elseif (get_user_by_email($email)) {
        set_flash_message('error', 'This email is already registered');
    }

    if (empty($password)) {
        set_flash_message('error', 'Password is required');
    } elseif (strlen($password) < 6) {
        set_flash_message('error', 'Password must be at least 6 characters long');
    } elseif ($password !== $confirm_password) {
        set_flash_message('error', 'Passwords do not match');
    }

    if (!has_flash()) {
        $users = [];
        if (file_exists('./database/users.json')) {
            $file_content = file_get_contents('./database/users.json');
            if (!empty($file_content)) {
                $users = json_decode($file_content, true);
            }
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $users[] = [
            'id' => uniqid(),
            'email' => $email,
            'password' => $hashed_password,
            'role' => 'user'
        ];

        file_put_contents('./database/users.json', json_encode($users, JSON_PRETTY_PRINT));

        set_flash_message('success', 'Registration successful! You can now log in.');
        header('Location: login.php');
        exit;
    }
}
include './inc/header.php';
include './views/register.php';
include './inc/footer.php';