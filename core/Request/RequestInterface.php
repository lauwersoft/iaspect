<?php

namespace Core\Request;

interface RequestInterface
{
    public static function uri(): string;
    public function get(string $key, ?string $default = null);
    public static function method(): string;
}
