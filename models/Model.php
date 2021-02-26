<?php


abstract class Model implements ModelInterface
{
    protected $db;
    protected $tableName;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->db = new Db();
        $this->tableName = $this->getTableName();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->tableName}";
        return $this->db->queryAll($sql);
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id = {$id}";
        return $this->db->execute($sql);
    }
}