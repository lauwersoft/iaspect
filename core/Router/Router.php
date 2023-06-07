<?php

namespace Core\Router;

use Exception;

class Router implements RouterInterface
{
    public array $routes = [
        'GET'  => [],
        'POST' => [],
    ];

    public function load($file): Router
    {
        $router = new static();

        require $file;

        return $router;
    }

    public function get(string $uri, string $controller): void
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post(string $uri, string $controller): void
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * @throws Exception
     */
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        throw new Exception('No route defined for this URI.');
    }

    /**
     * @throws Exception
     */
    protected function callAction(string $controller, string $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller();

        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}
