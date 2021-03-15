<?php


namespace app\services\renderers;


use app\interfaces\RendererInterface;

class TemplateRenderer implements RendererInterface
{
    public function render(string $templateName, array $params = []): string
    {
        extract($params);
        ob_start();
        include VIEWS_DIR . $templateName . ".php";
        return ob_get_clean();
    }

}