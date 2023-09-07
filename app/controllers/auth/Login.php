<?php

namespace Controllers\Auth;

use Core\Controller;
use Models\Users;


class Login
{

    use Controller;

    public $data = [
        "title" => "Login",
        "meta" => null,
        "errors" => []
    ];

    public function index()
    {

        $this->view('components/head', $this->data)
            . $this->view('auth/login', $this->data)
            . $this->view('components/footer');
    }

    public function validateInput()
    {
        $errors = [];
        $userModel = new Users;

        foreach ($_POST as $field => $value) {
            if (empty($value)) {
                $errors[$field] = ucfirst($field) . " is required!";
            }
        }

        $check = $userModel->first($_POST);

        if ($check) {
            $email_address = $check->email_address;
            $password = $check->password;

            if ($_POST["password"] == $password) {

                $_SESSION["user"] = [
                    "user_id" => $check->user_id,
                    "email_address" => $email_address,
                    "is_logged_in" => true,
                ];

                http_response_code(200);
                echo json_encode(['success' => 'Login successful!']);
                exit();
            }
        } else {
            $errors[$field] = "Incorrect username or password.";
        }

        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode(['errors' => $errors]);
            exit();
        }
    }
}
