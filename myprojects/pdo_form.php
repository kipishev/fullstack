<!--<pre>--><!-- Если pre или что-либо еще здесь останется, то отправка заголовка не сработает -->
<?php
/*print_r($_POST);
die();*/
// Сюда попадают все те значения, которые мы отправляем через input. И желательно сразу завершать код

/* Создаем соединение с БД */
$user = 'root';
$password = '2222';
$pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password); // Создаем экземпляр класса PDO

$contractor = $_POST['contractor']; // Получаем значения из передаваемого массива
$num = $_POST['num'];
$object = $_POST['object'];
$sum = $_POST['sum'];
$budget_id = $_POST['budget_id'];

$query = "INSERT INTO agreements (contractor, num, object, sum, budget_id) VALUES(:contractor, :num, :object, :sum, :budget_id)";
// Использование заглушек чрез : является защит от SQL-инъекций
$res = $pdo->prepare($query);
// Класс PDO через prepare подготавливает запрос, т.к. данные от пользователя могут быть абсолютно любые
$res->execute([ // Выполняем запрос к БД (вместо шаблонов появятся реальные значения)
    ':contractor' => $contractor,
    ':num' => $num,
    ':object' => $object,
    ':sum' => $sum,
    ':budget_id' => $budget_id,
]);

header('Location: pdo.php'); // Заголовок должен отправиться до вывода любой информации