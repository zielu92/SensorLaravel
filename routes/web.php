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

Route::get('/', 'HomeController@welcome')->name('home');

Auth::routes();
Route::get('/update', 'SensorController@store');

Route::group(['middleware' => 'admin'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('admin/devices', 'DeviceController', ['names' => [
        'index' => 'admin.devices.index',
        'create' => 'admin.devices.create',
        'store' => 'admin.devices.store',
        'edit' => 'admin.devices.edit',
        'show' => 'admin.devices.show'
    ]]);

});
