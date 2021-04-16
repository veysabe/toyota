<?php

use App\Models\Apply;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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

Route::get('/test', function () {

});

Auth::routes(['register' => false]);

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);

Route::get('/delete-apply/{apply}', [\App\Http\Controllers\Api\v1\AppliesController::class, 'destroy']);

Route::get('/{any}', function () {
    return view('home');
})->where('any', '.*');
