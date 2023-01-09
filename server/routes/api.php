<?php

use App\Http\Controllers\API\AUTH\AuthenticationController;
use App\Http\Controllers\API\AUTH\LogoutController;
use App\Http\Controllers\API\AUTH\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\UserController;
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

Route::apiResource('register', RegisterController::class);
Route::apiResource('login', AuthenticationController::class);
Route::apiResource('logout', LogoutController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('products', ProductController::class);
