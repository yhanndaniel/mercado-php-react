<?php
namespace App\Models;

use App\Helpers\Helpers;
use App\Repository\ProductRepository;
use DI\Container;
use DI\ContainerBuilder;
use JsonSerializable;
use stdClass;

class CartProduct implements JsonSerializable
{
    private int $products_id;
    private int $cart_id;
    private int $quantity;
    private float $total_amount;
    private float $total_tax;
    private float $total;
    private ?string $created_at;
    private ?string $updated_at;
    private ?string $productName;

    public function __construct()
    {
        $container = new Container();
        $builder = new ContainerBuilder();
        $container = $builder->build();
        $productRepository = $container->get(ProductRepository::class);
        if (isset($this->products_id)) {
            $product = $productRepository->getById($this->products_id);
            $this->productName = $product->getName();
        }
        
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public function fill(stdClass $data): void
    {
        $this->products_id = $data->products_id;
        $this->cart_id = $data->cart_id;
        $this->quantity = $data->quantity;
        $this->total_amount = $data->total_amount;
        $this->total_tax = $data->total_tax;
        $this->total = $data->total;
    }

    public function getProductsId(): int
    {
        return $this->products_id;
    }

    public function setProductsId(int $products_id): void
    {
        $this->products_id = $products_id;
    }

    public function getCartId(): int
    {
        return $this->cart_id;
    }

    public function setCartId(int $cart_id): void
    {
        $this->cart_id = $cart_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getTotalAmount(): float
    {
        return $this->total_amount;
    }

    public function setTotalAmount(float $total_amount): void
    {
        $this->total_amount = $total_amount;
    }

    public function getTotalTax(): float
    {
        return $this->total_tax;
    }

    public function setTotalTax(float $total_tax): void
    {
        $this->total_tax = $total_tax;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function toArray(): array
    {
        $this->created_at ??= Helpers::now();
        $this->updated_at ??= Helpers::now();

        return get_object_vars($this);
    }

    public function toArrayToUpdate(): array
    {
        $this->updated_at = Helpers::now();

        return [
            'products_id' => $this->products_id,
            'cart_id' => $this->cart_id,
            'quantity' => $this->quantity,
            'total_amount' => $this->total_amount,
            'total_tax' => $this->total_tax,
            'total' => $this->total,
            'updated_at' => $this->updated_at
        ];
    }
}
