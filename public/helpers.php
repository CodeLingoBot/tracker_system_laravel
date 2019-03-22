<?php
class Helper
{
    public static function isPrefixCurrentRoute($prefixRoute){
        return self::startsWith(\Route::current()->getName(), $prefixRoute);
    }

    public static function startsWith($string, $prefix)
    {
        return strncmp($string, $prefix, strlen($prefix)) === 0;
    }
}