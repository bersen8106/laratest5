@extends('admin.layout.app')    <!-- контент из app.blade.php -->

@section('title', 'Список постов Laravel 12')

@section('content')
    <!-- Шапка поста -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold leading-tight">{{ $post->title }}</h1>
            <div class="flex items-center gap-2 text-sm text-gray-400 mt-1">
                <span class="badge">{{ $post->is_published ? 'Опубликован' : 'Не опубликован' }}</span>
                <span>•</span>
                <time datetime="2025-10-31">{{ $post->published_at?->format('d.m.Y') }}</time>
            </div>
        </div>
    </div>

    <!-- Краткое описание -->
    <div class="glass rounded-2xl p-6 border border-white/10 mt-6">
        <h2 class="text-lg font-semibold mb-2">Описание</h2>
        <p class="text-gray-300 leading-relaxed">
            {{ $post->excerpt }}
        </p>
    </div>

    <!-- Основной текст -->
    <div class="glass rounded-2xl p-6 border border-white/10 mt-6">
        <h2 class="text-lg font-semibold mb-4">Контент</h2>
        <div class="prose prose-invert max-w-none">
            {!! $post->body !!}
        </div>
    </div>

    <!-- Кнопки действий -->
    <div class="flex items-center justify-end gap-2 mt-6">
        <a href="posts-list.html" class="btn btn-outline">Назад к списку</a>
        <a href="post-edit.html" class="btn btn-primary">Редактировать</a>
    </div>
@endsection
