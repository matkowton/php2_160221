<?php


namespace app\controllers;

//product/card
use app\models\records\Product;

class ProductController
{
    protected $action = null;
    protected $defaultAction = 'index';
    protected $useLayout = true;
    protected $defaultLayout = 'main';

    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if(method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }

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


    function renderTemplate(string $templateName, array $params = []): string
    {
        //extract(prepareViewParams());
        extract($params);
        ob_start();
        include VIEWS_DIR . $templateName . ".php";
        return ob_get_clean();
    }

    function render (string $template, array $params = []) {
        $content = $this->renderTemplate($template, $params);
        if($this->useLayout) {
            return $this->renderTemplate('layouts/' . $this->defaultLayout, ['content' => $content]);
        }
        return $content;
    }
}