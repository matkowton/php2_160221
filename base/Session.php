<?php


namespace app\base;


class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->openSession();
    }

    public function openSession()
    {
        session_start();
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }


    public function exists(string $key): bool
    {
        return isset($_SESSION[$key]);
    }


}