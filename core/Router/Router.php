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

    public function get(string $uri, array $controllerAction): void
    {
        $this->routes['GET'][$this->convertToRegex($uri)] = $controllerAction;
    }

    public function post(string $uri, array $controllerAction): void
    {
        $this->routes['POST'][$this->convertToRegex($uri)] = $controllerAction;
    }

    private function convertToRegex($uri): string
    {
        $trimmedUri = ltrim($uri, '/');

        return '/^' . str_replace(['{', '}', '/'], ['(?P<', '>[\w\-]+)', '\/'], $trimmedUri) . '$/i';
    }

    /**
     * @throws Exception
     */
    public function direct($uri, $requestType)
    {
        foreach ($this->routes[$requestType] as $route => $controllerAction) {
            if (preg_match($route, $uri, $matches)) {
                return $this->callAction(
                    $controllerAction,  // No need to explode anything here anymore
                    $this->processMatches($matches)  // Parameters
                );
            }
        }

        throw new Exception('No route defined for this URI.');
    }

    private function processMatches(array $matches): array
    {
        foreach ($matches as $key => $match) {
            if (is_int($key)) {
                unset($matches[$key]);
            }
        }
        return $matches;
    }

    /**
     * @throws Exception
     */
    protected function callAction(array $controllerAction, array $params = [])
    {
        $controller = new $controllerAction[0]();

        if (!method_exists($controller, $controllerAction[1])) {
            throw new Exception(
                "{$controllerAction[0]} does not respond to the {$controllerAction[1]} action."
            );
        }

        return $controller->{$controllerAction[1]}(...array_values($params));
    }
}
