<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dcote_site';
$charset = 'utf8mb4';


$db = mysqli_connect($host, $username, $password, $database);

if (!$db) {
    die("Ошибка подключения: " . mysqli_connect_error());
}


mysqli_set_charset($db, $charset);


?>