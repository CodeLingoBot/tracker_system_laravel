<?php

namespace App\Http\Controllers;


use App\Setting;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index(User $user){
        $users = User::where(['created_by' => $user->id])->paginate(Setting::paginacao());
        return view('laravelusers::usersmanagement.show-users', [
            'fromUser' =>  $user,
            'users'=>$users,
            'pagintaionEnabled' => config('laravelusers.enablePagination')
        ]);
    }
}