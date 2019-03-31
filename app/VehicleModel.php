<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $table = "vehicle_models";
    protected $fillable = ["name", "branch_id"];

    public function branch()
    {
        return $this->hasOne('App\VehicleBranch', 'id', 'branch_id');
    }
}