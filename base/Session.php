<?php


namespace app\base;


class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->open();
    }

    public function open()
    {
        session_start();
    }

    public function destroy()
    {
        session_destroy();
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

    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }
}