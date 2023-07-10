<?php

namespace App\Database;

class Create
{
    private string $sql;
    private array $data;

    public function create(string $table, array $data)
    {
        $this->sql = "INSERT INTO {$table} (";
        $this->sql .= implode(', ', array_keys($data)). ') VALUES (';
        $this->sql .= ':'.implode(', :', array_keys($data)).')';
        $this->data = $data;

        return $this;
    }

    public function execute()
    {
        $connection = DatabaseConnection::open();
        $rs = $connection->prepare($this->sql);
        return $rs->execute($this->data);
    }

    public function getSql()
    {
        return $this->sql;
    }
}
