<?php

namespace Core\Router;

interface RouterInterface
{
    public function load(string $file): RouterInterface;
    public function get(string $uri, array $controllerAction): void;
    public function post(string $uri, array $controllerAction): void;
    public function direct(string $uri, string $requestType);
}
