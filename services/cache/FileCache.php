<?php


namespace app\services\cache;


use app\base\Application;

class FileCache
{
    protected $cacheDirectory = '';
    protected $fileExtension = '.cache';

    public function __construct()
    {
        $this->cacheDirectory = Application::getInstance()
                ->getParam('root_dir') . '/cache/';
        $this->checkFolder();
    }


    public function set(string $key, string $value)
    {
        file_put_contents($this->buildCachePath($key), $value);
    }

    public function get(string $key)
    {
        $file = $this->buildCachePath($key);
        if(file_exists($file)) {
            return file_get_contents($file);
        }
        return null;
    }

    public function exists(string $key)
    {
        return file_exists($this->buildCachePath($key));
    }

    protected function checkFolder() {
        if(!file_exists($this->cacheDirectory) || !is_dir($this->cacheDirectory)) {
            mkdir($this->cacheDirectory);
        }
    }

    protected function buildCachePath(string $key) {
        return $this->cacheDirectory . $key . $this->fileExtension;
    }
}