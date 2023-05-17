<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest; // useする
use App\Http\Requests\SearchRequest; // useする
//use App\Http\Requests\Request; // useする //同じ名前にしない。
use Illuminate\Http\Request; //同じ名前にしない
use App\Models\Category;
use App\Models\Author;
//use stdClass; //配列をオブジェクトに変更
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Cloudinary; //Cloudinaryの使用

class BookController extends Controller
{
    public function index(Book $book) //(Review $review)//line13
    {
        // $reviews = $review->get(); //reviewをもってくる
        // $books = array();
        // foreach($reviews as $key => $value){
        //     $client = new \GuzzleHttp\Client();
        //     $url = 'https://www.googleapis.com/books/v1/volumes/'.$value->book_id; //apiのidを検索
        //     $response = $client->request(
        //         'GET',
        //         $url,
        //         ['Bearer' => config('services.googlebooks.token')]
        //     );
        
        //     $book = json_decode($response->getBody(), true);
        //     $books[]= $value;
        //     $books[$key]['title'] = $book['volumeInfo']['title'];
        //     $test = array();
        //     //dd($books);
        //     foreach($book['volumeInfo']['authors'] as $author){
        //         $test[] = $author;
        //     }
        //     $books[$key]['authors'] = $test;
        // }
        
        // index bladeに取得したデータを渡す
        return view('books/index'); //->with(['reviews' => $books])
    }
    
    public function show($book, Review $review)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://www.googleapis.com/books/v1/volumes/'.$book; //apiのidを検索
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.googlebooks.token')]
        );
        
        $books = json_decode($response->getBody(), true);

        $info = $review->where('book_id', $book)->get(); //絞り込み。引数
        
        return view('books/show')->with(['book' => $books, 'reviews'=>$info]);
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
    
    public function search(SearchRequest $request)
    {
        $keyword = $_POST['keyword'];
        // GETリクエストで送信したデータは、グローバル変数である $_GET に連想配列という形で入っている。
        // そこで、PHPでデータを受け取るときは、$_GETを使う。
        // $_GETからデータを受け取るには、受け取りたいinput要素のname属性をキーとして指定する。
        // name属性がkeywordなので、$_GET['keyword'] という書き方になる。

        // $keyword = $book['id'];
        // $keyword = "村上春樹";
        // $keyword = $request;

        // // クライアントインスタンス生成
        $client = new \GuzzleHttp\Client();

        // // GET通信するURL
        $url = 'https://www.googleapis.com/books/v1/volumes?q='.$keyword."&maxResults=20";
        //$url = 'https://www.googleapis.com/books/v1/volumes/lIaktAEACAAJ';

        // リクエスト送信と返却データの取得
        // Bearerトークンにアクセストークンを指定して認証を行う
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.googlebooks.token')]
        );
        
        // API通信で取得したデータはjson形式なので
        // PHPファイルに対応した連想配列にデコードする
        $booksArray = json_decode($response->getBody(), true); //dd($booksArray); //連想配列の確認
        //$books = (object)$booksArray; //オブジェクトに変更
        //$books = new stdClass();
        //$books->items = $booksArray['items'];

        return view('books/create')->with([
            'books' => $booksArray['items'] //['items']で余計な情報を取得しないように(情報を制限?)する。
            //bladeファイルにデータを送れているが、表示するときにうまく取り出せていない。=>解決。
        ]);
     }
    
    public function test($book, Review $review, BookRequest $request) //review
    {

        $input = $request['review']; //bodyとaddress
        $input['book_id'] = $book;
        $input['user_id'] = Auth::id();

        if($request->file('image')){ //画像ファイルが送られた時だけ処理が実⾏される
        //cloudinaryへ画像を送信し、画像のURLを$image_urlに代⼊している
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        //dd($image_url); //画像のURLを画⾯に表⽰
        $input += ['image_url' => $image_url]; //追加
        }
        
        $review->fill($input)->save();
        return redirect('/books/search/'.$book)->with(['reviews' => $review]);
        //->getPaginateByLimit()
        //'/review'
    }
}
