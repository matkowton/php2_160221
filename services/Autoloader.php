<?php
//namespace app\services;

class Autoloader
{
    public $paths = [
        'models',
        'services'
    ];

    public function loadClass(string $className): bool
    {
        foreach ($this->paths as $dir) {
            $filename = realpath($_SERVER['DOCUMENT_ROOT'] . "/../{$dir}/{$className}.php");
            if(file_exists($filename)) {
                include $filename;
                return true;
            }
        }
        return false;
    }
}