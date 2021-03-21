<?php

namespace app\controllers;

use app\base\Application;
use app\exceptions\ActionNotFoundException;
use app\interfaces\RendererInterface;
use app\models\records\Menu;
use app\models\Auth;
use app\models\repositories\MenuRepository;

/**
 * Class Controller
 * @package app\controllers
 * @property string $action название текущего исполняемого экшена
 * @property string $defaultAction название экшена, который будет исполнятся по дефолту
 * @property bool $useLayout флаг, будет ли испольховаться лэйаут при рендеоинге
 * @property string $defaultLayout название шаблона лэйаута, используемого по умолчанию
 * @property RendererInterface|null $renderer объект, занимающийся натягиванием данных на шаблон
 * @property Auth $auth объект, содержащий логику авторизации пользователя
 */
abstract class Controller
{
    protected $action = null;
    protected $defaultAction = 'index';
    protected $useLayout = true;
    protected $defaultLayout = 'main';
    protected $renderer = null;
    protected $request = null;


    /** @var Auth */
    protected $auth;

    /**
     * Controller constructor.
     * @param RendererInterface $renderer
     */
    public function __construct()
    {
        $this->request = Application::getInstance()->request;
        $this->renderer = Application::getInstance()->renderer;
        $this->auth = Application::getInstance()->auth;
    }

    /** Запуск экшена контроллера
     * @param null|string $action название экшена
     */
    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            throw new ActionNotFoundException("Указанный action не найден!");
        }
    }

    /** Подготовка параметров для лэйаута */
    protected function getLayoutParams(): array
    {
        $menuAccessLevel = [0];
        if ($user = $this->auth->getCurrentUser()) {
            $menuAccessLevel[] = 2;
        } else {
            $menuAccessLevel[] = 1;
        }
        $menu = (new MenuRepository())->getOrderedList($menuAccessLevel);
        return ['menu' => $menu];
    }

    /** Логика рендеренга (с лэйаутом/без) */
    public function render(string $template, array $params = [])
    {
        $content = $this->renderer->render($template, $params);
        if ($this->useLayout) {
            $params = $this->getLayoutParams();
            $params['content'] = $content;
            return $this->renderer->render('layouts/' . $this->defaultLayout, $params);
        }
        return $content;
    }

    /** Редирект */
    public function redirect(string $url)
    {
        header("Location: {$url}");
        exit();
    }

    /** Редирект на предыдущую старницу */
    public function redirectToReferer()
    {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}