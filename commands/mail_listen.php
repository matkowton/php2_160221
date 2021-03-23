<?php
require __DIR__ . "/../vendor/autoload.php";
$config = require __DIR__ . "/../config/main.php";

\app\base\Application::getInstance()
    ->setConsoleMode()
    ->run($config);


while (true) {
    sleep(1);
    $client = \app\base\Application::getInstance()->queue;
    $message = $client->shift();
    echo $message->id, $message->message, "\n";
}