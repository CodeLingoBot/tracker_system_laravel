<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use App\VehicleBranch;
use App\VehicleModel;
use Illuminate\Support\Facades\Input;

class JSONController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function contries()
    {
        $brazil = [
            "id" => 0,
            "nome" => "Brasil",
            "sigla" => "BR"
        ];
        return response()->json([
            (object)$brazil
        ]);
    }

    public function states()
    {
        $states = State::all();
        $statesJson = [];
        foreach ($states as $state) {
            $statesJson[] = (object)[
                "id" => $state->id,
                "nome" => $state->name,
                "sigla" => $state->initials,
                "pais_id" => 0
            ];
        }
        return response()->json($statesJson);
    }

    public function cities()
    {
        $cities = City::where(['state_id' => Input::get('id')])->get();
        $citiesJson = [];
        foreach ($cities as $city) {
            $citiesJson[] = (object)[
                "id" => $city->id,
                "nome" => $city->name,
                "estado_id" => $city->state_id
            ];
        }
        return response()->json($citiesJson);
    }

    public function branchs($type)
    {
        return response()->json(VehicleBranch::where(['type'=>$type])->get());
    }

    public function models(VehicleBranch $branch)
    {
        return response()->json($branch->models);
    }
}
