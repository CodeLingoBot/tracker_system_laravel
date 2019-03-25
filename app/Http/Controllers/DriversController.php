<?php

namespace App\Http\Controllers;

use App\Driver;
use App\License;
use App\Setting;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|subadmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::where(['created_by'=>\Auth::user()->id])->paginate(Setting::paginacao());
        return view('drivers.index', ['drivers' => $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $licenses = License::all();
        return view('drivers.create', ['licenses'=>$licenses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Driver::create($request->input())){
            return redirect(route('drivers.index'));
        } else {
            return $this->create();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        $licenses = License::all();
        return view('drivers.edit',['driver' => $driver, 'licenses'=>$licenses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        if ($driver->update($request->input())){
            return redirect(route('drivers.index'));
        } else {
            return $this->edit($driver);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect(route('drivers.index'));
    }
}
