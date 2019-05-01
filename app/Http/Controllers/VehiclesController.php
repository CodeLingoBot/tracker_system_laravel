<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Fleet;
use App\Setting;
use App\TrackerType;
use App\User;
use App\Vehicle;
use App\LocationInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use GMaps;

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
        $user = User::find(Input::get('final_user_id'));
        if (!$this->final && $user)
            $vehicles = Vehicle::where(['final_user_id' => $user->id]);
        else
            $vehicles = Vehicle::where(['created_by' => $this->user->id]);
        return view('vehicles.index', [
            'final'=>$this->final,
            'user'=> isset($user) ? $user : $this->user,
            'finalUserId' => Input::get('final_user_id'),
            'vehicles' => $vehicles->paginate(Setting::paginacao())
        ]);
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
            'finalUserId' => Input::get('final_user_id'),
            'drivers' => Driver::where(["created_by" => $this->user->id])->get(),
            'fleets' => Fleet::where(["created_by" => $this->user->id])->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        $lastLocation = LocationInformation::where('imei', $vehicle->uuid)->orderBy('created_at', 'desc')->first();
        $map = null;
        if ($lastLocation){
            GMaps::initialize(['center'=>$lastLocation->latitude_decimal.";".$lastLocation->longitude_decimal]);
            Gmaps::add_marker(['position'=>$lastLocation->latitude_decimal.";".$lastLocation->longitude_decimal]);
            $map = GMaps::create_map();
        }
        return view('vehicles.show', [
            'map' => $map
        ]);
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
            'finalUserId' => Input::get('final_user_id'),
            'drivers' => Driver::where(["created_by" => $this->user->id])->get(),
            'fleets' => Fleet::where(["created_by" => $this->user->id])->get(),
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
