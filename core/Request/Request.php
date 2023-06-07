<?php

namespace Core\Request;

class Request implements RequestInterface
{
    protected array $data;

    public function __construct()
    {
        $this->data = $_REQUEST;
    }

    public function get(string $key, ?string $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public static function uri(): string
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
