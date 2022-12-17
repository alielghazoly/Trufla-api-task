<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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



Route::group(['middleware' => ['jwt.verify']], function() {
    Route::apiResource('products', ProductController::class);   
    Route::apiResource('orders', OrderController::class);
});

Route::apiResource('users', UserController::class);

Route::post('users/login', [UserController::class,'login']);
Route::post('users/logout', [UserController::class,'logout'])->middleware(['jwt.verify']);

