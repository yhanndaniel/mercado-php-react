<?php
namespace App\Controllers;

use App\Library\Json;

class HomeController
{
    public function index()
    {
        echo file_get_contents('./build/index.html');
    }

    public function test()
    {
        Json::render([
            'message' => 'Hello Test',
        ]);
    }

}
