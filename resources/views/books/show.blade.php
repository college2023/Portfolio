<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Library</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div style='background-color: #F3F4F6; text-align: center;'>

            <div class="header">
            <div style='padding: 5px 0 0 0;'>    
                <a href="/" class="button">
                    <button style='color: #fff; background-color: #21759b; border-radius: 5px; border-color: #21759b;'>検索画面に戻る</button>
                </a>
            </div>
            </div>
            
            {{--<h2>くちこみ画面</h2>--}}
            <div style='padding: 0.5em 1em; border: double 5px #4ec4d3; margin:20px 100px;'>
            <h2>タイトル：
                @if(array_key_exists('title', $book['volumeInfo']))
                    {{ $book['volumeInfo']['title'] }}
                @endif
            </h2>
            <h4>作者：
            @if(array_key_exists('authors', $book['volumeInfo']))
                @foreach($book['volumeInfo']['authors'] as $author)
                    {{ $author }}
                @endforeach
            @endif
            　　　発売日(年-月-日)：
            @if(array_key_exists('publishedDate', $book['volumeInfo']))
                {{ $book['volumeInfo']['publishedDate'] }}
            @endif
            </h4>詳細：
            @if(array_key_exists('description', $book['volumeInfo']))
                {{ $book['volumeInfo']['description'] }}
            @endif
            </div>

            <h2>くちこみ投稿</h2>
            <form action='/review/{{ $book['id'] }}' method='POST' enctype="multipart/form-data">
                @csrf
                <div style='padding: 0.5em 1em; margin:20px 100px;'>
                    <div class="adress">
                        <div style='size: 50;'>
                            <p><input type='text' style='width: 50%; height: 40px; font-size: 15px;' name='review[address]' placeholder="場所の名前、または住所を書いてください。"/></p>
                            <p class="address_error" style="color:red">{{ $errors->first('review.address') }}</p>
                        </div>
                    </div>
                    <div class="body">
                            <p><input type='text' style='width: 50%; height: 150px; font-size: 17px;' name='review[body]' placeholder="くちこみを書いてください。"/></p>
                            <p class="body_error" style="color:red">{{ $errors->first('review.body') }}</p>
                    </div>
                    <div class="image">
                        <input type="file" style='width: 50%;' name="image"/>
                    </div>
                    <div style='padding: 5px;'>
                        <input type='submit' style='color: #fff; background-color: #21759b; border-radius: 5px; border-color: #21759b; font-size: 17px;' value='投稿する'/>
                    </div>
                </div>
            </form>
    
            <h2>くちこみ内容</h2>
                @foreach($reviews as $review)
                <div style='padding: 0.5em 1em; border: solid 2px #4ec4d3; margin:20px 100px;'>
                    <p>場所：{{ $review['address'] }}</p>
                    <p>投稿者：{{ $review->user->name }}</p>
                    <p>内容：{{ $review['body'] }}</p>
    
                    {{--<img src="{{ $review->image_url }}" alt="画像が読み込めません。"/>--}}
                    @if($review->image_url)
                    <div>
                        <img src="{{ $review->image_url }}" style='width: 100%; high: 100%;'/>
                    </div>
                    @endif
                    
                    <p>作成日時：{{ $review['created_at'] }}</p>
                </div>
                @endforeach
    
            <div class="footer">
            <div style='padding: 0 0 5px 0;'>    
                <a href="/" class="button">
                    <button style='color: #fff; background-color: #21759b; border-radius: 5px; border-color: #21759b;'>検索画面に戻る</button>
                </a>
            </div>
            </div>
        
        </div>
    </body>
</html>
