<?php
$dsn = 'mysql:host=localhost;dbname=skilogram_709';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$dbh->exec("set names utf8");
?>

