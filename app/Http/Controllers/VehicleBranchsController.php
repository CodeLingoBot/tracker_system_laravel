<?php

namespace App\Http\Controllers;

use App\VehicleBranch;
use App\Setting;
use Illuminate\Http\Request;

class VehicleBranchsController extends Controller
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
        $vehicleBranchs = VehicleBranch::paginate(Setting::paginacao());
        return view('vehicle_branchs.index', ['vehicleBranchs' => $vehicleBranchs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (VehicleBranch::create($request->input())) {
            return redirect(route('vehicle_branchs.index'));
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
        return view('vehicle_branchs.form', ['vehicleBranch' => new VehicleBranch()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \VehicleBranch $vehicleBranch
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleBranch $vehicleBranch)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \VehicleBranch $vehicleBranch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleBranch $vehicleBranch)
    {
        if ($vehicleBranch->update($request->input())) {
            return redirect(route('vehicle_branchs.index'));
        } else {
            return $this->edit($vehicleBranch);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \VehicleBranch $vehicleBranch
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleBranch $vehicleBranch)
    {
        return view('vehicle_branchs.form', ['vehicleBranch' => $vehicleBranch]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \VehicleBranch $vehicleBranch
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleBranch $vehicleBranch)
    {
        $vehicleBranch->delete();
        return redirect(route('vehicle_branchs.index'));
    }
}
