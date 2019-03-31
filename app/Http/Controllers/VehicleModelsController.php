<?php

namespace App\Http\Controllers;

use App\VehicleModel;
use App\VehicleBranch;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VehicleModelsController extends Controller
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
        $type = Input::get('type');
        $type = isset($type) ? $type : 0;
        $branchId = Input::get('branch_id');
        $branchId = isset($branchId) ? $branchId : VehicleBranch::where(['type'=>$type])->first()->id;
        $vehicleModels = VehicleModel::where(['branch_id'=>$branchId])->paginate(Setting::paginacao());
        return view('vehicle_models.index', ['type'=>$type, 'branchId' => $branchId, 'vehicleModels' => $vehicleModels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (VehicleModel::create($request->input())) {
            return redirect(route('vehicle_models.index'));
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
        return view('vehicle_models.form', ['vehicleModel' => new VehicleModel()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \VehicleModel $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleModel $vehicleModel)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \VehicleModel $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleModel $vehicleModel)
    {
        if ($vehicleModel->update($request->input())) {
            return redirect(route('vehicle_models.index'));
        } else {
            return $this->edit($vehicleModel);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \VehicleModel $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleModel $vehicleModel)
    {
        return view('vehicle_models.form', ['vehicleModel' => $vehicleModel]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \VehicleModel $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleModel $vehicleModel)
    {
        $vehicleModel->delete();
        return redirect(route('vehicle_models.index'));
    }
}
