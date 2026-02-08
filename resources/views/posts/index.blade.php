@extends('layouts.app')    <!-- контент из app.blade.php -->

@section('title', 'Блог на Laravel 12')

@section('content')
    <!-- Сетка карточек -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($posts as $post)
            <!-- Карточка поста -->
            <article
                class="group relative overflow-hidden rounded-2xl border border-white/10 bg-gray-900/40 p-5 shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-fuchsia-500/10">

                <!-- Кликабельная область -->
                <a
                    aria-label="Читать далее"
                    href="{{ route('blog.show', $post->slug) }}"
                    class="absolute inset-0 z-10"
                ></a>

                <!-- Контент карточки -->
                <div class="flex flex-col gap-3">

                    <!-- Дата -->
                    <div class="text-xs uppercase tracking-wide text-gray-400">
                        {{ $post->published_at?->format('d.m.Y') }}
                    </div>

                    <!-- Заголовок -->
                    <h3 class="text-xl font-semibold leading-tight text-white group-hover:text-fuchsia-300 transition-colors">
                        {{ $post->title }}
                    </h3>

                    <!-- Описание -->
                    <p class="text-gray-300 line-clamp-3">
                        {{ $post->excerpt }}
                    </p>

                    <!-- Кнопка действия -->
                    <div class="pt-2 mt-auto">
                        <a
                            href="{{ route('blog.show', $post->slug) }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-500/30 bg-fuchsia-500/10 px-3 py-2 text-sm text-fuchsia-500 transition-all hover:bg-fuchsia-500/20 hover:text-white hover:border-fuchsia-500/50"
                        >
                            Читать далее
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    @if($posts->hasPages())
        {{ $posts->onEachSide(1)->links('components.pagination') }}
    @endif
@endsection
