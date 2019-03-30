<?php

class Helper
{
    public static function isPrefixCurrentRoute($prefixRoute)
    {
        return self::startsWith(\Route::current()->getName(), $prefixRoute);
    }

    public static function startsWith($string, $prefix)
    {
        return strncmp($string, $prefix, strlen($prefix)) === 0;
    }

    public static function moneyToFloat($string)
    {
        $setting = 'App\Setting';
        return floatval(str_replace($setting::val('tipo-moeda', 'R$') . ' ', '', str_replace(',', '.', str_replace('.', '', $string))));
    }

    public static function formatDate($string){
        return date('d/m/Y h:i:00', strtotime(str_replace('/', '-', $string)));
    }

    public static function parseDate($string){
        return date('Y-m-d h:i:00', strtotime(str_replace('/', '-', $string)));
    }
}