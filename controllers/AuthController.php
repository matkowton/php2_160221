<?php


namespace app\controllers;
use app\models\records\User;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $password = $this->getHash($_POST['password']);

            if ($user = User::getByLoginPassword($login, $password)) {
                User::authById($user['id']);
                $this->redirect("/");
            } else {
                echo "Логин/пароль не верный!!!";
            }
        }
        echo $this->render('login');
    }

    public function actionLogout()
    {
        session_start();
        $_SESSION['user_id'] = null;
        session_destroy();
        $this->redirectToReferer();
    }

    public function actionRegister()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            if ($password == $confirmPassword) {
                $user = new User();
                $user->login = $login;
                $user->password = $this->getHash($password);
                $user->save();
                User::authById($user->id);
                $this->redirect("/profile");
            }
        }
        echo $this->render('register');
    }

    protected function getHash(string $string):string{
        $salt1 = 'trgf746';
        $salt2 = 'p58fbnn28';
        return md5($salt1 . $string . $salt2);
    }
}