<?php
namespace App\Repository;

use App\Database\DatabaseConnection;
use App\Database\Select;
use App\Models\ProductType;
use PDO;

class ProductTypeRepository implements RepositoryInterface
{
    private Select $select;
    private const CLASS_NAME = 'App\Models\ProductType';
    public const TABLE_NAME = 'product_types';

    public function __construct(Select $select)
    {
        $this->select = $select;
    }
    public function getAll(): array
    {
        return $this->select->query(self::TABLE_NAME)->get(self::CLASS_NAME);
    }

    public function getById($id){
        return $this->select->query(self::TABLE_NAME)->where('id', '=', $id)->first(self::CLASS_NAME);
    }

    public function create($data){
        return 'create';
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