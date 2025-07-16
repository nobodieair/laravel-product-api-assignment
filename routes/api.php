<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\AuthController; // Ensure this is imported

Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('products', ProductApiController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
});
