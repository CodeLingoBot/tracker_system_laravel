<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fence extends Model
{
    protected $table = "fences";
    protected $fillable = ["name", "polygon"];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_by = \Auth::user()->id;
        });
    }
}
