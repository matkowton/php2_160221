<?php


namespace app\interfaces;


interface RendererInterface
{
    public function render(string $templateName, array $params = []): string;
}