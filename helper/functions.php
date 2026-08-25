<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function set_flash_message($type, $message)
{
    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }

    $_SESSION['flash_messages'][] = [
        'type' => $type,
        'message' => $message
    ];
}

function has_flash()
{
    return isset($_SESSION['flash_messages']) && count($_SESSION['flash_messages']) > 0;
}

function get_flash_messages()
{
    if (has_flash()) {
        $messages = $_SESSION['flash_messages'];
        unset($_SESSION['flash_messages']);
        return $messages;
    }
    return [];
}


function is_admin()
{
    if (isLoggedIn() && isset($_SESSION['user']['role'])) {
        return $_SESSION['user']['role'] === 'admin';
    }
    return false;
}

function is_user()
{
    if (isLoggedIn() && isset($_SESSION['user']['role'])) {
        return $_SESSION['user']['role'] === 'user';
    }
    return false;
}


function get_user_by_email($email)
{
    if (!file_exists('./database/users.json')) return null;

    $users = json_decode(file_get_contents('./database/users.json'), true);
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }
    return null;
}


function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function logoutUser()
{
    unset($_SESSION['user']);
}

function get_products()
{
    $file = file_exists('./database/products.json') ? './database/products.json' : '../database/products.json';
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true) ?: [];
}

function get_products_details()
{
    $file = file_exists('./database/product_details.json') ? './database/product_details.json' : '../database/product_details.json';
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true) ?: [];
}

function get_product_detail($id)
{
    $details = get_products_details();
    foreach ($details as $detail) {
        if ($detail['id'] == $id) {
            return $detail;
        }
    }
    return null;
}

function get_first_n_products($n)
{
    $products = get_products();
    return array_slice($products, 0, $n);
}


function numberOfProducts()
{
    return count(get_products());
}


function checkExistsProduct($id)
{
    $products = get_products();
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return true;
        }
    }
    return false;
}

function checkExistsProductDetail($id)
{
    $products_details = get_products_details();
    foreach ($products_details as $product_detail) {
        if ($product_detail['id'] == $id) {
            return true;
        }
    }
    return false;
}