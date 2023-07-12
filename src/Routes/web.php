<?php

try {
    $router->add('/', 'GET', 'HomeController:index');
    $router->add('/admin', 'GET', 'HomeController:index');
    $router->add('/admin/produtos', 'GET', 'HomeController:index');
    $router->add('/admin/vendas', 'GET', 'HomeController:index');
} catch (Exception $e) {
    var_dump($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
}
