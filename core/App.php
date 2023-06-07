<?php

namespace Core;

use Exception;

class App
{
    protected static array $registry = [];

    public static function bind(string $key, $value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * @throws Exception
     */
    public static function get(string $key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new Exception("No {$key} is bound in the container.");
        }

        return static::$registry[$key];
    }
}
