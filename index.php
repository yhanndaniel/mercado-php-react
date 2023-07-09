<?php

use App\Database\DatabaseConnection;
use App\Database\Select;
use Symfony\Component\Dotenv\Dotenv;

include_once __DIR__.'/vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

(new Dotenv())->load(__DIR__.'/.env');

date_default_timezone_set('America/Sao_Paulo');

$url = explode('?', $_SERVER['REQUEST_URI'])[0];
$method = $_SERVER['REQUEST_METHOD'];

$path = explode('/', $url);

$select = new Select;

$category = $select->query('tb_category')
    ->join('tb_book', 'id', 'category_id')
    ->first();

var_dump($category);
