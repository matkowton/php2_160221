<?php

namespace app\models;

use app\base\Application;
use app\models\repositories\ProductRepository;
use app\base\Session;

class Basket
{
    /** @var Session */
    protected $session;
    /** @var ProductRepository */
    protected $productRepository;

    public function __construct()
    {
        $this->session = Application::getInstance()->session;
        $this->productRepository = new ProductRepository();
    }


    /** Получение списка всех товаров в корзине */
    public function getAll(): array
    {
        $basket = [];
        $productIds = [];

        if ($this->session->exists('basket')) {
            $items = $this->session->get('basket');
            $productIds = array_filter(
                array_keys($items),
                function ($element) {
                    return is_int($element);
                }
            );
        }

        if ($productIds) {
            $products = $this->productRepository->getAll($productIds);
            foreach ($products as $product) {
                $basket[] = [
                    'product' => $product,
                    'qty' => $items[$product->id]
                ];
            }
        }

        return $basket;
    }

    /** Добавить товар в корзину */
    public function add(int $productId, int $qty)
    {
        $basket = $this->session->get('basket');

        if (isset($basket[$productId])) {
            $basket[$productId] += $qty;
        } else {
            $basket[$productId] = $qty;
        }
        $this->session->set('basket', $basket);
    }

    /** Удалить товар из корзины */
    public function remove(int $productId)
    {
        $basket = $this->session->get('basket');
        if ($basket[$productId]) {
            unset($basket[$productId]);
        }
        $this->session->set('basket', $basket);
    }
}