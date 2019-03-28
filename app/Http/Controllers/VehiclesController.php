<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Vehicle;
use App\Setting;
use Illuminate\Http\Request;

class VehiclesController extends Controller
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
        $vehicles = Vehicle::where(['created_by'=>\Auth::user()->id])->paginate(Setting::paginacao());
        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drivers = Driver::all();
        return view('vehicles.create', ['drivers'=>$drivers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Vehicle::create($request->input())){
            return redirect(route('vehicles.index'));
        } else {
            return $this->create();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $drivers = Driver::all();
        return view('vehicles.edit',['vehicle' => $vehicle, 'drivers'=>$drivers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->update($request->input())){
            return redirect(route('vehicles.index'));
        } else {
            return $this->edit($vehicle);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect(route('vehicles.index'));
    }
}
