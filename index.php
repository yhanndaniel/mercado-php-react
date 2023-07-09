<?php

use App\Database\DatabaseConnection;
use Symfony\Component\Dotenv\Dotenv;

include_once __DIR__.'/vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

(new Dotenv())->load(__DIR__.'/.env');

//var_dump($_ENV);

date_default_timezone_set('America/Sao_Paulo');

$url = explode('?', $_SERVER['REQUEST_URI'])[0];
$method = $_SERVER['REQUEST_METHOD'];

$path = explode('/', $url);

$db = DatabaseConnection::open();
$rs = $db->prepare("SELECT x.* FROM db_estacio_library.tb_category x");
$rs->execute();
$obj = $rs->fetchAll(PDO::FETCH_ASSOC);

DatabaseConnection::close($db);

echo json_encode($obj);

//var_dump($url, $path, $method);
