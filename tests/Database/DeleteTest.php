<?php

namespace Tests\Database;

use App\Database\Delete;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    public function test_delete()
    {
        $delete = new Delete;
        $delete->delete('tb_category', ['id', 10]);
        $deleted = $delete->getSql();

        $this->assertEquals(
            "DELETE FROM tb_category WHERE id = :id",
            $deleted
        );
    }

}
