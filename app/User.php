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
        if ($zip_code = Input::post('zip_code'))
            $this->zip_code = $zip_code;
        if ($city_id = Input::post('city_id'))
            $this->city_id = $city_id;
        if ($address = Input::post('address'))
            $this->address = $address;
        if ($neighborhood = Input::post('neighborhood'))
            $this->neighborhood = $neighborhood;
        if ($is_company = Input::post('is_company'))
            $this->is_company =$is_company;
        if ($cpf_cnpj = Input::post('cpf_cnpj'))
            $this->cpf_cnpj = $cpf_cnpj;
        if ($accession = Input::post('accession'))
            $this->accession = \Helper::moneyToFloat($accession);
        if ($payment_day = Input::post('payment_day'))
            $this->payment_day = $payment_day;
        if ($payment_monthy = Input::post('payment_monthy'))
            $this->payment_monthy = \Helper::moneyToFloat($payment_monthy);
        if ($validation = Input::post('validation')) {
            $this->validation = \Helper::parseDate($validation);
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
