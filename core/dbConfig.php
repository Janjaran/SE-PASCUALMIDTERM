<?php 

$host = "localhost";
$user = "root";
$password = "";
$PASCUALMIDTERM = "PASCUALMIDTERM";
$dsn = "mysql:host={$host};dbname={$PASCUALMIDTERM}";

$pdo = new PDO($dsn, $user, $password);
$conn = new PDO($dsn, $user, $password);
$conn->exec("SET time_zone = '+08:00';");

?>