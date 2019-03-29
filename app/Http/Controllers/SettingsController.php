<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
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
        $settings = Setting::paginate(Setting::paginacao());
        return view('settings.index', ['settings' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.form', ['setting' => new Setting()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        if (Setting::create(['key' => $key, 'value' => $value])){
            return redirect(route('settings.index'));
        } else {
            return $this->create();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('settings.form',['setting' => $setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        if ($setting->update(['key' => $key, 'value' => $value])){
            return redirect(route('settings.index'));
        } else {
            return $this->edit($setting);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect(route('settings.index'));
    }
}
