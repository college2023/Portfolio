<!DOCTYPE html>
<x-app-layout>
    <x-slot name="header">
        　index
    </x-slot>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>library</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Book Name</h1>
        <form method="GET" action="/books/search">
            @csrf
            <input type="text" name="keyword" placeholder="タイトルを入力してください。">
            <button type="submit">検索する</button>
        </form>
        {{--<a href='/books/create'>(何を?)作成する</a>--}}
        <div class='books'>
            @foreach ($books as $book)
                <div class='book'>
                    <h2 class='title'>
                        <a href="/books/{{ $book->id }}">{{ $book->title }}</a>
                    </h2>
                    <p class='body'>{{ $book->body }}</p>
                </div>
                <a href="/categories/{{ $book->category->id }}">{{ $book->category->name }}</a>
                <a href="/authors/{{ $book->author->id }}">{{ $book->author->name }}</a>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $books->links() }}
        </div>
        <div class="back">[<a href="/">戻る</a>]</div>
        {{ Auth::user()->name }}
    </body>
</html>
</x-app-layout>
