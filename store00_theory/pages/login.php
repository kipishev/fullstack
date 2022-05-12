<?php
$title = 'Авторизация';
require_once '../templates/header.php';
?>

<form method="POST" action="../actions/login.php">
    <input class="form-control mb-2" placeholder="Логин" name='login'>
    <input class="form-control mb-2" type="password" placeholder="Пароль" name='password'>
    <button type="submit" class="btn btn-success w-100">Войти</button>
</form>

<?php

require_once '../templates/footer.php';