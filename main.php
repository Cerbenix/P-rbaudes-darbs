<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

$apiClient = new \App\ApiClient();

$amount = (float) readline('Input amount: ');
$currencyName = readline('Input currency: ');

echo PHP_EOL;

echo 'Result ' . $apiClient->convert($amount, $currencyName);



