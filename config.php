<?php
session_start(); // Данную функцию мы должны запускать до вывода любой информации на страницу
/* Создаем соединение с БД */
$user = 'root';
$password = '2222';
$pdo = new Pdo('mysql:dbname=fullstack;localhost;port=8889', $user, $password); // Создаем экземпляр класса PDO
