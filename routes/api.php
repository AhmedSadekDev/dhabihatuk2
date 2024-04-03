<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LocationCotroller;
use App\Http\Controllers\Api\OrderController;
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

Route::group(['middleware' => ['api']], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verifyCode', [AuthController::class, 'verifyCode']);
    Route::post('verifyCodePassword', [AuthController::class, 'verifyCodePassword']);
    Route::post('resendCode', [AuthController::class, 'resendCode']);
    Route::post('resetPassword', [AuthController::class, 'resetPassword']);
    Route::post('changePassword', [AuthController::class, 'changePassword']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('homeScreen', [HomeController::class, 'homeScreen']);
    Route::get('categoryProducts', [HomeController::class, 'categoryProducts']);
    Route::get('productDetials', [HomeController::class, 'productDetials']);
    Route::get('Wrapping', [HomeController::class, 'Wrapping']);
    Route::get('Chopping', [HomeController::class, 'Chopping']);
    Route::get('delivay_times', [HomeController::class, 'delivay_times']);
});
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('deleteAccount', [AuthController::class, 'deleteAccount']);
    Route::get('getProfileData', [AuthController::class, 'getProfileData']);
    Route::post('updateProfile', [AuthController::class, 'updateProfile']);
    Route::post('updatePassword', [AuthController::class, 'updatePassword']);
    Route::get('getLocations', [LocationCotroller::class, 'getLocations']);
    Route::get('deleteLocation', [LocationCotroller::class, 'deleteLocation']);
    Route::post('addLocation', [LocationCotroller::class, 'addLocation']);
    Route::get('getNotifications', [HomeController::class, 'getNotifications']);
    Route::get('about', [HomeController::class, 'about']);
    Route::get('terms', [HomeController::class, 'terms']);
    Route::get('getSocials', [HomeController::class, 'getSocials']);
    Route::post('sendContact', [HomeController::class, 'sendContact']);
    Route::get('setting', [HomeController::class, 'setting']);
    Route::post('addToCart', [CartController::class, 'addToCart']);
    Route::get('getCart', [CartController::class, 'getCart']);
    Route::get('removeCart', [CartController::class, 'removeCart']);
    Route::post('makeOrder', [OrderController::class, 'makeOrder']);
    Route::get('myOrders', [OrderController::class, 'myOrders']);
    Route::get('reOrder', [OrderController::class, 'reOrder']);
    Route::get('deleteOrder', [OrderController::class, 'deleteOrder']);
    Route::post('updateOrder', [OrderController::class, 'updateOrder']);
});
