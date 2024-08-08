<?php

use App\Http\Controllers\LocationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('locations')->group(function() {
    Route::get('/', [LocationsController::class, 'index']);
    Route::get('/{id}', [LocationsController::class, 'show']);
    Route::post('/', [LocationsController::class, 'store']);
    Route::put('/{id}', [LocationsController::class, 'update']);
});
