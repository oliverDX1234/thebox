<?php

use App\Http\Controllers\admin\AdminSettingsController;
use App\Http\Controllers\AuthController;
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

Route::group(["middleware" => 'auth:sanctum'], function () {

    Route::group(["prefix" => "admin"], function () {
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        Route::post('me', [AuthController::class, 'me']);
        Route::post('changeLayout', [AdminSettingsController::class, 'changeLayout']);
    });
});

Route::post('login', [AuthController::class, 'login']);
