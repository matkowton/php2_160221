<?php


namespace app\models\repositories;


use app\models\records\Menu;

class MenuRepository extends Repository
{
    public function getTableName(): string
    {
        return 'menu';
    }

    public function getRecordClass(): string
    {
        return Menu::class;
    }


    public function getOrderedList(array $accessLevels = [])
    {
        if(empty($accessLevels)) {
            $accessLevels = [0];
        }
        $placeholders = str_repeat('?,', count($accessLevels) - 1) . '?';
        $sql = "SELECT * FROM menu 
            WHERE access IN ({$placeholders}) 
            ORDER BY `order`";
        return $this->getQuery($sql, $accessLevels);
    }
}