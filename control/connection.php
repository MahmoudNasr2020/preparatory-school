<?php
$host = "mysql:host=localhost;dbname=school2";
$namesql = "root";
$password = '';
try {
    $con = new PDO($host, $namesql, $password);
} catch (PDOException $e) {
    echo "falid" . $e->getMessage();
}
