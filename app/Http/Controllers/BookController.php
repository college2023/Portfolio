<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest; // useする
use App\Http\Requests\Request; // useする
use App\Models\Category;
use App\Models\Author;
use stdClass; //配列をオブジェクトに変更

class BookController extends Controller
{
    public function index(Book $book)
    {
        // index bladeに取得したデータを渡す
        return view('books/index')->with([
            'books' => $book->getPaginateByLimit(),
        ]);
    }
    
    public function show(Book $book)
    {
        return view('books/show')->with(['book' => $book]);
    }

    public function create(Category $category, Author $author)
    {
        return view('books/create')->with(['categories' => $category->get(), 'authors' => $author->get()]);
    }

    public function store(Book $book, BookRequest $request) // 引数をRequestからBookRequestにする。
    {
        $input = $request['book'];
        $book->fill($input)->save();
        return redirect('/books/' . $book->id);
    }
    
    public function search(Request $request)
    {
        $keyword = $_GET['keyword'];
        // GETリクエストで送信したデータは、グローバル変数である $_GET に連想配列という形で入っている。
        // そこで、PHPでデータを受け取るときは、$_GETを使う。
        // $_GETからデータを受け取るには、受け取りたいinput要素のname属性をキーとして指定する。
        // name属性がkeywordなので、$_GET['keyword'] という書き方になる。

        // $keyword = $book['id'];
        // $keyword = "村上春樹";
        // $keyword = $request;
        //dd($keyword); //$keywordに入っているデータを確認

        // // クライアントインスタンス生成
        $client = new \GuzzleHttp\Client();

        // // GET通信するURL
        $url = 'https://www.googleapis.com/books/v1/volumes?q='.$keyword."&maxResults=40";

        // リクエスト送信と返却データの取得
        // Bearerトークンにアクセストークンを指定して認証を行う
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.googlebooks.token')]
        );
        
        // API通信で取得したデータはjson形式なので
        // PHPファイルに対応した連想配列にデコードする
        $booksArray = json_decode($response->getBody(), true);
        //dd($booksArray); //連想配列の確認
        //$books = (object)$booksArray; //オブジェクトに変更
        $books = new stdClass();
        $books->items = $booksArray['items'];
        // //dd($books);
        //dd($booksArray);
        
        return view('books/create')->with([
            'books' => $booksArray['items'] //['items']で余計な情報を取得しないように(情報を制限?)する。
            //bladeファイルにデータを送れているが、表示するときにうまく取り出せていない。
        ]);
    }
}
