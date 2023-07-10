<?php
namespace App\Repository;

use App\Models\Sale;
use App\Database\Select;
use App\Database\Create;
use App\Database\Update;
use App\Database\Delete;

class SaleRepository implements RepositoryInterface
{
    private Select $select;
    private Create $create;
    private Update $update;
    private Delete $delete;
    private const CLASS_NAME = 'App\Models\Sale';
    private const TABLE_NAME = 'sales';

    public function __construct(Select $select, Create $create, Update $update, Delete $delete)
    {
        $this->select = $select;
        $this->create = $create;
        $this->update = $update;
        $this->delete = $delete;
    }

    public function getAll(): array
    {
        return $this->select->query(self::TABLE_NAME)->get(self::CLASS_NAME);
    }

    public function getById($id) : ?Sale
    {
        return $this->select->query(self::TABLE_NAME)->where('id', '=', $id)->first(self::CLASS_NAME);
    }

    public function create($sale) : ?bool
    {
        return $this->create->create(self::TABLE_NAME, $sale->toArray())->execute();
    }

    public function update($sale)
    {
        return $this->update->update(self::TABLE_NAME, $sale->toArrayToUpdate(), ['id', $sale->getId()])->execute();
    }

    public function delete($sale)
    {
        return $this->delete->delete(self::TABLE_NAME, ['id', $sale->getId()])->execute();
    }

    public function count()
    {
        $count = $this->select->query(self::TABLE_NAME, 'count')->first();
        return (int) $count->count;
    }
}