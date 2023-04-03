<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Library</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Book Name</h1>
        <a href='/posts/create'>create</a>
        <div class='books'>
            @foreach($books as $book)
                <div class='book'>
                    <h2 class='title'>
                        <a href="/books/{{ $book->id }}">{{ $book->title }}</a>
                    </h2>
                    <p class='body'>{{ $book->body }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $books->links() }}
        </div>
    </body>
</html>
