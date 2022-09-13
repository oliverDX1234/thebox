<?php

use App\Http\Controllers\admin\AdminSettingsController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(["middleware" => 'auth:sanctum'], function () {

    Route::group(['middleware' => ['is-admin'], "prefix" => "admin"], function () {
        Route::post('me', [AuthController::class, 'me']);
        Route::post('changeLayout', [AdminSettingsController::class, 'changeLayout']);
    });

    Route::group([], function () {

        //Users
        Route::apiResource("users", UserController::class);

        Route::apiResource("suppliers", SupplierController::class);

        Route::apiResource("categories", CategoryController::class);
        Route::apiResource("categories", CategoryController::class);
        Route::get("categoriesTree", [CategoryController::class, "getCategoriesTree"]);
        Route::post("saveCategories", [CategoryController::class, "saveCategories"]);
        Route::post("getFiltersForCategories", [CategoryController::class, "getFiltersForCategories"]);
        Route::get("getCategoriesForProduct", [CategoryController::class, "getCategoriesForProduct"]);

        Route::get("/cities", [CityController::class, 'getCities']);

        Route::apiResource("filters", FilterController::class);

        Route::apiResource("attributes", AttributeController::class);

        Route::apiResource("products", ProductController::class);
        Route::get("products/remove-discount/{id}", [ProductController::class, "removeProductDiscount"]);

        Route::apiResource("packages", PackageController::class);
        Route::get("packages/remove-discount/{id}", [PackageController::class, "removePackageDiscount"]);

        Route::apiResource("discounts", DiscountController::class);
        Route::get("discounts/show-products/{id}", [DiscountController::class, "getProductsForDiscount"]);
        Route::get("discounts/update-status/{id}", [DiscountController::class, "updateStatus"]);

        Route::apiResource("couriers", CourierController::class);

        Route::apiResource("orders", OrderController::class);

        Route::get("search", SearchController::class);

        Route::group(["prefix" => "statistics"], function () {
            Route::get("user-statistics", [StatisticsController::class, "getStatisticsForUsers"]);
        });
    });
});


Route::get("password/reset/{token}", "ResetPasswordController@showResetForm")->name("password.reset"); // --> we'll delete this later
Route::post("password/reset", [ResetPasswordController::class, "reset"]);
Route::post("password/email", [ForgotPasswordController::class, "sendResetLinkEmail"])->name("password.email");

Route::post('admin/login', [AuthController::class, 'login']);
Route::post('admin/logout', [AuthController::class, 'logout']);

