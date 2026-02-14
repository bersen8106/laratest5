@extends('admin.layout.app')    <!-- контент из app.blade.php -->

@section('title', 'Создание поста')

@section('content')
    <!-- Заголовок страницы -->
    <h1 class="text-xl font-bold">Новый пост</h1>


    <form class="glass rounded-2xl p-6 border border-white/10 space-y-5 flex flex-col gap-3" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col">
            <label class="label mb-2 text-gray-300">Изображение</label>
            <input type="file" name="image" accept="image/*" class="mt-1 block w-full rounded border border-white/10 bg-gray-900/40 p-2 cursor-pointer">
            @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex flex-col">
            <label class="label mb-2 text-gray-300">Заголовок</label>
            <input type="text" class="input border border-white/10 px-3 py-2 rounded-xl" placeholder="Название поста" name="title">
            @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex flex-col">
            <label class="label mb-2 text-gray-300">Краткое описание</label>
            <textarea
                class="input border border-white/10 px-3 py-2 rounded-xl"
                rows="3"
                placeholder="Текст для списка постов..."
                name="excerpt"
            ></textarea>
            @error('excerpt') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex flex-col">
            <label class="label mb-2 text-gray-300">Текст</label>
            <textarea
                class="input border border-white/10 px-3 py-2 rounded-xl"
                rows="10"
                placeholder="Основной контент..."
                name="body"
            ></textarea>
            @error('body') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div class="flex flex-col">
                <label class="label mb-2 text-gray-300">Статус</label>
                <input type="checkbox" name="is_published">
            </div>
        </div>

        <div class="flex items-center justify-end gap-2 pt-4">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline cursor-pointer">Отмена</a>
            <button type="submit" class="btn btn-primary px-4 py-2 cursor-pointer rounded-xl">Создать</button>
        </div>
    </form>
@endsection
