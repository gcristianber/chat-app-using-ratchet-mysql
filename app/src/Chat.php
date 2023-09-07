<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{

    protected $clients;
    protected $model;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->model = new \Models\Messages;

        echo "Server Started!";
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        $conn->send("Hello");

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        $data = json_decode($msg, true);

        $message = [
            "user_id" => $data["user_id"],
            "message" => $data["message"],
            "sent_date" => date("d-m-y h:i:s")
        ];

        $data["from"] = $data["user_id"];
        $data["message"] = $data["message"];
        $data["sent_date"] = date("d-m-y h:i:s");

        $this->model->insert($message);

        foreach ($this->clients as $client) {
            if ($from == $client) {
                // The sender is not the receiver, send to each client connected
                // $client->send($msg);
                $data["from"] = "me";
            } else {
                // $data["from"] = $user["name"];
                $data["from"] = "friend";
            }
            $client->send(json_encode($data));
        }
    }



    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
