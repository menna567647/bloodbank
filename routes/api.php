<?php

use App\Http\Controllers\Api\v1\GeneralController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ContactController;
use App\Http\Controllers\Api\v1\DonationController;
use App\Http\Controllers\Api\v1\NotificationController;
use App\Http\Controllers\Api\v1\SettingController;
use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::get('bloodtypes', [GeneralController::class, 'bloodTypes']);
    Route::get('governrates', [GeneralController::class, 'governrates']);
    Route::get('cities', [GeneralController::class, 'cities']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset', [AuthController::class, 'reset']);
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [AuthController::class, 'reset']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('posts', [PostController::class, 'index']);
        Route::post('posts/favorite/{id}', [PostController::class, 'toggleFavorite']);
        Route::get('posts/myfavorite', [PostController::class, 'favoritePosts']);
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('contacts', [ContactController::class, 'index']);
        Route::get('donations', [DonationController::class, 'index']);
        Route::post('create_donation_request', [DonationController::class, 'store']);
        Route::get('notifications', [NotificationController::class, 'index']);
        Route::post('notifications/read/{id}', [NotificationController::class, 'isRead']);
        Route::get('settings', [SettingController::class, 'index']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});