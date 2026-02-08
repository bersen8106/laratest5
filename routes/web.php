<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use Illuminate\Support\Facades\Route;

// импортируем PostController

//Route::get('/', [PostController::class, 'index'])->name('posts.index');
//Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
// /posts/{post:slug} - Laravel будет искать пост по полю slug, а не по id
// name - имя маршрута, которое может быть использовано в шаблонах

Route::get('/', fn() => redirect()->route('blog.index'))->name('index');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class);
});

Route::prefix('blog')->as('blog.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show'); // {переменная:ключ}
});

