<?php

$userId = $_POST['id'];

$user = $password = 'root';
$pdo = new Pdo('mysql:dbname=fullstack2;host=127.0.0.1;port=3307', $user, $password);

$query = "DELETE FROM users WHERE id = :id";
$res = $pdo->prepare($query);
$res->execute([
    ':id' => $userId,
]);

header('Location: ../index.php');