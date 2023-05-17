<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController; //外部にあるBookControllerクラスをインポート。
use App\Http\Controllers\CategoryController; //追加
use App\Http\Controllers\AuthorController; //追加

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(BookController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/books/search', 'search')->name('search');
    Route::post('/review/{book}', 'test')->name('review');
    Route::post('/books/store', 'store')->name('store');
    Route::get('/books/create', 'create')->name('create');
    Route::get('/books/search/{book}', 'show')->name('show'); //getをpostに変更すると404|NOT FOUNDになる。
    // Route::put('/books/{book}', 'update')->name('update');
    // Route::delete('/books/{book}', 'delete')->name('delete');
    // Route::get('/books/{book}/edit', 'edit')->name('edit');
});

Route::get('/categories/{category}', [CategoryController::class,'index'])->middleware("auth");
Route::get('/authors/{author}', [AuthorController::class,'index'])->middleware("auth");

require __DIR__.'/auth.php';
