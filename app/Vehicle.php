<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = "vehicles";
    protected $fillable = ["name", "uuid", "driver_id"];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_by = \Auth::user()->id;
        });
    }

    public function driver()
    {
        return $this->hasOne("App\Driver", "id", "driver_id");
    }
}
