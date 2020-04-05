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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/about', 'WelcomeController@about')->name('about');
Auth::routes();
Route::get('/update', 'SensorController@store');

Route::group(['middleware' => 'admin'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('admin/places/location/{id}', 'LocationController@locationList');

    Route::resource('admin/devices', 'DeviceController', ['names' => [
        'index' => 'admin.devices.index',
        'create' => 'admin.devices.create',
        'store' => 'admin.devices.store',
        'edit' => 'admin.devices.edit',
        'show' => 'admin.devices.show'
    ]]);

    Route::resource('admin/places', 'PlaceController', ['names' => [
        'index' => 'admin.places.index',
        'create' => 'admin.places.create',
        'store' => 'admin.places.store',
        'edit' => 'admin.places.edit',
        'show' => 'admin.places.show'
    ]]);

    Route::resource('admin/locations', 'LocationController', ['names' => [
        'index' => 'admin.locations.index',
        'create' => 'admin.locations.create',
        'store' => 'admin.locations.store',
        'edit' => 'admin.locations.edit',
        'show' => 'admin.locations.show'
    ]]);
});

