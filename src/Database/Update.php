<?php
namespace App\Database;

class Update
{
    private string $sql;

    public function update(string $table, array $data, array $where = []): void
    {
        $this->sql = "UPDATE {$table} SET ";
        foreach ($data as $key => $value) {
            $this->sql .= "{$key} = :{$key}, ";
        }
        $this->sql = rtrim($this->sql, ', ');
        $this->sql .= " WHERE {$where[0]} = :{$where[0]}";
    }

    public function getSql()
    {
        return $this->sql;
    }
}
