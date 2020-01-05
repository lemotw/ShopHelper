<?php

    namespace App\Models\Pos;

    /**
     * Detect string.
     *
     * @param  string   detect string
     * @return boolean
     */
    function valid_string($str)
    {
        if(is_string($str) && $str != NULL && strpos($str, '\'') === false)
            return true;
        return false;
    }
?>