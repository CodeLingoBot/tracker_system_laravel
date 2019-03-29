<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contacts";
    protected $fillable = [ "value", "type_id", "user_id" ];

    public function type()
    {
        return $this->hasOne('App\ContactType', 'id', 'type_id');
    }
}
