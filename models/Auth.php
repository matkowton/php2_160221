<?php

namespace app\models;

use app\base\Application;
use app\base\Session;
use app\models\records\User;
use app\models\repositories\UserRepository;

/**
 * Class Auth
 * Класс, содержащий логику авторизации пользователя в системе
 * @package app\models
 * @property User $currentUser текущий авторизованный пользователь.
 */
class Auth
{
    /** @var User */
    protected $currentUser = null;
    /** @var Session  */
    protected $session = null;

    public function __construct()
    {
        $this->session = Application::getInstance()->session;
    }


    /**
     * Авторизовать пользователя по его ИД
     * @param int $userId
     * @return bool
     */
    public function authById(int $userId): bool
    {
        $this->session->set('user_id', $userId);
        return true;
    }

    /**
     * Получить экземплярд User для текущего авторизованного пользователя
     * @return User|null
     */
    public function getCurrentUser(): ?User
    {
        if (is_null($this->currentUser)) {
            if ($userId = $this->session->get('user_id')) {
                $this->currentUser = (new UserRepository())->getById($userId);
            }
        }
        return $this->currentUser;
    }

    /**
     * Разовтаризовать пользователя
     */
    public function logout()
    {
        $this->session->remove('user_id');
        $this->session->destroy();
    }
}