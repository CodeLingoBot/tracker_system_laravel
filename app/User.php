<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Support\Facades\Input;

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
        "name", "email", "password"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password", "remember_token", "created_by"
    ];

    public function isSubAdmin(){
        return $this->hasRole("subadmin");
    }

    public static function boot()
    {
        parent::boot();
        self::saving(function($model){
            $model->created_by = \Auth::user()->id;
            $model->setExtraFields();
        });
    }

    public function setExtraFields(){
        $this->zip_code = Input::post('zip_code');
        $this->city_id = Input::post('city_id');
        $this->address = Input::post('address');
        $this->neighborhood = Input::post('neighborhood');
    }

    private static function getSubAdminRole(){
        $roleSubAdmin = Role::where(["slug" => "subadmin"])->first();
        if ($roleSubAdmin) return $roleSubAdmin;
        return Role::create(["name" => "subadmin", "description" => "subadmin", "level"=>4, "slug" => "subadmin"]);
    }

    public static function paginate($size)
    {
        $user = \Auth::user();
        if ($user->isAdmin()) {
            return self::getSubAdminRole()->users()->paginate($size);
        } else if ($user->isSubAdmin()) {
            return parent::where(["created_by" => $user->id])->paginate($size);
        }
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }
}
