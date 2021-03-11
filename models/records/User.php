<?php


namespace app\records\models;

class User extends Record
{
    public $name;
    public $email;

    public function getByLogin(string $login)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE login = {$login}";
        return $this->db->queryOne($sql);
    }

    public function getTableName(): string
    {
        return 'users';
    }


}
