<?php

namespace Tests\Database;

use App\Database\Select;
use PHPUnit\Framework\TestCase;

class SelectTest extends TestCase
{

    private Select $select;

    public function setUp(): void
    {
        parent::setUp();
        $this->select = new Select;
    }
    public function test_get_simple_select()
    {
        $query = $this->select->query('SELECT * FROM users')->get();
        $this->assertEquals('SELECT * FROM users', $query->sql);
    }

    public function test_get_select_with_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')->where('id', '>', 10)->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id', $query->sql);
    }

    public function test_get_select_with_more_than_one_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')
            ->where('id', '>', 10, 'AND')
            ->where('firstName', '=', 'Yhann')
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id AND firstName = :firstName', $query->sql);
    }

    public function test_get_select_with_more_than_one_conditional_and_use_type_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')
            ->where('id', '>', 10, 'OR')
            ->where('firstName', '=', 'Yhann')
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id OR firstName = :firstName', $query->sql);
    }

    public function test_get_binds_from_conditional()
    {
        $query = $this->select->query('SELECT * FROM users')
            ->where('id', '>', 10, 'OR')
            ->where('firstName', '=', 'Yhann')
            ->get();
        $this->assertEquals(['id' => 10, 'firstName' => 'Yhann'], $query->binds);
    }

    public function test_get_select_with_order_by()
    {
        $query = $this->select->query('SELECT * FROM users')
            ->order('id', 'DESC')
            ->get();
        $this->assertEquals('SELECT * FROM users ORDER BY id DESC', $query->sql);
    }

    public function test_get_select_with_conditional_and_order_by_with_different_order()
    {
        $query = $this->select->query('SELECT * FROM users')
            ->order('id', 'DESC')
            ->where('id', '>', 10)
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id ORDER BY id DESC', $query->sql);
    }

}
