<?php

function view(string $name, array $data = [])
{
    extract($data);

    return require "src/views/{$name}.view.php";
}

function redirect(string $path)
{
    header("Location: /{$path}");
}
