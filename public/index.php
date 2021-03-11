<?php

require "../config/main.php";
require "../services/Autoloader.php";
require "../vendor/autoload.php";
spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);
session_start();

if (!$requestUri = preg_replace(['#^/#', '#[?].*#', '#/$#'], "", $_SERVER['REQUEST_URI'])) {
    $requestUri = DEFAULT_CONTROLLER;
}

$parts = explode("/", $requestUri);
$controllerName = $parts[0];
$action = $parts[1];

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)) {
    /** @var \app\controllers\ProductController $controller */
    $controller = new $controllerClass(new \app\services\renderers\TemplateRenderer());
    $controller->run($action);
}