<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>--}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Блог')</title>
</head>
<body class="min-h-screen bg-gray-950 text-gray-100 antialiased">
<header class="border-b border-white/10 bg-gray-900/60 backdrop-blur">
    <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
        <a href="{{ route('index') }}" class="text-lg font-semibold tracking-wide">
            Мой Блог
        </a>
        <nav class="flex items-center gap-6 text-sm text-gray-300">
            <a href="{{ route('blog.index') }}" class="hover:text-white transition">Посты</a>
            <a href="#" class="hover:text-white transition">0 проектов</a>

            @auth
                <a href="{{ route('admin.posts.index') }}" class="text-sm">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-600">Выйти</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="text-sm">Войти</a>
                <a href="{{ route('register') }}" class="text-sm">Регистрация</a>
            @endguest
        </nav>
    </div>
</header>

<main class="mx-auto max-w-6xl px-4 py-10">
    @yield('content')
</main>
</body>
</html>
