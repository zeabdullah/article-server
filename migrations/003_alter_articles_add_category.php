<?php
require_once(__DIR__ . "/../connection/connection.php");

$sql1 = "ALTER TABLE articles
    ADD category_id INT(11) NOT NULL";

$sql2 = "ALTER TABLE articles 
    ADD CONSTRAINT fk_categories_on_articles
    FOREIGN KEY (category_id) REFERENCES categories(id)";

$db = Database::getInstance();

$db->prepare($sql1)->execute();
$db->prepare($sql2)->execute();

echo 'migration 003 done!' . PHP_EOL;