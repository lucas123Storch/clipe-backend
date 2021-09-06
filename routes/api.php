<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\MaritalStatusController;
use App\Http\Controllers\Api\Auth\{RegisterController, LoginController};

Route::group([
    'prefix' => 'v1',
    'as' => 'v1.'
], static function () {
    Route::get('/ping', fn() => response()->json(['ok']));
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->middleware('guest');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store')->middleware('guest');
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

    Route::group([
        'middleware' => 'auth:sanctum'
    ], static function () {
        Route::group([
            'prefix' => 'profile',
            'as' => 'profile.'
        ], static function () {
            Route::get('/', [ProfileController::class, 'show'])->name('show');
            Route::put('/', [ProfileController::class, 'update'])->name('update');
        });

        Route::apiResource('users', UserController::class)->middleware('admin');
    });

    Route::get('/genders', [GenderController::class, 'index']);
    Route::get('/marital-status', [MaritalStatusController::class, 'index']);
});
