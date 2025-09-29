<?php
require_once(__DIR__ . "/../connection/connection.php");


$query = "CREATE TABLE IF NOT EXISTS articles(
          id INT(11) AUTO_INCREMENT PRIMARY KEY, 
          name VARCHAR(255) NOT NULL, 
          author VARCHAR(255) NOT NULL, 
          description TEXT NOT NULL)";

$execute = Database::getInstance()->prepare($query);
$execute->execute();

echo 'migration 001 done!' . PHP_EOL;
