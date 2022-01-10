<?php
$title = 'Cписок пользователе';
require '../../templates/header.php';

$query = "SELECT * FROM users"; // Просто текст запроса
$res = $pdo->query($query); // Подготавливаем запрос, возвращается объект
// print_r($res->fetchAll()); // Проверяем вывод данных, обрабатываем результат запроса
$users = $res->fetchAll(); // fetchAll всегда вернет массив, даже если записей не найдено

$query = "SELECT * FROM cities"; // Выбираем все из таблицы городов
$res = $pdo->query($query);
$cities = $res->fetchAll();

echo "
            <table class='table table-bordered <!--table-sm-->'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Имя</th>
                        <th>ID города</th>
                        <th>Удаление</th>
                    </tr>
                </thead>
                <tbody>
            ";

foreach ($users as $user) {
    /*if ($user['city_id']) {
        $city = $user['city_id'];
    } else {
        $city = '-';
    }*/
    $city = $user['city_id'] ? $user['city_id'] : '-';
    // Сокращенная запись предыдущего кода (использование тернарного оператора)
    // Читается: если $user['city_id'] не пуст, то $city = $user['city_id'], иначе $city = '-'

    echo "
                <tr>
                    <td>{$user['id']}</td>
                    <td>{$user['login']}</td>
                    <td><a href='pages/user.php?id={$user['id']}'>{$user['name']}</a></td>
                    <!-- Если необходимо передать еще какие-либо параметры, то используется знак & -->
                    <td>{$city}</td>
                    <td class='text-center'>
                        <form method='post' action='actions/del_user.php'>
                            <input hidden name='id' value='{$user['id']}'>
                            <button type='submit' class='btn btn-user-delete btn-danger'>X</button>
                        </form>
                    </td>
                </tr>
                ";
}

echo "
                </tbody>
            </table>
            ";