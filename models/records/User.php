<?php


namespace app\models\records;

class User extends Record
{
    public $id;
    public $login;
    public $password;

    public static function getByLoginPassword(string $login, string $password) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE login = :login AND password = :password";
        return static::getQuery($sql,[':login' => $login, ':password' => $password]);
    }

    public static function getTableName(): string
    {
        return 'users';
    }

    public static function authById(int $userId): bool
    {
        $_SESSION['user_id'] = $userId;
        return true;
    }

    public static function getCurrentUser(): ?array
    {
        if ($userId = $_SESSION['user_id']) {
            return static::getById($userId);
        }
        return null;
    }
}
