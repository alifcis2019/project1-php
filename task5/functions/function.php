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

function get_user_by_email($email)
{
    if (!file_exists('./data/users.json')) return null;

    $users = json_decode(file_get_contents('./data/users.json'), true);
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
