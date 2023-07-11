<?php

try {
    $router->add('/', 'GET', 'HomeController:index');
    $router->add('/teste', 'GET', 'HomeController:test');
    $router->init();
} catch (Exception $e) {
    var_dump($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
}
