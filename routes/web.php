<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/file-manager', 'HomeController@fileManager')->name('fileManager');
Route::get('/file-manager-frame', 'HomeController@fileManagerFrame')->name('fileManagerFrame');
Route::get('/tawk', 'HomeController@tawk')->name('tawk');
Route::get('/tawk-frame', 'HomeController@tawkFrame')->name('tawkFrame');
Route::resource('/settings', 'SettingsController');
Route::resource('/roles', 'RolesController');
Route::get('/user/{user}/users', 'UsersController@index')->name('user');
Route::resource('/licenses', 'LicensesController');
Route::resource('/drivers', 'DriversController');
Route::resource('/vehicles', 'VehiclesController');
Route::resource('/fences', 'FencesController');
Route::resource('/contact_types', 'ContactTypesController');
Route::resource('contacts', 'ContactsController');
Route::resource('/states', 'StatesController');
Route::resource('/cities', 'CitiesController');
Route::get('/manager', 'ManagerController@index');
Route::resource('/tracker_types', 'TrackerTypesController');
Route::resource('/vehicle_branchs', 'VehicleBranchsController');
Route::resource('/vehicle_models', 'VehicleModelsController');

Route::get('/cep_contries', 'JSONController@contries');
Route::get('/cep_states', 'JSONController@states');
Route::get('/cep_cities', 'JSONController@cities');
Route::get('/json_branchs/{type}', 'JSONController@branchs');
Route::get('/json_models/{branch}', 'JSONController@models');