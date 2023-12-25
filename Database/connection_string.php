<?php

$sourceName = 'mysql:host=localhost:3307;dbname=house_rental_db';
$username = 'root';
$password = 'admin';
$options = [];

try {
    $connection = new PDO($sourceName, $username, $password, $options);
} catch(PDOException $exception) {
    $messageFailed = $exception->getMessage();
}