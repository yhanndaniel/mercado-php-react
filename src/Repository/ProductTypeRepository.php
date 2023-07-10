<?php
namespace App\Repository;

use App\Database\Create;
use App\Database\DatabaseConnection;
use App\Database\Select;
use App\Models\ProductType;
use PDO;

class ProductTypeRepository implements RepositoryInterface
{
    private Select $select;
    private Create $create;
    private const CLASS_NAME = 'App\Models\ProductType';
    public const TABLE_NAME = 'product_types';

    public function __construct(Select $select, Create $create)
    {
        $this->select = $select;
        $this->create = $create;
    }
    public function getAll(): array
    {
        return $this->select->query(self::TABLE_NAME)->get(self::CLASS_NAME);
    }

    public function getById($id){
        return $this->select->query(self::TABLE_NAME)->where('id', '=', $id)->first(self::CLASS_NAME);
    }

    public function create($productType){
        return $this->create->create(self::TABLE_NAME, $productType->toArray())->execute();
    }

    public function update($data, $id){
        return 'update';
    }

    public function delete($id){
        return 'delete';
    }

    public function count(){
        return 'count';
    }
}