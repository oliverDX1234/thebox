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


Route::get("password/reset/{token}", "ResetPasswordAPIController@showResetForm")->name("password.reset"); // --> we'll delete this later
Route::post("password/reset", "ResetPasswordAPIController@reset");
Route::post("password/email", "ForgotPasswordAPIController@sendResetLinkEmail")->name("password.email");

Route::post('admin/login', [AuthController::class, 'login']);
