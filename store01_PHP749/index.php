<?php
$title = 'Главная';
require_once 'templates/header.php';
/*echo '<pre>';
print_r($_SESSION);*/

$query = "SELECT * FROM categories";
$res = $pdo->query($query);
$categories = $res->fetchAll();

$cards = '';
foreach ($categories as $category) {
    $cards .=
        "
        <div class='col-3 mb-2'>
            <div class='card'>
                <img src='/images/categories/no_photo.png' class='card-img-top' alt='...'>
                <div class='card-body'>
                    <h5 class='card-title'>{$category['name']}</h5>
                    <p class='card-text'>{$category['description']}</p>
                    <a href='/pages/category.php?id={$category['id']}' class='btn btn-primary'>Перейти</a>
                </div>
            </div>
        </div>
        ";
}
?>

<div class="row">
    <?= $cards; ?>
</div>

<?php
require_once 'templates/footer.php';
?>
