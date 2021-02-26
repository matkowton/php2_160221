<?php

//namespace app\models;

class Product extends Model
{
    public $id;
    public $title;
    public $description;
    public $price;
    public $categoryId;

    public function getByCategoryId(int $id)
    {

    }

    public function getTableName(): string
    {
        return 'products';
    }
}