<?php
return [
    'root_dir' => realpath(__DIR__ . "/../"),
    'root_namespace' => 'app',
    'default_controller' => 'product',
    'views_dir' => realpath(__DIR__ . "/../") . "/views/",
    'components' => [
        'request' => [
            'class' => \app\base\Request::class
        ],
        'session' => [
            'class' => \app\base\Session::class
        ],
        'connection' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'login' => 'root',
            'password' => 'root',
            'dbName' => 'main_db',
            'charset' => 'utf8',
        ],
        'auth' => [
            'class' => \app\models\Auth::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class,
            'viewsDir' => realpath(__DIR__ . "/../") . "/views/"
        ],
        'orm' => [
            'class' => \app\base\OrmFactory::class,
            'namespace' => '\app\models\repositories\\'
        ]
    ]
];