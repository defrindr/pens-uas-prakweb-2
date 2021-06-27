<?php

class User
{
    private $_user = [];

    public function __construct()
    {
        $this->_user = ($_SESSION['user']) ? $_SESSION['user'] : [];
        return $this;
    }

    public function login($user)
    {
        $this->_user = $user;
        $_SESSION['user'] = $this->_user;
    }

    public function logout()
    {
        $this->_user = [];
        unset($_SESSION['user']);
    }

    public function getUser()
    {

        return ($this->isLogin()) ? $this->_user : null;
    }

    public function isLogin()
    {
        if (self::$_user == []) {
            return false;
        }
        return true;
    }

    public function get($name)
    {
        return $this->_user->$name ?? null;
    }

}
