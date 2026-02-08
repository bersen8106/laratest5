@extends('admin.layout.app')    <!-- контент из app.blade.php -->

@section('title', 'Список постов Laravel 12')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-xl font-bold">Посты</h1>
            <p class="text-sm text-gray-400">Управляйте контентом блога</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-ptimary cursor-pointer p-1 rounded-xl">+ Новый пост</a>
    </div>
    <!-- Фильтры и поиск -->
    <div class="glass rounded-2xl p-4 border border-white/10">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3">

            <!-- Поле поиска -->
            <input type="text" class="input" placeholder="Поиск по заголовку..."/>

            <!-- Фильтр по статусу -->
            <select class="input">
                <option value="">Статус: все</option>
                <option value="draft">Черновик</option>
                <option value="published">Опубликован</option>
            </select>

            <!-- Сортировка -->
            <select class="input">
                <option value="newest">Сортировка: новые</option>
                <option value="oldest">Старые</option>
                <option value="title_asc">По заголовку A-Z</option>
            </select>

            <!-- Кнопка сброса -->
            <button class="btn btn-outline">Сбросить</button>
        </div>
    </div>
    <div class="overflow-hidden rounded-2xl border border-white/10">
        <!-- Таблица постов -->
        <table class="w-full text-sm">

            <!-- Заголовок таблицы -->
            <thead class="bg-white/5 text-gray-300">
            <tr>
                <th class="text-left px-4 py-3">ID</th>
                <th class="text-left px-4 py-3">Заголовок</th>
                <th class="text-left px-4 py-3">Статус</th>
                <th class="text-left px-4 py-3">Дата</th>
                <th class="text-left px-4 py-3">Действия</th>
            </tr>
            </thead>

            <!-- Тело таблицы -->
            <tbody class="&gt; tr:nth-child(even) :bg-white/5">

            <!-- Строка 1 -->
            @foreach($posts as $post)
                <tr>
                    <td class="px-4 py-3">{{ $post->id }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge">{{ $post->is_published ? 'Опубликован' : 'В драфте' }}</span>
                    </td>
                    <td class="px-4 py-3">{{ $post->published_at?->format('d.m.Y') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2 justify-end">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline">Редактировать</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline cursor-pointer">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div class="flex item-center justify-center gap-2">
        {{ $posts->links() }}
    </div>

@endsection
