<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Hello, world!</title>
        <style>
            .btn-danger {
                border-radius: 100px;
                padding: 3px 11px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <!--<pre>--> <!-- Чтобы привети структуру вывода print_r в читаемый вид -->
            <?php
            /* Создаем соединение с БД */
            $user = 'root';
            $password = '76No2201894';
            $pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password); // Создаем экземпляр класса PDO

            $query = "SELECT * FROM users"; // Просто прописали текст запроса
            $res = $pdo->query($query); // Передаем текст запроса и результат передаем в переменную
            // print_r($res->fetchAll()); // Проверяем вывод данных, обрабатываем результат запроса
            $users = $res->fetchAll();

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
                    <td>{$user['name']}</td>
                    <td>{$city}</td>
                    <td class='text-center'>
                        <form method='post' action='10_pdo_del_user.php'>
                            <button class='btn btn-danger'>X</button>
                        </form>
                    </td>
                </tr>
                ";
            }

            echo "
                </tbody>
            </table>
            ";

            ?>
            <form method="POST" action="10_pdo_form.php">
                <input required class="form-control mb-2" placeholder="Имя" name="name">
                <input class="form-control mb-2" placeholder="Логин" name="login">
                <input class="form-control mb-2" type="password" placeholder="Пароль" name="password">
                <select class="form-control mb-2" name="city_id">
                    // Если нужно передать только значение переменной, то можно использовать сокращенную запись PHP
                    <!--<option value='<?/*=NULL */?>' selected disabled>-- Выберете город --</option>-->
                    // Можно указать просто value без значения, что будет соответствовать value=NULL
                    // Либо благодаря тому, что disabled, никакое значение не передается и форма отправляется
                    <?php
                    $null = NULL; // Для отправки формы без выбранного города
                    echo "<option value='{$null}' selected disabled>-- Выберете город --</option>";
                    foreach ($cities as $city) {
                        echo "<option value='{$city['id']}'>{$city['name']}</option>";
                        // Отображается $city['name'], а отправляться будет $city['id']
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-success w-100">Отправить</button>
            </form>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
