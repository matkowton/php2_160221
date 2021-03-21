<?php


namespace app\base;


use app\models\Auth;
use app\services\Db;
use app\services\renderers\TemplateRenderer;
use app\traits\SingletonTrait;

/**
 * Class Application
 * @package app\base
 * @property Request $request
 * @property Session $session
 * @property Db $connection
 * @property Auth $auth
 * @property TemplateRenderer $renderer
 */
class Application
{
    use SingletonTrait;

    protected $config = [];
    /** @var ComponentsFactory */
    protected $componentsFactory = null;
    protected $components = [];

    public function run(array $config)
    {
        $this->config = $config;
        $this->componentsFactory = new ComponentsFactory();

        $controllerName = $this->request->getControllerName() ?: $this->getParam('default_controller');
        $action =  $this->request->getActionName();

        $controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            try {
                $controller->run($action);
            } catch (\app\exceptions\ActionNotFoundException $exception) {
                echo "Поймал !!! Произошла ошибка {$exception->getMessage()}";
            }
        }
    }

    public function __get($name)
    {
        if (!isset($this->components[$name])) {
            if ($params = $this->config['components'][$name]) {
                $this->components[$name] = $this->componentsFactory
                    ->createComponent($name, $params);
            } else {
                throw new \Exception("Не найдена конфигурация для компонентта {$name}");
            }
        }
        return $this->components[$name];
    }

    public function getParam(string $name)
    {
        return $this->config[$name];
    }
}