<?php

use App\Http\Controllers\NonPardusAppController;
use App\Http\Controllers\PardusAppController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'dashboard'], function () {
    Route::get('/', fn() => view('dashboard'))->name('dashboard');

    Route::resource('pardus-apps', PardusAppController::class);
    Route::resource('non-pardus-apps', NonPardusAppController::class);
    Route::resource('app-packages', \App\Http\Controllers\AppPackageController::class);
});

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/
