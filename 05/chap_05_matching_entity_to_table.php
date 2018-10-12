<?php

define('DB_CONFIG_FILE', '/../config/db.config.php');

require __DIR__ . '/../Application/Autoload/Loader.php';

Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Database\Connection;
use Application\Entity\Customer;

$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);
$id = rand(1,79);
$stmt = $conn->pdo->prepare('SELECT * FROM customer WHERE id = :id');
$stmt->execute(['id' => $id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$cust = Customer::arrayToEntity($result, new Customer());
var_dump($cust);
