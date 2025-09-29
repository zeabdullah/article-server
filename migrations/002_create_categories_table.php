<?php
require_once(__DIR__ . "/../connection/connection.php");

$sql = "CREATE TABLE IF NOT EXISTS categories(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";

Database::getInstance()->prepare($sql)->execute();

echo 'migration 002 done!' . PHP_EOL;