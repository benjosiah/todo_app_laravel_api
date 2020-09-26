<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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


Route::middleware('auth:api')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/tasks','App\Http\Controllers\TasksController@index');
    Route::post('/task','App\Http\Controllers\TasksController@store');
    Route::patch('/task/{task}','App\Http\Controllers\TasksController@update');
    Route::delete('/task/{task}','App\Http\Controllers\TasksController@destroy');
    Route::post('/logout','App\Http\Controllers\UserController@logout');
});
Route::post('/login','App\Http\Controllers\UserController@login');
Route::post('/register','App\Http\Controllers\UserController@register');




