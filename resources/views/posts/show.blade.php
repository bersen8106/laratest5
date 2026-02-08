@extends('layouts.app')    <!-- контент из app.blade.php -->

@section('title', 'Блог на Laravel 12')

@section('content')
    <main class="mx-auto max-w-6xl px-4 py-10">
        <div class="flex flex-col gap-4 bg-gray-900/40 p-6 rounded-2xl">
            <div>
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/10 px-3 py-2 text-sm text-gray-300 hover:text-white">
                    Ко всем постам
                </a>
            </div>
            <article class="prose prose-invert max-w-none">
                <p class="text-xs text-gray-400 uppercase tracking-wide">
                    Опубликовано: {{ optional($post->published_at ?? $post->created_at)->format('d.m.Y') }}
                </p>
                <hi class="mb-4 text-3xl font-bold">{{ $post->title }}</hi>
                {{-- Тело поста хранится как HTML (из редактора) --}}
                <div class="mt-6">
                    {!! $post->body !!}
                </div>
            </article>
        </div>
    </main>
@endsection
