<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Договоры</title>
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
    $password = '2222';
    $pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password); // Создаем экземпляр класса PDO

    $query = "SELECT * FROM agreements"; // Просто прописали текст запроса
    $res = $pdo->query($query); // Передаем текст запроса и результат передаем в переменную
    // print_r($res->fetchAll()); // Проверяем вывод данных, обрабатываем результат запроса
    $agreements = $res->fetchAll();

    $query = "SELECT * FROM budget"; // Выбираем все из таблицы бюджета
    $res = $pdo->query($query);
    $budget = $res->fetchAll();

    echo "
            <table class='table table-bordered <!--table-sm-->'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID статьи бюджета</th>
                        <th>Контрагент</th>
                        <th>Номер договора</th>
                        <th>Предмет договора</th>
                        <th>Сумма договора</th>
                    </tr>
                </thead>
                <tbody>
            ";

    foreach ($agreements as $agreement) {
        /*if ($user['city_id']) {
            $city = $user['city_id'];
        } else {
            $city = '-';
        }*/
        $item = $agreement['budget_id'] ? $agreement['budget_id'] : '-';
        // Сокращенная запись предыдущего кода (использование тернарного оператора)
        // Читается: если $agreement['budget_id'] не пуст, то $item = $agreement['budget_id'], иначе $item = '-'

        echo "
                <tr>
                    <td>{$agreement['id']}</td>
                    <td>{$item}</td>
                    <td>{$agreement['contractor']}</td>
                    <td>{$agreement['num']}</td>
                    <td>{$agreement['object']}</td>
                    <td>{$agreement['sum']}</td>
                    <td class='text-center'>
                        <form method='post' action='pdo_del_user.php'>
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
    <form method="POST" action="pdo_form.php">
        <input required class="form-control mb-2" placeholder="Наименование контрагента" name="contractor">
        <input class="form-control mb-2" placeholder="Номер договора" name="num">
        <input class="form-control mb-2" placeholder="Предмет договора" name="object">
        <input class="form-control mb-2" placeholder="Сумма договора" name="sum">
        <select class="form-control mb-2" name="budget_id">
            // Если нужно передать только значение переменной, то можно использовать сокращенную запись PHP
            <!--<option value='<?/*=NULL */?>' selected disabled>-- Выберете статью бюджета --</option>-->
            // Можно указать просто value без значения, что будет соответствовать value=NULL
            // Либо благодаря тому, что disabled, никакое значение не передается и форма отправляется
            <?php
            $null = NULL; // Для отправки формы без выбранного значения статьи бюджета
            echo "<option value='{$null}' selected disabled>-- Выберете статью бюджета --</option>";
            foreach ($budget as $item) {
                echo "<option value='{$item['id']}'>{$item['name']}</option>";
                // Отображается $item['name'], а отправляться будет $item['id']
            }
            ?>
        </select>
        <button type="submit" class="btn btn-success w-100">Отправить</button>
    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
