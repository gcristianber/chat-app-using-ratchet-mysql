<?php

namespace Core;

session_start();

trait Controller
{

    public function __construct()
    {
        $user_id = $_SESSION["user"]["user_id"] ?? "guest";
        $random_salt = bin2hex(random_bytes(16)); // Generate a random 128-bit salt
        $this->data["token_id"] = hash('sha256', $user_id . $random_salt);
        $_SESSION["user"]["token_salt"] = $random_salt; // Store the salt in the session
    }


    public function view($view, $data = [])
    {

        if (!empty($data))
            extract($data);

        require("../app/views/" . $view . ".view.php");
    }
}
