<?php

namespace Tests\Database;

use App\Database\Create;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function test_create()
    {
        $create = new Create;
        $create->create('users', [
            'firstName' => 'Yhann',
            'lastName' => 'Cruz',
            'email' => 'yCk5c@example.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ]);

        $created = $create->getSql();

        $this->assertEquals(
            "INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)",
            $created
        );
    }

}
