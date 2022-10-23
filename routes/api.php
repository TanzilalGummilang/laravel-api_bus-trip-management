<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TerminalController;
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

Route::apiResource('buses', BusController::class);
Route::apiResource('drivers', DriverController::class);
Route::apiResource('terminals', TerminalController::class);
Route::apiResource('routes', RouteController::class);