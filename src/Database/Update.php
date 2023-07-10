<?php
namespace App\Database;

class Update
{
    private string $sql;
    private array $data;
    private array $where;

    public function update(string $table, array $data, array $where = [])
    {
        $this->sql = "UPDATE {$table} SET ";
        foreach ($data as $key => $value) {
            $this->sql .= "{$key} = :{$key}, ";
        }
        $this->sql = rtrim($this->sql, ', ');
        $this->sql .= " WHERE {$where[0]} = :{$where[0]}";
        $this->data = $data;
        $this->where = $where;

        return $this;
    }

    public function execute()
    {
        $connection = DatabaseConnection::open();
        $rs = $connection->prepare($this->sql);

        return $rs->execute(array_merge($this->data, [$this->where[0] => $this->where[1]]));
    }

    public function getSql(): string
    {
        return $this->sql;
    }
}
