<?php

namespace App\Models\Attribute;

use DB;
require_once('ValidStringFunction.php');

trait HasPartition
{
    /**
     * Execute where query by partition.
     *
     * @param  string   column of condition
     * @param  string   symbol operator to set condition 
     * @param  string   value of condition
     * @param  int      select partition 
     * @return mixed|static
     */
    static public function whereByPartition($col, $symbol, $val, $shop)
    {
        $symbols =  ["=", "<", ">", "<=", ">=", "<>", "!=", "<=>", "like", "like binary",
                     "not like", "ilike", "&", "|", "^", "<<", ">>", "rlike", "not rlike",
                     "regexp", "not regexp","~", "~*", "!~", "!~*", "similar to", "not similar to",
                     "not ilike", "~~*", "!~~*"];

        if(!valid_string($col))
            throw QueryInvalidStringException::make($this, $col);

        if(!in_array($symbol, $symbols))
            throw QueryInvalidOperatorException::make($this, $symbol);

        //If value is numeric turn into string type.
        if(is_numeric($val))
            $val = strval($val);
        elseif(!valid_string($val))
            throw QueryInvalidStringException::make($this, $val);

        $result = DB::select(
            'SELECT * FROM '.self::$tableAccess.' PARTITION(p'.strval($shop).') WHERE '
            . $col . ' '.$symbol.' ?'.' and `'.self::$tableAccess.'`.`deleted_at` is null', [$val]);
        // SELECT * FROM $table Partition(p?) WHERE $col $symbol $val and `$table`.`deleted_at` is null

        return self::hydrate($result);
    }

    /**
     * Execute where between query by partition.
     *
     * @param  string   column of condition
     * @param  string   symbol operator to set condition 
     * @param  string   value of condition
     * @param  int      select partition 
     * @return mixed|static
     */
    static public function whereBetweenByPartition($col, $val1, $val2, $shop)
    {
        if(!valid_string($col))
            throw QueryInvalidStringException::make($this, $col);

        //If value is numeric turn into string type.
        if(is_numeric($val1))
            $val1 = strval($val);
        elseif(!valid_string($val1))
            throw QueryInval11idStringException::make($this, $val);

        if(is_numeric($val2))
            $val2 = strval($val2);
        elseif(!valid_string($val2))
            throw QueryInval2idStringException::make($this, $val);

        $result = DB::select(
            'SELECT * FROM '.self::$tableAccess.' PARTITION(p'.strval($shop).') WHERE '
            . $col . ' Between ? and ? and `'.self::$tableAccess.'`.`deleted_at` is null', [$val1, $val2]);
        // SELECT * FROM $table Partition(p?) WHERE $col Between $val1 and $val2 and `$table`.`deleted_at` is null

        return self::hydrate($result);
    }

    /**
     * Get all item in certain partition.
     * 
     * @param int $shop
     * @return mixed|static
     */
    static public function allPartition($shop)
    {
        $result = DB::select('SELECT * FROM '.self::$tableAccess.' PARTITION(p'.strval($shop).')');
        //SELECT * FROM $table PARTITION(p?);
        return self::hydrate($result);
    }
}