<?php

namespace app\models;
use app\models\records\User;

/**
 * Class Auth
 * Класс, содержащий логику авторизации пользователя в системе
 * @package app\models
 * @property User $currentUser текущий авторизованный пользователь.
 */
class Auth
{
    protected $currentUser = null;

    /**
     * Авторизовать пользователя по его ИД
     * @param int $userId
     * @return bool
     */
    public function authById(int $userId): bool
    {
        $_SESSION['user_id'] = $userId;
        return true;
    }

    /**
     * Получить экземплярд User для текущего авторизованного пользователя
     * @return User|null
     */
    public function getCurrentUser(): ?User
    {
        if(is_null($this->currentUser)){
            if ($userId = $_SESSION['user_id']) {
                $this->currentUser = User::getById($userId);
            }
        }
        return $this->currentUser;
    }

    /**
     * Разовтаризовать пользователя
     */
    public function logout()
    {
        $_SESSION['user_id'] = null;
        session_destroy();
    }
}