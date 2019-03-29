<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CitiesController extends Controller
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
        $stateId = Input::get('state_id');
        if (!isset($stateId)){
            $stateId = State::first()->id;
        }
        $state = State::find($stateId);
        $cities = City::where(['state_id' => $stateId])->paginate(Setting::paginacao());
        return view('cities.index', ['state' => $state, 'cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('cities.create', ['states'=>$states]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (City::create($request->input())){
            return redirect(route('cities.index')."?state_id=".$request->state_id);
        } else {
            return $this->create();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \City $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $states = State::all();
        return view('cities.edit',['city' => $city, 'states'=>$states]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \City $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        if ($city->update($request->input())){
            return redirect(route('cities.index')."?state_id=".$city->state_id);
        } else {
            return $this->edit($city);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $stateId = $city->state_id;
        $city->delete();
        return redirect(route('cities.index')."?state_id=".$stateId);
    }
}
