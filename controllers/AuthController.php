<?php


namespace app\controllers;
use app\models\repositories\UserRepository;
use app\services\Hash;
use app\models\records\User;

/**
 * Контроллер, управляющий авторизацией
 * Class AuthController
 * @package app\controllers
 *
 * @property $hash Объект, управляющий хэшированием
 */
class AuthController extends Controller
{
    /** @var Hash  */
    protected $hash;

    public function __construct()
    {
        parent::__construct();
        $this->hash = new Hash();
    }

    /** Страничка логина/авторизация */
    public function actionLogin()
    {
        if ($this->request->isPost()) {
            $login = $this->request->post('login');
            $password = $this->hash->make($this->request->post('password'));

            if ($user = (new UserRepository())->getByLoginPassword($login, $password)) {
                $this->auth->authById($user->id);
                $this->redirect("/");
            } else {
                echo "Логин/пароль не верный!!!";
            }
        }
        echo $this->render('login');
    }

    /** Выход */
    public function actionLogout()
    {
        $this->auth->logout();
        $this->redirectToReferer();
    }

    /** Регистрация нового пользователя */
    public function actionRegister()
    {
        if ($this->request->isPost()) {
            $login = $this->request->post('login');
            $password = $this->request->post('password');
            $confirmPassword = $this->request->post('confirm_password');
            if ($password == $confirmPassword) {
                $user = new User();
                $user->login = $login;
                $user->password = $this->hash->make($password);
                (new UserRepository())->save($user);
                $this->auth->authById($user->id);
                $this->redirect("/profile");
            }
        }
        echo $this->render('register');
    }
}