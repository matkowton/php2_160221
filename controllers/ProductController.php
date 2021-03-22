<?php


namespace app\controllers;

//product/card
use app\base\Application;
use app\models\records\Product;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = Application::getInstance()->orm->get('product');
    }


    /** Каталог товаров */
    public function actionIndex()
    {
        $products = $this->productRepository->getAll();
        echo $this->render('catalog', ['products' => $products]);
    }

    /** Карточка товара */
    public function actionCard()
    {
        $id = $this->request->get('id');

        /** @var Product $product */
        $product = $this->productRepository->getById($id);
        echo $this->render('card', ['product' => $product]);
    }
}