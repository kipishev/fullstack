<?php
session_start(); // Данную функцию мы должны запускать до вывода любой информации на страницу
?>
<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>F</title>
        <style>
            .btn-danger {
                border-radius: 100px;
                padding: 3px 11px;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">

            <!--<pre>-->
            <?php
            /*------------------------------------------------ Проверка работы сессии */
            //echo '<pre>';
            //$_SESSION['test']='sljfdjs';
            // Даже после обновления страницы информация останется, т. к. уже находится в файле сессии
            //print_r($_SESSION);
            //unset($_SESSION['test']); // Очистка сессии

            /*------------------------------------------------ Проверка наличия пользователя */
            //echo $_GET['id']; // На данном этапе можно проверить передается ли id
            //echo $_GET['login']; // Можно получить и другие данные через GET параметры

            $user = 'root';
            $password = '2222';
            $pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password);

            $userId = $_GET['id'];

            $query = 'SELECT * FROM users WHERE id = :id'; // Просто текст запроса
            $res = $pdo->prepare($query); // Подготавливаем запрос, возвращается объект
            $res->execute([ // Выполняем
                ':id' => $userId,
            ]);

            //var_dump($res->fetch()); // Получаем либо массив, либо false и на это нам и нужно сделать проверку

            $user = $res->fetch(); // fetch достает одну запись

            /*if ($user) {
                echo "Найден пользователь {$user['login']}";
            } else {
                echo "Пользователь с id $userId не найден";
            }*/

            if ($user) {

            $query = "SELECT * FROM cities"; // Выбираем все из таблицы городов
            $res = $pdo->query($query);
            $cities = $res->fetchAll();

            /*-------------------------------------------------- Работа с сессией */
            if (isset($_SESSION['error'])) { // Как только мы проверили ключ
                echo "
                    <div class='alert alert-danger text-center' role='alert'>
                        {$_SESSION['error']}
                    </div>
                "; // Показали сообщение о наличие пользователю
                unset($_SESSION['error']); // Теперь сообщение о наличие можно удалять
            } elseif (isset($_SESSION['success'])) {
                echo "
                    <div class='alert alert-success text-center' role='alert'>
                        <p>Изменения внесены</p>
                    </div>
                ";
                unset($_SESSION['success']);
            }
            ?>
            <!-------------------------------------------------- Форма редактирования пользователя-->
            <form method="post" action="11_pdo_update_user.php">
                <label>Имя</label>
                <input name="id" hidden value='<?=$user['id']?>'>
                <input class="form-control mb-2" name="name" value="<?=$user['name']?>">
                <label>Логин</label>
                <input class="form-control mb-2" name="login" value="<?=$user['login']?>">
                <select class="form-control mb-2" name="city_id">
                    <?php
                        if (!$user['city_id']) {
                            echo '<option selected disabled>-- Выберете город --</option>';
                        }
                        foreach ($cities as $city) {
                            $selected = $city['id'] == $user['city_id'] ? 'selected' : '';
                            echo "<option $selected value='{$city['id']}'>{$city['name']}</option>";
                        }
                    ?>
                </select>
                <button type="submit" class="btn btn-success w-100">СОХРАНИТЬ</button>
            </form>
            <?php
            } else {
                echo '
                    <div class="alert alert-warning" role="alert">
                        Пользователь не найден!
                    </div>
                    ';
            }
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
