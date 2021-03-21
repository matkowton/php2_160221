<?php


namespace app\controllers;

//product/card
use app\base\Application;
use app\models\records\Product;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
    /** Каталог товаров */
    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll();
        echo $this->render('catalog', ['products' => $products]);
    }

    /** Карточка товара */
    public function actionCard()
    {
        $id = $this->request->get('id');

        /** @var Product $product */
        $product = (new ProductRepository())->getById($id);
        echo $this->render('card', ['product' => $product]);
    }
}