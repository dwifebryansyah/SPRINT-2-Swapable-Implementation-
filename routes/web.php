<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ProvinceController;

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

// Province
Route::get('/province', [ProvinceController::class, 'index'])->name('province-index');
Route::get('/province/search', [ProvinceController::class, 'search'])->name('province-search');

// Cities
Route::get('/cities', [CitiesController::class, 'index'])->name('cities-index');