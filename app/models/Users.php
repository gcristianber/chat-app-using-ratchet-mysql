<?php

namespace Models;

use Core\Model;

class Users
{
    use Model;

    protected $table = "users";

    private $user_id;

    public function set_user_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }
}
