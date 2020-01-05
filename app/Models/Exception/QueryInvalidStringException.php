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
    public $str;

    /**
     * Create a new exception instance.
     *
     * @param  mixed  $model
     * @param  string $str
     * @return static
     */
    public static function make($model, $str)
    {
        $class = get_class($model);

        $instance = new static("Query join by invalid string [{$str}] on model [{$class}].");

        $instance->model = $model;
        $instance->str= $str;

        return $instance;
    }
}
