<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Input;
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

    public static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            if (!\Auth::guest()) $model->created_by = \Auth::user()->id;
            $model->setExtraFields();
        });
    }

    public static function paginate($size)
    {
        $user = \Auth::user();
        return parent::where(["created_by" => $user->id])->paginate($size);
    }

    private static function getSubAdminRole()
    {
        $roleSubAdmin = Role::where(["slug" => "subadmin"])->first();
        if ($roleSubAdmin) return $roleSubAdmin;
        return Role::create(["name" => "subadmin", "description" => "subadmin", "level" => 4, "slug" => "subadmin"]);
    }

    public function isSubAdmin()
    {
        return $this->hasRole("subadmin");
    }

    public function setExtraFields()
    {
        $this->setInputVar('zip_code');
        $this->setInputVar('city_id');
        $this->setInputVar('address');
        $this->setInputVar('is_company');
        $this->setInputVar('cpf_cnpj');
        $this->setInputVar('accession', '\Helper','moneyToFloat');
        $this->setInputVar('payment_day');
        $this->setInputVar('neighborhood');
        $this->setInputVar('payment_monthy', '\Helper','moneyToFloat');
        $this->setInputVar('validation', '\Helper','parseDate');
    }

    private function setInputVar($key, $class = null, $method = null){
        $value = Input::post($key);
        if (!$value) return;
        if ($class && $method){
            $this->{$key} = call_user_func(array($class, $method), $value);
        } else {
            $this->{$key} = $value;
        }
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact', 'id', 'user_id');
    }

    public function invalid()
    {
        if (!$this->validation) return false;
        return strtotime($this->validation) < strtotime(date("Y-m-d H:i:s"));
    }
}
