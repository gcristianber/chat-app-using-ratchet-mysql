<?php

namespace Controllers\Auth;

use Core\Controller;

class Logout
{
    use Controller;

    public function index()
    {
        session_unset();
        session_destroy();
        header("location: " . ROOT . "auth/login");
    }
}
