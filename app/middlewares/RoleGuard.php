<?php

class RoleGuard
{
    private $allowedRoles;

    public function __construct($allowedRoles)
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function handle($request)
    {
        $userRole = $this->getUserRole();

        if (!$this->isAuthorized($userRole)) {
            header('Location: ' . ROOT . 'error/unauthorized');
            exit;
        }

        return $request;
    }

    private function isAuthorized($userRole)
    {
        return in_array($userRole, $this->allowedRoles);
    }

    private function getUserRole()
    {
        return $_SESSION['user_role'] ?? 'guest';
    }
}
