<?php


use Doctrine\DBAL\Connection;
use Dotenv\Dotenv;
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$connectionParams = [
    'dbname' => $_ENV['DB_DATABASE'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
];
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

/*$stmt = $conn->prepare('SELECT  modell , merevlemez FROM laptop WHERE merevlemez BETWEEN :from AND :to');
$from = '80';
$to = '100';

$stmt->bindValue(':from', $from);
$stmt->bindValue(':to', $to);
$result = $stmt->executeQuery();
var_dump($result->fetchAllAssociative());*/
$ids = [1001,1002,1003];
$result = $conn->executeQuery('SELECT  gyarto , modelL FROM termek WHERE modelL IN(?)',
    [$ids], [Connection::PARAM_INT_ARRAY]);
var_dump($result->fetchAllAssociative());

