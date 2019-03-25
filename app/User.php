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

    private static function getSubAdminRole(){
        $roleSubAdmin = Role::where(['slug' => 'subadmin'])->first();
        if (!$roleSubAdmin)
            $roleSubAdmin = Role::create(['name'=>'subadmin', 'description'=>'subadmin','level'=>4, 'slug' => 'subadmin']);
        return $roleSubAdmin;
    }

    public static function paginate($size)
    {
        $user = \Auth::user();
        if ($user->isAdmin()){
            return self::getSubAdminRole()->users()->paginate($size);
        } else if ($user->hasRole('subadmin')) {
            return parent::where(['created_by' => $user->id])->paginate($size);
        }
    }
}
