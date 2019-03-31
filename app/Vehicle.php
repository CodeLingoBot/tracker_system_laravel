<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = "vehicles";
    protected $fillable = ["name", "uuid", "driver_id", "board", "sim_card", "tracker_type_id", "final_user_id", "model_id", "odometer", "year", "color"];

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

    public function model()
    {
        return $this->hasOne("App\VehicleModel", "id", "model_id");
    }
}
