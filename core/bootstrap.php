<?php

require 'vendor/autoload.php';

use Core\App;
use Core\Database\Connection;
use Dotenv\Dotenv;

(new Dotenv(__DIR__.'/../'))->load();

App::bind('config', require 'src/config.php');
App::bind('database', Connection::make(App::get('config')['database']));
