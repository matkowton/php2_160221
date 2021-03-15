<?php


namespace app\services\renderers;
use app\interfaces\RendererInterface;

class TwigRenderer implements RendererInterface
{
    protected $renderer;

    /**
     * TwigRenderer constructor.
     */
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(TWIG_VIEWS_DIR );
        $this->renderer = new \Twig\Environment($loader, []);
    }

    public function render($template, $params = []): string
    {
        $template .= ".twig";
        return $this->renderer->render($template, $params);
    }
}