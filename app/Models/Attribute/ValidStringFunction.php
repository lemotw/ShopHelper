<?php

    namespace App\Models\Attribute;

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