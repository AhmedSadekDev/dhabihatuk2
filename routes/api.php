<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
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
});
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('deleteAccount', [AuthController::class, 'deleteAccount']);
    Route::get('getProfileData', [AuthController::class, 'getProfileData']);
    Route::post('updateProfile', [AuthController::class, 'updateProfile']);
    Route::post('updatePassword', [AuthController::class, 'updatePassword']);
    Route::get('allNews', [HomeController::class, 'allNews']);
    Route::get('allSuitables', [HomeController::class, 'allSuitables']);
    Route::get('familyNames', [HomeController::class, 'familyNames']);
    Route::get('getNotifications', [HomeController::class, 'getNotifications']);
    Route::get('whoUs', [HomeController::class, 'whoUs']);
    Route::get('about', [HomeController::class, 'about']);
    Route::get('terms', [HomeController::class, 'terms']);
    Route::get('getSocials', [HomeController::class, 'getSocials']);
    Route::post('sendContact', [HomeController::class, 'sendContact']);
    Route::post('addNew', [HomeController::class, 'addNew']);
    Route::post('addSuitable', [HomeController::class, 'addSuitable']);
    Route::get('setting', [HomeController::class, 'setting']);
});
