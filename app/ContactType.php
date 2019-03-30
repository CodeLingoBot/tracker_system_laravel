<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    protected $table = "contact_types";
    protected $fillable = ["name", "mask"];
}
