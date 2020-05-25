<?php

require_once "vendor/autoload.php";

$connectionParams = array(
    'dbname' => 'carneval',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

