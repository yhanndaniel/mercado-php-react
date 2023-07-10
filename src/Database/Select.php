<?php

namespace App\Database;

use PDO;
use stdClass;

class Select
{
    private ?string $table = null;
    private ?string $sql = null;
    private ?string $order = null;
    private ?string $limit = null;
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
        $fieldPlaceholder = $field;

        if (str_contains($fieldPlaceholder, '.')) {
            $fieldPlaceholder = str_replace('.', '', $fieldPlaceholder);
        }

        $this->wheres[] = "{$field} {$operator} :{$fieldPlaceholder} {$type} ";

        $this->binds[$fieldPlaceholder] = $value;

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

    private function dump() :void
    {
        $this->sql.= (!empty($this->joins)) ? rtrim(implode('', $this->joins)) : '';
        $this->sql.= (!empty($this->wheres)) ? rtrim(' WHERE '.implode('', $this->wheres)) : '';
        $this->sql.= $this->order ?? '';
        $this->sql.= $this->limit ?? '';
    }

    private function reset() :void
    {
        $this->table = null;
        $this->sql = null;
        $this->order = null;
        $this->limit = null;
        $this->wheres = [];
        $this->joins = [];
        $this->binds = [];
    }

    public function get($class = 'stdClass')
    {
        $this->dump();
        $sql = $this->sql;
        $binds = $this->binds;
        $this->reset();
        
        $connection = DatabaseConnection::open();
        $rs = $connection->prepare($sql);
        $rs->execute($binds ?? []);
        DatabaseConnection::close($connection);

        return $rs->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function first($class = 'stdClass')
    {
        $this->dump();
        $sql = $this->sql;
        $binds = $this->binds;
        $this->reset();
        
        $connection = DatabaseConnection::open();
        $rs = $connection->prepare($sql);
        $rs->execute($binds ?? []);
        DatabaseConnection::close($connection);

        return $rs->fetchObject($class);
    }

    public function test() :object
    {
        $this->dump();
        $sql = $this->sql;
        $binds = $this->binds;
        $this->reset();
        return (object)[
            'sql' => $sql,
            'binds' => $binds
        ];
    }
}
