<?php
include_once './helper/functions.php';
// 1. Tell the app which page this is!
$currentPage = 'Checkout';

if (!isLoggedIn()) {
    set_flash_message('warning', 'Please login to checkout');
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $postal_code = trim($_POST['postal_code'] ?? '');
    $payment_method = $_POST['payment_method'] ?? 'cash_on_delivery';
    $notes = trim($_POST['notes'] ?? '');

    if (empty($first_name)) {
        set_flash_message('error', 'First name is required');
    }
    if (empty($last_name)) {
        set_flash_message('error', 'Last name is required');
    }
    if (empty($email)) {
        set_flash_message('error', 'Email is required');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        set_flash_message('error', 'Please enter a valid email');
    }
    if (empty($phone)) {
        set_flash_message('error', 'Phone number is required');
    }
    if (empty($address)) {
        set_flash_message('error', 'Street address is required');
    }
    if (empty($city)) {
        set_flash_message('error', 'City is required');
    }

    $cartItems = $_SESSION['cart'] ?? [];
    if (empty($cartItems)) {
        set_flash_message('error', 'Your cart is empty');
    }

    if (!has_flash()) {
        $orders = [];
        if (file_exists('./database/orders.json')) {
            $file_content = file_get_contents('./database/orders.json');
            if (!empty($file_content)) {
                $orders = json_decode($file_content, true);
            }
        }

        $allProducts = get_products();
        $items = [];
        $subtotal = 0;

        foreach ($cartItems as $productId => $quantity) {
            $product = null;
            foreach ($allProducts as $p) {
                if ($p['id'] == $productId) {
                    $product = $p;
                    break;
                }
            }
            if ($product) {
                $priceString = explode('-', $product['priceDisplay'])[0];
                $numericPrice = (float) preg_replace('/[^0-9.]/', '', $priceString);
                $itemTotal = $numericPrice * $quantity;
                $subtotal += $itemTotal;

                $items[] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'image' => $product['image'],
                    'price' => $product['priceDisplay'],
                    'quantity' => $quantity,
                    'total' => '$' . number_format($itemTotal, 2)
                ];
            }
        }

        $shipping = 10.00;
        $total = $subtotal + $shipping;
        $orderId = 'ORD_' . uniqid();

        $orders[] = [
            'id' => $orderId,
            'user_id' => $_SESSION['user']['id'] ?? null,
            'customer' => [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'city' => $city,
                'postal_code' => $postal_code,
                'notes' => $notes
            ],
            'items' => $items,
            'subtotal' => '$' . number_format($subtotal, 2),
            'shipping' => '$' . number_format($shipping, 2),
            'total' => '$' . number_format($total, 2),
            'payment_method' => $payment_method,
            'status' => 'Processing',
            'created_at' => date('Y-m-d H:i:s')
        ];

        file_put_contents('./database/orders.json', json_encode($orders, JSON_PRETTY_PRINT));

        unset($_SESSION['cart']);

        set_flash_message('success', 'Order placed successfully! Order ID: ' . $orderId);
        header('Location: index.php');
        exit;
    }
}

include './inc/header.php';
include './views/checkout.php';
include './inc/footer.php';