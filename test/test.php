<?php
require('../seeders/CategorySeeder.php');

$seeder = new CategorySeeder(
    ['name' => 'software'],
    ['name' => 'politics'],
    ['name' => 'science'],
    ['name' => 'physics'],
    ['name' => 'environment'],
    ['name' => 'finance']
);

$objs = $seeder->seed();
echo 'seed categories success!';