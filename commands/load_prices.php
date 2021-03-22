<?php
require __DIR__ . "/../vendor/autoload.php";
$config = require __DIR__ . "/../config/main.php";

\app\base\Application::getInstance()
    ->setConsoleMode()
    ->run($config);

/** @var \app\models\repositories\ProductRepository $rep */
$rep = \app\base\Application::getInstance()->orm->get('product');

$file = fopen(__DIR__ . "/../prices.csv", "r");
while ($row = fgetcsv($file, 0, ";")) {
    $rep->updateById($row[0], ["price" => $row[1]]);
}