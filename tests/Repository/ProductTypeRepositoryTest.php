<?php

namespace Tests\Repository;

use App\Database\Select;
use App\Repository\ProductTypeRepository;
use PHPUnit\Framework\TestCase;

class ProductTypeRepositoryTest extends TestCase
{

    private Select $select;

    public function setUp(): void
    {
        parent::setUp();
        $this->select = new Select;
    }
    public function test_getAll()
    {
        $repository = new ProductTypeRepository($this->select);
        $result = $repository->getAll();
        $this->assertIsArray($result);
    }

    
}