<?php

namespace App\Database;

class Create
{
    private string $sql;

    public function create(string $table, array $data)
    {
        $this->sql = "INSERT INTO {$table} (";
        $this->sql .= implode(', ', array_keys($data)). ') VALUES (';
        $this->sql .= ':'.implode(', :', array_keys($data)).')';

    }

    public function getSql()
    {
        return $this->sql;
    }
}
