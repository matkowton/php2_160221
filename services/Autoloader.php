<?php

namespace app\services;

class Autoloader
{
    private $fileExtension = ".php";


    //app\models\Product
    public function loadClass(string $className): bool
    {
        $className = str_replace(ROOT_NAMESPACE, ROOT_DIR, $className);
        $filename = realpath($className . $this->fileExtension);
        if (file_exists($filename)) {
            include $filename;
            return true;
        }

        return false;
    }
}