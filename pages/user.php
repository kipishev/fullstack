<?php
require_once '../templates/header.php';

            /*------------------------------------------------ Проверка работы сессии */
            //echo '<pre>';
            //$_SESSION['test']='sljfdjs';
            // Даже после обновления страницы информация останется, т. к. уже находится в файле сессии
            //print_r($_SESSION);
            //unset($_SESSION['test']); // Очистка сессии

            /*------------------------------------------------ Проверка наличия пользователя */
            //echo $_GET['id']; // На данном этапе можно проверить передается ли id
            //echo $_GET['login']; // Можно получить и другие данные через GET параметры

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
                    <div id='alertSuccess' class='alert alert-success text-center' role='alert'>
                        Изменения внесены
                    </div>
                ";
                unset($_SESSION['success']);
            }
            ?>
            <!-------------------------------------------------- Форма редактирования пользователя-->
            <form method="post" action="../action/update_user.php">
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
        <!--</div>--> <!--Подключается в футере-->
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#alertSuccess').fadeOut()
                }, 3000)
            })
        </script>
<?php
require_once '../templates/footer.php';
