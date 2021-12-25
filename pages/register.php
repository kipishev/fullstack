<?php
require_once '../templates/header.php';
?>
<form method="POST" action="form.php">
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
    <button type="submit" class="btn btn-success w-100">Зарегистрироваться</button>
</form>
<?php
require_once '../templates/footer.php';
