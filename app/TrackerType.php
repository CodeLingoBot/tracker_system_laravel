<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackerType extends Model
{
    protected $table = "tracker_types";
    protected $fillable = ["name"];
}