<?php
$dbHost = 'localhost';
$dbName = 'curso_platzi_php';
$dbUser = 'root';
$dbPass = '';
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e){
    echo $e->getMessage();
}