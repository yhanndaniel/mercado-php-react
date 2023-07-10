<?php
namespace App\Models;

use JsonSerializable;

class Sale implements JsonSerializable
{
    private int $id;
    private float $total_amount;
    private float $total_tax;
    private float $total;
    private bool $saled;
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

    public function getSaled(): bool
    {
        return $this->saled;
    }

    public function setSaled(bool $saled): void
    {
        $this->saled = $saled;
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
        $this->created_at ??= date('Y-m-d H:i:s');
        $this->updated_at ??= date('Y-m-d H:i:s');

        return get_object_vars($this);
    }

    public function toArrayToUpdate(): array
    {
        $this->updated_at = date('Y-m-d H:i:s');

        return [
            'total_amount' => $this->total_amount,
            'total_tax' => $this->total_tax,
            'total' => $this->total,
            'saled' => $this->saled,
            'updated_at' => $this->updated_at
        ];
    }
}