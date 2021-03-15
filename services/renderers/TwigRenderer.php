<?php


namespace app\services\renderers;
use app\interfaces\RendererInterface;

class TwigRenderer implements RendererInterface
{
    /**
     * @param string $template
     * @param array $params
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($template, $params = []): string
    {
        $loader = new \Twig\Loader\FilesystemLoader(TWIG_VIEWS_DIR);
        $twig = new \Twig\Environment($loader, );
        $template .= ".twig";
        return $twig->render($template, $params);
    }
}