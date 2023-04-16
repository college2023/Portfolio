<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
        public function index(Author $author)
    {
        return view('authors.index')->with(['books' => $author->getByAuthor()]);
    }
}
