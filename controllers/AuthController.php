<?php


namespace app\controllers;
use app\interfaces\RendererInterface;
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

    public function __construct(RendererInterface $renderer)
    {
        parent::__construct($renderer);
        $this->hash = new Hash();
    }

    /** Страничка логина/авторизация */
    public function actionLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $password = $this->hash->make($_POST['password']);

            if ($user = User::getByLoginPassword($login, $password)) {
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            if ($password == $confirmPassword) {
                $user = new User();
                $user->login = $login;
                $user->password = $this->hash->make($password);
                $user->save();
                $this->auth->authById($user->id);
                $this->redirect("/profile");
            }
        }
        echo $this->render('register');
    }
}