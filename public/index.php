<?php

use App\Library\Router;
use Symfony\Component\Dotenv\Dotenv;

include_once '../vendor/autoload.php';

(new Dotenv())->load('../.env');

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('America/Sao_Paulo');
$router = new Router;

require '../src/Routes/web.php';
require '../src/Routes/api.php';
