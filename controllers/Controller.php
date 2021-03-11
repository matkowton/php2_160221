<?php


namespace app\controllers;

use app\interfaces\RendererInterface;
use app\services\renderers\TemplateRenderer;
use app\services\renderers\TwigRenderer;

abstract class Controller
{
    protected $action = null;
    protected $defaultAction = 'index';
    protected $useLayout = true;
    protected $defaultLayout = 'main';
    protected $renderer = null;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }

    function render(string $template, array $params = [])
    {
        $content = $this->renderer->render($template, $params);
        if ($this->useLayout) {
            return $this->renderer->render('layouts/' . $this->defaultLayout, ['content' => $content]);
        }
        return $content;
    }

    public function redirect(string $url)
    {
        header("Location: {$url}");
        exit();
    }

    public function redirectToReferer()
    {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

}