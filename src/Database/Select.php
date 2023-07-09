<?php

namespace App\Database;

class Select
{
    private string $table;
    private string $sql;
    private string $order;
    private string $limit;
    private array $wheres = [];
    private array $joins = [];
    private array $binds = [];

    public function query(string $table)
    {
        $this->table = $table;
        $this->sql = 'SELECT * FROM ' . $this->table;
        return $this;
    }

    public function where(string $field, string $operator, mixed $value, ?string $type = null)
    {
        $this->wheres[] = "{$field} {$operator} :{$field} {$type} ";

        $this->binds[$field] = $value;

        return $this;
    }

    public function join(string $SecondaryTable, string $primaryKey, string $foreignKey)
    {
        $this->joins[] = " INNER JOIN {$SecondaryTable} ON {$SecondaryTable}.{$foreignKey} = {$this->table}.{$primaryKey}";
        return $this;
    }

    public function order(string $field, string $direction = 'ASC')
    {
        $this->order = " ORDER BY {$field} {$direction}";
        return $this;
    }

    public function limit(int $limit)
    {
        $this->limit = " LIMIT {$limit}";
        return $this;
    }

    public function dump()
    {
        $this->sql.= (!empty($this->joins)) ? rtrim(implode('', $this->joins)) : '';
        $this->sql.= (!empty($this->wheres)) ? rtrim(' WHERE '.implode('', $this->wheres)) : '';
        $this->sql.= $this->order ?? '';
        $this->sql.= $this->limit ?? '';
    }

    public function get()
    {
        $this->dump();
        return (object)[
            'sql' => $this->sql,
            'binds' => $this->binds
        ];
    }
}
