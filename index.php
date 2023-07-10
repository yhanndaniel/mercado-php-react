<?php

use App\Database\Create;
use App\Database\Select;
use App\Database\Update;
use App\Database\DatabaseConnection;
use App\Models\ProductType;
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

$productTypeRepo = new ProductTypeRepository(new Select, new Create, new Update);

// $productType = new ProductType();
// $productType->setName('JavaScript');
// $productType->setDescription('Language');
// $productType->setTax(10);
//$productType->setCreatedAt(date('Y-m-d H:i:s'));
//$productType->setUpdatedAt(date('Y-m-d H:i:s'));

$category = $productTypeRepo->getById(2);

$category->setName('PHP ALTERADO');

//var_dump($category);
var_dump($productTypeRepo->update($category));
die();

echo json_encode($category);

// $update = new Update;
// $updated = $update->update('tb_category', [
//     'name' => 'PHP',
// ], ['id', 1]);

//var_dump(json_encode($category));

// echo json_encode($category);
