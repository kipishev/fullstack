<?php
require $_SERVER['DOCUMENT_ROOT'].'/config.php';

$name = $_POST['name']; // Получаем значения из передаваемого массива
$login = $_POST['login'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$city_id = $_POST['city_id'];

if ($password != $repassword) {
    $_SESSION['registerError'] = 'Пароль не совпадает';
    header('Location: ../pages/register.php'); // Заголовок должен отправиться до вывода любой информации
    exit();
}

$query = "INSERT INTO users (name, login, pas, city_id) VALUES(:name, :login, :password, :city_id)";
// Использование заглушек чрез : является защит от SQL-инъекций
$res = $pdo->prepare($query);
// Класс PDO через prepare подготавливает запрос, т.к. данные от пользователя могут быть абсолютно любые
$status = $res->execute([ // Выполняем запрос к БД (вместо шаблонов появятся реальные значения)
    ':name' => $name,
    ':login' => $login,
    ':password' => md5($password), // Оборачиваем в md5 после удаления всех данных из таблицы БД users
    ':city_id' => $city_id,
]);

if ($status) {
    /*echo '<pre>';*/
    $query = 'SELECT * FROM users WHERE login = :login';
    $res = $pdo->prepare($query);
    $res->execute([
        ':login' => $login,
    ]);
    $user = $res->fetch();
    $_SESSION['user'] = $user;
}

header('Location: ../index.php'); // Заголовок должен отправиться до вывода любой информации