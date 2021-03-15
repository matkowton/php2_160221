<?php

namespace app\models\records;

use app\interfaces\RecordInterface;
use app\services\Db;

/**
 * Class Record
 * Абстрактный класс, описывающий поведение объектов, получающий и содержащих данные из БД
 * @package app\models\records
 * @property Db $db Объект, обеспечивающий работу с БД
 * @property string $tableName Имя таблицы в БД, с которой работает данный класс
 * @property array $excludedProperties Перечень свойств объекта, которые следует исключать при построении запросов на INSERT/UPDATE
 */
abstract class Record implements RecordInterface
{
    protected $db;
    protected $tableName;
    protected $excludedProperties =
        [
            'db',
            'tableName'
        ];

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->tableName = $this->getTableName();
    }

    /** Получить все записи из таблицы (с возможностью указать конкретный перечень ид-ов) */
    public static function getAll(array $ids = [])
    {
        $tableName = static::getTableName();
        $where = '';

        if(!empty($ids)) {
            $placeholders = str_repeat('?,', count($ids) - 1) . '?';
            $where = " WHERE id IN ({$placeholders})";
        }

        $sql = "SELECT * FROM {$tableName}" . $where;
        return static::getQuery($sql, $ids);
    }

    /** Получить конкретную запись по ее ИД */
    public static function getById(int $id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return static::getQuery($sql, [':id' => $id])[0];
    }

    /** удалить запись из БД, с ид-м текущего объекта */
    public function delete()
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $this->id]);
    }

    /** Вставить новую запись в таблицу, на основе свойств текущего объекта */
    protected function insert()
    {
        $tableName = static::getTableName();

        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            if(in_array($key, $this->excludedProperties)) {
                continue;
            }

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->getLastInsertId();
    }

    /** Обновить запись в таблице, на основе данных текущего объекта */
    protected function update()
    {
        $tableName = static::getTableName();

        $params = [];
        $setSection = [];

        foreach ($this as $key => $value) {
            if(in_array($key, $this->excludedProperties)) {
                continue;
            }

            $params[":{$key}"] = $value;
            $setSection[] = "`{$key}` = :{$key}";
        }

        $setSection = implode(", ", $setSection);

        $sql = "UPDATE {$tableName} SET {$setSection}";
        $this->db->execute($sql, $params);
    }

    /** Сохранить состояние объекта (обновить или создать новую запись) */
    public function save()
    {
        if(is_null($this->id)) {
            $this->insert();
        }else {
            $this->update();
        }
    }

    /** Выполнить запрос, получив в результате набор объектов текущего класса */
    protected static function getQuery(string $sql, array $params = []) {
        return Db::getInstance()->queryAll($sql, $params, get_called_class());
    }
}