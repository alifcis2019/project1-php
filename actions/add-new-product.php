<?php
include_once '../helper/functions.php';

$uploadDir = '../uploads/';
$productsFile = '../database/products.json';
$detailsFile = '../database/product_details.json';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['product'])) {
        die("Error: No product data received.");
    }

    $postData = $_POST['product'];
    $filesData = isset($_FILES['product']) ? $_FILES['product'] : null;

    $productsList = file_exists($productsFile) ? json_decode(file_get_contents($productsFile), true) : [];
    $productDetailsList = file_exists($detailsFile) ? json_decode(file_get_contents($detailsFile), true) : [];

    $nextId = 1;
    if (is_array($productsList) && count($productsList) > 0) {
        $lastProduct = end($productsList);
        $nextId = $lastProduct['id'] + 1;
    }

    $mainImagePath = "https://dummyimage.com/450x300/dee2e6/6c757d.jpg";
    if ($filesData && isset($filesData['name']['main_image']) && $filesData['error']['main_image'] === UPLOAD_ERR_OK) {
        $tmpName = $filesData['tmp_name']['main_image'];
        $fileName = time() . '_main_' . basename($filesData['name']['main_image']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($tmpName, $targetPath)) {
            $mainImagePath = 'uploads/' . $fileName;
        }
    }

    $galleryPaths = [];
    if ($filesData && isset($filesData['name']['gallery']) && is_array($filesData['name']['gallery'])) {
        $galleryCount = count($filesData['name']['gallery']);
        for ($i = 0; $i < $galleryCount; $i++) {
            if ($filesData['error']['gallery'][$i] === UPLOAD_ERR_OK) {
                $tmpName = $filesData['tmp_name']['gallery'][$i];
                $fileName = time() . '_gallery_' . $i . '_' . basename($filesData['name']['gallery'][$i]);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $galleryPaths[] = 'uploads/' . $fileName;
                }
            }
        }
    }
    if (empty($galleryPaths)) {
        $galleryPaths = ["https://dummyimage.com/600x600/dee2e6/6c757d.jpg"];
    }

    $isSale = isset($postData['is_sale']) ? true : false;
    $hasOptions = isset($postData['has_options']) ? true : false;

    $currentPrice = number_format((float)($postData['current_price'] ?? 0), 2, '.', '');
    $originalPrice = !empty($postData['original_price']) ? number_format((float)$postData['original_price'], 2, '.', '') : null;

    $newProduct = [
        "id" => $nextId,
        "name" => $postData['name'] ?? 'Unnamed Product',
        "image" => $mainImagePath,
        "isSale" => $isSale,
        "rating" => 0,
        "priceDisplay" => "$" . $currentPrice,
        "originalPriceDisplay" => $originalPrice ? "$" . $originalPrice : null,
        "buttonType" => $hasOptions ? "options" : "cart"
    ];

    $newProductDetails = [
        "id" => $nextId,
        "description" => $postData['description'] ?? "",
        "gallery" => $galleryPaths,
        "stockStatus" => $postData['stock_status'] ?? 'In Stock',
        "hasOptions" => $hasOptions,
        "options" => $hasOptions ? ["Notice" => ["To be configured later"]] : null,
        "variants" => null,
        "category" => $postData['category'] ?? "Uncategorized"
    ];

    $productsList[] = $newProduct;
    $productDetailsList[] = $newProductDetails;

    if (!is_dir(dirname($productsFile))) {
        mkdir(dirname($productsFile), 0777, true);
    }

    file_put_contents($productsFile, json_encode($productsList, JSON_PRETTY_PRINT));
    file_put_contents($detailsFile, json_encode($productDetailsList, JSON_PRETTY_PRINT));

    if (function_exists('set_flash_message')) {
        set_flash_message('success', 'Product added successfully!');
    }

    header("Location: " . '../products.php');
    exit;
}