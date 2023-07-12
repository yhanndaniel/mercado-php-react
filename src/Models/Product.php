<?php
namespace App\Models;

use App\Helpers\Helpers;
use App\Repository\ProductTypeRepository;
use DI\Container;
use DI\ContainerBuilder;
use JsonSerializable;
use stdClass;

class Product implements JsonSerializable
{
    private int $id;
    private int $product_types_id;
    private string $name;
    private float $price;
    private string $description;
    private ?string $image;
    private ?string $created_at;
    private ?string $updated_at;
    private ?string $productType;
    private ?float $taxCalculated;
    public function __construct()
    {
        $container = new Container();
        $builder = new ContainerBuilder();
        $container = $builder->build();
        $productTypeRepository = $container->get(ProductTypeRepository::class);
        if (isset($this->product_types_id)) {
            $productType = $productTypeRepository->getById($this->product_types_id);
            $this->image = 'https://placehold.co/236';
            $this->productType = $productType->getName();
            $this->taxCalculated = $this->calculateTax($this->price, $productType->getTax());
        }
    }

    private function calculateTax(float $price, float $tax): float
    {
        $tax = $tax / 100;
        return $price * $tax;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
    public function fill(stdClass $data): void
    {
        $this->product_types_id = $data->product_types_id;
        $this->name = $data->name;
        $this->price = $data->price;
        $this->description = $data->description;
        $this->image = $data->image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProductTypesId(): int
    {
        return $this->product_types_id;
    }

    public function setProductTypesId(int $product_types_id): void
    {
        $this->product_types_id = $product_types_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
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
            'product_types_id' => $this->product_types_id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $this->image,
            'updated_at' => $this->updated_at
        ];
    }
}
