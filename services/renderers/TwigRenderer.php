<?php


namespace app\services\renderers;
use app\interfaces\RendererInterface;

class TwigRenderer implements RendererInterface
{
    public function render(string $templateName, array $params = []): string
    {
        return '';
    }
}