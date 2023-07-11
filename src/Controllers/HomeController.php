<?php
namespace App\Controllers;

use App\Library\Json;

class HomeController
{
    public function index()
    {
        Json::render([
            'message' => 'Hello World',
        ]);
    }

    public function test()
    {
        Json::render([
            'message' => 'Hello Test',
        ]);
    }
}
