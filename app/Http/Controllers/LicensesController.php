<?php

namespace App\Http\Controllers;

use App\License;
use App\Setting;
use Illuminate\Http\Request;

class LicensesController extends Controller
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
        $licenses = License::paginate(Setting::paginacao());
        return view('licenses.index', ['licenses' => $licenses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (License::create($request->input())) {
            return redirect(route('licenses.index'));
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
        return view('licenses.form', ['license' => new License()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \License $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \License $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $license)
    {
        if ($license->update($request->input())) {
            return redirect(route('licenses.index'));
        } else {
            return $this->edit($license);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \License $license
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        return view('licenses.form', ['license' => $license]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \License $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        $license->delete();
        return redirect(route('licenses.index'));
    }
}
