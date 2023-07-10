<?php
namespace App\Models;

use JsonSerializable;

class ProductType implements JsonSerializable
{
    private int $id;
    private string $name;
    private string $description;
    private float $tax;
    private ?string $created_at;
    private ?string $updated_at;

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function setTax(float $tax): void
    {
        $this->tax = $tax;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function toArray(): array
    {
        $this->created_at ??= date('Y-m-d H:i:s');
        $this->updated_at ??= date('Y-m-d H:i:s');

        return get_object_vars($this);
    }

    public function toArrayToUpdate(): array
    {
        $this->updated_at = date('Y-m-d H:i:s');

        return [
            'name' => $this->name,
            'description' => $this->description,
            'tax' => $this->tax,
            'updated_at' => $this->updated_at
        ];
    }
}