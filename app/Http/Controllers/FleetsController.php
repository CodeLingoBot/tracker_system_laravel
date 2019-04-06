<?php

namespace App\Http\Controllers;

use App\Fleet;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FleetsController extends Controller
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
        $fleets = Fleet::where(['created_by' => Auth::user()->id])->paginate(Setting::paginacao());
        return view('fleets.index', ['fleets' => $fleets]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Fleet::create($request->input())) {
            return redirect(route('fleets.index'));
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
        return view('fleets.form', ['fleet' => new Fleet()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Fleet $fleet
     * @return \Illuminate\Http\Response
     */
    public function show(Fleet $fleet)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Fleet $fleet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fleet $fleet)
    {
        if ($fleet->update($request->input())) {
            return redirect(route('fleets.index'));
        } else {
            return $this->edit($fleet);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Fleet $fleet
     * @return \Illuminate\Http\Response
     */
    public function edit(Fleet $fleet)
    {
        return view('fleets.form', ['fleet' => $fleet]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fleet $fleet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        return redirect(route('fleets.index'));
    }
}
