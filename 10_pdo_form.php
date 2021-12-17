<!--<pre>--><!-- Если pre или что-либо еще здесь останется, то отправка заголовка не сработает -->
<?php
/*print_r($_POST);
die();*/
// Сюда попадают все те значения, которые мы отправляем через input. И желательно сразу завершать код

/* Создаем соединение с БД */
$user = 'root';
$password = '76No2201894';
$pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password); // Создаем экземпляр класса PDO

$name = $_POST['name']; // Получаем значения из передаваемого массива
$login = $_POST['login'];
$password = $_POST['password'];
$city_id = $_POST['city_id'];

$query = "INSERT INTO users (name, login, pas, city_id) VALUES(:name, :login, :password, :city_id)";
// Использование заглушек чрез : является защит от SQL-инъекций
$res = $pdo->prepare($query);
// Класс PDO через prepare подготавливает запрос, т.к. данные от пользователя могут быть абсолютно любые
$res->execute([ // Выполняем запрос к БД (вместо шаблонов появятся реальные значения)
    ':name' => $name,
    ':login' => $login,
    ':password' => $password,
    ':city_id' => $city_id,
]);

header('Location: 10_pdo.php'); // Заголовок должен отправиться до вывода любой информации