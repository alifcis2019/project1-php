<?php
$currentPage = 'Profile';
include_once './helper/functions.php';

if (!isLoggedIn()) {
    set_flash_message('warning', 'Please log in to view your profile.');
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update_profile') {
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $city = trim($_POST['city'] ?? '');

        if (empty($name)) {
            set_flash_message('error', 'Full name is required.');
        }

        if (!has_flash()) {
            $users = json_decode(file_get_contents('./database/users.json'), true);
            foreach ($users as &$u) {
                if ($u['id'] == $user['id']) {
                    $u['name'] = $name;
                    $u['phone'] = $phone;
                    $u['address'] = $address;
                    $u['city'] = $city;
                    $_SESSION['user'] = $u;
                    break;
                }
            }
            file_put_contents('./database/users.json', json_encode($users, JSON_PRETTY_PRINT));
            set_flash_message('success', 'Profile updated successfully!');
            header('Location: profile.php');
            exit;
        }
    } elseif ($action === 'change_password') {
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $isPasswordValid = false;
        if (isset($user['password'])) {
            if (password_verify($currentPassword, $user['password']) || $user['password'] === $currentPassword) {
                $isPasswordValid = true;
            }
        }

        if (!$isPasswordValid) {
            set_flash_message('error', 'Current password is incorrect.');
        }

        if (empty($newPassword)) {
            set_flash_message('error', 'New password cannot be empty.');
        } elseif (strlen($newPassword) < 6) {
            set_flash_message('error', 'New password must be at least 6 characters long.');
        } elseif ($newPassword !== $confirmPassword) {
            set_flash_message('error', 'New passwords do not match.');
        }

        if (!has_flash()) {
            $users = json_decode(file_get_contents('./database/users.json'), true);
            foreach ($users as &$u) {
                if ($u['id'] == $user['id']) {
                    $u['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                    $_SESSION['user'] = $u;
                    break;
                }
            }
            file_put_contents('./database/users.json', json_encode($users, JSON_PRETTY_PRINT));
            set_flash_message('success', 'Password updated successfully!');
            header('Location: profile.php');
            exit;
        }
    }
}

$userOrders = [];
if (file_exists('./database/orders.json')) {
    $orders = json_decode(file_get_contents('./database/orders.json'), true) ?: [];
    foreach ($orders as $order) {
        if ((isset($order['user_id']) && $order['user_id'] == $user['id']) || 
            (isset($order['customer']['email']) && $order['customer']['email'] == $user['email'])) {
            $userOrders[] = $order;
        }
    }
    $userOrders = array_reverse($userOrders);
}

include './inc/header.php';
include './views/profile.php';
include './inc/footer.php';
