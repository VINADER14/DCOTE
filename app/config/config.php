<?php
$host = '127.0.0.1';
$db   = 'dcote_site';
$user = 'root';
$pass = '';


$db = mysqli_connect($host, $user, $pass, $db);
mysqli_query($db, "SET time_zone = '+00:00'");

if (!$db) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
