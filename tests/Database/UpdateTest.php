<?php

namespace Tests\Database;

use App\Database\Update;
use PHPUnit\Framework\TestCase;

class UpdateTest extends TestCase
{
    public function test_update()
    {
        $update = new Update;
        $update->update('users', [
            'firstName' => 'Yhann',
            'lastName' => 'Cruz',
            'email' => 'yCk5c@example.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ], ['id', 1]);

        $this->assertEquals(
            "UPDATE users SET firstName = :firstName, lastName = :lastName, email = :email, password = :password WHERE id = :id",
            $update->getSql()
        );
    }

}
