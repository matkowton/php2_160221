<?php


require "../vendor/autoload.php";
$config = require "../config/main.php";

\app\base\Application::getInstance()->run($config);
