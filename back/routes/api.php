<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Home\SearchController;
use App\Http\Controllers\Home\ServicesController;
use App\Http\Controllers\Api\Providers\ServicesController as ServiceProvidersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('auth/login', [LoginController::class, 'index']);
    Route::post('auth/register', [RegisterController::class, 'index']);


    Route::group([
        'middleware' => ['auth:sanctum']
    ], function () {
        # Auth
        Route::post('auth/logout', [LoginController::class, 'logout']);
        # Profile
        Route::post('profile/avatar', [ProfileController::class, 'avatar']);
        Route::get('profile', [ProfileController::class, 'index']);
        #Service
        Route::get('services/{id}', [ServicesController::class, 'show']);
        Route::get('services', [ServicesController::class, 'index']);

        #Dashboard
        Route::post('dashboard/services', [ServiceProvidersController::class, 'store']);
        Route::patch('dashboard/services', [ServiceProvidersController::class, 'update']);
        Route::get('dashboard/services', [ServiceProvidersController::class, 'index']);

        #Search
        Route::get('search/providers', [SearchController::class, 'providers']);
        Route::get('search', [SearchController::class, 'index']);
        Route::get('search', [SearchController::class, 'index']);

    });

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
