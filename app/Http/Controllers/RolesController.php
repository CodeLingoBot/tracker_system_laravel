<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(Setting::paginacao());
        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Role::create($request->input())) {
            return redirect(route('roles.index'));
        } else {
            return $this->create();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.form', ['role' => new Role()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if ($role->update($request->input())) {
            return redirect(route('roles.index'));
        } else {
            return $this->edit($role);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.form', ['role' => $role]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('roles.index'));
    }
}
