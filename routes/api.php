<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Orders\StoreController;
use App\Http\Controllers\API\Products\IndexController;
use App\Http\Controllers\API\Categories\CategoryProductsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** Login */
Route::post('login', [AuthController::class, 'accessToken']);

/** Logout */
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

/** All Available Active Produtcs */
Route::get('products', IndexController::class);

/** All Available Category Active Produtcs */
Route::get('category/{id}/products', CategoryProductsController::class);

/** Save an Order */
Route::post('orders', StoreController::class);

/** Product Routes */
Route::group(['prefix' => 'products', 'middleware' => 'auth:api'], function () {
    /** Save Product */
    Route::post('/', App\Http\Controllers\API\Products\StoreController::class);

    /** Update Product */
    Route::put('/{id}/update', App\Http\Controllers\API\Products\UpdateController::class);

    /** Show Product */
    Route::get('/{id}', App\Http\Controllers\API\Products\ShowController::class);

    /** Delete Product */
    Route::delete('/{id}/destroy', App\Http\Controllers\API\Products\DeleteController::class);
});
