<?php

require "../services/Autoloader.php";

spl_autoload_register([new Autoloader(), 'loadClass']);

$product = new Product();
var_dump($product);


function cacheModel(ModelInterface $model) {
    echo serialize($model->getAll());
}

cacheModel(new Autoloader());