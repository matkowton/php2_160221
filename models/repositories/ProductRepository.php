<?php


namespace app\models\repositories;


use app\models\records\Product;

class ProductRepository extends Repository
{
    public function getTableName(): string
    {
        return 'products';
    }

    public function getRecordClass(): string
    {
        return Product::class;
    }

}