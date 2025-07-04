<?php
require("../connection/connection.php");

$sql = "CREATE TABLE categories(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";

$mysqli->prepare($sql)->execute();

echo 'migration done!';