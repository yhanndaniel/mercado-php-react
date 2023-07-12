<?php
namespace App\Repository;

use App\Interfaces\RepositoryInterface;
use App\Models\CartProduct;
use App\Database\Select;
use App\Database\Create;
use App\Database\Update;
use App\Database\Delete;

class CartProductRepository implements RepositoryInterface
{
    private Select $select;
    private Create $create;
    private Update $update;
    private Delete $delete;
    private const CLASS_NAME = 'App\Models\CartProduct';
    private const TABLE_NAME = 'cart_products';

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

    public function getById($id) : array
    {
        return $this->select->query(self::TABLE_NAME)->where('cart_id', '=', $id)->get(self::CLASS_NAME);
    }

    public function create($cartProduct) : ?bool
    {
        return $this->create->create(self::TABLE_NAME, $cartProduct->toArray())->execute();
    }

    public function update($cartProduct)
    {
        return $this->update->update(self::TABLE_NAME, $cartProduct->toArrayToUpdate(), ['id', $cartProduct->getId()])->execute();
    }

    public function delete($cartProduct)
    {
        return $this->delete->delete(self::TABLE_NAME, ['id', $cartProduct->getId()])->execute();
    }

    public function count()
    {
        $count = $this->select->query(self::TABLE_NAME, 'count')->first();
        return (int) $count->count;
    }

}
