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
                <p>{{ $book->body }}</p>    
            </div>
        </div>
        <a href='/books/create'>create</a>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
