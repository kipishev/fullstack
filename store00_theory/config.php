<?php
session_start();
$user = $password = 'root';
$pdo = new Pdo('mysql:dbname=fullstack2;host=127.0.0.1;port=3307', $user, $password);