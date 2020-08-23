<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', 'GeneralController@isOk');

Route::group([
    'prefix' => 'oauth'
], function ($router) {
    Route::post('token', 'AuthController@createToken');
    Route::delete('token/{tokenId}', 'AuthController@revokeToken');
    Route::post('user', 'AuthController@user');
});

Route::group([
    'prefix' => 'user'
], function ($router) {
    Route::get('/', 'UserController@getUser')->middleware(['permission2:']);
    Route::get('/{user_id}', 'UserController@getUserById')->middleware(['permission2:']);
    Route::post('/', 'UserController@newUser')->middleware(['permission2:']);
    Route::patch('/{user_id}', 'UserController@editUser')->middleware(['permission2:']);
    Route::delete('/{user_id}', 'UserController@removeUser')->middleware(['permission2:']);
});

Route::group([
    'prefix' => 'car'
], function ($router) {
    Route::get('/', 'CarController@getCar')->middleware(['permission2:']);
    Route::get('/{car_id}', 'CarController@getCarById')->middleware(['permission2:']);
    Route::get('/{license_plate}', 'CarController@getCarByLicensePlate')->middleware(['permission2:']);
    Route::get('/{company_id}', 'CarController@getCarByCompanyId')->middleware(['permission2:']);
    Route::get('/{status}', 'CarController@getCarByStatus')->middleware(['permission2:']);
    Route::post('/', 'CarController@newCar')->middleware(['permission2:']);
    Route::patch('/{car_id}', 'CarController@editCar')->middleware(['permission2:']);
    Route::delete('/{car_id}', 'CarController@removeCar')->middleware(['permission2:']);
});

Route::group([
    'prefix' => 'status'
], function ($router) {
    Route::get('/{license_plate}', 'StatusController@getStatusByLicensePlate')->middleware(['permission2:']);
    Route::post('/', 'StatusController@newStatus')->middleware(['permission2:']);
});

Route::group([
    'prefix' => 'history'
], function ($router) {
    Route::get('/', 'HistoryController@getHistory')->middleware(['permission2:']);
    Route::get('/{car_id}', 'HistoryController@getHistoryByCarId')->middleware(['permission2:']);
    Route::get('/{license_plate}', 'HistoryController@getHistoryByLicensePlate')->middleware(['permission2:']);
    Route::get('/{company_id}', 'HistoryController@getHistoryByCompanyId')->middleware(['permission2:']);
});
