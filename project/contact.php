<?php
include_once './helper/functions.php';
// 1. Tell the app which page this is!
$currentPage = 'Contact';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name)) {
        set_flash_message('error', 'Name is required');
    }
    if (empty($email)) {
        set_flash_message('error', 'Email is required');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_flash_message('error', 'Please enter a valid email');
    }
    if (empty($subject)) {
        set_flash_message('error', 'Subject is required');
    }
    if (empty($message)) {
        set_flash_message('error', 'Message is required');
    }

    if (!has_flash()) {
        $messages = [];
        if (file_exists('./database/messages.json')) {
            $file_content = file_get_contents('./database/messages.json');
            if (!empty($file_content)) {
                $messages = json_decode($file_content, true);
            }
        }

        $messages[] = [
            'id' => uniqid('MSG_'),
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];

        file_put_contents('./database/messages.json', json_encode($messages, JSON_PRETTY_PRINT));

        set_flash_message('success', 'Message sent successfully!');
        header('Location: contact.php');
        exit;
    }
}

include './inc/header.php';
include './views/contact.php';
include './inc/footer.php';
