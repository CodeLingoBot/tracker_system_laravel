<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key', 'value'
    ];

    public static function val($key, $default = null){
        $setting = Setting::where('key', $key)->first();
        if (!$setting) {
            Setting::create(['key'=>$key, 'value' => $default]);
            return $default;
        }
        return $setting->value;
    }

    public static function paginacao(){
        return self::val('paginacao', 15);
    }
}
