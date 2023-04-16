<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Books</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">
            {{ $book->title }}
        </h1>
        <div class="content">
            <div class="content__book">
                <h3>本文</h3>
                <p class='body'>{{ $book->body }}</p>
            </div>
        </div>
        <div>
            <a href="/categories/{{ $book->category->id }}">{{ $book->category->name }}</a>
            <a href="/authors/{{ $book->author->id }}">{{ $book->author->name }}</a>
        </div>
        <div class="footer">
            <a href='/books/review'>create(本のくちこみを書く)</a>
            <a href="/">戻る</a>
        </div>
    </body>
</html>
