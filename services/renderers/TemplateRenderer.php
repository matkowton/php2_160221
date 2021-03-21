<?php


namespace app\services\renderers;


use app\base\Application;
use app\interfaces\RendererInterface;

class TemplateRenderer implements RendererInterface
{
    protected $viewsDir;

    /**
     * TemplateRenderer constructor.
     */
    public function __construct(string $viewsDir)
    {
        $this->viewsDir = $viewsDir;
    }


    public function render(string $templateName, array $params = []): string
    {
        extract($params);
        ob_start();
        include  $this->viewsDir . $templateName . ".php";
        return ob_get_clean();
    }

}