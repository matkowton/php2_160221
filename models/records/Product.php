<?php

namespace app\models\records;

use app\models\Discount;

class Product extends Record
{
    public $id;
    public $title;
    public $description;
    public $price;
    protected $discount;

   /* public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }*/

    public function getShortDescription()
    {
        
    }

    public function getPrice()
    {
        return $this->price - $this->discount->getDiscount() ;
    }
}