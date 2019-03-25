<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = "drivers";
    protected $fillable = [ 'name', 'license_id' ];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->created_by = \Auth::user()->id;
        });
    }

    public function license()
    {
        return $this->hasOne('App\License', 'id', 'license_id');
    }
}
