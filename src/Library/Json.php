<?php
namespace App\Library;

class Json
{
    public static function render(array $data)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        echo json_encode($data);
    }
}
