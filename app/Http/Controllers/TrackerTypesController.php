<?php

namespace App\Http\Controllers;

use App\TrackerType;
use App\Setting;
use Illuminate\Http\Request;

class TrackerTypesController extends Controller
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
        $trackerTypes = TrackerType::paginate(Setting::paginacao());
        return view('tracker_types.index', ['trackerTypes' => $trackerTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (TrackerType::create($request->input())) {
            return redirect(route('tracker_types.index'));
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
        return view('tracker_types.form', ['trackerType' => new TrackerType()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \TrackerType $trackerType
     * @return \Illuminate\Http\Response
     */
    public function show(TrackerType $trackerType)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \TrackerType $trackerType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrackerType $trackerType)
    {
        if ($trackerType->update($request->input())) {
            return redirect(route('tracker_types.index'));
        } else {
            return $this->edit($trackerType);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \TrackerType $trackerType
     * @return \Illuminate\Http\Response
     */
    public function edit(TrackerType $trackerType)
    {
        return view('tracker_types.form', ['trackerType' => $trackerType]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \TrackerType $trackerType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackerType $trackerType)
    {
        $trackerType->delete();
        return redirect(route('tracker_types.index'));
    }
}
