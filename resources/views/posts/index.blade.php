<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Блог на Laravel</title>
</head>
<body>
    <div>
        <h2>Блог на Laravel</h2>

        @foreach($posts as $post) {{-- переменную $posts получаем из контроллера, проходим по всем постам --}}
            <div>
                <h2>
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                    {{--route('posts.show', $post->slug) - метод ведет на страницу posts.show, подставляет slug вместо id--}}
                    {{--все поля из БД берем как объект (через '->' )--}}
                </h2>
                <p>
                    {{ $post->published_at?->format('d.m.Y') }}
                </p>
                <p>{{ Str::limit($post->except, 150) }}</p>                         {{--лимит на количество символов--}}
                <a href="{{ route('posts.show', $post->slug) }}">Читать дальше</a>  {{--ссылка на страницу поста--}}
            </div>
        @endforeach

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</body>
</html>
