<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

date_default_timezone_set('America/Sao_Paulo');

$url = explode('?', $_SERVER['REQUEST_URI'])[0];
$method = $_SERVER['REQUEST_METHOD'];

$path = explode('/', $url);

var_dump($url, $path, $method);
