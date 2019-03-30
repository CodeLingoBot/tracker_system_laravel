<?php

namespace App\Http\Controllers;

use App\Setting;
use App\State;
use Illuminate\Http\Request;

class StatesController extends Controller
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
        $states = State::paginate(Setting::paginacao());
        return view('states.index', ['states' => $states]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (State::create($request->input())) {
            return redirect(route('states.index'));
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
        return view('states.form', ['state' => new State()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \State $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \State $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        if ($state->update($request->input())) {
            return redirect(route('states.index'));
        } else {
            return $this->edit($state);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \State $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        return view('states.form', ['state' => $state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \State $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        return redirect(route('states.index'));
    }
}
