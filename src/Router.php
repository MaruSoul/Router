<?php

namespace Mary\Router;

use InvalidArgumentException;

class Router implements RouteInterface
{
    public $baseControllersNamespace = '';

    public function __construct(string $baseControllersNamespace)
    {
        $this->baseControllersNamespace = $baseControllersNamespace;
    }

    public function route(string $requestUri)
    {
        $uri = parse_url($requestUri, PHP_URL_PATH);
        $uri = trim($uri, '/');
        $uri = explode('/', $uri);

        if (count($uri) < 2) {
            throw new InvalidArgumentException('URI must have controller and action');
        }

        $controller = $uri[0];
        $action = $uri[1];
        $params = [];
        
        for ($i = 2; count($uri) > $i + 1; $i+=2) {
            $params[$uri[$i]] = $uri[$i + 1];
        }

        $class = $this->baseControllersNamespace . "\\" . ucfirst($controller);
        if (!class_exists($class)) {
            throw new ResourceNotFoundException("Controller {$class} does not exists");
        }
        if (!method_exists($class, $action)) {
            throw new ResourceNotFoundException("Controller {$class} does not have method {$action}");
        }

        return function() use ($params, $class, $action) {
            return call_user_func_array([$class, $action], [$params]);
        };
    }
}
