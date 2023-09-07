<?php

class AuthGuard
{
    public function handle($request)
    {
        $check_auth = $this->authenticate();

        if (!$check_auth) {
            header('Location: ' . ROOT . 'auth/login');
            exit;
        }
    }

    private function authenticate()
    {
        return isset($_SESSION['user_id']);
    }
}
