<?php

require "../config/main.php";
require "../vendor/autoload.php";
session_start();

$request = new \app\base\Request();

$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$action = $request->getActionName();

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    /** @var \app\controllers\ProductController $controller */
    $controller = new $controllerClass(new \app\services\renderers\TemplateRenderer());
    //$controller = new $controllerClass(new \app\services\renderers\TwigRenderer());
    try {
        $controller->run($action);
    } catch (\app\exceptions\ActionNotFoundException $exception) {
        echo "Поймал !!! Произошла ошибка {$exception->getMessage()}";
    }
}