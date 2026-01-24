<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View                                      // метод для вывода всех постов
    {
        $posts = Post::query()                                         // берем данные из модели и обрабатываем
            ->where('is_published', true)              // выводим все посты которые опубликованы
            ->orderByDesc('published_at')                      // сортируем по полю 'published_at'
            ->paginate(6);                                    // пагинация
        return view('posts.index', compact('posts'));   // путь до файла, название переменной в шаблоне
    }

    public function show(Post $post): View                              // метод для вывода конкретного поста
    {
        return view('posts.show', compact('post'));     // данные передаются в шаблон в переменной 'post'
    }
}
