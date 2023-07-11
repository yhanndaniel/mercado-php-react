<?php

try {
    $router->group(['prefix' => 'api'], function () {
        $this->add('/product-type', 'GET', 'ProductTypeController:index');
        $this->add('/product-type/(:numeric)', 'GET', 'ProductTypeController:show', ['id']);
        $this->add('/product-type', 'POST', 'ProductTypeController:create');
        $this->add('/product-type/(:numeric)', 'PUT', 'ProductTypeController:update', ['id']);
        $this->add('/product-type/(:numeric)', 'DELETE', 'ProductTypeController:delete', ['id']);
      });
    $router->init();
} catch (Exception $e) {
    var_dump($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
}
