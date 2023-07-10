<?php

namespace Tests\Repository;

use App\Database\Create;
use App\Database\Select;
use App\Models\ProductType;
use App\Repository\ProductTypeRepository;
use PHPUnit\Framework\TestCase;

class ProductTypeRepositoryTest extends TestCase
{

    private Select $select;
    private Create $create;
    private ProductTypeRepository $productTypeRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->select = new Select;
        $this->create = new Create;
        $this->productTypeRepository = new ProductTypeRepository($this->select, $this->create);
    }
    public function test_getAll()
    {
        $result = $this->productTypeRepository->getAll();
        $this->assertIsArray($result);
    }

    public function test_getById()
    {
        $result = $this->productTypeRepository->getById(2);
        $this->assertInstanceOf( 'App\Models\ProductType', $result);
    }

    public function test_create()
    {
        $productType = new ProductType();
        $productType->setName('JavaScript');
        $productType->setDescription('Language');
        $productType->setTax(10);
        $result = $this->productTypeRepository->create($productType);
        $this->assertTrue($result);
    }

    
}