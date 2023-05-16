<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Library</title>
    </head>
    <body>
        <div style='background-color: #F3F4F6; text-align: center;'>

            <div class="back">
                <div style='padding: 5px 0 0 0;'>    
                <a href="/" class="button">
                    <button style='color: #fff; background-color: #21759b; border-radius: 5px; border-color: #21759b;'>戻る</button>
                </a>
                </div>
            </div>
            
            <h1>検索結果</h1>
                <div class='books'>
                    @foreach ($books as $book)
                        <div class='book'>
                            <div style='padding: 0.5em 1em; border: double 5px #4ec4d3; margin:20px 100px;'>
                                <a href="/books/search/{{ $book['id'] }}">
                                <h2>
                                    {{--<input type="submit" name="bookname"/>--}}
                                    @if(array_key_exists('title', $book['volumeInfo']))
                                        {{ $book['volumeInfo']['title'] }}
                                    @endif
                                </h2>
                                </a>
            
                                <h4>著者：
                                @if(array_key_exists('authors', $book['volumeInfo']))
                                    @foreach($book['volumeInfo']['authors'] as $author)
                                        {{ $author }}
                                    @endforeach
                                @endif
                                </h4>
                                <h4>出版社：
                                @if(array_key_exists('publisher', $book['volumeInfo']))
                                    {{ $book['volumeInfo']['publisher'] }}
                                @endif
                                </h4>
                                <h4>発売日(年-月-日)：
                                @if(array_key_exists('publishedDate', $book['volumeInfo']))
                                    {{ $book['volumeInfo']['publishedDate'] }}
                                @endif
                                </h4>
                                <div>
                                詳細：
                                @if(array_key_exists('description', $book['volumeInfo']))
                                    {{ $book['volumeInfo']['description'] }}
                                @endif
                                </div>
                            {{--詳細情報を表示させるためのコード変更を行う→現在、失敗中。→成功。array_keyがあるかチェックを行うコードを追加。--}}
                            </div>
                        </div>
                    @endforeach
                </div>

            <div class="back">
                <div style='padding: 0 0 5px 0;'>    
                <a href="/" class="button">
                    <button style='color: #fff; background-color: #21759b; border-radius: 5px; border-color: #21759b;'>戻る</button>
                </a>
                </div>
            </div>
        
        </div>
    </body>
</html>
