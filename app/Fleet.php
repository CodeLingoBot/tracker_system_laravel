<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    protected $table = "fleets";
    protected $fillable = ["name"];

    public static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            if (!\Auth::guest()) $model->created_by = \Auth::user()->id;
        });
    }
}
