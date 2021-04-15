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

Route::get('cars', [\App\Http\Controllers\Api\v1\CarsController::class, 'index']);
Route::post('times', [\App\Http\Controllers\Api\v1\TimesController::class, 'index']);
Route::resource('apply', \App\Http\Controllers\Api\v1\AppliesController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
