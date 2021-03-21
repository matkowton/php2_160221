<?php


namespace app\models\repositories;


use app\base\Application;
use app\interfaces\RepositoryInterface;
use app\models\records\Record;
use app\services\Db;

/**
 * Класс для получения/сохоранения/обновления record-ов
 * Class Repository
 * @package app\models\repositories
 *
 * @property Db $db Класс, управляющий соединением с БД
 * @property string $tableName имя таблицы, с которой работает репозиторий
 */
abstract class Repository implements RepositoryInterface
{
    protected $db;
    protected $tableName;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->db = Application::getInstance()->connection;
        $this->tableName = $this->getTableName();
    }

    /** Получить все записи из таблицы (с возможностью указать конкретный перечень ид-ов) */
    public function getAll(array $ids = [])
    {
        $tableName = $this->getTableName();
        $where = '';

        if(!empty($ids)) {
            $placeholders = str_repeat('?,', count($ids) - 1) . '?';
            $where = " WHERE id IN ({$placeholders})";
        }

        $sql = "SELECT * FROM {$tableName}" . $where;
        return $this->getQuery($sql, $ids);
    }

    /** Получить конкретную запись по ее ИД */
    public function getById(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->getQuery($sql, [':id' => $id])[0];
    }

    /** удалить запись из БД, с ид-м текущего объекта */
    public function delete(Record $record)
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $record->id]);
    }

    /** Вставить новую запись в таблицу, на основе свойств текущего объекта */
    public function insert(Record $record): Record
    {
        $tableName = $this->getTableName();

        $params = [];
        $columns = [];

        foreach ($record as $key => $value) {
            if(in_array($key, $record->excludedProperties)) {
                continue;
            }

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $record->id = $this->db->getLastInsertId();
        return $record;
    }

    /** Обновить запись в таблице, на основе данных текущего объекта */
    public function update(Record $record)
    {
        $tableName = static::getTableName();

        $params = [];
        $setSection = [];

        foreach ($record as $key => $value) {
            if(in_array($key, $record->excludedProperties)) {
                continue;
            }

            $params[":{$key}"] = $value;
            $setSection[] = "`{$key}` = :{$key}";
        }

        $setSection = implode(", ", $setSection);

        $sql = "UPDATE {$tableName} SET {$setSection}";
        return $this->db->execute($sql, $params);
    }

    /** Сохранить состояние объекта (обновить или создать новую запись) */
    public function save(Record $record)
    {
        if(is_null($record->id)) {
            $this->insert($record);
        }else {
            $this->update($record);
        }
    }

    /** Выполнить запрос, получив в результате набор объектов текущего класса */
    protected function getQuery(string $sql, array $params = []) {
        return $this->db->queryAll($sql, $params, $this->getRecordClass());
    }
}