<?php

namespace app\models;

class Product extends Model
{
    public $id;
    public $title;
    public $description;
    public $price;

    public function getTableName(): string
    {
        return 'products';
    }
}