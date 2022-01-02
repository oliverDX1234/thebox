<?php

use App\Http\Controllers\admin\AdminSettingsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => 'auth:sanctum'], function () {

    Route::group(["prefix" => "admin"], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('me', [AuthController::class, 'me']);
        Route::post('changeLayout', [AdminSettingsController::class, 'changeLayout']);
    });
});


Route::post('reset-password', [AuthController::class, 'sendPasswordResetLink']);
Route::post('reset/password', [AuthController::class, 'callResetPassword']);
Route::post('admin/login', [AuthController::class, 'login']);
