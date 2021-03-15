<?php


namespace app\models;


use app\models\records\Product;

class Basket
{
    /** Получение списка всех товаров в корзине */
    public function getAll(): array
    {
        $basket = [];
        if (!empty($_SESSION['basket'])) {
            $productIds = array_filter(
                array_keys($_SESSION['basket']),
                function ($element) {
                    return is_int($element);
                }
            );

            $products = Product::getAll($productIds);
            foreach ($products as $product) {
                $basket[] = [
                    'product' => $product,
                    'qty' => $_SESSION['basket'][$product->id]
                ];
            }
        }
        return $basket;
    }

    /** Добавить товар в корзину */
    public function add(int $productId, int $qty)
    {
        if(isset($_SESSION['basket'][$productId])) {
            $_SESSION['basket'][$productId] += $qty;
        } else {
            $_SESSION['basket'][$productId] = $qty;
        }
    }

    /** Удалить товар из корзины */
    public function remove(int $productId)
    {
        if(isset($_SESSION['basket'][$productId])){
            unset($_SESSION['basket'][$productId]);
        }
    }
}