<?php

try {
    $router->add('/', 'GET', 'HomeController:index');
    $router->add('/teste', 'GET', 'HomeController:test');
} catch (Exception $e) {
    var_dump($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
}
