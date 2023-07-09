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
        $query = $this->select->query('users')->get();
        $this->assertEquals('SELECT * FROM users', $query->sql);
    }

    public function test_get_select_with_conditional()
    {
        $query = $this->select->query('users')->where('id', '>', 10)->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id', $query->sql);
    }

    public function test_get_select_with_more_than_one_conditional()
    {
        $query = $this->select->query('users')
            ->where('id', '>', 10, 'AND')
            ->where('firstName', '=', 'Yhann')
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id AND firstName = :firstName', $query->sql);
    }

    public function test_get_select_with_more_than_one_conditional_and_use_type_conditional()
    {
        $query = $this->select->query('users')
            ->where('id', '>', 10, 'OR')
            ->where('firstName', '=', 'Yhann')
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id OR firstName = :firstName', $query->sql);
    }

    public function test_get_binds_from_conditional()
    {
        $query = $this->select->query('users')
            ->where('id', '>', 10, 'OR')
            ->where('firstName', '=', 'Yhann')
            ->get();
        $this->assertEquals(['id' => 10, 'firstName' => 'Yhann'], $query->binds);
    }

    public function test_get_select_with_order_by()
    {
        $query = $this->select->query('users')
            ->order('id', 'DESC')
            ->get();
        $this->assertEquals('SELECT * FROM users ORDER BY id DESC', $query->sql);
    }

    public function test_get_select_with_conditional_and_order_by_with_different_order()
    {
        $query = $this->select->query('users')
            ->order('id', 'DESC')
            ->where('id', '>', 10)
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id ORDER BY id DESC', $query->sql);
    }

    public function test_get_select_with_limit()
    {
        $query = $this->select->query('users')
            ->limit(10)
            ->get();
        $this->assertEquals('SELECT * FROM users LIMIT 10', $query->sql);
    }

    public function test_get_select_with_conditional_and_limit()
    {
        $query = $this->select->query('users')
            ->limit(10)
            ->where('id', '>', 10)
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id LIMIT 10', $query->sql);
    }

    public function test_get_select_with_more_than_one_conditional_and_limit()
    {
        $query = $this->select->query('users')
            ->limit(10)
            ->where('id', '>', 10, 'AND')
            ->where('firstName', '=', 'Yhann')
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id AND firstName = :firstName LIMIT 10', $query->sql);
    }

    public function test_get_select_with_more_than_one_conditional_and_limit_and_use_type_conditional()
    {
        $query = $this->select->query('users')
            ->limit(10)
            ->where('id', '>', 10, 'OR')
            ->where('firstName', '=', 'Yhann')
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id OR firstName = :firstName LIMIT 10', $query->sql);
    }

    public function test_get_select_with_more_than_one_conditional_and_limit_and_use_type_conditional_and_order_by()
    {
        $query = $this->select->query('users')
            ->limit(10)
            ->where('id', '>', 10, 'OR')
            ->where('firstName', '=', 'Yhann')
            ->order('id', 'DESC')
            ->get();
        $this->assertEquals('SELECT * FROM users WHERE id > :id OR firstName = :firstName ORDER BY id DESC LIMIT 10', $query->sql);
    }

    public function test_select_with_joins()
    {
        $query = $this->select->query('users')
            ->join('comments', 'id', 'user_id')
            ->get();

        $this->assertEquals('SELECT * FROM users INNER JOIN comments ON comments.user_id = users.id', $query->sql);
    }

    public function test_select_with_multiple_joins()
    {
        $query = $this->select->query('users')
            ->join('comments', 'id', 'user_id')
            ->join('posts', 'id', 'user_id')
            ->get();

        $this->assertEquals('SELECT * FROM users INNER JOIN comments ON comments.user_id = users.id INNER JOIN posts ON posts.user_id = users.id', $query->sql);
    }

    public function test_select_with_multiple_joins_and_where()
    {
        $query = $this->select->query('users')
            ->join('comments', 'id', 'user_id')
            ->join('posts', 'id', 'user_id')
            ->where('users.id', '>', 10)
            ->get();

        $this->assertEquals('SELECT * FROM users INNER JOIN comments ON comments.user_id = users.id INNER JOIN posts ON posts.user_id = users.id WHERE users.id > :users.id', $query->sql);
    }

    public function test_select_with_multiple_joins_and_multiple_where()
    {
        $query = $this->select->query('users')
            ->join('comments', 'id', 'user_id')
            ->join('posts', 'id', 'user_id')
            ->where('users.id', '>', 10, 'AND')
            ->where('posts.id', '>', 10)
            ->get();

        $this->assertEquals('SELECT * FROM users INNER JOIN comments ON comments.user_id = users.id INNER JOIN posts ON posts.user_id = users.id WHERE users.id > :users.id AND posts.id > :posts.id', $query->sql);
    }

    public function test_select_with_multiple_joins_and_multiple_where_and_order_by()
    {
        $query = $this->select->query('users')
            ->join('comments', 'id', 'user_id')
            ->join('posts', 'id', 'user_id')
            ->where('users.id', '>', 10, 'AND')
            ->where('posts.id', '>', 10)
            ->order('users.id', 'DESC')
            ->get();

        $this->assertEquals('SELECT * FROM users INNER JOIN comments ON comments.user_id = users.id INNER JOIN posts ON posts.user_id = users.id WHERE users.id > :users.id AND posts.id > :posts.id ORDER BY users.id DESC', $query->sql);
    }

}
