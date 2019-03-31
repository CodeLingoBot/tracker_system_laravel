<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleBranch extends Model
{
    protected $table = "vehicle_branchs";
    protected $fillable = ["name", "type"];


    public function models()
    {
        return $this->hasMany('App\VehicleModel', 'branch_id', 'id');
    }
}