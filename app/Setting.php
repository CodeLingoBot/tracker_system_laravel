<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";

    protected $fillable = [
        "key", "value",
    ];

    public static function paginacao()
    {
        return self::val("paginacao", 15);
    }

    public static function val($key, $default = null)
    {
        try {
            $setting = Setting::where("key", $key)->first();
            if (!$setting) {
                Setting::create(["key" => $key, "value" => $default]);
                return $default;
            }
            return $setting->value;
        } catch (\Exception $excecao) {
            return $default;
        }
    }

    public static function dateTime()
    {
        return self::val("formato-data-hora", "d/m/Y H:i:s");
    }
}
