<?php
namespace App\Database;

class Delete
{
    private string $sql;
    private string $table;
    private array $where;

    public function delete(string $table, array $where = [])
    {
        $this->sql = "DELETE FROM {$table} WHERE {$where[0]} = :{$where[0]}";
        $this->table = $table;
        $this->where = $where;

        return $this;
    }

    public function execute(): bool
    {
        $connection = DatabaseConnection::open();
        $rs = $connection->prepare($this->sql);

        return $rs->execute(array_merge([$this->where[0] => $this->where[1]]));
    }

    public function getSql(): string
    {
        return $this->sql;
    }
}
