<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BarangController;
use App\Http\Controllers\User\PesananController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('me', function (Request $request) {
        return response()->json([
            'user' => $request->user()
        ], 200);
    });
    Route::get('barang', [BarangController::class, 'get']);

    Route::get('orders/{order:id}', [PesananController::class, 'get']);
    Route::get('orders', [PesananController::class, 'getAll']);
    Route::post('orders', [PesananController::class, 'post']);

    Route::post('upload', [PesananController::class, 'upload']);

    Route::put('update-profile', [UserController::class, 'updateProfile']);

    Route::get('logout', [AuthController::class, 'logout']);
});
