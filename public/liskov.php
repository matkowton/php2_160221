<?php

class Rectangle {
    protected $height;
    protected $width;

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }


}

class Square extends Rectangle {
    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
        $this->width = $height;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
        $this->height = $width;
    }
}

function calculateArea(Rectangle $figure) {
    return $figure->getHeight() * $figure->getWidth();
}

$figure = new Square();
$figure->setHeight(4);
$figure->setWidth(5);
var_dump(calculateArea($figure));