<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_by'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->created_by = \Auth::user()->id;
        });
    }

    public static function paginate($size)
    {
        if (\Auth::user()->isAdmin()){
            return parent::whereNotNull('id')->paginate($size);
        } else {
            return parent::where(['created_by' => \Auth::user()->id])->paginate($size);
        }
    }
}
