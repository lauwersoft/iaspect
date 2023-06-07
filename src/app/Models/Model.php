<?php

namespace App\Models;

use Core\App;
use Core\Database\QueryBuilder;
use Exception;

abstract class Model extends QueryBuilder
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(App::get('database'));
    }
}
