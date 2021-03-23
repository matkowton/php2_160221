<?php


namespace app\controllers;


use app\base\Application;
use app\base\QueueClient;

class MailController extends Controller
{

    public function actionIndex()
    {
        $message = json_encode([
           'user_id' => 1,
           'content' => 'hello, user!'
        ]);
        Application::getInstance()->queue->push($message);
        echo "отправлено";
    }
}