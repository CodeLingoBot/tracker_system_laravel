<?php

namespace App\Http\Controllers;

class ManagerController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('role:admin|subadmin');
	}

	public function index() {
		return view('manager.index');
	}
}
