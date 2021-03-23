<?php


class AuthTest extends \PHPUnit\Framework\TestCase
{
    public function testLogin()
    {
        $auth = new \app\models\Auth();
        $this->assertTrue($auth->login());
    }
}