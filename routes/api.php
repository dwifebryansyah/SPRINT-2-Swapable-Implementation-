<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ApiController};

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH
Route::group([
    'prefix' => 'akun'
], function ($router) {
    Route::post('register', [ApiController::class,'register'])->name('register');
    Route::post('login', [ApiController::class,'login'])->name('login');
});

Route::middleware(['checkbearer'])->group(function () {
    
    // SEARCH
    Route::get('search/province', [ApiController::class,'search_province']);
    Route::get('search/cities', [ApiController::class,'search_city']); 
    
});

// FETCHING
Route::group([
    'prefix' => 'fetching'
], function ($router) {
    Route::get('province', [ApiController::class,'province']);
    Route::get('cities', [ApiController::class,'cities']);
});