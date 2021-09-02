<?php

use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\MaritalStatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Auth\LoginController;

Route::group([
    'prefix' => 'v1',
    'as' => 'v1.'
], static function () {
    Route::group([
        'middleware' => 'guest',
        'prefix' => 'login',
        'as' => 'login.'
    ], static function () {
        Route::post('/', [LoginController::class, 'store'])->name('store');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

    Route::group([
        'middleware' => 'auth:sanctum'
    ], static function () {
        Route::apiResource('users', UserController::class);

        Route::get('/genders', [GenderController::class, 'index']);
        Route::get('/marital-status', [MaritalStatusController::class, 'index']);
    });
});
