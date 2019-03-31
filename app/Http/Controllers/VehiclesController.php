<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Setting;
use App\TrackerType;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    private $user;
    private $final;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user();
            $this->final = !$this->user->isAdmin() && !$this->user->isSubAdmin();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = $this->final ? 'final_user_id' : 'created_by';
        $vehicles = Vehicle::where([$key => $this->user->id])->paginate(Setting::paginacao());
        return view('vehicles.index', ['final'=>$this->final, 'vehicles' => $vehicles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->final) return redirect(route('vehicles.index'));
        $all = $request->input();
        $all["odometer"]= \Helper::stringToFloat($all["odometer"]);
        if (Vehicle::create($all)) {
            return redirect(route('vehicles.index'));
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
        if ($this->final) return redirect(route('vehicles.index'));
        return view('vehicles.form', [
            'final'=>$this->final,
            'trackerTypes'=>TrackerType::all(),
            'finals'=>User::where(["created_by" => $this->user->id])->get(),
            'vehicle' => new Vehicle(),
            'drivers' => Driver::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $_vehicle)
    {
        return redirect(route('vehicles.index'));
    }

    private function validateVehicle($vehicle){
        if ($this->final && $vehicle->final_user_id != $this->user->id) return redirect(route('vehicles.index'));
        if (!$this->final && $vehicle->created_by != $this->user->id) return redirect(route('vehicles.index'));
        return false;
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
        if ($redirect = $this->validateVehicle($vehicle)) return $redirect;
        $all = $request->input();
        $all["odometer"] = \Helper::stringToFloat($all["odometer"]);
        return ($vehicle->update($all)) ? redirect(route('vehicles.index')) : $this->edit($vehicle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        if ($redirect = $this->validateVehicle($vehicle)) return $redirect;
        return view('vehicles.form', [
            'final'=>$this->final,
            'trackerTypes'=>  TrackerType::all(),
            'finals'=> User::where(["created_by" => $this->user->id])->get(),
            'vehicle' => $vehicle,
            'drivers' => Driver::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        if ($redirect = $this->validateVehicle($vehicle)) return $redirect;
        $vehicle->delete();
        return redirect(route('vehicles.index'));
    }
}
