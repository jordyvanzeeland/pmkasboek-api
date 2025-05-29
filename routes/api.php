<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::post("register", 'App\Http\Controllers\UserController@registerUser');

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get("amounts/types", 'App\Http\Controllers\AmountTypesController@getAllTypes');
    Route::get("amounts/type/{type}", 'App\Http\Controllers\AmountTypesController@getType');
    Route::post("amounts/types/insert", 'App\Http\Controllers\AmountTypesController@insertType');
    Route::put("amounts/type/{type}/update", 'App\Http\Controllers\AmountTypesController@updateType');
    Route::delete("amounts/type/{type}/delete", 'App\Http\Controllers\AmountTypesController@deleteType');

    Route::get("amounts/{bookid}", 'App\Http\Controllers\AmountsController@getAllAmountsOfUser');
    Route::get("amounts/{amount}", 'App\Http\Controllers\AmountsController@getAmount');
    Route::post("amounts/insert", 'App\Http\Controllers\AmountsController@insertAmount');
    Route::put("amounts/{amount}/update", 'App\Http\Controllers\AmountsController@updateAmount');
    Route::delete("amounts/{amount}/delete", 'App\Http\Controllers\AmountsController@deleteAmount');

    Route::get("saldos", 'App\Http\Controllers\SaldosController@getUserStartSaldo');
    Route::get("saldos/{saldo}", 'App\Http\Controllers\SaldosController@getSaldo');
    Route::post("saldos/insert", 'App\Http\Controllers\SaldosController@insertSaldo');
    Route::put("saldos/{saldo}/update", 'App\Http\Controllers\SaldosController@updateSaldo');
    Route::delete("saldos/{saldo}/delete", 'App\Http\Controllers\SaldosController@deleteSaldo');
});


