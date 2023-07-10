<?php

use App\Database\Select;
use App\Database\Update;
use App\Database\DatabaseConnection;
use Symfony\Component\Dotenv\Dotenv;
use App\Repository\ProductTypeRepository;

include_once __DIR__.'/vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

(new Dotenv())->load(__DIR__.'/.env');

date_default_timezone_set('America/Sao_Paulo');

$url = explode('?', $_SERVER['REQUEST_URI'])[0];
$method = $_SERVER['REQUEST_METHOD'];

$path = explode('/', $url);

$productType = new ProductTypeRepository(new Select);

$category = $productType->getAll();

// $update = new Update;
// $updated = $update->update('tb_category', [
//     'name' => 'PHP',
// ], ['id', 1]);

//var_dump(json_encode($category));

echo json_encode($category);
