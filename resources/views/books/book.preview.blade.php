<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>library</title>
    </head>
    <body>
        <h1>検索結果</h1>
            <div class='books'>
                @foreach ($books as $book)
                {{--<div class='book'>--}}
                        <h2 class='title'>{{ $book['volumeInfo']['title'] }}</h2>
                        <h3 class='title'>{{ $book['volumeInfo']['authors'] }}</h3>
                        <h3 class='title'>{{ $book['volumeInfo']['publishedDate'] }}</h3>
                {{--</div>--}}
                @endforeach
            </div>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</html>
