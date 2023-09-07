<?php

namespace Controllers\Chat;

use Core\Controller;

class Messages
{

    use Controller;

    public $data = [
        "title" => "Messages",
        "meta" => null,
        "errors" => [],
    ];

    public function index()
    {


        $this->view('components/head', $this->data)
            . $this->view('chat/messages', $this->data)
            . $this->view('components/footer');
    }
}
