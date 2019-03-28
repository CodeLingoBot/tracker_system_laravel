<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GMaps;

class FencesController extends Controller
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
        GMaps::initialize([
            'drawing' => true,
            'drawingDefaultMode' => 'polygon',
            'drawingControl' => false,
            'drawingOnComplete' => ['polygon' => 'onPolygonDrawn(event)'],
            'places' => true,
            'placesAutocompleteInputID' => 'center_map',
            'placesAutocompleteOnChange' => true
        ]);
        $map = GMaps::create_map();
        return view('fences.create', ['map' => $map]);
    }
}
