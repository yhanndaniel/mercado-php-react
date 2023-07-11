<?php
namespace App\Models;

use JsonSerializable;

class Product implements JsonSerializable
{
    private int $id;
    private int $product_types_id;
    private string $name;
    private float $price;
    private string $description;
    private string $image;
    private ?string $created_at;
    private ?string $updated_at;

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    private function now(): string
    {
        return date('Y-m-d H:i:s');
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
        $this->created_at ??= $this->now();
        $this->updated_at ??= $this->now();

        return get_object_vars($this);
    }

    public function toArrayToUpdate(): array
    {
        $this->updated_at = $this->now();

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