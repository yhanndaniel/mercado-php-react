<?php

namespace Tests\Database;

use App\Database\Update;
use PHPUnit\Framework\TestCase;

class UpdateTest extends TestCase
{
    public function test_update()
    {
        $update = new Update;
        $update->update('tb_category', [
            'name' => 'TEST PHP UNIT',
        ], ['id', 2]);

        $this->assertEquals(
            "UPDATE tb_category SET name = :name WHERE id = :id",
            $update->getSql()
        );
    }

}
