<?php


namespace app\controllers;


abstract class Controller
{
    protected $action = null;
    protected $defaultAction = 'index';
    protected $useLayout = true;
    protected $defaultLayout = 'main';

    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if(method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }
    public function renderTemplate(string $templateName, array $params = []): string
    {
        //extract(prepareViewParams());
        extract($params);
        ob_start();
        include VIEWS_DIR . $templateName . ".php";
        return ob_get_clean();
    }

    function render (string $template, array $params = []) {
        $content = $this->renderTemplate($template, $params);
        if($this->useLayout) {
            return $this->renderTemplate('layouts/' . $this->defaultLayout, ['content' => $content]);
        }
        return $content;
    }

    public function redirect (string $url) {
        header("Location: {$url}");
        exit();
    }

    public function redirectToReferer() {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

}