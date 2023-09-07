<?php

namespace Core;

use Core\Database;

trait Model
{

    use Database;

    public $errors = [];

    public function findAll()
    {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }

    public function findById($id, $id_column = "")
    {
        $query = "SELECT $id_column FROM $this->table WHERE $id_column = :$id_column";
        $data[$id_column] = $id;

        $result = $this->query($query, $data);

        if ($result)
            return $result[0];

        return false;
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");
        $data = array_merge($data, $data_not);

        $result = $this->query($query, $data);
        if ($result)
            return $result[0];

        return false;
    }

    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function insert($data)
    {
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(", ", $keys) . ") VALUES (:" . implode(", :", $keys) . ")";
        $this->query($query, $data);

        return true;
    }

    public function update($id, $data, $id_column = "")
    {
        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ", ");

        $query = " WHERE $id_column = :$id_column";

        $data[$id_column] = $id;
        $this->query($query, $data);
        return false;
    }

    public function countAll()
    {
        $query = "SELECT count(*) as count FROM $this->table";
        return $this->query($query);
    }

    public function countByCriteria($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "SELECT count(*) as count FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }
}
