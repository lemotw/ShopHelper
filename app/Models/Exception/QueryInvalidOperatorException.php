<?php

namespace App\Models\Exception;

use RuntimeException;

class QueryInvalidStringException extends RuntimeException
{
    /**
     * The name of the affected Eloquent model.
     *
     * @var string
     */
    public $model;

    /**
     * The name of the relation.
     *
     * @var string
     */
    public $symbol;

    /**
     * Create a new exception instance.
     *
     * @param  mixed  $model
     * @param  string $str
     * @return static
     */
    public static function make($model, $symbol)
    {
        $class = get_class($model);

        $instance = new static("Query join by invalid operator [{$symbol}] on model [{$class}].");

        $instance->model    = $model;
        $instance->symbol   = $symbol;

        return $instance;
    }
}
