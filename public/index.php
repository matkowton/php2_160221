<?php

require "../config/main.php";
require "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$product = new \app\models\Product();

var_dump($product->getById(2));