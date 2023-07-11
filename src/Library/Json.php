<?php
namespace App\Library;

class Json
{
    public static function render(array $data, int $code = 200)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        http_response_code($code);
        
        echo json_encode($data);
    }
}
