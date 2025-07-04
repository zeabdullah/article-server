<?php
require("../connection/connection.php");

$sql = "CREATE TABLE categories(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";

Database::getInstance()->prepare($sql)->execute();

echo 'migration 003 done!';