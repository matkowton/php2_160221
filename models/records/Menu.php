<?php


namespace app\models\records;


class Menu extends Record
{
    public $id;
    public $title;
    public $link;
    public $order;
    public $access;

    public static function getTableName(): string
    {
        return 'menu';
    }

    public static function getOrderedList(array $accessLevels = [])
    {
        if(empty($accessLevels)) {
            $accessLevels = [0];
        }
        $placeholders = str_repeat('?,', count($accessLevels) - 1) . '?';
        $sql = "SELECT * FROM menu 
            WHERE access IN ({$placeholders}) 
            ORDER BY `order`";
        return static::getQuery($sql, $accessLevels);
    }

}