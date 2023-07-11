<?php

namespace App\Library;

use DI\Container;
use DI\ContainerBuilder;
use Exception;
use ReflectionMethod;

class Controller
{

    private function controllerPath($route, $controller)
    {
        return ($route->getRouteOptionsInstance() && $route->getRouteOptionsInstance()->optionExist('controller')) ?
          "App\\Controllers\\" . $route->getRouteOptionsInstance()->execute('controller') . '\\' . $controller :
          "App\\Controllers\\" . $controller;
    }


    public function call(Route $route)
    {
        $controller = $route->controller;

        if (!str_contains($controller, ':')) {
            throw new Exception("Colon need to controller {$controller} in route");
        }

        [$controller, $action] = explode(':', $controller);

        $controllerInstance = $this->controllerPath($route, $controller);

        if (!class_exists($controllerInstance)) {
            throw new Exception("Controller {$controller} does not exist");
        }

        $container = new Container();
        $builder = new ContainerBuilder();
        $container = $builder->build();

        $controller = $container->get($controllerInstance);

        if (!method_exists($controller, $action)) {
            throw new Exception("Action {$action} does not exist");
        }

        if ($route->getRouteOptionsInstance()?->optionExist('middlewares')) {
            (new Middleware($route->getRouteOptionsInstance()->execute('middlewares')))->execute();
        }

        $reflectionMethod = new ReflectionMethod($controller, $action);

        $reflectionMethod->invokeArgs($controller, $route->getRouteWildcardInstance()?->getParams() ?? []);
    }
}
