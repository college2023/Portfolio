<!DOCTYPE html>
<x-app-layout>
    <x-slot name="header">
        　検索ページ
    </x-slot>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Library</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div style='background-color: #F3F4F6; padding: 200px; text-align: center;'>
        
        <form method="POST" action="/books/search">
            @csrf
            <input type="text" name="keyword" size='50' placeholder="タイトルを入力してください。"/>
            <button style='color: #fff; background-color: #21759b; border-radius: 5px; border-color: #21759b; padding: 2px 7px; box-shadow: 2px 2px 0 0 #0F3547;' type="submit">検索する</button>
            <p class="keyword__error" style="color:red">{{ $errors->first('keyword') }}</p>
        </form>
        
        <div class="information">
            <div style='padding: 0.5em 1em; border: double 5px #4ec4d3; margin:20px 100px;'>
                <h3>【運営からのお願い】</h3>
                <h4>このサイトは、本にまつわる皆さんの足跡を共有する場所です。</h4>
                <h4>快適なサイト作りにご協力いただき、ありがとうございます。</h4>
            </div>
        </div>

    {{--<h1>くちこみ新着</h1>
        @foreach($reviews as $review)
            <div style='border:solid 1px; margin-bottom: 10px;'>
                <p>本の題名：{{ $review['title'] }}</p>
                @foreach($review['authors'] as $author)
                    {{ $author }}
                @endforeach
                <p>場所：{{ $review['address'] }}</p>
                <p>投稿者：{{ $review['user_id'] }}</p>
                <p>内容：{{ $review['body'] }}</p>
                @if($review->image_url)
                <div>
                    <img src="{{ $review->image_url }}"/>
                </div>
                @endif
                <p>作成日時：{{ $review['created_at'] }}</p>
            </div>
        @endforeach--}}
        
        <div>ユーザー名：
        {{ Auth::user()->name }}
        </div>
        
        </div>
    </body>
</html>
</x-app-layout>
