<?php
require $_SERVER['DOCUMENT_ROOT'].'/config.php';

// Смотрим какие данные передаются в глобальной переменной, выбираем что будем выбирать и проверять
/*echo '<pre>';
print_r($_FILES);*/

$errors = []; // Создаем пустой массив и по мере выполнения проверок, данный массив будем заполнять
//$errors = false; // В других случаях можно использовать флаг, который изначально показывает, что ошибок нет

$file = $_FILES['file'];
if (!$file['name']) {
    $errors[] = 'Вы не загрузили изображение';
} else {
    $types = $file['type'];
    $type = explode('/', $types);
    if ($type[0] != 'image') {
        $errors[] = 'Файл должен быть изображением';
    }
}

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];

if (!$name) {
    $errors[] = 'Заполните наименование';
}
if (!$description) {
    $errors[] = 'Заполните описание';
}
if (!$price) {
    $errors[] = 'Укажите цену';
}
if (!$category_id) {
    $errors[] = 'Выберете категорию';
}

if (count($errors)) { // Нам нужно посмотреть есть ли что-нибудь в массиве
    $_SESSION['lastProductCreate'] = [
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'category_id' => $category_id,
    ];

    $_SESSION['createProductErrors'] = $errors;
    header('Location: /pages/admin/products.php');
    exit;
}

// Грузим изображения на сервер
$temp = explode('.', $file['name']);
$ext = $temp[count($temp) - 1]; // Количество элементов минус один (-1) - это всегда последний индекс
$fileName = time().rand(10000, 99999).'.'.$ext;

move_uploaded_file($file['tmp_name'], "$document_root/images/products/$fileName");

$query = "INSERT INTO products (name, description, price, category_id, picture)
            VALUES (:name, :description, :price, :category_id, :picture)";
$res = $pdo->prepare($query);
$res->execute([
    ':name' => $name,
    ':description' => $description,
    ':price' => $price,
    ':category_id' => $category_id,
    ':picture' => $fileName,
]);

// Если в БД ничего не попадает, нужно начать с проверки запроса
/*echo '<pre>';
print_r($res->errorInfo());*/

unset($_SESSION['createProductErrors']);

header("Location: /pages/admin/products.php");















