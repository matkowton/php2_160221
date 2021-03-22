<?php


namespace app\base;

class OrmFactory
{
    protected $orms = [];
    protected $namespace;

    /**
     * OrmFactory constructor.
     * @param $namespace
     */
    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
    }


    public function get(string $name)
    {
        if(!isset($this->orms[$name])) {
            $className = $this->namespace . ucfirst($name) . 'Repository';
            if(class_exists($className)) {
                $this->orms[$name] = new $className();
            }else {
                throw new \Exception("Класс не найден");
            }
        }
        return $this->orms[$name];
    }
}