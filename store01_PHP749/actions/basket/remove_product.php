<?php
require $_SERVER['DOCUMENT_ROOT'] .'/config.php';

$productId = $_POST['id'];
$categoryId = $_POST['category_id'];

// Если сессия пуста, то получаем пустой массив
$products = $_SESSION['products'] ?? [];

//var_dump($products);

if (isset($products[$productId])) {
    if ($products[$productId] == 1) {
        unset($products[$productId]);
    } else {
        $products[$productId] -= 1;
    }
}

$_SESSION['products'] = $products;

/*echo '<pre>';
var_dump($_SESSION['products']);*/

header("Location: /pages/category.php?id=$categoryId");
