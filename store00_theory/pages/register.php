<?php
$title = 'Регистрация';
require_once '../templates/header.php';
?>
<form method="POST" action="form.php">
    <input required class="form-control mb-2" placeholder="Имя" name='name'>
    <input class="form-control mb-2" placeholder="Логин" name='login'>
    <input class="form-control mb-2" type="password" placeholder="Пароль" name='password'>
    <select class="form-control mb-2" name="city_id">
        <option selected disabled>-- Выберите город --</option>
        <?php
            foreach ($cities as $city) {
                echo "<option value='{$city['id']}'>{$city['name']}</option>";
            }
        ?>
    </select>
    <button type="submit" class="btn btn-success w-100">Зарегистрироваться</button>
</form>

<?php
require_once '../templates/footer.php';