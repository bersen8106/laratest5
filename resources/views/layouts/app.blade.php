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
<!-- Шапка сайта -->
<header class="border-b border-white/10 bg-gray-900/60 backdrop-blur">
    <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
        <a href="{{ route('index') }}"
           class="text-lg font-semibold tracking-wide text-white hover:text-gray-200 transition">
            Мой блог
        </a>
        <nav class="flex items-center gap-6 text-sm">
            <a href="{{ route('blog.index') }}" class="text-gray-300 hover:text-white transition-colors">
                Главная
            </a>
            <a href="#" class="text-gray-300 hover:text-white transition-colors">
                О проекте
            </a>
        </nav>
    </div>
</header>
<main class="mx-auto max-w-6xl px-4 py-10">
    @yield('content')
</main>
</body>
</html>
