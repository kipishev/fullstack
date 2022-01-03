<!--<pre>--><!-- Если pre или что-либо еще здесь останется, то отправка заголовка не сработает -->
<?php
define('PRODUCTS_IMAGE_PATH', '/images/products/'); // Определяем константу
ini_set('display_errors', 1); // или можно указать значение true вместо 1
session_start(); // Данную функцию мы должны запускать до вывода любой информации на страницу

/*print_r($_POST);
die();*/
// Сюда попадают все те значения, которые мы отправляем через input. И желательно сразу завершать код

/* Создаем соединение с БД */
$user = 'root';
$password = '2222';
$pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// Создаем экземпляр класса PDO, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] добавляем на этапе разработки

$document_root = $_SERVER['DOCUMENT_ROOT'];
