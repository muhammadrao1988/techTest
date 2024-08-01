<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FibonacciController;

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

Route::get('/', [ArticleController::class, 'index'])->name('home');

#store procedure implementation
Route::get('/getArticle', [ArticleController::class, 'showArticle'])->name('article.show');
Route::post('/getArticle', [ArticleController::class, 'showArticle'])->name('article.fetch');

#fibonacci implementation
Route::get('/fibonacci', [FibonacciController::class, 'index'])->name('fibonacci');

#article crud
Route::resource('articles', ArticleController::class);

