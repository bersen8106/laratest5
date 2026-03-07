<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

Route::prefix('auth')->group(function (): void {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

//Route::get('posts', [PostController::class, 'index']);
//Route::get('posts/{id}', [PostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/posts/trashed', [PostController::class, 'trashed']);
    Route::apiResource('posts', PostController::class)->except('create', 'edit');   // исключаем методы create и edit т.к. их нет в PostController
    Route::post('/posts/{id}/restore', [PostController::class, 'restore']);
    Route::delete('/posts/{id}/force', [PostController::class, 'forceDelete']);
});
