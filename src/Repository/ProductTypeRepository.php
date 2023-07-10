<?php
namespace App\Repository;

use App\Database\Create;
use App\Database\DatabaseConnection;
use App\Database\Delete;
use App\Database\Select;
use App\Database\Update;
use App\Models\ProductType;
use PDO;

class ProductTypeRepository implements RepositoryInterface
{
    private Select $select;
    private Create $create;
    private Update $update;
    private Delete $delete;
    private const CLASS_NAME = 'App\Models\ProductType';
    public const TABLE_NAME = 'product_types';

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

    public function getById($id) : ?ProductType{
        return $this->select->query(self::TABLE_NAME)->where('id', '=', $id)->first(self::CLASS_NAME);
    }

    public function create($productType) : ?bool{
        return $this->create->create(self::TABLE_NAME, $productType->toArray())->execute();
    }

    public function update($productType){
        return $this->update->update(self::TABLE_NAME, $productType->toArrayToUpdate(), ['id', $productType->getId()])->execute();
    }

    public function delete($productType){
        return $this->delete->delete(self::TABLE_NAME, ['id', $productType->getId()])->execute();
    }

    public function count(){
        $count = $this->select->query(self::TABLE_NAME, 'count')->first();
        return (int) $count->count;
    }
}