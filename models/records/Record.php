<?php

namespace app\models\records;

use app\interfaces\RecordInterface;
use app\services\Db;

/**
 * Class Record
 * Абстрактный класс, описывающий поведение объектов-сущностей из предметной области
 * @package app\models\records
 * @property array $excludedProperties Перечень свойств объекта, которые следует исключать при построении запросов на INSERT/UPDATE
 */
abstract class Record
{
    public $excludedProperties =
        [
            'db',
            'tableName'
        ];
}