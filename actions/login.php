<?php
require $_SERVER['DOCUMENT_ROOT'].'/config.php';

$login = $_POST['login'];
$password = md5($_POST['password']); // Оборачиваем пароль также в md5 для возможности сравнения с вводом от пользователя

$query = 'SELECT * FROM users WHERE login = :login AND pas = :password';
$res = $pdo->prepare($query);
$res->execute([
    ':login' => $login,
    ':password' => $password,
]);

$user = $res->fetch(); // Здесь мы получаем либо массив, либ false

if ($user) {
    $_SESSION['user'] = $user;
    header('Location: ../index.php');
} else {
    $_SESSION['loginError'] = true;
    header('Location: ../pages/login.php');
}