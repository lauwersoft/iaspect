<?php

require 'core/bootstrap.php';

use Core\Request\Request;
use Core\Router\Router;

(new Router())->load('src/app/routes.php')->direct(Request::uri(), Request::method());

