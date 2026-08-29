<?php
include_once '../helper/functions.php';

if (!is_admin()) {
    set_flash_message('error', 'Access denied. Only administrators can edit products.');
    header('Location: ../index.php');
    exit;
}

$uploadDir = '../uploads/';
$productsFile = '../database/products.json';
$detailsFile = '../database/product_details.json';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id']) || !isset($_POST['product'])) {
        die("Error: Invalid product update request.");
    }

    $id = (int)$_POST['id'];
    $postData = $_POST['product'];
    $filesData = isset($_FILES['product']) ? $_FILES['product'] : null;

    $productsList = file_exists($productsFile) ? json_decode(file_get_contents($productsFile), true) : [];
    $productDetailsList = file_exists($detailsFile) ? json_decode(file_get_contents($detailsFile), true) : [];

    // Find indices
    $productIndex = -1;
    foreach ($productsList as $i => $p) {
        if ($p['id'] == $id) {
            $productIndex = $i;
            break;
        }
    }

    $detailIndex = -1;
    foreach ($productDetailsList as $i => $d) {
        if ($d['id'] == $id) {
            $detailIndex = $i;
            break;
        }
    }

    if ($productIndex === -1 || $detailIndex === -1) {
        set_flash_message('error', 'Product not found for update.');
        header('Location: ../products.php');
        exit;
    }

    // Handle Main Image upload if new file is uploaded
    $mainImagePath = $productsList[$productIndex]['image'];
    if ($filesData && isset($filesData['name']['main_image']) && $filesData['error']['main_image'] === UPLOAD_ERR_OK) {
        $tmpName = $filesData['tmp_name']['main_image'];
        $fileName = time() . '_main_' . basename($filesData['name']['main_image']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($tmpName, $targetPath)) {
            $mainImagePath = 'uploads/' . $fileName;
        }
    }

    // Handle Gallery Images upload if new files are uploaded
    $galleryPaths = $productDetailsList[$detailIndex]['gallery'] ?? [];
    if ($filesData && isset($filesData['name']['gallery']) && is_array($filesData['name']['gallery']) && !empty($filesData['name']['gallery'][0])) {
        $newGallery = [];
        $galleryCount = count($filesData['name']['gallery']);
        for ($i = 0; $i < $galleryCount; $i++) {
            if ($filesData['error']['gallery'][$i] === UPLOAD_ERR_OK) {
                $tmpName = $filesData['tmp_name']['gallery'][$i];
                $fileName = time() . '_gallery_' . $i . '_' . basename($filesData['name']['gallery'][$i]);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $newGallery[] = 'uploads/' . $fileName;
                }
            }
        }
        if (!empty($newGallery)) {
            $galleryPaths = $newGallery;
        }
    }

    $isSale = isset($postData['is_sale']) ? true : false;
    $hasOptions = isset($postData['has_options']) ? true : false;

    $currentPrice = number_format((float)($postData['current_price'] ?? 0), 2, '.', '');
    $originalPrice = !empty($postData['original_price']) ? number_format((float)$postData['original_price'], 2, '.', '') : null;

    // Update product in products.json
    $productsList[$productIndex]['name'] = $postData['name'] ?? $productsList[$productIndex]['name'];
    $productsList[$productIndex]['image'] = $mainImagePath;
    $productsList[$productIndex]['isSale'] = $isSale;
    $productsList[$productIndex]['priceDisplay'] = "$" . $currentPrice;
    $productsList[$productIndex]['originalPriceDisplay'] = $originalPrice ? "$" . $originalPrice : null;
    $productsList[$productIndex]['quantity'] = $postData['quantity'] ?? 0;
    $productsList[$productIndex]['buttonType'] = $hasOptions ? "options" : "cart";

    // Update product details in product_details.json
    $productDetailsList[$detailIndex]['description'] = $postData['description'] ?? "";
    $productDetailsList[$detailIndex]['gallery'] = $galleryPaths;
    $productDetailsList[$detailIndex]['stockStatus'] = $postData['stock_status'] ?? 'In Stock';
    $productDetailsList[$detailIndex]['hasOptions'] = $hasOptions;
    $productDetailsList[$detailIndex]['category'] = $postData['category'] ?? "Uncategorized";

    file_put_contents($productsFile, json_encode($productsList, JSON_PRETTY_PRINT));
    file_put_contents($detailsFile, json_encode($productDetailsList, JSON_PRETTY_PRINT));

    set_flash_message('success', 'Product updated successfully!');
    header("Location: ../product.php?id=" . $id);
    exit;
}
