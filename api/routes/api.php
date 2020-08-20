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

Route::prefix('/auth')->group(function () {
    Route::post('/signIn', 'UserController@signIn');
    Route::post('/signUp', 'UserController@signUp');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::prefix('/refunds')->group(function () {
        Route::get('/', 'RefundController@index');
        Route::get('/{refund}', 'RefundController@show');
        Route::post('/', 'RefundController@store');
        Route::put('/{refund}', 'RefundController@update');
        // Route::delete('/{refund}', 'RefundController@destroy');
    });

    Route::prefix('/expenses')->group(function () {
        Route::get('/', 'ExpenseController@index');
        Route::get('/{expense}', 'ExpenseController@show');
        Route::put('/{expense}', 'ExpenseController@update');
        Route::post('/', 'ExpenseController@store');
    });    
    Route::get('/auth/signOut', 'UserController@signOut');
});
