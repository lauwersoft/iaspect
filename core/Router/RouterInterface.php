<?php

namespace Core\Router;

interface RouterInterface
{
    public function load(string $file): RouterInterface;
    public function get(string $uri, string $controller): void;
    public function post(string $uri, string $controller): void;
    public function direct(string $uri, string $requestType);
}
