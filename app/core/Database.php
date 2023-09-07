<?php

namespace Core;

trait Database
{
    public function connect()
    {
        try {
            $dsn = 'mysql:host=localhost;dbname=development_realtime_chat;';
            $con = new \PDO($dsn, "root", "");

            return $con;
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchAll(\PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }

        return false;
    }

    // Rest of the trait code...
}
