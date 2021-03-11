<?php


namespace app\controllers;

//product/card
use app\models\records\Product;

class ProductController extends Controller
{
    public function actionIndex()
    {
            $products = Product::getAll();
            echo $this->render('catalog', ['products' => $products]);
    }

    public function actionCard()
    {
            $id = $_GET['id'];
            /** @var Product $product */
            $product = Product::getById($id);
            echo $this->render('card', ['product' =>$product]);
    }
}