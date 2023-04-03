<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest; // useする

class BookController extends Controller
{
    public function index(Book $book)
    {
        return view('books/index')->with(['books' => $book->getPaginateByLimit()]);
        //getPaginateByLimit()はBook.phpで定義したメソッドです。
    }
    
    public function show(Book $book)
    {
        return view('books/show')->with(['book' => $book]);
    }
    
    public function create()
    {
        return view('books/create');
    }
    
    public function store(Book $book, BookRequest $request) // 引数をRequestからBookRequestにする。
    {
        $input = $request['book'];
        $book->fill($input)->save();
        return redirect('/books/' . $book->id);
    }
}
