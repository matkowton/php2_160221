<?php


namespace app\models\repositories;


use app\models\records\User;

class UserRepository extends Repository
{
    public function getByLoginPassword(string $login, string $password)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE login = :login AND password = :password";
        return static::getQuery($sql, [':login' => $login, ':password' => $password])[0];
    }

    public function getTableName(): string
    {
        return 'users';
    }

    public function getRecordClass(): string
    {
        return User::class;
    }


}