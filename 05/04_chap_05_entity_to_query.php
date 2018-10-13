<?php

define('DB_CONFIG_FILE', '/../config/db.config.php');

require __DIR__ . '/../Application/Autoload/Loader.php';

Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Entity\Customer;
use Application\Database\Connection;
use Application\Database\CustomerService;

// get service instance
$service = new CustomerService(new Connection(include __DIR__ . DB_CONFIG_FILE));

echo "\nSingle Result\n";
var_dump($service->fetchById(rand(1, 79)));

// sample data
$data = [
'name' => 'Doug Bierer',
'balance' => 326.33,
'email' => 'doug' . rand(0,999) . '@test.com',
'password' => 'password',
'status' => 1,
'security_question' => 'Who\'s on first?',
'confirm_code' => 12345,
'level' => 'ADV'
];

// create new Customer
$cust = Customer::arrayToEntity($data, new Customer());

echo "Customer ID BEFORE Insert: {$cust->getId()}<br>";
$cust = $service->save($cust);
echo "Customer ID AFTER Insert: {$cust->getId()}<br>";

echo "Customer Balance BEFORE Update: {$cust->getBalance()}<br>";
$cust->setBalance(999.99);
$service->save($cust);
echo "Customer Balance AFTER Update: {$cust->getBalance()}\n";
var_dump($cust);

echo ($service->remove($cust)) ? "Customer {$cust->getId()} REMOVED<br>" : "Customer {$cust->getId()} NOT REMOVED<br>";
