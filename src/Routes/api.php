<?php

try {
    $router->group(['prefix' => 'api'], function () {
        $this->add('/product-type', 'GET', 'ProductTypeController:index');
        $this->add('/product-type/(:numeric)', 'GET', 'ProductTypeController:show', ['id']);
        $this->add('/product-type', 'POST', 'ProductTypeController:create');
        $this->add('/product-type/(:numeric)', 'PUT', 'ProductTypeController:update', ['id']);
        $this->add('/product-type/(:numeric)', 'DELETE', 'ProductTypeController:delete', ['id']);

        $this->add('/product', 'GET', 'ProductController:index');
        $this->add('/product/(:numeric)', 'GET', 'ProductController:show', ['id']);
        $this->add('/product', 'POST', 'ProductController:create');
        $this->add('/product/(:numeric)', 'PUT', 'ProductController:update', ['id']);
        $this->add('/product/(:numeric)', 'DELETE', 'ProductController:delete', ['id']);

        $this->add('/sale', 'GET', 'SaleController:index');
        $this->add('/sale/(:numeric)', 'GET', 'SaleController:show', ['id']);
        $this->add('/sale', 'POST', 'SaleController:create');
        $this->add('/sale/(:numeric)', 'PUT', 'SaleController:update', ['id']);
        $this->add('/sale/(:numeric)', 'DELETE', 'SaleController:delete', ['id']);

        $this->add('/cart-product', 'GET', 'CartProductController:index');
        $this->add('/cart-product/(:numeric)', 'GET', 'CartProductController:show', ['id']);
        $this->add('/cart-product', 'POST', 'CartProductController:create');
        $this->add('/cart-product/(:numeric)', 'PUT', 'CartProductController:update', ['id']);
        $this->add('/cart-product/(:numeric)', 'DELETE', 'CartProductController:delete', ['id']);
      });
    $router->init();
} catch (Exception $e) {
    var_dump($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
}
