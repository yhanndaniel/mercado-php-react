<?php
namespace App\Database;

class Delete
{
    private string $sql;

    public function delete(string $table, array $where = [])
    {
        $this->sql = "DELETE FROM {$table} WHERE {$where[0]} = :{$where[0]}";
    }

    public function getSql(): string
    {
        return $this->sql;
    }
}
