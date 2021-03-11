<?php

namespace app\models;

class Category extends Record
{
    public $id;
    public $name;

    public static function getTableName(): string
    {
        return 'categories';
    }
}