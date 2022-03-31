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

/** All Available Active Produtcs */
Route::get('products', IndexController::class);

/** All Available Category Active Produtcs */
Route::get('category/{id}/products', CategoryProductsController::class);

/** Save an Order */
Route::post('orders', StoreController::class);
