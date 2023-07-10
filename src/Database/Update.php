<?php
namespace App\Database;

class Update
{
    private string $sql;

    public function update(string $table, array $data, array $where = []): bool
    {
        $this->sql = "UPDATE {$table} SET ";
        foreach ($data as $key => $value) {
            $this->sql .= "{$key} = :{$key}, ";
        }
        $this->sql = rtrim($this->sql, ', ');
        $this->sql .= " WHERE {$where[0]} = :{$where[0]}";

        $connection = DatabaseConnection::open();
        $rs = $connection->prepare($this->sql);

        return $rs->execute(array_merge($data, [$where[0] => $where[1]]));
    }

    public function getSql(): string
    {
        return $this->sql;
    }
}
