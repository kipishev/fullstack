<?php
session_start(); // Данную функцию мы должны запускать до вывода любой информации на страницу
$user = 'root';
$password = '2222';
$pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password);

$userId = $_POST['id'];
$name = $_POST['name'];
$login = $_POST['login'];
$city_id = $_POST['city_id'];

/*echo '<pre>';
var_dump($_POST);
die();*/

$query = "UPDATE users SET name = :name, login = :login, city_id = :city_id WHERE id = :id";
$res = $pdo->prepare($query);
$status = $res->execute([
    ':name' => $name,
    ':login' => $login,
    ':city_id' => $city_id,
    ':id' => $userId,
]);

//echo '<pre>';
//var_dump($status, $res->errorInfo());
if (!$status) {
    $error = $res->errorInfo()[2];
    $_SESSION['error'] = $error;
} else {
    $success = $status;
    $_SESSION['success'] = $success;
    // Вывесте сообщение об успехе
}

header("Location: 11_pdo_users_profile.php?id=$userId"); // Заголовок должен отправиться до вывода любой информации