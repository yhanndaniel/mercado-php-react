<?php

namespace Tests\Repository;

use App\Database\Create;
use App\Database\Delete;
use App\Database\Select;
use App\Database\Update;
use App\Models\ProductType;
use App\Repository\ProductTypeRepository;
use PHPUnit\Framework\TestCase;

class ProductTypeRepositoryTest extends TestCase
{

    private Select $select;
    private Create $create;
    private Update $update;
    private Delete $delete;
    private ProductTypeRepository $productTypeRepository;

    public function setUp(): void
    {
        date_default_timezone_set('America/Sao_Paulo');
        parent::setUp();
        $this->select = new Select;
        $this->create = new Create;
        $this->update = new Update;
        $this->delete = new Delete;
        $this->productTypeRepository = new ProductTypeRepository($this->select, $this->create, $this->update, $this->delete);
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

    public function test_update()
    {
        $productType = $this->productTypeRepository->getById(3);
        $productType->setName('JavaScript Alterado Teste');
        $productType->setDescription('Language Alterado Teste');
        $productType->setTax(15);
        $result = $this->productTypeRepository->update($productType);
        $this->assertTrue($result);
    }

    public function test_delete()
    {
        $productType = $this->productTypeRepository->getById(6);
        $result = $this->productTypeRepository->delete($productType);
        $this->assertTrue($result);
    }

    public function test_count()
    {
        $result = $this->productTypeRepository->count();
        $this->assertIsInt($result);
    }

    
}