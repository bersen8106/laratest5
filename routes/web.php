<?php

use App\Http\Controllers\PostController;    // импортируем PostController
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
// /posts/{post:slug} - Laravel будет искать пост по полю slug, а не по id
// name - имя маршрута, которое может быть использовано в шаблонах
