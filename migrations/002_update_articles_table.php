<?php 
require("../connection/connection.php");


$query = "ALTER TABLE articles....";

$execute = Database::getInstance()->prepare($query);
$execute->execute();