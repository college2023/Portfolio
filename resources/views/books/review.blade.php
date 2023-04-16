<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>library</title>
    </head>
    <body>
        <h1>くちこみ作成</h1>
            <div class='books_review&star'>
                @foreach ($books as $book)
                    <div class='book'>
                        <h2 class='title'>
                            <a href="/books/{book}">{{ $book['volumeInfo']['title'] }}</a>
                        </h2>
                    </div>
                @endforeach
            </div>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</html>
