<?php


namespace app\controllers;

//product/card
use app\models\records\Product;

class ProductController extends Controller
{
    /** Каталог товаров */
    public function actionIndex()
    {
        $products = Product::getAll();
        echo $this->render('catalog', ['products' => $products]);
    }

    /** Карточка товара */
    public function actionCard()
    {
        $id = $_GET['id'];
        /** @var Product $product */
        $product = Product::getById($id);
        echo $this->render('card', ['product' => $product]);
    }
}