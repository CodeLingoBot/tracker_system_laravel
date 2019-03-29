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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/file-manager', 'HomeController@fileManager')->name('fileManager');
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
Route::get('/cep_contries', 'CEPController@contries');
Route::get('/cep_states', 'CEPController@states');
Route::get('/cep_cities', 'CEPController@cities');
Route::get('/manager', 'ManagerController@index');