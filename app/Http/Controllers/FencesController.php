<?php

namespace App\Http\Controllers;
use App\Fence;
use App\Setting;
use GMaps;
use Illuminate\Http\Request;

class FencesController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('role:admin');
	}
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
	public function index() {
		$fences = Fence::paginate(Setting::paginacao());
		return view('fences.index', ['fences' => $fences]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		GMaps::initialize([
			'drawing' => true,
			'drawingDefaultMode' => 'polygon',
			'drawingControl' => false,
			'drawingOnComplete' => ['polygon' => 'onPolygonDrawn(event)'],
			'places' => true,
			'placesAutocompleteInputID' => 'center_map',
			'placesAutocompleteOnChange' => true,
		]);
		return view('fences.form', ['fence' => new Fence(), 'map' => GMaps::create_map()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if (Fence::create($request->input())) {
			return redirect(route('fences.index'));
		} else {
			return $this->create();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \Fence $fence
	 * @return \Illuminate\Http\Response
	 */
	public function show(Fence $fence) {
		GMaps::initialize([
			'polygons' => ["polygon = new google.maps.Polygon({paths: " . json_encode(json_decode($fence->polygon)->positions) . "}); polygon.setMap(map);var bounds = new google.maps.LatLngBounds(); var path=polygon.getPath().j;for (var i=0; i<path.length; i++){bounds.extend(new google.maps.LatLng(path[i].lat(), path[i].lng()));};map.fitBounds(bounds);"],
		]);
		return view('fences.view', ['map' => GMaps::create_map(), 'fence' => $fence]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Fence $fence
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Fence $fence) {
		GMaps::initialize([
			'drawing' => true,
			'drawingDefaultMode' => 'polygon',
			'drawingControl' => false,
			'drawingOnComplete' => ['polygon' => 'onPolygonDrawn(event)'],
			'places' => true,
			'placesAutocompleteInputID' => 'center_map',
			'placesAutocompleteOnChange' => true,
			'polygons' => ["polygon = new google.maps.Polygon({paths: " . json_encode(json_decode($fence->polygon)->positions) . "}); polygon.setMap(map);var bounds = new google.maps.LatLngBounds(); var path=polygon.getPath().j;for (var i=0; i<path.length; i++){bounds.extend(new google.maps.LatLng(path[i].lat(), path[i].lng()));};map.fitBounds(bounds);"],
		]);
		return view('fences.form', ['map' => GMaps::create_map(), 'fence' => $fence]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Fence $fence
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Fence $fence) {
		if ($fence->update($request->input())) {
			return redirect(route('fences.index'));
		} else {
			return $this->edit($fence);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Fence $fence
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Fence $fence) {
		$fence->delete();
		return redirect(route('fences.index'));
	}
}
