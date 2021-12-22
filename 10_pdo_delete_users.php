<?php
//echo $_POST['id']; // На данном этапе можно проверить передается ли id

$userId = $_POST['id'];
$user = 'root';
$password = '2222';
$pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password);

$query = "DELETE FROM users WHERE id = :id";
// Использование заглушек чрез : является защит от SQL-инъекций
$res = $pdo->prepare($query);
// Класс PDO через prepare подготавливает запрос, т.к. данные от пользователя могут быть абсолютно любые
$res->execute([ // Выполняем запрос к БД (вместо шаблонов появятся реальные значения)
    ':id' => $userId,
]);

header('Location: 10_pdo.php'); // Заголовок должен отправиться до вывода любой информации