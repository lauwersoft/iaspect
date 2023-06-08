<?php

namespace App\Builders;

use Core\App;
use Core\Database\QueryBuilder;
use Exception;

abstract class Builder extends QueryBuilder
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct(App::get('database'));
    }
}
